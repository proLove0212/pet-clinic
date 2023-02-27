<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $table = 'pckcustlists';

    protected $fillable = [
        'DBNo',
        'ClinicID',
        'CustNo',
        'CustFamilyName',
        'CustName',
        'CustFamilyName_furigana',
        'CustName_furigana',
        'Address',
        'Tel1',
        'Tel2',
        'Tel3',
        'Tel4',
        'Tel5',
        'Tel6',
        'Tel7',
        'Tel8',
        'Tel1Num',
        'Tel2Num',
        'Tel3Num',
        'Tel4Num',
        'Tel5Num',
        'Tel6Num',
        'Tel7Num',
        'Tel8Num',
        'Tel1Last4',
        'Tel2Last4',
        'Tel3Last4',
        'Tel4Last4',
        'Tel5Last4',
        'Tel6Last4',
        'Tel7Last4',
        'Tel8Last4',
        'MailAddress',
        'Kubun',
        'LastCommingDate',
        'NextDate',
        'NextReason',
        'CustValid',
        'Replace',
        'EditID',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];
}
