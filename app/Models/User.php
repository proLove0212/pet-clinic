<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use ESolution\DBEncryption\Traits\EncryptedAttribute;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use EncryptedAttribute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'pckusers';

    protected $fillable = [
        'PeaksUserNo',
        'ClinicID',
        'ClinicName',
        'TelNo',
        'TelNum',
        'TelNo_2',
        'TelNum_2',
        'email',
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


    protected $encryptable = [

    ];
}
