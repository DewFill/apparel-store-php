<?php

use DB\Base\SlidesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();
$slide_id = $request->getMetaOrThrow("slide_id");

$slide = SlidesQuery::create()->findOneById($slide_id);
if ($slide === null) {
    JsonOutput::error("Slide not found");
}
JsonOutput::success(["id" => $slide->getId(),
                     "active" => $slide->getActive(),
                     "url" => $slide->getUrl(),
                     "image" =>
                         "https://" .
                         $_SERVER["HTTP_HOST"] .
                         "/api/v1/slides/image?slide_id=" .
                         $slide->getId()
                         . "/"]);