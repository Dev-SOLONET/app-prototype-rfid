<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'nama',
        'nik',
        'user_id',
        'jenis_kelamin',
        'alamat',
        'no_hp'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    
}
