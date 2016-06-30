<?php

use App\test_kpi;
use App\User;
use App\bms_www_bits;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
//a route showing the Lumen version
$app->get('/', function () use ($app) {
    return $app->version();
});
//a route to authenticate
$app->post('/auth/login', 'AuthController@postLogin');
//protected routes
$app->group(['namespace' => 'App\Http\Controllers','middleware' => ['auth:api']], function($group)
{


//a route to change the password
    $group->post('/change', 'change_passwordController@change');
 //a route to get the authenticated user
    $group->get('/authuser','AuthController@getAuthenticatedUser');



    $group->get('/bms_www_users','UserController@getUsers');
    $group->post('/bms_www_users/delete','UserController@destroyUser');
    $group->post('/bms_www_users/update','UserController@updateUser');


    $group->get('/bms_www_bits','BitsController@get');
    $group->post('/bms_www_bits/create','BitsController@createBit');
    $group->post('/bms_www_bits/delete','BitsController@destroyBit');
    $group->post('/bms_www_bits/update','BitsController@updateBit');



    $group->get('/bms_www_biflash','BiFlashController@get');
    $group->post('/bms_www_biflash/create','BiFlashController@createBiFlash');
    $group->post('/bms_www_biflash/delete','BiFlashController@destroyBiFlash');
    $group->post('/bms_www_biflash/update','BiFlashController@updateBiFlash');



    $group->get('/bms_www_bits_details','BitsDetailsController@get');
    $group->post('/bms_www_bits_details/create','BitsDetailsController@createBitDetails');
    $group->post('/bms_www_bits_details/delete','BitsDetailsController@destroyBitDetails');
    $group->post('/bms_www_bits_details/update','BitsDetailsController@updateBitDetails');


});
//route to submit forgotten password
$app->post('/recovery','recoveryController@recovery');
// Route that uses the reset code to reset a user password
$app->get('/resetpassword/{resetcode}','recoveryController@reset_password');

$app->post('/bms_www_users/create','UserController@createUser');









