<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Affiliates Login
Route::get('/login', 'Affiliates\AuthController@login')->name('login');
Route::post('/auth', 'Affiliates\AuthController@authenticate')->name('authenticate');
Route::get('/forgot-password', 'Affiliates\AuthController@forgotPassword')->name('forgot-password');
Route::get('/reset-password/{token}', 'Affiliates\AuthController@frmResetPassword')->name('get-reset-password');
Route::post('/reset-password', 'Affiliates\AuthController@resetPassword')->name('post-reset-password');
Route::get('/login-as-user/{distid}/{token}', 'Affiliates\AuthController@loginAsUser');

// User information for the replicated sites
Route::get('/user-info', 'Affiliates\UserController@getUserInfo');

// Affiliates Dashboard
Route::prefix('/')->middleware(['auth'])->name('affiliates.')->namespace('Affiliates')->group(function () {
    // Authentication
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');

    // Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    Route::get('/change-password', 'AuthController@frmChangePassword')->name('frm.change-password');
    Route::post('/change-password', 'AuthController@changePassword')->name('change-password');

    Route::get('/profile/{tab?}', 'ProfileController@showTabProfile')->name('profile');

    Route::post('/basic-information', 'ProfileController@postBasicInformation')->name('basic-information');
    Route::post('/billing-address', 'ProfileController@postBillingAddress')->name('billing-address');
    Route::post('/primary-address', 'ProfileController@postPrimaryAddress')->name('primary-address');
    Route::post('/shipping-address', 'ProfileController@postPrimaryAddress')->name('primary-address');

    Route::get('/get-primary-address', 'ProfileController@getPrimaryAddress')->name('get-primary-address');

    Route::get('/user-update-session', 'ProfileController@updateSession')->name('update-session');

    Route::post('profile/upload', 'ProfileController@uploadFoto')->name('profile-upload');
});


