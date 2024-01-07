<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Admin\CompanySettingsController;
use App\Http\Controllers\Admin\DepositRequestController;
use App\Http\Controllers\Admin\KYC\KycReportController;
use App\Http\Controllers\Admin\KYC\KycRequestController;
use App\Http\Controllers\Admin\KYC\KycUploadController;
use App\Http\Controllers\Admin\ManageClient\ManageClientController;
use App\Http\Controllers\Admin\managecollection\CreateCollectionController;
use App\Http\Controllers\Admin\managecollection\ManageCollectionController;
use App\Http\Controllers\Admin\managenft\NftGeneratController;
use App\Http\Controllers\Admin\managenft\NftListingController;
use App\Http\Controllers\Admin\Request\OrderRequestController;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\FaceBookController;
use App\Http\Controllers\User\Auth\RegistrationController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\IndexController;

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\User\Auth\GoogleController;
use App\Http\Controllers\User\Auth\Web3LoginController;
use App\Http\Controllers\Admin\Profile\AdminProfileController;
use App\Http\Controllers\Admin\Report\AdminSalesReportController;
use App\Http\Controllers\Admin\Report\DepositReportController as ReportDepositReportController;
use App\Http\Controllers\Admin\Report\WithdrawReportController as ReportWithdrawReportController;
use App\Http\Controllers\Admin\WithdrawRequestController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\LikeOperactionController;
use App\Http\Controllers\NftController;
use App\Http\Controllers\User\BidPlaceController;
use App\Http\Controllers\User\UserNotificationController;

use App\Http\Controllers\User\KYC\UserKycReportController;
use App\Http\Controllers\NftRankingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SocialShareController;
use App\Http\Controllers\User\KYC\UserKycRequestController;
use App\Http\Controllers\User\KYC\UserKycUploadController;

use App\Http\Controllers\User\Finance\WithdrawReportController;
use App\Http\Controllers\User\CollectionController;
use App\Http\Controllers\User\CreatorController;
use App\Http\Controllers\User\Finance\CryptoDepositController;
use App\Http\Controllers\User\Finance\CryptoWithdrawController;
use App\Http\Controllers\User\Finance\UserBankDepositController;
use App\Http\Controllers\User\Finance\DepositReportController;
use App\Http\Controllers\User\Finance\UserBankWithdrawController;
use App\Http\Controllers\User\SalesReportController;
use App\Http\Controllers\User\Explore\ExploreController;
use App\Http\Controllers\User\Finance\AddBankController;
use App\Http\Controllers\User\ForgetPasswordController;
use App\Http\Controllers\User\PurchaseReportController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\ShopComponentController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', function () {
        $company_info = CompanyInfo::select()->first();
        return view(
            'users.auth.login',
            ['company_infos' => $company_info]
        );
    })->name('login');
});
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::any('/cart', [ShopComponentController::class, 'store'])->name('add.to.cart');
Route::any('/cartRemove', [ShopComponentController::class, 'cartRemove'])->name('add.to.cart');
Route::any('/cart-details', [ShopComponentController::class, 'cartDetails'])->name('cart.details');
Route::post('/social-media-share', [SocialShareController::class, 'ShareWidget']);
Route::any('/like-operation', [LikeOperactionController::class, 'likeOperation'])->name('like-operation');
Route::any('/follow-operation', [LikeOperactionController::class, 'followOperation'])->name('follow-operation');
Route::any('/al-ajax-search', [SearchController::class, 'ajaxSearch'])->name('ajax-search');
Route::any('/search', [SearchController::class, 'SubmitSearch'])->name('search');
Route::post('/search-explor-product', [SearchController::class, 'explorSearchProduct'])->name('search.explor.product');
Route::get('/profile/{id}', [UserProfileController::class, 'profile'])->name('user.profile');

//  User login registration route ----------------
Route::any('/user', [LoginController::class, 'UserLoginForm'])->name('user.login');
Route::any('/user/registration', [RegistrationController::class, 'UserRegistrationForm'])->name('user.registration');
//  Admin login route ---------------------------
Route::any('/admin', [LoginController::class, 'showAdminLogin'])->name('admin.login');
// google login route  ---------------------------
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// facebook login route
Route::get('/auth/facebook/redirect', [FaceBookController::class, 'redirectToFB'])->name('facebookRedirect');
Route::get('/auth/facebook/callback', [FaceBookController::class, 'handleCallback']);

