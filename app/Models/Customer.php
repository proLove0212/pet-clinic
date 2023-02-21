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

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function phones()
    {
        return $this->hasMany('App\Models\CustomerPhone', 'cust_id', 'id');
    }

    public function lastReception()
    {
        return $this->hasOne('App\Models\Reception', 'id', 'last_recept_id');
    }

    public function NextReception()
    {
        return $this->hasOne('App\Models\Reception', 'id', 'next_recept_id');
    }
}
