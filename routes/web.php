<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\BoxCutController;
use App\Http\Controllers\OutlayController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;

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
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified',])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pos',[PosController::class, 'index'])->name('pos');
    Route::resource('category', CategoryController::class);
    Route::resource('printer', PrinterController::class);
    Route::resource('product', ProductController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('outlay', OutlayController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('boxcut', BoxCutController::class);
    Route::resource('shopping', ShoppingController::class);
    Route::resource('ticket', TicketSetupController::class);
    Route::post('boxcut-resume', [BoxCutController::class, 'resume'])->name('boxcut.resume');
    Route::post('/product/search',[ProductController::class, 'search'])->name('product.search');
    Route::get('/pos-search',[PosController::class, 'search'])->name('search');
    Route::get('/ticket-print/{id}',[PosController::class, 'ticket_print'])->name('ticket.print');
    Route::get('/tickets',[PosController::class, 'tickets'])->name('tickets');
    Route::get('/test',[PosController::class, 'test']);


        //administracion
        Route::resource('/roles', RolesController::class);
        Route::resource('/users', UsersController::class);

});
