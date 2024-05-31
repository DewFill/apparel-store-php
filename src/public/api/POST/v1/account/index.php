<?php

use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$request->checkRequestVariablesOrError("name", "surname", "patronymic", "email");

$user = UsersQuery::create()->findOneById(Auth::getUserOrThrow()->id());
$user->setName($request->getData("name"));
$user->setSurname($request->getData("surname"));
$user->setPatronymic($request->getData("patronymic"));
$user->setEmail($request->getData("email"));
if ($request->getData("phone_number") !== null) {
    $user->setPhoneNumber($request->getData("phone_number"));
}

if ($request->getData("username") !== null) {
    $user->setUsername($request->getData("username"));
}
if ($request->getData("main_address_id") !== null) {
    $user->setMainAddressId($request->getData("main_address_id"));
}

try {
    $user->save();
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при сохранении данных пользователя");
}

JsonOutput::success("Данные успешно сохранены");