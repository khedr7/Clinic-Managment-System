<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'               => $this->id,
            'name'             => $this->name,
            'email'            => $this->email,
            'phone'            => $this->phone,
            'role'             => $this->role,
            'gender'           => $this->gender,
            'image'            => $this->image,
            'address'          => $this->address,
            'birthday'         => $this->birthday,
            'specialization'   => $this->specialization ? SpecializationResource::make($this->specialization) : null,
            'doctorSchedules'  => $this->doctorSchedules ? DoctorScheduleResource::collection($this->doctorSchedules) : null,
            'created_at'       => $this->created_at
        ];
    }
}
