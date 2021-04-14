<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
// after  that
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Entities\User;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

/**
 * @OA\Post(
 * path="/auth/login",
 * summary="Sign in",
 * description="Login by email, password",
 * operationId="authLogin",
 * tags={"Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user credentials",
 *    @OA\JsonContent(
 *       required={"email","password"},
 *       @OA\Property(property="email", type="string", format="email", example="user1@gmail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345")       
 *    ),
 * ),
 * @OA\Response(
 *    response=401,
 *    description="Wrong credentials response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
 *        )
 *     )
 * )
 */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            // 'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user             = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Username/Email or password are invalid.'], 401);
        }
    }

/**
 * @OA\Post(
 * path="/auth/register",
 * summary="Sign up",
 * description="New user registration",
 * operationId="userSignup",
 * tags={"Auth"},
 * @OA\RequestBody(
 *    required=true,
 *    description="Pass user details",
 *    @OA\JsonContent(
 *       required={"username","email","password"},
 *      @OA\Property(property="username", type="string", format="string", example="admin"),
 *       @OA\Property(property="email", type="string", format="email", example="admin@mail.com"),
 *       @OA\Property(property="password", type="string", format="password", example="PassWord12345")       
 *    ),
 * ),
 * @OA\Response(
 *    response=201,
 *    description="Success",
 *    @OA\JsonContent(
 *       @OA\Property(property="error", type="string",  example=""
 *        ))
 * 
 *     ),
 * @OA\Response(
 *    response=400,
 *    description="Bad request response",
 *    @OA\JsonContent(
 *       @OA\Property(property="message", type="string", 
 *        example={"error": {
 *              "username": {
 *                "The username field is required."
 *               },
 *             "email": {
 *                "The email field is required."
 *              },
 *             "password": {
 *                "The password field is required."
 *             }
 *           } }
 *        )
 *      )
 *    )
 * )
 */
    public function register(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'username'                => 'required|unique:users',
            'email'                   => 'required|email|unique:users',
            'password'                => 'required',
            // 'c_password'              => 'required|same:password',
            'country_code'            => 'string|min:2|max:2',
            'mobile_no'               => 'min:10|max:20|unique:users',
            /*'company'                 => 'string|max:255',
            'production_capacity'     => 'numeric|min:0|max:99999',
            'storage_capacity'        => 'numeric|min:0|max:99999',
            'boat_contract'           => 'numeric|min:0|max:1',
            'boat_owner'              => 'numeric|min:0|max:1',
            'boat_contract_capacity'  => 'numeric|min:0|max:99999',
            'boat_owner_capacity'     => 'numeric|min:0|max:99999'*/
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $input             = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user              = User::create($input);
        $success['token']  = $user->createToken('MyApp')->accessToken;
        $success['username']   = $user->username;
        return response()->json(['success' => $success], $this->successStatus);
    }
   /**
     * @OA\Get(
     * path="/auth/details",
     * summary="Get login user details",
     * description="Get login user details",
     * operationId="getUserDetail",
     * tags={"Auth"},
     * security={{"bearerAuth":{}}},   
     * @OA\Response(
     *    response=201,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="error", type="string",  example=""
     *        ))
     *     )
     * )
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
