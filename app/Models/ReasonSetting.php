<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pckreasonsettings';

    protected $fillable = [
        'user_id',
        'visit_reason',
        'visit_disp_order',
        'take_time',
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
