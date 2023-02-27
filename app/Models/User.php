<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    protected $fillable = [
        'PeaksUserNo',
        'ClinicID',
        'ClinicName',
        'TelNo',
        'TelNum',
        'TelNum_2',
        'MailAddress',
        'Password',
        'PasswordExpiry',
        'LoginDateTime',
        'License',
        'PatientRegOpt',
        'ReceptionOpt',
        'ReserveOpt',
        'Option1',
        'Option2',
        'DBNo',
        'MaintenanceLock',
        'Memo',
        'CustStatus',
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
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
