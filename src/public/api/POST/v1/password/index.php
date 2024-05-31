<?php

use Delight\Auth\AuthError;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\NotLoggedInException;
use Delight\Auth\TooManyRequestsException;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;


$request = new Request();
$request->checkRequestVariablesOrError("old_password", "new_password");

$old_password = $request->getData("old_password");
$new_password = $request->getData("new_password");

$auth = Auth::getUserOrThrow();

try {
    $auth->changePassword($old_password, $new_password);
} catch (AuthError $e) {
} catch (InvalidPasswordException $e) {
    JsonOutput::error("Неверный пароль");
} catch (NotLoggedInException $e) {
    JsonOutput::error("Пользователь не вошел");
} catch (TooManyRequestsException $e) {
    JsonOutput::error("Слишком много попыток");
}

JsonOutput::success("Пароль изменен");