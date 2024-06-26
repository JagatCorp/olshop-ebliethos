<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DatabaseController;
use App\Http\Controllers\Admin\KonsultasiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CommentsController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Admin\KecamatanController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ReplyController;
use App\Http\Controllers\Frontend\ReviewController as FrontendReviewController;
use App\Http\Controllers\Frontend\WishListController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TripielController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CourierwarehousepricesController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Frontend\TrackpaketController;
use App\Http\Controllers\Admin\AdminTrackPaketController;
use App\Http\Controllers\Auth\OtpController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Auth::routes();

Route::group(['middleware' => ['auth', 'is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // admin
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::post('create-users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('create-users');
    Route::post('edit-users', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('edit-users');
    Route::get('delete-users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('delete-users');
    // Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'show'])->name('profile.show');
    // Route::put('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('attributes', \App\Http\Controllers\Admin\AttributeController::class);
    Route::resource('attributes.attribute_options', \App\Http\Controllers\Admin\AttributeOptionController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('products.product_images', \App\Http\Controllers\Admin\ProductImageController::class);
    Route::resource('products.product_video', \App\Http\Controllers\Admin\ProductVideoController::class);

    Route::get('orders/trashed', [\App\Http\Controllers\Admin\OrderController::class, 'trashed'])->name('orders.trashed');
    Route::get('orders/restore/{order:id}', [\App\Http\Controllers\Admin\OrderController::class, 'restore'])->name('orders.restore');
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    Route::post('orders/complete/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'doComplete'])->name('orders.complete');
    Route::get('orders/{order:id}/cancel', [\App\Http\Controllers\Admin\OrderController::class, 'cancel'])->name('orders.cancels');
    Route::put('orders/cancel/{order:id}', [\App\Http\Controllers\Admin\OrderController::class, 'doCancel'])->name('orders.cancel');
    Route::post('orders/edit-status', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.status.edit');
    // Route::resource('shipments', \App\Http\Controllers\Admin\ShipmentController::class);

       Route::get('shipments', [\App\Http\Controllers\Admin\ShipmentController::class,'index'])->name('shipments.index');
    Route::post('shipments-update', [\App\Http\Controllers\Admin\ShipmentController::class,'update'])->name('shipments.update');

    Route::get('reports/revenue', [\App\Http\Controllers\Admin\ReportController::class, 'revenue'])->name('reports.revenue');
    Route::get('reports/product', [\App\Http\Controllers\Admin\ReportController::class, 'product'])->name('reports.product');
    Route::get('reports/inventory', [\App\Http\Controllers\Admin\ReportController::class, 'inventory'])->name('reports.inventory');
    Route::get('reports/payment', [\App\Http\Controllers\Admin\ReportController::class, 'payment'])->name('reports.payment');
    Route::get('reports/transaksi', [\App\Http\Controllers\Admin\ReportController::class, 'transaksi'])->name('reports.transaksi');

    Route::get("dashboard", [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name("dashboard");

    //banner
    Route::get('banner', [BannerController::class, 'index'])->name('banner-index');
    Route::post('create-banner', [BannerController::class, 'store'])->name('create-banner');
    Route::post('edit-banner', [BannerController::class, 'update'])->name('edit-banner');
    Route::get('delete-banner/{id}', [BannerController::class, 'delete'])->name('delete-banner');

    //slider
    Route::get('slider', [SliderController::class, 'index'])->name('slider-index');
    Route::post('create-slider', [SliderController::class, 'store'])->name('create-slider');
    Route::post('edit-slider', [SliderController::class, 'update'])->name('edit-slider');
    Route::get('delete-slider/{id}', [SliderController::class, 'delete'])->name('delete-slider');

    //Artikel
    Route::get('artikel', [ArtikelController::class, 'index'])->name('artikel-index');
    Route::post('create-artikel', [ArtikelController::class, 'store'])->name('create-artikel');
    Route::post('edit-artikel', [ArtikelController::class, 'update'])->name('edit-artikel');
    Route::get('delete-artikel/{id}', [ArtikelController::class, 'delete'])->name('delete-artikel');

    //about
    Route::get('about', [AboutController::class, 'index'])->name('about-index');
    Route::post('create-about', [AboutController::class, 'store'])->name('create-about');
    Route::post('edit-about', [AboutController::class, 'update'])->name('edit-about');
    Route::get('delete-about/{id}', [AboutController::class, 'delete'])->name('delete-about');

    //konsultasi
    Route::get('konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi-index');
    Route::post('create-konsultasi', [KonsultasiController::class, 'store'])->name('create-konsultasi');
    Route::post('edit-konsultasi', [KonsultasiController::class, 'update'])->name('edit-konsultasi');
    Route::get('delete-konsultasi/{id}', [KonsultasiController::class, 'delete'])->name('delete-konsultasi');

    // get data customer
    Route::get('customer', [KonsultasiController::class, 'customer'])->name('customer-index');

    // testimoni
    Route::get('testimoni', [TestimoniController::class, 'index'])->name('testimoni-index');
    Route::post('create-testimoni', [TestimoniController::class, 'store'])->name('create-testimoni');
    Route::post('edit-testimoni', [TestimoniController::class, 'update'])->name('edit-testimoni');
    Route::get('delete-testimoni/{id}', [TestimoniController::class, 'delete'])->name('delete-testimoni');

    //review
    Route::get('review', [ReviewController::class, 'index'])->name('review-index');
    Route::post('create-review', [ReviewController::class, 'store'])->name('create-review');
    Route::post('edit-review', [ReviewController::class, 'update'])->name('edit-review');
    Route::get('delete-review/{id}', [ReviewController::class, 'delete'])->name('delete-review');

    //settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings-index');
    Route::post('create-settings', [SettingsController::class, 'store'])->name('create-settings');
    Route::post('edit-settings', [SettingsController::class, 'update'])->name('edit-settings');
    Route::get('delete-settings/{id}', [SettingsController::class, 'delete'])->name('delete-settings');

    //coupon
    Route::get('coupon', [CouponController::class, 'index'])->name('coupon-index');
    Route::post('create-coupon', [CouponController::class, 'store'])->name('create-coupon');
    Route::post('edit-coupon', [CouponController::class, 'update'])->name('edit-coupon');
    Route::get('delete-coupon/{id}', [CouponController::class, 'delete'])->name('delete-coupon');

      //warehouse
    Route::get('warehouse', [WarehouseController::class, 'index'])->name('warehouse-index');
    Route::get('warehouse/api', [WarehouseController::class, 'indexApi'])->name('warehouse-index-api');
    Route::post('create-warehouse', [WarehouseController::class, 'store'])->name('create-warehouse');
    Route::post('edit-warehouse', [WarehouseController::class, 'update'])->name('edit-warehouse');
    Route::get('delete-warehouse/{id}', [WarehouseController::class, 'delete'])->name('delete-warehouse');

    //province
    Route::get('province', [ProvinceController::class, 'index'])->name('province-index');
    Route::get('province/api', [ProvinceController::class, 'indexApi'])->name('province-index-api');
    Route::post('create-province', [ProvinceController::class, 'store'])->name('create-province');
    Route::post('edit-province', [ProvinceController::class, 'update'])->name('edit-province');
    Route::get('delete-province/{province_id}', [ProvinceController::class, 'delete'])->name('delete-province');

    //city
    Route::get('city', [CityController::class, 'index'])->name('city-index');
    Route::get('city/api', [CityController::class, 'indexApi'])->name('city-index-api');
    Route::post('create-city', [CityController::class, 'store'])->name('create-city');
    Route::post('edit-city', [CityController::class, 'update'])->name('edit-city');
    // Route::get('delete-city/{city_id}', [CityController::class, 'delete'])->name('delete-city');
    Route::post('delete-city', [CityController::class, 'delete'])->name('delete-city');
    //jquery fetch city by province
    // Route::get('/fetch-cities', [CityController::class, 'fetchCities']);
    // Route::get('/fetch-districts-by-city', [CityController::class, 'fetchDistrictsByCity']);

     //kecamatan
    Route::get('kecamatan', [KecamatanController::class, 'index'])->name('kecamatan-index');
    Route::get('kecamatan/api', [KecamatanController::class, 'indexApi'])->name('kecamatan-index-api');
    Route::post('create-kecamatan', [KecamatanController::class, 'store'])->name('create-kecamatan');
    Route::post('edit-kecamatan', [KecamatanController::class, 'update'])->name('edit-kecamatan');
    Route::post('delete-kecamatan', [KecamatanController::class, 'delete'])->name('delete-kecamatan');

    //courier
    Route::get('courier', [CourierController::class, 'index'])->name('courier-index');
    Route::get('courier/api', [CourierController::class, 'indexApi'])->name('courier-index-api');
    Route::post('create-courier', [CourierController::class, 'store'])->name('create-courier');
    Route::post('edit-courier', [CourierController::class, 'update'])->name('edit-courier');
    Route::get('delete-courier/{id}', [CourierController::class, 'delete'])->name('delete-courier');

    //courierwarehouseprices
    Route::get('courierwarehouseprices', [CourierwarehousepricesController::class, 'index'])->name('courierwarehouseprices-index');
    Route::post('create-courierwarehouseprices', [CourierwarehousepricesController::class, 'store'])->name('create-courierwarehouseprices');
    Route::post('edit-courierwarehouseprices', [CourierwarehousepricesController::class, 'update'])->name('edit-courierwarehouseprices');
    Route::get('delete-courierwarehouseprices/{id}', [CourierwarehousepricesController::class, 'delete'])->name('delete-courierwarehouseprices');

    //tripiel
    Route::get('tripiel', [TripielController::class, 'index'])->name('tripiel-index');
    Route::get('tripiel/{id}', [TripielController::class, 'show'])->name('tripiel-show');
    Route::post('create-tripiel', [TripielController::class, 'store'])->name('create-tripiel');
    Route::post('edit-tripiel', [TripielController::class, 'update'])->name('edit-tripiel');
    Route::post('duplikat-tripiel', [TripielController::class, 'duplikat'])->name('duplikat-tripiel');
    Route::get('delete-tripiel/{id}', [TripielController::class, 'delete'])->name('delete-tripiel');
    Route::get('delete-show/{id}', [TripielController::class, 'deleteshow'])->name('delete-show');

     // tranking paket by resi
    Route::get('track-paket-admin', [AdminTrackPaketController::class, 'showTrackForm'])->name('track.form.admin');
    Route::get('track-paket-result-admin', [AdminTrackPaketController::class, 'trackPaket'])->name('track.paket');


    // database
    Route::get('database', [DatabaseController::class, 'index'])->name('database-index');
    Route::get('database/backup', [DatabaseController::class, 'createBackup'])->name('create.backup');
    Route::get('database/backup/download/{filename}', [DatabaseController::class, 'downloadBackup'])->name('download.backup');

});

Route::group(['middleware' => 'cek_visit_token'], function() {
    // home
    Route::get('/', [HomepageController::class, 'index']);
    // products
    Route::get('products', [ProductController::class, 'index']);
    Route::get('product/{product:slug}', [ProductController::class, 'show'])->name('product.detail');
    Route::get('products/quick-view/{product:slug}', [ProductController::class, 'quickView']);
    // special deal
    Route::get('special-deal', [ProductController::class, 'specialDeal']);
    // about
    Route::get('/about', [HomepageController::class, 'about']);
    // konsultasi
    Route::get('/konsultasi', [HomepageController::class, 'konsultasi']);
    // artikel
    Route::get('/artikel', [HomepageController::class, 'artikel']);
    Route::get('/detail-artikel/{slug}', [HomepageController::class, 'Detailartikel']);
    // keluar
    Route::get('/keluar', [HomepageController::class, 'keluar'])->name('logout');
    //carts
    Route::get('carts', [CartController::class, 'index'])->name('carts.index');
    Route::post('carts', [CartController::class, 'store'])->name('carts.store');
    Route::post('carts/update', [CartController::class, 'update']);
    Route::get('carts/remove/{cartId}', [CartController::class, 'destroy']);

    // reviews
    Route::get('reviews', [FrontendReviewController::class, 'reviews'])->name('reviews');
    // Route::get('reviews-index', [FrontendReviewController::class, 'index'])->name('reviews-index');

    Route::get('/reviews/create/{product_id}', [FrontendReviewController::class, 'index'])->name('reviews.create');

    Route::post('reviews-create', [FrontendReviewController::class, 'store'])->name('reviews-create');
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('orders/checkout', [OrderController::class, 'checkout'])->middleware('auth');
    Route::post('orders/checkout', [OrderController::class, 'doCheckout'])->name('orders.checkout')->middleware('auth');
    Route::get('orders/cities', [OrderController::class, 'cities'])->middleware('auth');
    Route::post('orders/shipping-cost', [OrderController::class, 'shippingCost'])->middleware('auth');
    Route::post('orders/set-shipping', [OrderController::class, 'setShipping'])->middleware('auth');
    Route::get('orders/received/{orderId}', [OrderController::class, 'received'])->name('orders.received');
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{orderId}', [OrderController::class, 'show']);
    Route::get('/order/success/{orderId}', [OrderController::class, 'successOrder'])->name("order-success");
    Route::resource('wishlists', WishListController::class)->only(['index', 'store', 'destroy']);
    Route::get('delete-wishlist/{id}', [WishListController::class, 'delete'])->name('delete-wishlist');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile-update', [ProfileController::class, 'update'])->name('profile.update');

    // comentar
    Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
    // reply
    Route::post('/reply', [ReplyController::class, 'store'])->name('reply.store');
    Route::delete('/reply/{reply}', [ReplyController::class, 'destroy'])->name('reply.destroy');

    // coupon
    Route::post('/orders/{orderId}/apply-coupon', [OrderController::class, 'applyCoupon'])->name('apply.coupon');
    // search shipping cost sesuai excel eblie
    Route::post('/search-shipping-cost', [OrderController::class, 'searchShippingCost']);


    // tranking paket by resi
    Route::get('track-paket', [TrackpaketController::class, 'showTrackForm'])->name('track.form');
    Route::get('track-paket-result', [TrackpaketController::class, 'trackPaket'])->name('track.paket');

});

Route::post('payments/notification', [PaymentController::class, 'notification']);
Route::get('payments/completed', [PaymentController::class, 'completed']);
Route::get('payments/failed', [PaymentController::class, 'failed']);
Route::get('payments/unfinish', [PaymentController::class, 'unfinish']);

// otp verifikasi
Route::get('verify', [OtpController::class, 'verify'])->name('verify');
Route::post('send-otp', [OtpController::class, 'sendOTP'])->name('send.otp');
Route::get('cek-otp', [OtpController::class, 'cekOTP'])->name('cek.otp');
Route::post('verify-otp', [OtpController::class, 'verifyOTP'])->name('verify.otp');

//jquery fetch city by province
Route::get('/fetch-districts-by-city', [CityController::class, 'fetchDistrictsByCity']);
Route::get('/fetch-cities', [CityController::class, 'fetchCities']);
