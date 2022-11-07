<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ClinicController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\StudyController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\PictureController;



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




//Clinic
Route::get('clinics', [ClinicController::class, 'list']);
Route::post('clinic-create', [ClinicController::class, 'save']);
Route::get('clinic/{id}', [ClinicController::class, 'view']);
Route::get('clinic/delete/{id}', [ClinicController::class, 'delete']);
Route::post('clinic/edit/{id}', [ClinicController::class, 'edit']);


//Doctor
Route::get('doctors', [DoctorController::class, 'list']);
Route::post('doctor-create', [DoctorController::class, 'save']);
Route::get('doctor/{id}', [DoctorController::class, 'view']);
Route::get('doctor/delete/{id}', [DoctorController::class, 'delete']);
Route::post('doctor/edit/{id}', [DoctorController::class, 'edit']);


//Blog
Route::get('blogs', [BlogController::class, 'list']);
Route::post('blog-create', [BlogController::class, 'save']);
Route::get('blog/{id}', [BlogController::class, 'view']);
Route::get('blog/delete/{id}', [BlogController::class, 'delete']);
Route::post('blog/edit/{id}', [BlogController::class, 'edit']);


//Certificate
Route::get('certificates', [CertificateController::class, 'list']);
Route::post('certificate-create', [CertificateController::class, 'save']);
Route::get('certificate/{id}', [CertificateController::class, 'view']);
Route::get('certificate/delete/{id}', [CertificateController::class, 'delete']);
Route::post('certificate/edit/{id}', [CertificateController::class, 'edit']);


//Study
Route::get('studies', [StudyController::class, 'list']);
Route::post('study-create', [StudyController::class, 'save']);
Route::get('study/{id}', [StudyController::class, 'view']);
Route::get('study/delete/{id}', [StudyController::class, 'delete']);
Route::post('study/edit/{id}', [StudyController::class, 'edit']);


//Picture
Route::get('pictures', [PictureController::class, 'list']);
Route::post('picture-create', [PictureController::class, 'save']);
Route::get('picture/{id}', [PictureController::class, 'view']);
Route::get('picture/delete/{id}', [PictureController::class, 'delete']);
Route::post('picture/edit/{id}', [PictureController::class, 'edit']);


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
