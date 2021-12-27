<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Resources\UserResources;
use App\Repository\Users\UserRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTAuth;

class LoginController extends \App\Http\Controllers\Controller
{
    use ApiResponse;
    /**
     * @var JWTAuth
     */
    private $jwt;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var int
     */
    private $userId;

    public function __construct(JWTAuth $jwt, UserRepositoryInterface  $userRepository)
    {
        $this->jwt = $jwt;
        $this->userRepository = $userRepository;
        $this->userId = isset($jwt->user()->id) ? $jwt->user()->id : 0;
    }
    public function login(Request $request)
    {
        $this->validate($request, [
           'username'=>'required|string',
           'password'=>'required|string'
        ]);
        $input = $request->only(['username', 'password']);
        $user = $this->userRepository->findByUsername($request->get('username'));
        if ($user)
        {
            $token= $this->jwt->attempt($input);
            if (!$token)
            {
                return $this->errorResponse('Username hoặc mật khẩu không đúng', 413);
            }
            return $this->successResponseMessage(['token'=>$token, 'user'=>new UserResources($user)], 200, 'success');
        }
        return $this->successResponseMessage(new \stdClass(), 404, 'User không tồn tại');
    }
    public function logout(Request $request)
    {

        $user = $this->userRepository->findById($this->userId);
        $user->update([
            'fcm_token' => '',
            'device' => 0
        ]);
        Auth::logout();
        $this->jwt->invalidate();
        return $this->successResponseMessage(new \stdClass(), 200, 'Logout success');
    }

}
