<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reception extends Model
{
    use HasFactory;

    protected $table = 'pckreceptionlists';

    protected $fillable = [
        'ClinicID',
        'CustNo',
        'VisitDate',
        'VisitOrderIndex',
        'VisitReason',
        'EntryTime',
        'TakeTime',
        'Status',
        'NewPatientNo',
        'RegistDone',
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

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'cust_id', 'id');
    }

}
