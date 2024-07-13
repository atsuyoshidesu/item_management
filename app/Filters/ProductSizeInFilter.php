<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Filter;

class ProductSizeInFilter extends Filter
{
    public function handle(Builder $query): void
    {
        $query->whereIn('size', explode(',', $this->value));
    }
}