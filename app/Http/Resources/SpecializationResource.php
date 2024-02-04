<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecializationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $actionMethod = $request->route()->getActionMethod();
        return match ($actionMethod) {
            default => $this->defaultResource(),
        };
    }

    public function defaultResource()
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'details'    => $this->details,
            'image'      => $this->image,
            'created_at' => $this->created_at
        ];
    }
}
