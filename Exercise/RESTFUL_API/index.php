<?php
header("Content-Type:text/html;charset=utf-8");
require __DIR__ . '/lib/User.php';
require __DIR__ . '/lib/Article.php';
require __DIR__ . '/lib/ErrorCode.php';

$pdo = require __DIR__ . '/lib/db.php';

$article = new Article($pdo);

try {
    $article->edit(3, '标题2', '内容2', 2);
}catch (PDOException $e)
{
    echo $e->getMessage();
}catch (Exception $e)
{
    echo $e->getMessage();
}