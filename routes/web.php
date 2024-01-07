<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchStaffController;
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
            Route::get('/create', [BranchController::class, 'create'])->name('.create');
            Route::post('/create', [BranchController::class, 'store'])->name('.store');
            Route::get('/{id}', [BranchController::class, 'edit'])->name('.edit');
            Route::patch('/{id}', [BranchController::class, 'update'])->name('.update');
        }
    );
    
    Route::prefix('/staff')
        ->name('staff')
        ->group(function(){
            Route::get('/', [StaffController::class, 'index']);
            Route::get('/create', [StaffController::class, 'create'])->name('.create');
            Route::post('/', [StaffController::class, 'store'])->name('.store');
            Route::get('/{id}', [StaffController::class, 'edit'])->name('.edit');
            Route::patch('/{id}', [StaffController::class, 'update'])->name('.update');
            Route::delete('/{id}', [StaffController::class, 'destroy'])->name('.delete');
        }
    );
});
Route::group(['middleware' => ['role:manager']], function () {
    Route::prefix('/branchstaff')
        ->name('branchstaff')
        ->group(function(){
            Route::get('/', [BranchStaffController::class, 'index']);
            Route::get('/{id}', [BranchStaffController::class, 'branch'])->name('.branch');
            Route::get('/staff/{id}', [BranchStaffController::class, 'edit'])->name('.edit');
            Route::patch('/staff/{id}', [BranchStaffController::class, 'update'])->name('.update');
            Route::get('/{id}/create', [BranchStaffController::class, 'create'])->name('.create');
            Route::post('/', [BranchStaffController::class, 'store'])->name('.store');
            Route::post('/{id}', [BranchStaffController::class, 'assign'])->name('.assign');
            Route::delete('/{id}', [BranchStaffController::class, 'remove'])->name('.remove');
        }
    );
});
Route::group(['middleware' => ['role:warehouse-staff|supervisor']], function () {
    Route::prefix('/warehouse')
        ->name('warehouse')
        ->group(function(){
            Route::get('/', [WarehouseController::class, 'index']);
            Route::get('/item', [WarehouseController::class, 'create'])->name('.item.create');
            Route::post('/item', [WarehouseController::class, 'store'])->name('.item.store');
            Route::get('/item/{id}', [WarehouseController::class, 'edit'])->name('.item.edit');
            Route::patch('/item/{id}', [WarehouseController::class, 'update'])->name('.item.update');
            Route::get('/transaction', [WarehouseController::class, 'transactionIndex'])->name('.transaction');
            Route::post('/transaction', [WarehouseController::class, 'transactionStore'])->name('.transaction.store');
        }
    );
});
Route::group(['middleware' => ['role:cashier']], function () {
    Route::prefix('/transaction')
        ->name('transaction')
        ->group(function(){
            Route::get('/', [TransactionController::class, 'index']);
            Route::post('/', [TransactionController::class, 'store'])->name('.store');
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
});


require __DIR__.'/auth.php';
