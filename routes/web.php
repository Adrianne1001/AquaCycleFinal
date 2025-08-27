<?php

use App\Http\Controllers\AdminRewardExchangeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RewardExchangeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


Route::get('/',[LandingPageController::class,'index'])->name('Landing Page');
Route::get('/Article/{id}', [LandingPageController::class, 'showArticle'])->name('LandingPage.show');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth.redirect'])->group(function () {
    Route::get('/login', function () {
        return view('auth.login'); 
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register'); 
    })->name('register');
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('admin/dashboard',[HomeController::class,'admin']) -> middleware(['auth','verified','admin']);
Route::resource('reward', RewardController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('article', ArticleController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('user', UserController::class)->middleware(['auth', 'verified', 'admin']);
Route::resource('admin_reward_exchange', AdminRewardExchangeController::class)->middleware(['auth', 'verified', 'admin']);
Route::post('/claimRewardExchange/{id}', [AdminRewardExchangeController::class, 'claim'])->name('admin_reward_exchange.claim')->middleware(['auth', 'verified', 'admin']);
Route::post('/approveRewardExchange/{id}', [AdminRewardExchangeController::class, 'approve'])->name('admin_reward_exchange.approve')->middleware(['auth', 'verified', 'admin']);
Route::post('/rejectRewardExchange/{id}', [AdminRewardExchangeController::class, 'reject'])->name('admin_reward_exchange.reject')->middleware(['auth', 'verified', 'admin']);
Route::get('admin/RewardExchange/SuccessfulRedeems',[AdminRewardExchangeController::class,'SuccessfulRedeems']) -> middleware(['auth','verified','admin']);
Route::get('admin/RewardExchange/RejectedRequests',[AdminRewardExchangeController::class,'RejectedRequests']) -> middleware(['auth','verified','admin']);

Route::get('student/dashboard',[HomeController::class,'student']) -> middleware(['auth','verified','student']);
Route::resource('reward_exchange', RewardExchangeController::class)->middleware(['auth', 'verified', 'student']);
Route::get('student/RewardExchange/SuccessfulRedeems',[RewardExchangeController::class,'SuccessfulRedeems']) -> middleware(['auth','verified','student']);
Route::get('student/RewardExchange/RejectedRequests',[RewardExchangeController::class,'RejectedRequests']) -> middleware(['auth','verified','student']);
Route::resource('user_stats', UserStatsController::class)->middleware(['auth', 'verified', 'student']);
Route::resource('bottle_disposals', RewardExchangeController::class)->middleware(['auth', 'verified', 'student']);
// Route::prefix('admin')->middleware('auth:admin')->group(function () {
//     Route::resource('reward', RewardsController::class);
// });




require __DIR__.'/auth.php';
