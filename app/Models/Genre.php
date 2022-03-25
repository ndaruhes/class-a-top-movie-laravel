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

    public function movie(){
        // hasMany('model movie', 'foreign key di table movie');
        return $this->hasMany('App\Models\Movie', 'genre_id');
    }
}
