<?php

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
|planSecond
*/

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//check if auth mode is enabled
Route::middleware('checkAuthMode')->group(function () {

    //Payment controller
    Route::get('pricing', [App\Http\Controllers\PaymentController::class, 'index'])->name('pricing');
    Route::get('payment', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment');
    Route::post('handlePayment', [App\Http\Controllers\PaymentController::class, 'handlePayment'])->name('handlePayment');
    
    //Home controller
    
    Route::post('add-friend', [App\Http\Controllers\HomeController::class, 'addFriend']);
    Route::post('save-message', [App\Http\Controllers\HomeController::class, 'saveMessage']);
    Route::post('check-contact', [App\Http\Controllers\HomeController::class, 'checkContact']);
    Route::post('report-user', [App\Http\Controllers\HomeController::class, 'reportUser']);
    Route::get('check-user', [App\Http\Controllers\HomeController::class, 'checkUser']);
    Route::get('get-details', [App\Http\Controllers\HomeController::class, 'getDetails']);
    Route::post('modify-points', [App\Http\Controllers\HomeController::class, 'modifyPoints']);
    Route::post('get-points', [App\Http\Controllers\HomeController::class, 'getPoints']);
    Route::post('verify-photo', [App\Http\Controllers\HomeController::class, 'verifyPhoto']);
    Route::post('stripe_post', [App\Http\Controllers\HomeController::class, 'stripe_post'])->name('stripe_post');
    Route::get('get_women_points', [App\Http\Controllers\HomeController::class, 'get_women_points']);
    Route::get('get-women-photoes', [App\Http\Controllers\HomeController::class, 'get_women_photoes']);
    Route::post('logout_control', [App\Http\Controllers\HomeController::class, 'logoutControl']);
    Route::post('get-partner-avartar', [App\Http\Controllers\HomeController::class, 'getPartnerAvartar']);
    Route::post('video-history-save', [App\Http\Controllers\HomeController::class, 'videoHistorySave']);
    Route::post('get-video-history', [App\Http\Controllers\HomeController::class, 'getVideoHistory']);
    Route::post('video-history-delete', [App\Http\Controllers\HomeController::class, 'videoHistoryDelete']);
    Route::post('video-history-delete-all', [App\Http\Controllers\HomeController::class, 'videoHistoryDeleteAll']);
    Route::post('trans-message', [App\Http\Controllers\HomeController::class, 'transMessage']);
    Route::post('set-language', [App\Http\Controllers\HomeController::class, 'setLanguage']);
    
    //Text controller
    Route::get('messanger', [App\Http\Controllers\TextController::class, 'index']);
    Route::post('get-messages', [App\Http\Controllers\TextController::class, 'getMessage']);
    Route::post('get-contacts', [App\Http\Controllers\TextController::class, 'getContacts']);
    Route::post('unread-recent-contacts', [App\Http\Controllers\TextController::class, 'unreadOrRecentContacts']);
    Route::post('read-message', [App\Http\Controllers\TextController::class, 'readMessage']);
    Route::post('clear_chat_history', [App\Http\Controllers\TextController::class, 'clearChatHistory']);
    Route::post('delete_partner', [App\Http\Controllers\TextController::class, 'deletePartner']);
    Route::post('report_partner', [App\Http\Controllers\TextController::class, 'reportPartner']);
    Route::post('get-emoji', [App\Http\Controllers\TextController::class, 'getEmoji']);
    Route::post('get-gift', [App\Http\Controllers\TextController::class, 'getGift']);
    Route::post('take_photo', [App\Http\Controllers\TextController::class, 'takePhoto']);
    Route::post('send_photo', [App\Http\Controllers\TextController::class, 'sendPhoto']);
    Route::post('check-man-minute', [App\Http\Controllers\TextController::class, 'checkManMinute']);
    Route::post('view-photo', [App\Http\Controllers\TextController::class, 'viewPhoto']);
    Route::post('take-photo-another', [App\Http\Controllers\TextController::class, 'takePhotoAnother']);
    Route::post('upload_photo', [App\Http\Controllers\TextController::class, 'uploadPhoto']);
    Route::post('take-video-save', [App\Http\Controllers\TextController::class, 'takeVideoSave']);
    Route::post('add-favourite', [App\Http\Controllers\TextController::class, 'addFavourite']);
    Route::post('set-block', [App\Http\Controllers\TextController::class, 'setBlock']);
    
    
    //Record Controller
    Route::post('record-video-save', [App\Http\Controllers\RecordController::class, 'recordVideoSave']);
    Route::post('get-record-video', [App\Http\Controllers\RecordController::class, 'getRecordVideo']);
    Route::post('record-video-delete', [App\Http\Controllers\RecordController::class, 'recordVideoDelete']);
    Route::post('get-video-stories', [App\Http\Controllers\RecordController::class, 'getVideoStories']);
    Route::post('give-like', [App\Http\Controllers\RecordController::class, 'giveLike']);
    Route::post('set-time-synchronize', [App\Http\Controllers\RecordController::class, 'setTimeSynchronize']);
    
    //view request part because this is common part between video and text chat page.
    Route::post('view-requests', [App\Http\Controllers\ViewRequestController::class, 'viewRequests']);
    //profile page
    Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::get('man_transaction', [App\Http\Controllers\ProfileController::class, 'manTransaction'])->name('man_transaction');
    Route::get('women_withdraw', [App\Http\Controllers\ProfileController::class, 'womenWithdraw'])->name('women_withdraw');
    Route::get('get-profiles', [App\Http\Controllers\ProfileController::class, 'getProfileInfo']);
    Route::post('update-username', [App\Http\Controllers\ProfileController::class, 'updateUsername']);
    Route::post('upload-avatar', [App\Http\Controllers\ProfileController::class, 'uploadAvatar']);
    Route::post('take_profile_photo', [App\Http\Controllers\ProfileController::class, 'takeProfilePhoto']);
    
    //withdraw routes
    Route::post('visa_withdraw', [App\Http\Controllers\WithdrawController::class, 'visaWithdraw']);
    Route::post('paypal_withdraw', [App\Http\Controllers\WithdrawController::class, 'paypalWithdraw']);

});

//admin routes
Route::middleware('checkAdmin')->group(function () {
    Route::get('get-withdraw-data', [App\Http\Controllers\AdminController::class, 'getWithdrawData']);
    Route::get('admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('income', [App\Http\Controllers\AdminController::class, 'income'])->name('income');
    Route::get('update', [App\Http\Controllers\AdminController::class, 'update'])->name('update');
    Route::get('check-for-update', [App\Http\Controllers\AdminController::class, 'checkForUpdate']);
    Route::get('download-update', [App\Http\Controllers\AdminController::class, 'downloadUpdate']);
    Route::get('license', [App\Http\Controllers\AdminController::class, 'license'])->name('license');
    Route::get('verify-license', [App\Http\Controllers\AdminController::class, 'verifyLicense']);
    Route::get('uninstall-license', [App\Http\Controllers\AdminController::class, 'uninstallLicense']);
    Route::get('signaling', [App\Http\Controllers\AdminController::class, 'signaling'])->name('signaling');
    Route::get('check-signaling', [App\Http\Controllers\AdminController::class, 'checkSignaling']);

    //user routes
    Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
    Route::post('update-user-status', [App\Http\Controllers\UserController::class, 'updateUserStatus']);
    Route::post('update-user-text-chat', [App\Http\Controllers\UserController::class, 'updateUserTextStatus']);
    Route::post('update-user-video-chat', [App\Http\Controllers\UserController::class, 'updateUserVideoStatus']);
    Route::get('user-detail/edit/{id}', [App\Http\Controllers\UserController::class, 'user_detail_edit']);
    Route::post('update-user-verify-status', [App\Http\Controllers\UserController::class, 'updateUserVerifyStatus']);
    Route::post('send-message-client', [App\Http\Controllers\UserController::class, 'sendMessageClient']);
    Route::post('close-account', [App\Http\Controllers\UserController::class, 'closeAccount']);
    Route::post('user-minute-update', [App\Http\Controllers\UserController::class, 'modifyMinute']);

    //reportedUsers routes
    Route::get('reported-users', [App\Http\Controllers\ReportedUserController::class, 'index'])->name('reportedUsers');
    Route::post('ignore-user', [App\Http\Controllers\ReportedUserController::class, 'ignoreUser']);
    Route::post('ban-user', [App\Http\Controllers\ReportedUserController::class, 'banUser']);
    Route::get('banned-users', [App\Http\Controllers\ReportedUserController::class, 'bannedUsers'])->name('bannedUsers');
    Route::post('unban-user', [App\Http\Controllers\ReportedUserController::class, 'unbanUser']);

    //global config routes
    Route::get('global-config', [App\Http\Controllers\GlobalConfigController::class, 'index'])->name('global-config');
    Route::get('global-config/edit/{id}', [App\Http\Controllers\GlobalConfigController::class, 'edit']);
    Route::post('update-global-config', [App\Http\Controllers\GlobalConfigController::class, 'update']);

    //fatures routes
    Route::get('features', [App\Http\Controllers\FeaturesController::class, 'index'])->name('features');
    Route::post('update-feature-status', [App\Http\Controllers\FeaturesController::class, 'updateFeatureStatus']);
    Route::post('update-feature-paid', [App\Http\Controllers\FeaturesController::class, 'updateFeaturePaid']);
    
    //package routes
    Route::get('packages', [App\Http\Controllers\PackageController::class, 'index'])->name('packages');
    Route::get('packages/edit/{id}', [App\Http\Controllers\PackageController::class, 'edit']);
    Route::post('package-update', [App\Http\Controllers\PackageController::class, 'update']);
    
    //withdraw routes
    Route::get('withdraws', [App\Http\Controllers\WithdrawController::class, 'index'])->name('withdraws');
    Route::post('withdraw_approve', [App\Http\Controllers\WithdrawController::class, 'withdraw_approve']);
    Route::post('withdraw_disapprove', [App\Http\Controllers\WithdrawController::class, 'withdraw_disapprove']);
    
    //gifts
    Route::get('gifts', [App\Http\Controllers\GiftController::class, 'index'])->name('gifts');
    Route::get('new_gift', [App\Http\Controllers\GiftController::class, 'newGift'])->name('new_gift');
    Route::post('gift-create', [App\Http\Controllers\GiftController::class, 'create']);
    Route::get('gifts/edit/{id}', [App\Http\Controllers\GiftController::class, 'edit']);
    Route::post('gift-update', [App\Http\Controllers\GiftController::class, 'update']);
    Route::get('gifts/delete/{id}', [App\Http\Controllers\GiftController::class, 'delete']);
    
    //emoji
    Route::get('emoji', [App\Http\Controllers\EmojiController::class, 'index'])->name('emoji');
    Route::get('new_emoji', [App\Http\Controllers\EmojiController::class, 'newEmoji'])->name('new_emoji');
    Route::post('emoji-create', [App\Http\Controllers\EmojiController::class, 'create']);
    Route::get('emoji/edit/{id}', [App\Http\Controllers\EmojiController::class, 'edit']);
    Route::post('emoji-update', [App\Http\Controllers\EmojiController::class, 'update']);
    Route::get('emoji/delete/{id}', [App\Http\Controllers\EmojiController::class, 'delete']);
    //monitoring
    Route::get('monitoring', [App\Http\Controllers\MonitoringController::class, 'index'])->name('monitoring');
    Route::post('photovideo-message-delete', [App\Http\Controllers\MonitoringController::class, 'photovideoMessageDelete'])->name('photovideo-message-delete');
    
    //record video
    Route::get('recordvideo', [App\Http\Controllers\RecordController::class, 'index'])->name('recordvideo');
    Route::post('record-video-set-update', [App\Http\Controllers\RecordController::class, 'recordVideoSetUpdate']);
    Route::post('record-one-delete', [App\Http\Controllers\RecordController::class, 'recordOneDelete']);
    
});

//change password
Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'index'])->name('changePassword');
Route::post('update-password', [App\Http\Controllers\ChangePasswordController::class, 'changePassword']);
//forgot password
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'index'])->name('/password/email');

//extra routes
Route::get('privacy-policy', function () {
    return view('privacy-policy', [
        'page' => 'Privacy Policy',
    ]);
})->name('privacyPolicy');

Route::get('terms-and-conditions', function () {
    return view('terms-and-conditions', [
        'page' => 'Terms & Conditions',
    ]);
})->name('termsAndConditions');
