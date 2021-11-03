<?php

namespace App\Http\Controllers;
use App\Pajak;
use Illuminate\Http\Request;

class PajakController extends Controller
{
    //

    public function getAllPajaks() {
        $pajak = Pajak::get()->toJson(JSON_PRETTY_PRINT);
        return response($pajak, 200);
      }

    public function createPajaks(Request $request) {
        $pajak = new Pajak;
        $pajak->nama = $request->nama;
        $pajak->rate = $request->rate;
        $pajak->save();
        return response()->json([
            "message" => "pajak record created"
        ], 201);
    }  

    public function updatePajaks(Request $request, $id) {
        if (Pajak::where('id', $id)->exists()) {
            $pajak = Pajak::find($id);
            $pajak->nama = is_null($request->nama) ? $pajak->nama : $request->nama;
            $pajak->rate = is_null($request->rate) ? $pajak->rate : $request->rate;
            $pajak->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "pajak not found"
            ], 404);
            
        }
    }  

    public function deletePajaks ($id) {
        if(Pajak::where('id', $id)->exists()) {
            $pajak = Pajak::find($id);
            $pajak->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Pajak not found"
            ], 404);
          }
        
    }
}
