<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendidikanController extends Controller
{
    // Fungsi untuk membuat data baru
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Pastikan kolom 'foto' sudah dimasukkan di dalam array data
        $pendidikan = Pendidikan::create($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Pendidikan created successfully',
            'data' => $pendidikan,
        ], 201);
    }


    // Fungsi untuk memperbarui data
    public function update(Request $request, $id)
    {
        $pendidikan = Pendidikan::find($id);

        if (!$pendidikan) {
            return response()->json(['message' => 'Pendidikan not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string',
            'deskripsi' => 'sometimes|required|string',
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

        $pendidikan->update($data);

        return response()->json([
            'message' => 'User ID ' . $pendidikan->id . ' updated',
            'data' => $pendidikan
        ], 200);
    }

    // Fungsi untuk menghapus data
    public function delete($id)
    {
        $pendidikan = Pendidikan::find($id);

        if (!$pendidikan) {
            return response()->json(['message' => 'Pendidikan not found'], 404);
        }

        $pendidikan->delete();

        return response()->json([
            'message' => 'Pendidikan deleted'
        ], 200);
    }

    // Fungsi untuk mendapatkan data
    public function get(Request $request)
    {
        $id = $request->input('id');
        $pendidikan= Pendidikan::select('*');
        if ($id) {
            $pendidikan->where('id', $id);
        }
        $getpendidikan = $pendidikan->get();

        return response()->json($getpendidikan);
    }
}
