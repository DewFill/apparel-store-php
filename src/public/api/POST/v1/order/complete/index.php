<?php

use DB\OrdersQuery;
use inc\v1\environment_variable\EnvironmentVariable;
use inc\v1\json_output\JsonOutput;
use inc\v1\mail\Mail;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

$request = new Request();
$request->checkRequestVariablesOrError("order_id");

$order = OrdersQuery::create()->findOneById($request->getData("order_id"));
$order->setStatus("completed");
$http_schema = EnvironmentVariable::instance()->get("APP_SCHEMA");
$domain = EnvironmentVariable::instance()->get("APP_DOMAIN");
try {
    $order->save();
    $email_body = "Добрый день! Заказ №{$order->getId()} был завершён! Ссылка на заказ: $http_schema://$domain/order?order_id={$order->getId()}/";
    Mail::send($order->getEmail(), "Artemy | Заказ №{$order->getId()} завершён!",
        $email_body, $email_body);
    JsonOutput::success();
} catch (PropelException $e) {
    JsonOutput::error();
}