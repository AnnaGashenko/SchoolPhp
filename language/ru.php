<?php
class Language {
	static $text = array(
		'no-access' => 'У вас нет доступа к сайту',
        'tomain' => 'На главную',

	);
}

// вывод переменной
echo Language::$text['tomain'];