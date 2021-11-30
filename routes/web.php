<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuizTypeController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\McqController;
use Faker\Guesser\Name;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login-check', [LoginController::class, 'checkLogin'])->name('login.check');

// Forgot password
Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'postEmail'])->name('password.reset');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('password.get-token');
Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', [LoginController::class, 'successLogin'])->name('login.success');
    Route::get('logout', [LoginController::class, 'logOut'])->name('logout');

    Route::get('fetch-quiz-types', [QuizTypeController::class, 'fetchQuiztype'])->name('quiztype.fetch');
    Route::get('quiz-type', [QuizTypeController::class, 'getQuizTypeForm'])->name('quiz.type');
    Route::post('quiz-type-submit', [QuizTypeController::class, 'submitQuizType'])->name('quiztype.submit');
    Route::get('edit-quiz-type/{id}', [QuizTypeController::class, 'editQuizType'])->name('quiztype.edit');
    Route::put('update-quiz-type/{id}', [QuizTypeController::class, 'updateQuizType'])->name('quiztype.update');
    Route::delete('delete-quiz-type/{id}', [QuizTypeController::class, 'destroy'])->name('quiztype.delete');

    Route::get('fetch-quiz-data', [QuizController::class, 'fetchQuizData'])->name('quizdata.fetch');
    Route::get('view-quiz', [QuizController::class, 'getQuizForm'])->name('quiz.view');
    Route::post('quiz-submit', [QuizController::class, 'submitQuiz'])->name('quiz.add');
    Route::get('edit-quiz/{id}', [QuizController::class, 'editQuiz'])->name('quiz.edit');
    Route::put('update-quiz/{id}', [QuizController::class, 'updateQuiz'])->name('quiz.update');
    Route::delete('delete-quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.delete');

    Route::get('view-contest/{id}', [McqController::class, 'getContestView'])->name('contest.view');

    Route::put('update-answer', [McqController::class, 'updateAnswer'])->name('update.answer'); 

    Route::get('view-mcq', [McqController::class, 'getMcqForm'])->name('mcq.view');
    Route::post('mcq-submit', [McqController::class, 'submitMcq'])->name('mcq.submit');
});