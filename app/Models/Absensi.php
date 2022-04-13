<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'jam_lembur',
        'shift_id',
    ];

    public function shift()  
    {
        return $this->BelongsTo(Shift::class,'shift_id');
    }

    public function user()  
    {
        return $this->BelongsTo(Karyawan::class,'user_id');
    }

    public function karyawan()  
    {
        return $this->BelongsTo(Karyawan::class,'user_id','user_id');
    }
}
