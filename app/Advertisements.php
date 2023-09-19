<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisements extends Model
{
    protected $primarykey = 'id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'adv', 'status'
    ];
    
}