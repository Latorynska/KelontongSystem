<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WarehouseController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/brand', [BrandController::class, 'index'])->name('brand');
Route::group(['middleware' => ['role:owner']], function () {
    Route::prefix('/brand')
        ->name('brand')
        ->group(function(){
            Route::get('/', [BrandController::class, 'index']);
        }
    );
    
    Route::prefix('/branch')
        ->name('branch')
        ->group(function(){
            Route::get('/', [BranchController::class, 'index']);
        }
    );
});


Route::group(['middleware' => ['role:admin']], function () {
    Route::prefix('/user')
        ->name('user')
        ->group(function(){
            Route::get('/', [UserController::class, 'index']);
        }
    );
    
    Route::get('/admin/brand', [BrandController::class, 'admin'])->name('brand.admin');
    // Route::prefix('/branch')
    //     ->name('branch')
    //     ->group(function(){
    //         Route::get('/', [BranchController::class, 'index']);
    //     }
    // );
    Route::prefix('/item')
        ->name('item')
        ->group(function(){
            Route::get('/', [ItemController::class, 'index']);
        }
    );
    Route::prefix('/staff')
        ->name('staff')
        ->group(function(){
            Route::get('/', [StaffController::class, 'index']);
        }
    );
    Route::prefix('/transaction')
        ->name('transaction')
        ->group(function(){
            Route::get('/', [TransactionController::class, 'index']);
        }
    );
    Route::prefix('/warehouse')
        ->name('warehouse')
        ->group(function(){
            Route::get('/', [WarehouseController::class, 'index']);
        }
    );
});


require __DIR__.'/auth.php';
