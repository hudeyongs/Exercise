<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/14
 * Time: 10:54
 */
namespace app\index\validate;

use think\Validate;

class User extends Validate{
	protected $rule = [
		'nickname' => ['require', 'min'=>5, 'token'],
		'email'    => ['require', 'email'],
		'birthday' => ['dateFormat' => 'Y/m/d'],
	];
}
