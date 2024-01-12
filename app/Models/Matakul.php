<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakul extends Model
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
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'id_dosen',
        'sks',
        'created_by',
        'created_at',
        'updated_by',
    ];
}
