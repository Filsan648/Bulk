<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRcodeGenerateController;
use App\Http\Controllers\bulk;
use App\Http\Controllers\addition;


Route::get('/Homef', [bulk::class,'Homef'])->name('Homef')->middleware('auth');

Route::get('/form', [bulk::class,'form_get'])->name('form_get')->middleware('auth');
Route::post('/form', [bulk::class,'form_post'])->name('form_post')->middleware('auth');

Route::get('/form/affiche', [bulk::class,'formaffiche_get'])->name('formaffiche_get')->middleware('auth');
Route::post('/form_affiche', [bulk::class,'formaffiche_post'])->name('formaffiche_post')->middleware('auth');

Route::get('/client', [bulk::class,'client_get'])->name('client_get')->middleware('auth');
Route::post('/take-screenshot', [QRcodeGenerateController::class,'takeScreenshot'])->name('take-screenshot')->middleware('auth');

Route::get('/', [bulk::class,'login_get'])->name('login_get');
Route::post('/', [bulk::class,'login_post'])->name('login_post');
Route::get('/navbar', [bulk::class,'navbar'])->name('navbar')->middleware('auth');

Route::get('/client', [bulk::class,'client_get'])->name('client_get')->middleware('auth');
Route::post('/client', [bulk::class,'client_post'])->name('client_post')->middleware('auth');

Route::get('/Imprimer/{id}', [bulk::class,'Imprimer'])->name('Imprimer')->middleware('auth');
Route::get('/Refernce_entrer/{id}', [bulk::class,'Refernce_entrer'])->name('Refernce_entrer')->middleware('auth');
Route::get('/forget_password', [bulk::class,'forget_password'])->name('forget_password')->middleware('auth');
Route::post('/forget_password', [bulk::class,'forget_password_post'])->name('forget_password_post')->middleware('auth');
Route::get('/update_password', [bulk::class,'update_password_get'])->name('update_password_get')->middleware('auth');

Route::post('/update_password', [bulk::class,'update_password_post'])->name('update_password_post')->middleware('auth');
Route::post('/logout', [bulk::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/updat_password', [bulk::class, 'updat_password'])->name('updat_password')->middleware('auth');
Route::post('/updat_password_post', [bulk::class, 'updat_password_post'])->name('updat_password_post')->middleware('auth');

Route::get('/pen_entry/{id}', [bulk::class, 'pen_entry'])->name('pen_entry')->middleware('auth');
Route::get('/pen_exit/{id}', action: [bulk::class, 'pen_exit'])->name('pen_exit')->middleware('auth');

Route::put('/update_reference_entry/{id}',  [bulk::class, 'updat_entry'])->name('update_reference_entry')->middleware('auth');
Route::put('/update_reference_exit', [bulk::class, 'updat_exit'])->name('updat_exit')->middleware('auth');
Route::delete('/pessageentrydelete/{id}{ref}', [bulk::class, 'destroy'])->name('pessage.destroy');
Route::get('/Rechercher', [addition::class, 'Rechercher'])->name('Rechercher')->middleware('auth');
Route::post('/Rechercher', [addition::class, 'Rechercher_post'])->name('Rechercher_post')->middleware('auth');
Route::delete('/pessageentrydelete/{id}{ref}', [bulk::class, 'destroy'])->name('pessage.destroy');
Route::get('/Bar_chart', [addition::class, 'Bar_chart'])->name('Bar_chart');
Route::get('/Stock', [addition::class, 'Stock'])->name('stock');
Route::put('/Stock/{id}', action: [addition::class, 'post_Stock'])->name('post_stock');
Route::get('/Stock/Affiche{id}', [addition::class, 'Stockaffiche'])->name('stockaffiche');
Route::get('/select/month',[addition::class, 'mont'])->name('mont');

Route::post('/select/month',[addition::class, 'montpost'])->name('montpost');


