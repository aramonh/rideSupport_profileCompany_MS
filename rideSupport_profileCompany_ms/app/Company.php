<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table ='companys';
    
    protected $fillable = [
        'email',
        'password',
        'name',
        'city',
        'address',
        'phone',
        'manager',
        
];
}
