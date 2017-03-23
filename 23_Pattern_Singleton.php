<?php
/**
 * Pattern Singleton
 * Singleton не даст создавать множество экземпляров классов, будет всегда поддерживать один единственный экземпляр
 * 4 соединения с БД это нагрузка на MySQL вырастает в 4 раза
 * Одиночка — порождающий шаблон, который позволяет убедиться,
 * что в процессе выполнения программы создается
 * только один экземпляр класса с глобальным доступом.
 *
 * В ОСНОВНОМ ИСПОЛЬЗУЕТСЯ ДЛЯ СОЕДИНЕНИЯ С БД
 *  +++ Плюсы +++
 * Контролируемый доступ к единственному экземпляру
 * повторные запросы обращаются к одному земпляру
 *
 *  --- Минусы ---
 * Чтобы получить доступ к этому экземпляру он должен быть глобальным
 * Патерны программирования. Анти патерн. Singleton = Антипатерн
 */

/**
 * Чтобы избежать Singleton Yii1 пишет запросы так:
 * Yii реализовал статичный класс (у него глобальная область видимости)
 * реализовал ссылку на БД и записал эту ссылку в свойство
 * $post = Yii::$app->db->createCommand('SELECT * FROM post WHERE id=:id AND status=:status')
 *          ->bindValues($params)
 *          ->queryOne();
 */

/**
 * LARAVEL напоминает систему данного FW: $results = DB::select('select * from users where id = :id', ['id' => 1]);
 */

 /**
 * Joomla (Механизм Singleton):
 * $db = JFactory::getDBo();
 * $query = $db->getQuery(true);
 * $query->select('COUNT(*)');
 */

 /**
  * WordPress:
  * global $wpdb;
  * $wpdb->$query($sql);
  */

/**
 * Drupal:
 * db_query($query);
 */


/**
 * Использование трайтов для Singleton
 */
trait Singleton
{
    static public function getInstance()
    {
        static $instance = null;
        if ($instance === null) {
            $instance = new static();
        }
        return $instance;
    }

    // отменяем клонирование
    public function __clone()
    {
        trigger_error('Cloning '.__CLASS__.' id not allowed.',E_USER_ERROR);
    }

    /**
     * используется для восстановления любых соединений с базой данных,
     * которые могли быть потеряны во время операции сериализации и выполнения
     * других операций повторной инициализации.
     */
    public function __wakeup()
    {
        trigger_error('Unserializing '.__CLASS__.' id not allowed.',E_USER_ERROR);
    }


}

/**
 * Class TrySingleton
 * при первом вызове getInstance()
 * если $instance = false;
 * создастся экземпляр класса
 *
 * При повторнорном вызове, уже экземпляр класса создаваться не будет,
 * а будут возвращаться return self::$instance;
 */

class TrySingleton
{
    // любой класс можно сделать Singleton добавив в него trait Singleton
    use Singleton;
    public $var = 1;

    public function test()
    {
        ++$this->var;
        echo $this->var;
    }
}

$x = TrySingleton::getInstance(); // Получаем экземпляр класса в единичной экземпляре
$x->test(); // выведит 2
// если вызвать еще раз
$x->test(); // выведит 3

/**
 * если где то в другом классе вызвать метод, то он не будет создан заново
 * а будет дальше прибавлять +1
 */

$y = TrySingleton::getInstance();
$y->test(); // выведит 4


