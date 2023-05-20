<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface MusicContract
{
    /**
     * Get a paginated collection of musics.
     *
     */
    public function index();

    /**
     * Get a specific music by its ID.
     *
     * @param int $id
     * @return \App\Models\Music
     */
    public function show($id);

    /**
     * Store a new music.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\Music
     */
    public function store(Request $request);

    /**
     * Update an existing music.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \App\Models\Music
     */
    public function update(Request $request, $id);

    public function destroy($id);
}
