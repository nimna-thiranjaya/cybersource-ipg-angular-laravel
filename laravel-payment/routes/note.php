<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/addnote', [NoteController::class, 'addnote']) -> name('addnote');

//delete note
Route::get('/deletenote/{id}', [NoteController::class, 'deletenote']) -> name('deletenote');
Route::get('/restore-publish/{id}', [NoteController::class, 'restorepublish']) -> name('restorepublish');
Route::get('/restore-draft/{id}', [NoteController::class, 'restoredraft']) -> name('restoredraft');
Route::get('/add-favorite/{id}', [NoteController::class, 'addfavorite']) -> name('addfavorite');
Route::get('/add-unfavorite/{id}', [NoteController::class, 'addUnfavorite']) -> name('addUnfavorite');
Route::post('/updatenote/{id}', [NoteController::class, 'updatenote']) -> name('updatenote');
Route::get('/get-specific-note/{id}', [NoteController::class, 'getSpecificNote']) -> name('getSpecificNote');
Route ::get ('/deletepermently/{id}', [NoteController::class, 'deletepermently'])->name('deletepermently');