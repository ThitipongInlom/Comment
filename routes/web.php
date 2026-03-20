<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyLinkController;
use App\Http\Controllers\SurveyResponseController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\HotelProfileController;
use App\Http\Controllers\SurveySectionController;
use App\Http\Controllers\SurveyQuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public survey routes
Route::get('/{locale}/{slug}', [SurveyController::class, 'show'])
    ->where('locale', 'en|th')
    ->where('slug', '[^/]+');

Route::post('/survey/submit', [SurveyController::class, 'store']);

// View submitted response (public)
Route::get('/{locale}/{slug}/{responseNumber}', [SurveyResponseController::class, 'show'])
    ->where(['locale' => 'en|th', 'responseNumber' => '[0-9]+']);

// Auth routes
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

// Admin routes (protected)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/survey-links', [SurveyLinkController::class, 'index']);
    Route::get('/survey-links/create', [SurveyLinkController::class, 'create']);
    Route::post('/survey-links', [SurveyLinkController::class, 'store']);
    Route::post('/survey-links/{surveyLink}/toggle', [SurveyLinkController::class, 'toggleStatus']);
    Route::get('/survey-links/{surveyLink}/responses', [SurveyLinkController::class, 'responses']);
    Route::get('/survey-sections', [SurveySectionController::class, 'index']);
    Route::post('/survey-sections', [SurveySectionController::class, 'store']);
    Route::put('/survey-sections/{surveySection}', [SurveySectionController::class, 'update']);
    Route::delete('/survey-sections/{surveySection}', [SurveySectionController::class, 'destroy']);
    Route::post('/survey-sections/reorder', [SurveySectionController::class, 'reorder']);
    Route::post('/survey-questions', [SurveyQuestionController::class, 'store']);
    Route::put('/survey-questions/{surveyQuestion}', [SurveyQuestionController::class, 'update']);
    Route::delete('/survey-questions/{surveyQuestion}', [SurveyQuestionController::class, 'destroy']);
    Route::post('/survey-questions/reorder', [SurveyQuestionController::class, 'reorder']);
    Route::get('/rooms', [RoomController::class, 'index']);
    Route::post('/rooms', [RoomController::class, 'store']);
    Route::put('/rooms/{room}', [RoomController::class, 'update']);
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy']);
    Route::get('/hotel-profiles', [HotelProfileController::class, 'index']);
    Route::post('/hotel-profiles', [HotelProfileController::class, 'store']);
    Route::post('/hotel-profiles/{hotelProfile}', [HotelProfileController::class, 'update']);
    Route::delete('/hotel-profiles/{hotelProfile}', [HotelProfileController::class, 'destroy']);
    Route::post('/hotel-profiles/{hotelProfile}/activate', [HotelProfileController::class, 'activate']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
});

// 404
Route::get('/404', fn () => Inertia::render('Error/NotFound'));

// Redirects
Route::get('/', fn () => redirect('/admin/login'));
Route::get('/admin', fn () => redirect('/admin/dashboard'));
