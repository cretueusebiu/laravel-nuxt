<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('App\Http\Controllers')->group(function(){
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', 'Auth\LoginController@logout');

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::patch('settings/profile', 'Settings\ProfileController@update');
        Route::patch('settings/password', 'Settings\PasswordController@update');
    });

    Route::group(['middleware' => 'guest:api'], function () {
        Route::post('login', 'Auth\LoginController@login');
        Route::post('register', 'Auth\RegisterController@register');

        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

        Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'Auth\VerificationController@resend');

        Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
        Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
    });
});

/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');
$api
    ->version('v2', function (\Dingo\Api\Routing\Router $api) {
        $api->group([
            'middleware' => 'auth:api',
        ], function (\Dingo\Api\Routing\Router $api) {
            $api->resource('users', \App\BunkerMaestro\UserManagement\Controllers\UserController::class, ['only' => ['index']]);
        });
    });
