<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventDetailController;
use App\Http\Controllers\AdminRoleManagementController;
use App\Http\Controllers\NormalUserRoleManagementController;
use App\Http\Controllers\EventManagerRoleManagementController;
use App\Http\Controllers\PhotographerRoleManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 // Configuration: Event Routes
Route::controller(EventController::class)
    ->prefix('configuration/event')
    ->name('eventconfig.')
    ->group(function () {
        Route::get('/', 'index')->name('index');  // List events
        Route::get('/create', 'create')->name('create');  // Event creation form
        Route::post('/', 'store')->name('store');  // Store new event
        Route::get('/{event}/edit', 'edit')->name('edit');  // Edit event form
        Route::put('/{event}', 'update')->name('update');  // Update event
        Route::delete('/{event}', 'delete')->name('delete');  // Delete event
    });

Route::controller(EventDetailController::class)
    ->prefix('events')
    ->name('eventdetails.')
    ->group(function () {
        Route::get('/', 'index')->name('index');  // List all event details
        Route::get('/{event}', 'show')->name('show');  // Show event details
        Route::post('/{event}/assign', 'assignPhotographer')->name('assign');  // Assign photographer
        Route::post('/{event}/upload', 'uploadPhotos')->name('upload');  // Assign photographer

        // Remove photographer route
        Route::delete('/{event}/remove-photographer/{photographer}', 'removePhotographer')->name('removePhotographer');  // Remove photographer
    });


// Role management routes
Route::middleware('auth', 'admin')->prefix('user-role-managements/')->name('role.management.')->group(function () {
    // For admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminRoleManagementController::class, 'index'])->name('index');
        Route::get('/create', [AdminRoleManagementController::class, 'create'])->name('create');
        Route::post('/store', [AdminRoleManagementController::class, 'store'])->name('store');
        Route::delete('/{id}', [AdminRoleManagementController::class, 'destroy'])->name('destroy');
    });

    // For event manager
    Route::prefix('event-manager')->name('event.manager.')->group(function () {
        Route::get('/', [EventManagerRoleManagementController::class, 'index'])->name('index');
        Route::get('/create', [EventManagerRoleManagementController::class, 'create'])->name('create');
        Route::post('/store', [EventManagerRoleManagementController::class, 'store'])->name('store');
        Route::delete('/{id}', [EventManagerRoleManagementController::class, 'destroy'])->name('destroy');
    });

    // For photographer
    Route::prefix('photographer')->name('photographer.')->group(function () {
        Route::get('/', [PhotographerRoleManagementController::class, 'index'])->name('index');
        Route::get('/create', [PhotographerRoleManagementController::class, 'create'])->name('create');
        Route::post('/store', [PhotographerRoleManagementController::class, 'store'])->name('store');
        Route::delete('/{id}', [PhotographerRoleManagementController::class, 'destroy'])->name('destroy');
    });

    // For normal user
    Route::prefix('normal-user')->name('normal.user.')->group(function () {
        Route::get('/', [NormalUserRoleManagementController::class, 'index'])->name('index');
        Route::get('/create', [NormalUserRoleManagementController::class, 'create'])->name('create');
        Route::post('/store', [NormalUserRoleManagementController::class, 'store'])->name('store');
        Route::delete('/{id}', [NormalUserRoleManagementController::class, 'destroy'])->name('destroy');
    });
});


// useless routes
// Just to demo sidebar dropdown links active states.
// Route::get('/buttons/text', function () {
//     return view('buttons-showcase.text');
// })->middleware(['auth'])->name('buttons.text');

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
