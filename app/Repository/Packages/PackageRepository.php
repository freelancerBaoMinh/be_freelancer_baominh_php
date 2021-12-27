<?php

namespace App\Repository\Packages;

use App\Models\Package;
use Illuminate\Support\Facades\DB;

class PackageRepository extends \App\Repository\BaseRepository implements PackageRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Package::class;
    }
    public function getList($page = 1)
    {
        $query = DB::table($this->model->getTable())->selectRaw('id as package_id, name');
        if ($page > 1)
        {
            $query = $query->where('id','>', $page);
        }
        $list = $query->where('status', 1)->limit(20)->get();
        $lastId = 0;
        if ($list->last() && sizeof($list) === 20)
        {
            $lastId = $list->last()->id;
        }
        return [
          'list'=>$list,
          'next_page'=>$lastId
        ];
    }
}
