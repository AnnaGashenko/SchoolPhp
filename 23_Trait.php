<?php
/**
 * TRAIT (Трейты) - примеси
 * Создание небольшого кусочка кода который вставляется в другой код
 * Это неполноценные классы, которые сами по себе не могут существовать
 * От них нельзя создать экземпляр класса
 * Они предназначены только для того, чтобы их наследовал другой класс
 * При обычном наследовании, мы наследуем только один Class
 * class MyClass extends Class2 {}
 * TRAIT (Трейты) - это множественное наследование других Трейтов
 * Другими словами  TRAIT (Трейты) - это копирование участка кода
 *
 *
 * С версии 5.4 в PHP появился такой интересный механизм как примеси (trait),
 * который по задумке разработчиков должен помочь разруливать ситуации
 * когда уж очень хочется применить множественное наследование, но нельзя.
 * Вот о некоторых подобных ситуациях я и расскажу далее.
 */

trait MyTrait
{
    public $var = 1;
    public function test() {
        echo 'My Trait';
    }

}

class MyClass
{
    use MyTrait{
        test as aliac; // даем методу test новое имя (алиас, например если в нашем классе есть тоже метод test() )
    }
}

$x = new MyClass;
// $x->test();

// вызываем метод по алиасу
// $x->aliac();

class Symbol {
    function doSomething() {
        echo '<br>Это класс Symbol функция doSomething()';
    }
}

trait More{
    function doMore() {
        echo '<br>trait More';
    }
}

trait More2{
    function doMore2() {
        echo '<br>trait More2';
    }
}

class A extends Symbol{
    use More, More2;
}

class B extends Symbol{
    use More;
}

$a1 = new A;
$a1->doMore();
$a1->doMore2();
$a1->doSomething();

$b1 = new B;
$b1->doMore();
$b1->doSomething();


