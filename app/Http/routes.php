<?php
use App\User;

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('/auth/login', 'AuthController@postLogin');

$app->group(['middleware' => ['auth:api']], function($app)
{

    $app->get('/users', function() {
        return response()->json([
            User::all()
        ]);
    });

});
//route to submit forgotten password
$app->post('/recovery','recoveryController@recovery');
// Route that uses the reset code to reset a user password
$app->get('/resetpassword/{resetcode}','recoveryController@reset_password');
//Route::get('resetpassword/{resetcode}','UsersController@reset_password');
