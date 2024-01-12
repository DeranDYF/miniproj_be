<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\matakul;
use App\Models\Hari;
use Illuminate\Support\Facades\DB;

class MatakuliahControllerApi extends Controller
{
    public function index()
    {
        try {
            $matakul = Matakul::join('dosens', 'dosens.id', '=', 'matakuls.id_dosen')
                ->select('matakuls.*', 'dosens.nama as nama_dosen')
                ->get();
            return response()->json($matakul, Response::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
