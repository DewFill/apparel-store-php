<?php

use inc\v1\environment_variable\EnvironmentVariable;

require "vendor/autoload.php";
$env = EnvironmentVariable::init(".env");
$env = EnvironmentVariable::instance();

try {
    $multi_query = file_get_contents(__DIR__ . "/sql_inserts/inserts.sql");
    executeMultiQuery($env, $multi_query);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

function executeMultiQuery($env, #[SensitiveParameter] $multi_query)
{
    $new_conn = mysqli_connect(
        $env->get("DATABASE_HOST"),
        $env->get("DATABASE_USER"),
        $env->get("DATABASE_PASSWORD"),
        $env->get("DATABASE_NAME"));

    try {
        $res = mysqli_multi_query($new_conn, $multi_query);
    } catch (Exception $e) {
        exit(strlen($e->getMessage()));
    }
}