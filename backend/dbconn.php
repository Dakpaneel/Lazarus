<?php
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', 'admin');
define('MYSQL_HOST', 'localhost');
define('MYSQL_DATABASE', 'lazarus');
$dbconn = new PDO(
    "mysql:host=" . MYSQL_HOST .
    ";dbname=" . MYSQL_DATABASE,
    MYSQL_USER,
    MYSQL_PASSWORD
);

?>