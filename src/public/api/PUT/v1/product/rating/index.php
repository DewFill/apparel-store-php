<?php

use DB\ProductRatingQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$rating = $request->getDataOrThrow("rating");
$product_id = $request->getDataOrThrow("product_id");
$user = Auth::getUserOrThrow();

try {
    $product_rating = ProductRatingQuery::create()
        ->filterByUserId($user->getUserId())
        ->filterByProductId($product_id)
        ->findOneOrCreate();
} catch (PropelException $e) {
    JsonOutput::error("Could not create product rating");
}

try {
    $product_rating->setRating($rating);
    $product_rating->save();
} catch (PropelException $e) {
    JsonOutput::error("Could not save product rating");

}

JsonOutput::success();