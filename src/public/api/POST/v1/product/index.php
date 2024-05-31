<?php

use DB\ProductCategories;
use DB\ProductImages;
use DB\Products;
use DB\ProductSizes;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

//var_dump($_FILES);
//die();
$request = new Request();
//var_dump($_POST);
$request->checkRequestVariablesOrError("product_name", "product_price");
if (empty($_FILES["product_main_image"])) JsonOutput::error("No {product_main_image} uploaded");
if ($_FILES['product_main_image']['error'] !== UPLOAD_ERR_OK) {
    JsonOutput::error("Upload main image with error code " . $_FILES['product_main_image']['error']);
}
if (!str_starts_with(mime_content_type($_FILES['product_main_image']['tmp_name']), "image/")) {
    JsonOutput::error("File is not an image");
}
$fileContent = getImage("product_main_image");

$product_name = $request->getData("product_name");
$product_price = $request->getData("product_price");
$product_brand_id = $request->getData("product_brand_id") === 0 ? null : $request->getData("product_brand_id");
$product_discount_price = $request->getData("product_discount_price");
$product_description = $request->getData("product_description");
$product_composition = $request->getData("product_composition");
$product_article = $request->getData("product_article");

$product = new Products();
$product->setName($product_name);
$product->setPrice($product_price);
$product->setBrandId($product_brand_id);
$product->setDiscountPrice($product_discount_price);
$product->setDescription($product_description);
$product->setCopmosition($product_composition);
$product->setArticle($product_article);
$product->setMainImage($fileContent);

try {
    $product->save();

    // добавление размеров
    if ($request->getData("sizes")) {
        $product_sizes = $request->getData("sizes");

        foreach ($product_sizes as $size) {
            (new ProductSizes())->setProductId($product->getId())->setSize($size)->save();
        }
    }

    //добавление категорий
    if ($request->getData("categories")) {
        $product_sizes = $request->getData("categories");

        foreach ($product_sizes as $size) {
            (new ProductCategories())->setProductId($product->getId())->setCategoryId($size)->save();
        }
    }

    //добавление дополнительных картинок
    if (!empty($_FILES["other_images"]["name"][0])) {
        $images = getImages("other_images");

        foreach ($images as $image) {
            (new ProductImages())->setProductId($product->getId())->setImage($image)->save();
        }
    }

    JsonOutput::success(["product_id" => $product->getId()]);
} catch (PropelException $e) {
    JsonOutput::error("Error while saving the product");
}

function getImage(string $files_name): string
{
    if (empty($_FILES[$files_name])) JsonOutput::error("No { {$files_name} } uploaded");
    if ($_FILES[$files_name]['error'] !== UPLOAD_ERR_OK) {
        JsonOutput::error("Upload failed with error code " . $_FILES[$files_name]['error']);
    }
    if (!str_starts_with(mime_content_type($_FILES[$files_name]['tmp_name']), "image/")) {
        JsonOutput::error("File is not an image");
    }
    return file_get_contents($_FILES[$files_name]['tmp_name']);
}

function getImages(string $files_name): array
{
    $images = [];
    for ($i = 0; $i < count($_FILES[$files_name]['name']); $i++) {
        if ($_FILES[$files_name]['error'][$i] !== UPLOAD_ERR_OK) {
            JsonOutput::error("Upload failed with error code " . $_FILES[$files_name]['error'][$i]);
        }
        if (!str_starts_with(mime_content_type($_FILES[$files_name]['tmp_name'][$i]), "image/")) {
            JsonOutput::error("File is not an image");
        }

        $images[] = file_get_contents($_FILES[$files_name]['tmp_name'][$i]);
    }
    return $images;
}