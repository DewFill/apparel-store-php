<?php

use DB\Brands;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$request->checkRequestVariablesOrError("brand_name");

$brand = new Brands();
$brand->setName($request->getData("brand_name"));

try {
    $brand->save();
    JsonOutput::success(["brand_id" => $brand->getId(), "brand_name" => $brand->getName()]);
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при сохранении бренда");
}
