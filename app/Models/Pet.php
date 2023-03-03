<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pckpetlists';

    protected $fillable = [
        'ClinicID',
        'CustNo',
        'KarteNo',
        'PetNo',
        'PetName',
        'PetName_furigana',
        'PetKind',
        'PetBreed',
        'PetBirthday',
        'PetDeathType',
        'PetDeathDate',
        'PetSex',
        'PetValid',
        'VacInfo',
        'Memo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];
}
