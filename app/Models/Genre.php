<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    // Field yang boleh diisi kedalam table
    protected $fillable = ['title'];
    
    // Field yang tidak boleh diisi kedalam table
    // protected $guarded = ['id'];
}
