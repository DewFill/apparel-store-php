<?php

use Delight\Auth\AmbiguousUsernameException;
use Delight\Auth\AttemptCancelledException;
use Delight\Auth\AuthError;
use Delight\Auth\EmailNotVerifiedException;
use Delight\Auth\InvalidEmailException;
use Delight\Auth\InvalidPasswordException;
use Delight\Auth\TooManyRequestsException;
use Delight\Auth\UnknownUsernameException;
use inc\v1\auth\Auth;
use inc\v1\development_mode\DevelopmentMode;
use inc\v1\json_output\JsonOutput;
use inc\v1\request\Request;

$throttling = !DevelopmentMode::isActive();
$rememberDuration = (int)(60 * 60 * 24 * 365.25);
$auth = Auth::getUser();
$request = new Request();
$request->checkRequestVariablesOrError("user_email", "user_password");

try {
    $auth->login($request->getData("user_email"), $request->getData("user_password"), $rememberDuration);

    JsonOutput::success();
} catch (InvalidPasswordException|InvalidEmailException $e) {
    JsonOutput::error("Неправильно введён логин или пароль");
} catch (EmailNotVerifiedException $e) {
    JsonOutput::error("Почта не подтверждена");
} catch (TooManyRequestsException $e) {
    JsonOutput::error("Слишком много запросов");
} catch (AttemptCancelledException $e) {
    JsonOutput::error("Попытка отменена");
}