<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PembobotanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\Perhitungan\SawController;
use App\Http\Controllers\Perhitungan\TopsisController;
use App\Http\Controllers\Pesan\FeedbackStore;
use App\Http\Controllers\Pesan\FeedbackUser;
use App\Http\Controllers\profile\ProfileAdmin;
use App\Http\Controllers\profile\UpdateProfile;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\SimpanProfile;
use App\Http\Controllers\website\UpdateWebsite;
use App\Http\Controllers\website\WebsiteShow;
use App\Models\Karakter;

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/karakter', [UserController::class, 'karakter'])->name('karakter');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/public/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');

Route::middleware(['web'])->group(function () {
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
    Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);
});

Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verification.verify');

Route::get('/forgot-password', [PasswordController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [PasswordController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}/{email}', [PasswordController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act/{email}', [PasswordController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-proses', [RegisterController::class, 'register'])->name('register-proses');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/admin/kriteria', [KriteriaController::class, 'index'])->name('admin.kriteria');
        Route::post('/admin/kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
        Route::put('/admin/kriteria/update/{column}', [KriteriaController::class, 'update'])->name('kriteria.update');
        Route::delete('/admin/kriteria/delete/{column}', [KriteriaController::class, 'delete'])->name('kriteria.delete');

        Route::get('/admin/alternatif', [AlternatifController::class, 'alternatif'])->name('admin.alternatif');
        Route::post('/admin/alternatif/store', [AlternatifController::class, 'store'])->name('alternatif.store');
        Route::put('/admin/alternatif/update/{karakter}', [AlternatifController::class, 'update'])->name('alternatif.update');
        Route::delete('/admin/alternatif/delete/{karakter}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

        Route::get('/admin/penilaian', [PenilaianController::class, 'index'])->name('admin.penilaian');
        Route::post('/admin/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
        Route::put('/admin/penilaian/update/{nilai}', [PenilaianController::class, 'update'])->name('penilaian.update');
        Route::delete('/admin/penilaian/delete/{nilai}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');

        Route::get('/admin/pembobotan', [PembobotanController::class, 'index'])->name('admin.pembobotan');
        Route::post('/admin/pembobotan/store', [PembobotanController::class, 'store'])->name('pembobotan.store');
        Route::put('/admin/pembobotan/update/{bobot}', [PembobotanController::class, 'update'])->name('pembobotan.update');
        Route::delete('/admin/pembobotan/delete/{bobot}', [PembobotanController::class, 'destroy'])->name('pembobotan.destroy');

        Route::get('/admin/akun', [AdminController::class, 'userAll'])->name('admin.akun');
        Route::post('/admin/akun', [AdminController::class, 'store'])->name('akun.store');
        Route::put('/kriteria/update/{id}', [AdminController::class, 'update'])->name('akun.update');
        Route::delete('/kriteria/delete/{id}', [AdminController::class, 'destroy'])->name('akun.delete');

        Route::get('/admin/profile', [ProfileAdmin::class, 'index'])->name('admin.profile');
        Route::put('/admin/profile', [UpdateProfile::class, 'updateProfile'])->name('profile.update');

        Route::get('/admin/website-setting', [WebsiteShow::class, 'show'])->name('admin.website');
        Route::put('/admin/website-setting/update', [UpdateWebsite::class, 'update'])->name('website.update');
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('/user/home', [UserController::class, 'home'])->name('user.home');
        Route::get('/user/karakter', [UserController::class, 'karakter'])->name('user.karakter');
        Route::get('/user/rekomendasi', [RekomendasiController::class, 'rekomendasi'])->name('user.rekomendasi');
        Route::post('/user/rekomendasi/add', [RekomendasiController::class, 'addCharacter'])->name('user.addCharacter');
        Route::delete('/user/rekomendasi/delete/{characterId}', [RekomendasiController::class, 'deleteCharacter'])->name('user.deleteCharacter');
        Route::post('/user/bobot/add-data', [RekomendasiController::class, 'addData'])->name('user.addData');
        Route::get('/user/perhitungan-topsis', [TopsisController::class, 'HitungTopsis'])->name('user.hitungTopsis');
        Route::get('/user/perhitungan-saw', [SawController::class, 'HitungSAW'])->name('user.hitungSAW');
        Route::get('/user/feedback', [FeedbackUser::class, 'show'])->name('user.feedback');
        Route::post('/user/feedback/store', [FeedbackStore::class, 'store'])->name('feedback.store');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [SimpanProfile::class, 'update'])->name('profile.update');
    });
});
