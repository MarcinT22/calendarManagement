<?php

namespace App\Http\Controllers\Api;

use App\Calendar;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class AuthController extends Controller
{

    /**
     * Create new user
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author Marcin Topolski
     * @version 1.0
     */
    public function register(Request $request)
    {

        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->roles = $request->roles;
        $user->save();
        $calendar = new Calendar;
        $calendar->user_id = $user->id;
        $calendar->save();

        return response([
            'status' => 'success',
            'data' => $user
        ], 200);
    }

    /**
     * Login user
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author Marcin Topolski
     * @version 1.0
     */
    public function login(Request $request)
    {

        $user = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($user)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.user',
                'message' => 'Logowanie nie powiodło się.'
            ], 400);
        }

        return response([
            'status' => 'success'
        ])->header('Authorization', $token);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);

        return response([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function refresh()
    {

        return response([
            'status' => 'success'
        ]);
    }


    /**
     * Logout user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author Marcin Topolski
     * @version 1.0
     */
    public function logout()
    {
        JWTAuth::invalidate();

        return response([
            'status' => 'success',
            'message' => 'Wylogowano'
        ], 200);
    }
}
