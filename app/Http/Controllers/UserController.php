<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\ErrorHandler\Debug;

class UserController extends Controller
{
    /**
     * @SWG\Post(
     *     path="/api/user/create",
     *     tags={"User"},
     *     description="Tạo tài khoản mẫu",
     *      @SWG\Parameter(in="body", name="body", required=true,
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="name", type="string", required=true),
     *              @SWG\Property(property="email", type="string", required=true),
     *              @SWG\Property(property="password", type="string", required=true),
     *          ),
     *      ),
     *      @SWG\Response(response=200, description="Info",
     *          @SWG\Schema(type="object",
     *              @SWG\Property(property="success", type="boolean"),
     *              @SWG\Property(property="statusCode", type="integer", default=200),
     *              @SWG\Property(property="data", type="object",
     *                  @SWG\Property(property="name", type="string"),
     *                  @SWG\Property(property="email", type="string"),
     *              ),
     *          ),
     *      ),
     *     @SWG\Response(response=422, description="Missing Data")
     * )
     */
    public function create(Request $request)
    {
        $userData = $request->only([
            'name',
            'email',
            'password',
        ]);
        if (empty($userData['name']) ||empty($userData['password']) || empty($userData['email'])) {
            return new \Exception('Missing data', 404);
        }

        $user = new User([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($userData['password']),
        ]);
        if(!$user->save()){
            dd('create user lỗi');
        }
        $res = [
            'success' => true,
            'statusCode' => 200,
            'data' => $user
        ];
        return response()->json($res);
    }
}
