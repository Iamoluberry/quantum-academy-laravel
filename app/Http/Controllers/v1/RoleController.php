<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function show(){
        $authUser = Auth::user();

        $role = $authUser->roles;

        return response()->json([
            'role' => $role,
        ], 200);

    }
}
