<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genders extends Model
{
    protected $primarykey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender_title', 'gender_color', 'gender_slug'
    ];
}
