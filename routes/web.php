<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\KesiswaanController;

/*
|--------------------------------------------------------------------------
| SCAN QR
|--------------------------------------------------------------------------
*/
Route::get('/scan/{nis}', [AbsensiController::class, 'scan']);

/*
|--------------------------------------------------------------------------
| HALAMAN AWAL
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('login');
});

/*
|--------------------------------------------------------------------------
| LOGIN SISWA
|--------------------------------------------------------------------------
*/
Route::post('/login-siswa', function (Request $request) {

    $siswa = Siswa::where('nis', $request->nis)->first();

    if ($siswa && $request->password == $siswa->nis) {

        session([
            'login_siswa' => true,
            'siswa_id' => $siswa->id
        ]);

        return redirect('/dashboard-siswa');
    }

    return back()->with('error', 'Login siswa gagal');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD SISWA
|--------------------------------------------------------------------------
*/
Route::get('/dashboard-siswa', function () {

    if (!session('login_siswa')) {
        return redirect('/');
    }

    $siswa = Siswa::find(session('siswa_id'));

    return view('dashboard_siswa', compact('siswa'));
});

/*
|--------------------------------------------------------------------------
| LOGOUT SISWA
|--------------------------------------------------------------------------
*/
Route::post('/logout-siswa', function () {
    session()->forget(['login_siswa', 'siswa_id']);
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| LOGIN GURU & KESISWAAN
|--------------------------------------------------------------------------
*/
Route::post('/login-process', function (Request $request) {

    $credentials = $request->only('email', 'password');

    Auth::logout();

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/redirect-role');
    }

    return back()->with('error', 'Login gagal');
});

/*
|--------------------------------------------------------------------------
| REDIRECT ROLE
|--------------------------------------------------------------------------
*/
Route::get('/redirect-role', function () {

    if (!auth()->check()) return redirect('/');

    $role = auth()->user()->role;

    if ($role == 'guru') return redirect('/dashboard-guru');
    if ($role == 'kesiswaan') return redirect('/dashboard-kesiswaan');

    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard-guru', fn() => view('dashboard_guru'));
    Route::get('/dashboard-kesiswaan', fn() => view('dashboard_kesiswaan'));

    /*
    | CRUD SISWA
    */
    Route::get('/kesiswaan/siswa', [SiswaController::class, 'index']);
    Route::get('/kesiswaan/siswa/create', [SiswaController::class, 'create']);
    Route::post('/kesiswaan/siswa/store', [SiswaController::class, 'store']);
    Route::get('/kesiswaan/siswa/delete/{id}', [SiswaController::class, 'destroy']);

    /*
    | USER
    */
    Route::get('/kesiswaan/users', [UserController::class, 'index']);
    Route::get('/kesiswaan/users/create', [UserController::class, 'create']);
    Route::post('/kesiswaan/users/store', [UserController::class, 'store']);
    Route::get('/kesiswaan/users/delete/{id}', [UserController::class, 'destroy']);

    /*
    | KESISWAAN
    */
    Route::get('/kesiswaan/absensi', [KesiswaanController::class, 'absensi']);
    Route::get('/kesiswaan/kehadiran', [KesiswaanController::class, 'kehadiran']);
});

/*
|--------------------------------------------------------------------------
| ABSENSI SISWA (IZIN)
|--------------------------------------------------------------------------
*/
Route::get('/absensi', [IzinController::class, 'create']);
Route::post('/absensi/store', [IzinController::class, 'store']);

/*
|--------------------------------------------------------------------------
| SCAN PAGE
|--------------------------------------------------------------------------
*/
Route::get('/scan-absensi', function () {
    return view('kesiswaan.scan');
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

/*
|--------------------------------------------------------------------------
| AUTH DEFAULT
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/guru/absensi', [KesiswaanController::class, 'absensi']);
    Route::get('/guru/kehadiran', [KesiswaanController::class, 'kehadiran']);

});

Route::middleware('auth')->group(function () {

    Route::get('/guru/absensi', function () {
        $izin = \App\Models\Izin::with('siswa')->latest()->get();
        return view('guru.absensi.index', compact('izin'));
    });

    Route::get('/guru/kehadiran', function () {
        $absensi = \App\Models\Absensi::with('siswa')->latest()->get();
        return view('guru.kehadiran.index', compact('absensi'));
    });

});

Route::get('/kesiswaan/siswa/edit/{id}', [SiswaController::class, 'edit']);
Route::post('/kesiswaan/siswa/update/{id}', [SiswaController::class, 'update']);

// GURU
Route::get('/guru/kehadiran', [AbsensiController::class, 'dataKehadiran']);
Route::get('/guru/absensi', [IzinController::class, 'dataIzin']);

//Export
Route::get('/kesiswaan/siswa/export', [SiswaController::class, 'export']);

Route::get('/kesiswaan/kehadiran/export', [AbsensiController::class, 'export']);

Route::get('/kesiswaan/absensi/export', [IzinController::class, 'export']);




Route::get('/kesiswaan/users', [UserController::class, 'index']);

Route::get('/kesiswaan/users/create', [UserController::class, 'create']);
Route::post('/kesiswaan/users/store', [UserController::class, 'store']);

Route::get('/kesiswaan/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/kesiswaan/users/update/{id}', [UserController::class, 'update']);

//import
Route::post('/kesiswaan/siswa/import', [SiswaController::class, 'import']);