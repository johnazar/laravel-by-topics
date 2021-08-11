<?php
namespace App\QueryFilters;


class Sort extends Filter
{
    public function applyFilter($builder)
    {
        return $builder->orderBy('published_at', request()->get($this->filterName()));
    }
}