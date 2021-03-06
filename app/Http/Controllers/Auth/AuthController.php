<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use App\Model\Company;
use Mockery\Exception;
use Validator;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    "error" => "invalid_credentials",
                    "message" => "The user credentials were incorrect. "
                ], 400);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                "error" => "could_not_create_token",
                "message" => "Enable to process request."
            ], 422);
        }

        // all good so return the token
        $user =  User::where('email', $request->get('email'))->get();
        return response()->json([
            'userData'  => $user,
            'accessToken' => $token,
            'refreshToken' => $token,
        ],200);

    }


    /*
    * Register Company User
    */
    public function register(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'companyName' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json([
                "error_message" => 'validation_error',
                "error" => $validator->errors(),
            ]);
        }

        //$request->merge(['password' => Hash::make($request->password)]);
        try{
            //Add company
            $company = new Company;
            $company->name = $request->companyName;
            $company->slug = Str::slug($request->companyName);
            $company->save();
            //Add User 
            $user = new User;
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->role = 'Entreprise';
            $user->password = Hash::make($request->password);
            $user->company_id = $company->id;
            $user->save();
            return response()->json(['status','registered successfully'],200);
        }
        catch(Exception $e){
            return response()->json([
                "error" => "could_not_register",
                "message" => "Unable to register user"
            ], 400);
        }

    }

}