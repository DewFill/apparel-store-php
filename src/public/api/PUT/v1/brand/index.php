<?php
//updating slides
use DB\BrandsQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;


$request = new Request();
$brand_id = $request->getDataOrThrow("brand_id");
$brand_name = $request->getDataOrThrow("brand_name");



$brand = BrandsQuery::create()->findOneById($brand_id);
$brand->setName($brand_name);
try {
    $brand->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error("Error while saving the brand: " . $e->getMessage());
}

JsonOutput::success();