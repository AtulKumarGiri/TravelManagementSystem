<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Partner\PartnerController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Customer\CustomerController;    
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Controllers\Admin\SidebarController;

Route::get('/create-admin', function () {
    $admin = Admin::create([
        'company_id' => 'COMP001',
        'name'       => 'Super Admin',
        'email'      => 'admin@travel.com',
        'password'   => Hash::make('123456789'), // Always hash passwords
        'phone'      => '9876543210',
        'address'    => 'Kolkata, India',
        'is_active'  => true,
    ]);

    return "Admin created successfully with ID: {$admin->id}";
});

// ---------------------------
// HOME / PAGES
// ---------------------------
Route::get('/', function (Request $request) {
    if (auth()->check()) {
        return match(auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'partner' => redirect()->route('partner.dashboard'),
            'supplier' => redirect()->route('supplier.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
        };
    }

    $view = view('front.home');
    if ($request->ajax()) {
        return $view->renderSections()['content'] ?? '';
    }

    return $view;
})->name('home');

Route::get('/{page?}', [HomeController::class, 'show'])
     ->where('page', 'home|about|services|contact|terms|privacy|cancellation|operations')
     ->name('page.show');

// ---------------------------
// LOGIN PAGE (GET)
// ---------------------------

// All routes below require session handling
Route::middleware('web')->group(function () {

    // Login Page
    Route::get('/login', function (Request $request) {
        $role = $request->query('role', 'customer');
        if (!in_array($role, ['admin','partner','supplier','customer'])) abort(404);

        $colors = match($role) {
            'admin' => ['start'=>'#000','end'=>'#333','button_start'=>'#333','button_end'=>'#000'],
            'partner' => ['start'=>'#00c6ff','end'=>'#0072ff','button_start'=>'#0072ff','button_end'=>'#00c6ff'],
            'supplier' => ['start'=>'#f7971e','end'=>'#ffd200','button_start'=>'#ffd200','button_end'=>'#f7971e'],
            'customer' => ['start'=>'#00b09b','end'=>'#96c93d','button_start'=>'#96c93d','button_end'=>'#00b09b'],
        };

        return view('auth.login', compact('role', 'colors'));
    })->name('login');

    // Login Submit
    Route::post('/login', function (Request $request) {
        $role = $request->input('role');
        $credentials = $request->only('email','password');

        if (!in_array($role,['admin','partner','supplier','customer'])) {
            abort(404);
        }

        if (Auth::guard($role)->attempt($credentials)) {
            $request->session()->regenerate();

            return match($role) {
                'admin' => redirect()->route('admin.dashboard'),
                'partner' => redirect()->route('partner.dashboard'),
                'supplier' => redirect()->route('supplier.dashboard'),
                'customer' => redirect()->route('customer.dashboard'),
            };
        }

        return back()->withErrors(['email'=>'Invalid credentials for '.$role]);
    })->name('login.submit');

});



Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/cms', \App\Http\Controllers\Admin\CMSPageController::class);
    Route::get('/admin/sidebars', [SidebarController::class, 'index'])->name('sidebar.index');
    Route::get('/admin/sidebars/create', [SidebarController::class, 'create'])->name('sidebar.create');
    Route::post('/admin/sidebars', [SidebarController::class, 'store'])->name('sidebar.store');
    Route::get('/admin/profile', [UserController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/change-password', [UserController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('admin/change-password', [UserController::class, 'updatePassword'])->name('admin.password.update');

    Route::get('/admin/settings', [UserController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings/update', [UserController::class, 'updateSettings'])->name('admin.settings.update');

});

Route::middleware(['auth:partner'])->group(function () {
    Route::get('/partner/dashboard', [PartnerController::class, 'index'])->name('partner.dashboard');
});

Route::middleware(['auth:supplier'])->group(function () {
    Route::get('/supplier/dashboard', [SupplierController::class, 'index'])->name('supplier.dashboard');
});

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');
});


// ---------------------------
// REGISTRATION
// ---------------------------
Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.submit');

Route::post('/logout', function (Request $request) {
    // Determine the guard dynamically
    $guards = ['admin', 'partner', 'supplier', 'customer'];

    foreach ($guards as $guard) {
        if (Auth::guard($guard)->check()) {
            Auth::guard($guard)->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect to the correct login page
            return redirect()->route('login', ['role' => $guard]);
        }
    }

    // Default redirect if no one is logged in
    return redirect()->route('login', ['role' => 'customer']);
})->name('logout');
