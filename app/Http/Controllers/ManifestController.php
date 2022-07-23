<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ManifestController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table Manifest
        $manifests = Manifest::with(['user'])->latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Manifest',
            'data'    => $manifests 
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
        //find manifest by ID
        $manifest = Manifest::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Manifest',
            'data'    => $manifest 
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
            'nama_event'            => 'required',
            'nama_penangung_jawab'  => 'required',
            'lokasi_event'          => 'required',
            'list_barang'           => 'required',
            'tanggal_event'         => 'required',
            'tanggal_barang_keluar' => 'required',
            'tanggal_barang_masuk'  => 'required',
            'id_user'               => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $inventory = Inventory::create([
            
            'nama_inv'      => $request->nama_inv,
            'jumlah_inv'    => $request->jumlah_inv,
            'id_kategori'   => $request->id_kategori,
            'id_lokasi'     => $request->id_lokasi,
        ]);

        //success save to database
        if($inventory) {

            return response()->json([
                'success' => true,
                'message' => 'Inventory Created',
                'data'    => $inventory
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'Inventory Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $inventory
     * @return void
     */
    public function update(Request $request, Inventory $inventory)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_inv'      => 'required',
            'jumlah_inv'    => 'required',
            'id_kategori'   => 'required',
            'id_lokasi'     => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find inventory by ID
        $inventory = Inventory::findOrFail($inventory->id);

        if($inventory) {

            //update inventory
            $inventory->update([
                'nama_inv'      => $request->nama_inv,
                'jumlah_inv'    => $request->jumlah_inv,
                'id_kategori'   => $request->id_kategori,
                'id_lokasi'     => $request->id_lokasi,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Inventory Updated',
                'data'    => $inventory  
            ], 200);

        }

        //data barang not found
        return response()->json([
            'success' => false,
            'message' => 'Inventory Not Found',
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
        //find inventory by ID
        $inventory = Inventory::findOrfail($id);

        if($inventory) {

            //delete inventory
            $inventory->delete();

            return response()->json([
                'success' => true,
                'message' => 'Inventory Deleted',
            ], 200);

        }

        //data inventory not found
        return response()->json([
            'success' => false,
            'message' => 'Inventory Not Found',
        ], 404);
    }
}
