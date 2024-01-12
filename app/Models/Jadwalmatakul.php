<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalmatakul extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // public function jurusan()
    // {
    //     return $this->belongsTo(Jurusan::class, 'id_jurusan');
    // }

    protected $fillable = [
        'id',
        'id_kelas',
        'id_matakuls',
        'id_hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'created_by',
        'created_at',
        'updated_by',
    ];
}
