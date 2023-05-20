<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface UserContract
{
    /**
     * Get a paginated collection of users.
     *
     */
    public function index($page, $perPage);

    /**
     * Get a specific user by its ID.
     *
     * @param int $id
     * @return \App\Models\User
     */
    public function show($id);

    /**
     * Store a new user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    public function store(Request $request);

    /**
     * Update an existing user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \App\Models\user
     */
    public function update(Request $request, $id);

    public function destroy($id);
}
