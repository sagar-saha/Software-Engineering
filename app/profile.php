<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    protected $table="profile";
	protected $fillable =['name','contact','address','addby'];
	
}