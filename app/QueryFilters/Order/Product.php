<?php


namespace App\QueryFilters\Order;


use App\QueryFilters\Filter;

class Product extends Filter
{
    protected function applyFilter($builder)
    {
        return $builder
            ->select('orders.*', 'order_product.product_id')
            ->join('order_product', 'orders.id', '=', 'order_product.order_id')
            ->whereIn('order_product.product_id', request($this->filterName()));
    }
}
