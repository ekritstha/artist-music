<?php

namespace App\Services;

use App\Exports\ArtistExport;
use App\Imports\ArtistImport;
use App\Repositories\ArtistRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ArtistService
{
    protected $artistRepo;

    public function __construct(ArtistRepository $artistRepo)
    {
        $this->artistRepo = $artistRepo;
    }

    public function index($request)
    {
        $page = $request['page'] ?? 1;
        $perPage = $request['perPage'] ?? 10;
        return $this->artistRepo->index($page, $perPage);
    }

    public function store(Request $request)
    {
        return $this->artistRepo->store($request);
    }

    public function show($id)
    {
        return $this->artistRepo->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->artistRepo->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->artistRepo->destroy($id);
    }

    public function export()
    {
        $artists = $this->artistRepo->getAll();
        return Excel::download(new ArtistExport($artists), 'artists.csv');
    }

    public function import($request)
    {
        Excel::import(new ArtistImport($this->artistRepo), $request['file']);
    }
}
