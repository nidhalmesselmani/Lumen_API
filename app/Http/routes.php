<?php

use App\test_kpi;
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
});
//route to submit forgotten password
$app->post('/recovery','recoveryController@recovery');
// Route that uses the reset code to reset a user password
$app->get('/resetpassword/{resetcode}','recoveryController@reset_password');

$app->get('/test_kpi', function () use ($app){
    return test_kpi::all();


});

