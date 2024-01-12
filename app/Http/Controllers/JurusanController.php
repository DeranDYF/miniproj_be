<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'jurusan';
        $data['title'] = 'JURUSAN';
        return view('jurusan/jurusan', $data);
    }

    public function getAllJurusan()
    {
        $data = Jurusan::all();
        return response()->json($data);
    }

    public function getJurusanById($id)
    {
        $data = Jurusan::find($id);
        return response()->json($data);
    }

    protected function addJurusan(Request $request)
    {
        $find = Jurusan::where('kode_jurusan', $request->input('jurusan-add-kode-jurusan'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'Kode Jurusan Sudah Terdaftar!'));
        } else {
            $create = Jurusan::create([
                'kode_jurusan' => $request->input('jurusan-add-kode-jurusan'),
                'nama_jurusan' => $request->input('jurusan-add-nama-jurusan'),
                'created_by' => $request->input('created'),
            ]);
            if ($create) {
                echo json_encode(array('success' => true, 'msg' => 'Tambah Jurusan Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Tambah Jurusan Berhasil!'));
            }
        }
    }

    public function editJurusan(Request $request)
    {
        $update = Jurusan::find($request->input('jurusan-edit-id'))
            ->update([
                'nama_jurusan' => $request->input('jurusan-edit-nama-jurusan'),
            ]);
        if ($update) {
            echo json_encode(array('success' => true, 'msg' => 'Edit Jurusan Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Edit Jurusan Gagal!'));
        }
    }

    protected function deleteJurusan($id)
    {
        $delete = Jurusan::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus Jurusan Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus Jurusan Gagal!'));
        }
    }
}
