<?php

use App\Http\Controllers\AdvertController;
use App\Http\Controllers\BodyTypeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarListController;
use App\Http\Controllers\CarModelController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\FuelController;
use App\Http\Controllers\MakeController;
use App\Http\Livewire\Components\MakesCarModelsList;
use App\Models\BodyType;
use App\Models\Fuel;

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
    // return view('welcome');
    return view('pages.home');
    // return view('pages.car-list');
});

Route::resource('carlist', CarListController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::get('/admin', function() {
    //     dd('To może zobaczyć ' . config('auth.roles.admin'));
    // })->middleware('role:' . config('auth.roles.admin'))
    // ->name('admin');

    // Route::get('/worker', function() {
    //     Log::error("Error log");
    //     Log::debug('Debug log');
    //     dd('To może zobaczyć ' . config('auth.roles.worker'));
    // })->middleware('role:' . config('auth.roles.worker'))
    // ->name('worker');

    Route::name('users.')->prefix('users')->group(function() {
        Route::get('', [UserController::class, 'index'])
            ->name('index')
            ->middleware(['permission:users.index']);
    });

    // Route::get('async/users', [UserController::class, 'async'])
    //     ->name('async.users');

    // Route::resource('categories', CategoryController::class);

    Route::resource('makes', MakeController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async makes
    Route::get('async/makes', [MakeController::class, 'async'])
        ->name('async.makes');

    Route::resource('fuels', FuelController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async fuels
    Route::get('async/fuels', [FuelController::class, 'async'])
        ->name('async.fuels');

    Route::resource('counties', CountyController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async counties
    Route::get('async/counties', [CountyController::class, 'async'])
        ->name('async.counties');

    Route::resource('bodyTypes', BodyTypeController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async body types
    Route::get('async/bodyTypes', [BodyTypeController::class, 'async'])
        ->name('async.bodyTypes');

    Route::resource('cities', CityController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async cities
    Route::get('async/cities', [CityController::class, 'async'])
        ->name('async.cities');

    Route::resource('carModels', CarModelController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async car models
    Route::get('async/carModels', [CarModelController::class, 'async'])
        ->name('async.carModels');

    Route::resource('cars', CarController::class)->only([
        'index', 'create', 'edit'
    ]);

    // ? Async cars
    Route::get('async/cars', [CarController::class, 'async'])
        ->name('async.cars');

    Route::resource('adverts', AdvertController::class)->only([
        'index', 'create', 'edit'
    ]);

    // Dependent List for Make and CarModel
    Route::get('makesCarModels', MakesCarModelsList::class);


    
});
