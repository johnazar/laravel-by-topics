<?php
namespace App\QueryFilters;


class MaxCount extends Filter
{

    public function applyFilter($builder)
    {
        // get max_count
        return $builder->take(request()->get($this->filterName()));
    }
}