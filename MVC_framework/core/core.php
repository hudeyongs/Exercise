<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/7
 * Time: 11:09
 */
namespace core;

class core {
	private static $_map = array();
	static public function run() {
		spl_autoload_register('\core\core::autoload');
		require ROOT_PATH . '/core/lib/route.php';
		$route = new \core\lib\route();
		$ctrlClass = $route->ctrl;
		$action = $route->action;
		$ctrlfile = APP . '/ctrl/' . $ctrlClass . 'Ctrl.php';
		if(is_file($ctrlfile))
		{
			$new_class = $ctrlClass . 'Ctrl';
			$class_path = ROOT_PATH . '/app/ctrl/' . $ctrlClass . 'Ctrl.php';
			include $class_path;
			$m = new \app\ctrl\indexCtrl();
			$m->$action();
		} else {
			throw new \Exception('找不到控制器' . $ctrlClass);
		}
	}

	static public function autoload($class){
		// 检查是否存在映射
		if(isset(self::$_map[$class])) {
			include self::$_map[ $class ];
		} else {
			// 自动加载类库
			$class_path = ROOT_PATH . '/app/ctrl/' . $class . '.php';
			$class_path = str_replace( '\\', '/', $class_path );
			if ( isset( self::$_map[$class] ) ) {
				return true;
			} else {
				if ( is_file( $class_path ) ) {
					self::$_map[ $class ] = $class;
					include $class_path;
					$m = new ctrl\indexCtrl();
					$m->index();exit;
					return true;
				} else {
					return false;
				}
			}
		}
	}
}