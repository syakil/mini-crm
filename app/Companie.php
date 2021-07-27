<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companie extends Model
{
    protected $fillable = ['name','email','logo','website'];

     /**
     * Method One To Many Employees (Companies has Employees)
     */
    public function employees(){

        return $this->hasMany(Employee::class);
    
    }
   
}
