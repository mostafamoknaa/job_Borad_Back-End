<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    { return [
        'id' => $this->id,
        'user_id' => $this->user_id,
        'full_name' => $this->full_name,
        'bio' => $this->bio,
        'resume_url' => $this->resume ? asset('storage/' . $this->resume) : null,
        'experience_level' => $this->experience_level,
        'education' => $this->education,
        'skills' => $this->skills,
        'experience' => $this->experience,
        'created_at' => $this->created_at->toDateTimeString(),
        'updated_at' => $this->updated_at->toDateTimeString(),

    ];
    }
}
