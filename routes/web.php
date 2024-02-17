<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CsvFileController;
use App\Http\Controllers\FontController;
use App\Http\Controllers\ImageProcessing;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('event:clear');
    echo 'Cache Cleared';
});

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'signin')->name('authentication.signin');
    Route::get('/forget', 'forget')->name('authenticaion.forget');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/signin', 'signin')->name('authentication.login');
    Route::post('/reset-link', 'resetLink')->name('authentication.resetLink');
    Route::get('/reset-password/{email}', 'resetPassword')->name('authenticaion.reset');
    Route::post('/update_password', 'updatePassword')->name('authenticaion.update');
    Route::get('/auth/github/redirect', 'githubredirectToProvider')->name('login.github');
    Route::get('/auth/github/callback', 'githubhandleProviderCallback')->name('login.github.callback');
    Route::get('/auth/google/redirect', 'googleredirectToProvider')->name('login.google');
    Route::get('/auth/google/callback', 'googlehandleProviderCallback')->name('login.google.callback');
});

Route::group(["middleware" => ["authsecurity"]], function () {
    Route::controller(PagesController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard.dashboard');
        Route::get('/profile', 'profile')->name('dashboard.profile');
        Route::get('/profile_edit', 'editProfile')->name('dashboard.profile.edit');
        Route::put('/profile_update/{id}', 'updateProfile')->name('updateProfile');
        Route::put('/email_update/{id}', 'emailUpdate')->name('emailUpdate');
        Route::put('/password_update/{id}', 'passwordUpdate')->name('passwordUpdate');
    });

    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/logout', 'logout')->name('authenticaion.logout');
    });

    Route::controller(ImageProcessing::class)->group(function () {
        Route::get('/getting_csv_data/{file}', 'getting_csv_data');
        Route::get('/getting_font_effect/{font_family}', 'getting_font_effect');
        Route::post('/div', 'addDivToImage');
        Route::get('/getting-data/{title}', 'gettingData');
        Route::post('/image-making/', 'imageMaking');
        Route::post('/apply-text-position', 'applyTextPosition');
        Route::get('/all_templates', 'allTemplates');
        Route::post('/makeZipFile', 'makeZipFile');
        Route::get('/downlaod-zip', 'downloadZip');
    });

    Route::resources([
        'template' => TemplateController::class,
        'csv' => CsvFileController::class,
        'fonts' => FontController::class,
    ]);
    Route::controller(TemplateController::class)->group(function () {
        Route::get('/gettingData', 'gettingData');
        Route::get('/new-templates', 'newTemplates')->name('templates.new');
    });
    Route::controller(CsvFileController::class)->group(function () {
        Route::get('/download-csv/{filename}', 'downloadCsv')->name('download.csv');
    });
});
