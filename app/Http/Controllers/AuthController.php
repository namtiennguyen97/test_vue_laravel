<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => [
                'login',
                'logout',
                'refresh',
                'detail'
            ]
        ]);
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Post(
     *     path="/api/auth/login",
     *     tags={"Auth"},
     *     description="Login",
     *      @SWG\Parameter(in="body", name="body", required=true,
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="email", type="string", required=true),
     *              @SWG\Property(property="password", type="string", required=true),
     *          ),
     *      ),
     *      @SWG\Response(response=200, description="Đăng nhập lấy token",
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="success", type="boolean"),
     *              @SWG\Property(property="statusCode", type="integer", default=200),
     *              @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="access_token", type="string"),
     *                  @SWG\Property(property="token_type", type="string"),
     *                  @SWG\Property(property="expires_in", type="integer"),
     *              ),
     *          ),
     *      ),
     *     @SWG\Response(response=422, description="Missing Data")
     * )
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            $res = [
                'success' => true,
                'statusCode' => 200,
                'data' => $this->respondWithToken($token)
            ];
            return response()->json($res);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * @SWG\Get(
     *     path="/api/auth/detail",
     *     tags={"Auth"},
     *     description="Get Infor",
     *      @SWG\Response(response=200, description="Lấy thông tin user",
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="success", type="boolean"),
     *              @SWG\Property(property="statusCode", type="integer", default=200),
     *              @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="access_token", type="string"),
     *                  @SWG\Property(property="token_type", type="string"),
     *                  @SWG\Property(property="expires_in", type="integer"),
     *              ),
     *          ),
     *      ),
     *     @SWG\Response(response=422, description="Missing Data"),
     *      security = {
     *         {
     *             "http_bearer_auth": {},
     *         }
     *      },
     * )
     */
    public function detail()
    {
        $res = [
            'success' => true,
            'statusCode' => 200,
            'data' => $this->guard()->user()
        ];
        return response()->json($res);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->json($this->respondWithToken($this->guard()->refresh()));
    }

    /**
     * @param $token
     * @return array
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ];
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard();
    }
}
