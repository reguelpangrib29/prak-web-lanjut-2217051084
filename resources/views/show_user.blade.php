@extends('layouts.app')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
@endsection

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 relative overflow-hidden">
        <!-- Elemen background dekoratif -->
        <div class="absolute w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 top-1/3 left-1/4 animate-pulse"></div>
        <div class="absolute w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 top-1/4 right-1/3 animate-pulse"></div>
        <div class="absolute w-48 h-48 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 bottom-1/3 left-1/3 animate-pulse"></div>

        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-lg mx-auto text-center transform hover:scale-105 transition-transform duration-500 relative z-10">
            <!-- Menampilkan Foto Profil -->
            @if($user->foto)
            <div class="w-48 h-48 mx-auto mb-6">
                <img class="w-full h-full rounded-full shadow-lg border-4 border-blue-500 object-cover"
                     src="{{ asset('storage/uploads/' . $user->foto) }}" alt="Profile Picture">
            </div>
            @else
            <p>Foto tidak tersedia</p>
            @endif

            <!-- Informasi User -->
            <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->nama }}</h2>
            <p class="text-lg text-gray-600 mb-4">{{ $user->npm }}</p>
            <p class="text-lg text-gray-600 mb-4">{{ $kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</p>

            <hr class="my-4 border-t-4" style="border-color: rgba(0, 0, 0, 0.15);">

            <!-- Tombol Kembali ke List User -->
            <a href="{{ route('user.list') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300">
                Kembali ke List User
            </a>
        </div>
    </div>
@endsection