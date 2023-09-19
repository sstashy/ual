<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Settings extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_name', 'website_tagline', 'website_desc', 'dir', 'items_result', 'items_status', 'comments_status', 'photo_upload', 'max_chars_title', 'min_chars_story', 'max_chars_story', 'logo', 'analytics', 'adv_1', 'adv_2'
    ];

}