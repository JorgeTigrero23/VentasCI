<?php

//use App\Http\Middleware\CheckMenu;

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


//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('/grafico', 'HomeController@amountGraph');

Route::get('/admin/user/{user}/menu', 'Administration\UserController@menu')->name('user.menu')->middleware('admin');
Route::patch('/admin/user/menu/{user}', 'Administration\UserController@menuStore')->name('users.menuStore')->middleware('admin');

Route::get('user/profile/{user}', 'Administration\UserController@editProfile')->name('user.edit.profile');
Route::patch('user/profile/{user}', 'Administration\UserController@updateProfile')->name('user.update.profile');

Route::get('movimiento/listClient', 'Movements\SaleController@getClients')->middleware('auth');
Route::get('movimiento/listProduct', 'Movements\SaleController@getProducts')->middleware('auth');

Route::get('reporte/factura/{id}', 'Movements\SaleController@invoice')->name('invoice')->middleware('auth');

Route::group(['middleware' => ['auth','checkMenu']], function () {
    
    Route::get('acercade', function(){
        return view('about');
    });
    Route::get('ayuda', function(){
        return view('help');
    });
    
    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes

    Route::get('/admin/option/create/{padre}', 'Administration\OptionMenuController@create');
    Route::get('/admin/option/orden', 'Administration\OptionMenuController@updateOrden');
    Route::post('/admin/option/orden', 'Administration\OptionMenuController@updateOrden');
    Route::resource('/admin/option',"Administration\OptionMenuController");
    
    Route::resource('admin/configurations', 'Administration\ConfigurationController');
    Route::resource('admin/rols', 'Administration\RolController');
    Route::resource('admin/users', 'Administration\UserController');

    Route::resource('admin/tipodocumento', 'Administration\DocumentTypeController');
    Route::resource('admin/tipocliente', 'Administration\ClientTypeController');
    Route::resource('admin/tipocomprobante', 'Administration\VoucherTypeController');

    Route::resource('mantenimiento/categoria', 'Maintenances\CategoryController');
    Route::resource('mantenimiento/cliente', 'Maintenances\ClientController');
    Route::resource('mantenimiento/producto', 'Maintenances\ProductController');

    Route::resource('movimiento/venta', 'Movements\SaleController');

    Route::get('reporte/categorias', 'Maintenances\CategoryController@report')->name('report.categories');
    
    Route::get('reporte/clientes', 'Maintenances\ClientController@report')->name('report.clients');
    
    Route::get('reporte/productos', 'Maintenances\ProductController@report')->name('report.products');
    
    Route::get('reporte/ventas', 'Movements\SaleController@report')->name('report.sales');

    Route::resource('empresa', 'Administration\CompanyController');

    Route::get('reporte/categorias/view', 'Maintenances\CategoryController@viewReport')->name('report.view.categories');
    Route::get('reporte/clientes/view', 'Maintenances\ClientController@viewReport')->name('report.view.clients');
    Route::get('reporte/productos/view', 'Maintenances\ProductController@viewReport')->name('report.view.products');
    Route::get('reporte/ventas/view', 'Movements\SaleController@viewReport')->name('report.view.sales');



});
