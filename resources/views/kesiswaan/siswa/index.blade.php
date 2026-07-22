<!DOCTYPE html>
<html>
<head>
    <title>Data Siswa</title>
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
        <h2 class="text-xl font-bold text-white">Data Siswa</h2>
    </div>

    <!-- BACK -->
    <a href="/dashboard-kesiswaan"
        class="bg-gray-600 text-white px-4 py-2 rounded mb-4 inline-block">
        ⬅ Kembali
    </a>

    <!-- TAMBAH -->
    <a href="/kesiswaan/siswa/create"
       class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
       + Tambah Siswa
    </a>
    

    <!-- EXPORT -->
     <a href="/kesiswaan/siswa/export?search={{ request('search') }}&kelas={{ request('kelas') }}"
   class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
   ⬇ Export Excel
</a>
    <!-- FILTER -->
<form method="GET" class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-2 bg-white p-3 rounded shadow">

    <!-- SEARCH -->
    <input type="text" name="search" placeholder="Cari nama / NIS / kelas"
        value="{{ request('search') }}"
        class="border p-2 rounded">

    <!-- FILTER KELAS -->
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

    <!-- BUTTON -->
    <button class="bg-blue-500 text-white rounded px-4">
        Filter
    </button>

</form>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-200 text-center">
                    <th class="p-2">No</th>
                    <th class="p-2">NIS</th>
                    <th class="p-2">Nama</th>
                    <th class="p-2">Kelas</th>
                    <th class="p-2">QR Code</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $s)
                <tr class="text-center border-t hover:bg-gray-50">
                    <td class="p-2">{{ $loop->iteration }}</td>
                    <td class="p-2">{{ $s->nis }}</td>
                    <td class="p-2">{{ $s->nama }}</td>
                    <td class="p-2">{{ $s->kelas }}</td>

                    <td class="p-2">
                        @if($s->qr_code)
                            {!! QrCode::size(80)->generate($s->qr_code) !!}
                        @else
                            <span class="text-red-500 text-sm">Belum ada QR</span>
                        @endif
                    </td>

                    <td class="p-2 space-x-1">
                        <a href="/kesiswaan/siswa/edit/{{ $s->id }}"
                           class="bg-green-500 text-white px-2 py-1 rounded">
                           Edit
                        </a>
                       <a href="/kesiswaan/siswa/delete/{{ $s->id }}"
   onclick="return confirm('Yakin hapus?')"
   class="bg-red-500 text-white px-2 py-1 rounded">
   Hapus
</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<div class="p-4 flex justify-center">
    {{ $siswa->links('pagination::tailwind') }}
</div>
</div>


</body>
</html>