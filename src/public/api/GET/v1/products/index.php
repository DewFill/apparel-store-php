<?php

use DB\BrandsQuery;
use DB\ProductsQuery;
use inc\v1\json_output\JsonOutput;

$products = ProductsQuery::create()->find();

$array = [];
foreach ($products as $product) {
    $brand_name = $product->getBrandId() === null ? null : BrandsQuery::create()->findOneById($product->getBrandId())->getName();
    $array[] = $product->getId();
}

JsonOutput::success($array);