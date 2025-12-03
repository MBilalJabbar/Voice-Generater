<?php

use App\Http\Controllers\AddUserAdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentProof;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoiceGeneratorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashbaordController;
use App\Http\Controllers\GenrateAudioController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VoiceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\CloneVoiceController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Subscription;
use App\Models\Subscription as ModelsSubscription;

Route::get('/index', [DashbaordController::class, 'index'])->name('dashboard.index');
Route::get('/subscription', [PlanController::class, 'index'])->name('subscriptions.index');
Route::get('/genrate-audio', [GenrateAudioController::class, 'genrateaudio'])->name('genrateaudio.index');
Route::get('/genrate-bulk-audio', [GenrateAudioController::class, 'genrateBulkAudio'])->name('genrateaudio.bulkaudio');
Route::get('/task-history', [TaskController::class, 'taskhistory'])->name('taskhistory.index');
Route::get('/voices-Page', [VoiceController::class, 'index'])->name('voice.index');
Route::get('/clone-voice', [CloneVoiceController::class, 'index'])->name('clonevoice.index');
Route::get('/setting', [PagesController::class, 'setting'])->name('pages.setting');
Route::get('/profile', [PagesController::class, 'profile'])->name('pages.profile');
Route::get('/contact', [PagesController::class, 'contact'])->name('pages.contact');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard.index');
Route::get('/admin/payment-proof', [AdminController::class, 'payment'])->name('admin.payment.index');
// Route::get('/admin/plans/index', [AdminController::class, 'plansIndex'])->name('admin.plans.index');
Route::get('/admin/plans/create', [AdminController::class, 'plansCreate'])->name('admin.plans.create');
Route::get('/admin/plans/edit', [AdminController::class, 'plansEdit'])->name('admin.plans.Edit');
Route::get('/admin/voices/index', [AdminController::class, 'addvoices'])->name('admin.voices.index');
    Route::resource('admin/adduser', AddUserController::class);




// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
< -- =========================================Backend User Management====================================== -->
*/

Route::post('CreateUser', [UserController::class, 'CreateUser']);
Route::post('LoginUser', [UserController::class, 'LoginUser']);
Route::post('LogoutUser', [UserController::class, 'LogoutUser']);
// Login with Google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/complete-profile', function () {
    return view('auth.profileComplete');
})->name('complete-profile');

Route::post('/complete-profile', [GoogleController::class, 'updateCompleteProfile']);


Route::post('UpdateSetting', [PagesController::class, 'UpdateSetting']);


// Voice Generated Routes
Route::get('/voices-genai', [VoiceGeneratorController::class, 'fetchGenAIVoices']);
Route::post('/generateAudioVoice', [VoiceGeneratorController::class, 'generateAudioVoices'])->name('generateAudioVoice');

// Show Data in Dashboard
Route::get('/fetchVoices/{id}', [DashbaordController::class, 'fetchVoices']);
Route::post('/deletedVoice/{id}', [DashbaordController::class, 'deletedVoice']);

// Task History Routes
Route::post('/taskDeleted/{id}', [TaskController::class, 'taskDeleted']);
Route::get('/TaskShowModal/{id}', [TaskController::class, 'TaskShowModal']);

// Add User Admin Routes
Route::get('/CreateUserAdminPage', [AddUserAdminController::class, 'CreateUserAdminPage']);
Route::post('/CreateUserAdmin', [AddUserAdminController::class, 'CreateUserAdmin']);
Route::get('/editUserAdmin/{id}', [AddUserAdminController::class, 'editUserAdmin'])->name('editUserAdmin');
Route::put('/updateUserAdmin/{id}', [AddUserAdminController::class, 'updateUserAdmin'])->name('updateUserAdmin');
Route::delete('/deleteUserAdmin/{id}', [AddUserAdminController::class, 'deleteUserAdmin'])->name('deleteUserAdmin');
Route::get('/ShowUserAdminDetails/{id}', [AddUserAdminController::class, 'ShowUserAdminDetails']);

// Voice Clone User Dashboard
Route::post('/addVoiceClone', [CloneVoiceController::class, 'addVoiceClone'])->name('addVoiceClone');
Route::delete('/cloneVoiceDelete/{id}', [CloneVoiceController::class, 'cloneVoiceDelete'])->name('cloneVoiceDelete');
Route::get('/clone-voices', [CloneVoiceController::class, 'getCloneVoices']);


// Voice  Routes Admin Dashboard
Route::post('/createVoices', [AdminController::class, 'createVoices']);
Route::post('/editVoice/{id}', [AdminController::class, 'editVoice']);
Route::post('/deleteVoice/{id}', [AdminController::class, 'deleteVoice']);

// Admin Add Plans Section
Route::post('/storePlans', [PlanController::class, 'storePlans'])->name('storePlans');
Route::get('/showPlansTable', [PlanController::class, 'showPlansTable'])->name('showPlansTable');
Route::get('/editPlans/{id}', [PlanController::class, 'editPlans']);
Route::put('/updatePlans/{id}', [PlanController::class, 'updatePlans'])->name('plansUpdate');
Route::delete('/deletedPlans/{id}', [PlanController::class, 'deletedPlans']);

// Plans Show On Web
Route::get('/', [PlanController::class, 'ShowPlanWeb']);

// Voice UserDashboad page
Route::get('/voices/filter', [VoiceController::class, 'filter'])->name('voices.filter');

// Admin dashboard get Users With Graph
Route::get('/users-stats', [AdminController::class, 'usersStats']);

// Bulk Voices Generate Using GenerateAudioController
Route::get('/fetchGenAIBulkVoices', [GenrateAudioController::class, 'fetchGenAIBulkVoices']);
Route::post('/generateAudioVoices', [GenrateAudioController::class, 'generateBulkAudioVoices'])->name('generateAudioVoices');

// Password Reset Route
Route::get('/password-reset', function () {
    return view('auth.forgot-password');
});

Route::get('/reset-password', function () {
    return view('auth.reset-password');
});


Route::post('/send-forgot-password-link', [UserController::class, 'sendForgotPasswordLink']);
Route::post('/reset-user-password', [UserController::class, 'submitConfirmPassword'])->name('reset-user-password');


// Payment Routes
Route::get('FreePlanActive/{id}', [Subscription::class, 'FreePlanActive']);
Route::get('/viewCheckout/{id}', [PaymentController::class, 'viewCheckout']);
Route::post('/progressCheckout', [Subscription::class, 'progressCheckout']);
Route::get('/binancePay/{id}', [PaymentController::class, 'binancePay']);
Route::get('crypto/usdt/{id}', [PaymentController::class, 'usdtPay']);

//Patment Proof
Route::get('/fetchPlan/{id}', [PaymentProof::class, 'fetchPlan']);
Route::post('/PlanStatusUpdate/{id}', [PaymentProof::class, 'PlanStatusUpdate'])->name('PlanStatusUpdate');
Route::post('/deleteProofPlan/{id}', [PaymentProof::class, 'deleteProofPlan'])->name('deleteProofPlan');
// show character count
// Route::get('/index', [PaymentProof::class, 'CharacterCount']);
