<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\User;
class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function postLogin(Request $request)
    {
//make a validtion of the posted credentials
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);

        try {
//if the credentials doesn't meet any user, user not found will be returned
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//if the token expired, this message will be returned
            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
//if the token is invalid, this message will be returned
            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
//if there is no token, this message will be returned
            return response()->json(['token_absent' => $e->getMessage()], 500);

        }
        //else if everything went well
        //a date object will be created with the current date and time
        $today = date("Y-m-d H:i:s");
        //get the user having the same email as the posted email
        $user = User::where('email',$request->email)->first();
        //the last_coonection_date field will recieve the dated object
        $user->last_connection_date = $today;
        //and the changes will be saved
        $user->save();
        //finally a token will be returned
        return response()->json(compact('token'));
    }
    public function getAuthenticatedUser()
    {

        try {
//here the post token will be parsed and if the user not found, a user not found message will be returned
            if (! $user = $this->jwt->parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//if the token expired, this message will be returned
            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
//if the token is invalid, this message will returned
            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
//if the token is abscent, this message will be returned
            return response()->json(['token_absent'], $e->getStatusCode());

        }

        // the token is valid and we have found the user
        return response()->json(compact('user'));
    }

}