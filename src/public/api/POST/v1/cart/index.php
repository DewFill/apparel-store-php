<?php

use DB\CartProducts;
use DB\CartProductsQuery;
use DB\ProductSizesQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$request->checkRequestVariablesOrError("product_id", "quantity", "size_id");
$user = Auth::getUserOrThrow();

if ($request->getData("quantity") < 1 or $request->getData("quantity") > 99) {
    JsonOutput::error("Quantity must be between 1 and 99");
}


//если есть размеры товара - проверяем, что выбран один из них
$product_sizes = ProductSizesQuery::create()->findByProductId($request->getData("product_id"));
if ($product_sizes->count() !== 0) {
    $selected_size = ProductSizesQuery::create()
        ->filterById($request->getData("size_id"))
        ->filterByProductId($request->getData("product_id"))
        ->findOne();

    if ($selected_size === null) {
        JsonOutput::error("У товара нет выбранного размера");
    }
}


try {

    $cart_product = CartProductsQuery::create()
        ->filterByUserId($user->id())
        ->filterByProductId($request->getData("product_id"))
        ->filterBySizeId($request->getData("size_id"))
        ->findOne();

    //если в корзине пользователя уже существует товар - добавить количество
    if ($cart_product !== null) {
        $cart_product->setQuantity($cart_product->getQuantity() + $request->getData("quantity"));
        $cart_product->save();
    } else {
        (new CartProducts())
            ->setUserId($user->id())
            ->setProductId($request->getData("product_id"))
            ->setQuantity($request->getData("quantity"))
            ->setSizeId($request->getData("size_id"))
            ->save();
    }

} catch (PropelException $e) {
    JsonOutput::error($e->getMessage());
}

JsonOutput::success("Товар добавлен в корзину");