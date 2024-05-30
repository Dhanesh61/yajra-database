<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/data', [StudentController::class, 'data'])->name('students.data');
Route::get('students/emails', [StudentController::class,'getEmails'])->name('students.emails');