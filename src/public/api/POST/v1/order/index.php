<?php

use DB\CartProductsQuery;
use DB\OrderProducts;
use DB\Orders;
use DB\UserAdressesQuery;
use DB\UsersQuery;
use inc\v1\auth\Auth;
use inc\v1\content\Content;
use inc\v1\environment_variable\EnvironmentVariable;
use inc\v1\json_output\JsonOutput;
use inc\v1\mail\Mail;
use inc\v1\request\Request;
use Propel\Runtime\Exception\PropelException;

const PRICE_USUAL_DELIVERY = 390;
const PRICE_PREMIUM_DELIVERY = 790;

$request = new Request();
$request->checkRequestVariablesOrError("delivery_type", "address_id");

$delivery_type = $request->getData("delivery_type") === "premium" ? "Премиум" : "Обычная";


$delivery_price = $request->getData("delivery_type") === "premium"
    ? PRICE_PREMIUM_DELIVERY
    :
    PRICE_USUAL_DELIVERY;
$number_of_products = 0;

$user = UsersQuery::create()->findOneById(Auth::getUser()->id());
$user_full_name = "{$user->getSurname()} {$user->getName()} {$user->getPatronymic()}";

$address = UserAdressesQuery::create()
    ->filterByUserId(Auth::getUser()->id())
    ->filterById($request->getData("address_id"))
    ->findOne();

if ($address === null) JsonOutput::error("Неверный адрес");

$order = new Orders();
$order->setUserId(Auth::getUser()->id());
$order->setAddress(Content::addressStringBuilder($address));
$order->setFullName($user_full_name);
$order->setEmail($user->getEmail());
$order->setDeliveryName($delivery_type);
$order->setDeliveryPrice($delivery_price);
//$order->setStatus("completed");

try {
    $order->save();
} catch (PropelException $e) {
    die("1DATABASE ERROR: " . $e->getMessage());
}

$cart_products = CartProductsQuery::create()
    ->filterByUserId(Auth::getUser()->id())
    ->find();

if ($cart_products->isEmpty()) JsonOutput::error("Корзина пуста");

foreach ($cart_products as $cart_product) {
    $order_product = new OrderProducts();
    $order_product->setOrderId($order->getId());
    $order_product->setProductId($cart_product->getProducts()->getId());
    $order_product->setSizeId($cart_product->getSizeId());
    $order_product->setQuantity($cart_product->getQuantity());
    try {
        $order_product->save();
    } catch (PropelException $e) {
        die("2DATABASE ERROR: " . $e->getMessage());
    }

    try {
        $cart_product->delete();
    } catch (PropelException $e) {
        die("3DATABASE ERROR: " . $e->getMessage());
    }
}

$http_schema = EnvironmentVariable::instance()->get("APP_SCHEMA");
$domain = EnvironmentVariable::instance()->get("APP_DOMAIN");
$email_body = "Добрый день! Заказ №{$order->getId()} был создан! Ссылка на заказ: $http_schema://$domain/order?order_id={$order->getId()}/";
Mail::send($order->getEmail(), "Artemy | Заказ №{$order->getId()} создан!",
    $email_body, $email_body);

JsonOutput::success(["order_id" => $order->getId()]);