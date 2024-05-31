<?php

namespace inc\v1\filter;

use DB\ProductsQuery;

class Filter
{
    const TAG_SHOW_ON_MAIN_PAGE = "show_on_main_page";
    static function filter() {
        $products = ProductsQuery::create()->find();
        $products->filterByShowOnMainPage(true);
        return $products;
    }
}