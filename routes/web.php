<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminDashboardController,
    UserDashboardController,
    ProfileController,
    PermissionController,
    RoleController,
    UserController,
    PaketController
};

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/',function(){
//     return view('guests/dashboard');
// });

Route::get('/', [PaketController::class, 'showGuestPackages'])->name('guest.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', 'role:admin', 'verified'])->group(function () {

    Route::get('/admin-dashboard', [AdminDashboardController::class, 'index'])->name('admin.index');
    
    // Permission routes
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions/{id}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Roles routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles', [RoleController::class, 'destroy'])->name('roles.destroy');

    // Users route
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('users.destroy');

    // Pakets routes
    Route::get('/pakets', [PaketController::class, 'index'])->name('pakets.index');
    Route::get('/pakets/create', [PaketController::class, 'create'])->name('pakets.create');
    Route::post('/pakets', [PaketController::class, 'store'])->name('pakets.store');
    Route::get('/pakets/{paket}/edit', [PaketController::class, 'edit'])->name('pakets.edit');
    Route::put('/pakets/{paket}', [PaketController::class, 'update'])->name('pakets.update');
    Route::delete('/pakets/{paket}', [PaketController::class, 'destroy'])->name('pakets.destroy');

});

// Route yang bisa diakses oleh semua user yang login (termasuk user biasa)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
