<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProfileBidan extends Model
{
    protected $table = 'tbl_data_bidan';
    protected $primaryKey = 'nik_bidan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nik_bidan', 'nama_bidan', 'username', 'password'
    ];

    protected $hidden = ['password'];
}