//  metamask login route  ---------------------------
// Route::get('/web3-login-message', [Web3LoginController::class, 'message']);
// Route::post('/web3-login-verify', [Web3LoginController::class, 'verify']);

Route::any('admin/manage-clients', [ManageClientController::class, 'index']);
Route::any('admin/reports/withdraw', [ReportWithdrawReportController::class, 'index']);
Route::any('admin/reports/deposit', [ReportDepositReportController::class, 'index']);



// explore
Route::any('/explore', [ExploreController::class, 'exploreView'])->name('explore');

// user route
Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'user_dashboard'])->name('user.dashboard');
    Route::get('/user/profile', [UserProfileController::class, 'login_profile'])->name('user.login_profile');
    Route::any('user/profile-settings', [UserProfileController::class, 'profile_settings'])->name('user.profile-settings');
    Route::get('/user/collection', [CollectionController::class, 'collection'])->name('user.collection');
    // Route::any('collection/view/{name}', [CollectionController::class, 'collections'])->name('asset.collections');
    Route::any('collection/create', [CollectionController::class, 'create'])->name('asset.collections.create');
    Route::get('/user/notification-query', [UserNotificationController::class, 'notificationQuery'])->name('user.notification.query');
    Route::get('/user/dashboard/notification-query', [UserNotificationController::class, 'dashboardNotificationQuery'])->name('user.dashboard.notification.query');
    Route::any('/user/dashboard/top-user-query', [UserNotificationController::class, 'topUserQuery'])->name('user.dashboard.top.user.query');
    Route::get('/user/notification', [UserNotificationController::class, 'page'])->name('user.notification');
    Route::any('/user/create', [NftController::class, 'create'])->name('nft.create');
    Route::any('/user/activity', [ActivityController::class, 'activity'])->name('nft.activity');
    Route::post('/add/collection', [CollectionController::class, 'addCollection'])->name('user.collection');
    Route::get('/profile/{id}', [UserProfileController::class, 'profile'])->name('user.profile');
    Route::get('mylivebid/', [UserDashboardController::class, 'alllivebid'])->name('my.livebid');
    Route::get('mycollection/', [UserDashboardController::class, 'allcollection'])->name('my.collection');
    Route::any('mycollection/edit/{id}', [CollectionController::class, 'edit_collection_page'])->name('user.edit-collection');
    Route::any('mycollection/edit/', [CollectionController::class, 'editCollection'])->name('user.edit_collection');
    Route::any('edit/nft/{id}', [NftController::class, 'editnft'])->name('edit.nft');



    //user kyc route
    //kyc report controller
    Route::get('/user/kyc-management/kyc-report', [UserKycReportController::class, 'UserkycReport'])->name('user.kyc.management.report');
    Route::get('/user/kyc-management/kyc-report-view-descrption/{id}/{table_id}', [UserKycReportController::class, 'UserviewDescription'])->name('user.kyc.description.report');


    // Start : Finance
    // bank deposit : [Rajin]
    Route::get('/user/finance/bank_deposit', [UserBankDepositController::class, 'bankDeposit'])->name('user.finance.bank_deposit');
    Route::post('/user/finance/bank_deposit/add', [UserBankDepositController::class, 'bankDepositAdd'])->name('user.finance.bank_deposit.add');

    // crypto deposit : [Rajin]
    Route::get('/user/finance/crypto_deposit', [CryptoDepositController::class, 'cryptoDeposit'])->name('user.finance.crypto_deposit');
    Route::post('/user/finance/crypto_deposit/add', [CryptoDepositController::class, 'cryptoDepositAdd'])->name('user.finance.crypto_deposit.add');
    Route::post('/user/crypto-name', [CryptoDepositController::class, 'cryptoNameFind'])->name('user.crypto-name');
    Route::post('/user/crypto-convert', [CryptoDepositController::class, 'cryptoConvert'])->name('user.crypto-instrument');

    // bank withdraw : [Rajin]
    Route::get('/user/finance/bank_withdraw', [UserBankWithdrawController::class, 'bankWithdraw'])->name('user.finance.bank_withdraw');
    Route::post('/user/finance/bank_withdraw/bank_name', [UserBankWithdrawController::class, 'findBankAccounts'])->name('user.finance.bank_withdraw.bank_name');
    Route::post('/user/finance/bank_withdraw/bank_ac_number', [UserBankWithdrawController::class, 'findBankAccountDetails'])->name('user.finance.bank_withdraw.bank_ac_number');
    Route::post('/user/finance/bank_withdraw/add', [UserBankWithdrawController::class, 'bankWithdrawAdd'])->name('user.finance.bank_withdraw.add');

    // crypto withdraw : [Rajin]
    Route::get('/user/finance/crypto_withdraw', [CryptoWithdrawController::class, 'cryptoWithdraw'])->name('user.finance.crypto_withdraw');
    Route::post('/user/finance/crypto_withdraw/crypto_address', [CryptoWithdrawController::class, 'cryptoAddressFind'])->name('user.finance.crypto_withdraw.crypto_address');
    Route::post('/user/finance/crypto_withdraw/usd_to_crypto', [CryptoWithdrawController::class, 'cryptoConvert'])->name('user.finance.crypto_withdraw.usd_to_crypto');
    Route::post('/user/finance/crypto_withdraw/add', [CryptoWithdrawController::class, 'cryptoWithdrawAdd'])->name('user.finance.crypto_withdraw.add');

    // End : Finance
    //kyc request controller
    Route::get('/user/kyc-management/kyc-request', [UserKycRequestController::class, 'kycRequest'])->name('user.kyc.management.request');
    Route::get('/user/kyc-management/kyc-request-profile-view/{id}', [UserKycRequestController::class, 'kycRequestProfile'])->name('user.kyc.management.profile');
    Route::post('/user/kyc-management/kyc-request-user-profile-update', [UserKycRequestController::class, 'kycProfileUpdate'])->name('user.kyc.request.profile.update');
    Route::get('/user/kyc-management/kyc-request-description/{id}/{table_id}', [UserKycRequestController::class, 'kycRequestDescription'])->name('user.kyc.management.description');
    Route::post('/user/kyc-management/kyc-approve-request/{id}/{table_id}', [UserKycRequestController::class, 'kycApproveRequest'])->name('user.kyc.management.approve');
    Route::post('/user/kyc-management/kyc-decline-request', [UserKycRequestController::class, 'kycDeclineRequest'])->name('user.kyc.management.decline');

    //<-------------------- kyc upload report route here--------------------------------->
    Route::any('/user/kyc-management/kyc-upload-view', [UserKycUploadController::class, 'index'])->name('user.kyc-upload-view');
    Route::post('/user/kyc-management/kyc-front-upload-file', [UserKycUploadController::class, 'id_front_file_upload'])->name('user.kyc-front-upload-file');

    Route::post('/user/kyc-management/kyc-upload-front-delete-file', [UserKycUploadController::class, 'id_front_file_delete'])->name('user.kyc-front-upload-delete-file');
    // kyc back upload/delete
    Route::post('/user/kyc-management/kyc-back-upload-file', [UserKycUploadController::class, 'id_back_file_upload'])->name('user.kyc-back-upload-file');
    Route::post('/user/kyc-management/kyc-upload-back-delete-file', [UserKycUploadController::class, 'id_back_file_delete'])->name('user.kyc-back-upload-delete-file');
    // kyc address proof upload/delete
    Route::post('/user/kyc-management/kyc-address-upload-file', [UserKycUploadController::class, 'address_file_upload'])->name('user.kyc-address-upload-file');
    Route::post('/user/kyc-management/kyc-upload-address-delete-file', [UserKycUploadController::class, 'address_file_delete'])->name('user.kyc-address-upload-delete-file');
    // submit kyc upload form and store data
    Route::post('/user/kyc-management/kyc-store', [UserKycUploadController::class, 'store'])->name('user.kyc-store');

    // decline while upload kyc by user
    Route::post('/user/kyc-management/kyc-upload-decline-mail', [UserKycUploadController::class, 'kyc_decline_mail'])->name('user.kyc-upload-decline-mail');

    Route::get('/user/kyc-management/kyc-get-id-type/{id_type}', [UserKycUploadController::class, 'get_id_type'])->name('user.kyc-get-id-type');
    Route::get('/user/kyc-management/get-client/{user_type}', [UserKycUploadController::class, 'get_client'])->name('user.kyc-get-client');

    Route::get('/user/kyc-management/get-client-details/{id}', [UserKycUploadController::class, 'get_client_details'])->name('user.kyc-get-client-details');
    Route::get('/search/get-client/{user_type}/user/{value}', [UserKycUploadController::class, 'search_client'])->name('user.kyc-get-client');
    Route::post('/user/verify-form', [UserKycUploadController::class, 'file_upload'])->name('user.user-verification-form');

    // finance report
    Route::get('/finance/withdraw-report', [WithdrawReportController::class, 'WithdrawReportView'])->name('finance.withdraw.report');
    Route::any('/finance/deposit-report', [DepositReportController::class, 'depositReportView'])->name('finance.deposit.report');

    //place bid route
    Route::post('/user/place-bid', [BidPlaceController::class, 'placeBid'])->name('user.place.bid');
    //sales report
    Route::get('/user/sales-report', [SalesReportController::class, 'salesReportShow'])->name('user.sales_report');
    Route::get('/user/sales-report/data', [SalesReportController::class, 'getData'])->name('user.sales_report_data');

    //purchase report
    Route::get('/user/purchase-report', [PurchaseReportController::class, 'purchaseReportShow'])->name('user.purchase_report');
    Route::get('/user/purchase-report/data', [PurchaseReportController::class, 'getData'])->name('user.purchase_report_data');
    Route::post('/report', [CommonController::class, 'report'])->name('report');

    //bank account add
    Route::any('/finance/add-bank', [AddBankController::class, 'addBank'])->name('user.finance.add_bank');
});

