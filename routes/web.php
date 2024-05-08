<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApoyoController;
use App\Http\Controllers\AprendicesController;
use App\Http\Controllers\AprendizController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PracticaController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [LoginController::class, 'index'])->middleware(['auth', 'verified'])->name('login');
//-------------------------------------------ADMIN----------------------------------------------
Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified', 'auth.redirect', 'rol.admin'])->name('admin.index');

//-------------------------------------------APOYO----------------------------------------------
Route::get('/apoyo', [ApoyoController::class, 'index'])->middleware(['auth', 'verified', 'auth.redirect', 'rol.apoyo'])->name('apoyo.index');

//Importar aprendices
Route::get('/aprendices', [AprendicesController::class, 'index'])->name('fichas.aprendices');
Route::post('/aprendices/importar', [AprendicesController::class, 'importar']);
//Crear fichas
Route::get('/fichas/create', [FichaController::class, 'create'])->name('fichas.create');

//-------------------------------------------APRENDIZ----------------------------------------------
Route::get('/aprendiz', [AprendizController::class, 'index'])->middleware(['auth', 'verified', 'auth.redirect', 'rol.aprendiz'])->name('aprendiz.index');

//-------------------------------------------INSTRUCTOR----------------------------------------------
Route::get('/instructor', [InstructorController::class, 'index'])->middleware(['auth', 'verified', 'auth.redirect', 'rol.instructor'])->name('instructor.index');


//-------------------------------------------PRACTICA----------------------------------------------
Route::get('/practica', [PracticaController::class, 'index'])->middleware(['auth', 'verified', 'auth.redirect', 'rol.practica'])->name('practica.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
