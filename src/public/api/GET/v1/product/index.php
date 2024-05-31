<?php

use DB\BrandsQuery;
use DB\ProductRatingQuery;
use DB\ProductsQuery;
use DB\UserFavoritesQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$product_id = (new Request())->getMetaOrThrow('product_id');

$product = ProductsQuery::create()->findOneById($product_id);

$sizes = (function() use ($product) {
    $array = [];
    foreach ($product->getProductSizess() as $size) {
        $array[] = [
            'id' => $size->getId(),
            'name' => $size->getSize()
        ];
    }

    return $array;
})();


JsonOutput::success([
                        'id' => $product->getId(),
                        "name" => $product->getName(),
                        "price" => $product->getPrice(),
                        "discount" => $product->getDiscountPrice(),
                        "sizes" => $sizes,
                        "brand" => [
                            "id" => $product->getBrands()?->getId(),
                            "name" => $product->getBrands()?->getName(),
                        ],
                        "description" => $product->getDescription(),
                        "categories" => [
                            "id" => $product->getCategoryId(),
                            "name" => $product->getCategory()->getName()
                        ],
                        "article" => $product->getArticle(),
                    ]);