<?php
abstract class Car {
    public $x;
    public $y;
    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
    abstract public function move ($x, $y);
    abstract public function sound();
}

class Auto extends Car {
    public function move($x, $y) {
        $this->sound();
        echo "Движение легкового автомобиля из координат ($this->x, $this->y) в координаты ($x, $y)<br />";
        $this->x = $x;
        $this->y = $y;
    }
    public function sound() {
        echo "Звук движения легкового автомобиля<br />";
    }
}

$auto = new Auto(10, 20);
echo 'Координата по х : '.$auto->x;
echo "<br />";
echo 'Координата по y : '.$auto->y;
echo "<br />";
$auto->move(5, 15);


$phrases = [':)', ';)', ':-)'];
$emojis = ["\u{1F600}", "\u{1F609}", "\u{1F606}"];
echo str_replace($phrases, $emojis, 'Всем привет! :) Как дела? ;) Давайте жить дружно! :-)');


echo "<br>" .bin2hex(random_bytes(10));