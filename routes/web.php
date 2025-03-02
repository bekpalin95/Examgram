<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', ['users' => \App\Models\User::all()]);
});

Auth::routes();

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');

Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);

Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);

Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);

Route::get('/home', function() {
    return redirect('/');
});