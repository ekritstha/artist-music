<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface ArtistContract
{
    /**
     * Get a paginated collection of artists.
     *
     */
    public function index();

    /**
     * Get a specific artist by its ID.
     *
     * @param int $id
     * @return \App\Models\Artist
     */
    public function show($id);

    /**
     * Store a new artist.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Artist
     */
    public function store(Request $request);

    /**
     * Update an existing artist.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \App\Models\Artist
     */
    public function update(Request $request, $id);

    public function destroy($id);
}
