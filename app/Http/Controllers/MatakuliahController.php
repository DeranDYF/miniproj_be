<?php

namespace App\Http\Controllers;

use App\Models\Matakul;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'mata_kuliah';
        $data['title'] = 'MATA KULIAH';
        return view('mata_kuliah/mata_kuliah', $data);
    }

    public function getAllMatakuliah()
    {
        // $data = Matakul::all();
        $data = Matakul::join('dosens', 'dosens.id', '=', 'matakuls.id_dosen')
            ->select('matakuls.*', 'dosens.nama as nama_dosen')
            ->get();
        return response()->json($data);
    }
    public function getMatakuliahById($id)
    {
        $data = Matakul::find($id);
        return response()->json($data);
    }

    protected function addMatakuliah(Request $request)
    {
        $find = Matakul::where('kode_mata_kuliah', $request->input('mata-kuliah-add-kode-mata-kuliah'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'Nama Mata kuliah Sudah Terdaftar!'));
        } else {
            $create = Matakul::create([
                'kode_mata_kuliah'  => $request->input('mata-kuliah-add-kode-mata-kuliah'),
                'id_dosen'          => $request->input('mata-kuliah-add-id-dosen-mata-kuliah'),
                'nama_mata_kuliah'  => $request->input('mata-kuliah-add-nama-mata-kuliah'),
                'sks'               => $request->input('mata-kuliah-add-sks-mata-kuliah'),
                'created_by'        => $request->input('created'),
            ]);
            if ($create) {
                echo json_encode(array('success' => true, 'msg' => 'Tambah Mata Kuliah Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Tambah Mata Kuliah Berhasil!'));
            }
        }
    }

    public function editMatakuliah(Request $request)
    {
        $find = Matakul::where('nama_mata_kuliah', $request->input('mata-kuliah-edit-nama-Mata_kuliah'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'Kode Mata kuliah Sudah Terdaftar!'));
        } else {
            $update = Matakul::find($request->input('mata-kuliah-edit-id'))
                ->update([
                    'id_dosen'         => $request->input('mata-kuliah-edit-id-dosen-mata-kuliah'),
                    'nama_mata_kuliah' => $request->input('mata-kuliah-edit-nama-mata-kuliah'),
                    'sks'              => $request->input('mata-kuliah-edit-sks-mata-kuliah'),
                ]);
            if ($update) {
                echo json_encode(array('success' => true, 'msg' => 'Edit Mata Kuliah Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Edit Mata Kuliah Gagal!'));
            }
        }
    }

    protected function deleteMatakuliah($id)
    {
        $delete = Matakul::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus Mata Kuliah Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus Mata Kuliah Gagal!'));
        }
    }
}
