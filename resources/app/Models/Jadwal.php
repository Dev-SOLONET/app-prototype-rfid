<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'shift_id',
    ];

    public function shift()  
    {
        return $this->BelongsTo(Shift::class,'shift_id');
    }

    public function user()  
    {
        return $this->BelongsTo(User::class,'user_id','id');
    }
}
