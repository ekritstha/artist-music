<?php

namespace App\Http\Resources\Artist;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtistResource extends JsonResource
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
            'dob' => $this->dob,
            'address' => $this->address,
            'gender' => $this->gender,
            'first_released_year' => Carbon::parse($this->first_release_year)->format('Y'),
            'no_of_albums_released' => $this->no_of_albums_released,
        ];
    }
}
