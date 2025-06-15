<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Kader extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_data_user';
    protected $primaryKey = 'nik_kader';
    public $timestamps = false;

    protected $fillable = [
        'nik_kader', 'nama_kader', 'username', 'password',
    ];

    protected $hidden = ['password'];
}
