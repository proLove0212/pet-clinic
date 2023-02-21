<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'cust_id',
        'karte_no',
        'pet_no',
        'name',
        'name_furigana',
        'kind',
        'breed',
        'birthday',
        'death_type',
        'death_date',
        'sex',
        'is_valid',
        'vacc_info',
        'memo',
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
