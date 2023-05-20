<?php

namespace App\Repositories;

use App\Contracts\ArtistContract;
use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistRepository implements ArtistContract
{
    protected $artist;

    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }

    public function index()
    {
        return DB::select("SELECT * FROM artists");
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO artists (name, dob, gender, address, first_release_year, no_of_albums_released, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?,?)', [
            $request['name'],
            Carbon::createFromFormat('Y-m-d', $request['dob']),
            $request['gender'],
            $request['address'],
            Carbon::createFromFormat('Y', $request['first_release_year']),
            $request['no_of_albums_released'],
            Carbon::now(),
            Carbon::now()
        ]);
        return true;
    }

    public function show($id)
    {
        $artist = DB::select('SELECT * FROM artists WHERE id = ?', [$id]);
        if(count($artist) == 0) {
            throw new \Exception('artist not found');
        }
        return $artist[0];
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE artists SET name = ?, dob = ?, gender = ?, address = ?, first_release_year = ?, no_of_albums_released = ?, updated_at = ? WHERE id = ?', [
            $request['name'],
            Carbon::createFromFormat('Y-m-d', $request['dob']),
            $request['gender'],
            $request['address'],
            Carbon::createFromFormat('Y', $request['first_release_year']),
            $request['no_of_albums_released'],
            CArbon::now(),
            $id,
        ]);
        return true;
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM artists WHERE id = ?', [$id]);
        return true;
    }
}
