<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
    	$sql = "update ";
    	$result = Db::execute($sql);
    	dump($result);
    }

    public function hello($name = 'thinkphp')
    {
    	$this->assign('name', $name);
    	return $this->fetch();
    }
}
