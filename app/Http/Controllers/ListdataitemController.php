<?php

namespace App\Http\Controllers;
use App\Item;
use App\Pajak;
use Illuminate\Http\Request;

class ListdataitemController extends Controller
{
    //
    public function getAll() {
        $items = Item::get()->toArray();
        $pajak = Pajak::select(\DB::raw("id,nama,concat(ifnull(format(rate, 0, 'en_US'), 0), '%') AS rate"))->get();
        $new_array=array();

        foreach ( $items as $key => $value){
        $new_array[]= 
        ['id' => $value['id'],
        'nama' => $value['nama'],
        'pajak' => $pajak 
        ];
        }

        return response()->json([
             'data:' =>$new_array
        ], 200);
    }
}
