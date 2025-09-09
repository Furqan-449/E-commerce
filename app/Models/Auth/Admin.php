<?php

namespace App\Models\Auth;

use App\Models\Categories\Categorie;
use Dom\Attr;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{
    //
    public $timestamps = true; // Disable timestamps if not needed
    protected $fillable = ['id', 'name', 'email', 'password', 'image', 'business', 'flag'];
    protected function Name(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value),
        );
    }

    protected function Email(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => strtolower($value),
            set: fn(string $value) => strtolower($value),
        );
    }

    protected function Password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value),
        );
    }

    public function scopeDeleteaccount($query)
    {
        return $query->where('id', Auth::guard('admin')->id())->first();
    }
}
