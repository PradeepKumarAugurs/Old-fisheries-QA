<?php

namespace Modules\Auth\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Modules\Auth\Notifications\PasswordResetRequest;
use Modules\Auth\Notifications\PasswordResetSuccess;
// use App\User;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\PasswordReset;
use Illuminate\Support\Str;
use Validator;

class PasswordResetController extends Controller
{
    /**
     * @OA\Post(
     * path="/auth/password/create",
     * summary="Create token to reset password",
     * description="Create token to reset password",
     * operationId="CreateToken",
     * tags={"Auth"},
     *  @OA\RequestBody(
     *    required=true,
     *    description="Pass user email",
     *    @OA\JsonContent(
     *       required={"email"},
     *       @OA\Property(property="email", type="string", format="email", example="admin@gmail.com")      
     *    ),
     * ),
     * @OA\Response(
     * response=201,
     * description="Success",
     * @OA\JsonContent(
     * @OA\Property(property="error", type="string",  example=""
     *  )
     * ),
     * 
     * * @OA\Response(
     *    response=400,
     *    description="Bad request response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", 
     *      example={"error": {
     *       "email": {
     *           "The email field is required."
     *       }
     *   }})
     *        )
     *     )
     * 
     * )
     * )
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|string|email'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $user = User::where('email',$request->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can`t find a user with that e-mail address.'
            ], 404);
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                // 'token' => str_random(60)
                'token' => Str::random(12)
                
             ]
        );
        if ($user && $passwordReset)
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
    /**
     * @OA\Get(
     * path="/auth/password/find/{token}",
     * summary="Find valid Token",
     * description="Find Valid token",
     * operationId="findToekn",
     * tags={"Auth"},
     *     @OA\Parameter(
     *         description="ID of pet to return",
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *           format="IcOFLdRlCBz8"
     *         )
     *     ),
     * @OA\Response(
     *  response=201,
     *  description="Success",
     *  @OA\JsonContent(
     *    @OA\Property(
     *      property="error",type="string",example="" 
     *   )
     *  )
     * )
     * )
     
     */
    public function find($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        if(Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
    /**
     * @OA\Post(
     *   path="/auth/password/reset",
     *   summary="Reset Password",
     *   description="Reset Password",
     *   operationId="passwordReset",
     *   tags={"Auth"}, 
     *   @OA\RequestBody(
     *      required=true,
     *      description="pass toekn and password details",
     *        @OA\JsonContent(
     *          required={"password","password_confirmation","token"},
     *          @OA\Property(property="password",type="string",format="string",example="Password@123"),
     *          @OA\Property(property="password_confirmation",type="string",format="string",example="Password@123"),
     *          @OA\Property(property="token",type="string",format="string",example="IcOFLdRlCBz8")
     *       )
     *   ),
     *   @OA\Response(
     *       response=201,
     *       description="Success",
     *       @OA\JsonContent(
     *         @OA\Property(property="error",type="string",format="string",example="IcOFLdRlCBz8")  
     *       )
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad request response",
     *      @OA\JsonContent(
     *         @OA\Property(property="message",type="string",format="string",
     *             example={
     *                     "error":{
*                           "password":{"The password field is required."},
*                           "token" : {"The token field is required."}
     *               } 
     *            }
     *         )
     *      ) 
     *   )
     *   
     * )
    */
    public function reset(Request $request)
    {      

        $validator = Validator::make($request->all(), [ 
            // 'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        
        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            //['email', $request->email]
        ])->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => 'We can`t find a user with that e-mail address.'
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json($user);
    }
}
