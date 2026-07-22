<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
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
        <h2 class="text-xl font-bold text-white">Data User</h2>
    </div>

    <!-- BACK -->
    <a href="/dashboard-kesiswaan"
       class="bg-gray-600 text-white px-4 py-2 rounded mb-3 inline-block">
       ⬅ Kembali ke Dashboard
    </a>

    <!-- TAMBAH -->
    <a href="/kesiswaan/users/create"
       class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
       + Tambah User
    </a>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Nama</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Role</th>
                    <th class="p-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $u)
                <tr class="border-t hover:bg-gray-50">
                    <td class="p-2">{{ $u->name }}</td>
                    <td class="p-2">{{ $u->email }}</td>
                    <td class="p-2 capitalize">{{ $u->role }}</td>
                    <td class="p-2 space-x-1">

    <!-- EDIT -->
    <a href="/kesiswaan/users/edit/{{ $u->id }}"
       class="bg-green-500 text-white px-3 py-1 rounded">
       Edit
    </a>

    <!-- HAPUS -->
    <a href="/kesiswaan/users/delete/{{ $u->id }}"
       onclick="return confirm('Yakin hapus user?')"
       class="bg-red-500 text-white px-3 py-1 rounded">
       Hapus
    </a>

</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

</body>
</html>