<?php
//deleting slides
use DB\SlidesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$slide_id = $request->getMetaOrThrow("slide_id");

$slide = SlidesQuery::create()->findOneById($slide_id);
try {
    $slide->delete();
} catch (PropelException $e) {
    JsonOutput::error("Не удалось удалить слайд");
}

JsonOutput::success("Слайд удален");