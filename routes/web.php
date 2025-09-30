<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Customer\CustomerController;    
use App\Http\Controllers\HomeController;

use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    if (auth()->check()) {
        return match(auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'partner' => redirect()->route('partner.dashboard'),
            'supplier' => redirect()->route('supplier.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => null,
        };
    }

    if ($request->ajax()) {
        return view('front.partials.home-content'); // create this blade with only <main> content
    }

    // Normal page load with full layout
    return view('front.home'); // extends layouts.app
})->name('home');


Route::get('/{page?}', [HomeController::class, 'show'])
     ->where('page', 'home|about|services|contact|terms|privacy|cancellation|operations')
     ->name('page.show');

Route::get('/partner/login', function () {
    $colors = [
        'start' => '#00c6ff', 
        'end' => '#0072ff',
        'button_start' => '#0072ff',
        'button_end' => '#00c6ff'
    ];
    return view('auth.login', ['role' => 'partner', 'colors' => $colors]);
})->name('partner.login');

Route::get('/supplier/login', function () {
    $colors = [
        'start' => '#f7971e', 
        'end' => '#ffd200',
        'button_start' => '#ffd200',
        'button_end' => '#f7971e'
    ];
    return view('auth.login', ['role' => 'supplier', 'colors' => $colors]);
})->name('supplier.login');

Route::get('/login', function () {
    $colors = [
        'start' => '#00b09b', 
        'end' => '#96c93d',
        'button_start' => '#96c93d',
        'button_end' => '#00b09b'
    ];
    return view('auth.login', ['role' => 'customer', 'colors' => $colors]);
})->name('login');

Route::get('/admin/login', [AuthenticatedSessionController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'adminLogin'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthenticatedSessionController::class, 'adminLogout'])->name('admin.logout');

// ---------------------------
// ADMIN AUTH ROUTES
// ---------------------------

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

// ---------------------------
// PARTNER / SUPPLIER / CUSTOMER AUTH ROUTES
// ---------------------------
Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.submit');

Route::post('/partner/login', [AuthenticatedSessionController::class, 'partnerLogin'])->name('partner.login.submit');

Route::post('/supplier/login', [AuthenticatedSessionController::class, 'supplierLogin'])->name('supplier.login.submit');

Route::post('/customer/login', [AuthenticatedSessionController::class, 'customerLogin'])->name('customer.login.submit');

Route::middleware(['auth', 'partner'])->group(function () {
    Route::get('/partner/dashboard', [PartnerController::class, 'index'])->name('partner.dashboard');
});

Route::middleware(['auth', 'supplier'])->group(function () {
    Route::get('/supplier/dashboard', [SupplierController::class, 'index'])->name('supplier.dashboard');
});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
});
