<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/14
 * Time: 11:37
 */

namespace app\index\model;

use think\Model;

class Profile extends Model{
	protected $type = [
		'birthday' => 'timestamp:Y-m-d',
	];

	public function user(){
		return $this->belongsTo('User');
	}
}