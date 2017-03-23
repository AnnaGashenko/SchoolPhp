<?php

/**
 * Factory Method (Фабричный метод), называют также как Виртуальный констрктор
 * Шаблон проектирования "Фабрика"(Pattern Factory).
 * У нас есть какой-то абстрактный класс,
 * от которого наследуются другие классы: HTMLRenderer и XMLRenderer,
 * а также есть функция RendererFactory,
 * которая проверяет заголовок HTTP_ACCEPT и возвращает(!) нужный объект.
 * Этот шаблон очень похож на стратегию, но разница в том,
 * что в этом шаблоне мы возвращаем нужный нам объект.
 * Наш класс вернёт нам объект в зависимости от того, какой заголовок.
 * Если HTML, то HTMLRenderer, а если XML, то XMLRenderer.
 * Можно так же создать, например, класс PDFRenderer,
 * объект которого будет создан "на лету", если заголовок будет соответствующий.
 */

abstract class Renderer {
    private $_document;
    abstract function render();
    function setDocument($document) {
        $this->_document = $document;
    }
}
class HTMLRenderer extends Renderer {
    function render() {
        // Выводим HTML
    }
}
class XMLRenderer extends Renderer {
    function render() {
        // Выводим XML
    }
}
// Создаём соответствующий тип класса Renderer
function RendererFactory() {
    $accept = strtolower($_SERVER["HTTP_ACCEPT"]);
    if(strpos($accept, "text/xml")>0) {
        return new XMLRenderer();
    }else{
        return new HTMLRenderer();
    }
}
$renderer = RendererFactory();
$renderer->setDocument("Some content...");
$renderer->render();

/**
 * В зависимости от того что передали в CacheVar, получаем нужный ответ
 * Фабрика- это посредник между A и B
 * Мы запрашиваем то, что мы хотим, а нам возвращается нужный нам класс
 * Хотим кешировать в файл передаем формат файл
 * Хотис в MySQL передаем формат MySQL

$var =  1;
$cache = new CacheVar('File'); // записали кеш в файл
$cache->set($var,'key');
$cache->get('key');

function ($method) {
    if($method == 'File') {
        return new CacheVarFile;
    } elseif ($method == 'MySQL') {
        return new CacheVarMySQL;
    } else {
        throw new \Exception('Не верный формат');
    }
}

*/

namespace MyCache;

class CacheFactory
{
    static function Initial($class) {
        $classname = '\\Cache\\Cache'.$class;
        return new $classname;
    }
}


/**
 * Прямое использование интерфейса
 */
 interface CacheInterface
{
    public function getItem($key);
    public function setItem($key,$value);

}

class CacheFile implements CacheInterface
{
    public function getItem($key) {
        // TODO: Implement getItem() method.
    }
    public function setItem($key,$value) {
        // TODO: Implement setItem() method.
    }
}

\MyCache\CacheFactory::Initial('File');