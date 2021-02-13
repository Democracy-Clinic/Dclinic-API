<?php

namespace ElectricalBlog\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;

    protected $filters = [];

    /**
     * Construct filters for the request from your model
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Main filter apply
     */
    public function apply($builder)
    {
        // dd($builder);
        $this->builder = $builder;
        foreach ($this->getFilter() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        return $this->builder;
    }

    public function getFilter()
    {
        return array_filter($this->request->only($this->filters));
    }
}
