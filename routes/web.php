<?php

use App\Http\Controllers\ContactContoller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;

// cache clear
Route::get('/clear', function() {
  Auth::logout();
  session()->flush();
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('config:cache');
  Artisan::call('view:clear');
  return "Cleared!";
});

 Route::fallback(function () {
    return redirect('/');
});

require __DIR__.'/admin.php';

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::get('/content-search', [FrontendController::class, 'searchContent'])->name('content.search');
Route::get('/type/{type}', [FrontendController::class, 'type'])->name('content.type');
Route::get('/{type}-details/{slug}', [FrontendController::class, 'contentDetails'])->name('content.show');

Route::get('/service/{slug}', [FrontendController::class, 'serviceDetails'])->name('service.show');

Route::get('/content/{type}/category/{slug}', [FrontendController::class, 'categoryContents'])->name('content.category');

Route::get('/content/{type}/tag/{slug}', [FrontendController::class, 'tagContents'])->name('content.tag');

Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'storeContact'])->name('contact.store');

Route::get('/team', [FrontendController::class, 'team'])->name('team');

Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-and-conditions', [FrontendController::class, 'termsAndConditions'])->name('terms-and-conditions');
Route::get('/frequently-asked-questions', [FrontendController::class, 'frequentlyAskedQuestions'])->name('faq');

Route::get('gallery', [FrontendController::class, 'gallery'])->name('gallery');
Route::get('/checkout/{plan}', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/checkout-success/{plan}/{session_id}', [FrontendController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/checkout-cancel', [FrontendController::class, 'checkoutCancel'])->name('checkout.cancel');
Route::post('/subscribe', [FrontendController::class, 'subscribeNewsletter'])->name('subscribe.newsletter');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::group(['prefix' =>'manager/', 'middleware' => ['auth', 'is_manager']], function(){
    Route::get('/dashboard', [HomeController::class, 'managerHome'])->name('manager.dashboard');
});

Route::group(['prefix' =>'user/', 'middleware' => ['auth', 'is_user']], function(){
    Route::get('/dashboard', [HomeController::class, 'userHome'])->name('user.dashboard');
});