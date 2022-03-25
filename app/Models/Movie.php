<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // Field yang tidak boleh diisi kedalam table
    protected $guarded = ['id'];

    public function genre(){
        // belogsTo('Model genre', 'foreign key genre_id ditable movie', 'primary key ditable genre => id');
        return $this->belongsTo('App\Models\Genre', 'genre_id', 'id');
    }

    public function user(){
        // belogsTo('Model user', 'foreign key user_id ditable movie', 'primary key ditable user => id');
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    } 
}
