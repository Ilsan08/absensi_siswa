<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
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
        Tambah User
    </h2>

    <p class="text-gray-500 text-sm">
        Masukkan data akun guru atau kesiswaan
    </p>

</div>

    <!-- BACK -->
    <a href="/kesiswaan/users"
       class="text-sm text-gray-600 underline mb-3 inline-block">
       ⬅ Kembali ke Data User
    </a>

   <!-- FORM -->
<form method="POST" action="/kesiswaan/users/store">
    @csrf

    <!-- Nama -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            Nama <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name') }}"
            placeholder="Nama"
            required
            class="w-full p-2 border rounded @error('name') border-red-500 @enderror">

        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            Email <span class="text-red-500">*</span>
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Email"
            required
            class="w-full p-2 border rounded @error('email') border-red-500 @enderror">

        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            Password <span class="text-red-500">*</span>
        </label>

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
            class="w-full p-2 border rounded @error('password') border-red-500 @enderror">

        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Role -->
    <div class="mb-3">
        <label class="block text-sm font-semibold mb-1">
            Role <span class="text-red-500">*</span>
        </label>

        <select
            name="role"
            required
            class="w-full p-2 border rounded @error('role') border-red-500 @enderror">

            <option value="">Pilih Role</option>
            <option value="guru" {{ old('role')=='guru' ? 'selected' : '' }}>
                Guru
            </option>
            <option value="kesiswaan" {{ old('role')=='kesiswaan' ? 'selected' : '' }}>
                Kesiswaan
            </option>

        </select>

        @error('role')
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