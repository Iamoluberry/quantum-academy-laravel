<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return response()->json([
            "data" => $users
        ], 200);

    }

    public function students()
    {
        $students = User::role('student')->get();

        return response()->json([
            "data" => $students
        ], 200);
    }

    public function show(User $user){

        if (Auth::id() != $user->id) {
            abort(403);
        }

        return response()->json([
            "data" => $user
        ], 200);
    }

    public function destroy(User $user){
        $user->delete();
        return response()->json([
            "message" => 'User has been deleted'
        ], 200);
    }

    public function update(UpdateUserRequest $request, User $user){
        $request->validated();

        $user->update([
            "first_name" => $request["first_name"],
            "other_name" => $request["other_name"],
            "last_name" => $request["last_name"],
            "date_of_birth" => $request["date_of_birth"],
            "country" => $request["country"],
            "state_of_origin" => $request["state_of_origin"],
            "gender" => $request["gender"],
            "mode_of_learning" => $request["mode_of_learning"],
            "course" => $request["course"],
            "email" => $request["email"],
        ]);

        return response()->json([
            "message" => 'User has been updated',
            "data" => $user
        ], 200);
    }
}
