<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionSetting extends Model
{
    use HasFactory;

    protected $table = 'reception_settings';

    protected $fillable = [
        'user_id',
        'time1_enable_date',
        'running_column1',
        'start_time1',
        'end_time1',
        'time2_enable_date',
        'running_column2',
        'start_time2',
        'end_time2',
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
