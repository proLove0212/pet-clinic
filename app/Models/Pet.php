<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use HasFactory;
    use SoftDeletes;

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
