<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WebInformationController;
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

Route::get('/', [AuthController::class, 'index'])->name('signin')->middleware('signout');

Route::group(['as' => 'auth.', 'prefix' => 'portal/auth'], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/signin', 'signin')->name('signin')->middleware('signout');
        Route::get('/signout', 'signout')->name('signout')->middleware('signin');
    });
});

Route::group(['prefix' => 'portal', 'middleware' => 'signin'], function(){
    Route::group(['as' => 'dashboard.', 'prefix' => 'dashboard'], function () {
        Route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
    });
    
    Route::group(['as' => 'post.', 'prefix' => 'post'], function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/datatable', 'datatable')->name('datatable');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::post('/{id}/show', 'show')->name('show');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    });
    
    Route::group(['as' => 'post_category.', 'prefix' => 'post-category'], function () {
        Route::controller(PostCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/datatable', 'datatable')->name('datatable');
            Route::post('/create', 'create')->name('create');
            Route::post('/{id}/update', 'update')->name('update');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    });
    
    Route::group(['as' => 'news.', 'prefix' => 'news'], function () {
        Route::controller(NewsController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::get('/datatable', 'datatable')->name('datatable');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/{id}/update', 'update')->name('update');
            Route::post('/{id}/show', 'show')->name('show');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    });
    
    Route::group(['as' => 'news_category.', 'prefix' => 'news-category'], function () {
        Route::controller(NewsCategoryController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/datatable', 'datatable')->name('datatable');
            Route::post('/create', 'create')->name('create');
            Route::post('/{id}/update', 'update')->name('update');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    });

    Route::group(['as' => 'web_information.', 'prefix' => 'web-information'], function () {
        Route::controller(WebInformationController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update', 'update')->name('update');
        });
    });
    
    Route::group(['as' => 'slider.', 'prefix' => 'slider'], function () {
        Route::controller(SliderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/datatable', 'datatable')->name('datatable');
            Route::post('/create', 'create')->name('create');
            Route::post('/{id}/update', 'update')->name('update');
            Route::post('/{id}/show', 'show')->name('show');
            Route::delete('/{id}/delete', 'delete')->name('delete');
        });
    });
});