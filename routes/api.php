<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DeviceTokenController;
use App\Http\Controllers\Api\Driver\TripController as DriverTripController;
use App\Http\Controllers\Api\Guardian\TripController as GuardianTripController;
<<<<<<< HEAD
use App\Http\Controllers\Api\TransportController;
=======
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['api' => 'ok', 'version' => 'v1'];
});

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::post('/device-tokens', [DeviceTokenController::class, 'store']);
        Route::delete('/device-tokens', [DeviceTokenController::class, 'destroy']);

<<<<<<< HEAD
        // General transport discovery endpoints
        Route::get('/vehicles', [TransportController::class, 'vehicles']);
        Route::get('/drivers', [TransportController::class, 'drivers']);
        Route::get('/schools', [TransportController::class, 'schools']);

=======
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
        Route::prefix('driver')->middleware('api.role:driver')->group(function () {
            Route::get('/trips', [DriverTripController::class, 'index']);
            Route::get('/trips/{trip}', [DriverTripController::class, 'show']);
            Route::post('/trips/{trip}/start-pickup', [DriverTripController::class, 'startPickup']);
            Route::post('/trips/{trip}/arrive', [DriverTripController::class, 'arrive']);
            Route::post('/trips/{trip}/board', [DriverTripController::class, 'board']);
            Route::post('/trips/{trip}/complete', [DriverTripController::class, 'complete']);
            Route::post('/trips/{trip}/locations', [DriverTripController::class, 'storeLocation']);
        });

        Route::prefix('guardian')->middleware('api.role:guardian|parent')->group(function () {
            Route::get('/students', [GuardianTripController::class, 'students']);
<<<<<<< HEAD
            Route::post('/students', [GuardianTripController::class, 'storeStudent']);
            Route::post('/assign-driver', [GuardianTripController::class, 'assignDriver']);
=======
>>>>>>> bf416999db8681b6a737b848a02d55a444493b4d
            Route::get('/students/{student}/active-trip', [GuardianTripController::class, 'activeTrip']);
            Route::get('/trips/{trip}', [GuardianTripController::class, 'show']);
            Route::get('/trips/{trip}/realtime', [GuardianTripController::class, 'realtime']);
            Route::get('/trips/{trip}/locations', [GuardianTripController::class, 'locations']);
        });
    });
});
