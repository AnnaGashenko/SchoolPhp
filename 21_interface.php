<?php

/**
 * То есть данный интерфейс просто описывает работу с файлом.
 * Соответственно, те объекты, которые должны читать из файла и записывать различные данные,
 * обязаны реализовать интерфейс "FileInterface".
 */

interface FileInterface {
    public function readFromFile($path);
    public function writeToFile($path, $some);
}

/**
 * Данный интерфейс реализует функцию клиента, то есть можно что-то купить (задаётся $id),
 * а также что-то возвратить обратно (тоже задаётся по $id).
 */

interface Client {
    public function buy ($id);
    public function repayment($id);
}

/**
 * класс, который реализует эти интерфейсы,
 * то есть класс у которого области задач две - быть клиентом и работать с файлом
 */

class Shop implements FileInterface, Client{
    public function readFromFile($path) {
        echo "Считываем из файла и возвращаем строку<br />";
    }
    public function writeToFile($path, $some) {
        echo "Записываем в файл данные $some<br />";
    }
    public function buy($id) {
        echo "Спасибо за покупку<br />";
        $this->writeToFile("data.db", "<br />Был куплен товар $id");
    }
    public function repayment($id) {
        $this->readFromFile("data.db");
        //Тут, допустим, проверка того, была ли на самом деле покупка товара $id
        $this->writeToFile("data.db", "<br />Был сделан возврат товара $id");
    }
}

$shop = new Shop();
$shop->buy(5);
$shop->repayment(5);

/**
 * Спасибо за покупку
 * Записываем в файл данные
 * Был куплен товар 5
 * Считываем из файла и возвращаем строку
 * Записываем в файл данные
 * Был сделан возврат товара 5
 */