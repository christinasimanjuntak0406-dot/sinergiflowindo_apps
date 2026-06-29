<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PesanKontakController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogController;

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/produk', [HomeController::class, 'produk']);
Route::get('/produk/{slug}',[HomeController::class,'produkDetail'])->name('produk.detail');
Route::get('/layanan', [HomeController::class, 'layanan']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::post('/contact', [PesanKontakController::class, 'store'])->name('kontak.kirim');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [HomeController::class, 'detailBlog'])->name('blog.detail');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticated']);
Route::get('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| ADMIN (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('layanan', LayananController::class);
    Route::resource('produk', ProdukController::class);
    Route::resource('categories', CategoryController::class);

    Route::prefix('pesan-kontak')->name('pesan-kontak.')->group(function () {
        Route::get('', [PesanKontakController::class, 'index'])->name('index');
        Route::get('/{id}', [PesanKontakController::class, 'show'])->name('show');
        Route::patch('/{id}/baca', [PesanKontakController::class, 'tandaiDibaca'])->name('baca');
        Route::delete('/{id}', [PesanKontakController::class, 'destroy'])->name('destroy');
    });
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');

});