<?
return [
// 全局变量规则定义
'__pattern__'         => [
'id'    => '\d+',
],
'user/index'      => 'index/user/index',
'user/create'     => 'index/user/create',
'user/add'        => 'index/user/add',
'user/add_list'   => 'index/user/addList',
'user/update/:id' => 'index/user/update',
'user/delete/:id' => 'index/user/delete',
'user/:id'        => 'index/user/read',
];
