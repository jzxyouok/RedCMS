<?php
/*$home_conf =  include DATA_PATH. 'sys.config.php';

if(MOB != ''){
  $default_theme = $home_conf['DEFAULT_THEME'].MOB;
}else{
  $default_theme = !empty($_GET['l'])?$_GET['l']:$home_conf['DEFAULT_THEME'];
}
*/
// $database = require ('./config.php');
$sys_config =  include DATA_PATH. 'sys.config.php';
if(empty($sys_config)){
  $sys_config=array();
  $sys_config['LAYOUT_ON']=1;
}
if($sys_config['URL_MODEL'])
  $RULES = include DATA_PATH. 'Routes.php';

$default_theme = "Default";
return array(
	//'配置项'=>'配置值'

	'DEFAULT_CHARSET'       =>  'utf-8',
	// 'APP_GROUP_MODE'        =>  1,
	'DB_FIELDS_CACHE'       =>  false,
	'DB_FIELDTYPE_CHECK'    =>  true,
  'DEFAULT_THEME'       => $default_theme,

  //多模板支持
  //'TMPL_SWITCH_ON'    => true,
  //'TMPL_DETECT_THEME'   => true,
  //'THEME_LIST'          => 'Default,mobile,En,Jp,en,jp',//支持的模板主题项

   /* 模板相关配置 */
  'TMPL_PARSE_STRING'   => array(
    '__STATIC__' => __ROOT__ . '/Public/static',
    '__TMPL__'   => __ROOT__.'/Themes/Home/'.$default_theme,
  ),

  /* 数据缓存设置 */
  'DATA_CACHE_TIME'       =>  0,      // 数据缓存有效期 0表示永久缓存
  'DATA_CACHE_COMPRESS'   =>  false,   // 数据缓存是否压缩缓存
  'DATA_CACHE_CHECK'      =>  false,   // 数据缓存是否校验缓存
  'DATA_CACHE_PREFIX'     =>  '',     // 缓存前缀
  'DATA_CACHE_TYPE'       =>  'File',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
  'DATA_CACHE_PATH'       =>  TEMP_PATH,// 缓存路径设置 (仅对File方式缓存有效)
  'DATA_CACHE_SUBDIR'     =>  false,    // 使用子目录缓存 (自动根据缓存标识的哈希创建子目录)
  'DATA_PATH_LEVEL'       =>  1,        // 子目录缓存级别

	//多语言支持设置
	'DEFAULT_LANG'          =>  'zh-cn',
	'LANG_SWITCH_ON'		    =>  true,
	'LANG_AUTO_DETECT'      =>  true,
	'LANG_LIST'             =>  'cn,zh-cn,en',


  /* Cookie设置 */
  'COOKIE_EXPIRE'         =>  '',    // Cookie有效期
  //'COOKIE_DOMAIN'         =>  '',      // Cookie有效域名
  //'COOKIE_PATH'           =>  '/',     // Cookie路径
	'COOKIE_PREFIX'         =>  'yzh_',


  /* 系统变量名称设置 */
	'VAR_PAGE'              =>  'p',

  // Think模板引擎标签库相关设定
  'TAGLIB_BEGIN'          =>  '<',  // 标签库标签开始标记
  'TAGLIB_END'            =>  '>',  // 标签库标签结束标记
  'TAGLIB_LOAD'           =>  true, // 是否使用内置标签库之外的其它标签库，默认自动检测
  'TAGLIB_BUILD_IN'       =>  'gr', // 内置标签库名称(标签使用不必指定标签库名称),以逗号分隔 注意解析顺序
  // 'TAGLIB_PRE_LOAD'       =>  'cx,gr',   // 需要额外加载的标签库(须指定标签库名称)，多个以逗号分隔

	/* URL设置 */
  'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
  // 'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
  // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
  // 'URL_PATHINFO_DEPR'     =>  '/',    // PATHINFO模式下，各参数之间的分割符号
  // 'URL_PATHINFO_FETCH'    =>  'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
  // 'URL_REQUEST_URI'       =>  'REQUEST_URI', // 获取当前页面地址的系统变量 默认为REQUEST_URI
  // 'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置
  // 'URL_DENY_SUFFIX'       =>  'ico|png|gif|jpg', // URL禁止访问的后缀设置
  // 'URL_PARAMS_BIND'       =>  true, // URL变量绑定到Action方法参数
  // 'URL_PARAMS_BIND_TYPE'  =>  0, // URL变量绑定的类型 0 按变量名绑定 1 按变量顺序绑定
  // 'URL_404_REDIRECT'      =>  '', // 404 跳转页面 部署模式有效
  'URL_ROUTER_ON'         =>  true,   // 是否开启URL路由
  'URL_ROUTE_RULES'       =>  $RULES, // 默认路由规则 针对模块
  'URL_MAP_RULES'         =>  array(), // URL映射定义规则


	/* 模板引擎设置 */
  'VIEW_PATH'=>'./Themes/Home/',
	'TMPL_STRIP_SPACE'      =>  false,
	'TMPL_FILE_DEPR'        =>  '_',
  'TMPL_ACTION_ERROR'     =>  TMPL_PATH.'Home/Default/public/error.html',
  'TMPL_ACTION_SUCCESS'   =>  TMPL_PATH.'Home/Default/public/success.html',
  'TMPL_EXCEPTION_FILE'   =>  TMPL_PATH.'Home/Default/public/exception.html',

	// 布局设置
	//'LAYOUT_HOME_ON'        =>  $sys_config['LAYOUT_ON'],




	//调试开关
  'SHOW_PAGE_TRACE'       =>  true, // 开启页面Trace显示界面
	// 'SHOW_RUN_TIME'         =>  true, // 运行时间显示
	// 'SHOW_ADV_TIME'         =>  true, // 显示详细的运行时间
	// 'SHOW_DB_TIMES'         =>  true, // 显示数据库查询和写入次数
	// 'SHOW_CACHE_TIMES'      =>  true, // 显示缓存操作次数
	// 'SHOW_USE_MEM'          =>  true, // 显示内存开销
	// 'SHOW_LOAD_FILE'        =>  true, // 显示加载文件数
	// 'SHOW_FUN_TIMES'        =>  true, // 显示函数调用次数
);
return array_merge($config ,$sys_config);