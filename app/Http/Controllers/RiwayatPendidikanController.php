<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RiwayatPendidikanController extends Controller
{
    // Fungsi untuk membuat data baru
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date',
            'deskripsi' => 'nullable|string|max:255',
            
            // Input Data Sesuai Kolom Di Atas Saja Abaikan Yang Dibawah

            // 'biodata_id' => 'nullable|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Pastikan kolom 'foto' sudah dimasukkan di dalam array data
        $riwayatpendidikan = RiwayatPendidikan::create($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'RiwayatPendidikan created successfully',
            'data' => $riwayatpendidikan,
        ], 201);
    }


    // Fungsi untuk memperbarui data
    public function update(Request $request, $id)
    {
        $riwayatpendidikan = RiwayatPendidikan::find($id);

        if (!$riwayatpendidikan) {
            return response()->json(['message' => 'RiwayatPendidikan not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|nullable|string|max:255',
            'tanggal_mulai' => 'sometimes|nullable|date',
            'tanggal_selesai' => 'sometimes|nullable|date',
            'deskripsi' => 'sometimes|nullable|string|max:255',

            // Input Data Sesuai Kolom Di Atas Saja Abaikan Yang Dibawah

            // 'biodata_id' => 'nullable|integer',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $riwayatpendidikan->update($data);

        return response()->json([
            'message' => 'User ID ' . $riwayatpendidikan->id . ' updated',
            'data' => $riwayatpendidikan
        ], 200);
    }

    // Fungsi untuk menghapus data
    public function delete($id)
    {
        $riwayatpendidikan = RiwayatPendidikan::find($id);

        if (!$riwayatpendidikan) {
            return response()->json(['message' => 'RiwayatPendidikan not found'], 404);
        }

        $riwayatpendidikan->delete();

        return response()->json([
            'message' => 'RiwayatPendidikan deleted'
        ], 200);
    }

    // Fungsi untuk mendapatkan data
    public function get(Request $request)
    {
        $id = $request->input('id');
        $riwayatpendidikan= RiwayatPendidikan::select('*');
        if ($id) {
            $riwayatpendidikan->where('id', $id);
        }
        $getriwayatpendidikan = $riwayatpendidikan->get();

        return response()->json($getriwayatpendidikan);
    }
}
