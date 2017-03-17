<?php

/**
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