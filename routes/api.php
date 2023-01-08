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
use App\Http\Controllers\Api\DoctorUserController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\IdentityController;
use App\Http\Controllers\Api\IntroductionController;
use App\Http\Controllers\Api\NotificationController;
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
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\PageController;

use Illuminate\Support\Facades\Route;

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
    Route::get('categories', [CategoryController::class, 'pagination']);

    Route::post('category-create', [CategoryController::class, 'save']);
    Route::get('category/{id}', [CategoryController::class, 'view']);
    Route::post('category/edit/{id}', [CategoryController::class, 'edit']);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete']);

    Route::get('categories-by-type/{type}', [CategoryController::class, 'getCategoryByType']);

    //faq
    Route::get('faq', [FaqController::class, 'pagination']);
    Route::post('faq-create', [FaqController::class, 'save']);
    Route::get('faq/{id}', [FaqController::class, 'view']);
    Route::get('faq/delete/{id}', [FaqController::class, 'delete']);

    //Clinic
    Route::get('clinics', [ClinicController::class, 'pagination']);
    Route::post('clinic-create', [ClinicController::class, 'save']);
    Route::get('clinic/{id}', [ClinicController::class, 'view']);
    Route::get('clinic/delete/{id}', [ClinicController::class, 'delete']);
    Route::post('clinic/edit/{id}', [ClinicController::class, 'edit']);

    Route::post('doctor/add-category/{doctor_id}', [CategoryController::class, 'addToDoctor']);

    Route::get('doctors/get-category', [CategoryController::class, 'getCategoriesForDoctors']);

    Route::get('get-doctors/{category_id}', [CategoryController::class, 'getDoctors']);

############################### section ################################
    Route::get('sections', [SectionController::class, 'pagination']);

    Route::post('section-create', [SectionController::class, 'save']);
    Route::get('section/{id}', [SectionController::class, 'view']);
    Route::post('section/update/{id}', [SectionController::class, 'edit']);
    Route::get('section/delete/{id}', [SectionController::class, 'delete']);

    //Blog
    Route::get('blogs', [BlogController::class, 'pagination']);
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
    Route::get('doctors', [DoctorController::class, 'pagination']);
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
    Route::get('questions', [QuestionController::class, 'pagination']);

    Route::post('question-create', [QuestionController::class, 'save']);
    Route::get('question/{id}', [QuestionController::class, 'view']);
    Route::post('question/update/{id}', [QuestionController::class, 'edit']);
    Route::get('question/delete/{id}', [QuestionController::class, 'delete']);

    Route::get('answers', [AnswerController::class, 'pagination']);

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

    //Certificate
    Route::get('certificates', [CertificateController::class, 'pagination']);

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
    Route::get('studies', [StudyController::class, 'pagination']);
    Route::post('study-create', [StudyController::class, 'save']);
    Route::get('study/{id}', [StudyController::class, 'view']);
    Route::get('study/delete/{id}', [StudyController::class, 'delete']);
    Route::post('study/edit/{id}', [StudyController::class, 'edit']);

