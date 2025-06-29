<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rujukan extends Model
{
    use HasFactory;

    protected $table = 'tbl_rujukan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'no_rujukan',
        'nik_kader',
        'nik_ibu_hamil',
        'catatan_kesehatan',
        'tgl_rujukan',
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
