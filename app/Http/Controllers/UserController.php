<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['guru', 'kesiswaan'])->get();
        return view('kesiswaan.users.index', compact('users'));
    }

    public function create()
    {
        return view('kesiswaan.users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect('/kesiswaan/users')->with('success', 'User berhasil ditambahkan');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User dihapus');
    }

    // FORM EDIT
public function edit($id)
{
    $user = User::findOrFail($id);

    return view('kesiswaan.users.edit', compact('user'));
}

// UPDATE USER
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ];

    // kalau password diisi
    if ($request->password) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect('/kesiswaan/users')
        ->with('success', 'User berhasil diupdate');
}
}