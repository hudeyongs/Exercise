<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/7
 * Time: 10:57
 */
function p($var) {
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

/**
 * 实例化访问控制器
 */
function controller($classname){
	$new_class = $classname . 'Ctrl';
	$module = new $new_class;
	return $module;
}
