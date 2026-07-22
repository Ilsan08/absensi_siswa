<!DOCTYPE html>
<html>
<head>
    <title>Scan QR Absensi</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
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
<div class="relative bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-2xl text-center w-[420px]">

    <!-- LOGO -->
    <div class="mb-3">
        <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
        <h2 class="text-lg font-bold text-gray-700">Scan QR Absensi</h2>
    </div>

    <p class="text-sm text-gray-500 mb-4">
        Arahkan kamera ke QR Code siswa
    </p>

    <!-- SCANNER (LEBIH BESAR) -->
    <div id="reader" class="mx-auto"></div>

    <!-- STATUS -->
    <p id="status" class="mt-4 text-green-600 font-semibold"></p>

    <!-- BACK BUTTON -->
    <a href="/dashboard-kesiswaan"
       class="block mt-4 bg-gray-500 hover:bg-gray-600 transition text-white py-2 rounded-xl">
        ← Kembali ke Dashboard
    </a>

</div>

<script>
let scanner;
let lastScan = null;

function playSound() {
    let audio = new Audio('https://www.soundjay.com/buttons/sounds/button-3.mp3');
    audio.volume = 1.0; // 🔥 full volume
    audio.play();
}

function onScanSuccess(decodedText) {

    if (decodedText === lastScan) return;
    lastScan = decodedText;

    document.getElementById('status').innerHTML = "Memproses...";

    playSound();

    fetch('/scan/' + decodedText)
        .then(res => res.text())
        .then(data => {

            document.getElementById('status').innerHTML = data;

            setTimeout(() => {
                lastScan = null;
                document.getElementById('status').innerHTML = "";
            }, 1200);

        })
        .catch(err => console.log(err));
}

function startScanner() {
    scanner = new Html5Qrcode("reader");

    Html5Qrcode.getCameras().then(devices => {
        if (devices.length) {

            scanner.start(
                devices[0].id,
                {
                    fps: 12,          
                    qrbox: 300     
                },
                onScanSuccess
            );

        }
    }).catch(err => console.log(err));
}

window.onload = startScanner;
</script>

</body>
</html>