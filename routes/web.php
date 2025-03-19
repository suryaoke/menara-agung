
<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileAdminControllerr;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



// route admin //

Route::group(
    [
        "middleware" => "auth",
        "verified",
        "role:admin",
        "prefix" => "admin",
        "as" => "admin."
    ],
    function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/pofile', [ProfileAdminControllerr::class, 'profile'])->name('profile');

        Route::patch('/profile', [ProfileAdminControllerr::class, 'update'])->name('profile.update');

        Route::post('/profile/image', [ProfileAdminControllerr::class, 'storeImage'])->name('profile.store.image');

        Route::delete('/profile/delete', [ProfileAdminControllerr::class, 'destroy'])->name('profile.delete');

        Route::get('/password', [ProfileAdminControllerr::class, 'password'])->name('password');



        // route supplier //

        Route::resource('supplier', SupplierController::class);


        // route category //

        Route::resource('category', CategoryController::class);
    }
);


require __DIR__ . '/auth.php';
