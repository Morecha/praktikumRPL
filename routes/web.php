<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{DashboardController, UserController, RoleController,
    KatbarangController, BarangController, PembukuanController, LaporanController};

Route::get('/', function () {
    return view('welcome');
});

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
Route::get('/showlaporan', [LaporanController::class, 'show'])->name('show');

Route::group([
	'middleware' => 'auth',
	'prefix' => 'admin',
	'as' => 'admin.'
], function(){
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::get('/logs', [DashboardController::class, 'activity_logs'])->name('logs');
	Route::post('/logs/delete', [DashboardController::class, 'delete_logs'])->name('logs.delete');

    // Kategori Barang
    Route::get('/katbarang', [KatbarangController::class, 'index'])->name('katbarang');
	Route::get('/katbarang/create', [KatbarangController::class, 'create'])->name('katbarang.create');
	Route::post('/katbarang/create', [KatbarangController::class, 'store'])->name('katbarang.store');
	Route::get('/katbarang/{id}/edit', [KatbarangController::class, 'edit'])->name('katbarang.edit');
	Route::post('/katbarang/{id}/update', [KatbarangController::class, 'update'])->name('katbarang.update');
	Route::post('/katbarang/{id}/delete', [KatbarangController::class, 'destroy'])->name('katbarang.delete');

    // Barang
    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
	Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
	Route::post('/barang/create', [BarangController::class, 'store'])->name('barang.store');
	Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
	Route::post('/barang/{id}/update', [BarangController::class, 'update'])->name('barang.update');
	Route::post('/barang/{id}/delete', [BarangController::class, 'destroy'])->name('barang.delete');

    //Pembukuan
    Route::get('/pembukuan', [PembukuanController::class, 'index'])->name('pembukuan');
	Route::get('/pembukuan/create', [PembukuanController::class, 'create'])->name('pembukuan.create');
	Route::post('/pembukuan/create', [PembukuanController::class, 'store'])->name('pembukuan.store');
	Route::get('/pembukuan/{id}/edit', [PembukuanController::class, 'edit'])->name('pembukuan.edit');
	Route::post('/pembukuan/{id}/update', [PembukuanController::class, 'update'])->name('pembukuan.update');
	Route::post('/pembukuan/{id}/delete', [PembukuanController::class, 'destroy'])->name('pembukuan.delete');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
	Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
	Route::post('/laporan/create', [LaporanController::class, 'store'])->name('laporan.store');
	Route::get('/laporan/{id}/tampilan', [LaporanController::class, 'tampilan'])->name('laporan.tampilan');
	// Route::post('/laporan/{id}/update', [LaporanController::class, 'update'])->name('laporan.update');
	Route::post('/laporan/{id}/delete', [LaporanController::class, 'destroy'])->name('laporan.delete');

	// Settings menu
	Route::view('/settings', 'admin.settings')->name('settings');
	Route::post('/settings', [DashboardController::class, 'settings_store'])->name('settings');

	// Profile menu
	Route::view('/profile', 'admin.profile')->name('profile');
	Route::post('/profile', [DashboardController::class, 'profile_update'])->name('profile');
	Route::post('/profile/upload', [DashboardController::class, 'upload_avatar'])
		->name('profile.upload');

	// Member menu
	Route::get('/member', [UserController::class, 'index'])->name('member');
	Route::get('/member/create', [UserController::class, 'create'])->name('member.create');
	Route::post('/member/create', [UserController::class, 'store'])->name('member.create');
	Route::get('/member/{id}/edit', [UserController::class, 'edit'])->name('member.edit');
	Route::post('/member/{id}/update', [UserController::class, 'update'])->name('member.update');
	Route::post('/member/{id}/delete', [UserController::class, 'destroy'])->name('member.delete');

	// Roles menu
	Route::get('/roles', [RoleController::class, 'index'])->name('roles');
	Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
	Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.create');
	Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
	Route::post('/roles/{id}/update', [RoleController::class, 'update'])->name('roles.update');
	Route::post('/roles/{id}/delete', [RoleController::class, 'destroy'])->name('roles.delete');

});


require __DIR__.'/auth.php';
