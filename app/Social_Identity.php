<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social_Identity extends Model
{
    protected $table = 'social_identities';

    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
