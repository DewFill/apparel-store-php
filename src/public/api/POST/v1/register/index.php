<?php

//SETTINGS
use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;
use Delight\Auth\UserAlreadyExistsException;
use inc\v1\auth\Auth;
use inc\v1\development_mode\DevelopmentMode;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$throttling = false;
$rememberDuration = (int)(60 * 60 * 24 * 365.25);
$auth = Auth::getUser();

$request = new Request();
$request->checkRequestVariablesOrError("user_email", "user_password", "user_username");


try {
    $userId = $auth->register($request->getData("user_email"), $request->getData("user_password"),
                              $request->getData("user_username"));

    $auth->admin()->logInAsUserById($userId);
    JsonOutput::success();
} catch (InvalidEmailException $e) {
    JsonOutput::error("Неверный адрес электронной почты");
} catch (InvalidPasswordException $e) {
    JsonOutput::error("Неправильный пароль");
} catch (UserAlreadyExistsException $e) {
    JsonOutput::error("Пользователь уже существует");
} catch (TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов");
} catch (\Delight\Auth\AuthError $e) {
    JsonOutput::error("Ошибка входа");
} catch (\Delight\Auth\EmailNotVerifiedException $e) {
    JsonOutput::error("Email не подтвержден");
} catch (\Delight\Auth\UnknownIdException $e) {
    JsonOutput::error("Неизвестный ID");
}