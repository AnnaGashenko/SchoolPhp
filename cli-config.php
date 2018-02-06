<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner; // working with console
require_once './bootstrap.php'; // include bootstrap.php
return ConsoleRunner::createHelperSet($entityManager); //