<?php

use App\Category;
use App\Mail\WelcomeMail;
use App\SubCategory;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');

//Backend Routes + Admin Middleware Security:
Route::group(['middleware' => 'admin'], function(){
    Route::get('/admin' , function(){
        return view('admin.index');
    })->name('admin');

    //Backend Admin Routes:
    Route::get('/admin', 'HomeController@index')->name('admin');
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/roles', 'AdminRolesController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/subcategories', 'AdminSubCategoriesController');
    Route::resource('admin/products', 'AdminProductsController');
    Route::resource('admin/addresses', 'AdminAddressController');
    Route::resource('admin/photos', 'AdminPhotosController');
    Route::resource('admin/orders', 'AdminOrdersController');
    Route::resource('admin/stocks', 'AdminStocksController');
    Route::resource('admin/faqs', 'AdminFaqsController');
    Route::resource('admin/faqcategories', 'AdminFaqsCategoriesController');
    Route::resource('admin/blogs', 'AdminBlogsController');
    Route::resource('admin/blogcategories', 'AdminBlogsCategoriesController');
    Route::resource('admin/contacts', 'ContactController');

    //SoftDelete Routes:
    //Route::get('admin/roles/restore/{role}', 'AdminRolesController@roleRestore')->name('admin.rolerestore');
    Route::get('admin/users/restore/{user}', 'AdminUsersController@userRestore')->name('admin.userrestore');
    //Route::get('admin/categories/restore/{category}', 'AdminCategoriesController@categoryRestore')->name('admin.categoryrestore');
    Route::get('admin/addresses/restore/{address}', 'AdminAddressController@addressRestore')->name('admin.addressrestore');
    Route::get('admin/products/restore/{product}', 'AdminProductsController@productRestore')->name('admin.productrestore');
    //Route::get('admin/photos/restore/{photo}', 'AdminPhotosController@photosRestore')->name('admin.photorestore');
    Route::get('admin/faqs/restore/{faq}', 'AdminFaqsController@faqRestore')->name('admin.faqrestore');
    //Route::get('admin/subcategories/restore/{subcategory}', 'AdminSubCategoriesController@subcategoryRestore')->name('admin.subcategoryrestore');
    //Route::get('admin/blogs/restore/{blog}', 'AdminBlogsController@blogRestore')->name('admin.blogrestore');
    //Route::get('admin/faqcategories/restore/{faqcategory}', 'AdminFaqsCategoriesController@faqcategoryRestore')->name('admin.faqcategoryrestore');
    //Route::get('admin/blogcategories/restore/{blogcategory}', 'AdminBlogsCategoriesController@blogcategoryRestore')->name('admin.blogcategoryrestore');
    //Route::get('admin/orders/restore/{orders}', 'AdminOrdersController@orderRestore')->name('admin.orderrestore');

    Route::post('save_product', 'AdminProductsController@save_product');
    Route::get('admin/user/{id}/profile', 'AdminUsersController@profile')->name('profile');
    Route::get('admin/products/{id}/info', 'AdminProductsController@info')->name('info');

});

//Frontend Routes:
Route::get('/index', 'PagesController@funkoIndex')->name('index');
Route::get('/shop', 'PagesController@funkoShop')->name('shop');
Route::get('/pop', 'PagesController@funkoPop')->name('pop');
Route::get('/shop/{product}', 'AdminProductsController@show')->name('product.show');
Route::get('/blog', 'PagesController@funkoBlog')->name('blog');
Route::get('/blog/{slug}', 'AdminBlogsController@show')->name('blog.show');
Route::get('/faq', 'PagesController@funkoFaq')->name('faq');
Route::get('/product', 'PagesController@funkoProduct')->name('product');
Route::get('/review', 'PagesController@funkoReview')->name('review');
Route::get('/login', 'PagesController@funkoLogin')->name('login');
Route::get('/register', 'PagesController@funkoRegister')->name('register');
/*Route::get('/checkout', 'PagesController@funkoCheckout')->name('checkout');*/
Route::get('/checkout', 'CheckoutController@index')->name('checkout');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/account', 'PagesController@funkoAccount')->name('account');
Route::get('/paymentCompleted', 'PagesController@funkopaymentCompleted')->name('paymentCompleted');


/*Filter maken op producten:*/
Route::get('/shop/category/{slug}', 'AdminProductsController@productsPerCategory')->name('productsPerCategory');
Route::get('/shop/subcategory/{id}', 'AdminProductsController@productsPerSubCategory')->name('productsPerSubCategory');

//Cart
Route::get('/winkelwagen', 'PagesController@cart')->name('winkelwagen');
Route::get('/products/addToCart/{id}', 'PagesController@addToCart')->name('addToCart');
Route::post('/winkelwagen', 'PagesController@updateQuantity')->name('quantity');
Route::get('/removeItem/{id}', 'PagesController@removeItem')->name('removeItem');

//Special Routes:
Route::resource('admin/reviews', 'AdminReviewsController');
Route::patch('/account/update', 'PagesController@updateAccount')->name('account.update');
Route::post('/account/address', 'PagesController@accountNewAddress')->name('account.address');
Route::patch('/account', 'PagesController@updateAddress')->name('update.address');
Route::post('/contact', 'ContactController@store');

//Payments:
Route::post('/payments/pay', 'PaymentController@pay')->name('pay');
Route::get('/payments/approval', 'PaymentController@approval')->name('approval');
Route::get('/payments/cancelled', 'PaymentController@cancelled')->name('cancelled');

//Paginate

//Email bekijken via route om te stylen
/*Route::get('/welcomemail', function (){
   return new WelcomeMail();
});*/

