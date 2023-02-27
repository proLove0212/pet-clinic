<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicSetting extends Model
{
    use HasFactory;

    protected $table = 'pckreasonsettings';

    protected $fillable = [
        'user_id',
        'visit_reason',
        'visit_disp_order',
        'take_time',
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
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
