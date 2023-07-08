<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'is_active'])->name('dashboard');

Route::middleware(['auth', 'is_active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', function () {
        return view('users');
    })->name('users')->middleware('can:view users');

    Route::get('/categories', function () {
        return view('categories');
    })->name('categories')->middleware('can:view categories');

    Route::get('/tasks', function () {
        return view('tasks');
    })->name('tasks')->middleware('can:view tasks');

    Route::get('/submissions', function () {
        return view('submissions');
    })->name('submissions')->middleware('can:view submission');

    Route::get('/submissions/form/{id}/starter', function ($id) {
        return view('form', [
            'id' => $id,
        ]);
    })->name('start-form')->middleware('can:start form');

    Route::get('/tasks/{id}/questions', function ($id) {
        return view('task-questions', [
            'id' => $id,
        ]);
    })->name('task-questions')->middleware('can:view company questions');

    Route::get('/roles', function () {
        return view('roles');
    })->name('roles')->middleware('can:view roles');

    Route::get('/billings', function () {
        return view('billings');
    })->name('billings')->middleware('can:view billings');

    Route::get('/roles/{id}/permissions', function ($id) {
        return view('role-permissions', [
            'id' => $id,
        ]);
    })->name('role-permissions')->middleware('can:manage role permissions');

    Route::get('/companies', function () {
        return view('companies');
    })->name('companies')->middleware('can:view companies');

    Route::get('/account-setting', function (Request $request) {
        return view('account-setting', [
            'user' => $request->user(),
        ]);
    })->name('account-setting');

    Route::get('/companies/{id}/settings', function ($id) {
        return view('company-settings', [
            'id' => $id,
        ]);
    })->name('company-settings')->middleware('can:edit company setting');

    Route::get('/companies/{id}/segments', function ($id) {
        return view('company-segments', [
            'id' => $id,
        ]);
    })->name('company-segments')->middleware('can:edit company setting');

});

require __DIR__.'/auth.php';
