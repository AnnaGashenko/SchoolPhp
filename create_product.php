<?php
// create_product.php
require_once "bootstrap.php";
include 'src/Aaaa.php';
include 'src/Product.php';


//А теперь сложнее запрос, выбираем записи, где name='Меч в камне' с пагинатором:
use Doctrine\ORM\Tools\Pagination\Paginator; // подключаем готовый класс
$query = $entityManager->getRepository('Book')->createQueryBuilder('b')
    ->getQuery()
    ->setFirstResult(0) // выводим с позиции 0
    ->setMaxResults(2); // 2 записи

$paginator = new Paginator($query, $fetchJoinCollection = true);

$c = count($paginator); //сколько записей в таблице
var_dump($c);
foreach ($paginator as $post) {
    echo $post->name . "\n";
}


// Убрать связи и отредактировать Автора:
//$book = $entityManager->find('Book',8); // выбираем книгу с id=8
//$author = $entityManager->find('Author',11); // выбираем автора с id=11
//$book->authorRead->removeElement($author); // удаляем из связей автора с id=11
//$author->name = 'Новое имя'; // Изменяем имя у автора с id=10
//$entityManager->flush(); // сохраняем

// Удаляем книгу и авторов этой книги полностью!
//$book = $entityManager->find('Book',4); // берем книгу с id=4
//// прогоняем в цикле эту книгу
//foreach ($book->authorRead as $author) {
//    $entityManager->remove($author); // каждый элемент удаляем
//}
//$entityManager->remove($book); // удаляем книгу
//$entityManager->flush();

// Добавить Книгу и авторов для связи многие ко многим:
//$book = new Book(); // создаем объест кнриги
//$book->name = 'Карлсон, который живёт на крыше'; // создаем имя книги
//$author = new Author(); // создаем авторов
//// $author = $entityManager->find('Author',1); // для существующего выборка
//$author->name = 'Писатель1';
//// чтобы это добавление работало нужно
//$book->authorRead->add($author); // authorRead поле, которое связывает автора с книгой
//
//$author2 = new Author();
//$author2->name = 'Писатель2';
//$book->authorRead->add($author2);
//
//$entityManager->persist($book); // записываем как объект
//$entityManager->flush(); // сохраняем

/**
 * проверка на существование записи
 * !isset - не существует
 * TRUE - отсутствует запись
 */
//$availableNickname = 0 === $entityManager->getRepository('Author')->count(['id' => 111]);
//var_dump($availableNickname);

/**
 * вместо 3 запросов или JOIN пишем всего одну строку
 * в этом преимущество doctrine
 */
//$book = $entityManager->find('Book',1);
//echo $book->date->format('Y-m-d H:i:s')."\r\n";
//foreach ($book->authorRead as $authors) {
//    echo $authors->name."\r\n";
//}


//$book = $entityManager->getRepository('Book')->findBy(['name'=>'Меч в камне']);
// альтернатива воспользоваться магическим методом findByName
//$book = $entityManager->getRepository('Book')->findByName('Меч в камне');
//echo $book[0]->date->format('Y-m-d H:i:s')."\r\n";
//foreach ($book[0]->authorRead as $authors) {
//    echo $authors->name."\r\n";
//}



/*
$product = new Product(); // создаем экземпляр класса
$product->setName('test'); // через метод (сеттер) записываем имя
$product->love = 'haha';

$entityManager->persist($product); // записываем как объект
$entityManager->flush(); // сохраняем
*/
// получить id записи которую добавили
//echo "Created Product with ID " . $product->getId() . "\n"; // mysqli_insert_id

// достаем данный продукт,  где find(название таблицы, id)
//$product = $entityManager->find('Product',1);
//echo $product->id.','.$product->getName().','.$product->love;

// это как у нас было q()->fetch_assoc(); - 2 запроса подряд
// в объектном представдении это q()->fetch_object();

/**
 * получаем список в массив из найдешшых строк WHERE love = love2
 */
//$product = $entityManager->getRepository('Product')->findBy(['love' => 'love2']);
//foreach ($product as $products) {
//    echo $products->id.','.$products->getName().','.$products->love;
//}