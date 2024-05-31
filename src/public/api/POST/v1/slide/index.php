<?php
//adding slides
use inc\v1\json_output\JsonOutput;

if (empty($_FILES['slide_image'])) JsonOutput::error("Image is required");


if ($_FILES['slide_image']['error'] !== UPLOAD_ERR_OK) {
    JsonOutput::error("Upload failed with error code " . $_FILES['slide_image']['error']);
}

if (!str_starts_with(mime_content_type($_FILES['slide_image']['tmp_name']), "image/")) {
    JsonOutput::error("File is not an image");
}


$fileContent = file_get_contents($_FILES['slide_image']['tmp_name']);

$slide = new \DB\Slides();
$slide->setImage($fileContent);

try {
    $slide->save();
} catch (\Propel\Runtime\Exception\PropelException $e) {
    JsonOutput::error("Error while saving the slide: " . $e->getMessage());
}

JsonOutput::success(["slide_id" => $slide->getId()]);