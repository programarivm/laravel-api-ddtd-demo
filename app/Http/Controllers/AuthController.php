<?php

namespace App\Http\Controllers;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    /**
     * Authenticates a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        $user = User::whereName($request->username)->first();

        if (empty($user)) {
            throw new NotFoundHttpException;
        } elseif (!Hash::check($request->password, $user->password)) {
            throw new NotFoundHttpException;
        }

        $token = [
            'id' => $user->id,
            'exp' => time() + (60 * 60)
        ];

        return response()->json([
            'status' => 200,
            'access_token' => JWT::encode($token, getenv('JWT_SECRET'))
        ]);
    }
}
