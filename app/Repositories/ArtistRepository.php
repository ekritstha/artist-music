<?php

namespace App\Repositories;

use App\Contracts\ArtistContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistRepository implements ArtistContract
{
    public function index($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;

        $results = DB::select("SELECT id, name, dob, address, gender, first_release_year, no_of_albums_released FROM artists LIMIT :perPage OFFSET :offset", [
            'perPage' => $perPage,
            'offset' => $offset,
        ]);

        $totalCount = DB::selectOne("SELECT COUNT(*) AS count FROM artists")->count;

        $pagination = [
            'data' => $results,
            'total' => $totalCount,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($totalCount / $perPage),
            'next_page_url' => null,
            'prev_page_url' => null,
            'from' => $offset + 1,
            'to' => min($offset + $perPage, $totalCount),
        ];
        return $pagination;
    }

    public function store($request)
    {
        DB::insert('INSERT INTO artists (name, dob, gender, address, first_release_year, no_of_albums_released, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?,?)', [
            $request['name'],
            Carbon::createFromFormat('Y-m-d', $request['dob']),
            $request['gender'],
            $request['address'],
            $request['first_release_year'],
            $request['no_of_albums_released'],
            Carbon::now(),
            Carbon::now()
        ]);
        return true;
    }

    public function show($id)
    {
        $artist = DB::select('SELECT id, name, dob, address, gender, first_release_year, no_of_albums_released FROM artists WHERE id = ?', [$id]);
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
            $request['first_release_year'],
            $request['no_of_albums_released'],
            Carbon::now(),
            $id,
        ]);
        return true;
    }

    public function destroy($id)
    {
        DB::delete(
            'DELETE artists, musics
            FROM artists
            JOIN musics ON artists.id = musics.artist_id
            WHERE artists.id = ?',
            [$id]
        );
        return true;
    }

    public function getAll()
    {
        $artists = DB::select('SELECT id, name, dob, address, gender, first_release_year, no_of_albums_released FROM artists');
        return $artists;
    }

    public function getTotalNumber()
    {
        return DB::selectOne("SELECT COUNT(*) AS count FROM artists")->count;
    }
}
