<?php

use Illuminate\Support\Facades\Route;

// controller
use App\Http\Controllers\Admin\MyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;

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

// Admin
Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/', [MyController::class, 'index'])->name('index');

    // quản lý Users
    Route::prefix('user')->name('user.')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('index');
        //thêm người dùng
        Route::get('add', [UserController::class, 'getAdd'])->name('add');
        Route::post('add', [UserController::class, 'postAdd']);
        // edit người dùng
        Route::get('edit/{id}', [UserController::class, 'getEdit'])->name('edit');
        Route::post('update', [UserController::class, 'postEdit'])->name('postEdit');
        //xóa người dùng
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });

    // quản lý công ty
    Route::prefix('company')->name('company.')->group(function(){
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        //thêm người dùng
        Route::get('add', [CompanyController::class, 'getAdd'])->name('add');
        Route::post('add', [CompanyController::class, 'postAdd']);
        // edit người dùng
        Route::get('edit/{id}', [CompanyController::class, 'getEdit'])->name('edit');
        Route::post('update', [CompanyController::class, 'postEdit'])->name('postEdit');
        //xóa người dùng
        Route::get('delete/{id}', [CompanyController::class, 'delete'])->name('delete');
    });

    // quản lý Đơn vị của công ty
    Route::prefix('unit')->name('unit.')->group(function(){
        Route::get('/', [UnitController::class, 'index'])->name('index');
        //thêm đơn vị
        Route::get('add', [UnitController::class, 'getAdd'])->name('add');
        Route::post('add', [UnitController::class, 'postAdd']);
        // edit đơn vị
        Route::get('edit/{id}', [UnitController::class, 'getEdit'])->name('edit');
        Route::post('update', [UnitController::class, 'postEdit'])->name('postEdit');
        //xóa đơn vị
        Route::get('delete/{id}', [UnitController::class, 'delete'])->name('delete');
    });

    // quản lý thuong hieu
    Route::prefix('brand')->name('brand.')->group(function(){
        Route::get('/', [BrandController::class, 'index'])->name('index');
        //thêm thuong hieu
        Route::get('add', [BrandController::class, 'getAdd'])->name('add');
        Route::post('add', [BrandController::class, 'postAdd']);
        // edit thuong hieu
        Route::get('edit/{id}', [BrandController::class, 'getEdit'])->name('edit');
        Route::post('update', [BrandController::class, 'postEdit'])->name('postEdit');
        //xóa thuong hieu
        Route::get('delete/{id}', [BrandController::class, 'delete'])->name('delete');
    });

    // quản lý mau sac
    Route::prefix('color')->name('color.')->group(function(){
        Route::get('/', [ColorController::class, 'index'])->name('index');
        //thêm mau sac
        Route::get('add', [ColorController::class, 'getAdd'])->name('add');
        Route::post('add', [ColorController::class, 'postAdd']);
        // edit mau sac
        Route::get('edit/{id}', [ColorController::class, 'getEdit'])->name('edit');
        Route::post('update', [ColorController::class, 'postEdit'])->name('postEdit');
        //xóa mau sac
        Route::get('delete/{id}', [ColorController::class, 'delete'])->name('delete');
    });

    // quản lý san pham
    Route::prefix('product')->name('product.')->group(function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        //thêm mau sac
        Route::get('add', [ProductController::class, 'getAdd'])->name('add');
        Route::post('add', [ProductController::class, 'postAdd']);

        // edit mau sac
        Route::get('image/{id}', [ProductController::class, 'getImage'])->name('image');

        // edit mau sac
        Route::get('edit/{id}', [ProductController::class, 'getEdit'])->name('edit');
        Route::post('update', [ProductController::class, 'postEdit'])->name('postEdit');
        //xóa mau sac
        Route::get('delete/{id}', [ProductController::class, 'delete'])->name('delete');
    });
    
});






