<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ReportController;

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

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('/site')->group(function() {
    Route::get('/categorias', 'SiteController@getCategorias')->name('site.categoria');
    Route::get('/ganhos', 'SiteController@getGanhos')->name('site.ganho');
    Route::get('/gastos', 'SiteController@getGastos')->name('site.gasto');
    Route::get('/pagamentos', 'SiteController@getPagamentos')->name('site.pagamento');
    Route::get('/metas', 'SiteController@getMetas')->name('site.meta');
});


Route::resource('categoria', CategoriaController::class);
Route::resource('ganho', GanhoController::class);
Route::resource('gasto', GastoController::class);
Route::resource('pagamento', PagamentoController::class);
Route::resource('meta', MetaController::class);

Route::get('/chart', [ReportController::class, 'showPizza'])->name('pizza');
Route::get('/chartFP', [ReportController::class, 'showPizzaFP'])->name('pizzafp');

Route::get('/pdf', 'PdfController@geraPdf')->name('pdf');