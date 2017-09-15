<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/14
 * Time: 17:50
 */

namespace app\index\model;
use think\Model;


class Book extends Model{
	protected $type = [
		'publist_time' => 'timestamp:Y-d-d',
	];

	// 开启自动写入时间戳
	protected $autoWriteTimestamp = true;

	// 定义自动完成的属性
	protected $insert = ['status' => 1];

	public function user(){
		return $this->belongsTo('User');
	}
}