<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Attend extends Model
{
    //use SoftDeletes;

    //protected $dates = ['deleted_at'];
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
