<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananBalita extends Model
{
    use HasFactory;

    protected $table = 'tbl_layanan_bayi_balita';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nik_anak',
        'nik_kader',
        'bb_anak',
        'tb_anak',
        'lk_anak',
        'lila_anak',
        'imunisasi',
        'status_gizi',
        'tgl_imunisasi',
        'catatan_kesehatan',
        'tgl_kunjungan',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'nik_anak', 'nik_anak');
    }

    public function kader()
    {
        return $this->belongsTo(Kader::class, 'nik_kader', 'nik_kader');
    }
}