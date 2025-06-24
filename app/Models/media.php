<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class media extends Model
{
    protected $guarded = ['id'];

    public function resource()
    {
        return $this->morphTo();
    }
}
