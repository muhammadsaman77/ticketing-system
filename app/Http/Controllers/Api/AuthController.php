<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        try {
            $response = Http::asForm()->post(config('app.url') . '/oauth/token', [
                'grant_type'    => 'password',
                'client_id'     => $request->client_id,
                'client_secret' => $request->client_secret,
                'username'      => $request->email,
                'password'      => $request->password,
                'scope'         => '*',
            ]);

            if ($response->successful()) {

                if (isset($response->json()['access_token'])) {
                    return response()->json([
                        'message' => 'User logged in Successfully',
                        'token'   => $response->json()['access_token'],
                    ], 200);
                } else {

                    return response()->json([
                        'message' => 'Login successful, but no access token received.',
                    ], 500);
                }
            } else {
                return response()->json($response->json(), $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan internal saat mencoba login.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|lowercase|email|max:255|unique:' . User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $role = DB::table('roles')->where('name', 'USER')->first()->id;
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => $role,
        ]);
        return response()->json([
            'message' => 'User registered',
            'user'    => $user,
        ]);

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            'message' => 'Password changed',
        ]);
    }

}
