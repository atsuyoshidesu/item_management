<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class Filter
{
    public function __construct(protected readonly mixed $value)
    {
    }

    abstract public function handle(Builder $query): void;
}