// database

    //user_role
    Route::get('/user_role', function(){ 
        Schema::create('user_role', function($table){ 
            $table->increments('ur_id'); 
            $table-> string('ur_name', 20)->nullable(); 
        }); 
        echo "Đã tạo bảng user_role thành công"; 
    });

    //users
    Route::get('/users', function(){ 
        Schema::create('users', function($table){ 
            $table->increments('user_id'); 
            $table-> integer('ur_id')->unsigned()->nullable();
            $table-> string('user_name', 100)->nullable(); 
            $table->integer('user_phoneNumber')->unique()->unsigned()->nullable(); 
            $table-> string('user_email', 50)->unique()->nullable(); 
            $table->string('user_password', 50)->nullable(); 
            $table-> string('user_address', 200)->nullable(); 
            $table->integer('user_status')->unsigned()->nullable(); 
            $table-> timestamp('user_createAt')->nullable(); 
            $table->foreign('ur_id')->references('ur_id')->on('user_role');
        }); 
        echo "Đã tạo bảng users thành công"; 
    });

    //companys
    Route::get('/companys', function(){ 
        Schema::create('companys', function($table){ 
            $table->increments('cp_id'); 
            $table-> string('cp_name', 100)->nullable(); 
            $table->integer('cp_phoneNumber')->unique()->unsigned()->nullable(); 
            $table-> string('cp_email', 50)->unique()->nullable(); 
            $table-> string('cp_address', 200)->nullable(); 
        }); 
        echo "Đã tạo bảng companys thành công"; 
    });

    //units
    Route::get('/units', function(){ 
        Schema::create('units', function($table){ 
            $table->increments('unit_id'); 
            $table-> integer('cp_id')->unsigned()->nullable();
            $table-> string('unit_name', 100)->nullable(); 
            $table->integer('unit_phoneNumber')->unique()->unsigned()->nullable(); 
            $table-> string('unit_email', 50)->unique()->nullable(); 
            $table-> string('unit_address', 200)->nullable(); 
            $table->foreign('cp_id')->references('cp_id')->on('companys');
        }); 
        echo "Đã tạo bảng units thành công"; 
    });

    //Inventory Vouchers
    Route::get('/inventory_vouchers', function(){ 
        Schema::create('inventory_vouchers', function($table){ 
            $table->increments('unit_id'); 
            $table-> integer('cp_id')->unsigned()->nullable();
            $table-> integer('unit_input')->unsigned()->nullable();
            $table-> integer('unit_export')->unsigned()->nullable();
            $table-> integer('user_create')->unsigned()->nullable();
            $table-> integer('iv_type')->unsigned()->nullable();
            $table-> integer('iv_quantity')->unsigned()->nullable();
            $table-> integer('iv_status')->unsigned()->nullable();
            $table-> float('iv_total')->unsigned()->nullable();
            $table-> string('iv_note', 500)->nullable(); 
            $table-> date('iv_date')->nullable(); 
            $table-> timestamp('iv_createAt')->nullable(); 
            $table->foreign('cp_id')->references('cp_id')->on('companys');
            $table->foreign('unit_input')->references('unit_id')->on('units');
            $table->foreign('unit_export')->references('unit_id')->on('units');
            $table->foreign('user_create')->references('user_id')->on('users');
        }); 
        echo "Đã tạo bảng Inventory Vouchers thành công"; 
    });

    //Brands
    Route::get('/brands', function(){ 
        Schema::create('brands', function($table){ 
            $table->increments('brand_id'); 
            $table-> string('brand_name',200)->nullable(); 
        }); 
        echo "Đã tạo bảng brands thành công"; 
    });

    //colors
    Route::get('/colors', function(){ 
        Schema::create('colors', function($table){ 
            $table->increments('color_id'); 
            $table-> string('color_name',100)->nullable(); 
        }); 
        echo "Đã tạo bảng color thành công"; 
    });

    //Products
    Route::get('/products', function(){ 
        Schema::create('products', function($table){ 
            $table->increments('pro_id'); 
            $table-> integer('color_id')->unsigned()->nullable();
            $table-> integer('brand_id')->unsigned()->nullable();
            $table-> integer('pro_ram')->unsigned()->nullable();
            $table-> string('pro_oSystem',30)->nullable();
            $table-> integer('pro_IMemory')->unsigned()->nullable();

            $table-> integer('pro_warrantyPeriod')->unsigned()->nullable();
            $table-> integer('pro_quatity')->unsigned()->nullable();

            $table-> float('pro_price')->unsigned()->nullable();
            $table-> float('pro_reducedPrice')->unsigned()->nullable();

            $table-> string('pro_description', 500)->nullable(); 
            $table-> string('pro_origin', 50)->nullable();
            $table-> string('pro_name', 100)->nullable();

            $table-> date('pro_launchDate')->nullable();

            $table->foreign('color_id')->references('color_id')->on('colors');
            $table->foreign('brand_id')->references('brand_id')->on('brands');
        }); 
        echo "Đã tạo bảng products thành công"; 
    });

    //images
    Route::get('/images', function(){ 
        Schema::create('images', function($table){ 
            $table->increments('pro_id'); 
            $table-> string('image1', 200)->nullable();
            $table-> string('image2',200)->nullable();
            $table-> string('image3',200)->nullable();
            $table-> string('image4',200)->nullable();
            $table-> string('image5',200)->nullable();
            $table-> string('image6',200)->nullable();

            $table->foreign('pro_id')->references('pro_id')->on('products');
        }); 
        echo "Đã tạo bảng Image thành công"; 
    });


    //Carts
    Route::get('/carts', function(){ 
        Schema::create('carts', function($table){ 
            $table->increments('cart_id'); 
            $table-> integer('user_id')->unsigned()->nullable();
            $table-> integer('pro_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('pro_id')->references('pro_id')->on('products');
        }); 
        echo "Đã tạo bảng Carts thành công"; 
    });

    //orders
    Route::get('/orders', function(){ 
        Schema::create('orders', function($table){ 
            $table-> increments('order_id'); 
            $table-> integer('cart_id')->unsigned()->nullable();
            $table-> integer('order_status')->unsigned()->nullable();
            $table-> integer('order_quantity')->unsigned()->nullable();

            $table-> float('order_total')->unsigned()->nullable();
            $table-> timestamp('order_createAt')->nullable();

            $table->foreign('cart_id')->references('cart_id')->on('carts');
        }); 
        echo "Đã tạo bảng orders thành công"; 
    });

    //Banners
    Route::get('/banners', function(){ 
        Schema::create('banners', function($table){ 
            $table->increments('banner_id'); 
            $table-> string('banner1',200)->nullable();
            $table-> string('banner2',200)->nullable();
            $table-> string('banner3',200)->nullable();
            $table-> string('banner4',200)->nullable();
            $table-> string('banner5',200)->nullable();
        }); 
        echo "Đã tạo bảng Banners thành công"; 
    });


