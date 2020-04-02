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
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'scodocId' => $this->scodocId,
            'nip' => $this->nip,
            'ine' => $this->ine,
            'bulletin' => $this->whenPivotLoaded('semestre_user', function () {
                return $this->pivot->bulletin;
            }),
        ];
    }
}
