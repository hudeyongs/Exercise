<?php
namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;

class UserController extends Controller
{


	public function index()
	{
		// debug
		trace(['1', '2']);
		$list = UserModel::all();
		$this->assign('list', $list);
		$this->assign('count', count($list));
		// 关闭布局
		$this->view->engine->layout(false);
		$content = <<<EOT
		<style>            
body{
	color: #333;
	font: 16px Verdana, "Helvetica Neue", helvetica, Arial, 'Microsoft YaHei', sans-serif;
	margin: 0px;
	padding: 20px;
}

a{
	color: #868686;
	cursor: pointer;
}
a:hover{
	text-decoration: underline;
}
h2{
	color: #4288ce;
	font-weight: 400;
	padding: 6px 0;
	margin: 6px 0 0;
	font-size: 28px;
	border-bottom: 1px solid #eee;
}
div{
margin:8px;
}
.info{
	padding: 12px 0;
	border-bottom: 1px solid #eee;
}

.copyright{
	margin-top: 24px;
	padding: 12px 0;
  border-top: 1px solid #eee;
}
</style>
<h2>用户列表（{\$count}）</h2>
<div>
{volist name="list" id="user"  }
ID：{\$user.id}<br/>
昵称：{\$user.nickname}<br/>
------------------------<br/>
{/volist}
</div>
<div class="copyright">
	<a title="官方网站" href="http://www.thinkphp.cn">ThinkPHP</a> 
	<span>V5</span> 
	<span>{ 十年磨一剑-为API开发设计的高性能框架 }</span>
</div>

EOT;
		return $this->display($content);

	}
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
	public function read($id = '')
	{
		$user = UserModel::get($id);
		return view('', ['user' => $user], ['__PUBLIC__' => '/static']);
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