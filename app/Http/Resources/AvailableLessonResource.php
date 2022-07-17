<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AvailableLessonResource extends JsonResource
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
            'participant_limit' => $this->limit,
            'type' => $this->type,
            'gym' => $this->gym->name,
            'class' => $this->category->name,
            'trainer' => $this->trainer->full_name,
            'start' => Carbon::parse($this->start_at)->format('d-m-Y h:i A'),
            'end' => Carbon::parse($this->end_at)->format('d-m-Y h:i A'),
        ];
    }
}
