<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
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
    public function jadwalmatakuls()
    {
        return $this->hasMany(Jadwalmatakul::class, 'id_kelas');
    }

    protected $fillable = [
        'id',
        'kelas',
        'id_jurusan',
        'created_by',
        'created_at',
        'updated_by',
    ];
}
