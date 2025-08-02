<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('fetch-issues', 'FetchAllIssues')->name('fetch.all.issues');
    Route::post('fetch-my-issues', 'FetchMyIssues')->name('fetch.my.issues');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact', 'sendContactForm')->name('contact.send');
    Route::get('my-issues', 'UserIssue')->name('my_issues');
    Route::get('issues/{uri}', 'IssueView')->name('issue.view');
    Route::get('new-issues', 'ReportIssueView')->name('issue.report');
    Route::post('issues/save', 'ReportIssue')->name('issue.save');
    Route::get('profile', 'Profile')->name('profile');
});
Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'loginView')->name('login');
    Route::get('logout', 'logout')->name('logout');
    Route::get('register', 'registerView')->name('register');
    Route::post('login', 'login')->name('login.submit');
    Route::post('register', 'register')->name('register.submit');
    Route::get('password-reset', 'resetPasswirdView')->name('password.reset');
    Route::get('verify-email', 'verifyEmail')->name('verify.email');
});