<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LostFoundItemController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ReportCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Bantuan
Route::get('/bantuan', function () {
    return view('help');
})->name('help');

// Halaman Tentang Kami
Route::get('/tentang', function () {
    return view('about');
})->name('about');

// Rute untuk registrasi
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('role:admin')->get('/dashboard', function (Request $request) {
    if ($request->user()->role === "admin") {
        return redirect()->route('admin.dashboard');
    } else if ($request->user()->role === "mahasiswa") {
        return redirect()->route('mahasiswa.dashboard');
    } else if ($request->user()->role === "petugas") {
        return redirect()->route('officer.dashboard');
    }
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->middleware('role')->name('logout');

Route::prefix('admin')->middleware('role:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/users/{id}/update-role', [AdminController::class, 'updateRole'])->name('admin.update-role');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
});

Route::prefix('officer')->middleware('role:petugas')->group(function () {
    Route::get('/dashboard', [OfficerController::class, 'dashboard'])->name('officer.dashboard');
});

Route::middleware('role:admin,petugas')
    ->group(function (){
        Route::prefix('location')
            ->name('location.')
            ->group(function () {
                Route::get('/', [LocationController::class, 'index'])->name('index');
                Route::get('create', [LocationController::class, 'create'])->name('create');
                Route::post('store', [LocationController::class, 'store'])->name('store');
                Route::put('update/{id}', [LocationController::class, 'update'])->name('update');
                Route::get('edit/{id}', [LocationController::class, 'edit'])->name('edit');
                Route::get('{id}', [LocationController::class, 'show'])->name('show');
                Route::delete('{id}', [LocationController::class, 'destroy'])->name('destroy');
            });
        Route::prefix('report-category')
            ->name('reportcategory.')
            ->group(function () {
                Route::get('/', [ReportCategoryController::class, 'index'])->name('index');
                Route::get('create', [ReportCategoryController::class, 'create'])->name('create');
                Route::post('store', [ReportCategoryController::class, 'store'])->name('store');
                Route::put('update/{id}', [ReportCategoryController::class, 'update'])->name('update');
                Route::get('edit/{id}', [ReportCategoryController::class, 'edit'])->name('edit');
                Route::get('{id}', [ReportCategoryController::class, 'show'])->name('show');
                Route::delete('{id}', [ReportCategoryController::class, 'destroy'])->name('destroy');
            });
    });

Route::prefix('report')
    ->middleware('role')
    ->name('report.')
    ->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('create', [ReportController::class, 'create'])->name('create');
        Route::post('store', [ReportController::class, 'store'])->name('store');
        Route::put('update/{id}', [ReportController::class, 'update'])->name('update');
        Route::get('edit/{id}', [ReportController::class, 'edit'])->name('edit');
        Route::get('{id}', [ReportController::class, 'show'])->name('show');
        Route::delete('{id}', [ReportController::class, 'destroy'])->name('destroy');
    });

Route::prefix('lost-found')
    ->middleware('role')
    ->name('lostfound.')
    ->group(function () {
        Route::get('/', [LostFoundItemController::class, 'index'])->name('index');
        Route::get('create', [LostFoundItemController::class, 'create'])->name('create');
        Route::post('store', [LostFoundItemController::class, 'store'])->name('store');
        Route::put('update/{id}', [LostFoundItemController::class, 'update'])->name('update');
        Route::get('edit/{id}', [LostFoundItemController::class, 'edit'])->name('edit');
        Route::get('{id}', [LostFoundItemController::class, 'show'])->name('show');
        Route::delete('{id}', [LostFoundItemController::class, 'destroy'])->name('destroy');
    });

// Dashboard mahasiswa
Route::prefix('mahasiswa')->middleware('role:mahasiswa')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');

    // Laporan kebersihan
    Route::prefix('kebersihan')->group(function () {
        Route::get('/', [MahasiswaController::class, 'kebersihanIndex'])->name('mahasiswa.kebersihan.index');
        Route::get('/create', [MahasiswaController::class, 'kebersihanCreate'])->name('mahasiswa.kebersihan.create');
    });

    // Laporan barang hilang/temuan
    Route::prefix('barang')->group(function () {
        Route::get('/', [MahasiswaController::class, 'barangIndex'])->name('mahasiswa.lostfound.index');
        Route::get('/create', [MahasiswaController::class, 'barangCreate'])->name('mahasiswa.lostfound.create');
    });
});