Route::middleware(['auth'])->group(function () {
    //Route::get('/user-update-session', 'Affiliates\ProfileController@updateSession')->name('update-session');

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.welcome');
        });
    });

    Route::group(['prefix' => '/dashboard'], function () {
        Route::get('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
        Route::post('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
    });

    Route::group(['prefix' => '/organization'], function () {
        Route::get('/customers', function () {
            return view('affiliates.organization.customer');
        });

        //Bucket Placement
        Route::get('/bucket-placement', 'Affiliates\PlacementController@bucketPlacement');
        Route::get('/set-user/bucket-placement/{id}', 'Affiliates\BucketPlacementController@setUser');
        Route::get('/remove-user/bucket-placement/{id}', 'Affiliates\BucketPlacementController@removeUser');
        Route::get('/get-user/bucket-placement/{usern}', 'Affiliates\BucketPlacementController@getUser');
        Route::get('/place-selected/{bucket}', 'Affiliates\BucketPlacementController@placeSelected');


        # New Placement
        Route::get('/placement', 'Affiliates\PlacementController@index');
        Route::post('placement', 'Affiliates\PlacementController@update')->name('update-preference-placement');

        Route::get('/binary-viewer/{id?}', 'Affiliates\BinaryViewerController@index')->name('binaryViewer');
        Route::get('/entire-organization-report', 'Affiliates\ReportsController@entireOrganizationReport');

        Route::get('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
        Route::post('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
    });

    Route::group(['prefix' => '/e-wallet'], function () {
        Route::get('/', 'Affiliates\EwalletTransactionController@index');
        Route::get('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
        Route::post('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
    });

    Route::group(['prefix' => '/report'], function () {
        Route::get('/', function () {
            return view('affiliates.reports.invoices');
        });
        Route::get('/entire-organization-report/data', 'Affiliates\ReportsController@entireOrganizationReportData');
        Route::get('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
        Route::post('/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
        Route::get('/pear/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');
        Route::post('/pear/datatables-api', 'Affiliates\ReportsController@dataTablesAPICall');

        Route::get('/invoice', 'Affiliates\ReportsController@getAllInvoices');
        Route::get('/invoice/view/{order_id}', 'Affiliates\ReportsController@invoiceView');
        Route::get('/invoice/download/{order_id}', 'Affiliates\ReportsController@invoiceDownload');

        Route::get('/pre-order/view/{pre_order_id}', 'Affiliates\ReportsController@preOrderView');
        Route::get('/pre-order/download/{pre_order_id}', 'Affiliates\ReportsController@preOrderDownload');

        Route::get('/orders', function () {
            return view('affiliates.reports.order');
        });

        Route::get('/order', 'Affiliates\ReportsController@getAllOrders');

        // Route::get('/invoice', function () {
        //     return view('affiliates.reports.invoices');
        // });

        Route::any('/pear/{id?}', 'Affiliates\ReportsController@getPearReportByUser')->name('pear-report');

        Route::any('/json/pear', 'Affiliates\ReportsController@getPearReportByUserJson')->name('pear-report-json');
        Route::any('/pear/json/pear', 'Affiliates\ReportsController@getPearReportByUserJson')->name('pear-report-json');

        // Route::get('/weekly-binary-report', function () {
        //     return view('affiliates.reports.weekly-binary-report');
        // });

        Route::get('/distributors_by_level', function () {
            return view('affiliates.reports.distributors-by-level');
        });

        Route::get('/weekly-enrollment-report', 'Affiliates\ReportsController@getWeeklyEnrollmentReport');

        // Route::get('/historical', 'Affiliates\ReportsController@historical')->name('historical-report');

        Route::get('/upgrade-prospects', 'Affiliates\ReportsController@getUpgradeProspects')->name('upgrade-prospects');
    });

    Route::get('/checkIpayoutUser', 'Affiliates\EwalletTransactionController@getIpayoutUser');

    Route::group(['prefix' => '/commission'], function () {
        Route::get('/', function () {
            return view('affiliates.commission.weekly');
        });
        Route::get('/monthly', 'Affiliates\ReportsController@commissionDetails')->name('monthly-commissions');
        Route::get('/commission-details-level', 'Affiliates\ReportsController@getCommissionDetailsLevel')->name('commission-details-level#');#
        Route::get('/found1099/download', 'Affiliates\ReportsController@found1099Download')->name('found1099-download');
        Route::get('/historical', 'Affiliates\ReportsController@commissionHistorical')->name('commission-historical');
    });

    # New group to commissions viewer
    Route::group(['prefix' => '/commission-viewer'], function () {
        Route::get('/weekly', function () {
            return view('affiliates.commission.weekly');
        });
        Route::get('/monthly', 'Affiliates\ReportsController@commissionDetails')->name('monthly-commissions');
        Route::get(
            '/commission-details-level',
            'Affiliates\ReportsController@getCommissionDetailsLevel'
        )->name('commission-details-level');
        Route::get('/found1099/download', 'Affiliates\ReportsController@found1099Download')->name('found1099-download');
        Route::get('/historical', 'Affiliates\ReportsController@commissionHistorical')->name('commission-historical');
    });

    // Route::get('/commission/monthly', function () {
    //     return view('affiliates.commission.monthly');
    // })->name('monthly-commissions');


    // Route::get('/individual-boomerangs', function () {
    //     return view('affiliates.boomerang.individual');
    // });


    Route::get('/world-series', 'Affiliates\WorldSeriesController@index')->name('world-series');

    // Route::get('/group-boomerangs', function () {
    //     return view('affiliates.boomerang.group');
    // });

    # Older Commissions Viewer
    Route::get('/commission', 'Affiliates\ReportsController@commission')->name('commission');
    Route::post('/commission/weekly', 'Affiliates\ReportsController@getWeeklyCommissionDates');
    Route::post('/commission/weekly/details', 'Affiliates\ReportsController@getWeeklyCommissionDetails');

    # New Commissions Viewer
    Route::get('/commission-viewer', 'Affiliates\ReportsController@commissionViewer');
    Route::post('/commission-viewer/weekly', 'Affiliates\ReportsController@getWeeklyCommissionDates');
    Route::post('/commission-viewer/weekly/details', 'Affiliates\ReportsController@getWeeklyCommissionDetails');

    Route::post(
        '/commission/unilevel-commission-details',
        'Affiliates\ReportsController@getUnilevelCommissionDetails'
    )->name('unilevel-commissions');
    Route::post(
        '/commission/leadership-commission-details',
        'Affiliates\ReportsController@getLeadershipCommissionDetails'
    )->name('leadership-commissions');
    Route::post(
        '/commission/tsb-commission-details',
        'Affiliates\ReportsController@getTsbCommissionDetails'
    )->name('tsb-commissions');
    Route::post(
        '/commission/promo-commission-details',
        'Affiliates\ReportsController@getPromoCommissionDetails'
    )->name('promo-commissions');
    Route::post(
        '/commission/vibe-commission-details',
        'Affiliates\ReportsController@getVibeCommissionDetails'
    )->name('vibe-commissions');

    Route::group(['namespace' => 'Affiliates'], function () {
        
        Route::group(['prefix' => '/tools'], function () {
            Route::get('/', 'ToolsController@tools')->name('affiliates.tools');
            Route::get('/presentations', 'ToolsController@presentations')->name('affiliates.tools.presentations');
            Route::get('/documents', 'ToolsController@documents')->name('affiliates.tools.documents');
            Route::get('/medias', 'ToolsController@medias')->name('affiliates.tools.medias');
            Route::get('/social', 'ToolsController@social')->name('affiliates.tools.social');
            Route::get('/training', 'ToolsController@training')->name('affiliates.tools.training');
            Route::get(
                '/downloads/performed',
                'ToolsController@downloadPerformed'
            )->name('affiliates.tools.downloadPerformed');
            Route::get('/downloads', 'ToolsController@downloads')->name('affiliates.tools.downloads');
            Route::get('/downloads/download', 'ToolsController@downloadSigned')->name('download.signed');;
            Route::get('/amount', 'ToolsController@amountConvert');
            Route::get('/live-sessions/{live?}','ToolsController@liveSession');
        });
    });

    Route::post('/currency', 'Affiliates\ToolsController@amountConvert');

    Route::get(
        '/dlg-subscription-reactivate-suspended-user',
        'Affiliates\SubscriptionController@dlgSubscriptionReactivateSuspendedUser'
    );
    Route::get('/subscription', 'Affiliates\SubscriptionController@subscription');
    Route::any('/shop', 'Affiliates\ShopController@shop')->name('shop.index');
    Route::get('/shop/product/{id}/detail', 'Affiliates\ShopController@productDetail')->name('product.details');

    // Route::get('/reports', function () {
    //     return view('affiliates.reports.invoices');
    // });
    // Api Request
    Route::get('/api-request', 'ApiRequestController@request');
    Route::post('/api-request', 'ApiRequestController@request')->name('api-request');

    // Shopping Cart
    Route::prefix('/shopping-cart')
        ->as('shopping-cart.')
        ->namespace('Affiliates')
        ->middleware('ShoppingCart')
        ->group(
            function () {
                Route::get('/', 'ShoppingCartController@myCart')->name('my-cart');
                Route::post('add-to-cart', 'ShoppingCartController@addToCart')->name('add');
                Route::post('is-gift', 'ShoppingCartController@isGift')->name('is-gift');
                Route::post('update-cart', 'ShoppingCartController@updateCart')->name('update-cart');
                Route::post('remove-from-cart', 'ShoppingCartController@removeFromCart')->name('remove');
                Route::get('payment-methods', 'ShoppingCartController@paymentsMethods')->name('checkout');
                Route::any('confirmation', 'ShoppingCartController@confirmation')->name('confirmation');
                Route::post('add-payment-method', 'ShoppingCartController@addPaymentMethod');
                Route::post('apply-payment-method', 'ShoppingCartController@applyPaymentMethod');
                Route::post('apply-shipping-address', 'ShoppingCartController@applyShippingAddress');
                Route::post('process-payment', 'ShoppingCartController@processPayment');
                Route::get('thank-you', 'ShoppingCartController@thankYou');
                Route::get('payment-waiting', 'ShoppingCartController@paymentWaiting');
                Route::get('get-status', 'ShoppingCartController@getStatus');

                # To test, remove all routes after the tests are completed
                Route::get('change-status', 'ShoppingCartController@changeStatus');
                Route::post('send-change-status', 'ShoppingCartController@processPayment');

                Route::get('user-payment-methods', 'ShoppingCartController@getUserPaymentsMethods')->name('user.paymentsMethods');
            }
        );
    Route::get('/get-total-items-cart', 'Affiliates\ShoppingCartController@getTotalItemCart');

    Route::group(['middleware' => 'ShoppingCartStop'], function () {
        Route::get('/cart-stop', 'Affiliates\ShoppingCartController@myCart')->name('my-cart-stop');
    });
});

Route::post('/login-to-igo4less', 'Auth\LoginIgo4lessController@login');
