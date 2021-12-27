<?php

namespace App\Repository\Rules;

use App\Models\Rule;
use Illuminate\Support\Facades\DB;

class RuleRepository extends \App\Repository\BaseRepository implements RuleRepositoryInterface
{
    public $group = [
        'A' => 'Quyền lợi bảo hiểm chính',
        'B' => 'Quyền lợi bổ sung'
    ];

    /**
     * @inheritDoc
     */
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return Rule::class;
    }

    public function getList(array $ids): \Illuminate\Support\Collection
    {
        return DB::table($this->model->getTable())->whereIn('id', $ids)
            ->orderBy('group')
            ->orderBy('order')
            ->get()->keyBy('id');
    }
    public function listRule(): array
    {
        $list = DB::table($this->model->getTable())
            ->orderBy('group')
            ->orderBy('order')
            ->get()->groupBy('group');
        $result = [];
        foreach ($list as $group=>$rules)
        {
            $result[]=[
              'group'=>$group,
              'group_name'=>$this->group[$group],
              'list'=>$rules
            ];
        }
        return $result;
    }
}
