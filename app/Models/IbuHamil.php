<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IbuHamil extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tbl_data_ibu_hamil';
    protected $primaryKey = 'nik_ibu_hamil';

    protected $fillable = [
        'nik_ibu_hamil',
        'nama_ibu_hamil',
        'tgl_lahir',
        'telepon',
        'alamat',
    ];

    public function getUsiaAttribute()
    {
        $tgl_lahir = Carbon::parse($this->tgl_lahir);
        return $tgl_lahir->age;
    }
}
