<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

// LOGIN PAGE
Route::middleware('guest')->group(function () {

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (Request $request) {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');

    })->name('login.submit');

});

Route::middleware('guest')->get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Guest routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [
        AuthenticatedSessionController::class,
        'create'
    ])->name('login');

    Route::post('/login', [
        AuthenticatedSessionController::class,
        'store'
    ])->middleware('throttle:5,1')->name('login.submit');

});

// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::post('/logout', [
        AuthenticatedSessionController::class,
        'destroy'
    ])->name('logout');

    // Temporary administrator dashboard entry point.
    Route::get('/admin/dashboard', function () {
        abort_unless(
            auth()->user()->hasRole('administrator'),
            403
        );

        return view('admin.dashboard');

    })->name('admin.dashboard');

});