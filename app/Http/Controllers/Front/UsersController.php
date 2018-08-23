<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Docs\UsersDocController;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UsersController extends UsersDocController
{


    /**
     * @return JsonResponse
     * @throws \Exception
     */
    public function show(): JsonResponse {
        $user = \Auth::guard()->user();
        if (empty($user)) {
            throw new \Exception('User not found');
        }
        return response()->json($user);
    }

    public function logout() {
        if (\Auth::check()) {
            \Auth::guard()->user()->oauthAcessTokens()->delete();
        }
    }
}
