<!DOCTYPE html>
<html>
<head>
    <title>Absensi Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center">

<!-- BACKGROUND -->
<div class="absolute inset-0">
    <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<!-- OVERLAY -->
<div class="absolute inset-0 bg-black/50"></div>

<!-- CONTENT -->
<div class="relative bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-2xl w-96">

    <!-- LOGO -->
    <div class="text-center mb-3">
        <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
        <h2 class="text-lg font-bold text-gray-700">Absensi Siswa</h2>
    </div>

    <p class="text-sm text-gray-500 text-center mb-4">
        Isi form jika tidak dapat hadir ke sekolah
    </p>

    <!-- ERROR -->
    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-2 mb-3 rounded text-sm">
        {{ session('error') }}
    </div>
    @endif

   <!-- FORM -->
<form method="POST" action="/absensi/store" enctype="multipart/form-data">
    @csrf

    <!-- NIS -->
    <input type="text" value="{{ $siswa->nis }}"
        class="w-full mb-3 p-2 border rounded bg-gray-100" readonly>

    <!-- NAMA -->
    <input type="text" value="{{ $siswa->nama }}"
        class="w-full mb-3 p-2 border rounded bg-gray-100" readonly>

    <!-- KELAS -->
    <input type="text" value="{{ $siswa->kelas }}"
        class="w-full mb-3 p-2 border rounded bg-gray-100" readonly>

    <!-- JENIS -->
    <div class="mb-3">
        <label class="block text-sm mb-1 font-semibold">
            Jenis Absensi <span class="text-red-500">*</span>
        </label>

        <div class="space-y-1 text-sm">
            <label>
                <input type="radio" name="jenis" value="sakit" required
                    {{ old('jenis')=='sakit'?'checked':'' }}>
                Sakit
            </label><br>

            <label>
                <input type="radio" name="jenis" value="izin"
                    {{ old('jenis')=='izin'?'checked':'' }}>
                Izin
            </label><br>

            <label>
                <input type="radio" name="jenis" value="dispen"
                    {{ old('jenis')=='dispen'?'checked':'' }}>
                Dispensasi
            </label><br>

            <label>
                <input type="radio" name="jenis" value="alfa"
                    {{ old('jenis')=='alfa'?'checked':'' }}>
                Alfa
            </label>
        </div>

        @error('jenis')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- TANGGAL -->
    <div class="mb-3">
        <label class="block text-sm mb-1 font-semibold">
            Tanggal <span class="text-red-500">*</span>
        </label>

        <input
            type="date"
            name="tanggal"
            value="{{ old('tanggal') }}"
            required
            class="w-full p-2 border rounded @error('tanggal') border-red-500 @enderror">

        @error('tanggal')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- KETERANGAN -->
    <div class="mb-3">
        <label class="block text-sm mb-1 font-semibold">
            Keterangan <span class="text-red-500">*</span>
        </label>

        <textarea
            name="keterangan"
            required
            placeholder="Masukkan keterangan"
            class="w-full p-2 border rounded @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>

        @error('keterangan')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- FILE -->
    <div class="mb-3">
        <label class="block text-sm mb-1 font-semibold">
            Upload Bukti <span class="text-red-500">*</span>
        </label>

        <input
            type="file"
            name="file"
            required
            class="w-full p-2 border rounded @error('file') border-red-500 @enderror">

        <p class="text-xs text-gray-400 mt-1">
            Upload bukti (jpg, png, pdf, doc, docx) maksimal 20MB
        </p>

        @error('file')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <p class="text-xs text-red-500 mb-3">
        * Wajib diisi
    </p>

    <!-- BUTTON SUBMIT -->
    <button class="bg-blue-500 hover:bg-blue-600 transition text-white w-full py-2 rounded-xl mb-2">
        Submit Absensi
    </button>

</form>

    <!-- BACK BUTTON -->
    <a href="/dashboard-siswa"
       class="block text-center bg-gray-500 hover:bg-gray-600 transition text-white py-2 rounded-xl">
        ← Kembali ke Dashboard
    </a>

</div>

</body>
</html>