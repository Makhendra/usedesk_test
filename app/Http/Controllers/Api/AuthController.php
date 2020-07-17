<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @OA\POST(
     *     path="/api/auth/login",
     *     summary="Login",
     *     tags={"Auth"},
     *     @OA\Response(response="200", description="Success", content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="access_token",
     *                         type="string",
     *                         example="long_string"
     *                     ),
     *                    @OA\Property(
     *                         property="token_type",
     *                         type="string",
     *                         example="bearer"
     *                     ),
     *                    @OA\Property(
     *                         property="expires_in",
     *                         type="integer",
     *                         example="3600"
     *                     )
     *                )
     *            )
     *     }),
     *     @OA\Response(response="401", description="Authorisation Error", content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="error",
     *                         type="string",
     *                         example="Unauthorized"
     *                     )
     *                )
     *            )
     *     }),
     *     @OA\Response(response="422", description="Validation error"),
     *     @OA\RequestBody(
     *        request="auth",
     *        required=true,
     *        @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     format="email",
     *                     example="test@test.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     example="a866b892e50261ac8576"
     *                 ),
     *             )
     *         )
     *       ),
     *   ),
     *)
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $credentials = compact('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return $this->sendUnauthorized();
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @OA\POST(
     *     path="/api/auth/logout",
     *     summary="Logout",
     *     tags={"Auth"},
     *     security={ {"bearerAuth": {} } },
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent(
     *          @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Successfully logged out"
     *          ),
     *          @OA\Property(
     *              property="data",
     *              @OA\Items(type="string", example=""),
     *          ),
     *       )
     *   )
     * )
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout(true);

        return $this->sendSuccess( 'Successfully logged out');
    }

    /**
     * Refresh a token.
     * @OA\POST(
     *     path="/api/auth/refresh",
     *     summary="Refresh",
     *     tags={"Auth"},
     *     security={ {"bearerAuth": {} } },
     *    @OA\Response(response="200", description="Success", content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="access_token",
     *                         type="string",
     *                         example="long_string"
     *                     ),
     *                    @OA\Property(
     *                         property="token_type",
     *                         type="string",
     *                         example="bearer"
     *                     ),
     *                    @OA\Property(
     *                         property="expires_in",
     *                         type="integer",
     *                         example="3600"
     *                     )
     *                )
     *            )
     *     }),
     *     @OA\Response(response="401", description="Authorisation Error", content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="error",
     *                         type="string",
     *                         example="Unauthorized"
     *                     )
     *                )
     *            )
     *     }),
     *   ),
     * )
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * config('app.token_lifetime')
            ]
        );
    }
}