//Introduction
    Route::get('introductions', [IntroductionController::class, 'pagination']);

    Route::post('introduction-create', [IntroductionController::class, 'save']);
    Route::get('introduction/{id}', [IntroductionController::class, 'view']);
    Route::get('introduction/delete/{id}', [IntroductionController::class, 'delete']);
    Route::post('introduction/edit/{id}', [IntroductionController::class, 'edit']);

    //Plan
    Route::get('plans', [PlanController::class, 'pagination']);
    Route::post('plan-create', [PlanController::class, 'save']);
    Route::get('plan/{id}', [PlanController::class, 'view']);
    Route::get('plan/delete/{id}', [PlanController::class, 'delete']);
    Route::post('plan/edit/{id}', [PlanController::class, 'edit']);

    //Notification
    Route::get('notifications', [NotificationController::class, 'pagination']);
    Route::post('notification-create', [NotificationController::class, 'save']);
    Route::get('notification/{id}', [NotificationController::class, 'view']);
    Route::get('notification/delete/{id}', [NotificationController::class, 'delete']);
    Route::post('notification/edit/{id}', [NotificationController::class, 'edit']);

    Route::post('send-noti', [NotificationController::class, 'sendNotiToUser']);

    Route::post('send-to-all', [NotificationController::class, 'sendNotiToAll']);

    Route::get('user-doctor/delete/{doctor_id}/{user_id}', [DoctorUserController::class, 'deletebyID']);

    Route::get('favorite/delete/{doctor_id}/{user_id}', [FavoriteController::class, 'deletebyID']);


        //Country
        Route::get('countries', [CountryController::class, 'list']);
        Route::post('country-create', [CountryController::class, 'save']);
        Route::get('country/{id}', [CountryController::class, 'view']);
        Route::get('country/delete/{id}', [CountryController::class, 'delete']);
        Route::post('country/edit/{id}', [CountryController::class, 'edit']);


        //City
        Route::get('cities', [CityController::class, 'list']);
        Route::post('city-create', [CityController::class, 'save']);
        Route::get('city/{id}', [CityController::class, 'view']);
        Route::get('city/delete/{id}', [CityController::class, 'delete']);
        Route::post('city/edit/{id}', [CityController::class, 'edit']);

        Route::get('cities/{country_id}', [CityController::class, 'getCitiesByCountry']);
});

//Favorite
Route::get('favorites', [FavoriteController::class, 'pagination']);
Route::post('favorite-create', [FavoriteController::class, 'save']);
Route::get('favorite/{id}', [FavoriteController::class, 'view']);

Route::post('favorite/edit/{id}', [FavoriteController::class, 'edit']);

//user_doctor
Route::get('user-doctor', [DoctorUserController::class, 'pagination']);
Route::post('user-doctor-create', [DoctorUserController::class, 'save']);
Route::get('user-doctor/{id}', [DoctorUserController::class, 'view']);

Route::post('user-doctor/edit/{id}', [DoctorUserController::class, 'edit']);

//File
Route::get('files', [FileController::class, 'pagination']);
Route::post('file-create', [FileController::class, 'save']);
Route::get('file/{id}', [FileController::class, 'view']);
Route::get('file/delete/{id}', [FileController::class, 'delete']);
Route::post('file/edit/{id}', [FileController::class, 'edit']);

//doctor

Route::post('doctor/add-review/{doctor_id}', [ReviewController::class, 'addToDoctor']);

Route::get('doctor/get-reviews/{doctor_id}', [ReviewController::class, 'getByDoctor']);

Route::get('doctor/get-reviews/{doctor_id}', [ReviewController::class, 'getByDoctor']);

// Route::get( 'blog/get-categories/{blog_id}', [ CategoryController::class, 'getByBlog' ]);

//Picture
Route::get('pictures', [PictureController::class, 'pagination']);
Route::post('picture-create', [PictureController::class, 'save']);
Route::get('picture/{id}', [PictureController::class, 'view']);
Route::get('picture/delete/{id}', [PictureController::class, 'delete']);
Route::post('picture/edit/{id}', [PictureController::class, 'edit']);

//Appointment
Route::get('appointments', [AppointmentController::class, 'pagination']);
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
Route::get('appointments-by-doctor/{doctor_id}', [AppointmentController::class, 'appointmentsByDoctor']);
Route::get('appointments-by-clinic/{clinic_id}', [AppointmentController::class, 'appointmentsByClinic']);


//Slider
Route::get('sliders', [SliderController::class, 'pagination']);
Route::post('slider-create', [SliderController::class, 'save']);
Route::get('slider/{id}', [SliderController::class, 'view']);
Route::get('slider/delete/{id}', [SliderController::class, 'delete']);
Route::post('slider/edit/{id}', [SliderController::class, 'edit']);

//Subscription
Route::get('subscriptions', [SubscriptionController::class, 'pagination']);
Route::post('subscription-create', [SubscriptionController::class, 'save']);
Route::get('subscription/{id}', [SubscriptionController::class, 'view']);
Route::get('subscription/delete/{id}', [SubscriptionController::class, 'delete']);
Route::post('subscription/edit/{id}', [SubscriptionController::class, 'edit']);

