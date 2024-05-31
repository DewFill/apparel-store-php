<?php

use DB\CategoriesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;


$request = new Request();
$category_id = $request->getDataOrThrow("category_id");
$category_name = $request->getDataOrThrow("category_name");


$category = CategoriesQuery::create()->findOneById($category_id);
$category->setName($category_name);
try {
    $category->save();
} catch (PropelException $e) {
    JsonOutput::error("Error while saving the category: " . $e->getMessage());
}

JsonOutput::success();