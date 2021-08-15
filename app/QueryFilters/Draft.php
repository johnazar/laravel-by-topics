<?php
namespace App\QueryFilters;



class Draft extends Filter
{

    public function applyFilter($builder)
    {
        return $builder->whereNull('published_at');
    }
}