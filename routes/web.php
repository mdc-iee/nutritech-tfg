<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RecipeController;

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

// VIEWS
Route::view('/login', "login")->name('login');
Route::view('/registro', "register")->name('registro');
// "->middleware('auth')" will avoid to enter the page by writing in the route
Route::view('/home', 'home')->middleware('auth')->name('home');
Route::view('/recipeForm', 'recipeForm')->middleware('auth')->name('recipeForm');
Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');

// RECIPES
Route::get('/recipe/create', [RecipeController::class, 'create'])->middleware('auth')->name('recipeForm');
Route::post('/recipe/store', [RecipeController::class, 'storeIngredient'])->middleware('auth')->name('recipes-store');

// PROFILE
Route::put('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('perfil-update');
Route::put('/perfil-update', [UserController::class, 'update'])->name('perfil-update');

// LOGIN
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
