<?php

/**
 * переименовываем Агрегатную ф-ю COUNT в `cnt` для удобства
 *
 * SELECT COUNT (*) as `cnt`
 * FROM `goods`
 */


/**
 * DISTINCT уникальные записи
 *
 * SELECT DISTINCT `cat_name`
 * FROM `goods`
 */


/**
 * Запрос без использования кеша, можно видеть скорость выполнения запроса
 * в случаях огромный таблиц, когда кэш-таблиц не хватает для кеширования всех данных или новых.
 * SQL_NO_CACHE -применяется больше для отладки
 * SELECT SQL_NO_CACHE `name`, `cat`, `cat_name` as `category`
 * FROM `goods`
 */


/**
 * HAVING - что сделать с полученным результатом
 * хотим получить только те категории в которых >= 2 записи
 * SELECT `category`,`cat_name`, COUNT(*)
 * FROM `goods`
 * GROUP BY `category`
 * HAVING COUNT(*) >=2
 */

// INTO OUTFILE - результат записывается в файл. Права нужны.
// нужно разрешение для работы с файловой системой на сервере
// это тоже самое, что сделать экпорт таблицы
q("
    SELECT *
    INTO OUTFILE '/var/www/school-php.com/lalala.txt'
    FROM `goods`
");


// Подсчитаем сумму COUNT (*)
// подсчитает количество товаров по категориям и внизу выведит общую цифру всех COUNT
// В одном запросе один ответ, но это имеет редкое использование
q("
    SELECT *, COUNT(*)
    FROM `goods`
    GROUP BY `category` WITH ROLLUP
");


/**
 * Вставка нескольких записей
 */

q("
    INSERT INTO `table` SET 
    (`name`, `category`) VALUES /* поля в которые вставляем данные*/
    ('skirt',1), ('Notebook',2)
");


/**
 * INSERT ... ON DUPLICATE KEY UPDATE
 * Способ ниже на php идентичен
 * Если не существует дубликата по PRIMARY KEY
 *
 */
q("
    INSERT INTO `goods` SET 
    `id` = 33,
    `name` = 'XXX'
    ON DUPLICATE KEY UPDATE
    `name` = 'YYY'
");

/**
 * Если в таблице есть товары, их не нужно удалять
 * лучще сделать для них видимость
 * если не нужен в данный момент просто скрыть
 * например, нужно залить новые товары, но мы не знаем есть ли уже такие в базе
 * для начала скроем видимость всех товаров
 */

q("
    UPDATE `goods` SET
    `visiable` = 0 
");
// показываем те которые добавили или обновили
q("
    INSERT INTO `goods` SET 
    `id` = 33,
    `name` = 'XXX',
    `visiable` = 1 
    ON DUPLICATE KEY UPDATE
    `name` = 'YYY',
    `visiable` = 1 
");


/**
 * на php бывают случаи когда нам нужно,
 * обновить запись если такая запись существует
 * вставить, если запись не существует
 */

$res = q("
    SELECT *
    FROM `user`
    WHERE `id` = 33
");
// если запись существует, то делаем UPDATE записи
if($res->num_rows) {
    q("
        UPDATE `user` SET
        `name` = 'YYY'
        WHERE `id` = 33
    ");
} else {
    q("
        INSERT INTO `user` SET
        `name` = 'YYY'
        WHERE `id` = 33
    ");
}

/**
 * Проверяем если такой ip
 * если нет то создастся счетчик для пользователя `count` будет равен 1
 * PRIMARY KEY по ip
 * если есть, то счетчик count увеличится на 1
 */

q("
    INSERT INTO `statistic` SET 
    `ip` = ".$_SERVER['REMOTE_ADDR'].",
    `count` = 1
    ON DUPLICATE KEY UPDATE
    `count` = `count` + 1
");

/**
 * Отсортировать по id по порядку
 * лимит на выборку 2
 * удалить указанные записи
 */

q("
    DELETE FROM `goods`
    WHERE `id` IN (1,2,3,4,5,8)
    ORDER BY `id` ASC 
    LIMIT 2
");

/**
 * удаляем в цикле записи, пока они существует в базе
 */
do{
    q("
    DELETE FROM `goods`
    WHERE `date` < NOW() - INTERVAL 1 YEAR 
    LIMIT 500
");
} while(DB_()::affected_rows());

/**
 * UPDATE нескольких записей: PhpMyAdmin ругается на CASE, все норм, еще не исправили
 * https://github.com/phpmyadmin/issues/12100
 */

q("
    UPDATE `user` SET
    `name` = CASE
      WHEN `id` = 1 THEN 'Сапожки'
      WHEN `id` = 2 THEN 'Платья'
    END 
    WHERE `id` IN (1, 2)
");
