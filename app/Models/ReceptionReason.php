<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionReason extends Model
{
    use HasFactory;
    protected $table = 'pckreasonsettings';

    protected $fillable = [
        'PeaksUserNo',
        'ClinicID',
        'VisitReason',
        'VisitReasonDispOrder',
        'TakeTime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];
}
