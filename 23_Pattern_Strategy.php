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