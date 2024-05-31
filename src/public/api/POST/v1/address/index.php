<?php

use DB\UserAdresses;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();

$request->checkRequestVariablesOrError("region", "city", "district", "street", "zip_code", "house");

$user = Auth::getUserOrThrow();
$address = new UserAdresses();
$address->setUserId($user->id());
$address->setRegion($request->getData("region"));
$address->setCity($request->getData("city"));
$address->setDistrict($request->getData("district"));
$address->setStreet($request->getData("street"));
$address->setZipCode($request->getData("zip_code"));
$address->setHouse($request->getData("house"));
if ($request->getData("apartment") !== null) {
    $address->setApartment($request->getData("apartment"));
}

try {
    $address->save();
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при сохранении адреса");
}

JsonOutput::success("Адрес успешно сохранен");