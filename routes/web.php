<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MomentifyController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\AdminRoleManagementController;
use App\Http\Controllers\NormalUserRoleManagementController;
use App\Http\Controllers\EventManagerRoleManagementController;
use App\Http\Controllers\PhotographerRoleManagementController;

// Welcome Route with Events
Route::get('/', [MomentifyController::class, 'welcome'])->name('welcome');

// Dashboard Routes with Role-based Redirection
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->is_user == 1) {
            return redirect()->route('momentify.index');
        }
        return app(AdminDashboardController::class)->index();
    })->name('dashboard');

    // Admin Dashboard Routes
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard/stats', [AdminDashboardController::class, 'getStats'])->name('admin.dashboard.stats');
        Route::get('/admin/dashboard/logs', [AdminDashboardController::class, 'getLogs'])->name('admin.dashboard.logs');
        Route::get('/admin/dashboard/activity', [AdminDashboardController::class, 'getActivity'])->name('admin.dashboard.activity');
        Route::get('/admin/dashboard/filter-logs', [AdminDashboardController::class, 'filterLogs'])->name('admin.dashboard.filter-logs');
    });
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Configuration: Event Routes
Route::middleware('auth', 'adminManager')
    ->controller(EventController::class)
    ->prefix('configuration/event')
    ->name('eventconfig.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{event}/edit', 'edit')->name('edit');
        Route::put('/{event}', 'update')->name('update');
        Route::delete('/{event}', 'delete')->name('delete');
    });

// Event Details Routes
Route::middleware('auth')
    ->controller(EventDetailController::class)
    ->prefix('events')
    ->name('eventdetails.')
    ->group(function () {
        Route::get('/{event}', 'show')->name('show');
        Route::get('/{event}/image/{image}', 'showImage')->name('showImage')->where('image', '[0-9]+');
        Route::get('/{event}/image/{image}/download', 'downloadImage')->name('downloadImage')->where('image', '[0-9]+');
    });

Route::middleware('auth', 'adminManagerPhotographer')
    ->controller(EventDetailController::class)
    ->prefix('events')
    ->name('eventdetails.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/{event}/assign', 'assignPhotographer')->name('assign');
        Route::post('/{event}/photos', 'uploadPhotos')->name('upload');
        Route::delete('/{event}/photographers/{photographer}', 'removePhotographer')->name('removePhotographer');
        Route::get('/{event}/photos', 'getPhotos')->name('photos');
        Route::delete('/photos/{image}', 'deleteImage')->name('deleteImage');
    });

// Momentify Routes
Route::middleware('auth', 'adminUser')
    ->controller(MomentifyController::class)
    ->prefix('momentify')
    ->name('momentify.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/search', 'search')->name('search');
    });

// Role Management Routes
Route::middleware('auth', 'admin')
    ->prefix('user-role-managements')
    ->name('role.management.')
    ->group(function () {
        // Admin Routes
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [AdminRoleManagementController::class, 'index'])->name('index');
            Route::get('/create', [AdminRoleManagementController::class, 'create'])->name('create');
            Route::post('/store', [AdminRoleManagementController::class, 'store'])->name('store');
            Route::delete('/{id}', [AdminRoleManagementController::class, 'destroy'])->name('destroy');
        });

        // Event Manager Routes
        Route::prefix('event-manager')->name('event.manager.')->group(function () {
            Route::get('/', [EventManagerRoleManagementController::class, 'index'])->name('index');
            Route::get('/create', [EventManagerRoleManagementController::class, 'create'])->name('create');
            Route::post('/store', [EventManagerRoleManagementController::class, 'store'])->name('store');
            Route::delete('/{id}', [EventManagerRoleManagementController::class, 'destroy'])->name('destroy');
        });

        // Photographer Routes
        Route::prefix('photographer')->name('photographer.')->group(function () {
            Route::get('/', [PhotographerRoleManagementController::class, 'index'])->name('index');
            Route::get('/create', [PhotographerRoleManagementController::class, 'create'])->name('create');
            Route::post('/store', [PhotographerRoleManagementController::class, 'store'])->name('store');
            Route::delete('/{id}', [PhotographerRoleManagementController::class, 'destroy'])->name('destroy');
        });

        // Normal User Routes
        Route::prefix('normal-user')->name('normal.user.')->group(function () {
            Route::get('/', [NormalUserRoleManagementController::class, 'index'])->name('index');
            Route::get('/create', [NormalUserRoleManagementController::class, 'create'])->name('create');
            Route::post('/store', [NormalUserRoleManagementController::class, 'store'])->name('store');
            Route::delete('/{id}', [NormalUserRoleManagementController::class, 'destroy'])->name('destroy');
        });
    });

require __DIR__ . '/auth.php';
