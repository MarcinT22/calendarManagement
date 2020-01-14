<?php

namespace App\Http\Controllers\Api;
use App\Calendar;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function index(){
        return User::all();
    }


    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
