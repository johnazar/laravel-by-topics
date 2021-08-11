<?php
namespace App\QueryFilters;



class Published extends Filter
{

    public function applyFilter($builder)
    {
        return $builder->whereNotNull('published_at');
    }
}