<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        // dd($users);
        return response()->json([
            "result" => $users
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        // $user->password = Hash::make($request->password);

        $user->save();
        return response()->json(['result'=>$user], Response::HTTP_CREATED);
    }
    
    public function update(Request $request, $id){
        $user = User::findOrFail($request->id);
        $user->name = $request ->name;
        $user->email = $request ->email;
        $user->password = $request ->password;

        $user->save();

        return response()->json(['result' => $user], Response::HTTP_OK);
    }


    public function destroy($id){
        User::destroy($id);
        return response()->json(['message' => "Deleted"], Response::HTTP_OK);
    }


}
