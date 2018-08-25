<?php

// Show Index
Route::get('/{locale}/{encode}', 'Controller@Show_welcome_encode');
// List View
Route::get('/{locale}/{encode}/{list}', 'View_Data@List_View');
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
// Logout
Route::get('/Logout', 'Login@Logout');
// Create Link
Route::get('/Create_Link', 'Login@Create_Link');
// Process Create Link
Route::post('/Do_create_link', 'Login@Do_create_link');
// View_Information
Route::get('/View_Information', 'Controller@View_Information');
// User Page
Route::get('/User', 'Login@User');
// 404 Error Page
Route::get('/404', function () {
	return view('404');
});
// Table Show
Route::get('/Table_View', 'View_Data@Table_View');
