<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table kategoris
        $kategoris = Kategori::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Kategori',
            'data'    => $kategoris
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find kategori by ID
        $kategori = Kategori::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Kategori',
            'data'    => $kategori 
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $kategori = Kategori::create([
            'kode_kategori'  => $request->kode_kategori,
            'nama_kategori'  => $request->nama_kategori
        ]);

        //success save to database
        if($kategori) {

            return response()->json([
                'success' => true,
                'message' => 'Kategori Created',
                'data'    => $kategori  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Kategori Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $kategori
     * @return void
     */
    public function update(Request $request, Kategori $kategori)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'kode_kategori'   => 'required',
            'nama_kategori' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find kategori by ID
        $kategori = Kategori::findOrFail($kategori->id);

        if($kategori) {

            //update kategori
            $kategori->update([
                'kode_kategori'  => $request->kode_kategori,
                'nama_kategori'  => $request->nama_kategori
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kategori Updated',
                'data'    => $kategori  
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Kategori Not Found',
        ], 404);

    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find kategori by ID
        $kategori = Kategori::findOrfail($id);

        if($kategori) {

            //delete kategori
            $kategori->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kategori Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Kategori Not Found',
        ], 404);
    }
}
