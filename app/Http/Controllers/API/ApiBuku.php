<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ApiBuku extends Controller
{
    public function getData()
    {
        
        $data = Buku::all();
        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 200);
    }
    public function show($id)
    {
        $data = Buku::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 200);
    }
    public function destroy($id)
    {
        $data = Buku::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 200);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'sampul' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'judul' =>  'required|max:20',
            'penulis' => 'string',
            'deskripsi' => 'string',
            'kategori_id' => 'integer'
        ]);

        $image_path = $request->file('sampul')->store('sampul', 'public');

        $data = Buku::create([
            'sampul' => $image_path,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'kategori_id' => $request->kategori_id,
        ]);

        

        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sampul' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'judul' =>  'required|max:20',
            'penulis' => 'string',
            'deskripsi' => 'string',
            'kategori_id' => 'integer'
        ]);
        

        $image_path = $request->file('sampul')->store('sampul', 'public');

        $data = Buku::findOrFail($id);
        $data->update([
            'sampul' => $image_path,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'penulis' => $request->penulis,
            'kategori_id' => $request->kategori_id,
        ]);

        

        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 201);
    }
}
