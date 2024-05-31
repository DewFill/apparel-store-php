<?php

use Delight\Auth\AuthError;
use Delight\Auth\NotLoggedInException;
use Delight\Auth\UnknownIdException;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;

try {
    $user_id = Auth::getUserOrThrow()->id();
    Auth::getUserOrThrow()->logOutEverywhere();
    Auth::getUser()->admin()->deleteUserById($user_id);
    JsonOutput::success("Аккаунт успешно удален");
} catch (UnknownIdException $e) {
    JsonOutput::error("Пользователь не найден");
} catch (NotLoggedInException $e) {
    JsonOutput::error("Вы не авторизованы");
} catch (AuthError $e) {
    JsonOutput::error("Ошибка авторизации");
}