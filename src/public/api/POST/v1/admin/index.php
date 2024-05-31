<?php

use DB\UsersQuery;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\Role;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$request = new Request();

$request->checkRequestVariablesOrError("user_email");

if (!Auth::getUserOrThrow()->hasRole(Role::ADMIN)) JsonOutput::error("Недостаточно прав");

//$admins = UsersQuery::create()->filterByRolesMask(Role::ADMIN)->find();
//
//if ($admins->count() === 1) JsonOutput::error("Нельзя удалить последнего администратора");

try {
    Auth::getUserOrThrow()->admin()->addRoleForUserByEmail($request->getData("user_email"), Role::ADMIN);
    JsonOutput::success();
} catch (InvalidEmailException $e) {
    JsonOutput::error("Неверный email");
}