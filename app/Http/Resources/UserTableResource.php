<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'num' => $this->num, 
            'id' => $this->id,
            'fullname' => $this->fullname,
            'profile_image' => $this->profile_image,
            'email' => $this->email,
            'phone' => $this->phone,
            'verified' => $this->when(condition: $this->email_verified_at, value: Carbon::parse($this->email_verified_at)->diffForHumans(), default: null),
            'is_signed_in' => $this->when(condition: $this->issignedin, value: "True", default: "False")
        ];
    }
}
