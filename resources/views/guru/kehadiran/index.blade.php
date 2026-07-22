<!DOCTYPE html>
<html>
<head>
    <title>Rekap Kehadiran Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen">

<!-- BACKGROUND -->
<div class="fixed inset-0">
   <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<div class="relative z-10 p-5">

    <!-- HEADER -->
    <div class="flex items-center gap-4">
        <img src="{{ asset('uploads/logo.png') }}"
             alt="Logo SMAN 1 Ciparay"
             class="w-16 h-16 object-contain">
        <h2 class="text-xl font-bold text-white">Rekap Kehadiran Siswa</h2>
    </div>

    <!-- BACK -->
    <a href="/dashboard-guru"
       class="bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
       ⬅ Kembali ke Dashboard Guru
    </a>

     <!-- EXPORT -->
        <a href="/kesiswaan/kehadiran/export?search={{ request('search') }}&kelas={{ request('kelas') }}&tanggal={{ request('tanggal') }}"
           class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
           ⬇ Export Excel
        </a>

    <!-- FILTER -->
    <form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-2 bg-white p-3 rounded shadow">

        <input type="text" name="search" placeholder="Cari nama / NIS / kelas"
            value="{{ request('search') }}"
            class="border p-2 rounded">

      <select name="kelas" class="border p-2 rounded">
    <option value="">-- Semua Kelas --</option>

    @foreach(['X','XI','XII'] as $tingkat)
        @for($i=1;$i<=12;$i++)
            <option value="{{ $tingkat }} {{ $i }}"
                {{ request('kelas') == "$tingkat $i" ? 'selected' : '' }}>
                {{ $tingkat }} {{ $i }}
            </option>
        @endfor
    @endforeach
</select>

        <input type="date" name="tanggal"
            value="{{ request('tanggal') }}"
            class="border p-2 rounded">

        <button class="bg-blue-500 text-white rounded px-4">
            Filter
        </button>

    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-x-auto">
        <table class="w-full text-center">
                <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No</th>
                <th class="p-2">Nama</th>
                <th class="p-2">Kelas</th>
                <th class="p-2">Tanggal</th>
                <th class="p-2">Jam Masuk</th>
                <th class="p-2">Jam Pulang</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>    
           <tbody>
    @foreach($absensi as $a)
    <tr class="border-t hover:bg-gray-50">
        <td class="p-2">{{ $loop->iteration }}</td>

        <td class="p-2">
            {{ $a->siswa->nama ?? '-' }}
        </td>

        <td class="p-2">
            {{ $a->siswa->kelas ?? '-' }}
        </td>

        <td class="p-2">
            {{ $a->tanggal }}
        </td>

        <!-- JAM MASUK -->
        <td class="p-2">
            {{ $a->waktu_masuk ?? '-' }}
        </td>

        <!-- JAM PULANG -->
        <td class="p-2">
            {{ $a->waktu_pulang ?? '-' }}
        </td>

        <!-- STATUS -->
        <td class="p-2">
            <span class="
                px-2 py-1 text-white rounded
                @if($a->status=='hadir') bg-green-500
                @elseif($a->status=='terlambat') bg-yellow-500
                @else bg-red-500
                @endif
            ">
                {{ $a->status }}
            </span>
        </td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
<div class="p-4 flex justify-center">
    {{ $absensi->links('pagination::tailwind') }}
</div>

</div>

</body>
</html>