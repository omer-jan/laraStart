<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\user;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

  public function __construct()
  {
    $this->middleware('api');
  }
    public function index()
    {
      return user::latest()->paginate(50);

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
    public function profile()
    {
      return auth('api')->user();

    }
    public function UpdateProfile(Request $request)
    {
       $user=auth('api')->user();
      $this->validate($request,[
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,// it mean for update for the current user escape the uniquniss property
        'password' => 'sometimes|string|min:6', // it mean if you dont enter the password so it is ok
      ]);
     
      $currentPhoto=$user->photo;
    if($request->photo != $currentPhoto)
    {
      $name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
      // the above line will create file name something linke 1550571515.jpeg
         \Image::make($request->photo)->save(public_path('img/profile/').$name);
      // the above line will save the image in public/img/profile Directory       
        $request->merge(['photo'=>$name]);
        // to delete the old photo so just go to the path and photo name
        $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
              // if photo exit and he or she change there image it should delete the old one
                @unlink($userPhoto);
            }
    }
   if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
      $user->update($request->all());
      return ['message' => "Success"];


    }

    public function update(Request $request, $id)
    {
      $user=User::findOrFail($id);
      $this->validate($request,[
        'name' => 'required|string|max:191',
        'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,// it mean for update for the current user escape the uniquniss property
        'password' => 'sometimes|string|min:6', // it mean if you dont enter the password so it is ok
      ]);
      //dd($request->all());
      $user->update($request->all());
      return ['message'=>"update the user info"];

    }
    public function destroy($id)
    {
      $this->authorize('isAdmin');
      // 1- find the user
      $user=User::findOrFail($id);
      // 2-  delete the user
      $user->delete();
      // 3- return message to the user
      return ['message'=>'user Deleted'];


    }
}
