<?php
// CacheFile распологается внутри папки Cache
// если этот класс находиться внутри папки, то пишем сокращенно
namespace Cache;
/** иначе пишем полный путь к файлу
\PHPMailer\PHPMailer\PHPMailer;
*/
class CacheFile implements CacheInterface
{
    private $id = '';

    public $text = '';

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * filemtime — Возвращает время последнего изменения файла
     * time() - filetime('./cache/file/'.$this->id) < 60
     * время сейчас - время последнего изменения файла (не больше) 60
     */
    public function get()
    {
        if (file_exists('./cache/file/'.$this->id) && time() - filetime('./cache/file/'.$this->id) < 60) {
            echo "FROM CACHE<br>";
            $this->text = file_get_contents('./cache/file/'.$this->id);
            return true;
        } else {
            echo "CREATE NEW CACHE<br>";
            return false;
        }
    }

    public function set($value)
    {
        file_put_contents('./cache/file/'.$this->id, $value);
    }

    public function write($text) {
        throw new \Exception('Ошибка'); // глобальная область видимости
        new Lala; // \Cache\Lala; - этот класс будет искаться только внутри папки Cache
        echo $text;
        str_replace(); // будет искаться и внутри пространства имен и за ее пределами
    }

}







































