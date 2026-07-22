<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-500 flex items-center justify-center h-screen">

<div class="bg-white p-6 rounded-2xl w-80 shadow-lg">

    <h2 class="text-xl font-bold mb-4 text-center">Daftar Akun</h2>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
        {{ $errors->first() }}
    </div>
@endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- ROLE -->
        <select name="role" class="w-full mb-3 p-2 border rounded-lg" required>
            <option value="">Pilih Role</option>
            <option value="siswa">Siswa</option>
            <option value="guru">Guru</option>
            <option value="kesiswaan">Kesiswaan</option>
        </select>

        <!-- NAMA -->
        <input type="text" name="name" placeholder="Nama"
            class="w-full mb-3 p-2 border rounded-lg" required>

        <!-- EMAIL -->
        <input type="email" name="email" placeholder="Email"
            class="w-full mb-3 p-2 border rounded-lg" required>

        <!-- PASSWORD -->
        <input type="password" name="password" placeholder="Password"
            class="w-full mb-3 p-2 border rounded-lg" required>

        <!-- CONFIRM -->
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
            class="w-full mb-4 p-2 border rounded-lg" required>

        <button class="w-full bg-blue-500 text-white py-2 rounded-lg">
            Daftar
        </button>
    </form>

    <p class="text-center mt-3 text-sm">
        Sudah punya akun?
        <a href="/login-custom" class="text-blue-500">Login</a>
    </p>

</div>

</body>
</html>