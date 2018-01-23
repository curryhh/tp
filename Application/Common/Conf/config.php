<?php
return array(
	//'配置项'=>'配置值'

	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'tp',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'tp_',    // 数据库表前缀

	//开启调试
	'SHOW_PAGE_TRACE' =>true,

	//模板常量
	'TMPL_PARSE_STRING' =>  array(
		//'__ADMIN__' => __ROOT__.'/Public/Admin', 
		'__ADMIN__' => __ROOT__.'/Public/Admin',
	),
	
	// 开启路由
	'URL_ROUTER_ON'   => true, 
	'URL_ROUTE_RULES'=>array(
	   'showlist'=>'/index.php/Admin/News/showlist'
	)
);