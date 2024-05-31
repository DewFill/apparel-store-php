<?php

use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\json_output\JsonOutput;

$user_id = Auth::getUser()->getUserId();

$user = UsersQuery::create()->findOneById($user_id);

if ($user === null) {
    JsonOutput::error('User not found');
}

JsonOutput::success([
                        "name" => $user->getName(),
                        "surname" => $user->getSurname(),
                        "patronymic" => $user->getPatronymic(),
                        "phone_number" => $user->getPhoneNumber(),
                        "birthday" => $user->getBirthday(),
                        "gender" => $user->getGender()
                    ]);