<?php

use DB\UserFavorites;
use DB\UserFavoritesQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;
$request = new Request();
//var_dump(_PUT);
$is_favorite = $request->getDataOrThrow("is_favorite");
$product_id = $request->getDataOrThrow("product_id");
$user = Auth::getUserOrThrow();

$product_user_favorite = UserFavoritesQuery::create()
    ->filterByUserId($user->getUserId())
    ->filterByProductId($product_id)
    ->findOne();

if ($is_favorite === true) {
    try {
        (new UserFavorites())
            ->setUserId($user->getUserId())
            ->setProductId($product_id)
            ->save();

        JsonOutput::success(["m" => "Сохранен фаворит"]);
    } catch (PropelException $e) {
        JsonOutput::error("Не удалось сохранить фаворит");
    }
} else {
    try {
        $product_user_favorite->delete();

        JsonOutput::success(['m' => "фаворит удален"]);
    } catch (PropelException $e) {
        JsonOutput::error("Не удалось удалить фаворит");
    }
}