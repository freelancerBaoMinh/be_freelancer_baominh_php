<?php

namespace App\Http\Controllers\Api\Admin;

use App\Repository\Details\DetailRepositoryInterface;
use App\Repository\Packages\PackageRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class HomeController extends \App\Http\Controllers\Controller
{
    use ApiResponse;

    /**
     * @var PackageRepositoryInterface
     */
    private $packageRepository;
    /**
     * @var DetailRepositoryInterface
     */
    private $detailRepository;

    public function __construct(PackageRepositoryInterface $packageRepository, DetailRepositoryInterface  $detailRepository)
    {
        $this->packageRepository= $packageRepository;
        $this->detailRepository = $detailRepository;
    }
    public function listPackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $page = (int)$request->get('page', 1);
        $list = $this->packageRepository->getList($page);
        return $this->successResponseMessage($list, 200, 'success');
    }
    public function detailPackage(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
           'package_id'=>'numeric|required'
        ]);
        return $this->successResponseMessage($this->detailRepository->getDetail($request->get('package_id')), 200, 'success');
    }
}
