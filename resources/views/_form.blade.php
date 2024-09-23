<form action="{{ $action }}" method="POST" class="p-form p-form--stacked">
    @csrf
    <!-- Untuk update, menambahkan method PUT -->
    @if(isset($method) && $method == 'PUT')
        @method('PUT')
    @endif

    <!-- Input Nama -->
    <div class="p-form__group">
        <label for="nama" class="p-form__label">Nama:</label>
        <input type="text" id="nama" name="nama" class="p-form__input" value="{{ old('nama', $user->nama ?? '') }}" required>
        @error('nama')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Input NPM -->
    <div class="p-form__group">
        <label for="npm" class="p-form__label">NPM:</label>
        <input type="text" id="npm" name="npm" class="p-form__input" value="{{ old('npm', $user->npm ?? '') }}" required>
        @error('npm')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Pilihan Kelas -->
    <div class="p-form__group">
        <label for="kelas" class="p-form__label">Kelas:</label>
        <select name="kelas_id" id="kelas_id" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach($kelas as $kelasItem)
                <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $user->kelas_id ?? '') == $kelasItem->id ? 'selected' : '' }}>{{ $kelasItem->nama_kelas }}</option>
            @endforeach
        </select>
        @error('kelas_id')
            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Tombol Submit -->
    <div class="p-form__group">
        <button type="submit" class="p-button--positive">Submit</button>
    </div>
</form>
