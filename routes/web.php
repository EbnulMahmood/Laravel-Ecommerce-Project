<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingController;
use App\Http\Controllers\Backend\OrderController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;

use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\MyCartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\UserController;

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

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function() {
    // admin routes
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    Route::get('/admin/profile', [AdminProfileController::class, 'AdminProfile'])->name('admin.profile');

    Route::get('/admin/profile/edit', [AdminProfileController::class, 'AdminProfileEdit'])->name('admin.profile.edit');

    Route::post('/admin/profile/store', [AdminProfileController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminProfileController::class, 'AdminUpdatePassword'])->name('admin.update.password');

    // admin brand routes
    Route::prefix('brand')->group(function() {
        Route::get('/all', [BrandController::class, 'AllBrand'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/update/{id}', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    });

    // admin category routes
    Route::prefix('category')->group(function() {
        Route::get('/all', [CategoryController::class, 'AllCategory'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

        // subcategory route
        Route::get('/sub/all', [SubCategoryController::class, 'AllSubCategory'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update/{id}', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

        // sub-subcategory route
        Route::get('/sub/sub/all', [SubSubCategoryController::class, 'AllSubSubCategory'])->name('all.subsubcategory');
        Route::get('/subcategory/ajax/{category_id}', [SubSubCategoryController::class, 'GetSubCategoryAJAX']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubSubCategoryController::class, 'GetSubSubCategoryAJAX']);
        Route::post('/sub/sub/store', [SubSubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubSubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update/{id}', [SubSubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubSubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');    
    });

    // admin product routes
    Route::prefix('product')->group(function() {
        Route::get('/multiple-image/add/{id}', [ProductController::class, 'AddMultiImage'])->name('add.multi.image');
        Route::post('/multiple-image/store/{id}', [ProductController::class, 'StoreMultiImage'])->name('multi.image.store');
        Route::post('/multiple-image/update', [ProductController::class, 'UpdateMultiImage'])->name('multi.image.update');
        Route::get('/multiple-image/delete/{id}', [ProductController::class, 'DeleteMultiImage'])->name('multi.image.delete');
        
        Route::get('/all', [ProductController::class, 'ManageProduct'])->name('manage.product');
        Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
        Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product.store');
        Route::get('/edit/{id}', [ProductController::class, 'ProductEdit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'ProductUpdate'])->name('product.update');

        Route::get('/active/{id}', [ProductController::class, 'ProductActive'])->name('product.active');
        Route::get('/inactive/{id}', [ProductController::class, 'ProductInactive'])->name('product.inactive');
        Route::get('/delete/{id}', [ProductController::class, 'ProductDelete'])->name('product.delete');
    });

    // admin coupon routes
    Route::prefix('coupon')->group(function() {
        Route::get('/all', [CouponController::class, 'ManageCoupon'])->name('manage.coupon');
        Route::post('/store', [CouponController::class, 'StoreCoupon'])->name('coupon.store');
        Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
        Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
        Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');
    });

    // admin shipping routes
    Route::prefix('shipping')->group(function() {
        // admin shipping routes
        Route::get('/division/all', [ShippingController::class, 'ManageDivision'])->name('manage.division');
        Route::post('/division/store', [ShippingController::class, 'StoreDivision'])->name('division.store');
        Route::get('/division/edit/{id}', [ShippingController::class, 'DivisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}', [ShippingController::class, 'DivisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}', [ShippingController::class, 'DivisionDelete'])->name('division.delete');
        
        // admin district routes
        Route::get('/district/all', [ShippingController::class, 'ManageDistrict'])->name('manage.district');
        Route::post('/district/store', [ShippingController::class, 'StoreDistrict'])->name('district.store');
        Route::get('/district/edit/{id}', [ShippingController::class, 'DistrictEdit'])->name('district.edit');
        Route::post('/district/update/{id}', [ShippingController::class, 'DistrictUpdate'])->name('district.update');
        Route::get('/district/delete/{id}', [ShippingController::class, 'DistrictDelete'])->name('district.delete');
        
        // // admin state routes
        Route::get('/state/all', [ShippingController::class, 'ManageState'])->name('manage.state');
        Route::get('/district/ajax/{division_id}', [ShippingController::class, 'GetDistrictAJAX']);
        Route::post('/state/store', [ShippingController::class, 'StoreState'])->name('state.store');
        Route::get('/state/edit/{id}', [ShippingController::class, 'StateEdit'])->name('state.edit');
        Route::post('/state/update/{id}', [ShippingController::class, 'StateUpdate'])->name('state.update');
        Route::get('/state/delete/{id}', [ShippingController::class, 'StateDelete'])->name('state.delete');
    });

    // admin orders routes
    Route::prefix('order')->group(function() {
        Route::get('/pending', [OrderController::class, 'PendingOrder'])->name('pending.order');
        Route::get('/detail/{id}', [OrderController::class, 'OrderDetail'])->name('order.detail');
        Route::get('/delete/{id}', [OrderController::class, 'OrderDelete'])->name('order.delete');
        Route::get('/confirmed', [OrderController::class, 'ConfirmedOrder'])->name('confirmed.order');
        Route::get('/processing', [OrderController::class, 'ProcessingOrder'])->name('processing.order');
        Route::get('/picked', [OrderController::class, 'PickedOrder'])->name('picked.order');
        Route::get('/shipped', [OrderController::class, 'ShippedOrder'])->name('shipped.order');
        Route::get('/delivered', [OrderController::class, 'DeliveredOrder'])->name('delivered.order');
        Route::get('/canceled', [OrderController::class, 'CanceledOrder'])->name('canceled.order');
    });
});

// home routes
Route::get('/', [IndexController::class, 'Index'])->name('home');

// user routes
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');

Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');

Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');

Route::get('/user/change/password', [IndexController::class, 'ChangePassword'])->name('change.password');

Route::post('/user/update/password', [IndexController::class, 'UserUpdatePassword'])->name('user.update.password');

Route::get('/language/bangla', [LanguageController::class, 'Bangla'])->name('bangla.language');

Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');

// user product route
Route::get('/product/details/{id}/{slug}', [FrontProductController::class, 'ProductDetails'])->name('product.details');

Route::get('/product/modal/ajax/{id}', [FrontProductController::class, 'ProductDetailsModalAJAX']);

Route::get('/product', [ShopController::class, 'ShopProduct'])->name('shop.product');

Route::get('/category/{id?}/{slug?}', [ShopController::class, 'ShopCategory'])->name('shop.category');

Route::get('/sub-category/{id?}/{slug?}', [ShopController::class, 'ShopSubCategory'])->name('shop.subcategory');

// cart routes
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCartAJAX']);

Route::get('/product/cart/ajax', [CartController::class, 'GetCartAJAX']);

Route::get('/remove/cart-product/ajax/{id}', [CartController::class, 'RemoveCartProductAJAX']);

// user cart route
Route::get('/my-cart', [MyCartController::class, 'MyCart'])->name('my.cart');

Route::get('/my-cart/data/ajax', [MyCartController::class, 'MyCartAJAX']);

Route::get('/remove/my-cart-product/ajax/{id}', [MyCartController::class, 'RemoveMyCartProductAJAX']);

Route::get('/increment/my-cart-qty/ajax/{id}', [MyCartController::class, 'incrementMyCartQtyAJAX']);

Route::get('/decrement/my-cart-qty/ajax/{id}', [MyCartController::class, 'decrementMyCartQtyAJAX']);

// apply coupon routes
Route::post('/apply/coupon/ajax', [MyCartController::class, 'ApplyCouponAJAX']);

Route::get('/coupon/calculation/ajax', [MyCartController::class, 'CouponCalculationAJAX']);

Route::get('/remove/coupon/ajax', [MyCartController::class, 'RemoveCouponAJAX']);

// checkout routes
Route::get('/checkout', [CheckoutController::class, 'CreateCheckout'])->name('checkout');

Route::get('/shipping', [CheckoutController::class, 'ShippingInfo'])->name('shipping');

Route::get('/get/district/ajax/{id}', [CheckoutController::class, 'GetDistrictAJAX']);

Route::get('/get/state/ajax/{id}', [CheckoutController::class, 'GetStateAJAX']);

Route::post('/checkout/store', [CheckoutController::class, 'StoreCheckout'])->name('checkout.store');

// whishlist routes
Route::post('/whish/product/store/{id}', [WishlistController::class, 'AddToWhishlistAJAX']);

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function() {
    // whishlist routes
    Route::get('/wishlist', [WishlistController::class, 'UserWishlist'])->name('user.wishlist');
    Route::get('/wishlist/data/ajax', [WishlistController::class, 'UserWishlistAJAX']);
    Route::get('/remove/wishlist-product/ajax/{id}', [WishlistController::class, 'RemoveWishlistProductAJAX']);
 
    // order routes
    Route::get('/order', [UserController::class, 'UserOrder'])->name('user.order');

    // stripe routes
    Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');
    Route::get('/order/receipt/{order_id}', [StripeController::class, 'OrderReceipt'])->name('order.receipt');
    Route::get('/download/receipt/{order_id}', [StripeController::class, 'DownloadReceipt'])->name('download.receipt');
    Route::get('/return/order/{order_id}', [StripeController::class, 'ReturnOrder'])->name('return.order');
});