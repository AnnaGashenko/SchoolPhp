<?php
/**
 * ORM и Docrtine 2 в PHPStorm
 * ORM - представление работы с БД в виде объектов
 * ORM - представление всей БД в виде объекта
 *
 */
echo $row['id'];
echo $row->id; // в объектном стиле

/** to get data from MySQL in object
 * instead --
 * mysqli_result::fetch_assoc -- mysqli_fetch_assoc — Извлекает результирующий ряд в виде ассоциативного массива
 * use --
 * mysqli_result::fetch_object -- mysqli_fetch_object — Возвращает текущую строку результирующего набора в виде объекта
 */

1. Устанавливаем плагин Markdown support
2. Устанавливаем плагин PHP Annotation
2. Устанавливаем Doctrine