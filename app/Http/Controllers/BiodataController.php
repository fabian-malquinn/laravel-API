<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function create(Request $request){
        $datainput = [
            'name' => $request->input('name'),
            'fullname' => $request->input('fullname'),

        ];

        $insert = Biodata::insert($datainput);

        if ($insert){
            return response()->json([
                'status' => true,
                'message' => 'berhasil dibuat',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'gagal terbuat'
            ]);
        }
    }
}
