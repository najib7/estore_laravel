<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $profile = $this->profile;

        return [
            'id'         => $this->id,
            'username'   => $this->username,
            'email'      => $this->email,
            'group'      => $this->group->name ?? '',
            'group_id'   => $this->group->id ?? 0,
            'last_login' => $this->last_login ? $this->last_login->format('Y') : trans('app.common.never'),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i'),

            'first_name' => $profile->first_name,
            'last_name'  => $profile->last_name,
            'address'    => $profile->address,
            'dob'        => $profile->date_of_birth->format('Y-m-d'),
            'image'      => $profile->image,
            'gender'     => $profile->gender,
            'phone'      => $profile->phone
        ];
    }
}
