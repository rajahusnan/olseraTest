<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Transac;
use App\Pajak;
class ItemController extends Controller
{
    //
    public function getAllItems() {
        $item = Item::get()->toJson(JSON_PRETTY_PRINT);
        return response($item, 200);
      }

    public function createItems(Request $request) {
      if (!empty($request->nama)){
        $item = new Item;
        $item->nama = $request->nama;
        $item->save();
        $LastInsertId = $item->id;
        $pajak = Pajak::get()->toArray();
        foreach($pajak as $v)
        {                
            if($v>0){
              $trancast = new Transac;
              $trancast->item_id =  $LastInsertId;
              $trancast->pajak_id = $v['id'];
              $trancast->save();
            }
        }
      

        return response()->json([
            "message" => "item record created"
        ], 201);

      }else{
        return response()->json([
          "message" => "nama  cant be empty!"
        ], 404);
      }
        
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
