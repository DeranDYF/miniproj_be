<?php

namespace App\Http\Controllers;

use App\Models\Matakul;
use App\Models\Jadwalmatakul;
use App\Models\Hari;
use Illuminate\Http\Request;

class JadwalmatakulController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'jadwalmatakul';
        $data['title'] = 'JADWAL MATA KULIAH';
        return view('jadwalmatakul/jadwalmatakul', $data);
    }

    public function getAllJadwalmatakul()
    {
        $data = Jadwalmatakul::join('kelas', 'kelas.id', '=', 'jadwalmatakuls.id_kelas')
            ->join('matakuls', 'matakuls.id', '=', 'jadwalmatakuls.id_matakuls')
            ->leftjoin('haris', 'haris.id', '=', 'jadwalmatakuls.id_hari')
            ->select('jadwalmatakuls.*', 'kelas.kelas as nama_kelas', 'matakuls.nama_mata_kuliah', 'haris.hari')
            ->get();
        return response()->json($data);
    }

    public function getAllHari()
    {
        $data = Hari::all();
        return response()->json($data);
    }

    public function getJadwalmatakulById($id)
    {
        $data = Jadwalmatakul::find($id);
        return response()->json($data);
    }

    public function getJadwalmatakulByIdKelas($id)
    {
        $data = Jadwalmatakul::where('id_kelas', $id)->get();
        return response()->json($data);
    }

    public function editJadwalmatakul(Request $request)
    {
        $find_sks = Jadwalmatakul::join('matakuls', 'jadwalmatakuls.id_matakuls', '=', 'matakuls.id')
            ->where('jadwalmatakuls.id', $request->input('jadwalmatakul-edit-id'))
            ->first();

        if ($find_sks) {
            $find_available = Jadwalmatakul::where('ruangan', $request->input('jadwalmatakul-edit-ruangan'))->get();

            if ($find_available->isNotEmpty()) {
                $jamMulaiInput = $request->input('jadwalmatakul-edit-jam-mulai');
                $jamSelesaiInput = date('H:i', strtotime($jamMulaiInput . " + " . ($find_sks->sks * 45) . " minutes"));
                $conflictingSchedule = $find_available->filter(function ($schedule) use ($jamMulaiInput, $jamSelesaiInput) {
                    $scheduleJamMulai = $schedule->jam_mulai;
                    $scheduleJamSelesai = date('H:i', strtotime($schedule->jam_mulai . " + " . ($schedule->sks * 45) . " minutes"));

                    return (
                        ($jamMulaiInput >= $scheduleJamMulai && $jamMulaiInput < $scheduleJamSelesai) ||
                        ($jamSelesaiInput > $scheduleJamMulai && $jamSelesaiInput <= $scheduleJamSelesai) ||
                        ($jamMulaiInput <= $scheduleJamMulai && $jamSelesaiInput >= $scheduleJamSelesai)
                    );
                });

                if ($conflictingSchedule->isEmpty()) {
                    $update = Jadwalmatakul::find($request->input('jadwalmatakul-edit-id'))
                        ->update([
                            'id_hari' => $request->input('jadwalmatakul-edit-id-hari'),
                            'jam_mulai' => $jamMulaiInput,
                            'jam_selesai' => $jamSelesaiInput,
                            'ruangan' => $request->input('jadwalmatakul-edit-ruangan'),
                        ]);

                    if ($update) {
                        return response()->json(['success' => true, 'msg' => 'Edit jadwal mata kuliah berhasil!']);
                    } else {
                        return response()->json(['success' => false, 'msg' => 'Edit jadwal mata kuliah gagal!']);
                    }
                } else {
                    return response()->json(['success' => false, 'msg' => 'Ruangan sedang digunakan pada jam tersebut!']);
                }
            } else {
                $update = Jadwalmatakul::find($request->input('jadwalmatakul-edit-id'))
                    ->update([
                        'id_hari'     => $request->input('jadwalmatakul-edit-id-hari'),
                        'jam_mulai'   => $request->input('jadwalmatakul-edit-jam-mulai'),
                        'jam_selesai' => date('H:i', strtotime($request->input('jadwalmatakul-edit-jam-mulai') . " + " . ($find_sks->sks * 45) . " minutes")),
                        'ruangan'     => $request->input('jadwalmatakul-edit-ruangan'),
                    ]);

                if ($update) {
                    return response()->json(['success' => true, 'msg' => 'Edit jadwal mata kuliah berhasil!']);
                } else {
                    return response()->json(['success' => false, 'msg' => 'Edit jadwal mata kuliah gagal!']);
                }
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'Edit jadwal mata kuliah gagal!']);
        }
    }


    protected function deleteJadwalmatakul($id)
    {
        $delete = Jadwalmatakul::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus jadwal mata kuliah Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus jadwal mata kuliahh Gagal!'));
        }
    }
}