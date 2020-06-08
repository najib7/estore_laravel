<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'first_name', 'last_name', 'address', 'date_of_birth', 'image', 'gender', 'phone'];

    protected $primaryKey = 'user_id';

    public $timestamps = false;

    protected $dates = ['date_of_birth'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
