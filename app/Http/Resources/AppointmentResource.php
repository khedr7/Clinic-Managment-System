<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'date'       => $this->date,
            'status'     => $this->status,
            'note'       => $this->note,
            'user'       => $this->user ? UserResource::make($this->user) : null,
            'doctor'     => $this->doctor ? UserResource::make($this->doctor) : null,
            'created_at' => $this->created_at
        ];
    }
}
