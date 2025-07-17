<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'location' => $this->location,
            'languages' => $this->languages,
            'languages_list' => $this->languages_list,
            'supervisor' => $this->supervisor ? [
                'id' => $this->supervisor->id,
                'name' => $this->supervisor->name,
            ] : null,
            'status' => $this->status,
            'is_archived' => $this->is_archived,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
