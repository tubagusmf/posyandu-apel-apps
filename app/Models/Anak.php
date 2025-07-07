<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anak extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tbl_data_bayi_balita';
    protected $primaryKey = 'nik_anak';

    protected $fillable = [
        'nik_anak',
        'nama_anak',
        'nama_ibu',
        'tgl_lahir',
        'jenis_kelamin',
        'telepon',
        'alamat',
    ];

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->tgl_lahir)->age;
    }
}
