<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public contact endpoint used by the coming soon page
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::middleware('guest')->group(function () {
    Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index'); // Render login page here
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login'); // Login form
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post'); // Post login request
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/dashboard/chart-data', [\App\Http\Controllers\Admin\DashboardController::class, 'getChartData'])->name('admin.dashboard.chart-data');
        Route::prefix('category')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category');
            Route::get('/list', [\App\Http\Controllers\Admin\CategoryController::class, 'list'])->name('admin.category.list');
            Route::post('/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('/update',  [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
            Route::delete('/categories/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
            Route::post('/change-status', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleStatus'])->name('categories.change-status');
            Route::post('/change-visibility', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleVisibilityStatus'])->name('categories.change-visibility');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class,  'edit'])->name('categories.edit');
        });
        Route::resource('guardians', App\Http\Controllers\Admin\GuardianController::class)->names('admin.guardians');
        Route::resource('students', App\Http\Controllers\Admin\StudentController::class)->names('admin.students');
        Route::post('students/bulk-delete', [App\Http\Controllers\Admin\StudentController::class, 'bulkDelete'])->name('admin.students.bulk-delete');
        Route::post('students/export', [App\Http\Controllers\Admin\StudentController::class, 'export'])->name('admin.students.export');
        
        // Trip Management
        Route::resource('trips', App\Http\Controllers\Admin\TripController::class)->names('admin.trips');
        Route::post('trips/{trip}/start', [App\Http\Controllers\Admin\TripController::class, 'start'])->name('admin.trips.start');
        Route::post('trips/{trip}/complete', [App\Http\Controllers\Admin\TripController::class, 'complete'])->name('admin.trips.complete');
        Route::post('trips/{trip}/location', [App\Http\Controllers\Admin\TripController::class, 'addLocation'])->name('admin.trips.location');
        Route::get('trips/{trip}/track', [App\Http\Controllers\Admin\TripController::class, 'track'])->name('admin.trips.track');
        Route::get('trips/{trip}/locations', [App\Http\Controllers\Admin\TripController::class, 'getLocations'])->name('admin.trips.locations');
        
        // Vehicle Management
        Route::resource('vehicles', App\Http\Controllers\Admin\VehicleController::class)->names('admin.vehicles');
        
        // Route Management
        Route::resource('routes', App\Http\Controllers\Admin\RouteController::class)->names('admin.routes');
        
        // Driver Management
        Route::resource('drivers', App\Http\Controllers\Admin\DriverController::class)->names('admin.drivers');
        
        // School Management
        Route::resource('school', App\Http\Controllers\Admin\SchoolController::class)->names('admin.school');
    });
});

// Guardian Dashboard and Tracking Routes
Route::middleware(['auth', 'role:guardian'])->group(function () {
    Route::get('/guardian/dashboard', [App\Http\Controllers\GuardianDashboardController::class, 'index'])->name('guardian.dashboard');
    
    Route::prefix('guardian')->group(function () {
        Route::get('/tracking', [App\Http\Controllers\GuardianTrackingController::class, 'index'])->name('guardian.tracking.index');
        Route::get('/students/{student}/trips', [App\Http\Controllers\GuardianTrackingController::class, 'getStudentTrips'])->name('guardian.students.trips');
        Route::get('/students/{student}/active-trip', [App\Http\Controllers\GuardianTrackingController::class, 'getActiveTrip'])->name('guardian.students.active-trip');
        Route::get('/trips/{trip}/locations', [App\Http\Controllers\GuardianTrackingController::class, 'getTripLocations'])->name('guardian.trips.locations');
        Route::get('/trips/{trip}/realtime', [App\Http\Controllers\GuardianTrackingController::class, 'getRealTimeLocation'])->name('guardian.trips.realtime');
        Route::get('/trips/{trip}/map', [App\Http\Controllers\GuardianTrackingController::class, 'trackMap'])->name('guardian.trips.map');
    });
});
