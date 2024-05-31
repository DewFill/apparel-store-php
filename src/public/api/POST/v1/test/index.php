<?php

use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();

var_dump($request::$method_body);

//JsonOutput::success();
