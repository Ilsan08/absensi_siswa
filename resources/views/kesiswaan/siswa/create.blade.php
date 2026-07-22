<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex justify-center items-center">

<!-- BACKGROUND -->
<div class="fixed inset-0">
   <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<div class="relative z-10 bg-white p-6 rounded-2xl shadow w-96">

   <!-- HEADER -->
<div class="text-center mb-6">

    <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-16 h-16 mx-auto object-contain mb-3">

    <h2 class="text-2xl font-bold text-gray-800">
        Tambah Siswa
    </h2>

    <p class="text-gray-500 text-sm">
        Masukkan data siswa
    </p>

</div>

    <!-- BACK BUTTON -->
    <a href="/kesiswaan/siswa"
        class="text-sm text-gray-600 underline mb-3 inline-block">
        ⬅ Kembali ke Data Siswa
    </a>

   <!-- FORM -->
<form method="POST" action="/kesiswaan/siswa/store">
    @csrf

    <!-- NIS -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            NIS <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="nis"
            value="{{ old('nis') }}"
            placeholder="Masukkan NIS"
            required
            inputmode="numeric"
            pattern="[0-9]+"
            maxlength="20"
            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
            class="w-full p-2 border rounded @error('nis') border-red-500 @enderror">

        @error('nis')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Nama -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            Nama <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="nama"
            value="{{ old('nama') }}"
            placeholder="Masukkan Nama"
            required
            class="w-full p-2 border rounded @error('nama') border-red-500 @enderror">

        @error('nama')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Kelas -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            Kelas <span class="text-red-500">*</span>
        </label>

        <select
            name="kelas"
            required
            class="w-full p-2 border rounded @error('kelas') border-red-500 @enderror">

            <option value="">Pilih Kelas</option>

            <optgroup label="Kelas X">
                @for($i=1;$i<=12;$i++)
                    <option value="X {{ $i }}"
                        {{ old('kelas')=="X $i" ? 'selected' : '' }}>
                        X {{ $i }}
                    </option>
                @endfor
            </optgroup>

            <optgroup label="Kelas XI">
                @for($i=1;$i<=12;$i++)
                    <option value="XI {{ $i }}"
                        {{ old('kelas')=="XI $i" ? 'selected' : '' }}>
                        XI {{ $i }}
                    </option>
                @endfor
            </optgroup>

            <optgroup label="Kelas XII">
                @for($i=1;$i<=12;$i++)
                    <option value="XII {{ $i }}"
                        {{ old('kelas')=="XII $i" ? 'selected' : '' }}>
                        XII {{ $i }}
                    </option>
                @endfor
            </optgroup>

        </select>

        @error('kelas')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <p class="text-xs text-red-500 mb-3">
        * Wajib diisi
    </p>

    <button class="bg-blue-500 hover:bg-blue-600 transition text-white w-full py-2 rounded">
        Simpan
    </button>

</form>
</div>

</body>
</html>