<?php

return array(
    //模块名
    'name' => 'Wechat',
    //别名
    'alias' => '微信平台',
    //版本号
    'version' => '1.0.0',
    //是否商业模块,1是，0，否
    'is_com' => 0,
    //是否显示在导航栏内？  1是，0否
    'show_nav' => 1,
    //模块描述
    'summary' => '微信模块，可绑定微信公众号',
    //开发者
    'developer' => '誉字号研发',
    //开发者网站
    'website' => 'http://dev.yuzihao.com',
    //前台入口，可用U函数
    'entry' => 'Wechat/index/index',

    'admin_entry' => 'Admin/Wechat/contents',

    'icon' => 'th',

    'can_uninstall' => 1
);