@extends('layouts.app')

@section('content')
<div class="frame">
    <div class="p-card u-align--center">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>

        <div class="flex justify-end mb-6">
            <a href="{{ route('user.list') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-300">
                List User
            </a>
        </div>

        <!-- Form untuk update user -->
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="p-form p-form--stacked">
            @csrf
            @method('PUT') <!-- Menggunakan method PUT untuk update -->

            <!-- Input Nama -->
            <div class="p-form__group mb-4">
                <label for="nama" class="p-form__label font-semibold text-gray-700">Nama:</label>
                <input type="text" id="nama" name="nama" class="p-form__input w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                value="{{ old('nama', $user->nama ?? '') }}" required>
                @error('nama')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input NPM -->
            <div class="p-form__group mb-4">
                <label for="npm" class="p-form__label font-semibold text-gray-700">NPM:</label>
                <input type="text" id="npm" name="npm" class="p-form__input w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                value="{{ old('npm', $user->npm ?? '') }}" required>
                @error('npm')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilihan Kelas -->
            <div class="p-form__group mb-4">
                <label for="kelas_id" class="p-form__label font-semibold text-gray-700">Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $user->kelas_id ?? '') == $kelasItem->id ? 'selected' : '' }}>
                        {{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('kelas_id')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Foto -->
            <div class="p-form__group mb-4">
                <label for="foto" class="p-form__label font-semibold text-gray-700">Foto:</label>
                <input type="file" id="foto" name="foto" class="p-form__input w-full p-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('foto')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
                @if($user->foto)
                <img src="{{ asset('storage/uploads/' . $user->foto) }}" alt="Foto User" width="100" class="mt-4">
                @endif
            </div>

            <!-- Tombol Submit -->
            <div class="p-form__group">
                <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- CSS Styling -->
<style>
    body {
        font-family: "Ubuntu", sans-serif;
        background: linear-gradient(135deg, #4c4cfa, #6fa3ef);
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        overflow: hidden;
    }

    .frame {
        padding: 20px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.3); 
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px); 
        width: 450px;
        display: flex;
        justify-content: center;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .p-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 100%;
        max-width: 400px;
        margin: 0 auto;
        animation: fadeIn 1.5s ease-out;
    }

    @keyframes fadeIn {
        0% {
            transform: scale(0.8);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    h1 {
        font-family: 'Pacifico', cursive;
        color: #4c4cfa;
        margin-bottom: 20px;
        text-align: center;
        font-size: 2em;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-15px);
        }
        60% {
            transform: translateY(-10px);
        }
    }

    .p-form__group {
        margin-bottom: 15px;
    }

    .p-form__label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }

    .p-form__input {
        width: 100%;
        padding: 10px;
        border: 2px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }

    .p-form__input:focus {
        border-color: #6fa3ef;
    }

    .p-button--positive {
        width: 100%;
        padding: 10px;
        background-color: #4c4cfa;
        border: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        animation: pulse 1.5s infinite;
    }

    .p-button--positive:hover {
        background-color: #6fa3ef;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }
</style>