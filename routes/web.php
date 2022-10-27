<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-or-update-game-details', [GameController::class, 'addOrUpdateGame'])->name('addOrUpdateGame');
Route::post('/get-game-details', [GameController::class, 'getGameDetails'])->name('getGameDetails');
Route::post('/add-or-update-question-details', [QuestionsController::class, 'addOrUpdateQuestion'])->name('addOrUpdateQuestion');
Route::post('/get-question-details', [QuestionsController::class, 'getQuestionDetails'])->name('getQuestionDetails');
Route::post('/add-or-update-option-details', [OptionController::class, 'addOrUpdateOption'])->name('addOrUpdateOption');
Route::post('/get-option-details', [OptionController::class, 'getOptionDetails'])->name('getOptionDetails');