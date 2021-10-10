<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;


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
    return view('auth.login');
});

/*Route::get('/funcionarios', function(){
    return view('funcionarios.index');
});
Route::get('/funcionarios/create',[FuncionarioController::class, 'create']);*/

Route::resource('funcionarios', FuncionarioController::class)->middleware('auth');

Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [FuncionarioController::class, 'index'])->name('home');

Route::group(['middleware' =>'auth'], function(){

    Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('index');
});
