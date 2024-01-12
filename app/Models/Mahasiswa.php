<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
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
        'id_users',
        'nim',
        'nama',
        'id_kelas',
        'created_by',
        'created_at',
        'updated_by',
    ];
}
