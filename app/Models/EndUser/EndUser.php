<?php

namespace App\Models\EndUser;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class EndUser extends Authenticatable
{
    //
    use Notifiable;
    protected $fillable = [];
    public $timestamps = true;

    protected $table = 'endusers';

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
}
