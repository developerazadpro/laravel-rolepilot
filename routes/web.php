<?php

use App\Http\Controllers\MenuController;
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
})->middleware(['auth', 'verified', 'permission:view dashboard'])->name('dashboard');

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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Users Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])
            ->name('index')
            ->middleware('permission:view users');

        Route::get('/create', [UserController::class, 'create'])
            ->name('create')
            ->middleware('permission:create users');

        Route::post('/store', [UserController::class, 'store'])
            ->name('store')
            ->middleware('permission:create users');

        Route::get('/{id}/edit-role', [UserController::class, 'editRole'])
            ->name('editRole')
            ->middleware('permission:edit users');

        Route::put('/{id}/update-role', [UserController::class, 'updateRole'])
            ->name('updateRole')
            ->middleware('permission:edit users');

        Route::delete('/{user}/destroy', [UserController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete users');

        Route::put('/{user}/toggle-active', [UserController::class, 'toggleActive'])
            ->name('toggleActive')
            ->middleware('permission:edit users');
    });


    /*
    |--------------------------------------------------------------------------
    | Roles Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])
            ->name('index')
            ->middleware('permission:view roles');

        Route::get('/create', [RoleController::class, 'create'])
            ->name('create')
            ->middleware('permission:create roles');

        Route::post('/', [RoleController::class, 'store'])
            ->name('store')
            ->middleware('permission:create roles');

        Route::get('/{role}/edit', [RoleController::class, 'edit'])
            ->name('edit')
            ->middleware('permission:edit roles');

        Route::put('/{role}', [RoleController::class, 'update'])
            ->name('update')
            ->middleware('permission:edit roles');

        Route::delete('/{role}', [RoleController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete roles');
    });


    /*
    |--------------------------------------------------------------------------
    | Permissions Management
    |--------------------------------------------------------------------------
    */
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])
            ->name('index')
            ->middleware('permission:view permissions');

        Route::get('/create', [PermissionController::class, 'create'])
            ->name('create')
            ->middleware('permission:create permissions');

        Route::post('/', [PermissionController::class, 'store'])
            ->name('store')
            ->middleware('permission:create permissions');

        Route::delete('/{permission}', [PermissionController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete permissions');
    });


    /*
    |--------------------------------------------------------------------------
    | Menu Management
    |--------------------------------------------------------------------------
    */
    //Route::resource('menus', MenuController::class);
    Route::prefix('menus')->name('menus.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])
            ->name('index')
            ->middleware('permission:view menus');

        Route::get('/create', [MenuController::class, 'create'])
            ->name('create')
            ->middleware('permission:create menus');

        Route::post('/', [MenuController::class, 'store'])
            ->name('store')
            ->middleware('permission:create menus');

        Route::get('/{menu}/edit', [MenuController::class, 'edit'])
            ->name('edit')
            ->middleware('permission:edit menus');

        Route::put('/{menu}', [MenuController::class, 'update'])
            ->name('update')
            ->middleware('permission:edit menus');

        Route::delete('/{menu}', [MenuController::class, 'destroy'])
            ->name('destroy')
            ->middleware('permission:delete menus');
    });
});

require __DIR__.'/auth.php';
