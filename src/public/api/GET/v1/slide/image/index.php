<?php

use DB\SlidesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();
$slide_id = $request->getMetaOrThrow("slide_id");
$slide = SlidesQuery::create()->findOneById($slide_id);

if ($slide === null) {
    http_response_code(404);
    JsonOutput::error("Slide not found");
}

header("Content-Type: " . mime_content_type($slide->getImage()));

echo stream_get_contents($slide->getImage());