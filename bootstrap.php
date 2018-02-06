<?php
/**
 * ПОДКЛЮЧАЕМ ЧЕРЗ НЕГО ДРУГИЕ СКРИПТЫ
 */
require_once "./vendor/autoload.php";
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths = array("src"); // по этому пути находится представление БД в виде классов
$isDevMode = true; // developer (если false - будет размещать запросы в кеше)

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '',
    'dbname'   => '333',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);