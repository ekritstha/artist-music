<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserResources extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return UserResource::collection($this->collection);
    }
}
