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

        $user->update([
            'nama' => $validatedData['nama'],
            'npm' => $validatedData['npm'],
            'kelas_id' => $validatedData['kelas_id'],
        ]);

        return redirect()->route('user.list')->with('success', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Mencari user berdasarkan ID
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->route('user.list')->with('error', 'User tidak ditemukan.');
        }

        $user->delete();

        return redirect()->route('user.list')->with('success', 'User berhasil dihapus!');
    }

    public function show($id)
    {
        // Mengambil data user berdasarkan ID
        $user = $this->userModel->getUser($id);

        if (!$user) {
            return redirect()->route('user.list')->with('error', 'User tidak ditemukan.');
        }

        // Mengirim data user ke view profile
        $data = [
            'title' => 'Profile',
            'nama' => $user->nama,
            'npm' => $user->npm,
            'nama_kelas' => $user->nama_kelas,
            'profile_picture' => $user->foto,
        ];

        return view('profile', $data);
    }


    public function store(StoreUserRequest $request)
    {
        // validasi input
        $request->validate([
            'nama' => 'required',
            'npm' => 'required',
            'kelas_id' => 'required',
            'foto' => 'image|file|max:2048', // validasi foto
        ]);

        // Proses upload foto
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename); // Menyimpan file ke storage

            // Simpan data user ke database
            $this->userModel->create([
                'nama' => $request->input('nama'),
                'npm' => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id'),
                'foto' => $filename, // Menyimpan nama file ke database
            ]);
        }

        return redirect()->to('/user/list')->with('success', 'User berhasil ditambahkan!');

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

    }

}
