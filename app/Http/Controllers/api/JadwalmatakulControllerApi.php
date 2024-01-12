<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Jadwalmatakul;
use App\Models\Hari;
use Illuminate\Support\Facades\DB;

class JadwalmatakulControllerApi extends Controller
{
    public function index()
    {
        try {
            $dosen = Jadwalmatakul::join('kelas', 'kelas.id', '=', 'jadwalmatakuls.id_kelas')
                ->join('matakuls', 'matakuls.id', '=', 'jadwalmatakuls.id_matakuls')
                ->leftjoin('haris', 'haris.id', '=', 'jadwalmatakuls.id_hari')
                ->select('jadwalmatakuls.*', 'kelas.kelas as nama_kelas', 'matakuls.nama_mata_kuliah', 'haris.hari')
                ->get();
            return response()->json($dosen, Response::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllHari(): JsonResponse
    {
        try {
            $data = Hari::all();
            return response()->json($data, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getJadwalmatakulById($id): JsonResponse
    {
        try {
            $data = Jadwalmatakul::find($id);
            return response()->json($data, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getJadwalmatakulByIdKelas($id): JsonResponse
    {
        try {
            $data = Jadwalmatakul::where('id_kelas', $id)->get();
            return response()->json($data, JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function editJadwalmatakul(Request $request): JsonResponse
    {
        try {
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
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    protected function deleteJadwalmatakul($id): JsonResponse
    {
        try {
            $delete = Jadwalmatakul::find($id)->delete();
            if ($delete) {
                return response()->json(['success' => true, 'msg' => 'Hapus jadwal mata kuliah Berhasil!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Hapus jadwal mata kuliah Gagal!']);
            }
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
