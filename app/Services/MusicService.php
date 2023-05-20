<?php

namespace App\Services;

use App\Repositories\MusicRepository;
use Illuminate\Http\Request;

class MusicService
{
    protected $musicRepo;

    public function __construct(MusicRepository $musicRepo)
    {
        $this->musicRepo = $musicRepo;
    }

    public function index($request)
    {
        $page = $request['page'] ?? 1;
        $perPage = $request['perPage'] ?? 10;
        return $this->musicRepo->index($page, $perPage);
    }

    public function store(Request $request)
    {
        return $this->musicRepo->store($request);
    }

    public function show($id)
    {
        return $this->musicRepo->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->musicRepo->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->musicRepo->destroy($id);
    }

    public function getArtistMusics(Request $request, $artist_id)
    {
        $page = $request['page'] ?? 1;
        $perPage = $request['perPage'] ?? 10;
        return $this->musicRepo->getArtistMusics($page, $perPage, $artist_id);
    }
}
