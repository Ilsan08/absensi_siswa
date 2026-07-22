<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center">

<!-- BACKGROUND -->
<div class="fixed inset-0">
   <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<!-- CONTENT -->
<div class="relative z-10 bg-white w-80 p-6 rounded-2xl shadow text-center">

    <!-- LOGO -->
    <div class="flex justify-center mb-3">
       <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
    </div>

    <!-- TITLE -->
    <h2 class="text-lg font-bold mb-4">Dashboard Guru</h2>

    <!-- MENU -->
    <a href="/guru/absensi"
        class="block bg-blue-500 hover:bg-blue-600 transition text-white py-3 rounded-xl mb-3">
        📄 Lihat Absensi Siswa
    </a>

    <a href="/guru/kehadiran"
        class="block bg-green-500 hover:bg-green-600 transition text-white py-3 rounded-xl mb-3">
        📊 Rekap Kehadiran
    </a>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-xl w-full">
            Logout
        </button>
    </form>

</div>

</body>
</html>