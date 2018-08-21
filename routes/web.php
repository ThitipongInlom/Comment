<?php

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

// Show Index
Route::get('/{locale}/{encode}', 'Controller@Show_welcome_encode');
// Save Data
Route::post('/Save_Data', 'Controller@Save_Data');
// Main Admin Page
Route::get('/Admin', function () {
    return view('admin');
});
// Do_login 
Route::post('/Do_login', 'Login@Do_login');
// Dashboard
Route::get('/Dashboard', 'Login@Dashboard');
// Star Program
Route::get('/Star', 'Login@Star');
// Logout
Route::get('/Logout', 'Login@Logout');
// Create Link
Route::get('/Create_Link', 'Login@Create_Link');
