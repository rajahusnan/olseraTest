<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
class ItemController extends Controller
{
    //
    public function getAllItems() {
        $item = Item::get()->toJson(JSON_PRETTY_PRINT);
        return response($item, 200);
      }

    public function createItems(Request $request) {
        $item = new Item;
        $item->nama = $request->nama;
        $item->save();
        return response()->json([
            "message" => "item record created"
        ], 201);
    }  

    public function updateItems(Request $request, $id) {
        if (Item::where('id', $id)->exists()) {
            $item = Item::find($id);
            $item->nama = is_null($request->nama) ? $item->nama : $request->nama;
            $item->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "item not found"
            ], 404);
            
        }
    }  

    public function deleteItems ($id) {
        if(Item::where('id', $id)->exists()) {
            $item = Item::find($id);
            $item->delete();
    
            return response()->json([
              "message" => "records deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Item not found"
            ], 404);
          }
        
    }
}
