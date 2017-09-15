<?php
/**
 * Created by PhpStorm.
 * User: deyong@hackoops.com
 * Date: 2017/9/15
 * Time: 8:56
 */

namespace app\index\model;

use think\Model;


class Role extends Model{
	public function user()
	{
		return $this->belongsToMany('User', 'think_access');
	}
}