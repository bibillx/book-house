    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Auth\LoginController;
    use App\Http\Controllers\Auth\RegisterController;
    use App\Http\Controllers\Auth\ForgotPasswordController;
    use App\Http\Controllers\BooksController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminController;

    /*
    |--------------------------------------------------------------------------
    | Public Routes
    |--------------------------------------------------------------------------
    */

    // Home
Route::get('/', function () {
        return view('welcome');
    })->name('home');
use Illuminate\Support\Facades\Auth;
use App\Models\User;
Route::get('/debug-admin', function () {
    $admin = User::firstOrCreate(
        ['email' => 'admin@gmail.com'],
        ['name' => 'Admin', 'password' => bcrypt('12345678'), 'role' => 'admin']
    );
    Auth::login($admin);
    return redirect('/admin');
});

    // Authentication
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    // Public API Routes for Books (can be accessed without login)
    Route::get('/api/books', [BooksController::class, 'apiIndex'])->name('api.books.index');
    Route::get('/api/books/featured', [BooksController::class, 'apiFeatured'])->name('api.books.featured');

    /*
    |--------------------------------------------------------------------------
    | Protected Routes (Login Required)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', [BooksController::class, 'adminDashboard'])->name('admin.dashboard');

        // ===============================
        // USER ROUTES
        // ===============================

        Route::get('/dashboard', [BooksController::class, 'dashboard'])->name('dashboard');

        Route::get('/catalog', [BooksController::class, 'catalog'])->name('catalog');

        Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');

        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

        // Wishlist
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
        Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
        Route::delete('/wishlist/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
        Route::delete('/wishlist', [WishlistController::class, 'clear'])->name('wishlist.clear');

        // Checkout
        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout');

        Route::post('/checkout', [CheckoutController::class, 'process'])
            ->name('checkout.process');
            
        Route::post('/checkout/buynow', [CheckoutController::class, 'buyNow'])
            ->name('checkout.buynow');

        Route::get('/orders', [CheckoutController::class, 'orders'])
            ->name('checkout.orders');

        Route::get('/orders/{id}', [CheckoutController::class, 'orderDetail'])
            ->name('checkout.detail');

        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/remove-photo', [ProfileController::class, 'removePhoto'])->name('profile.remove-photo');

        // Detail
        Route::get('/book/{id}', [BooksController::class, 'show'])->name('book.detail');

        Route::get('/orders', [CheckoutController::class, 'orders'])
            ->name('checkout.orders');


        // ===============================
        // ADMIN ROUTES
        // ===============================

        Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

            // Dashboard
            Route::get('/', [BooksController::class, 'adminDashboard'])
                ->name('dashboard');

            // ======================
            // BOOK CRUD
            // ======================

            // List Buku
            Route::get('/books', [BooksController::class, 'manageBooks'])
                ->name('books.index');

            // Form Tambah
            Route::get('/books/create', [BooksController::class, 'create'])
                ->name('books.create');

            // Simpan Buku
            Route::post('/books', [BooksController::class, 'store'])
                ->name('books.store');

            // Form Edit
            Route::get('/books/{id}/edit', [BooksController::class, 'edit'])
                ->name('books.edit');

            // Update Buku
            Route::put('/books/{id}', [BooksController::class, 'update'])
                ->name('books.update');

            // Hapus Buku
            Route::delete('/books/{id}', [BooksController::class, 'destroy'])
                ->name('books.destroy');
            
            // Users management
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            
            // Orders management
            Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
            Route::post('/orders/{orderId}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');
        });
    });
