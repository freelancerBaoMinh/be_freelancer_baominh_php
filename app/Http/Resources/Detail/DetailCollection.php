<?php

namespace App\Http\Resources\Detail;

use App\Repository\Rules\RuleRepositoryInterface;

class DetailCollection extends \Illuminate\Http\Resources\Json\ResourceCollection
{
    private $ruleIds;

    public function __construct($resource, $ruleIds)
    {
        parent::__construct($resource);
        $this->ruleIds = $ruleIds;
    }

    public function toArray($request)
    {
        $ruleRepository = app()->make(RuleRepositoryInterface::class);
        $rules = $ruleRepository->getList($this->ruleIds);
        $details = $this->collection->map(function ($item) use (&$rules) {
            $rule = $rules[$item->rule_id] ?? new \stdClass();
            return [
                'name' => $rule->name ?? '',
                'order' => $rule->order ?? 0,
                'group' => $rule->group ?? 'A',
                'value' => $item->value
            ];
        })->sortBy('group')->groupBy('group');
        $list = [];
        foreach ($details as $key => $detail) {
            $list[] = [
                'group' => $key,
                'group_name' => $ruleRepository->group[$key]??'',
                'list' => $detail
            ];
        }
        return $list;
    }
}
