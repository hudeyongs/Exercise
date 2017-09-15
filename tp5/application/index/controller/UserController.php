<?php
namespace app\index\controller;

use app\index\model\Profile;
use app\index\model\User as UserModel;
use app\index\model\Role;

class UserController
{
// 关联新增数据
	public function add()
	{
		$user = UserModel::getByNickname('张三');
		$role = Role::getByName('leader');
		$user->roles()->attach($role);
		return '用户角色添加成功';
	}

	/**
	 * 确认  profile 中有数据，且是和 user 表中的数据关联对应的，否则警惕导致的 "Trying to get property of non-object" 错误
	 * @param $id
	 */
	public function read()
	{
		$user = UserModel::get(2, 'roles');
		dump($user->roles);
	}



	public function update($id)
	{
		$user = UserModel::get($id);
		$book = $user->books()->getByTitle('ThinkPHP5开发手册');
		$book->title = 'ThinkPHP5快速入门';
		$book->save();
	}


	public function delete()
	{
		$user = UserMOdel::getByNickname('张三');
		$role = Role::getByName('leader');
		$user->roles()->detach($role, true);
		return '用户角色删除成功';
	}

	public function addBook()
	{
		$user = UserModel::get(1);
		$books = [
			['title' => 'ThinkPHP5快速入门', 'publish_time' => '2016-05-06'],
			['title' => 'ThinkPHP5快速入门', 'publish_time' => '2016-01-01'],
		];
		$user->books()->saveAll($books);
		return '添加Book成功';
	}




}