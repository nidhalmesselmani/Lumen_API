<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
class bms_www_bits extends Model {
    protected $table = 'bms_www_bits';
    protected $fillable = [
        'fk_Company','Titre','SousTitre','xAxisLabel','yAxisLabel'
    ];

    protected $primaryKey = 'id_TimeSeriesMaster';
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'CreateAt';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'UpdatedAt';
    
    
}