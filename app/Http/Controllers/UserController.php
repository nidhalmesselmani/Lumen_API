<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use response;
use App\User;
class UserController extends Controller{
    public function  getUsers(){
        return  response(User::all());
    }
    public function  createUser(Request $request){
        $input = $request->all();

        $input["Password"] = Hash::make($request->Password);
        $create = User::create($input);
        return response($create);
    }
    public function destroyUser(Request $request)
    {

        return User::where('idUser',$request->idUser)->delete();

    }
    public function updateUser(Request $request)

    {
       //dd($request->idUser);
        $User = User::find($request->idUser);

        $User->fk_Company = $request->input('fk_Company');
        $User->Nom = $request->input('Nom');
        $User->Prenom = $request->input('Prenom');
        $User->Password = $request->input('Password');



  
        $User->save();
        return response(  'User Updated Succesfully');




    }

}