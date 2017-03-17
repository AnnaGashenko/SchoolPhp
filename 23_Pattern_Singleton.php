<?php
/**
 * Pattern Singleton
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
 * Class TrySinglton
 * при первом вызове
 */

class TrySingleton
{
    static $instance = false;
    static public function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new __CLASS__;
        }
        return self::$instance;
    }

    public $var = 1;
    public function test()
    {
        ++$this->var;
        echo $this->var;
    }

}