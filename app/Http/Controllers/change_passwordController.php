<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
class change_passwordController extends  Controller {

    public function  change(Request $request){
//get the user that have the same id as the posted id
        $user = User::where('id',$request->id)->first();

   //check if the password of the user is the same as the posted password
        if (Hash::check($request->password, $user->password)){
            //if the condition is true, the new password will be encrypted and affected to the password field
            $user->password = Hash::make($request->new_password);
           //check if the password field is successfully changed
            if($user->save()){
                //if yes
                //create new object that has the user credentials
                $data = array(
                    'email'=>$user->email,
                    'name'=>$user->name

                );
                //send a notification mail to the user (password_change is a view you can find under
                // ressources/views/auth/ )
                Mail::send('auth.password_change',$data,function($message) use($user){

                    $message->to($user->email)->subject('Password has changed');


                });
                //if everything went well, this message will be returned
                return 'password has been changed, a notification has been sent to your email ';
            };


        }else{
            //if the posted password is not the same as the user having the same id as the posted id, this message will be retur
            return 'password incorrect';

        };


    }


}