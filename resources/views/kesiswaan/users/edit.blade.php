<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center">

<!-- BACKGROUND -->
<div class="absolute inset-0">
   <img src="{{ asset('uploads/latar.png') }}"
     class="w-full h-full object-cover">
</div>

<!-- FORM -->
<div class="relative bg-white/90 backdrop-blur-md p-6 rounded-2xl shadow-xl w-96">

    <!-- LOGO -->
    <div class="flex justify-center mb-3">
        <img src="{{ asset('uploads/logo.png') }}"
         alt="Logo SMAN 1 Ciparay"
         class="w-20 h-20 mx-auto object-contain">
    </div>

    <h2 class="text-xl font-bold text-center mb-4">
        Edit User
    </h2>

    <a href="/kesiswaan/users"
       class="bg-gray-500 text-white px-3 py-1 rounded mb-4 inline-block">
       ⬅ Kembali
    </a>

    <form method="POST" action="/kesiswaan/users/update/{{ $user->id }}">
        @csrf

        <input type="text" name="name"
            value="{{ $user->name }}"
            class="w-full border p-2 rounded mb-3" required>

        <input type="email" name="email"
            value="{{ $user->email }}"
            class="w-full border p-2 rounded mb-3" required>

        <select name="role"
            class="w-full border p-2 rounded mb-3" required>

            <option value="guru"
                {{ $user->role == 'guru' ? 'selected' : '' }}>
                Guru
            </option>

            <option value="kesiswaan"
                {{ $user->role == 'kesiswaan' ? 'selected' : '' }}>
                Kesiswaan
            </option>

        </select>

        <input type="password" name="password"
            placeholder="Password baru (opsional)"
            class="w-full border p-2 rounded mb-3">

        <button class="bg-green-500 text-white w-full py-2 rounded">
            Update
        </button>

    </form>

</div>

</body>
</html>