<?php
/**
 * Created by PhpStorm.
 * UserController: deyong@hackoops.com
 * Date: 2017/9/13
 * Time: 17:09
 */

namespace app\index\controller;

use app\index\model\Profile;
use app\index\model\User;

class UserController {

	public function index()
	{
		$list = User::scope('email', 'thinkphp@qq.com')->select();
		foreach($list as $user)
		{
			echo $user->nickname . '<br />';
			echo $user->email . '<br />';
			echo $user->birthday . '<br />';
			echo '---------------<br />';
		}
	}

	public function add ()
	{
		$user = new User;
		$user->name = 'thinkphp';
		$user->password = '123456';
		$user->nickname = '流年';
		if($user->save())
		{
			$profile = new Profile;
			$profile->truename = '刘晨';
			$profile->birthday = '1977-03-05';
			$profile->address = '中国上海';
			$profile->email = 'thinkphp@qq.com';
			$user->profile()->save($profile);
			return '用户[ ' . $user->name . ' ]新增成功';
		} else {
			return $user->getError();
		}
	}


	public function addList()
	{
		$user = new User;
		$list = [
			['nickname' => '张三', 'email' => 'zhangsan@qq.com', 'birthday' => strtotime('1998-01-15')],
			['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-09-19')],
		];
		if ($user->saveAll($list))
		{
			return '用户批量新增成功!';
		} else {
			return $user->getError();
		}
	}

	public function read($id)
	{
		$user = User::get($id);
		echo $user->name . '<br/>';
		echo $user->nickname . '<br/>';
		echo $user->profile->truename . '<br/>';
		echo $user->profile->email . '<br/>';
	}

	public function create()
	{
		return view();
	}

	public function update($id)
	{
		$user['id'] = (int)$id;
		$user['nickname'] = '刘晨';
		$user['email'] = 'liu21st@gmail.com';
		User::update($user);
		return '更新用户成功';
	}

	public function delete ($id)
	{
		$user = User::destroy($id);
		if ($user)
		{
			return '删除用户成功';
		} else {
			return '删除的用户不存在';
		}
	}

	public function profile()
	{
		return $this->hasOne('app\index\Profile');
	}
}





























