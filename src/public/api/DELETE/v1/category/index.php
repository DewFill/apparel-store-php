<?php

use DB\CategoriesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$category_id = (new Request())->getMetaOrThrow("category_id");

if (in_array($category_id, [1, 2, 3, 4])) JsonOutput::error("Нельзя удалить категорию по умолчанию");

    $category = CategoriesQuery::create()->findOneById($category_id);

try {
    $category->delete();
    JsonOutput::success("Категория удалена");
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при удалении категории");
}