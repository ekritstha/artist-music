<?php

namespace App\Http\Resources\Artist;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArtistResources extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return ArtistResource::collection($this->collection);
    }
}
