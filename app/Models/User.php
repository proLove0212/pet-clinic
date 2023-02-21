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
        'user_no',
        'clinic_id',
        'clinic_name',
        'tel_no_new',
        'tel_num_new',
        'tel_no_old',
        'tel_num_old',
        'email',
        'password',
        'password_expired_at',
        'login_at',
        'register_at',
        'license_at',
        'patient_reg_opt',
        'reception_opt',
        'reserve_opt',
        'opt1',
        'opt2',
        'db_no',
        'maintainance_lock',
        'cust_status',
        'memo',
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
