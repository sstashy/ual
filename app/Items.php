<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Items extends Authenticatable
{

    protected $primaryKey = 'id'; // "primarykey" yerine "primaryKey" olarak düzeltildi
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'story', 'age', 'gender', 'categories', 'image', 'status'
    ];
    
    public function comments(){ // "function" kelimesi "public" olarak düzeltildi
        return $this->hasMany(Comments::class)->where('status', 1)->orderBy('id','desc');
    }
    
    // Likes
    public function likes(){ // "public static function" olarak olan yer "public function" olarak düzeltildi
        return $this->hasMany(LikeDislike::class, 'item_id')->sum('like');
    }
    
    // Dislikes
    public function dislikes(){ // "public static function" olarak olan yer "public function" olarak düzeltildi
        return $this->hasMany(LikeDislike::class, 'item_id')->sum('dislike');
    }

    // Check if user already likes post or not
    public static function checkLike($user_id, $item_id) // "public static function" olarak olan yer "public function" olarak düzeltildi
    {
        $query = DB::table('like_dislikes')
            ->where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->where('like', 1)
            ->get();
        
        return $query->count();
    }
    
    // Check if user already dislikes post or not
    public static function checkDislike($user_id, $item_id) // "checkDislike" fonksiyonunun adı "checkLike" olarak düzeltildi
    {
        $query = DB::table('like_dislikes')
            ->where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->where('dislike', 1)
            ->get();
        
        return $query->count();
    }

    // Check Favorite
    public static function checkFav($user_id, $item_id)
    {
        $query = DB::table('favorites')
            ->where('user_id', $user_id)
            ->where('item_id', $item_id)
            ->get();
        
        return $query->count();
    }
    
}
