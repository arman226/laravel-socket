<?php

use App\Events\UserRegistration;
use App\Models\User;
use App\Notifications\NewNotification;
use Illuminate\Http\Request;
use Pusher\Pusher;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;


Route::post('/fight', function(Request $request){
 try{ 
   $rev= event(new UserRegistration('test'));
  return $rev;
}
  catch(Exception $e){
    return $e->getMessage();
  }
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
