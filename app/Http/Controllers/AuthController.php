<?php

namespace App\Http\Controllers;

use App\Models\cashRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $validation = Validator::make($request->only(['password', 'cash_register_id', 'name']), [
        'name' => ['required', 'string'],
        'password' => ['required'],
        'cash_register_id' => ['nullable'],
    ]);

    if ($validation->fails()) {
        return response()->json([
            'errors' => $validation->errors(),
        ],Response::HTTP_BAD_REQUEST);
    }
    $user = User::where('name', $request->input('name'))->first();

    
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['error' => 'Credentials do not match our records'],Response::HTTP_UNAUTHORIZED);
    }

    if($user->role() == 'cashier'){
        $cash_register = cashRegister::find($request->cash_register_id);
        if (!$cash_register) {
            return response()->json(['error' => 'Cash register not found']);
        }
        
       
        $existingShift = $cash_register->users()->whereNull('end_at')->first();
        if ($existingShift) {
            return response()->json(['error' => 'This cash register is already in use']);
        }
    
        $user->cashRegister()->attach($request->input('cash_register_id'), ['start_at' => now()]);
        
        
    }
    
    $token = $user->createToken($user->id)->plainTextToken;

    return response()->json([
        'message' => 'User logged in!',
        'token' => $token,
        'role'=>$user->role(),
    ]);
}


    public function logout(Request $request)
    {
        $user = $request->user();
        $latestshift = $user->cashRegister()->withPivot('start_at', 'end_at')->orderByDesc('shifts.start_at')->first();

        if ($latestshift) {
            $user->cashRegister()->updateExistingPivot($latestshift->id, [
                'end_at' => now(),
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'message' => 'User logged out!',
        ]);
    }
}
