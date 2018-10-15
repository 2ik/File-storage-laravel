<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function resource()
    {
        return $this->hasMany('\App\Resource');
    }
}
