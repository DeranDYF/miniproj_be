<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jadwalmatakul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class KelasController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'kelas';
        $data['title'] = 'KELAS';
        return view('kelas/kelas', $data);
    }

    public function getAllKelas()
    {
        $data = Kelas::join('jurusans', 'jurusans.id', '=', 'kelas.id_jurusan')
            ->select('kelas.*', 'jurusans.nama_jurusan as jurusan')
            ->get();
        return response()->json($data);
    }
    public function getKelasById($id)
    {
        $data = Kelas::find($id);
        return response()->json($data);
    }

    protected function addKelas(Request $request)
    {
        $find = Kelas::where('kelas', $request->input('kelas-add-nama-Kelas'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'Nama Kelas Sudah Terdaftar!'));
        } else {
            DB::beginTransaction();
            try {
                $create = Kelas::create([
                    'kelas' => $request->input('kelas-add-nama-Kelas'),
                    'id_jurusan' => $request->input('kelas-add-jurusan'),
                    'created_by' => $request->input('created'),
                ]);
                if ($create) {
                    $data = $request->input('add-jadwalmatakuls', []);
                    foreach ($data as $item) {
                        Jadwalmatakul::create([
                            'id_kelas' => $create->id,
                            'id_matakuls' => $item,
                            'created_by' => $request->input('created'),
                        ]);
                    }
                    DB::commit();
                    echo json_encode(array('success' => true, 'msg' => 'Tambah Kelas Berhasil!'));
                } else {
                    DB::rollBack();
                    echo json_encode(array('success' => false, 'msg' => 'Tambah Kelas Berhasil!'));
                }
            } catch (\Exception $e) {
                DB::rollBack();
                echo json_encode(array('success' => false, 'msg' => 'Tambah Dosen Gagal! ' . $e->getMessage()));
            }
        }
    }

    public function editKelas(Request $request)
    {
        $kelasId = $request->input('kelas-edit-id');
        $kelas = Kelas::find($kelasId);

        if (!$kelas) {
            echo json_encode(array('success' => false, 'msg' => 'Kelas tidak ditemukan!'));
            return;
        }

        $find = Kelas::where('kelas', $request->input('kelas-edit-nama-kelas'))->first();

        if ($find && $find->id != $kelasId) {
            echo json_encode(array('success' => false, 'msg' => 'Nama Kelas Sudah Terdaftar!'));
            return;
        }

        $existingMatakuls = $kelas->jadwalmatakuls()->pluck('id_matakuls')->toArray();

        $kelas->update([
            'kelas' => $request->input('kelas-edit-nama-kelas'),
            'id_jurusan' => $request->input('kelas-edit-jurusan'),
        ]);

        $newMatakuls = $request->input('edit-jadwalmatakuls', []);

        $deletedMatakuls = array_diff($existingMatakuls, $newMatakuls);
        Jadwalmatakul::whereIn('id_matakuls', $deletedMatakuls)->delete();

        foreach ($newMatakuls as $item) {
            Jadwalmatakul::updateOrCreate([
                'id_kelas' => $kelasId,
                'id_matakuls' => $item,
                'created_by' => $request->input('created_edit'),
            ]);
        }

        echo json_encode(array('success' => true, 'msg' => 'Edit Kelas Berhasil!'));
    }

    protected function deleteKelas($id)
    {
        DB::beginTransaction();
        try {
            $find = Jadwalmatakul::where('id_kelas', $id)->get();
            if ($find) {
                Jadwalmatakul::where('id_kelas', $id)->delete();
            }
            $delete = Kelas::find($id)->delete();
            if ($delete) {
                DB::commit();
                echo json_encode(array('success' => true, 'msg' => 'Hapus Kelas Berhasil!'));
            } else {
                DB::rollBack();
                echo json_encode(array('success' => false, 'msg' => 'Hapus Kelas Gagal!'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            echo json_encode(array('success' => false, 'msg' => 'Tambah Dosen Gagal! ' . $e->getMessage()));
        }
    }
}