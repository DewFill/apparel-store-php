<?php

use DB\ProductsQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\mime_type\MimeType;
use inc\v1\request\Request;

$request = new Request();
$product_id = $request->getMetaOrThrow('product_id');

$product = ProductsQuery::create()->findOneById($product_id);


$image = $product->getMainImage();

$content_type = mime_content_type($image);
MimeType::setContentTypeHeader($content_type);

echo stream_get_contents($product->getMainImage());