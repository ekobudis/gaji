<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = array();

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
