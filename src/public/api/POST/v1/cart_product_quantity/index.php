<?php

use DB\CartProductsQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$request->checkRequestVariablesOrError("cart_product_id", "quantity");
$cart_product = CartProductsQuery::create()
    ->filterById($request->getData("cart_product_id"))
    ->filterByUserId(Auth::getUserOrThrow()->id())
    ->findOne();

if ($cart_product === null) {
    JsonOutput::error("Товар не найден");
}

$cart_product->setQuantity($request->getData("quantity"));
try {
    $cart_product->save();
} catch (PropelException $e) {
    JsonOutput::error("Database error");
}

JsonOutput::success("success");