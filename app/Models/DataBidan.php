<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBidan extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'tbl_data_bidan';
    protected $primaryKey = 'nik_bidan';

    protected $fillable = [
        'nik_bidan',
        'nama_bidan',
        'username',
        'password',
    ];
}
