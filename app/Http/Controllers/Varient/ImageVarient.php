<?php

namespace App\Http\Controllers\Varient;

use App\Http\Controllers\Controller;
use App\Models\Variant\ImageVariant;
use Illuminate\Http\Request;

class ImageVarient extends Controller
{
    //
    public function variant_image($id)
    {
        $find = ImageVariant::findOrFail($id);
        return response()->json([
            'otherimage' => $find->variant_image
        ], 200);
    }
}
