<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'users_groups';

    protected $fillable = ['name', 'description'];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    public function privileges()
    {
        return $this->belongsToMany('App\Models\UserPrivilege', 'group_privilege', 'group_id', 'privilege_id');
    }
}
