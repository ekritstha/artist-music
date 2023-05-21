<?php

namespace App\Services;

use App\Repositories\ArtistRepository;
use App\Repositories\MusicRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    protected $artistRepo;
    protected $userRepo;
    protected $musicRepo;

    public function __construct(ArtistRepository $artistRepo, UserRepository $userRepo, MusicRepository $musicRepo)
    {
        $this->artistRepo = $artistRepo;
        $this->userRepo = $userRepo;
        $this->musicRepo = $musicRepo;
    }

    public function getCurrentUser()
    {
        $user = Auth::user();
        return $user;
    }

    public function getTotalCount()
    {
        $userCount = $this->userRepo->getTotalNumber();
        $artistCount = $this->artistRepo->getTotalNumber();
        $musicCount = $this->musicRepo->getTotalNumber();

        return [
            'userCount' => $userCount,
            'artistCount' => $artistCount,
            'musicCount' => $musicCount
        ];
    }
}
