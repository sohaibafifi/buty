<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Department extends JsonResource
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
            'name' => $this->name,
            'scodoc_id' => $this->scodoc_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'formations' => Formation::collection($this->formations)
        ];
    }
}
