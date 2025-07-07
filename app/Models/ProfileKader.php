<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ProfileKader extends Authenticatable
{
    protected $table = 'tbl_data_kader';
    protected $primaryKey = 'nik_kader';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nik_kader', 'nama_kader', 'username', 'password'
    ];

    protected $hidden = ['password'];
}
