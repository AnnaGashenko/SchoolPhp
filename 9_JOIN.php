<?php

// JOIN UNIQUE `cat_name`
q("
    SELECT *
    FROM `goods`
    JOIN `goods-cat` ON `goods-cat`.`id` = `goods`.`category`
    GROUP BY `cat_name`
");

/**
 * GROUP_CONCAT
 */
q("
    SELECT *,GROUP_CONCAT(`name`)
    FROM `goods`
    GROUP BY `category`
");

// GROUP_CONCAT для двух таблиц и более:
q("
    SELECT *,GROUP_CONCAT(`goods`.`name` SEPARATOR '; ')
    FROM `goods-cat`
    JOIN `goods` ON `goods`.`category` = `goods-cat`.`id`
    GROUP BY `goods-cat`.`id`
");

q("
    SELECT `books`.*,GROUP_CONCAT(`books_author`.`author`) as `author`
    FROM `books`
    LEFT JOIN `books2author` ON `books2author`.`id_book` = `books`.`id`
    LEFT JOIN `books_author` ON `books_author`.`id` = `books2author`.`id_author`
    WHERE `books`.`id` = 1
    GROUP BY `books`.`id`
");

/**
 * Запрос с подзапросом. Дополнительный запрос пишется в скобках
 * Здесь нет связей как в JOIN это просто два запроса выводятся в одну таблицу
 */
q("
    SELECT *, (
      SELECT COUNT (*) FROM `books_author`
    ) AS `cnt`
    FROM `books`
");

/**
 * Выбрать книгу автор у которой под id=4
 */
q("
    SELECT *
    FROM `books`
    WHERE `id` = (
      SELECT `id_book`
      FROM `books2author`
      WHERE `id_author` = 4
      LIMIT 1
    ) 
");


// SELECT LAST_DAY(NOW()) - последний день текущего месяца
// SELECT LAST_DAY(NOW() - INTERVAL 1 MONTH) - последний день прошлого месяца
// SELECT CONCAT(LAST_DAY(NOW() - INTERVAL 1 MONTH),' 23:59:59') - последний день прошлого месяца и последняя секунда
// SELECT LAST_DAY( NOW() ) + INTERVAL 1 DAY - INTERVAL 2 MONTH,' 00:00:00' - первый день прошлого месяца и последняя секунда
/**
 * статистика ровно за месяц, от первого числа до последнего
 */
q("
    BETWEEN
    CONCAT(LAST_DAY( NOW() ) + INTERVAL 1 DAY - INTERVAL 2 MONTH,' 00:00:00')
    AND
    CONCAT (LAST_DAY(NOW() - INTERVAL 1 MONTH),' 23:59:59')
");