<?php
namespace App\QueryFilters;
use Closure;
use Illuminate\Support\Str;
abstract class Filter
{
    public function handle($request, Closure $next)
    {
        $builder = $next($request);
        if(!request()->has($this->filterName())){
            return $builder;
        }

        return $this->applyFilter($builder);
        

    }

    protected abstract function applyFilter($builder);

    protected function filterName()
    {

        // get the name of filter based on name of filename (class)
        return Str::snake(class_basename($this));
    }

}