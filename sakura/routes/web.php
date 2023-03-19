<?php

use Illuminate\Support\Facades\Route;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SourceController as AdminSourceController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\ParserController;
use \App\Http\Controllers\ProfileController;

use \App\Http\Controllers\test\TestConroller;
use App\Http\Controllers\Auth\VerificationController;


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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::match(['get', 'post'],'/about', [AboutController::class, 'index'])->name('about');

// Роуты для новостей на самом сайте (не админ)
Route::name('news.')
    ->prefix('news')
    ->group(function() {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/one/{id}', [NewsController::class, 'show'])->where('id', '[0-9]+')->name('one');

        Route::name('category.')
            ->group(function () {
                Route::get('/categories', [CategoryController::class, 'index'])->name('index');
                Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('show');
            });

    });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Сгруппировать маршруты для admin
Route::name('admin.') //задать префикс для имени-псевдонима в ссылке меню: то есть выглядит как бы так ->name('admin.index')
->prefix('admin') // а это часть идет как префикс для uri, там где сейчас '/' автоматом становится '/admin',
// где сейчас в uri '/test1' - автоматически подставится префикс, чтобы получилось '/admin/test1'
->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/test1', [AdminController::class, 'test1'])->name('test1');
        Route::get('/test2', [AdminController::class, 'test2'])->name('test2');

        Route::get('/user/index', [AdminUserController::class, 'index'])->name('user.index');
        Route::delete('/user/{user}', [AdminUserController::class, 'destroy'])->name('user.destroy');
        Route::put('/user/{user}', [AdminUserController::class, 'update'])->name('user.update');

        Route::get('/parser', [ParserController::class, 'index'])->name('parser');

        Route::resource('/category', AdminCategoryController::class)->except('show');
        Route::resource('/news', AdminNewsController::class)->except('show');
        Route::resource('/source', AdminSourceController::class)->except('show');

        Route::get('/ajax', [AdminController::class, 'ajax'])->name('ajax');
        Route::post('/ajax', [AdminController::class, 'sendAjax'])->name('ajax');

    });

// для юзеров

Route::match(['get', 'post'], '/profile', [ProfileController::class, 'update'])->name('updateProfile');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register');

Route::get('/auth/vk', [LoginController::class, 'loginVK'])->name('vkLogin');
// здесь - как в самой соцсети
Route::get('/auth/vk/response', [LoginController::class, 'responseVK'])->name('vkResponse');

Route::get('/auth/gh', [LoginController::class, 'loginGH'])->name('ghLogin');
// здесь - как в самой соцсети
Route::get('/auth/gh/response', [LoginController::class, 'responseGH'])->name('ghResponse');

// для файлового менеджера
//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'is_admin']], function () {
//
//    \UniSharp\LaravelFilemanager\Lfm::routes();
//
//});


Route::name('test.')
    ->prefix('test')
    ->group(function() {
        Route::get('/home', [TestConroller::class, 'index'])->name('home');
        Route::get('/info', [TestConroller::class, 'info'])->name('info');
    });


Route::resource('aa/photos', \App\Http\Controllers\aa\PhotoController::class);

