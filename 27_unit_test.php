<?php

function calc($num1, $num2, $action = '+') {
    switch ($action) {
        case '+':
            return $num1 + $num2;
            break;
        case '-':
            return $num1 - $num2;
            break;
        case '*':
            return $num1 * $num2;
            break;
        case '/':
            if($num2 == 0) {
                return 'На 0 делить нельзя';
            } else {
                return $num1 / $num2;
            }
            break;
        default:
            throw new \Exception('UPS');
            break;
    }
}

// проводим простое тестирование
//if (calc(1,1, '+') == 2) {
//    echo 'OK';
//} else {
//    echo 'FALSE';
//}
//
//// проверяем что выдает Exception
//try {
//    calc(1,1, 'blabla');
//} catch (Exception $exception) {
//    if($exception->getMessage() !== 'UPS') {
//        echo 'FALSE';
//    }
//}

/**
 * Разработка через тестирование
 * TDD - test driven development
 * суть в том, что сначала пишеться тест, а потом класс(функция)
 * например я заранее знаю, что в случае 1+1 результат будет 2
 */

/**
 * Я разрабатываю поведение калькулятора
 * 1. сложение
 * 2. вычитание
 * 3. умножение
 * 4. деление
 * 5. проверка на 0
 * 6. ошибка
 * Такое поведение я должна прописать и на тесте
 */


/**
 * Напишем тестовый класс который проверяет совпадает ли содержание
 * первое значение должно совпасть со вторым
 */
class Tests {
    static $error_eval = '';
    static $error_mess = '';
    static function checkValues($var1,$var2) {
        if ($var1 !== $var2) {
            echo htmlspecialchars($var1).' !== '.htmlspecialchars($var2).'<hr>';
            echo '<pre>'.print_r(debug_backtrace(),1);
            exit;
        }
        return true;
    }

    static function checkException($eval, $mess) {
        try { // если исключение не произошло
            eval($eval);
            echo 'Error: No Exception';
            exit;
        } catch (Exception $e) { // если искобчение не то, что мы ожидаем
            if($mess !== $e->getMessage()) {
                echo 'Wrong Exeption: '.$mess.', must be: '.$e->getMessage();
                exit;
            }
            return;
        }
    }

    static function checkError($eval, $mess) {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) {
            if(Tests::$error_mess !== $errstr) {
                echo $errno.'<br><s>'.$errstr.'</s><br>'.$errfile.'<br>'.$errline;
                echo htmlspecialchars(Tests::$error_eval).' - '.htmlspecialchars(Tests::$error_mess).'<hr>';
                echo '<pre>'.print_r(debug_backtrace(), 1);
                exit;
            }
        });
        self::$error_eval = $eval;
        self::$error_mess = $mess;
        eval($eval);
        restore_error_handler();
    }
}

// На примере того же калькулятора
Tests::checkValues(calc(1,0,'+'), 1);
Tests::checkValues(calc(1,0,'/'), 'На 0 делить нельзя');
Tests::checkValues(calc(6,2,'/'), 3);
Tests::checkValues(calc(2,3), 5);

// проверяем выбрасывает ли наш код исключение 'UPS'
Tests::checkException('calc(1,2, "zaza");', 'UPS');
Tests::checkException('calc(1,2, "zaza");', 'UPS');


// Проверяем какую ошибку выдает php при неверно переданном значении
// можем перехватывать ошибки самого php интерпритатора
// В данном случае такой переменной не существует
Tests::checkError('echo $a;', 'Undefined variable: a');

// если все хорошо
echo 'All OK! WELL DONE!';
exit;

