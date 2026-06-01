<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/verify-otp', [AuthController::class, 'showOTP'])->name('otp.show');
Route::post('/verify-otp', [AuthController::class, 'verifyOTP'])->name('otp.verify');
Route::post('/resend-otp', [AuthController::class, 'resendOTP'])->name('otp.resend');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/enquiry', [EnquiryController::class, 'enquiry'])->name('enquiry.index');

Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::post('/', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/receipts', [InvoiceController::class, 'receiptsIndex'])->name('receipts.index');
    Route::get('/transactions', [InvoiceController::class, 'transactionsIndex'])->name('transactions.index');
    Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'downloadPDF'])->name('invoices.pdf');
    Route::get('/invoices/{invoice}/receipt', [InvoiceController::class, 'showReceipt'])->name('invoices.receipt');
    Route::get('/invoices/{invoice}/receipt/pdf', [InvoiceController::class, 'downloadReceipt'])->name('invoices.receipt_pdf');
    Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::post('/invoices/{invoice}/confirm', [InvoiceController::class, 'confirmPayment'])->name('invoices.confirm');

    Route::get('/settings/gateways', [InvoiceController::class, 'gatewaySettings'])->name('settings.gateways');
    Route::post('/settings/gateways/{gateway}', [InvoiceController::class, 'updateGateway'])->name('settings.gateways.update');


    // Access Control
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except(['show', 'create']);
    Route::resource('vehicles', \App\Http\Controllers\Admin\VehicleController::class);

    // Ride Bookings
    Route::get('rides', [\App\Http\Controllers\Admin\RideBookingController::class, 'index'])->name('rides.index');
    Route::get('rides/{ride}', [\App\Http\Controllers\Admin\RideBookingController::class, 'show'])->name('rides.show');
    Route::patch('rides/{ride}/status', [\App\Http\Controllers\Admin\RideBookingController::class, 'updateStatus'])->name('rides.status');
    Route::delete('rides/{ride}', [\App\Http\Controllers\Admin\RideBookingController::class, 'destroy'])->name('rides.destroy');

    // Drivers
    Route::resource('drivers', \App\Http\Controllers\Admin\DriverController::class);

    // Revenue Reports
    Route::get('reports/revenue', [\App\Http\Controllers\Admin\RevenueController::class, 'index'])->name('reports.revenue');

    // Customers
    Route::get('customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    Route::get('customers/{customer}', [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
    Route::delete('customers/{customer}', [\App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customers.destroy');

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/pricing', [SettingsController::class, 'pricingIndex'])->name('pricing');
        // InvoiceController already has gatewaySettings, I'll keep it there for now or migrate later.
        Route::post('/pricing', [SettingsController::class, 'pricingUpdate'])->name('pricing.update');
        
        Route::get('/criteria', [SettingsController::class, 'criteriaIndex'])->name('criteria');
        Route::post('/criteria', [SettingsController::class, 'criteriaStore'])->name('criteria.store');
        Route::patch('/criteria/{criterion}', [SettingsController::class, 'criteriaUpdate'])->name('criteria.update');
        Route::delete('/criteria/{criterion}', [SettingsController::class, 'criteriaDelete'])->name('criteria.delete');

        Route::get('/global', [SettingsController::class, 'globalIndex'])->name('global');
        Route::post('/global', [SettingsController::class, 'globalUpdate'])->name('global.update');

        Route::get('/templates', [SettingsController::class, 'templatesIndex'])->name('templates');
        Route::post('/templates/{template}', [SettingsController::class, 'templatesUpdate'])->name('templates.update');
    });
});

// Payment Flow (Publicly accessible for authors)
Route::get('/payments/{invoice}/checkout', [PaymentController::class, 'showCheckout'])->name('payments.checkout');
Route::get('/payments/{invoice}/initiate', [PaymentController::class, 'initiate'])->name('payments.initiate');
Route::get('/payments/success', function () {
    return view('payments.success');
})->name('payments.success');
// Payments (Callback/Webhook)
Route::get('/payments/callback/{gateway}', [PaymentController::class, 'callback'])->name('payments.callback');

// Author Dashboard
Route::group(['prefix' => 'author', 'as' => 'author.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [AuthorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/enquiries', [AuthorDashboardController::class, 'enquiries'])->name('enquiries.index');
    Route::get('/enquiries/create', [AuthorDashboardController::class, 'createEnquiry'])->name('enquiries.create');
    Route::get('/enquiries/{prospect}', [AuthorDashboardController::class, 'showEnquiry'])->name('enquiries.show');
    
    Route::get('/invoices', [AuthorDashboardController::class, 'invoices'])->name('invoices');
    Route::get('/transactions', [AuthorDashboardController::class, 'transactions'])->name('transactions');

    // Contracts
    Route::get('/contracts/{contract}', [\App\Http\Controllers\ContractController::class, 'show'])->name('contracts.show');
    Route::post('/contracts/{contract}/sign', [\App\Http\Controllers\ContractController::class, 'sign'])->name('contracts.sign');
});



Route::get('/services', function () {
    return view('services');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/fleet', function () {
    $vehicles = \App\Models\Vehicle::where('status', 'Active')->get();
    return view('fleet', compact('vehicles'));
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact/submit', function (Request $request) {
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'message' => 'required|string',
    ]);
    return redirect('/contact')->with('success', 'Thank you, ' . e($request->name) . '! Your inquiry has been received. Our concierge team will contact you within 2 hours.');
});

// Chauffeur Search & Booking Flow routes
Route::get('/search-results', [BookingController::class, 'search']);
Route::get('/checkout', [BookingController::class, 'checkout']);
Route::post('/checkout/passenger', [BookingController::class, 'passenger']);
Route::get('/booking/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
Route::post('/checkout/store', [BookingController::class, 'store']);
Route::get('/trips', [BookingController::class, 'trips']);
Route::post('/trips/cancel/{index}', [BookingController::class, 'cancel']);



