<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceptionSetting extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pckreceptionsettings';

    protected $fillable = [
        'PeaksUserNo',
        'ClinicID',
        'ClinicName',
        'Time1EnableDate',
        'RunningColumn1',
        'StartTime1',
        'EndTime1',
        'Time2EnableDate',
        'RunningColumn2',
        'StartTime2',
        'EndTime2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

}
