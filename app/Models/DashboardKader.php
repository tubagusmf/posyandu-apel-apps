<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class DashboardKader extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_data_kader';
    protected $primaryKey = 'nik_kader';
    public $timestamps = false;

    protected $fillable = [
        'nik_kader', 'nama_kader', 'username', 'password',
    ];

    protected $hidden = ['password'];
}
