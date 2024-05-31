<?php

use Delight\Auth\AuthError;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;

try {
    Auth::getUser()->logOut();
    JsonOutput::success(['message' => 'Вы успешно вышли из аккаунта']);
} catch (AuthError $e) {
    JsonOutput::error("Ошибка выхода из аккаунта");
}