<?php

use DB\BrandsQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$brand_id = (new Request())->getMetaOrThrow("brand_id");

$brand = BrandsQuery::create()->findOneById($brand_id);

try {
    $brand->delete();
    JsonOutput::success("Бренд удален");
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при удалении бренда");
}