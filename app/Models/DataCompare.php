<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCompare extends Model
{
    use HasFactory;
    protected $fillable = ['data_pertama', 'data_kedua'];
}
