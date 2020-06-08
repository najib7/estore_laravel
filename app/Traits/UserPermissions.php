<?php


namespace App\Traits;

use App\Models\Group;
use App\Models\UserPrivilege;

trait UserPermissions
{
    public function hasPermission($access, $model)
    {
        if($this->group === null) {
            return false;
        }
        $p =  $this->group->privileges()->where('model', $model)->get();
        $privi = $p->pluck('privilege');
        
        return $privi->contains($access);
    }
}
