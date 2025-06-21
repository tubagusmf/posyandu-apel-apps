<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananIbuHamil extends Model
{
    use HasFactory;

    protected $table = 'tbl_layanan_ibu_hamil';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nik_ibu_hamil',
        'nik_kader',
        'tensi',
        'bb_ibu_hamil',
        'usia_hamil',
        'kondisi',
        'tgl_kunjungan',
    ];

    public function ibu()
    {
        return $this->belongsTo(IbuHamil::class, 'nik_ibu_hamil', 'nik_ibu_hamil');
    }

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'nik_kader', 'nik_kader');
    }
}
