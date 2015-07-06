    <?php
    return array(
    //'配置项'                  =>'配置值'
    'DEFAULT_THEME'          => 'Default',
    'LANG_SWITCH_ON'         => true,
    'DEFAULT_LANG'           => 'zh-cn',
    'URL_ROUTER_ON'          => false,
    'TMPL_CACHE_ON'          => false,
    'TMPL_CACHE_TIME'        => -1,
    'URL_DISPATCH_ON'        => 0,
    'URL_MODEL'              => 0,

    'LANG_AUTO_DETECT'       => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'              => 'zh-cn', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'           => 'l', // 默认语言切换变量

    'USER_AUTH_ON'           =>true,
    'USER_AUTH_TYPE'         =>1,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'          =>'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'         =>'administrator',
    'USER_AUTH_MODEL'        =>'User',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'       =>'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'      =>'?g=admin&m=login',	// 默认认证网关
    'NOT_AUTH_MODULE'        =>'',		// 默认无需认证模块
    'REQUIRE_AUTH_MODULE'    =>'',		// 默认需要认证模块
    'NOT_AUTH_ACTION'        =>'',		// 默认无需认证操作
    'REQUIRE_AUTH_ACTION'    =>'',		// 默认需要认证操作
    'GUEST_AUTH_ON'          => false,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'          =>    0,     // 游客的用户ID
    'DB_LIKE_FIELDS'         =>	'name|remark',
    'RBAC_ROLE_TABLE'        =>	C('DB_PREFIX').'role',
    'RBAC_USER_TABLE'        =>	C('DB_PREFIX').'role_user',
    'RBAC_ACCESS_TABLE'      =>	C('DB_PREFIX').'access',
    'RBAC_NODE_TABLE'        =>  C('DB_PREFIX').'node',
    'DEFAULT_HOME_THEME'     => C('DEFAULT_THEME'),
    'LAYOUT_ON'              => false,
    'TMPL_CACHE_ON'          => true,
    'TMPL_CACHE_TIME'        => 3600,
    //'TMPL_DETECT_THEME'    => true
    //'LANG_SWITCH_ON'       => true,
    'TMPL_DENY_PHP'          =>  false, // 默认模板引擎是否禁用PHP原生代码
    'TMPL_L_DELIM'           =>  '{',            // 模板引擎普通标签开始标记
    'TMPL_R_DELIM'           =>  '}',            // 模板引擎普通标签结束标记


    /* 模板相关配置 */
    'TMPL_PARSE_STRING'      => array(
        '__STATIC__'             => __ROOT__ . '/Public/static',
        '__TMPL__'               => __ROOT__.'/Themes/Admin/Default',
    ),
    'SHOW_PAGE_TRACE'        =>  true, // 开启页面Trace显示界面
    // 'TMPL_ACTION_ERROR'   => TMPL_PATH.'Admin/Default/Public/success.html',
    // 'TMPL_ACTION_SUCCESS' =>  TMPL_PATH.'Admin/Default/Public/success.html',
    // 'TMPL_EXCEPTION_FILE' => TMPL_PATH.'Admin/Default/Public/exception.html',
);