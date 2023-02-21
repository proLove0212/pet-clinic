<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'cust_no',
        'family_name',
        'name',
        'family_name_furigana',
        'name_furigana',
        'address',
        'email',
        'kind',
        'last_recept_id',
        'next_recept_id',
        'cust_valid',
        'replace',
        'edit_id',
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
