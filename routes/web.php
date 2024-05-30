<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\myController;
use App\Http\Controllers\postController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReparationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [myController::class, 'acceuil'])->name('acceuil');
Route::get('/logout' , [myController::class, 'logout'])->name('logout') ;

// client root

Route::get('/dashboard' , [myController::class, 'dashboard'])->middleware('auth') ;
Route::get('/client/{id}' , [ClientController::class, 'client'])->name('client' , 'id')->whereAlphaNumeric('id')->middleware('auth') ;

Route::post('/recu' , [ClientController::class, 'recu'])->middleware('auth');

Route::get('/print/{id}/{date}' , [ClientController::class, 'print'])->name('print' , 'id' , 'date')->whereAlphaNumeric('id' , 'date')->middleware('auth') ;
Route::get('/clients' , [ClientController::class, 'clients'])->name('clients')->middleware('auth') ;
Route::get('/nouveau' , [ClientController::class, 'ajouter'])->name('ajouter')->middleware('auth') ;
Route::post('/search' , [ClientController::class, 'search'])->name('search')->middleware('auth') ;
Route::post('/nouveau' , [ClientController::class, 'store'])->name('store') ;
Route::get('/modify/{id}' , [ClientController::class, 'modify'])->name('modify' , 'id')->whereAlphaNumeric('id')->middleware('auth') ;
Route::post('/edit/{id}' , [ClientController::class, 'edit'])->name('edit' , 'id')->whereAlphaNumeric('id') ;
Route::get('/delete/{id}' , [ClientController::class, 'supprimer'])->name('delete' , 'id')->whereNumber('id')->middleware('auth') ;

//reparations root
Route::post('/client/filter/{id}' , [ReparationController::class , 'getFilteredRep'])->name('filter' , 'id')->whereAlphaNumeric('id');
Route::post('/client/{id}' , [ReparationController::class, 'addRep'])->name('addRep' , 'id')->whereAlphaNumeric('id') ;
Route::get('/deleteRep/{id}/{rep}' , [ReparationController::class, 'deleteRep'])->whereAlphaNumeric('id' , 'rep')->middleware('auth');
Route::post('/updateRep/{id}' , [ReparationController::class, 'updateRep'])->name('update','id');
Route::get('/editRep/{id}/{rep}' , [ReparationController::class, 'editRep'])->whereAlphaNumeric('id' , 'rep')->middleware('auth');
Route::get('stats' , [ReparationController::class, 'stats'])->name('stats')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
