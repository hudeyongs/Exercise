<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/7
 * Time: 10:29
 *
 * 入口文件
 * 1. 定义常亮
 * 2. 加载函数库
 * 3. 启动框架
 */
defined('ROOT_PATH') or define('ROOT_PATH', realpath('.' . DIRECTORY_SEPARATOR));
defined('CORE') or define('CORE', ROOT_PATH . DIRECTORY_SEPARATOR . 'core');
defined('APP') or define('APP', ROOT_PATH . DIRECTORY_SEPARATOR . 'app');
defined('MODULE') or define('MODULE', 'app');
defined('DEBUG') or define('DEBUG', true);

if(DEBUG)
{
	ini_set('display_errors', 'On');
} else {
	ini_set('display_errors', 'Off');
}
require_once CORE . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR .'function.php';
require_once CORE . DIRECTORY_SEPARATOR . 'core.php';

\core\core::run();