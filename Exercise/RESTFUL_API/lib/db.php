<?php
//$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
//$pdo_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "set names utf8";
//$pdo_options[PDO::ATTR_EMULATE_PREPARES] = false;
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"
];
$pdo = new PDO('mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=mydb', 'root', 'nimae', $opt);
//$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
return $pdo;
