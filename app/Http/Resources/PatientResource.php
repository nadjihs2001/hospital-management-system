<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'blood_group' => $this->blood_group,
            'age' => $this->date_birth ? now()->diffInYears($this->date_birth) : null,
            'address' => $this->Address,
            'appointments_count' => $this->appointments_count ?? $this->appointments()->count(),
            'last_visit' => $this->appointments()->latest()->first()?->appointment_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}