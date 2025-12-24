<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityPhotoController;
use App\Http\Controllers\CrewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubcategoryController;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Menu;

// ======================
// PUBLIC ROUTES
// ======================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/promo', [PromoController::class, 'index'])->name('promo');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/promo-loyalty', fn () => Inertia::render('Home/components/PromoLoyalty'))->name('promo-loyalty');

// CSRF token endpoint for frontend fetch fallback
Route::get('/csrf-token', fn () => response()->json([
    'csrf_token' => csrf_token(),
]));

// POSTS (public)
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);

// REVIEWS (public)
Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::get('/reviews/google', [ReviewController::class, 'google']);

// COMMUNITY PHOTOS (public)
Route::get('/community/photos', [CommunityPhotoController::class, 'getActive']);
Route::get('/crew/photos', [CrewController::class, 'getActive']);
Route::post('/members/search', [MemberController::class, 'search'])->name('members.search');

// ======================
// LOGIN
// ======================
Route::get('/login', fn() => Inertia::render('Auth/Login'))->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.home');
    }

    return back()->with('error', 'Email atau password salah.');
});

// ======================
// ADMIN (AUTH REQUIRED)
// ======================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin', function () {
        $foodsCount = Menu::where('category_id', 1)->count();
        $drinksCount = Menu::where('category_id', 2)->count();

        return Inertia::render('Admin/HomeAdmin', [
            'foodsCount' => $foodsCount,
            'drinksCount' => $drinksCount,
        ]);
    })->name('admin.home');

    // Menu
    Route::get('/admin/menu', function (Request $request) {
        $tab = $request->query('tab', 'foods');

        return Inertia::render('Admin/Menu', [
            'foodsMenus' => Menu::where('category_id', 1)->get(),
            'drinksMenus' => Menu::where('category_id', 2)->get(),
            'foodsSubcategories' => Subcategory::where('category_id', 1)->orderBy('order')->get(),
            'drinksSubcategories' => Subcategory::where('category_id', 2)->orderBy('order')->get(),
            'tab' => $tab,
        ]);
    })->name('admin.menu');

    Route::post('/admin/menu/store', [MenuController::class, 'store'])
        ->name('admin.menu.store');
    Route::put('/admin/menu/{menu}', [MenuController::class, 'update'])
        ->name('admin.menu.update');

    Route::delete('/admin/menu/{menu}', [MenuController::class, 'destroy'])
        ->name('admin.menu.destroy');
    // ============================
    // SUBCATEGORY PAGE (INDEX)
    // ============================
    Route::get('/admin/subcategory', [SubcategoryController::class, 'index'])
        ->name('admin.subcategory');

    // SubCategories CRUD
    Route::post('/admin/subcategories', [SubcategoryController::class, 'store']);
    Route::put('/admin/subcategories/{id}', [SubcategoryController::class, 'update']);
    Route::delete('/admin/subcategories/{id}', [SubcategoryController::class, 'destroy']);

    // Users
    Route::get('/admin/users', fn() => Inertia::render('Admin/Users'))
        ->name('admin.users');

    // Banners
    Route::get('/admin/banners', [\App\Http\Controllers\Admin\BannerController::class, 'index'])->name('admin.banners.index');
    Route::post('/admin/banners', [\App\Http\Controllers\Admin\BannerController::class, 'store'])->name('admin.banners.store');
    Route::delete('/admin/banners/{banner}', [\App\Http\Controllers\Admin\BannerController::class, 'destroy'])->name('admin.banners.destroy');

    // Posts Management
    Route::get('/admin/posts', [PostController::class, 'getPending'])->name('admin.posts.index');
    Route::put('/admin/posts/{id}', [PostController::class, 'update'])->name('admin.posts.update');
    Route::post('/admin/posts/{id}/approve', [PostController::class, 'approve'])->name('admin.posts.approve');
    Route::post('/admin/posts/{id}/reject', [PostController::class, 'reject'])->name('admin.posts.reject');

    // Community Photos Management
    Route::get('/admin/community', [CommunityPhotoController::class, 'index'])->name('admin.community.index');
    Route::post('/admin/community', [CommunityPhotoController::class, 'store'])->name('admin.community.store');
    Route::put('/admin/community/{id}', [CommunityPhotoController::class, 'update'])->name('admin.community.update');
    Route::delete('/admin/community/{id}', [CommunityPhotoController::class, 'destroy'])->name('admin.community.destroy');

    // Crew Management
    Route::get('/admin/crews', [CrewController::class, 'index'])->name('admin.crew.index');
    Route::post('/admin/crews', [CrewController::class, 'store'])->name('admin.crew.store');
    Route::put('/admin/crews/{id}', [CrewController::class, 'update'])->name('admin.crew.update');
    Route::delete('/admin/crews/{id}', [CrewController::class, 'destroy'])->name('admin.crew.destroy');

    // Member Management
    Route::get('/admin/members', [MemberController::class, 'index'])->name('admin.members.index');
    Route::post('/admin/members', [MemberController::class, 'store'])->name('admin.members.store');
    Route::put('/admin/members/{id}', [MemberController::class, 'update'])->name('admin.members.update');
    Route::post('/admin/members/{id}/redeem', [MemberController::class, 'redeem'])->name('admin.members.redeem');
    Route::delete('/admin/members/{id}', [MemberController::class, 'destroy'])->name('admin.members.destroy');
});

    // Community Posts
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // Reviews
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // CSRF fetch for SPA usage
    Route::get('/csrf-token', function () {
        return response()->json(['csrf_token' => csrf_token()]);
    });

// ======================
// LOGOUT
// ======================
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');
