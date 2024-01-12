<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'mahasiswa';
        $data['title'] = 'MAHASISWA';
        return view('mahasiswa/mahasiswa', $data);
    }

    public function getAllMahasiswa()
    {
        $data = Mahasiswa::join('kelas', 'kelas.id', '=', 'mahasiswas.id_kelas')
            ->join('jurusans', 'jurusans.id', '=', 'kelas.id_jurusan')
            ->select('mahasiswas.*', 'kelas.kelas', 'jurusans.nama_jurusan as jurusan')
            ->get();
        return response()->json($data);
    }

    public function getMahasiswaById($id)
    {
        $data = Mahasiswa::join('users', 'users.id', '=', 'mahasiswas.id_users')
            ->select('mahasiswas.*', 'users.email')
            ->find($id);
        return response()->json($data);
    }

    protected function addMahasiswa(Request $request)
    {
        $find = Mahasiswa::where('nim', $request->input('mahasiswa-add-nim-Mahasiswa'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'NIM Mahasiswa Sudah Terdaftar!'));
        } else {
            $find_users = User::where('username', $request->input('mahasiswa-add-usename-Mahasiswa'))->first();
            if ($find_users) {
                echo json_encode(array('success' => false, 'msg' => 'Username Mahasiswa Sudah Terdaftar!'));
            } else {
                DB::beginTransaction();
                try {
                    $user = User::create([
                        'name'       => $request->input('mahasiswa-add-nama-mahasiswa'),
                        'username'   => $request->input('mahasiswa-add-username-mahasiswa'),
                        'level'      => 'mahasiswa',
                        'email'      => $request->input('mahasiswa-add-email-mahasiswa'),
                        'password'   => bcrypt($request->input('mahasiswa-add-password-mahasiswa')),
                    ]);

                    if ($user) {
                        $mahasiswa = Mahasiswa::create([
                            'id_users'    => $user->id,
                            'nim'        => $request->input('mahasiswa-add-nim-mahasiswa'),
                            'nama'       => $request->input('mahasiswa-add-nama-mahasiswa'),
                            'id_kelas'   => $request->input('mahasiswa-add-id-kelas'),
                            'created_by' => $request->input('created'),
                        ]);

                        if ($mahasiswa) {
                            DB::commit();
                            echo json_encode(array('success' => true, 'msg' => 'Tambah Mahasiswa Berhasil!'));
                        } else {
                            DB::rollBack();
                            echo json_encode(array('success' => false, 'msg' => 'Tambah Mahasiswa Gagal!'));
                        }
                    } else {
                        DB::rollBack();
                        echo json_encode(array('success' => false, 'msg' => 'Tambah Mahasiswa Gagal!'));
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    echo json_encode(array('success' => false, 'msg' => 'Tambah Mahasiswa Gagal! ' . $e->getMessage()));
                }
            }
        }
    }

    public function editMahasiswa(Request $request)
    {
        $find = Mahasiswa::where('nim', $request->input('Mahasiswa-add-nim-Mahasiswa'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'NIM Mahasiswa Sudah Terdaftar!'));
        } else {
            $find_users = User::where('username', $request->input('Mahasiswa-add-usename-Mahasiswa'))->first();
            if ($find_users) {
                echo json_encode(array('success' => false, 'msg' => 'Username Mahasiswa Sudah Terdaftar!'));
            } else {
                DB::beginTransaction();
                try {
                    $user = User::find($request->input('mahasiswa-edit-id-user'))
                        ->update([
                            'name'       => $request->input('mahasiswa-edit-nama-mahasiswa'),
                            'email'      => $request->input('mahasiswa-edit-email-mahasiswa'),
                        ]);

                    $mahasiswa = Mahasiswa::find($request->input('mahasiswa-edit-id'))
                        ->update([
                            'nama'       => $request->input('mahasiswa-edit-nama-mahasiswa'),
                            'id_kelas'   => $request->input('mahasiswa-edit-id-kelas'),
                        ]);

                    if ($user && $mahasiswa) {
                        DB::commit();
                        echo json_encode(array('success' => true, 'msg' => 'Edit Mahasiswa Berhasil!'));
                    } else {
                        DB::rollBack();
                        echo json_encode(array('success' => false, 'msg' => 'Edit Mahasiswa Gagal!'));
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    echo json_encode(array('success' => false, 'msg' => 'Edit Mahasiswa Gagal! ' . $e->getMessage()));
                }
            }
        }
    }

    protected function deleteMahasiswa($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        DB::beginTransaction();
        try {
            $mahasiswa = Mahasiswa::find($id);
            if (!$mahasiswa) {
                throw new \Exception('Mahasiswa not found');
            }

            $user = User::find($mahasiswa->id_users);
            if (!$user) {
                throw new \Exception('User not found');
            }

            $mahasiswa->delete();
            $user->delete();

            DB::commit();
            echo json_encode(array('success' => true, 'msg' => 'Hapus Mahasiswa Berhasil!'));
        } catch (\Exception $e) {
            DB::rollBack();
            echo json_encode(array('success' => false, 'msg' => 'Hapus Mahasiswa Gagal! ' . $e->getMessage()));
        }
    }
}
