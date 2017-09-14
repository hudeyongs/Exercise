<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/7
 * Time: 11:14
 */
namespace core\lib;

class route {
	public $ctrl;
	public $action;

	public function __construct() {
		/**
		 * 1. 隐藏index.php
		 * 2. 获取 URL 参数部分
		 * 3. 返回对应控制和方法
		 */
		$path = $_SERVER['REQUEST_URI'];
		if(isset($path) && $path != '/')
		{
			$patharr = explode('/', trim($path, '/'));
			if(isset($patharr[0]))
			{
				$this->ctrl = array_shift($patharr);
			}
			if(isset($patharr[1]))
			{
				$this->action = array_shift($patharr);
			} else {
				$this->action = 'index';
			}
		} else {
			$this->ctrl = 'index';
			$this->action = 'index';
		}
//		$module = controller($this->ctrl);
//		$method = new \ReflectionMethod($module, $this->action);
//		$method->invokeArgs($patharr);
	}
}