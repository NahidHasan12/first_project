<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\admitController;
use App\Http\Controllers\curdController;

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

Route::get('/jquery', function(){
    return view('jquery');
});
Route::get('/ajax', function(){
    return view('ajax');
});

Route::get('/ajax/data',[AjaxController::class, 'test'])->name('ajax.data');

Route::get('/form', function(){
    return view('ajax_form');
});
Route::post('/form/store',[AjaxController::class, 'store'])->name('form.store');

Route::get('/admit',[admitController::class, 'view']);
Route::post('/admit/store',[admitController::class, 'store'])->name('admit.store');
Route::post('/admit/read',[admitController::class, 'read'])->name('admit.read');
Route::post('/admit/edit',[admitController::class, 'edit'])->name('admit.edit');
Route::post('/admit/boardSelect',[admitController::class, 'boardSelect'])->name('admit.boardSelect');
Route::post('/admit/studentSession',[admitController::class, 'studentSession'])->name('admit.studentSession');
Route::post('/admit/update',[admitController::class, 'update'])->name('admit.update');
Route::post('/admit/delete',[admitController::class, 'delete'])->name('admit.delete');


  //=========================//
 //         CURD            //
//=========================//
Route::middleware('auth')->group(function(){
Route::get('/curd',[curdController::class, 'view']);
Route::post('/curd/store',[curdController::class, 'store'])->name('curd.store');
Route::post('/curd/read',[curdController::class, 'read'])->name('curd.read');
Route::post('/curd/edit',[curdController::class, 'edit'])->name('curd.edit');
Route::post('/curd/selectDpt',[curdController::class, 'selectDpt'])->name('curd.selectDpt');
Route::post('/curd/update',[curdController::class, 'update'])->name('curd.update');
Route::post('/curd/delete',[curdController::class, 'delete'])->name('curd.delete');
});
