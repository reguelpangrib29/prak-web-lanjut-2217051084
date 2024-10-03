@extends('layouts.app')

@section ('content')

<!-- Flash Message -->
@if(session('success'))
    <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="container mx-auto p-8">
    <div class="flex justify-between items-center mb-6 bg-gradient-to-r from-blue-500 to-blue-300 text-white py-4 px-6 rounded-lg shadow-lg transform hover:scale-105 transition duration-500">
        <h1 class="text-3xl font-extrabold text-white">List of Users</h1>
        <a href="{{ route('user.create') }}" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transform hover:scale-105 transition duration-500 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah User
        </a>
    </div>
    
    <div class="overflow-x-auto bg-white shadow-2xl rounded-lg">
        <table class="min-w-full bg-white border-collapse border border-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-400 text-white">
                <tr>
                    <th class="w-20 py-3 px-4 uppercase font-semibold text-sm border border-gray-200">ID</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm border border-gray-200">Nama</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm border border-gray-200">NPM</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm border border-gray-200">Kelas</th>
                    <th class="py-3 px-4 uppercase font-semibold text-sm border border-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gradient-to-r from-gray-100 to-gray-200 transform hover:scale-105 transition duration-300 ease-in-out">
                    <td class="w-20 py-3 px-4 text-center border border-gray-200">{{ $user['id'] }}</td>
                    <td class="py-3 px-4 border border-gray-200">{{ $user['nama'] }}</td>
                    <td class="py-3 px-4 border border-gray-200">{{ $user['npm'] }}</td>
                    <td class="py-3 px-4 border border-gray-200">{{ $user['nama_kelas'] }}</td>
                    <td class="py-3 px-4 flex items-center justify-center border border-gray-200 space-x-2">
                        <a href="{{ route('user.edit', $user->id) }}" class="flex items-center bg-yellow-400 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded-lg shadow-lg transform hover:scale-110 transition duration-500 ease-in-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L6.707 10.464a1 1 0 00-.263.45l-1 4a1 1 0 001.263 1.263l4-1a1 1 0 00.45-.263l7.879-7.879a2 2 0 000-2.828l-1.586-1.586zM10 14H9v1h1v-1zm2-2h-1v1h1v-1zm-2-2h1v1H9v-1zm-1 1v1H7v-1h1z" />
                            </svg>
                            Edit
                        </a>
                        
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded-lg shadow-lg transform hover:scale-110 transition duration-500 ease-in-out" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 2a2 2 0 00-2 2v1H5.5a.5.5 0 000 1H6v10a2 2 0 002 2h4a2 2 0 002-2V6h.5a.5.5 0 000-1H12V4a2 2 0 00-2-2zM8 7a.5.5 0 00-.5.5v7a.5.5 0 001 0v-7A.5.5 0 008 7zm4 0a.5.5 0 00-.5.5v7a.5.5 0 001 0v-7A.5.5 0 0012 7z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection