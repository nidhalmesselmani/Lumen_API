<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use response;
use App\bms_www_bits;
class BitsController extends Controller{
    public function  get(){
        return  response(bms_www_bits::all());
    }
    public function  createBit(Request $request){
        $input = $request->all();


        $create = bms_www_bits::create($input);
        return response($create);
    }
    public function destroyBit(Request $request)
    {

        return bms_www_bits::where('id_TimeSeriesMaster',$request->id_TimeSeriesMaster)->delete();

    }
    public function updateBit(Request $request)

    {
        //dd($request->idUser);
        $Bit = bms_www_bits::find($request->id_TimeSeriesMaster);

        $Bit->fk_Company = $request->input('fk_Company');
        $Bit->Titre = $request->input('Titre');
        $Bit->SousTitre = $request->input('SousTitre');
        $Bit->xAxisLabel = $request->input('xAxisLabel');
        $Bit->yAxisLabel = $request->input('yAxisLabel');
        $Bit->save();
        return response(  'Bit Updated Succesfully');




    }

}