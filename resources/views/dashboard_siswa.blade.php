<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <div class="mb-3">
        <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
        <h2 class="text-lg font-bold text-gray-700">Dashboard Siswa</h2>
    </div>

    <!-- NAMA -->
    <p class="mb-4 text-gray-600">
        Halo, <span class="font-semibold">{{ $siswa->nama }}</span>
    </p>

    <!-- QR CODE -->
    <div class="flex justify-center mb-4">
        <div class="bg-white p-3 rounded-xl shadow">
            {!! QrCode::size(150)->generate($siswa->qr_code ?? $siswa->nis) !!}
        </div>
    </div>

    <p class="text-sm text-gray-600 mb-3">
        Scan QR Code ini untuk melakukan presensi di sekolah
    </p>

    <p class="text-xs text-gray-400 italic mb-4">
        "Semangat terus dan jangan lupa datang tepat waktu ya! 😊"
    </p>

    <!-- BUTTON -->
    <a href="/absensi"
       class="block bg-green-500 hover:bg-green-600 transition text-white py-3 rounded-xl mb-3">
        Absensi (Izin/Sakit)
    </a>

    <!-- LOGOUT -->
    <form method="POST" action="/logout-siswa">
        @csrf
        <button class="bg-red-500 hover:bg-red-600 transition text-white px-4 py-2 rounded-xl w-full">
            Logout
        </button>
    </form>

    @if(session('success'))
<script>
    Swal.fire({
        title: 'Berhasil 🎉',
        html: `
            <div style="font-size:15px">
                <b>Absensi kamu berhasil dikirim!</b><br><br>
                📚 Data ketidakhadiran telah masuk ke sistem sekolah.<br>
                Semangat dan semoga sehat selalu 😊
            </div>
        `,
        icon: 'success',
        confirmButtonText: 'Mantap!',
        confirmButtonColor: '#22c55e',
        background: '#ECFDF5',
        color: '#1F2937',
        width: 430
    });
</script>
@endif

</div>

</body>
</html>