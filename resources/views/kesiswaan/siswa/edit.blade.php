<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center">

<!-- BACKGROUND -->
<div class="absolute inset-0">
   <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<!-- CONTENT -->
<div class="relative bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl w-96">

    <!-- LOGO -->
    <div class="flex justify-center mb-3">
        <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
    </div>

    <!-- TITLE -->
    <h2 class="text-lg font-bold text-center mb-4">Edit Siswa</h2>

    <!-- BACK -->
    <a href="/kesiswaan/siswa"
       class="bg-gray-500 hover:bg-gray-600 transition text-white px-3 py-1 rounded mb-3 inline-block">
       ⬅ Kembali
    </a>

    <!-- FORM -->
    <form method="POST" action="/kesiswaan/siswa/update/{{ $siswa->id }}">
        @csrf

        <!-- NIS -->
        <input type="text" name="nis" value="{{ $siswa->nis }}"
            class="w-full mb-3 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">

        <!-- NAMA -->
        <input type="text" name="nama" value="{{ $siswa->nama }}"
            class="w-full mb-3 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">

        <!-- KELAS -->
        <select name="kelas"
            class="w-full mb-3 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            
            @foreach(['X','XI','XII'] as $tingkat)
                @for($i=1;$i<=12;$i++)
                    <option value="{{ $tingkat }} {{ $i }}"
                        {{ $siswa->kelas == "$tingkat $i" ? 'selected' : '' }}>
                        {{ $tingkat }} {{ $i }}
                    </option>
                @endfor
            @endforeach

        </select>

        <!-- BUTTON -->
        <button class="bg-green-500 hover:bg-green-600 transition text-white w-full py-2 rounded">
            Update
        </button>

    </form>

</div>

</body>
</html>