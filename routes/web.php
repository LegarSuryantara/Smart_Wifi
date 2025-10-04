<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\{
    AdminDashboardController,
    OrdersController,
    UserDashboardController,
    ProfileController,
    PermissionController,
    RoleController,
    UserController,
    PaketController,
    CustomerController,
    MessageController,
    DeviceController,
    MonitoringController,
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

Route::middleware(['auth', 'permission:admin-access', 'verified'])->group(function () {

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

    // Customer route
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/admin/customers/pdf', [CustomerController::class, 'exportPdf'])->name('customers.pdf');


    // Pakets routes
    Route::get('/pakets', [PaketController::class, 'index'])->name('pakets.index');
    Route::get('/pakets/create', [PaketController::class, 'create'])->name('pakets.create');
    Route::post('/pakets', [PaketController::class, 'store'])->name('pakets.store');
    Route::get('/pakets/{paket}/edit', [PaketController::class, 'edit'])->name('pakets.edit');
    Route::put('/pakets/{paket}', [PaketController::class, 'update'])->name('pakets.update');
    Route::delete('/pakets/{paket}', [PaketController::class, 'destroy'])->name('pakets.destroy');

    //Transaction
    Route::get('/transactions', [OrdersController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/{orderId}', [OrdersController::class, 'detailTransaction']);
    Route::get('/transactions/sync/{id}', [OrdersController::class, 'syncTransaction'])->name('transactions.sync');
    Route::post('/transactions/notification', [OrdersController::class, 'notificationHandler']);

    // Fonnte routes
    Route::resource('messages', MessageController::class);
    Route::resource('devices', DeviceController::class);

    Route::post('send-message', [DeviceController::class, 'sendMessage'])->name('send.message');
    Route::post('devices/status', [DeviceController::class, 'checkDeviceStatus']);
    Route::post('devices/activate', [DeviceController::class, 'activateDevice'])->name('devices.activate');
    Route::post('devices/disconnect', [DeviceController::class, 'disconnect'])->name('devices.disconnect');


    // Kalau mau test UI,DLL taruh didalam sini Routenya :

    // Route::get('/dashboardHome', function () {
    //     return view('UI_disini.dashboardHome');
    // })->name('dashboard.dashboardHome');

    // Route::get('/dashboardPakets', function () {
    //     return view('UI_disini.dashboardPakets');
    // })->name('dashboard.dashboardPakets');

    // Route::get('/tambahPaket', function () {
    //     return view('UI_disini.tambahPaket');
    // })->name('dashboard.tambahPaket');

    // Route::get('/editPaket', function () {
    //     return view('UI_disini.editPaket');
    // })->name('dashboard.editPaket');

    // Route::get('/dashboardPengguna', function () {
    //     return view('UI_disini.dashboardPengguna');
    // })->name('dashboard.dashboardPengguna');

    // Route::get('/dashboardCustomer', function () {
    //     return view('UI_disini.dashboardCustomers');
    // })->name('dashboard.dashboardCustomer');

    // Route::get('/dashboardTransaksi', function () {
    //     return view('UI_disini.dashboardTransaksi');
    // })->name('dashboard.dashboardTransaksi');

    // Route::get('/dashboardMonitoring', function () {
    //     return view('UI_disini.monitoring');
    // })->name('dashboard.dashboardMonitring');

    // -------------------- //


    // ----Experimental---- //

    Route::get('/monitorings', [MonitoringController::class, 'index'])->name('monitorings.index');
    Route::get('/monitorings/stats', [MonitoringController::class, 'stats'])->name('monitorings.stats');
    Route::post('/monitorings/connect', [MonitoringController::class, 'connect'])->name('monitorings.connect');
    // Route::get('/monitorings/create', [MonitoringController::class, 'create'])->name('monitorings.create');
    // Route::post('/monitorings', [MonitoringController::class, 'store'])->name('monitorings.store');

});

// Route yang bisa diakses oleh semua user yang login (termasuk user biasa)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/profile-photos', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/paket/{id}', [PaketController::class, 'show'])->name('pakets.show');
    Route::get('/paket/{id}/pembayaran', [PaketController::class, 'pembayaran'])->name('pakets.pembayaran');
    Route::post('/Checkout', [OrdersController::class, 'checkout'])->name('pakets.checkout');

    // Kalau mau test UI,DLL taruh di dalam sini Routenya :



    // --------------------//



});

require __DIR__ . '/auth.php';
