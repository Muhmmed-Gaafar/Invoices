<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductsController;

use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::resource([
    '/sections', SectionsController::class,
    '/products', ProductsController::class,
    'invoiceAttachments', InvoiceAttachmentsController::class,
    'archive', InvoiceAchiveController::class,
    '/branch', BranchController::class,
]);

//Route::get('/branch', [BranchController::class , 'index'])->name('branches.index');
//Route::POST('/branch', [BranchController::class , 'store'])->name('branches.store');
//Route::PATCH('/branch/{id}', [BranchController::class , 'update'])->name('branches.update');
//Route::DELETE('/branch/{branch}', [BranchController::class , 'destroy'])->name('branches.destroy');

Route::prefix('branch')->name('branches.')->group(function () {
    Route::get('/', [BranchController::class, 'index'])->name('index');
    Route::post('/', [BranchController::class, 'store'])->name('store');
    Route::patch('/{id}', [BranchController::class, 'update'])->name('update');
    Route::delete('/{branch}', [BranchController::class, 'destroy'])->name('destroy');
});


    //Route::resource('invoicesDetails', InvoicesDetailsController::class);
    //Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'show'])->name('invoicesDetails.show');
    //Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'edit'])->name('invoicesDetails.edit');
    //Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file'])->name('invoicesDetails.get_file');
    //Route::get('view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file'])->name('invoicesDetails.open_file');
    //Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

Route::group(['prefix' => 'invoicesDetails'], function() {
    Route::resource('/', InvoicesDetailsController::class)->names([
        'index' => 'invoicesDetails.index',
        'create' => 'invoicesDetails.create',
        'store' => 'invoicesDetails.store',
        'show' => 'invoicesDetails.show',
        'edit' => 'invoicesDetails.edit',
        'update' => 'invoicesDetails.update',
        'destroy' => 'invoicesDetails.destroy',
    ]);
    Route::get('/{id}', [InvoicesDetailsController::class, 'show'])->name('invoicesDetails.show');
    Route::get('/{id}/edit', [InvoicesDetailsController::class, 'edit'])->name('invoicesDetails.edit');
    Route::get('/download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file'])->name('invoicesDetails.get_file');
    Route::get('/view_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file'])->name('invoicesDetails.open_file');
    Route::post('/delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');
});

Route::resource('invoices', InvoicesController::class);
Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
Route::get('/invoices/{id}', [InvoicesController::class, 'show'])->name('invoices.show');
Route::get('/edit_invoice/{id}', [InvoicesController::class, 'edit']);
Route::post('/status_update/{id}', [InvoicesController::class, 'Status_Update'])->name('Status_Update');
Route::get('/status_show/{id}', [InvoicesController::class, 'show'])->name('Status_show');
Route::get('invoice_paid', [InvoicesController::class, 'Invoice_Paid'])->name('Invoice_Paid');
Route::get('invoice_unpaid', [InvoicesController::class, 'Invoice_UnPaid'])->name('Invoice_UnPaid');
Route::get('invoice_partial', [InvoicesController::class, 'Invoice_Partial'])->name('Invoice_Partial');
Route::get('print_invoice/{id}', [InvoicesController::class, 'Print_invoice']);
Route::get('export_invoices', [InvoicesController::class, 'export']);

Route::get('invoices_report', [Invoices_Report::class, 'index']);
Route::post('search_invoices', [Invoices_Report::class, 'Search_invoices']);
Route::get('customers_report', [Customers_Report::class, 'index'])->name('customers_report');
Route::post('search_customers', [Customers_Report::class, 'Search_customers']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/markAllAsRead', [NotificationController::class, 'markAllAsRead'])->name('markAllAsRead');
    Route::get('/all-notifications', [NotificationController::class, 'allNotifications'])->name('all-notifications');
});

require __DIR__.'/auth.php';





//
//Route::middleware(['auth'])->group(function () {
//    Route::resource('roles', RoleController::class);
//    Route::resource('users', UserController::class);
//});
//

//
//Route::get('markAsRead_all', [InvoicesController::class, 'MarkAsRead_all'])->name('markAsRead_all');
//Route::get('unreadNotifications_count', [InvoicesController::class, 'unreadNotifications_count'])->name('unreadNotifications_count');
//Route::get('unreadNotifications', [InvoicesController::class, 'unreadNotifications'])->name('unreadNotifications');
//
//Route::get('/{page}', [AdminController::class, 'index']);
