<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function index()
    {

    }
    public function store(Request $request)
    {
        return User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'type' => $request['type'],
          'bio' => $request['bio'],
          'photo' => $request['photo'],
          'password' => Hash::make($request['name']),
        ]);
    }

    public function show($id)
    {

    }
    public function update(Request $request, $id)
    {

    }
    public function destroy($id)
    {

    }
}
