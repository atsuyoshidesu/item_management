<?php

namespace App\Filters\Product;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\Filter;

class ProductRaitingFilter extends Filter
{
    public function handle(Builder $query): void
    {
        $query->where('raiting', '>=', $this->value);
    }
}