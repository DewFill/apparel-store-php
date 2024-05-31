<?php

use DB\UserAdressesQuery;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();

$address_id = $request->getMetaOrThrow("address_id");

$address = UserAdressesQuery::create()->filterById($address_id);

try {
    $address->delete();
} catch (PropelException $e) {
    JsonOutput::error("DATABASE ERROR");
}

JsonOutput::success("OK");