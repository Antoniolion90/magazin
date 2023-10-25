<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderFilter extends AbstractFilter
{
    public const NAME_ORDER = 'name_order';
    public const DESCRIPTION = 'description';
    public const CATEGORY_ID = 'category_id';


    protected function getCallbacks(): array
    {
        return [
            self::NAME_ORDER => [$this, 'nameOrder'],
            self::DESCRIPTION => [$this, 'description'],
            self::CATEGORY_ID => [$this, 'categoryId'],
        ];
    }

    public function nameOrder(Builder $builder, $value)
    {
        $builder->where('name_order', 'like', "%{$value}%");
    }

    public function description(Builder $builder, $value)
    {
        $builder->where('description', 'like', "%{$value}%");
    }

    public function categoryId(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }
}
