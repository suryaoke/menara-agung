
<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileAdminControllerr;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\StockController;
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


        //route store
        Route::resource('store', StoreController::class);

        // route supplier //

        Route::resource('supplier', SupplierController::class);


        // route category //

        Route::resource('category', CategoryController::class);


        // route product //

        Route::resource('product', ProductController::class);

        Route::controller(ProductController::class)->group(function () {
            Route::get('/barcode/product/{id}', 'BarcodeProduct')->name('barcode.product');
            Route::get('/import/product', 'ImportProduct')->name('import.product');
            Route::get('/export/product', 'ExportProduct')->name('export.product');
            Route::post('/import/file/product', 'ImportFileProduct')->name('import.file.product');

            Route::get('/export/template/product', 'ExportTemplateProduct')->name('export.template.product');
        });



        //route POS

        Route::controller(PosController::class)->group(function () {
            Route::get('/pos', 'Index')->name('pos');
            Route::post('/add-cart', 'AddCart')->name('add.pos.cart');
            Route::post('/update-cart/{rowId}', 'UpdateCart')->name('update.pos.cart');
            Route::delete('/delete-cart/{rowId}', 'DeleteCart')->name('delete.pos.cart');
            Route::get('/allitem', 'AllItem')->name('pos.all');

            Route::post('/add-invoice', 'AddInvoice')->name('add.invoice');
        });


        //route Order

        Route::controller(OrderController::class)->group(function () {
            Route::post('/final-invoice', 'FinalInvoice')->name('final.invoice');
            Route::get('/pending/order', 'PendingOrder')->name('pending.order');
            Route::get('/order/details/{order_id}', 'OrderDetails')->name('order.details');

            Route::post('/order/status/update', 'OrderStatusUpdate')->name('order.status.update');

            Route::get('/complete/order', 'CompleteOrder')->name('complete.order');


            Route::get('/invoice/pdf/{order_id}', 'PdfInvoice')->name('order.invoice.pdf');


            Route::get('/export/complete-order', 'exportComplete')->name('export.complete.order');
        });


        //route Stock

        Route::controller(StockController::class)->group(function () {

            Route::get('/stok', 'index')->name('stock');
            Route::post('/stok/add', 'AddStok')->name('add.stok');
            Route::get('/stok/detail/{id}', 'detail')->name('detail.stok');
            Route::get('/stok/export', 'ExportStok')->name('export.stok');
        });
    }
);


require __DIR__ . '/auth.php';
