<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DosenControllerApi extends Controller
{

    public function index()
    {
        try {
            $dosen = Dosen::all();
            return response()->json($dosen, Response::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function store(Request $request): JsonResponse
    {
        try {
            $find = Dosen::where('nip', $request->input('dosen-add-nim-dosen'))->first();
            if ($find) {
                return response()->json(['success' => false, 'msg' => 'NIP Dosen Sudah Terdaftar!']);
            }

            $findUsers = User::where('username', $request->input('dosen-add-username-dosen'))->first();
            if ($findUsers) {
                return response()->json(['success' => false, 'msg' => 'Username Dosen Sudah Terdaftar!']);
            }

            DB::beginTransaction();
            $user = User::create([
                'name'       => $request->input('dosen-add-nama-dosen'),
                'username'   => $request->input('dosen-add-username-dosen'),
                'level'      => 'dosen',
                'email'      => $request->input('dosen-add-email-dosen'),
                'password'   => bcrypt($request->input('dosen-add-password-dosen')),
            ]);

            if (!$user) {
                DB::rollBack();
                return response()->json(['success' => false, 'msg' => 'Tambah Dosen Gagal!']);
            }

            $dosen = Dosen::create([
                'id_users'   => $user->id,
                'nip'        => $request->input('dosen-add-nim-dosen'),
                'nama'       => $request->input('dosen-add-nama-dosen'),
                'no_telp'    => $request->input('dosen-add-no-telp-dosen'),
                'created_by' => $request->input('created'),
            ]);

            if ($dosen) {
                DB::commit();
                return response()->json(['success' => true, 'msg' => 'Tambah Dosen Berhasil!']);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'msg' => 'Tambah Dosen Gagal!']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => 'Tambah Dosen Gagal! ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $find = Dosen::where('nip', $request->input('dosen-add-nim-dosen'))->first();
            if ($find) {
                return response()->json(['success' => false, 'msg' => 'NIP Dosen Sudah Terdaftar!']);
            }

            $findUsers = User::where('username', $request->input('dosen-add-username-dosen'))->first();
            if ($findUsers) {
                return response()->json(['success' => false, 'msg' => 'Username Dosen Sudah Terdaftar!']);
            }

            DB::beginTransaction();
            $userUpdate = User::find($request->input('dosen-edit-id-user'))->update([
                'name'  => $request->input('dosen-edit-nama-dosen'),
                'email' => $request->input('dosen-edit-email-dosen'),
            ]);

            $dosenUpdate = Dosen::find($request->input('dosen-edit-id'))->update([
                'nama'    => $request->input('dosen-edit-nama-dosen'),
                'no_telp' => $request->input('dosen-edit-no-telp-dosen'),
            ]);

            if ($userUpdate && $dosenUpdate) {
                DB::commit();
                return response()->json(['success' => true, 'msg' => 'Edit Dosen Berhasil!']);
            } else {
                DB::rollBack();
                return response()->json(['success' => false, 'msg' => 'Edit Dosen Gagal!']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => 'Edit Dosen Gagal! ' . $e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $dosen = Dosen::find($id);
            if (!$dosen) {
                throw new \Exception('Dosen not found');
            }

            $user = User::find($dosen->id_users);
            if (!$user) {
                throw new \Exception('User not found');
            }

            DB::beginTransaction();
            $dosen->delete();
            $user->delete();
            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Hapus Dosen Berhasil!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => 'Hapus']);
        }
    }
}
