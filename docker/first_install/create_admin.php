<?php

use Delight\Auth\Role;
use inc\v1\auth\Auth;
use inc\v1\environment_variable\EnvironmentVariable;
use MysqlCredentials\MysqlCredentials;

require "vendor/autoload.php";
$env = EnvironmentVariable::init(".env");
$env = EnvironmentVariable::instance();


// CREATING ADMIN USER
try {
    Auth::getUser()->register(
        $env->get("APP_ADMIN_PANEL_EMAIL"),
        $env->get("APP_ADMIN_PANEL_PASSWORD"),
        $env->get("APP_ADMIN_PANEL_USERNAME")
    );
    (new \Delight\Auth\Auth(MysqlCredentials::getPDO()))->admin()->addRoleForUserByEmail($env->get("APP_ADMIN_PANEL_EMAIL"), Role::ADMIN);
} catch (Exception $e) {
    exit($e->getMessage());
}

//UsersQuery::create()->findOneByEmail($env->get("APP_ADMIN_PANEL_EMAIL"))->set

// INSERTING DATA
