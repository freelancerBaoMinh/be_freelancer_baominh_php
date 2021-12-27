<?php

namespace App\Repository\Details;

use App\Http\Resources\Detail\DetailCollection;
use App\Models\Detail;
use Illuminate\Support\Facades\DB;

class DetailRepository extends \App\Repository\BaseRepository implements DetailRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Detail::class;
    }
    public function getDetail($packageId)
    {
        $detail = DB::table($this->model->getTable())
            ->where('package_id', (int)$packageId)
            ->orderBy('rule_id')->get();
        if ($detail)
        {
            $ruleIds = $detail->pluck('rule_id')->toArray();
            return new DetailCollection($detail, $ruleIds);
        }
        return new \stdClass();
    }
    public function insert($input)
    {
        DB::table($this->model->getTable())->insert($input);
    }
}
