<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = 'items';

    protected $fillable = ['nama'];

    public function pajaks()
    {
        return $this->belongsToMany(Pajak::class,'transacs','item_id','pajak_id');
    }

}
