<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\CountriesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Auth
Route::post('login', [AuthController::class, 'login']);

Route::post('/user-reg', [AuthController::class, 'store']);

Route::post('/otb-check', [AuthController::class, 'check']);

Route::post('/password-otb', [AuthController::class, 'password']);

Route::post('change-password', [AuthController::class, 'changePassword']);


// cat

//only those have manage_user permission will get access
Route::get('categories', [CategoryController::class, 'list']);
Route::post('category-create', [CategoryController::class, 'store']);
Route::get('category/{id}', [CategoryController::class, 'profile']);
Route::get('category/delete/{id}', [CategoryController::class, 'delete']);


//Reviews

Route::get('reviews', [ReviewController::class, 'test']);

Route::get('reviews', [ReviewController::class, 'list']);


Route::get('review/{id}', [ReviewController::class, 'view']);
Route::post('review/delete/{id}', [ReviewController::class, 'delete']);

Route::get('faq', [FaqController::class, 'list']);
Route::post('faq-create', [FaqController::class, 'save']);
Route::get('faq/{id}', [FaqController::class, 'view']);
Route::get('faq/delete/{id}', [FaqController::class, 'delete']);


Route::post('users/search', [UserController::class, 'search']);

############################### section ################################
Route::get('sections', [SectionController::class, 'list']);
Route::post('section-create', [SectionController::class, 'save']);
Route::get('section/{id}', [SectionController::class, 'view']);
Route::post('section/update/{id}', [SectionController::class, 'edit']);
Route::get('section/delete/{id}', [SectionController::class, 'delete']);

############################### question ################################
Route::get('questions', [QuestionController::class, 'list']);
Route::post('question-create', [QuestionController::class, 'save']);
Route::get('question/{id}', [QuestionController::class, 'view']);
Route::post('question/update/{id}', [QuestionController::class, 'edit']);
Route::get('question/delete/{id}', [QuestionController::class, 'delete']);

############################### answer ################################
Route::get('answers', [AnswerController::class, 'list']);
Route::post('answer-create', [AnswerController::class, 'save']);
Route::get('answer/{id}', [AnswerController::class, 'view']);
Route::post('answer/update/{id}', [AnswerController::class, 'edit']);
Route::get('answer/delete/{id}', [AnswerController::class, 'delete']);

############################### result ################################
Route::get('results', [ResultController::class, 'list']);
Route::post('result-create', [ResultController::class, 'save']);
Route::get('result/{id}', [ResultController::class, 'view']);
Route::post('result/update/{id}', [ResultController::class, 'edit']);
Route::get('result/delete/{id}', [ResultController::class, 'delete']);

Route::middleware(['auth:api'])->group(function () {


    Route::post('/review/edit/{id}', [ReviewController::class, 'edit']);
    Route::post('review-create', [ReviewController::class, 'save']);

    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    //only those have manage_user permission will get access
    Route::get('/users', [UserController::class, 'list']);
    Route::post('/user-create', [UserController::class, 'store']);
    Route::get('/user/{id}', [UserController::class, 'profile']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);
    Route::post('/user/change-role/{id}', [UserController::class, 'changeRole']);

    //only those have manage_role permission will get access
    Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
        Route::get('/roles', [RolesController::class, 'list']);
        Route::post('/role/create', [RolesController::class, 'store']);
        Route::get('/role/{id}', [RolesController::class, 'show']);
        Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
        Route::post('/role/change-permission/{id}', [RolesController::class, 'changePermissions']);
    });


    //only those have manage_permission permission will get access
    Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
        Route::get('/permissions', [PermissionController::class, 'list']);
        Route::post('/permission/create', [PermissionController::class, 'store']);
        Route::get('/permission/{id}', [PermissionController::class, 'show']);
        Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
    });
});

Route::get('country-list', [CountriesController::class, 'getCountries']);
