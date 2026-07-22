<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kesiswaan</title>
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
<div class="relative bg-white/90 backdrop-blur-md w-80 p-6 rounded-2xl shadow-2xl text-center">

    <!-- LOGO -->
    <div class="mb-4">
        <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
        <h2 class="text-lg font-bold text-gray-700">Dashboard Kesiswaan</h2>
    </div>

    <!-- MENU -->
    <a href="/scan-absensi"
       class="block bg-indigo-600 hover:bg-indigo-700 transition text-white py-3 rounded-xl mb-3">
        Scan QR Absensi
    </a>

    <a href="/kesiswaan/absensi"
       class="block bg-green-600 hover:bg-green-700 transition text-white py-3 rounded-xl mb-3">
        Data Tidak Hadir (Izin/Sakit)
    </a>

    <a href="/kesiswaan/kehadiran"
       class="block bg-yellow-500 hover:bg-yellow-600 transition text-white py-3 rounded-xl mb-3">
        Rekap Kehadiran
    </a>

    <a href="/kesiswaan/siswa"
       class="block bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-xl mb-3">
        Data Siswa
    </a>

    <a href="/kesiswaan/users"
       class="block bg-purple-600 hover:bg-purple-700 transition text-white py-3 rounded-xl mb-4">
        Data User (Guru & Kesiswaan)
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