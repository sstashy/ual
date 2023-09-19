<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use Notifiable;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role_id',
    ];
    
    public function users()
    {
      return $this->belongsToMany(User::class);
    }
    
}