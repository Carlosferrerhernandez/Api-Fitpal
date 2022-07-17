<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JetBrains\PhpStorm\ArrayShape;

class AvailableLessonCollection extends ResourceCollection
{
    /**
     * @param $request
     * @return AnonymousResourceCollection
     */
    #[ArrayShape(['lessons' => "\Illuminate\Http\Resources\Json\AnonymousResourceCollection", 'pagination' => "string"])]
    public function toArray($request): AnonymousResourceCollection
    {
        return AvailableLessonResource::collection($this->collection);
    }
}
