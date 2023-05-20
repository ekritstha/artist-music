<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index($request)
    {
        $page = $request['page'] ?? 1;
        $perPage = $request['perPage'] ?? 10;
        return $this->userRepo->index($page, $perPage);
    }

    public function store(Request $request)
    {
        return $this->userRepo->store($request);
    }

    public function show($id)
    {
        return $this->userRepo->show($id);
    }

    public function update(Request $request, $id)
    {
        return $this->userRepo->update($request, $id);
    }

    public function destroy($id)
    {
        if($id == Auth()->user()->id) {
            throw new \Exception("can't delete the logged in user");
        }
        return $this->userRepo->destroy($id);
    }
}
