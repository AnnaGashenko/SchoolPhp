<?php
/**
 * Шаблон проектирования "Стратегия"(Pattern Strategy)
 * Итак, у нас есть 2 класса: ZipFile и TarGzFile.
 * Первый возвращает нам ссылку на скачивание файла в .zip формате,
 * а второй в .tar.gz формате. В классе FileStrategy, в конструкторе,
 * мы проверяем заголовок USER_AGENT и, если там присутствуют буквы Win,
 * то создаём объект класса ZipFile, иначе же создаём объект класса TarGzFile.
 * Потом мы создаём объект FileStrategy и вызываем метод getLink,
 * который вернёт нам наш файл в нужном формате.
 * Т.е. суть его в том, что мы не знаем, какой объект у нас будет,
 * за нас это проверяет наш класс и возвращает нужный.
 */

abstract class FileNamingStrategy {
    abstract function createLinkName($fileName);
}
class ZipFile extends FileNamingStrategy {
    function createLinkName($fileName) {
        return "http://localhost/download/$fileName.zip";
    }
}
class TarGzFile extends FileNamingStrategy {
    function createLinkName($fileName) {
        return "http://localhost/download/$fileName.tar.gz";
    }
}
class FileStrategy {
    protected $_type;
    function __construct() {
        if(strstr($_SERVER["HTTP_USER_AGENT"], "Win"))
            $this->_type = new ZipFile();
        else
            $this->_type = new TarGzFile();
    }
    public function getLink($name) {
        return $this->_type->createLinkName($name);
    }
}
$obj = new FileStrategy();
$link1 = $obj->getLink("file_one");
$link2 = $obj->getLink("file_two");

?>
  <h1>Список файлов для скачивания:</h1>
  <p>
  <a href="$link1">Первый файл</a>
  <a href="$link2">Второй файл</a>
  </p>


<?php

/**
 * Class User
 * Представьте, что вы разрабатываете класс, который может создать или обновить запись в базе данных.
 * В обоих случаях входные параметры будут одни и те же (имя, адрес, номер телефона и т. п.),
 * но, в зависимости от ситуации, он будет должен использовать различные функции для обновления
 * и создания записи. Можно каждый раз переписывать условие if/else,
 * а можно создать один метод, который будет принимать контекст:
 */
class User {

    public function CreateOrUpdate($name, $address, $mobile, $userid = null)
    {
        if( is_null($userid) ) {
        // пользователя не существует, создаем запись
        } else {
        // запись есть, обновляем ее
        }
    }
}

/**
 * Обычно шаблон «Стратегия» подразумевает инкапсуляцию алгоритмов в классы,
 * но в данном случае это излишне. Помните, что вы не обязаны следовать шаблону слово в слово.
 * Любые варианты допустимы, если они решают задачу и соответствуют концепции.
 */


/**
 * Например у нас есть приложение Вконтакте со своим API
 * 1. Запрос в нашему API - получить ответ в HTML формате
 * 2. Получить ответ в json формате // для AJAX
 * 2. Получить ответ в xml формате // для APPLE
 * Здесь к нам на помощь приходит патерн СТРАТЕГИЯ
 * который сам решает, что нам отдавать
 * мы ему даем только задвние
 */

class apiStrategy
{
    static function write($data) {
        if(!isset($_GET['type']) || $_GET['type'] == 'text') {
            echo generateTable($data); // Создать HTML-таблицу
        } elseif($_GET['type'] == 'json') {
            echo json_encode($data);
            exit;
        } elseif($_GET['type'] == 'xml') {
            // код вывода XML структуры
        }
    }
}

apiStrategy::write($country);

// например если передать $_GET параметром api=1, то получим формат XML
if ($_GET['api'] == 1) {
    echo 'XML FORMAT';
}

/**
 * передаем только название файла
 * а наш паттерн Strategy уже сам определяет нужный Url
 */

echo printUrlStrategy('/file.txt');
https: // https://site.ru/file.txt
http: // http://site.ru/file.txt
