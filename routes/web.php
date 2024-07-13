<?php

use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use \App\Http\Controllers\OfferController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/view-document', function () {
    if (!request('link')) {
        abort(404);
    }

    return view('view-document', ['link' => request('link')]);
})->name('view-document');


Route::get('/', [HomeController::class, 'index']);
Route::get('/offer/{id}',[HomeController::class,'show']);
Route::post('/offer/{id}',[HomeController::class,'apply']);
Route::get('/offer/apply/{id}',[HomeController::class,'apply']);
Route::get('/offers',[HomeController::class,'offers']);
Route::get('/contact',[HomeController::class,'contact']);
Route::post('/contact',[HomeController::class,'send_contact']);
Route::get('/privacy_policy',[HomeController::class,'privacy_policy']);

Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);

Route::get('lang/{locale}', [LocalizationController::class, 'index']);


//CV GENERATOR ROUTES
Route::get('/create/cv', [ResumeController::class, 'showForm'])->name('cv.create');
Route::post('/create/cv', [ResumeController::class, 'generateCv'])->name('cv.generate');
Route::post('/download/en-cv', [ResumeController::class, 'generateEnCv'])->name('en.cv.generate');

//Offers
Route::post('/offers/refresh', [OfferController::class, 'refreshID']);


