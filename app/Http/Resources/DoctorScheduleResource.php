<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorScheduleResource extends JsonResource
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
            'id'                   => $this->id,
            'day'                  => $this->day,
            'start_time'           => $this->start_time,
            'end_time'             => $this->end_time,
            'medical_session_time' => $this->medical_session_time,
        ];
    }
}
