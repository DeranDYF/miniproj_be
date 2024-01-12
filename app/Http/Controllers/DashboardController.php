<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwalmatakul;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Matakul;

class DashboardController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'dashboard';
        $data['title'] = 'DASHBOARD';
        $data['count_dosen'] = count(Dosen::all());
        $data['count_mahasiswa'] = count(Mahasiswa::all());
        $data['count_kelas'] = count(Kelas::all());
        $data['count_mata_kuliah'] = count(Matakul::all());
        return view('dashboard/dashboard', $data);
    }

    public function getAllJadwalmatakulMahasiswa()
    {
        $data = Jadwalmatakul::join('kelas', 'kelas.id', '=', 'jadwalmatakuls.id_kelas')
            ->join('matakuls', 'matakuls.id', '=', 'jadwalmatakuls.id_matakuls')
            ->join('dosens', 'dosens.id', '=', 'matakuls.id_dosen')
            ->join('mahasiswas', 'mahasiswas.id_kelas', '=', 'kelas.id')
            ->leftjoin('haris', 'haris.id', '=', 'jadwalmatakuls.id_hari')
            ->where('mahasiswas.id_users', '=', auth()->user()->id)
            ->select('jadwalmatakuls.*', 'kelas.kelas as nama_kelas', 'haris.hari', 'matakuls.kode_mata_kuliah', 'matakuls.nama_mata_kuliah', 'dosens.nama as dosen')
            ->get();
        return response()->json($data);
    }

    public function getAllJadwalmatakulDosen()
    {
        $data = Jadwalmatakul::join('kelas', 'kelas.id', '=', 'jadwalmatakuls.id_kelas')
            ->join('matakuls', 'matakuls.id', '=', 'jadwalmatakuls.id_matakuls')
            ->join('dosens', 'dosens.id', '=', 'matakuls.id_dosen')
            ->leftjoin('haris', 'haris.id', '=', 'jadwalmatakuls.id_hari')
            ->where('dosens.id_users', '=', auth()->user()->id)
            ->select('jadwalmatakuls.*', 'kelas.kelas as nama_kelas', 'haris.hari', 'matakuls.kode_mata_kuliah', 'matakuls.nama_mata_kuliah', 'dosens.nama as dosen')
            ->get();
        return response()->json($data);
    }
}
