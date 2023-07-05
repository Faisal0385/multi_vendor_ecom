<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/', [IndexController::class, 'Index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::post('/user/update/password', [UserController::class, 'UserUpdatePassword'])->name('user.update.password');
}); // Group Milldeware End

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';





## Admin

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);

## Admin Profile Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashobard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
});

## Admin Brand Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');

        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
    });
});

## Admin Category Route 
Route::controller(CategoryController::class)->group(function () {
    Route::get('/all/category', 'AllCategory')->name('all.category');
    Route::get('/add/category', 'AddCategory')->name('add.category');
    Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
    Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');

    Route::post('/store/category', 'StoreCategory')->name('store.category');
    Route::post('/update/category', 'UpdateCategory')->name('update.category');
});

## SubCategory All Route 
Route::controller(SubCategoryController::class)->group(function () {
    Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');


    Route::get('/edit/subcategory/{id}', 'EditSubcategory')->name('edit.subcategory');
    Route::post('/update/subcategory', 'UpdateSubcategory')->name('update.subcategory');
    Route::get('/delete/subcategory/{id}', 'DeleteSubcategory')->name('delete.subcategory');

    Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
    Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');

    Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
});




## Frontend Product Details All Route 
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');












## Vendor
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');

## Vendor Active and Inactive All Route 
Route::controller(AdminController::class)->group(function () {
    Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
    Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
    Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
    Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');

    Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');
    Route::post('/inactive/vendor/approve', 'InActiveVendorApprove')->name('inactive.vendor.approve');
});

Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashobard');
    Route::get('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::get('/vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');

    Route::post('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::post('/vendor/update/password', [VendorController::class, 'VendorUpdatePassword'])->name('vendor.update.password');

    // Vendor Add Product All Route 
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::get('/vendor/product/multiimg/delete/{id}', 'VendorMultiimgDelete')->name('vendor.product.multiimg.delete');
        Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}', 'VendorProductDelete')->name('vendor.delete.product');

        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thambnail', 'VendorUpdateProductThabnail')->name('vendor.update.product.thambnail');
        Route::post('/vendor/update/product/multiimage', 'VendorUpdateProductmultiImage')->name('vendor.update.product.multiimage');
    });
});


## Product All Route 
Route::controller(ProductController::class)->group(function () {
    Route::get('/all/product', 'AllProduct')->name('all.product');
    Route::get('/add/product', 'AddProduct')->name('add.product');
    Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
    Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
    Route::get('/delete/product/{id}', 'ProductDelete')->name('delete.product');
    Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
    Route::get('/product/multiimg/delete/{id}', 'MulitImageDelelte')->name('product.multiimg.delete');

    Route::post('/store/product', 'StoreProduct')->name('store.product');
    Route::post('/update/product', 'UpdateProduct')->name('update.product');
    Route::post('/update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');
    Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
});

## Slider All Route 
Route::controller(SliderController::class)->group(function () {
    Route::get('/all/slider', 'AllSlider')->name('all.slider');
    Route::get('/add/slider', 'AddSlider')->name('add.slider');
    Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
    Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');

    Route::post('/store/slider', 'StoreSlider')->name('store.slider');
    Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
});

// Banner All Route 
Route::controller(BannerController::class)->group(function () {
    Route::get('/all/banner', 'AllBanner')->name('all.banner');
    Route::get('/add/banner', 'AddBanner')->name('add.banner');
    Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
    Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');

    Route::post('/store/banner', 'StoreBanner')->name('store.banner');
    Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
});
