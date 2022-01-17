<?php

namespace App\Http\Controllers\Api\Customer;

use App\Repository\Contracts\ContractRepositoryInterface;
use App\Repository\Users\UserRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class UserController extends \App\Http\Controllers\Controller
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
     * @var int|mixed
     */
    private $userId;
    /**
     * @var \Tymon\JWTAuth\Contracts\JWTSubject
     */
    private $userLogin;
    /**
     * @var ContractRepositoryInterface
     */
    private $contractRepository;

    public function __construct(JWTAuth $jwt, UserRepositoryInterface $userRepository, ContractRepositoryInterface $contractRepository)
    {
        $this->jwt = $jwt;
        $this->userRepository = $userRepository;
        $this->userLogin = $jwt->user();
        $this->userId = ($this->userLogin)?$this->userLogin->id:0;
        $this->contractRepository = $contractRepository;
    }
    public function changePass(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ]);
        $oldPassword = $request->input('old_password');

        $status = 456;
        $message = 'Old password incorrect';

        if (password_verify($oldPassword, $this->userLogin->password)) {
            $password = $request->input('new_password');

            $this->userLogin->update([
                'password' => Hash::make($password),
            ]);
            $status = 200;
            $message = 'Change password successful';
            $this->jwt->invalidate();
        }
        return $this->successResponseMessage(new \stdClass(), $status, $message);
    }
    public function getRelationShip(): \Illuminate\Http\JsonResponse
    {
        $list = $this->contractRepository->getRelationship($this->userId);
        return $this->successResponseMessage(['list'=>$list], 200, 'success');
    }
}
