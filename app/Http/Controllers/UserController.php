<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        // Tampilkan halaman profile dengan data yang dikirim dari formulir
        return view('profile', [
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'npm' => $request->input('npm'),
        ]);
    }

    public function create()
    {
        return view('create_user');
    }

    public function store(Request $request)
    {
        // Mengambil data yang dikirim dari form menggunakan input()
        $data = [
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'npm' => $request->input('npm'),
        ];

        // Validasi data
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:20',
            'kelas' => 'required|string|max:10',
        ]);

        // Mengirim data ke view profile
        return view('profile', $data);
    }
}
