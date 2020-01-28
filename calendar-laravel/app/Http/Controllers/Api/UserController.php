<?php

namespace App\Http\Controllers\Api;
use App\Calendar;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
     /**
      * Get all list of users
      * @return \Illuminate\Http\JsonResponse
      * @author Marcin Topolski
      * @version 1.0
      */
     public function index(){
         $users = User::all();
         return response()->json($users, 200);
     }


      /**
        * Remove user
        * @param User $user
        * @return \Illuminate\Http\JsonResponse
        * @author Marcin Topolski
        * @version 1.0
        */
       public function delete(User $user)
       {
           $user->delete();
           return response()->json(null, 204);
       }
}
