<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class drugmart extends Model
{
	protected $table="profit";
	protected $fillable =['profit','adby','dat'];
}