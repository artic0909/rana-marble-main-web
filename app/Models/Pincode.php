<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $table = 'pincodes';

    protected $fillable = ['name', 'fees'];
}
