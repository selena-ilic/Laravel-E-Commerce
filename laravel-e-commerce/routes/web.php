<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::group(['middleware' => ['auth', 'isAdmin']], function () {
//
//    Route::get('/dashboard', function () {
//        // return view('admin.dashboard');
//        return 'This is Admin';
//    });
//
//});

Route::middleware(['auth', 'isAdmin'])->group(function () {

//    Route::get('/dashboard', function () {
//         return view('admin.index');
//    });

    Route::get('/dashboard', 'Admin\FrontendController@index' );

    Route::get('/categories', 'Admin\CategoryController@index' );

    Route::get('/add-category', 'Admin\CategoryController@add' );

    Route::post('/insert-category', 'Admin\CategoryController@insert' );

    Route::get('/edit-prod/{id}', [CategoryController::class, 'edit'] );

    Route::put('/update-category/{id}', [CategoryController::class, 'update'] );

});

