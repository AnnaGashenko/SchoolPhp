<?php
$dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
/* Текст XML-документа */
$xml = "<?xml version='1.0' encoding='utf-8'?>
  <root><el>Элемент 1</el><el>Элемент 2</el></root>";
$dom->loadXML($xml); // Загружаем в объект domDocument XML-разметку
$root = $dom->documentElement; // Добираемся до корневого элемента root
$nodelist = $root->childNodes; // Получаем объект NodeList, содержащий список дочерних узлов у root
for ($i = 0; $i < $nodelist->length; $i++) {
    $child = $nodelist->item($i); // Получаем i-й узел
    echo $child->nodeName." - ".$child->nodeValue; // Выводим информацию об узле
    echo "<br />"; // Переходим на следующую строку в браузере
}


/**
 * el - Элемент 1
 * el - Элемент 2
 */