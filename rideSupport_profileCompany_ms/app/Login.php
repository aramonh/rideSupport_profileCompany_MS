<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $table ='companys';
    
    protected $fillable = ['email','password'];

}
