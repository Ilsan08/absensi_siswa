<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Absensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center">

<!-- BACKGROUND IMAGE -->
<div class="absolute inset-0">
   <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<!-- OVERLAY GELAP (BIAR FORM KELIHATAN) -->
<div class="absolute inset-0 bg-black/50"></div>

<!-- CONTENT -->
<div class="relative bg-white/90 backdrop-blur-md w-96 p-8 rounded-2xl shadow-2xl">

   <!-- LOGO -->
<div class="text-center mb-4">
    <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
    <h2 class="text-xl font-bold text-gray-700">SMAN 1 Ciparay</h2>
    <p class="text-sm text-gray-500">Sistem Absensi Siswa</p>
</div>

    <!-- ERROR -->
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-3 rounded text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- LOGIN SISWA -->
    <div class="mb-6">
        <h3 class="font-semibold mb-2 text-green-600">Login Siswa</h3>

        <form method="POST" action="/login-siswa">
            @csrf

            <input type="text" name="nis" placeholder="Masukkan NIS"
                class="w-full mb-2 p-3 border rounded-xl focus:ring-2 focus:ring-green-400 outline-none">

            <input type="password" name="password" placeholder="Password (NIS)"
                class="w-full mb-3 p-3 border rounded-xl focus:ring-2 focus:ring-green-400 outline-none">

            <button class="w-full bg-green-500 hover:bg-green-600 transition text-white py-2 rounded-xl">
                Login Siswa
            </button>
        </form>
    </div>

    <!-- DIVIDER -->
    <div class="flex items-center my-4">
        <div class="flex-1 h-px bg-gray-300"></div>
        <span class="px-2 text-gray-400 text-sm">atau</span>
        <div class="flex-1 h-px bg-gray-300"></div>
    </div>

    <!-- LOGIN GURU -->
    <div>
        <h3 class="font-semibold mb-2 text-blue-600">Guru / Kesiswaan</h3>

        <form method="POST" action="/login-process">
            @csrf

            <input type="email" name="email" placeholder="Email"
                class="w-full mb-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">

            <input type="password" name="password" placeholder="Password"
                class="w-full mb-3 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400 outline-none">

            <button class="w-full bg-blue-500 hover:bg-blue-600 transition text-white py-2 rounded-xl">
                Login Guru / Kesiswaan
            </button>
        </form>
    </div>

</div>

</body>
</html>