<?php

use DB\ProductImagesQuery;
use DB\SlidesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();
$product_image_id = $request->getMetaOrThrow("product_image_id");
$product_image = ProductImagesQuery::create()->findOneById($product_image_id);

if ($product_image === null) {
    http_response_code(404);
    JsonOutput::error("Product images not found");
}

header("Content-Type: " . mime_content_type($product_image->getImage()));

echo stream_get_contents($product_image->getImage());