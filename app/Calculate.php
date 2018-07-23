<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculate extends Model
{
    protected $guarded = array();

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pegawai()
    {
        return $this->belongsTo('App\Employee','employee_id','id');
    }
}
