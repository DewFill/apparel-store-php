<?php

use DB\CartProductsQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$product_id = $request->getMetaOrThrow('product_id');

$product = CartProductsQuery::create()
    ->filterByUserId(Auth::getUser()->id())
    ->filterByProductId($product_id)
    ->findOne();

try {
    $product->delete();
} catch (PropelException $e) {
}

JsonOutput::success("Product removed from cart");