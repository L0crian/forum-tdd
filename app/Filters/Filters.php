<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

/*        $this->getFilters()
            ->filter(function($filter) {
                return methods_exists($this, $filter);
            })
            ->each(function($filter, $value) {
                $this->$filter($value);
            });*/

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)){
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function getFilters()
    {
        return $this->request->intersect($this->filters);
    }

    /*public function getFilters()
    {
        return collect($this->request->intersect($this->filters))->flip();
    }*/

    /**
     * @param $filter
     * @return bool
     */
   /* protected function hasFilter($filter)
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }*/
}