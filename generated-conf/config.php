<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion(2);
$serviceContainer->setAdapterClass('default', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle('default');
$manager->setConfiguration(array (
  'dsn' => 'mysql:host=database;port=3306;dbname=database',
  'user' => 'root',
  'password' => 'yE7sD6aH5rwB8z',
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
    ),
  ),
  'classname' => '\\Propel\\Runtime\\Connection\\ConnectionWrapper',
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$serviceContainer->setConnectionManager($manager);
$serviceContainer->setDefaultDatasource('default');
require_once __DIR__ . '/./loadDatabase.php';
