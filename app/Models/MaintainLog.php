<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintainLog extends Model
{
    use HasFactory;

    protected $table = 'maintain_logs';

    protected $fillable = [
        'from',
        'to',
        'memo',
    ];
}
