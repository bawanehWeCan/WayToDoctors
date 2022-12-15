<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ClinicController;
use App\Http\Controllers\Api\CountriesController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IdentityController;
use App\Http\Controllers\Api\IntroductionController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PictureController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\RelativeController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\StudyController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\ChangeLang;

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

Route::post('/user-update', [AuthController::class, 'updateProfile']);

Route::post('/otb-check', [AuthController::class, 'check']);

Route::post('/password-otb', [AuthController::class, 'password']);

Route::post('change-password', [AuthController::class, 'changePassword']);


Route::post('delete-user/{id}', [AuthController::class, 'delete']);

Route::post('phone-update/{id}', [AuthController::class, 'updatePhone']);
Route::post('resend-otp/{id}', [AuthController::class, 'resendOTP']);





Route::middleware('changeLang')->group(function () {

    // cat

    //only those have manage_user permission will get access

    Route::get('categories', [CategoryController::class, 'list']);
    Route::post('category-create', [CategoryController::class, 'save']);
    Route::get('category/{id}', [CategoryController::class, 'view']);
    Route::post('category/edit/{id}', [CategoryController::class, 'edit']);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete']);


    Route::get('categories-by-type/{type}', [CategoryController::class, 'getCategoryByType']);


    //faq
    Route::get('faq', [FaqController::class, 'list']);
    Route::post('faq-create', [FaqController::class, 'save']);
    Route::get('faq/{id}', [FaqController::class, 'view']);
    Route::get('faq/delete/{id}', [FaqController::class, 'delete']);

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
    Route::post('doctors/search', [DoctorController::class, 'lookfor']);

    Route::post('doctor/add-category/{doctor_id}', [CategoryController::class, 'addToDoctor']);

    Route::get('doctors/get-category', [CategoryController::class, 'getCategoriesForDoctors']);

    Route::get('get-doctors/{category_id}', [CategoryController::class, 'getDoctors']);

############################### section ################################
    Route::get('sections', [SectionController::class, 'list']);
    Route::post('section-create', [SectionController::class, 'save']);
    Route::get('section/{id}', [SectionController::class, 'view']);
    Route::post('section/update/{id}', [SectionController::class, 'edit']);
    Route::get('section/delete/{id}', [SectionController::class, 'delete']);

    //Blog
    Route::get('blogs', [BlogController::class, 'list']);
    Route::post('blog-create', [BlogController::class, 'save']);
    Route::get('blog/{id}', [BlogController::class, 'view']);
    Route::get('blog/delete/{id}', [BlogController::class, 'delete']);
    Route::post('blog/edit/{id}', [BlogController::class, 'edit']);
    Route::get('blogs-lists', [BlogController::class, 'getLists']);

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
    Route::post('doctors/search', [DoctorController::class, 'lookfor']);

    Route::post('doctor/add-category/{doctor_id}', [CategoryController::class, 'addToDoctor']);

    Route::get('doctors/get-category', [CategoryController::class, 'getCategoriesForDoctors']);

    Route::get('get-doctors/{category_id}', [CategoryController::class, 'getDoctors']);


    Route::post('blog/add-category/{blog_id}', [CategoryController::class, 'addToBlog']);


    Route::get('blog/get-blogs/{category_id}', [CategoryController::class, 'getBlogs']);

    Route::get('random-blogs', [BlogController::class, 'randomBlogs']);

############################### question ################################
    Route::get('questions', [QuestionController::class, 'list']);
    Route::post('question-create', [QuestionController::class, 'save']);
    Route::get('question/{id}', [QuestionController::class, 'view']);
    Route::post('question/update/{id}', [QuestionController::class, 'edit']);
    Route::get('question/delete/{id}', [QuestionController::class, 'delete']);

############################### answer ################################

    ############################### section ################################
    Route::get('sections', [SectionController::class, 'list']);
    Route::post('section-create', [SectionController::class, 'save']);
    Route::get('section/{id}', [SectionController::class, 'view']);
    Route::post('section/update/{id}', [SectionController::class, 'edit']);
    Route::get('section/delete/{id}', [SectionController::class, 'delete']);



    //Blog
    Route::get('blogs', [BlogController::class, 'list']);
    Route::post('blog-create', [BlogController::class, 'save']);
    Route::get('blog/{id}', [BlogController::class, 'view']);
    Route::get('blog/delete/{id}', [BlogController::class, 'delete']);
    Route::post('blog/edit/{id}', [BlogController::class, 'edit']);
    Route::get('blogs-lists', [BlogController::class, 'getLists']);

    Route::post('blog/add-category/{blog_id}', [CategoryController::class, 'addToBlog']);

    Route::get('blog/get-blogs/{category_id}', [CategoryController::class, 'getBlogs']);


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


    //Study
    Route::get('studies', [StudyController::class, 'list']);
    Route::post('study-create', [StudyController::class, 'save']);
    Route::get('study/{id}', [StudyController::class, 'view']);
    Route::get('study/delete/{id}', [StudyController::class, 'delete']);
    Route::post('study/edit/{id}', [StudyController::class, 'edit']);

    Route::get('introductions', [IntroductionController::class, 'list']);
    Route::post('introduction-create', [IntroductionController::class, 'save']);
    Route::get('introduction/{id}', [IntroductionController::class, 'view']);
    Route::get('introduction/delete/{id}', [IntroductionController::class, 'delete']);
    Route::post('introduction/edit/{id}', [IntroductionController::class, 'edit']);

     //Plan
    Route::get('plans', [PlanController::class, 'list']);
    Route::post('plan-create', [PlanController::class, 'save']);
    Route::get('plan/{id}', [PlanController::class, 'view']);
    Route::get('plan/delete/{id}', [PlanController::class, 'delete']);
    Route::post('plan/edit/{id}', [PlanController::class, 'edit']);

    //Notification
    Route::get('notifications', [NotificationController::class, 'list']);
    Route::post('notification-create', [NotificationController::class, 'save']);
    Route::get('notification/{id}', [NotificationController::class, 'view']);
    Route::get('notification/delete/{id}', [NotificationController::class, 'delete']);
    Route::post('notification/edit/{id}', [NotificationController::class, 'edit']);

    Route::post('send-noti', [NotificationController::class, 'sendNotiToUser']);

    Route::post('send-to-all', [NotificationController::class, 'sendNotiToAll']);


//doctor

Route::post('doctor/add-review/{doctor_id}', [ReviewController::class, 'addToDoctor']);

Route::get('doctor/get-reviews/{doctor_id}', [ReviewController::class, 'getByDoctor']);







Route::get('doctor/get-reviews/{doctor_id}', [ReviewController::class, 'getByDoctor']);

// Route::get( 'blog/get-categories/{blog_id}', [ CategoryController::class, 'getByBlog' ]);

//Picture
Route::get('pictures', [PictureController::class, 'list']);
Route::post('picture-create', [PictureController::class, 'save']);
Route::get('picture/{id}', [PictureController::class, 'view']);
Route::get('picture/delete/{id}', [PictureController::class, 'delete']);
Route::post('picture/edit/{id}', [PictureController::class, 'edit']);

//Appointment
Route::get('appointments', [AppointmentController::class, 'list']);
Route::post('appointment-create', [AppointmentController::class, 'save']);
Route::get('appointment/{id}', [AppointmentController::class, 'view']);
Route::get('appointment/delete/{id}', [AppointmentController::class, 'delete']);
Route::post('appointment/edit/{id}', [AppointmentController::class, 'edit']);

Route::get('appointments-next', [AppointmentController::class, 'nextAppointmentList']);
Route::get('appointments-finished', [AppointmentController::class, 'finishedAppointmentList']);
Route::get('appointments-canceled', [AppointmentController::class, 'canceledAppointmentList']);

Route::get('my-next/{user_id}', [AppointmentController::class, 'myNextAppointments']);
Route::get('my-finished/{user_id}', [AppointmentController::class, 'myFinishedAppointments']);
Route::get('my-canceled/{user_id}', [AppointmentController::class, 'myCanceledAppointments']);
Route::get('my-appointments/{user_id}', [AppointmentController::class, 'myAppointments']);


//Slider
Route::get('sliders', [SliderController::class, 'list']);
Route::post('slider-create', [SliderController::class, 'save']);
Route::get('slider/{id}', [SliderController::class, 'view']);
Route::get('slider/delete/{id}', [SliderController::class, 'delete']);
Route::post('slider/edit/{id}', [SliderController::class, 'edit']);

//Subscription
Route::get('subscriptions', [SubscriptionController::class, 'list']);
Route::post('subscription-create', [SubscriptionController::class, 'save']);
Route::get('subscription/{id}', [SubscriptionController::class, 'view']);
Route::get('subscription/delete/{id}', [SubscriptionController::class, 'delete']);
Route::post('subscription/edit/{id}', [SubscriptionController::class, 'edit']);

//Card
Route::get('cards', [CardController::class, 'list']);
Route::post('card-create', [CardController::class, 'save']);
Route::get('card/{id}', [CardController::class, 'view']);
Route::get('card/delete/{id}', [CardController::class, 'delete']);
Route::post('card/edit/{id}', [CardController::class, 'edit']);

//Relative
Route::get('relatives', [RelativeController::class, 'list']);
Route::post('relative-create', [RelativeController::class, 'save']);
Route::get('relative/{id}', [RelativeController::class, 'view']);
Route::get('relative/delete/{id}', [RelativeController::class, 'delete']);
Route::post('relative/edit/{id}', [RelativeController::class, 'edit']);

//Identity
Route::get('identities', [IdentityController::class, 'list']);
Route::post('identity-create', [IdentityController::class, 'save']);
Route::get('identity/{id}', [IdentityController::class, 'view']);
Route::get('identity/delete/{id}', [IdentityController::class, 'delete']);
Route::post('identity/edit/{id}', [IdentityController::class, 'edit']);

//Home
Route::get('home-page', [HomeController::class, 'homePage']);

//Reviews

Route::get('reviews', [ReviewController::class, 'test']);

Route::get('reviews', [ReviewController::class, 'list']);

Route::get('review/{id}', [ReviewController::class, 'view']);
Route::post('review/delete/{id}', [ReviewController::class, 'delete']);

Route::post('users/search', [UserController::class, 'search']);

############################### result ################################
Route::get('results', [ResultController::class, 'list']);

Route::get('result/{id}', [ResultController::class, 'view']);
Route::post('result/update/{id}', [ResultController::class, 'edit']);
Route::get('result/delete/{id}', [ResultController::class, 'delete']);

Route::middleware(['auth:api'])->group(function () {

    Route::post('result-create', [ResultController::class, 'save']);

    Route::get('my-subscriptions', [SubscriptionController::class, 'mySubscription']);

    Route::get('my-cards', [CardController::class, 'myCards']);

    Route::get('my-results', [ResultController::class, 'myResult']);

    Route::post('/review/edit/{id}', [ReviewController::class, 'edit']);
    Route::post('review-create', [ReviewController::class, 'save']);

    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    //only those have manage_user permission will get access
    Route::get('/users', [UserController::class, 'list']);
    Route::post('/user-create', [UserController::class, 'save']);
    Route::get('/user/{id}', [AuthController::class, 'profile']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);
    Route::post('/user/update/{id}', [UserController::class, 'edit']);
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

// Route::get('certificates', [CertificateController::class, 'list']);
// Route::post('certificate-create', [CertificateController::class, 'save']);
// Route::get('certificate/{id}', [CertificateController::class, 'profile']);
// Route::get('certificate/delete/{id}', [CertificateController::class, 'delete']);
Route::get('country-list', [CountriesController::class, 'getCountries']);
