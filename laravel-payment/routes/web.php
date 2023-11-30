<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::redirect('/', '/dashboard');
Route::get('/', [WebController::class, 'login']) -> name('login');
Route::get('/payment', [WebController::class, 'payment']) -> name('Payment');

Route::get('/register', [WebController::class, 'register']) -> name('register');
Route::get('/dashboard', [WebController::class, 'dashboard']) -> name('dashboard');
Route::get('/favourites', [WebController::class, 'favourites']) -> name('favourites');
Route::get('/addnote', [WebController::class, 'addnote']) -> name('addnote');
Route::get('/dashboard/viewnotes/{id}', [WebController::class, 'viewnotes']) -> name('viewnotes');
Route::get('/drafts', [WebController::class, 'drafts']) -> name('drafts');
Route::get('/trash', [WebController::class, 'trash']) -> name('trash');
// Route::get('/editnote', [WebController::class, 'editnote']) -> name('editnote');
Route::get('/update-note/{id}', [WebController::class, 'updateNote']) -> name('updateNote');
