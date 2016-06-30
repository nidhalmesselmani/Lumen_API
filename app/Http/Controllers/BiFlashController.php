<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use response;
use App\bms_www_biflash;
class BiFlashController extends Controller{
    public function  get(){
        return  response(bms_www_biflash::all());
    }
    public function  createBiFlash(Request $request){
        $input = $request->all();


        $create = bms_www_biflash::create($input);
        return response($create);
    }
    public function destroyBiFlash(Request $request)
    {

        return bms_www_biflash::where('fk_Company',$request->fk_Company)->delete();


    }
    public function updateBiFlash(Request $request)

    {


        $BitFLash =  bms_www_biflash::where('fk_Company', $request->fk_Company)->first();

        $BitFLash->idFlash = $request->input('idFlash');
        $BitFLash->fk_FlashCateg = $request->input('fk_FlashCateg');
        $BitFLash->Titre = $request->input('Titre');
        $BitFLash->SousTitre = $request->input('SousTitre');
        $BitFLash->Nombre = $request->input('Nombre');
        $BitFLash->Devise = $request->input('Devise');
        $BitFLash->Severite = $request->input('Severite');

        $BitFLash->F1 = $request->input('F1');
        $BitFLash->F2 = $request->input('F2');
        $BitFLash->F3 = $request->input('F3');

        $BitFLash->save();





        return response(  'BitFlash Updated Succesfully');




    }

}