<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
class bms_www_bitsdetails extends Model {
    protected $table = 'bms_www_bitsdetails';
    protected $fillable = [
        'fk_TimeSeriesMaster','xAxisValue','yAxisValue'
    ];

    protected $primaryKey = 'id_TimeSeriesDetails';
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    //const CREATED_AT = 'DateCreation';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
   // const UPDATED_AT = 'DateMAJ';
    public $timestamps = false;

}