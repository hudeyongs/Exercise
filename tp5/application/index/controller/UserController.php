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
		// 查询所有写过书的作者
		$user = UserModel::has('books')->select();
		// 查询写过三本书以上的作者
		$user = UserModel::has('books', '>=', 3)->select();
		// 查询写过 ThinkPHP5快速入门的作者
		$user = UserModel::hasWhere('books', ['title' => 'ThinkPHP5快速入门'])->select();
	}


	public function update($id)
	{
		$user = UserModel::get($id);
		$book = $user->books()->getByTitle('ThinkPHP5开发手册');
		$book->title = 'ThinkPHP5快速入门';
		$book->save();
	}


	public function delete($id)
	{
		$user = UserModel::get($id);
		if($user->delete())
		{
			// 删除关联数据
			$user->profile->delete();
			return '用户[ ' . $user->name . ' ]删除成功';
		} else {
			return $user->getError();
		}
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