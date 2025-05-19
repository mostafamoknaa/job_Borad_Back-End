<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployerResource extends JsonResource
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
            'id'           => $this->id,
            'name'         => $this->company_name,
            'logo_url'     => $this->company_logo
                    ? asset('storage/'.$this->company_logo)
                    : asset('images/default-logo.png'),
            'city'         => $this->user->city ?? '',
            'country'      => $this->user->country ?? '',
            'open_jobs'    => $this->jobs_count ?? 0,
            'created_at'   => $this->created_at->toDateString(),
        ];
    }
}
