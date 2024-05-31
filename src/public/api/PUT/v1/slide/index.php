<?php
//updating slides
use DB\SlidesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;


$request = new Request();
$slide_id = $request->getDataOrThrow("slide_id");

if (!empty($_FILES['slide_image'])) {
    if ($_FILES['slide_image']['error'] !== UPLOAD_ERR_OK) {
        JsonOutput::error("Upload failed with error code " . $_FILES['slide_image']['error']);
    }

    if (!str_starts_with(mime_content_type($_FILES['slide_image']['tmp_name']), "image/")) {
        JsonOutput::error("File is not an image");
    }

    $fileContent = file_get_contents($_FILES['slide_image']['tmp_name']);
}



$slide = SlidesQuery::create()->findOneById($slide_id);
if (!empty($fileContent)) {
    $slide->setImage($fileContent);
}
if (!empty(_PUT["slide_url"])) {
    $slide->setUrl(_PUT["slide_url"]);
}

if (!empty(_PUT["slide_active"])) {
    $slide->setActive(_PUT["slide_active"]);
}

try {
    $slide->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error("Error while saving the slide: " . $e->getMessage());
}

JsonOutput::success();