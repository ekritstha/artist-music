<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserContract
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return DB::select("SELECT * FROM users");
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO users (first_name, last_name, email, password, phone, dob, gender, address, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?)', [
            $request['first_name'],
            $request['last_name'],
            $request['email'],
            Hash::make($request['password']),
            $request['phone'],
            Carbon::createFromFormat('Y-m-d', $request['dob']),
            $request['gender'],
            $request['address'],
            Carbon::now(),
            Carbon::now()
        ]);
        return true;
    }

    public function show($id)
    {
        $user = DB::select('SELECT * FROM users WHERE id = ?', [$id]);
        if(count($user) == 0) {
            throw new \Exception('user not found');
        }
        return $user[0];
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE users SET first_name = ?, last_name = ?, phone = ?, dob = ?, gender = ?, address = ?, updated_at = ? WHERE id = ?', [
            $request['first_name'],
            $request['last_name'],
            $request['phone'],
            Carbon::createFromFormat('Y-m-d', $request['dob']),
            $request['gender'],
            $request['address'],
            Carbon::now(),
            $id,
        ]);
        return true;
    }

    public function destroy($id)
    {
        if($id == Auth()->user()->id) {
            throw new \Exception("can't delete the logged in user");
        }
        if(count(DB::select('SELECT id FROM users')) ==1) {
            throw new \Exception("must be at least one user");
        }
        DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        return true;
    }
}
