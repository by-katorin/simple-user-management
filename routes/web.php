<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RemoveRoleFromUserController;
use App\Http\Controllers\RevokePermissionFromRoleController;
use App\Http\Controllers\RevokePermissionFromUserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::group(["prefix" => "/users"], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index'); // list all users

        Route::get('/{user}/show', [UserController::class, 'show'])->name('users.show'); // show user

        Route::get('/create', [UserController::class, 'create'])->name('users.create'); // create user form
        Route::post('/', [UserController::class, 'store'])->name('users.store'); // store user

        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // edit user form
        Route::post('/{user}/update', [UserController::class, 'update'])->name('users.update'); // update user

        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // delete user
        
        // Soft-deleted users
        Route::get('/trashed', [UserController::class, 'trashed'])->name('users.trashed'); // list all deleted users
        Route::patch('/{user}/restore', [UserController::class, 'restore'])->name('users.restore'); // recreate user
        Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('users.delete'); // force-delete user
    });

    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

    Route::delete('/roles/{role}/permissions/{permission}', RevokePermissionFromRoleController::class)
        ->name('roles.permissions.destroy');

    Route::delete('/users/{user}/permissions/{permission}', RevokePermissionFromUserController::class)
        ->name('users.permissions.destroy');

    Route::delete('/users/{user}/roles/{role}', RemoveRoleFromUserController::class)
        ->name('users.roles.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