//Card
Route::get('cards', [CardController::class, 'pagination']);
Route::post('card-create', [CardController::class, 'save']);
Route::get('card/{id}', [CardController::class, 'view']);
Route::get('card/delete/{id}', [CardController::class, 'delete']);
Route::post('card/edit/{id}', [CardController::class, 'edit']);

//Relative
Route::get('relatives', [RelativeController::class, 'pagination']);
Route::post('relative-create', [RelativeController::class, 'save']);
Route::get('relative/{id}', [RelativeController::class, 'view']);
Route::get('relative/delete/{id}', [RelativeController::class, 'delete']);
Route::post('relative/edit/{id}', [RelativeController::class, 'edit']);

Route::get('my-relatives/{user_id}', [UserController::class, 'myRelatives']);

//Identity
Route::get('identities', [IdentityController::class, 'pagination']);
Route::post('identity-create', [IdentityController::class, 'save']);
Route::get('identity/{id}', [IdentityController::class, 'view']);
Route::get('identity/delete/{id}', [IdentityController::class, 'delete']);
Route::post('identity/edit/{id}', [IdentityController::class, 'edit']);

//Home
Route::get('home-page', [HomeController::class, 'homePage']);

//Reviews

Route::get('reviews', [ReviewController::class, 'test']);

Route::get('reviews', [ReviewController::class, 'pagination']);

Route::get('review/{id}', [ReviewController::class, 'view']);
Route::post('review/delete/{id}', [ReviewController::class, 'delete']);

Route::post('users/search', [UserController::class, 'search']);

############################### result ################################
Route::get('results', [ResultController::class, 'pagination']);

Route::get('result/{id}', [ResultController::class, 'view']);
Route::post('result/update/{id}', [ResultController::class, 'edit']);
Route::get('result/delete/{id}', [ResultController::class, 'delete']);

//check type of doctor

Route::get('check-type-doctor/{doctor_id}', [AppointmentController::class, 'checkType']);

Route::middleware(['auth:api'])->group(function () {

    //Doctor

    Route::post('doctor-create', [DoctorController::class, 'save']);
    Route::get('doctor/{id}', [DoctorController::class, 'view']);
    Route::get('doctor/delete/{id}', [DoctorController::class, 'delete']);
    Route::post('doctor/edit/{id}', [DoctorController::class, 'edit']);
    Route::post('doctors/search', [DoctorController::class, 'lookfor']);

    Route::post('result-create', [ResultController::class, 'save']);

    Route::get('my-subscriptions', [SubscriptionController::class, 'mySubscription']);

    Route::get('my-cards', [CardController::class, 'myCards']);

    Route::get('my-results', [ResultController::class, 'myResult']);

    Route::post('/review/edit/{id}', [ReviewController::class, 'edit']);
    Route::post('review-create', [ReviewController::class, 'save']);

    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('profile', [AuthController::class, 'profile']);

    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    //only those have manage_user permission will get access
    Route::get('/users', [UserController::class, 'pagination']);
    Route::post('/user-create', [UserController::class, 'save']);
    Route::get('/user/{id}', [AuthController::class, 'userProfile']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);
    Route::post('/user/update/{id}', [UserController::class, 'edit']);
    Route::post('/user/change-role/{id}', [UserController::class, 'changeRole']);

    //my favorites doctors
    Route::get('my-favorites', [UserController::class, 'myFavorites']);

    //my doctors
    Route::get('my-doctors', [UserController::class, 'myDoctors']);

    //only those have manage_role permission will get access
    Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
        Route::get('/roles', [RolesController::class, 'pagination']);
        Route::post('/role/create', [RolesController::class, 'store']);
        Route::get('/role/{id}', [RolesController::class, 'show']);
        Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
        Route::post('/role/change-permission/{id}', [RolesController::class, 'changePermissions']);

    });

    //only those have manage_permission permission will get access
    Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
        Route::get('/permissions', [PermissionController::class, 'pagination']);
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


 //pages

 Route::get('pages', [PageController::class, 'list']);
 Route::post('pages-create', [PageController::class, 'save']);
 Route::get('page/{id}', [PageController::class, 'view']);
 Route::get('page/delete/{id}', [PageController::class, 'delete']);
 Route::post('page/edit/{id}', [PageController::class, 'edit']);
