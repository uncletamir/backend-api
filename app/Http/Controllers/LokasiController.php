<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Lokasi;

class LokasiController extends Controller
{
     /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table lokasis
        $lokasis = Lokasi::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Lokasi',
            'data'    => $lokasis
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
        //find lokasi by ID
        $lokasi = Lokasi::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Lokasi',
            'data'    => $lokasi 
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
            'nama_lokasi' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $lokasi = Lokasi::create([
            'nama_lokasi'  => $request->nama_lokasi
        ]);

        //success save to database
        if($lokasi) {

            return response()->json([
                'success' => true,
                'message' => 'Lokasi Created',
                'data'    => $lokasi  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Lokasi Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $lokasi
     * @return void
     */
    public function update(Request $request, Lokasi $lokasi)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_lokasi' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find lokasi by ID
        $lokasi = Lokasi::findOrFail($lokasi->id);

        if($lokasi) {

            //update lokasi
            $lokasi->update([
                'nama_lokasi'  => $request->nama_lokasi
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Lokasi Updated',
                'data'    => $lokasi  
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Lokasi Not Found',
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
        //find lokasi by ID
        $lokasi = Lokasi::findOrfail($id);

        if($lokasi) {

            //delete lokasi
            $lokasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Lokasi Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'Lokasi Not Found',
        ], 404);
    }
}
