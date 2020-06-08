<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPrivilege extends Model
{
    protected $table = 'users_privileges';

    protected $fillable = ['privilege', 'model'];

    public $timestamps = false;

    public function Groups()
    {
        return $this->belongsToMany('App\Models\Group', 'group_privilege', 'privilege_id', 'group_id');
    }
}
