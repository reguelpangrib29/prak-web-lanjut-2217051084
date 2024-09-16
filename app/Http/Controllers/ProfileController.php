<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($nama = "", $kelas = "", $npm = "") 
    { 
        $profile_picture = session('profile_picture');

        $data = [
            'nama' => $nama,
            'kelas' => $kelas, 
            'npm' => $npm,
            'profile_picture' => $profile_picture,
        ];

        return view('profile', $data); 
    }

    public function uploadProfilePicture(Request $request) {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $path = $request->file('profile_picture')->store('profile_pictures', 'public');

        // Menyimpan path gambar ke session
        session(['profile_picture' => $path]);

        return back()->with('success', 'Foto profil berhasil diunggah. ')->with('profile_picture', $path);
    }
}
