<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/7
 * Time: 14:53
 */
class HelloWorld {
	public function sayHelloTo($name)
	{
		return 'Hello ' . $name;
	}
}

$reflectionMethod = new ReflectionMethod('HelloWorld', 'sayHelloTo');
echo $reflectionMethod->invokeArgs(new HelloWorld(), array('Mike'));