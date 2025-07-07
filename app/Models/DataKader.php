<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKader extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tbl_data_kader';
    protected $primaryKey = 'nik_kader';

    protected $fillable = [
        'nik_kader',
        'nama_kader',
        'username',
        'password',
    ];
}
