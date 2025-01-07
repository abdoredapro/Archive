<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Export\ExportFilesController;
use App\Http\Controllers\FileClipController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\Footage\AddFootageController;
use App\Http\Controllers\Import\ImportFilesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Server\ServerController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/server-info', function () {
    $host = $_SERVER['SERVER_ADDR'];
    $port = $_SERVER['SERVER_PORT'];

    return response()->json([
        'host' => $host,
        'port' => $port,
    ]);
});

Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth'],
    'as' => 'dashboard.',
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::resource('/category', CategoryController::class);

    Route::resource('/film', FilmController::class);

    Route::resource('/file', FileController::class);


    Route::get('{file}/clip', [FileClipController::class, 'create'])
        ->name('file_clip.add');

    Route::post('{file}/clip', [FileClipController::class, 'store'])
        ->name('file_clip.store');


    Route::post('/clip/{type}/{id}', [FileClipController::class, 'update'])
        ->name('file.clip.update');

    Route::post('/clips/{type}/{id}', [FileClipController::class, 'destroy'])
    ->name('file.clip.delete');


    Route::get('user', [DashboardController::class, 'settings'])
        ->name('settings');

    Route::put('user/{user_id}', [DashboardController::class, 'update_info'])
        ->name('update_profile');

    Route::resource('/roles', RolesController::class);

    Route::resource('/users', UsersController::class);

    Route::resource('/projects', ProjectController::class);

    Route::get('/reports', [ReportsController::class, 'index'])
        ->name('reports.index');

    Route::get('/search', [SearchController::class, 'search'])
        ->name('search');

    Route::view('/advanced-search', 'dashboard.search.advanced')
        ->name('advanced-search');

    Route::get('/export/{path?}', [ExportFilesController::class, 'index'])
        ->where('path', '.*')
        ->name('export');

    Route::post('/export-files', [ExportFilesController::class, 'export'])
        ->name('export-files');

});


Route::group([
    'prefix' => 'dashboard',
    'middleware' => ['auth'],
], function () {
    Route::get('/excel/import', [ImportFilesController::class, 'index'])
        ->name('excel.import.index');

    Route::post('/excel/import', [ImportFilesController::class, 'import'])
        ->name('excel.import');
});


Route::prefix('dashboard/export')->middleware('auth')
->as('dashboard.exports.')->group(function () {
    Route::get('export', [ImportFilesController::class, 'index'])->name('index');
});

Route::post('/add-footage', [AddFootageController::class, 'store'])
    ->name('dashboard.add-footage');

Route::get('/server', [ServerController::class, 'index'])
    ->name('server.index');

Route::get('/server/show', [ServerController::class, 'show'])
    ->name('server.show');

Route::get('/server/files', [ServerController::class, 'getFiles'])
    ->name('server.files');
