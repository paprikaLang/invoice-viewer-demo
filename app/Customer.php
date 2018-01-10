<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'firstName','lastName','email','address'
    ];
    protected $appends = ['text'];
    public  function getTextAttribute(){
        return $this->attributes['firstName'].' - '.$this->attributes['lastName'];
    }

}
