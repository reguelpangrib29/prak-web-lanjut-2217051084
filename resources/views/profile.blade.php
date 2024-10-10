<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Halaman Profile</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-blue-500 to-purple-600 relative overflow-hidden">
        <!-- Elemen background dekoratif -->
        <div class="absolute w-64 h-64 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 top-1/3 left-1/4 animate-pulse"></div>
        <div class="absolute w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 top-1/4 right-1/3 animate-pulse"></div>
        <div class="absolute w-48 h-48 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 bottom-1/3 left-1/3 animate-pulse"></div>

        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-sm mx-auto text-center transform hover:scale-105 transition-transform duration-500 relative z-10">
            <!-- Form untuk upload profile picture -->
            <form action="{{ route('upload.profile.picture') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="relative w-32 h-32 mx-auto mb-6">
                    <!-- Gambar Profil -->
                    <img class="w-full h-full rounded-full shadow-lg border-4 border-blue-500 object-cover"
                        src="{{ $profile_picture ? asset('storage/uploads/' . $profile_picture) : asset('assets/img/Gaurav Kavat Profile.jpeg') }}"
                        alt="Profile Picture">

                    <!-- Tombol Upload Gambar -->
                    <label for="profile_picture"
                        class="absolute bottom-0 right-0 bg-blue-500 text-white rounded-full p-2 cursor-pointer shadow-md transition duration-300 ease-in-out hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354l3.293 3.293-1.414 1.414L12 7.414l-1.879 1.879-1.414-1.414L12 4.354zM12 11v7m-3.5-3.5H7m10 0h-1.5m-5.5 3a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </label>

                    <!-- Input file hidden -->
                    <input type="file" name="profile_picture" id="profile_picture" class="hidden" onchange="this.form.submit()">
                </div>

                <h2 class="text-2xl font-bold text-gray-800 mb-2">Profile Information</h2>
                <p class="text-sm text-gray-500 mb-4">Welcome to your profile page. Here's a brief summary of your details.</p>

                <!-- Informasi Profil -->
                <div class="bg-blue-100 p-3 rounded-lg mb-4 shadow-inner">
                    <span class="block text-lg font-semibold text-blue-800">Nama</span>
                    <span class="text-gray-700">{{ $nama }}</span>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg mb-4 shadow-inner">
                    <span class="block text-lg font-semibold text-blue-800">NPM</span>
                    <span class="text-gray-700">{{ $npm }}</span>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg mb-4 shadow-inner">
                    <span class="block text-lg font-semibold text-blue-800">Kelas</span>
                    <span class="text-gray-700">{{ $nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>