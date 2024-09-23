<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\Kelas;
use App\Models\UserModel;


class UserController extends Controller
{
    public function profile($nama = '', $kelas = '', $npm = '')
    {
        $data = [
            'nama' => $nama,
            'kelas' => $kelas,
            'npm' => $npm
        ];

        return view('profile', $data);
    }

    public function create()
    {
        return view('create_user', [
            'kelas' => Kelas::all(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        // Mengambil data yang dikirim dari form menggunakan input()
        $data = [
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'npm' => $request->input('npm'),
        ];

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
