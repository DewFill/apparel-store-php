<?php

use DB\ProductsQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$product_id = $request->getMeta("product_id");

if ($product_id === null) JsonOutput::error("Не указан ID товара");

$product = ProductsQuery::create()->findOneById($product_id);
try {
    $product->delete();
    JsonOutput::success("Товар успешно удален");
} catch (PropelException $e) {
    JsonOutput::error("Ошибка удаления товара");
}