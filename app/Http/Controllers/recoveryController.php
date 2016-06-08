<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\User;
class recoveryController extends Controller{

    public function reset_password($resetcode){
        //Grab the user record where the reset code sent in the email matches the database
        $user = User::where('resetcode','=',$resetcode)
            ->where('password_temp','!=','');
        //if the DB search comes back with the records from the query
        if($user->count()){
            //Set The user variable to the first returned record
            $user = $user->first();

            //Set the user password to the value stored in password_temp, and clear password temp and reset code
            $user->password = $user->password_temp;
            $user->password_temp = '';
            $user->resetcode = '';
            //Save the record to the database
            if($user->save())
            {
                //let the user that he can use the new password
                return response('your account has been reset, you can use the new password');
            }
        }//End User Count
//if no user record was found, then inform the user that the reset code was not found in the database
        return response('could not recover account, Please contact nidhalmesselmani@yahoo.fr for further assistance');
    }//End Reset Password function






    public function recovery(Request $request){
        //gather information from forgot password angular form
        $userdata = array(
            'email'=>$request->email
        );
        //Set Validation Rule
        $rules = array(
            'email'=>'required|email',
        );
        //Run validation check
        $validator = Validator::make($userdata,$rules);

        // if validation fails
        if($validator->fails()){
            return response($validator->errors()->all());
            // if validation passes
        }else {
            //Grab the user record by the email address provided
            $user = User::where('email','=',$request->input('email'));

            //if the user record exist then grab the first returned resutlt
            if($user->count()){
                $user = $user->first();
                //Generate a reset code and the temp password
                $resetcode = str_random(60);
                $passwd = str_random(15);
//Set the new values in the user
                $user->password_temp = Hash::make($passwd);
                $user->resetcode = $resetcode;
                // save reset code and temp password to the user db
                if ($user->save()){
                    //set data array, this is the information that will be passed from the angular forgot password form
                    $data = array(
                        'email'=>$user->email,
                        'name'=>$user->name,
                        'link'=>URL::to('resetpassword',$resetcode),
                        'password'=>$passwd,
                    );
                    $email= $user->email;
                    //Send an e-mail to the user
                    Mail::send('auth.reminder',$data,function($message) use($user,$data){

                        $message->to($user->email, $user->name)->subject('Spare Parts Password Recovery Request');


                    });
                    //inform the user to check their email
                    return response('pls check your email');
                }
                // If the email address doen not match an email email address in the database
                return response('email not found');


            }



        }


    }
}