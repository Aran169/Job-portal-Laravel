<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Public Job Listings
Route::get('/', [JobController::class, 'index'])->name('jobs.index');
Route::get('jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// Apply for Jobs
Route::get('/jobs/{id}/apply', [JobController::class, 'apply'])->name('jobs.apply'); // Show application form
Route::post('/jobs/{id}/apply', [JobController::class, 'submitApplication'])->name('jobs.submitApplication'); // Handle form submission

// Admin Routes - Applying auth and admin middleware for protection
    Route::get('/admin', [AdminController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/admin/jobs/create', [AdminController::class, 'create'])->name('admin.jobs.create');
    Route::post('/admin/jobs', [AdminController::class, 'store'])->name('admin.jobs.store');
// Admin Routes for Job Management
Route::get('/admin/jobs/{id}/edit', [AdminController::class, 'edit'])->name('admin.jobs.edit')->middleware('auth'); // Edit job form
Route::put('/admin/jobs/{id}', [AdminController::class, 'update'])->name('admin.jobs.update')->middleware('auth'); // Update job
Route::delete('/admin/jobs/{id}', [AdminController::class, 'destroy'])->name('admin.jobs.destroy')->middleware('auth'); // Delete job
Route::get('/search', [JobController::class, 'search'])->name('jobs.search');

Route::middleware('auth')->group(function () {
    Route::get('applied-jobs', [JobController::class, 'showAppliedJobs'])->name('appliedJobs');
});