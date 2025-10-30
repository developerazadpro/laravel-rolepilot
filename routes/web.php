<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (auth required)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
});

/*
|-------------------------------------------------------------------------------------------------------------
| Permission-based Protected Routes
|-------------------------------------------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Roles Management — users who can "manage roles"
    Route::middleware('permission:manage roles')->group(function () {
        Route::resource('roles', RoleController::class)->names('roles');
    });

    // Users Management — users who can "manage users"
    Route::middleware('permission:manage users')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit-role', [UserController::class, 'editRole'])->name('users.editRole');
        Route::put('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
        Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');

    });

    // Permissions Management — requires "manage permissions" permission
    Route::middleware('permission:manage permissions')->group(function () {
        Route::resource('permissions', PermissionController::class)
            ->only(['index', 'create', 'store', 'destroy'])
            ->names('permissions');
    });
});

require __DIR__.'/auth.php';
