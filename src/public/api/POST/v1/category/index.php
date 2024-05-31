<?php

use DB\Categories;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$request->checkRequestVariablesOrError("category_name");

$category = new Categories();
$category->setName($request->getData("category_name"));

try {
    $category->save();
    JsonOutput::success(["category_id" => $category->getId(), "category_name" => $category->getName()]);
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при сохранении категории");
}
