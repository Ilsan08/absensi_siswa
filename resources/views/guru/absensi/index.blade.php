<!DOCTYPE html>
<html>
<head>
    <title>Data Tidak Hadir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen">

<!-- BACKGROUND -->
<div class="fixed inset-0">
    <img src="{{ asset('uploads/latar.png') }}"
         class="w-full h-full object-cover">
</div>

<!-- CONTENT -->
<div class="relative z-10 p-5">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-6">

        <div class="flex items-center gap-4">

            <img src="{{ asset('uploads/logo.png') }}"
                 alt="Logo SMAN 1 Ciparay"
                 class="w-16 h-16 object-contain">

            <div>
                <h2 class="text-2xl font-bold text-white drop-shadow">
                    Data Tidak Hadir
                </h2>

                <p class="text-white/90 text-sm">
                    Data Izin, Sakit, Dispensasi, dan Alfa Siswa
                </p>
            </div>

        </div>

    </div>

    <!-- BUTTON -->
    <div class="flex gap-2 mb-4">

        <!-- BACK -->
        <a href="/dashboard-guru"
           class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            ⬅ Kembali
        </a>

        <!-- EXPORT -->
        <a href="/kesiswaan/absensi/export?search={{ request('search') }}&kelas={{ request('kelas') }}&tanggal={{ request('tanggal') }}"
           class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
            ⬇ Export Excel
        </a>

    </div>

    <!-- FILTER -->
    <form method="GET"
          class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-2 bg-white p-3 rounded shadow">

        <!-- SEARCH -->
        <input type="text"
               name="search"
               placeholder="Cari nama / NIS / kelas"
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

        <!-- FILTER TANGGAL -->
        <input type="date"
               name="tanggal"
               value="{{ request('tanggal') }}"
               class="border p-2 rounded">

        <!-- BUTTON -->
        <button class="bg-blue-500 text-white rounded px-4 hover:bg-blue-600 transition">
            Filter
        </button>

    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="bg-gray-200 text-center">

                    <th class="p-2">No</th>
                    <th class="p-2">Nama</th>
                    <th class="p-2">Kelas</th>
                    <th class="p-2">Jenis</th>
                    <th class="p-2">Keterangan</th>
                    <th class="p-2">Tanggal</th>
                    <th class="p-2">File</th>

                </tr>

            </thead>

            <tbody>

                @forelse($izin as $i)

                <tr class="text-center border-t hover:bg-gray-50">

                    <td class="p-2">
                        {{ $loop->iteration }}
                    </td>

                    <td class="p-2">
                        {{ $i->siswa->nama ?? '-' }}
                    </td>

                    <td class="p-2">
                        {{ $i->siswa->kelas ?? '-' }}
                    </td>

                    <td class="p-2">

                        <span class="
                            @if($i->jenis == 'izin')
                                bg-blue-500
                            @elseif($i->jenis == 'sakit')
                                bg-yellow-500
                            @elseif($i->jenis == 'dispen')
                                bg-purple-500
                            @else
                                bg-red-500
                            @endif

                            text-white px-3 py-1 rounded-full text-sm
                        ">

                            {{ ucfirst($i->jenis) }}

                        </span>

                    </td>

                    <td class="p-2">
                        {{ $i->keterangan ?? '-' }}
                    </td>

                    <td class="p-2">
                        {{ $i->tanggal }}
                    </td>

                    <td class="p-2">

                        @if($i->file)

                            <a href="{{ asset('storage/'.$i->file) }}"
                               target="_blank"
                               class="bg-green-500 hover:bg-green-600 transition text-white px-3 py-1 rounded-lg">

                                Lihat

                            </a>

                        @else

                            <span class="text-gray-400">
                                Tidak ada
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="p-4 text-center text-gray-500">

                        Data tidak ditemukan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-4 flex justify-center">
        {{ $izin->links('pagination::tailwind') }}
    </div>

</div>

</body>
</html>