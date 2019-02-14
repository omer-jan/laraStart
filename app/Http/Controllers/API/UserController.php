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
      return user::latest()->paginate(10);

    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:191|unique:users',
        'password' => 'required|string|min:6',
      ]);
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
      // 1- find the user
      $user=User::findOrFail($id);
      // 2-  delete the user
      $user->delete();
      // 3- return message to the user
      return ['message'=>'user Deleted'];


    }
}
