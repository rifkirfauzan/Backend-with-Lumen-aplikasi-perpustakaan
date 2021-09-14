<?php

namespace App\Http\Controllers;
use App\Perpus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerpusController extends Controller
{
    public function index()
    {
        $perpus = Perpus::all();
        
        return response()->json([
            'success' => true,
            'message' =>'Data perpus yang tersedia',
            'data'    => $perpus
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_buku'   => 'required',
            'penulis' => 'required',
            'pengarang' => 'required',
            'ketersediaan' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua kolom wajib diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $perpus = Perpus::create([
                'nama_buku'     => $request->input('nama_buku'),
                'penulis'   => $request->input('penulis'),
                'pengarang'   => $request->input('pengarang'),
                'ketersediaan'   => $request->input('ketersediaan'),
            ]);
            
            if ($perpus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data perpus Berhasil Disimpan!',
                    'data' => $perpus
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data perpus Gagal Disimpan!',
                ], 400);
            }
            
        }
    }
    
    public function show($id)
    {
        $perpus = Perpus::find($id);
        
        if ($perpus) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Data perpus',
                'data'      => $perpus
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data perpus Tidak Ditemukan!',
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_buku'   => 'required',
            'penulis' => 'required',
            'pengarang' => 'required',
            'ketersediaan' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $perpus = Perpus::whereId($id)->update([
                'nama_buku'     => $request->input('nama_buku'),
                'penulis'   => $request->input('penulis'),
                'pengarang'   => $request->input('pengarang'),
                'ketersediaan'   => $request->input('ketersediaan'),
            ]);
            
            if ($perpus) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data perpus Berhasil Diupdate!',
                    'data' => $perpus
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data perpus Gagal Diupdate!',
                ], 400);
            }
            
        }
    }
    
    public function destroy($id)
    {
        $perpus = Perpus::whereId($id)->first();
        $perpus->delete();
        
        if ($perpus) {
            return response()->json([
                'success' => true,
                'message' => 'Data perpus Berhasil Dihapus!',
            ], 200);
        }
        
    }
    
    
}