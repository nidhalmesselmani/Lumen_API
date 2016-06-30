<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
class bms_www_biflash extends Model {
    protected $table = 'bms_www_biflash';
    protected $fillable = [
        'fk_FlashCateg','idFlash','Titre','SousTitre','Nombre','Montant','Devise','Severite','F1','F2','F3'
    ];

    protected $primaryKey = 'fk_Company';
    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'DateCreation';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'DateMAJ';


}