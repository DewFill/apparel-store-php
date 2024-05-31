<?php

use DB\AddressUser;
use DB\AddressUserQuery;
use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Exception\PropelException;

$user_id = Auth::getUser()->getUserId();

if ($user_id === null) JsonOutput::error('User not logged in');

$user = UsersQuery::create()->findOneById($user_id);
$request = new Request();
if ($request->getData("user_name") !== null) $user->setUserName($request->getData("user_name"));
if ($request->getData("user_surname") !== null) $user->setSurname($request->getData("user_surname"));
if ($request->getData("user_patronymic") !== null) $user->setPatronymic($request->getData("user_patronymic"));
if ($request->getData("user_phone_number") !== null) $user->setPhoneNumber($request->getData("user_phone_number"));
if ($request->getData("user_birthday") !== null) $user->setBirthday($request->getData("user_birthday"));
if ($request->getData("user_gender") !== null) $user->setGender($request->getData("user_gender"));
if ($request->getData("user_address") !== null) $address = (new AddressUser())->setAddress($request->getData("user_address"))->setUserId($user_id);

try {
    $user->save();
    if (isset($address)) $address->save();
} catch (PropelException $e) {
    JsonOutput::error("Error while saving user data");
}

