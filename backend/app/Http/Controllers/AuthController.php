<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\School;
use App\Subject;

class AuthController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $school = School::firstOrCreate(['name' => $request['school']]);
        $subject = Subject::firstOrCreate(['name' => $request['subject']]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'school_id' => $school->id,
            'subject_id' => $subject->id,
            'password' => Hash::make($request['password'])
        ]);
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        $response = ['user' => $user];

        return response()->json($response, 200);
    }

    /**
     * register user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response()->json($response, 200);
            } else {
                $response = "Password missmatch";
                return response()->json($response, 422);
            }

        } else {
            $response = 'User does not exist';
            return response()->json($response, 422);
        }

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response()->json($response, 200);
    }
}
