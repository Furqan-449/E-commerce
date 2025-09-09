<?php

namespace App\Models\Cart;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    //
    public $fillable = ['id', 'item_id', 'name', 'price', 'user_id', 'quantity', 'image'];
    public $timestamps = true;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
