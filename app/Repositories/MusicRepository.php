<?php

namespace App\Repositories;

use App\Contracts\MusicContract;
use App\Models\Music;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MusicRepository implements MusicContract
{
    protected $music;

    public function __construct(Music $music)
    {
        $this->music = $music;
    }

    public function index($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;

        $results = DB::select("SELECT m.id, m.artist_id, m.title, m.album_name, m.genre, a.name AS artist_name FROM music m JOIN artists a ON m.artist_id = a.id LIMIT :perPage OFFSET :offset", [
            'perPage' => $perPage,
            'offset' => $offset,
        ]);

        $totalCount = DB::selectOne("SELECT COUNT(*) AS count FROM music")->count;

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

    public function store(Request $request)
    {
        DB::insert('INSERT INTO music (artist_id, title, album_name, genre, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [
            $request['artist_id'],
            $request['title'],
            $request['album_name'],
            $request['genre'],
            Carbon::now(),
            Carbon::now()
        ]);
        return true;
    }

    public function show($id)
    {
        $music = DB::select('SELECT m.id, m.artist_id, m.title, m.album_name, m.genre, a.name AS artist_name
        FROM music m
        JOIN artists a ON m.artist_id = a.id
        WHERE m.id = ?', [$id]);
        if(count($music) == 0) {
            throw new \Exception('music not found');
        }
        return $music[0];
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE music SET artist_id = ?, title = ?, album_name = ?, genre = ?, updated_at = ? WHERE id = ?', [
            $request['artist_id'],
            $request['title'],
            $request['album_name'],
            $request['genre'],
            Carbon::now(),
            $id,
        ]);
        return true;
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM music WHERE id = ?', [$id]);
        return true;
    }

    public function getArtistMusics($page, $perPage, $artist_id)
    {
        $offset = ($page - 1) * $perPage;

        $results = DB::select("SELECT m.id, m.title, m.album_name, m.genre, a.name AS artist_name FROM music m JOIN artists a ON m.artist_id = a.id LIMIT :perPage OFFSET :offset", [
            'perPage' => $perPage,
            'offset' => $offset,
        ]);

        $totalCount = DB::selectOne("SELECT COUNT(*) AS count FROM music")->count;

        $music = [
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
        return $music;
    }
}
