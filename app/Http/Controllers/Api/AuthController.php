<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'         => 'required|email',
            'password'      => 'required',
            'client_id'     => 'required',
            'client_secret' => 'required',
        ]);
        $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
            'grant_type'    => 'password',
            'client_id'     => $request->client_id,
            'client_secret' => $request->client_secret,
            'username'      => $request->email,
            'password'      => $request->password,
            'scope'         => '*',
        ]);
        return response()->json([
            'message' => 'User logged in Successfully',
            'token'   => $response->json()['access_token'],

        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'User registered',
            'user'    => $user,
        ]);

    }

}
