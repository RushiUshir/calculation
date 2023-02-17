<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    use HasFactory;
    protected $table = "calculation";
    protected $primaryKey = "id";
    protected $fillable = ['input_calculation','output_calculation'];
  
}