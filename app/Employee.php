<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name','last_name','companie_id','email','phone'];


    public function companie(){

        return $this->belongsTo(Companie::class);

    }
}
