<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // Get all mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ]);
    }

    // Create mahasiswa
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|unique:mahasiswas',
            'nama' => 'required|string',
            'jurusan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa created successfully',
            'data' => $mahasiswa
        ], 201);
    }

    // Get single mahasiswa
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ]);
    }

    // Update mahasiswa
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|unique:mahasiswas,nim,'.$id,
            'nama' => 'required|string',
            'jurusan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404);
        }

        $mahasiswa->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa updated successfully',
            'data' => $mahasiswa
        ]);
    }

    // Delete mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa not found'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa deleted successfully'
        ]);
    }
}
