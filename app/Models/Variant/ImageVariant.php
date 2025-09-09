<?php

namespace App\Models\Variant;

use Illuminate\Database\Eloquent\Model;

class ImageVariant extends Model
{
    //
    protected $fillable = ['id', 'image_id', 'variant_image', 'color'];
    protected $timestamp = true;
    protected $table = 'imagevariants';
}
