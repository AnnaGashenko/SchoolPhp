<?php
$dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
/* Текст XML-документа */
$xml = "<?xml version='1.0' encoding='utf-8'?>
  <root>
    <el>Элемент 1</el>
    <el>Элемент 2</el>
  </root>";
$dom->loadXML($xml); // Загружаем в объект domDocument XML-разметку
echo htmlspecialchars($dom->saveXML()); // Выгрузка в окно браузера XML-документа
echo "<br />"; // Переход на новую строку
$dom->save("doc.xml"); // Сохраняем XML-документ в файл
$dom->load("doc.xml"); // Выгружаем из файла XML-документ
echo htmlspecialchars($dom->saveXML()); // Выгрузка в окно браузере XML-документа (уже из файла)