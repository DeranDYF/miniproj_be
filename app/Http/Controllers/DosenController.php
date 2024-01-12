<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'dosen';
        $data['title'] = 'DOSEN';
        return view('dosen/dosen', $data);
    }

    public function getAllDosen()
    {
        $data = Dosen::all();
        return response()->json($data);
    }

    public function getDosenById($id)
    {
        $data = Dosen::join('users', 'users.id', '=', 'dosens.id_users')
            ->select('dosens.*', 'users.email')
            ->find($id);
        return response()->json($data);
    }
    protected function addDosen(Request $request)
    {
        $find = Dosen::where('nip', $request->input('dosen-add-nim-dosen'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'NIP Dosen Sudah Terdaftar!'));
        } else {
            $find_users = User::where('username', $request->input('dosen-add-usename-dosen'))->first();
            if ($find_users) {
                echo json_encode(array('success' => false, 'msg' => 'Username Dosen Sudah Terdaftar!'));
            } else {
                DB::beginTransaction();
                try {
                    $user = User::create([
                        'name'       => $request->input('dosen-add-nama-dosen'),
                        'username'   => $request->input('dosen-add-username-dosen'),
                        'level'      => 'dosen',
                        'email'      => $request->input('dosen-add-email-dosen'),
                        'password'   => bcrypt($request->input('dosen-add-password-dosen')),
                    ]);

                    if ($user) {
                        $dosen = Dosen::create([
                            'id_users'   => $user->id,
                            'nip'        => $request->input('dosen-add-nim-dosen'),
                            'nama'       => $request->input('dosen-add-nama-dosen'),
                            'no_telp'    => $request->input('dosen-add-no-telp-dosen'),
                            'created_by' => $request->input('created'),
                        ]);

                        if ($dosen) {
                            DB::commit();
                            echo json_encode(array('success' => true, 'msg' => 'Tambah Dosen Berhasil!'));
                        } else {
                            DB::rollBack();
                            echo json_encode(array('success' => false, 'msg' => 'Tambah Dosen Gagal!'));
                        }
                    } else {
                        DB::rollBack();
                        echo json_encode(array('success' => false, 'msg' => 'Tambah Dosen Gagal!'));
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    echo json_encode(array('success' => false, 'msg' => 'Tambah Dosen Gagal! ' . $e->getMessage()));
                }
            }
        }
    }

    public function editDosen(Request $request)
    {
        $find = Dosen::where('nip', $request->input('dosen-add-nim-dosen'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'NIP Dosen Sudah Terdaftar!'));
        } else {
            $find_users = User::where('username', $request->input('dosen-add-usename-dosen'))->first();
            if ($find_users) {
                echo json_encode(array('success' => false, 'msg' => 'Username Dosen Sudah Terdaftar!'));
            } else {
                DB::beginTransaction();
                try {
                    $user = User::find($request->input('dosen-edit-id-user'))
                        ->update([
                            'name'       => $request->input('dosen-edit-nama-dosen'),
                            'email'      => $request->input('dosen-edit-email-dosen'),
                        ]);

                    $dosen = Dosen::find($request->input('dosen-edit-id'))
                        ->update([
                            'nama'       => $request->input('dosen-edit-nama-dosen'),
                            'no_telp'    => $request->input('dosen-edit-no-telp-dosen'),
                        ]);

                    if ($user && $dosen) {
                        DB::commit();
                        echo json_encode(array('success' => true, 'msg' => 'Edit Dosen Berhasil!'));
                    } else {
                        DB::rollBack();
                        echo json_encode(array('success' => false, 'msg' => 'Edit Dosen Gagal!'));
                    }
                } catch (\Exception $e) {
                    DB::rollBack();
                    echo json_encode(array('success' => false, 'msg' => 'Edit Dosen Gagal! ' . $e->getMessage()));
                }
            }
        }
    }

    protected function deleteDosen($id)
    {
        $dosen = Dosen::find($id);
        DB::beginTransaction();
        try {
            $dosen = Dosen::find($id);
            if (!$dosen) {
                throw new \Exception('Dosen not found');
            }
            $user = User::find($dosen->id_users);
            if (!$user) {
                throw new \Exception('User not found');
            }
            $dosen->delete();
            $user->delete();

            DB::commit();
            echo json_encode(array('success' => true, 'msg' => 'Hapus Dosen Berhasil!'));
        } catch (\Exception $e) {
            DB::rollBack();
            echo json_encode(array('success' => false, 'msg' => 'Hapus Dosen Gagal! ' . $e->getMessage()));
        }
    }
}
