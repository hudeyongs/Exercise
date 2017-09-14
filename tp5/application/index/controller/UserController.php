<?php
namespace app\index\controller;

use app\index\model\Profile;
use app\index\model\User as UserModel;

class UserController
{
// 关联新增数据
	public function add()
	{
		$user           = new UserModel;
		$user->name     = 'thinkphp';
		$user->password = '123456';
		$user->nickname = '流年';
		if ($user->save()) {
			// 写入关联数据
			$profile           = new Profile;
			$profile->truename = '刘晨';
			$profile->birthday = '1977-03-05';
			$profile->address  = '中国上海';
			$profile->email    = 'thinkphp@qq.com';
			$user->profile()->save($profile);
			return '用户新增成功';
		} else {
			return $user->getError();
		}
	}

	/**
	 * 确认  profile 中有数据，且是和 user 表中的数据关联对应的，否则警惕导致的 "Trying to get property of non-object" 错误
	 * @param $id
	 */
	public function read($id)
	{
		$user = UserModel::get($id, 'profile');
		echo $user->name . '<br />';
		echo $user->nickname . '<br />';
		echo $user->profile->truename . '<br />';
		echo $user->profile->email .'<br />';
	}
}