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
        $user = $this->userModel->findOrFail($id);

        // Mengambil data kelas untuk dropdown
        $kelas = $this->kelasModel->getKelas();

        // Set title untuk halaman edit
        $title = 'Edit User';

        // Mengirim data ke view edit_user dengan fungsi compact
        return view('edit_user', compact('user', 'kelas', 'title'));
    }

    public function update(StoreUserRequest $request, $id)
    {
        
        // Mencari user berdasarkan ID
        $user = $this->userModel->findOrFail($id);

        // Validasi data dari request
        $validatedData = $request->validated();

        // Update data user lainnya
        $user->nama = $validatedData['nama'];
        $user->npm = $validatedData['npm'];
        $user->kelas_id = $validatedData['kelas_id'];

        // Cek apakah ada file foto yang di-upload
        if ($request->hasFile('foto')) {
            // Ambil nama file foto lama dari database
            $oldFilename = $user->foto;

            // Hapus foto lama jika ada
            if ($oldFilename) {
                $oldFilePath = public_path('storage/uploads/' . $oldFilename);
                // Cek apakah file lama ada dan hapus
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Hapus foto lama dari folder
                }
            }

            // Simpan file baru dengan storeAs
            $file = $request->file('foto');
            $newFilename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $newFilename, 'public'); // Menyimpan file ke folder uploads dalam storage/public

            // Update nama file di database
            $user->foto = $newFilename;
        }

        // Simpan perubahan pada user
        $user->save();

        return redirect()->route('user.list')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Mencari user berdasarkan ID
        $user = $this->userModel->findOrFail($id);

        // Hapus user dari database
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('user.list')->with('success', 'User Berhasil dihapus');
    }

    public function show($id)
    {
        // Mencari user berdasarkan ID
        $user = $this->userModel->findOrFail($id);

        // Mencari data kelas berdasarkan kelas_id user
        $kelas = $this->kelasModel->find($user->kelas_id);

        // Set title untuk halaman detail
        $title = 'Show User ' . $user->nama;

        // Mengirim data ke view show_user dengan fungsi compact
        return view('show_user', compact('user', 'kelas', 'title'));
    }

    public function store(StoreUserRequest $request)
    {
        // Validasi input
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
