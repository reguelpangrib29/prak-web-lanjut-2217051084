<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\Kelas;
use App\Models\UserModel;


class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function profile($nama = '', $kelas = '', $npm = '')
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm
        ];

        return view('profile', $data);
    }

    public function index()
    {
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(),
        ];

        return view('list_user', $data);
    }

    public function create()
    {
        $kelasModel = new Kelas();

        $kelas = $kelasModel->getKelas();

        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);

        return view('create_user', [
            'kelas' => Kelas::all(),
        ]);
    }

    public function edit($id)
    {
        // Mencari user berdasarkan ID
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->route('user.list')->with('error', 'User tidak ditemukan.');
        }

        $kelas = $this->kelasModel->getKelas();

        // Mengirim data user dan kelas ke view edit_user
        return view('edit_user', [
            'user' => $user,
            'kelas' => $kelas,
        ]);
    }

    public function update(StoreUserRequest $request, $id)
    {
        
        $validatedData = $request->validated();

        // Mencari user berdasarkan ID
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->route('user.list')->with('error', 'User tidak ditemukan.');
        }

        // Update data user
        $user->update([
            'nama' => $validatedData['nama'],
            'npm' => $validatedData['npm'],
            'kelas_id' => $validatedData['kelas_id'],
        ]);

        // Redirect kembali ke halaman list user dengan pesan sukses
        return redirect()->route('user.list')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Mencari user berdasarkan ID
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->route('user.list')->with('error', 'User tidak ditemukan.');
        }

        // Hapus user dari database
        $user->delete();

        // Redirect kembali ke halaman list user dengan pesan sukses
        return redirect()->route('user.list')->with('success', 'User berhasil dihapus!');
    }

    public function store(StoreUserRequest $request)
    {
        // Mengambil data yang dikirim dari form menggunakan input()
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
        ]);

        // Validasi data
        $validatedData = $request->validated();

        // Menyimpan data user ke database
        $user = UserModel::create($validatedData);

        $user->load('kelas');

        // Mengirim data ke view profile
        return view('profile', [
            'nama' => $user->nama,
            'npm' => $user->npm,
            'nama_kelas' => $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan',
        ]);

        return redirect()->route('user.list')->with('success', 'User berhasil ditambahkan!');
    }

}
