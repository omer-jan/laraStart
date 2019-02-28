<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    'user' => 'API\UserController',
  ]);
  Route::get('profile','API\UserController@profile');
  Route::get('findUser','API\UserController@search');
  Route::put('profile','API\UserController@UpdateProfile');
