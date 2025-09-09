<?php

namespace App\Models;

use App\Models\Cart\Cartitem;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories\Categorie;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    //
    public $fillable = ['id', 'name', 'sku', 'price', 'quantity', 'image', 'category_id', 'created_by'];
    public $timestamps = true;
    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function cartitem()
    {
        return $this->hasMany(Cartitem::class);
    }

    public function scopeAllitems($query)
    {
        return $query->get();
    }

    public function scopeFinditem($query, $id)
    {
        return $query->findOrFail($id);
    }

    public function scopeProductsearch($query, $name)
    {
        return $query->where('name', 'like', "%$name%");
    }

    public function scopeCategoryproduct($query, $id)
    {
        return $query->where('category_id', $id);
    }

    public function scopeOwnerproducts($query, $id)
    {
        return $query->where('created_by', $id);
    }
}