// admin route
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    //kyc report controller
    Route::get('/admin/kyc-management/kyc-report', [KycReportController::class, 'kycReport'])->name('kyc.management.report');
    Route::get('/admin/kyc-management/kyc-report-view-descrption/{id}/{table_id}', [KycReportController::class, 'viewDescription'])->name('kyc.description.report');

    //kyc request controller
    Route::get('/admin/kyc-management/kyc-request', [KycRequestController::class, 'kycRequest'])->name('kyc.management.request');
    Route::get('/admin/kyc-management/kyc-request-profile-view/{id}', [KycRequestController::class, 'kycRequestProfile'])->name('kyc.management.profile');
    Route::post('/admin/kyc-management/kyc-request-user-profile-update', [KycRequestController::class, 'kycProfileUpdate'])->name('kyc.request.profile.update');
    Route::get('/admin/kyc-management/kyc-request-description/{id}/{table_id}', [KycRequestController::class, 'kycRequestDescription'])->name('kyc.management.description');
    Route::post('/admin/kyc-management/kyc-approve-request/{id}/{table_id}', [KycRequestController::class, 'kycApproveRequest'])->name('kyc.management.approve');
    Route::post('/admin/kyc-management/kyc-decline-request', [KycRequestController::class, 'kycDeclineRequest'])->name('kyc.management.decline');

    //<-------------------- kyc upload report route here--------------------------------->
    Route::any('/admin/kyc-management/kyc-upload-view', [KycUploadController::class, 'index'])->name('admin.kyc-upload-view');
    Route::post('/admin/kyc-management/kyc-front-upload-file', [KycUploadController::class, 'id_front_file_upload'])->name('admin.kyc-front-upload-file');

    Route::post('/admin/kyc-management/kyc-upload-front-delete-file', [KycUploadController::class, 'id_front_file_delete'])->name('admin.kyc-front-upload-delete-file');
    // kyc back upload/delete
    Route::post('/admin/kyc-management/kyc-back-upload-file', [KycUploadController::class, 'id_back_file_upload'])->name('admin.kyc-back-upload-file');
    Route::post('/admin/kyc-management/kyc-upload-back-delete-file', [KycUploadController::class, 'id_back_file_delete'])->name('admin.kyc-back-upload-delete-file');
    // kyc address proof upload/delete
    Route::post('/admin/kyc-management/kyc-address-upload-file', [KycUploadController::class, 'address_file_upload'])->name('admin.kyc-address-upload-file');
    Route::post('/admin/kyc-management/kyc-upload-address-delete-file', [KycUploadController::class, 'address_file_delete'])->name('admin.kyc-address-upload-delete-file');
    // submit kyc upload form and store data
    Route::post('/admin/kyc-management/kyc-store', [KycUploadController::class, 'store'])->name('admin.kyc-store');

    // decline while upload kyc by admin
    Route::post('/admin/kyc-management/kyc-upload-decline-mail', [KycUploadController::class, 'kyc_decline_mail'])->name('admin.kyc-upload-decline-mail');

    Route::get('/admin/kyc-management/kyc-get-id-type/{id_type}', [KycUploadController::class, 'get_id_type'])->name('admin.kyc-get-id-type');
    Route::get('/admin/kyc-management/get-client/{user_type}', [KycUploadController::class, 'get_client'])->name('admin.kyc-get-client');

    Route::get('/admin/kyc-management/get-client-details/{id}', [KycUploadController::class, 'get_client_details'])->name('admin.kyc-get-client-details');
    Route::get('/search/get-client/{user_type}/user/{value}', [KycUploadController::class, 'search_client'])->name('admin.kyc-get-client');
    Route::post('/admin/user-admin/verify-form', [KycUploadController::class, 'file_upload'])->name('admin.admin-verification-form');

    // admin manage profile
    Route::get('/admin/profile/profile-settings/', [AdminProfileController::class, 'profileSetting'])->name('admin.profile-settings');
    Route::post('/admin/profile/profile-settings/update-profile', [AdminProfileController::class, 'updateProfile'])->name('admin.profile-settings.update-profile');
    Route::post('/admin/update-security-setting/{check_auth}', [AdminProfileController::class, 'securitySettingUpdate'])->name('admin.update-security-setting');
    Route::post('/admin/google-security-setting', [AdminProfileController::class, 'googleAuthenticationUpdate'])->name('admin.google-security-setting');

    //Manage Request for Deposit
    Route::get('/admin/manage-report/deposit-request', [DepositRequestController::class, 'depositRequest'])->name('admin.manage.deposit');
    Route::post('/admin/manage-report/deposit-request/approve-request/{id}/{u_id}', [DepositRequestController::class, 'approveRequest']);
    Route::post('/admin/manage-report/deposit-request/decline-request', [DepositRequestController::class, 'declineRequest'])->name('admin.decline-request');

    //Manage Request for order
    Route::get('/admin/manage-order/order-request', [OrderRequestController::class, 'orederRequest'])->name('admin.manage.order');
    Route::get('/admin/manage-order/order-request-report', [OrderRequestController::class, 'orderRequestReport']);
    Route::Post('/admin/manage-order/order-request/approve-request/{id}', [OrderRequestController::class, 'approveOrderRequest']);
    Route::Post('/admin/manage-order/order-request/decline-request', [OrderRequestController::class, 'declineOrderRequest'])->name('admin.cancel_order');
    //Manage Request for Withdraw
    Route::get('/admin/manage-report/withdraw-request', [WithdrawRequestController::class, 'withdrawRequest'])->name('admin.manage.withdraw');
    Route::post('/admin/manage-report/withdraw-request/approve-request/{id}/{u_id}', [WithdrawRequestController::class, 'approveWithdrawRequest']);
    Route::post('/admin/manage-report/withdraw-request/decline-request', [WithdrawRequestController::class, 'declineWithdrawRequest'])->name('withdraw.decline.request');

    // Sales Report
    Route::any('/admin/reports/sales-report', [AdminSalesReportController::class, 'index'])->name('admin.sales_report');
    Route::any('/admin/reports/sales-report/data', [AdminSalesReportController::class, 'SalesReport']);

    // setting
    Route::any('admin/settings/company-settings', [CompanySettingsController::class, 'companySettings'])->name('admin.company_settings');
    Route::any('admin/settings/company-info', [CompanySettingsController::class, 'companyInfoUpdate'])->name('admin.company_info');
    Route::any('admin/settings/social-info', [CompanySettingsController::class, 'socialInfo'])->name('admin.settings.social_info');

    // manage nft
    Route::any('/admin/manage-nft/nft-listing', [NftListingController::class, 'nftListing'])->name('admin.nft_listing');
    Route::any('/admin/manage-nft/nft-listing/data', [NftListingController::class, 'getData']);
    Route::Post('/admin/manage-nft/active-nft/{id}', [NftListingController::class, 'activeNft']);
    Route::Post('/admin/manage-nft/deactive-nft/{id}', [NftListingController::class, 'deactiveNft']);
    Route::Post('/admin/manage-nft/getuser/id', [NftGeneratController::class, 'getUser']);
    Route::any('/admin/manage-nft/nft-generate', [NftGeneratController::class, 'nftGenerator'])->name('admin.nft_generator');
    Route::any("/admin/manage-nft/get-collection/",[NftGeneratController::class,"getCollection"]);

    //manage collection
    Route::any('/admin/manage-collection/create-collection', [CreateCollectionController::class, 'createCollection'])->name('admin.create_collection');
    Route::any('/admin/manage-collection/all-collection', [ManageCollectionController::class, 'showCollection'])->name('admin.manage_collection');
    Route::any('/admin/manage-collection/all-collection/data', [ManageCollectionController::class, 'getCollection']);
    Route::Post('/admin/manage-collection/getuser/id', [CreateCollectionController::class, 'getUser']);

});

// logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/nft/ranking', [NftRankingController::class, 'ranking'])->name('nft.ranking');
Route::post('explor-product', [IndexController::class, 'explorProduct'])->name('explor.product');
Route::get('asset-details/{id}', [IndexController::class, 'assetDetails'])->name('asset.details');
Route::any('/watchlist_add', [NftRankingController::class, 'watchlistAdd']);

// collection route
Route::any('collection/view/{name}/{id}', [CollectionController::class, 'collections'])->name('asset.collections');
Route::any('/user/creator', [CreatorController::class, 'creator'])->name('user.creator');
route::any('/collections', [CollectionController::class, 'all_collections'])->name('collections.all-collections');
route::any('/forget-password', [ForgetPasswordController::class, 'forget_password'])->name('user.password-forget');
route::any('/privacy-policy', [CommonController::class, 'privacy_policy'])->name('user.privacy-policy');
route::any('/about-us', [CommonController::class, 'about_us'])->name('about-us');
route::any('/contact-us', [CommonController::class, 'contact_us'])->name('contact-us');
Route::any('/contact-us/message', [CommonController::class, 'supportMessage'])->name('support.message');
route::any('/products', [CommonController::class, 'all_product'])->name('all-products');
route::any('/supports-faq', [CommonController::class, 'support_faq'])->name('support-faq');
route::any('/terms-condition', [CommonController::class, 'terms_condition'])->name('terms-condition');
route::any('/comming-soon', [CommonController::class, 'comming_soon'])->name('comming-soon');
route::any('/forum-details', [CommonController::class, 'forum_details'])->name('forum-details');
route::any('/news-later', [CommonController::class, 'news_later'])->name('news-later');
route::any('/connecto-to-wallet', [CommonController::class, 'connect_to_wallet'])->name('connect-to-wallet');
Route::any('/subscription', [CommonController::class, 'subscription'])->name('subscription');
route::any('/collections', [CollectionController::class, 'all_collections'])->name('collections.all-collections');
// start : forgot password
route::get('/forget-password', [ForgetPasswordController::class, 'forget_password'])->name('user.forgot-password');
route::post('/forget-password', [ForgetPasswordController::class, 'findEmail'])->name('user.forgot-password');
// end : forgot password
// route::any('/privacy-policy', [CommonController::class, 'privacy_policy'])->name('user.privacy-policy');
// route::any('/about-us', [CommonController::class, 'about_us'])->name('about-us');
// route::any('/contact-us', [CommonController::class, 'contact_us'])->name('contact-us');
// route::any('/contact-us/message', [CommonController::class, 'supportMessage'])->name('support.message');
// route::any('/products', [CommonController::class, 'all_product'])->name('all-products');
// route::any('/supports-faq', [CommonController::class, 'support_faq'])->name('support-faq');
// route::any('/terms-condition', [CommonController::class, 'terms_condition'])->name('terms-condition');
// route::any('/comming-soon', [CommonController::class, 'comming_soon'])->name('comming-soon');
// route::any('/forum-details', [CommonController::class, 'forum_details'])->name('forum-details');
// route::any('/news-later', [CommonController::class, 'news_later'])->name('news-later');
// route::any('/connecto-to-wallet', [CommonController::class, 'connect_to_wallet'])->name('connect-to-wallet');

route::any('test-mail', [CommonController::class, 'test_mail'])->name('test-mail');
route::any('buy_now_nft', [ShopComponentController::class, 'buyNowNft'])->name('buy_now_nft');
route::any('/destroy/cartInfo', [ShopComponentController::class, 'destroy'])->name('cart_destroy');
route::any('/invoice/print/{invoice_number}', [ShopComponentController::class, 'invoicePrint']);
route::any('/select_wallet/buy_nft', [ShopComponentController::class, 'select_wallet']);
route::any('/internal_payment', [ShopComponentController::class, 'internal_wallet_form_buy'])->name('internal_wallet_form_buy');
