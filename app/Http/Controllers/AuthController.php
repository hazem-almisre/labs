<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;    //-----------
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login']]);      //------was default------
        //$this->middleware('auth:api', ['except' => ['login','signup']]);     //-------------
        $this->middleware('JWT', ['except' => ['login','signup']]);     //-------------
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'phone' => ['required', 'string'],
            'password' => ['required', 'min:4'],
        ]);

        $credentials = request(['phone', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email or Password is Invalid'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
    //  */
    // public function refresh()
    // {
    //     return $this->respondWithToken(auth()->refresh());
    // }


    public function signup(Request $request)    //---------------------------
    {
        try {
            $validateData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'min:8'],
            ]);

            $data = array();
            $data['name'] = $request->name;
            $data['phone'] = $request->phone;
            $data['socId'] = '1';
            $data['password'] = Hash::make($request->password);

            User::query()->create($data);
            // DB::table('users')->insert($data);

            return $this->login($request);
        } catch (\Throwable $th) {
            return response()->json(['data'=>['errors'=>$th->getMessage()]]) ;
        }
     //------------------------
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        // return response()->json([           //---------------------------
        //     'access_token' => $token,
        //     'token_type'   => 'bearer',
        //     'expires_in'   => auth()->factory()->getTTL() * 60,
        //     'name'         => auth()->user()->name,             //--OR-- Auth::user()->name
        //     'user_id'      => auth()->user()->id,
        //     'phone'        => auth()->user()->phone,            //-- Auth::user()->email
        // ]);
    }
}
