<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'phone', 'email','logo' , 'location', 'footer_description', 'social_facebook', 'social_instagram', 'social_twitter', 'social_linkedin'
    ];
}
