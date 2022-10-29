<?php

    use Illuminate\Foundation\Application;
    use Illuminate\Support\Facades\Route;
    use Inertia\Inertia;
    use App\Http\Controllers\Super\DashboardController as SuperDashboardController;
    use App\Http\Controllers\Super\UserController;
    use App\Http\Controllers\Super\OfficeController;
    use App\Http\Controllers\Super\PoolController;
    use App\Http\Controllers\Admin\VehicleController;

    use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
    use App\Http\Controllers\Admin\ReservationController;
    use App\Http\Controllers\Admin\TripController;
    use App\Http\Controllers\Admin\MaintenanceController;

    use App\Http\Controllers\Head\DashboardController as HeadDashboardController;
    use App\Http\Controllers\Head\ApprovalController as HeadApprovalController;

    use App\Http\Controllers\Officer\DashboardController as OfficerDashboardController;
    use App\Http\Controllers\Officer\ApprovalController as OfficerApprovalController;

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
        return Inertia::render('Welcome', [
            'canLogin'       => Route::has('login'),
            'canRegister'    => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion'     => PHP_VERSION,
        ]);
    });

    Route::prefix('super')->middleware(['auth', 'verified', 'can:isSuper'])->group(function () {
        Route::get('', [SuperDashboardController::class, 'index']);

        Route::prefix('user')->group(function () {
            Route::get('', [UserController::class, 'index']);
            Route::get('create', [UserController::class, 'create']);
            Route::post('', [UserController::class, 'store']);
            Route::get('{id}', [UserController::class, 'show']);
            Route::get('{id}/edit', [UserController::class, 'edit']);
            Route::patch('{id}', [UserController::class, 'update']);
            Route::delete('{id}', [UserController::class, 'destroy']);
        });

        Route::prefix('office')->group(function () {
            Route::get('', [OfficeController::class, 'index']);
            Route::get('create', [OfficeController::class, 'create']);
            Route::post('', [OfficeController::class, 'store']);
            Route::get('{id}', [OfficeController::class, 'show']);
            Route::get('{id}/edit', [OfficeController::class, 'edit']);
            Route::patch('{id}', [OfficeController::class, 'update']);
            Route::delete('{id}', [OfficeController::class, 'destroy']);
        });

        Route::prefix('pool')->group(function () {
            Route::get('', [PoolController::class, 'index']);
            Route::get('create', [PoolController::class, 'create']);
            Route::post('', [PoolController::class, 'store']);
            Route::get('{id}', [PoolController::class, 'show']);
            Route::get('{id}/edit', [PoolController::class, 'edit']);
            Route::patch('{id}', [PoolController::class, 'update']);
            Route::delete('{id}', [PoolController::class, 'destroy']);
        });
    });

    Route::prefix('admin')->middleware(['auth', 'verified', 'can:isAdmin'])->group(function () {
        Route::get('', [AdminDashboardController::class, 'index']);
        Route::get('maintenance', [MaintenanceController::class, 'index']);

        Route::prefix('vehicle')->group(function () {
            Route::get('', [VehicleController::class, 'index']);
            Route::get('create', [VehicleController::class, 'create']);
            Route::post('', [VehicleController::class, 'store']);
            Route::get('{id}', [VehicleController::class, 'show']);
            Route::get('{id}/edit', [VehicleController::class, 'edit']);
            Route::patch('{id}', [VehicleController::class, 'update']);
            Route::delete('{id}', [VehicleController::class, 'destroy']);
        });

        Route::prefix('reservation')->group(function () {
            Route::get('', [ReservationController::class, 'index']);
            Route::get('export', [ReservationController::class, 'export']);
            Route::get('create', [ReservationController::class, 'create']);
            Route::post('', [ReservationController::class, 'store']);
            Route::get('{id}', [ReservationController::class, 'show']);
            Route::get('{id}/edit', [ReservationController::class, 'edit']);
            Route::patch('{id}', [ReservationController::class, 'update']);
            Route::delete('{id}', [ReservationController::class, 'destroy']);
        });

        Route::prefix('trip')->group(function () {
            Route::get('', [TripController::class, 'index']);
            Route::get('{id}/create', [TripController::class, 'create']);
            Route::post('', [TripController::class, 'store']);
            Route::get('{id}', [TripController::class, 'show']);
            Route::get('{id}/edit', [TripController::class, 'edit']);
            Route::patch('{id}', [TripController::class, 'update']);
            Route::delete('{id}', [TripController::class, 'destroy']);
        });
    });

    Route::prefix('head')->middleware(['auth', 'verified', 'can:isHead'])->group(function () {
        Route::get('', [HeadDashboardController::class, 'index']);

        Route::prefix('approval')->group(function () {
            Route::get('', [HeadApprovalController::class, 'index']);
            Route::get('{id}', [HeadApprovalController::class, 'show']);
            Route::patch('{id}/{action}', [HeadApprovalController::class, 'update']);
        });
    });

    Route::prefix('officer')->middleware(['auth', 'verified', 'can:isOfficer'])->group(function () {
        Route::get('', [OfficerDashboardController::class, 'index']);

        Route::prefix('approval')->group(function () {
            Route::get('', [OfficerApprovalController::class, 'index']);
            Route::get('{id}', [OfficerApprovalController::class, 'show']);
            Route::patch('{id}/{action}', [OfficerApprovalController::class, 'update']);
        });
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    require __DIR__ . '/auth.php';
