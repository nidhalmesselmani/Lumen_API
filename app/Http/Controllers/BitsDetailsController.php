<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use response;
use App\bms_www_bitsdetails;
class BitsDetailsController extends Controller{
    public function  get(){
        return  response(bms_www_bitsdetails::all());
    }
    public function  createBitDetails(Request $request){
        $input = $request->all();


        $create = bms_www_bitsdetails::create($input);
        return response($create);
    }
    public function destroyBitDetails(Request $request)
    {

        return bms_www_bitsdetails::where('id_TimeSeriesDetails',$request->id_TimeSeriesDetails)->delete();

    }
    public function updateBitDetails(Request $request)

    {
        //dd($request->idUser);
        $Bit = bms_www_bitsdetails::find($request->id_TimeSeriesDetails);

        $Bit->fk_TimeSeriesMaster = $request->input('fk_TimeSeriesMaster');
        $Bit->xAxisValue = $request->input('xAxisValue');
        $Bit->yAxisValue = $request->input('yAxisValue');

        $Bit->save();
        return response(  'BitDetails Updated Succesfully');




    }

}