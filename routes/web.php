<?php

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

Route::get('/welcome', function () {
  return view('welcome');
});

Route::get('/', function () {
  return view('index');
});
Route::get('/about', function () {
  return view('about');
});
Route::get('/campaigns', function () {
  return view('campaigns');
});

Route::get('/campaign-detail', function () {
  return view('campaign-detail');
});

Route::get('/register', function () {
  return view('register');
});
Route::get('/login', function () {
  return view('login');
});

Route::get('/dashboard', function () {
  return view('dashboard');
});


Route::get('/template', function () {
  return view('template');
});
Route::get('/template2', function () {
  return view('template2');
});
