<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ibu extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'nik_ibu';

    protected $table = 'tbl_data_ibu';

    protected $fillable = [
        'nik_ibu',
        'nama_ibu',
        'tgl_lahir',
        'telepon',
        'alamat',
    ];

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tgl_lahir)->age;
    }
}
