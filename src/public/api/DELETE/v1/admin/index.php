<?php

use DB\UsersQuery;
use Delight\Auth\Role;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$user_id = $request->getMetaOrThrow("user_id");

if (!Auth::getUserOrThrow()->hasRole(Role::ADMIN)) JsonOutput::error("Недостаточно прав");

$admins = UsersQuery::create()->filterByRolesMask(Role::ADMIN)->find();
if ($admins->count() === 1) JsonOutput::error("Нельзя удалить последнего администратора");

$user = UsersQuery::create()->findOneById($user_id);
if ($user === null) JsonOutput::error("Пользователь не найден");

$user->setRolesMask(0);

try {
    $user->save();
    JsonOutput::success();
} catch (PropelException $e) {
    JsonOutput::error("Ошибка при удалении администратора");
}

