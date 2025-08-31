<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Bidan extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_data_bidan';
    protected $primaryKey = 'nik_bidan';
    public $timestamps = false;

    protected $fillable = [
        'nik_bidan', 'nama_bidan', 'username', 'password',
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'nik_bidan' => 'string',
    ];
}
