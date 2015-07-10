<?php
/**
 *
 * Adminbase (后台公共模块)
 *
 */
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Form;
use Org\Util\Online;
use Org\Util\Rbac;
use Org\Util\Page;
use Org\Util\Tree;

class BaseController extends Controller {

    protected $mod;
    protected $Config;
    protected $sysConfig;
    protected $nav;
    protected $menudata;
    protected $cache_model;
    protected $categorys;
    protected $module;
    protected $moduleid;
    protected $Type;
    protected $Urlrule;
    protected $Lang;

    function _initialize()
    {
        //检测是否登陆
        $this->checkLogin();
        $this->sysConfig = F('sys.config');
        $this->menudata  = F('Menu');
        $this->module    = F('Module');
        $this->Type      = F('Type');
        $this->Urlrule   = F('Urlrule');
        $this->mod       = F('Mod');

        if(APP_LANG){

            $this->Lang = F('Lang');

            if(!empty($_GET['l'])){
                if($this->Lang[$_GET['l']]['id']){
                    $_SESSION['yzh_lang'] = $_GET['l'];
                    $_SESSION['yzh_langid'] = $this->Lang[$_GET['l']]['id'];
                }else{
                    $this->error ('找不到多语言数据');
                }
            }elseif(!empty($_SESSION['yzh_lang']) || !$_SESSION['yzh_langid']){
                $_SESSION['yzh_lang'] = $this->sysConfig['DEFAULT_LANG'];
                $_SESSION['yzh_langid'] = $this->Lang[$this->sysConfig['DEFAULT_LANG']]['id'];
            }

            define('LANG_NAME',$_SESSION['yzh_lang']);
            define('LANG_ID',$_SESSION['yzh_langid']);
            $this->assign('l',LANG_NAME);
            $this->assign('langid',LANG_ID);
            $this->categorys = F('Category_'.LANG_NAME);
            $this->Config = F('Config_'.LANG_NAME);
            $this->assign('Lang',$this->Lang);
        }else{
            $this->Config = F('Config');
            $this->categorys = F('Category');
        }

        $this->assign('controller_name',CONTROLLER_NAME);
        $this->assign('action_name',ACTION_NAME);
        $this->cache_model = array('Lang','Menu','Config','Module','AdminRole','Category','Posid','Field','Type','Urlrule','Dbsource');

        C('PAGE_LISTROWS',$this->sysConfig['PAGE_LISTROWS']);
        C('URL_LANG',$this->sysConfig['DEFAULT_LANG']);
        C('URL_M',$this->sysConfig['URL_MODEL']);
        C('URL_M_PATHINFO_DEPR',$this->sysConfig['URL_PATHINFO_DEPR']);
        C('URL_M_HTML_SUFFIX',$this->sysConfig['URL_HTML_SUFFIX']);
        C('URL_URLRULE',$this->sysConfig['URL_URLRULE']);
        C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);

        // 用户权限检查
        if (C( 'USER_AUTH_ON' ) && !in_array(CONTROLLER_NAME,explode(',',C('NOT_AUTH_MODULE')))) {
            import('@.ORG.RBAC');
            if (! RBAC::AccessDecision ('admin')) {
                //检查认证识别号
                if (! $_SESSION [C( 'USER_AUTH_KEY' )]) {
                    //跳转到认证网关
                    redirect( PHP_FILE . C( 'USER_AUTH_GATEWAY' ) );
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect ( C( 'RBAC_ERROR_PAGE' ) );
                } else {
                    if (C('GUEST_AUTH_ON' )) {
                        $this->assign ('jumpUrl', PHP_FILE . C( 'USER_AUTH_GATEWAY' ) );
                    }
                    // 提示错误信息
                    $this->error( L('_VALID_ACCESS_'));
                }
            }
        }

        if(!empty($this->mod[CONTROLLER_NAME])){

            $this->moduleid = $this->mod[CONTROLLER_NAME];
            $this->m = $this->module[$this->moduleid];
            $this->assign('moduleid',$this->moduleid);
            $this->Type = F('Type');
            $this->assign('Type',$this->Type);

            if($this->categorys){

                foreach ($this->categorys as $r){

                    if($r['moduleid'] != $this->moduleid || $r['child']){
                        $arr= explode(",",$r['arrchildid']);
                        $show=0;
                        foreach((array)$arr as $rr){
                            if($this->categorys[$rr]['moduleid'] ==$this->moduleid)
                                $show=1;
                        }

                        if(empty($show))
                            continue;

                        $r['disabled'] = $r['child'] ? ' disabled' : '';
                    }else{
                        $r['disabled'] = '';
                    }
                    $array[] = $r;
                }

                $str  = "<option value='\$id' \$disabled \$selected>\$spacer \$catname</option>";
                $tree = new Tree($array);
                $select_categorys = $tree->get_tree(0, $str);
                $this->assign('select_categorys', $select_categorys);
                $this->assign('categorys', $this->categorys);
            }
            $this->assign('posids', F('Posid'));

        }


        if(!$_SESSION[C('ADMIN_AUTH_KEY')]){
            $modules = array();
            foreach ((array)$_SESSION['_ACCESS_LIST'] as $key=>$r) {
                $modules[] = ucwords(strtolower($key));
            }

            $modules = implode("','",$modules);

            $alltopnode= M('Node')->field('groupid')->where("name in('$modules') and level=2")->group('groupid')->select();

            $GroupAccessids = array();
            foreach((array)$alltopnode as $key=>$r){
                $GroupAccessids[] = $r['groupid'];
            }

            foreach ($this->menudata as $key=>$module) {

                if($module['parentid'] != 0 || $module['status']==0) {
                    continue;
                }

                if (in_array($key,$GroupAccessids) || $_SESSION[C('ADMIN_AUTH_KEY')]) {

                    if (empty($module['action'])){
                        $module['action']='index';
                    }

                    $nav[$key] = $module;
                }
            }

        } else {//dump($this->menudata);exit;
            foreach ($this->menudata as $key=>$module) {

                if($module['parentid'] != 0 || $module['status']==0) {
                    continue;
                }

                if (empty($module['action'])){
                    $module['action']='index';
                }

                $nav[$key] = $module;
            }
        }

        $topnav = array();
        $asidenav = array();
        foreach ($nav as $key=>$val) {
            $M = $this->getnav($val['id']);
            $topnav[] = $M['bnav'];//顶部菜单
            $asidenav[$val['id']] = $M['nav'];//侧边栏菜单
        }

        $this->assign('topnav2', $topnav);
        $this->assign('asidenav2', $asidenav);

        $Form = new \Org\Util\Form();
        $this->assign('Form', $Form);
    }

    function getnav($menuid,$isnav=0)
    {

        if($menuid){

            $bnav = $this->menudata[$menuid];
            if(empty($bnav['action']))
                $bnav['action'] ='index';

            $array = array('menuid'=>$bnav['id']);

            parse_str($bnav['data'],$c);

            $bnav['data'] = $c + $array;

        }

        if($this->menudata){

            $accessList = $_SESSION['_ACCESS_LIST'];

            foreach($this->menudata as $key=>$module) {

                if($module['parentid'] != $menuid || $module['status']==0) continue;

                if(isset($accessList[strtoupper('Admin')][strtoupper($module['model'])]) || $_SESSION[C('ADMIN_AUTH_KEY')]) {

                    //设置模块访问权限$module['access'] =   1;
                    if(empty($module['action'])) $module['action']='index';

                    //检测动作权限
                    if(isset($accessList[strtoupper('Admin')][strtoupper($module['model'])][strtoupper($module['action'])]) || $_SESSION[C('ADMIN_AUTH_KEY')]){

                        $nav[$key]  = $module;

                        if($isnav){
                            $array=array('menuid'=> $nav[$key]['parentid']);
                            cookie('menuid',$nav[$key]['parentid']);
                            //$_SESSION['menuid'] = $nav[$key]['parentid'];
                        }else{
                             $array=array('menuid'=> $nav[$key]['id']);
                        }

                        if(empty($menuid) && empty($isnav)) $array=array();
                        $c=array();
                        parse_str($nav[$key]['data'],$c);
                        $nav[$key]['data'] = $c + $array;
                    }
                }
            }
        }

        $navdata['bnav'] = $bnav;
        $navdata['nav'] = $nav;
        return $navdata;
    }

    public function cache()
    {

        dir_delete(RUNTIME_PATH.'Html/');
        dir_delete(RUNTIME_PATH.'Cache/');
        if(is_file(RUNTIME_PATH.'~runtime.php')){
            @unlink(RUNTIME_PATH.'~runtime.php');
        }
        if(is_file(RUNTIME_PATH.'~allinone.php')){
            @unlink(RUNTIME_PATH.'~allinone.php');
        }

        R('Admin/Category/repair');

        foreach($this->cache_model as $r){
            savecache($r);
        }

        $this->ajaxReturn('更新缓存成功！');
    }


    function checkLogin()
    {
        if(empty($_SESSION['username']) ){
            $this->redirect('Login/index');
        }
    }


   /**
     * action访问控制,在 **登陆成功** 后执行的第一项权限检测任务
     *
     * @return boolean|null  返回值必须使用 `===` 进行判断
     *
     *   返回 **false**, 不允许任何人访问(超管除外)
     *   返回 **true**, 允许任何管理员访问,无需执行节点权限检测
     *   返回 **null**, 需要继续执行节点权限检测决定是否允许访问
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final protected function accessControl()
    {
        if (IS_ROOT) {
            return true;//管理员允许访问任何页面
        }
        $allow = C('ALLOW_VISIT');
        $deny = C('DENY_VISIT');
        $check = strtolower(CONTROLLER_NAME . '/' . ACTION_NAME);
        if (!empty($deny) && in_array_case($check, $deny)) {
            return false;//非超管禁止访问deny中的方法
        }
        if (!empty($allow) && in_array_case($check, $allow)) {
            return true;
        }
        return null;//需要检测节点权限
    }

    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     *
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $data 修改的数据
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    final protected function editRow($model, $data, $where, $msg)
    {
        $id = array_unique((array)I('id', 0));
        $id = is_array($id) ? implode(',', $id) : $id;
        $where = array_merge(array('id' => array('in', $id)), (array)$where);
        $msg = array_merge(array('success' => '操作成功！', 'error' => '操作失败！', 'url' => '', 'ajax' => IS_AJAX), (array)$msg);
        if (M($model)->where($where)->save($data) !== false) {
            $this->success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
            $this->error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }

    /**
     * 禁用条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的 where()方法的参数
     * @param array  $msg 执行正确和错误的消息,可以设置四个元素 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function forbid($model, $where = array(), $msg = array('success' => '状态禁用成功！', 'error' => '状态禁用失败！'))
    {
        $data = array('status' => 0);
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 恢复条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function resume($model, $where = array(), $msg = array('success' => '状态恢复成功！', 'error' => '状态恢复失败！'))
    {
        $data = array('status' => 1);
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 还原条目
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     * @author huajie  <banhuajie@163.com>
     */
    protected function restore($model, $where = array(), $msg = array('success' => '状态还原成功！', 'error' => '状态还原失败！'))
    {
        $data = array('status' => 1);
        $where = array_merge(array('status' => -1), $where);
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 条目假删除
     * @param string $model 模型名称,供D函数使用的参数
     * @param array  $where 查询时的where()方法的参数
     * @param array  $msg 执行正确和错误的消息 array('success'=>'','error'=>'', 'url'=>'','ajax'=>false)
     *                     url为跳转页面,ajax是否ajax方式(数字则为倒数计时秒数)
     *
     * @author 朱亚杰  <zhuyajie@topthink.net>
     */
    protected function delete($model, $where = array(), $msg = array('success' => '删除成功！', 'error' => '删除失败！'))
    {
        $data['status'] = -1;
        $data['update_time'] = NOW_TIME;
        $this->editRow($model, $data, $where, $msg);
    }

    /**
     * 设置一条或者多条数据的状态
     */
    public function setStatus($Model = CONTROLLER_NAME)
    {

        $ids = I('request.ids');
        $status = I('request.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }

        $map['id'] = array('in', $ids);
        switch ($status) {
            case -1 :
                $this->delete($Model, $map, array('success' => '删除成功', 'error' => '删除失败'));
                break;
            case 0  :
                $this->forbid($Model, $map, array('success' => '禁用成功', 'error' => '禁用失败'));
                break;
            case 1  :
                $this->resume($Model, $map, array('success' => '启用成功', 'error' => '启用失败'));
                break;
            default :
                $this->error('参数错误');
                break;
        }
    }

    /**获取模块列表，用于显示在左侧
     * @auth 陈一枭 <yixiao2020@qq.com>
     */
    public function getModules()
    {
        $modules=D('Module')->getAll();
        foreach($modules as $key=> &$v){
            $rule = strtolower($v['admin_entry']);
            if (!$this->checkRule($rule, array('in', '1,2'))) {
                unset($modules[$key]);
            }

        }
        return $modules;

    }

    /**
     * 获取控制器菜单数组,二级菜单元素位于一级菜单的'_child'元素中
     * @author 朱亚杰  <xcoolcc@gmail.com>
     */
    final public function getMenus($controller = CONTROLLER_NAME)
    {
        // $menus  =   session('ADMIN_MENU_LIST'.$controller);
        if (empty($menus)) {
            // 获取主菜单
            $where['pid'] = 0;
            //$where['hide'] = 0;
            if (!C('DEVELOP_MODE')) { // 是否开发者模式
                $where['is_dev'] = 0;
            }
            $menus['main'] = M('Menu')->where($where)->order('sort asc')->select();


            $menus['child'] = array(); //设置子节点

            //高亮主菜单
            //$current = M('Menu')->where("url like '%{$controller}/" . ACTION_NAME . "%'")->field('id')->find();
            $current = M('Menu')->where("url like '{$controller}/" . ACTION_NAME . "%' OR url like '%/{$controller}/" . ACTION_NAME . "%'  ")->field('id')->find();
            if ($current) {
                $nav = D('Menu')->getPath($current['id']);
                $nav_first_title = $nav[0]['title'];

                foreach ($menus['main'] as $key => $item) {
                    if (!is_array($item) || empty($item['title']) || empty($item['url'])) {
                        $this->error('控制器基类$menus属性元素配置有误');
                    }
                    if (stripos($item['url'], MODULE_NAME) !== 0) {
                        $item['url'] = MODULE_NAME . '/' . $item['url'];
                    }
                    // 判断主菜单权限
                    if (!IS_ROOT && !$this->checkRule($item['url'], AuthRuleModel::RULE_MAIN, null)) {
                        unset($menus['main'][$key]);
                        continue;//继续循环
                    }
                    // 获取当前主菜单的子菜单项
                    if ($item['title'] == $nav_first_title) {
                        $menus['main'][$key]['class'] = 'active';
                        //生成child树
                        $groups = M('Menu')->where("pid = {$item['id']}")->distinct(true)->field("`group`")->select();

                        if ($groups) {
                            $groups = array_column($groups, 'group');
                        } else {
                            $groups = array();
                        }

                        //获取二级分类的合法url
                        $where = array();
                        $where['pid'] = $item['id'];
                        $where['hide'] = 0;
                        if (!C('DEVELOP_MODE')) { // 是否开发者模式
                            $where['is_dev'] = 0;
                        }
                        $second_urls = M('Menu')->where($where)->getField('id,url');

                        if (!IS_ROOT) {
                            // 检测菜单权限
                            $to_check_urls = array();
                            foreach ($second_urls as $key => $to_check_url) {
                                if (stripos($to_check_url, MODULE_NAME) !== 0) {
                                    $rule = MODULE_NAME . '/' . $to_check_url;
                                } else {
                                    $rule = $to_check_url;
                                }
                                if ($this->checkRule($rule, AuthRuleModel::RULE_URL, null))
                                    $to_check_urls[] = $to_check_url;
                            }
                        }
                        // 按照分组生成子菜单树
                        foreach ($groups as $g) {
                            $map = array('group' => $g);
                            if (isset($to_check_urls)) {
                                if (empty($to_check_urls)) {
                                    // 没有任何权限
                                    continue;
                                } else {
                                    $map['url'] = array('in', $to_check_urls);
                                }
                            }
                            $map['pid'] = $item['id'];
                            $map['hide'] = 0;
                            if (!C('DEVELOP_MODE')) { // 是否开发者模式
                                $map['is_dev'] = 0;
                            }
                            $menuList = M('Menu')->where($map)->field('id,pid,title,url,tip')->order('sort asc')->select();
                            $menus['child'][$g] = list_to_tree($menuList, 'id', 'pid', 'operater', $item['id']);
                        }
                        if ($menus['child'] === array()) {
                            //$this->error('主菜单下缺少子菜单，请去系统=》后台菜单管理里添加');
                        }
                    }
                }
            }
            // session('ADMIN_MENU_LIST'.$controller,$menus);
        }
        return $menus;
    }

    /**
     * 返回后台节点数据
     * @param boolean $tree 是否返回多维数组结构(生成菜单时用到),为false返回一维数组(生成权限节点时用到)
     * @retrun array
     *
     * 注意,返回的主菜单节点数组中有'controller'元素,以供区分子节点和主节点
     *
     * @author 朱亚杰 <xcoolcc@gmail.com>
     */
    final protected function returnNodes($tree = true)
    {
        static $tree_nodes = array();
        if ($tree && !empty($tree_nodes[(int)$tree])) {
            return $tree_nodes[$tree];
        }
        if ((int)$tree) {
            $list = M('Menu')->field('id,pid,title,url,tip,hide')->order('sort asc')->select();
            foreach ($list as $key => $value) {
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    $list[$key]['url'] = MODULE_NAME . '/' . $value['url'];
                }
            }
            $nodes = list_to_tree($list, $pk = 'id', $pid = 'pid', $child = 'operator', $root = 0);
            foreach ($nodes as $key => $value) {
                if (!empty($value['operator'])) {
                    $nodes[$key]['child'] = $value['operator'];
                    unset($nodes[$key]['operator']);
                }
            }
        } else {
            $nodes = M('Menu')->field('title,url,tip,pid')->order('sort asc')->select();
            foreach ($nodes as $key => $value) {
                if (stripos($value['url'], MODULE_NAME) !== 0) {
                    $nodes[$key]['url'] = MODULE_NAME . '/' . $value['url'];
                }
            }
        }
        $tree_nodes[(int)$tree] = $nodes;
        return $nodes;
    }


    /**
     * 通用分页列表数据集获取方法
     *
     *  可以通过url参数传递where条件,例如:  userList.html?name=asdfasdfasdfddds
     *  可以通过url空值排序字段和方式,例如: userList.html?_field=id&_order=asc
     *  可以通过url参数r指定每页数据条数,例如: userList.html?r=5
     *
     * @param sting|Model  $model 模型名或模型实例
     * @param array        $where where查询条件(优先级: $where>$_REQUEST>模型设定)
     * @param array|string $order 排序条件,传入null时使用sql默认排序或模型属性(优先级最高);
     *                              请求参数中如果指定了_order和_field则据此排序(优先级第二);
     *                              否则使用$order参数(如果$order参数,且模型也没有设定过order,则取主键降序);
     *
     * @param array        $base 基本的查询条件
     * @param boolean      $field 单表模型用不到该参数,要用在多表join时为field()方法指定参数
     * @author 朱亚杰 <xcoolcc@gmail.com>
     *
     * @return array|false
     * 返回数据集
     */
    protected function lists($model, $where = array(), $order = '', $base = array('status' => array('egt', 0)), $field = true)
    {
        $options = array();
        $REQUEST = (array)I('request.');
        if (is_string($model)) {
            $model = M($model);
        }

        $OPT = new \ReflectionProperty($model, 'options');
        $OPT->setAccessible(true);

        $pk = $model->getPk();
        if ($order === null) {
            //order置空
        } else if (isset($REQUEST['_order']) && isset($REQUEST['_field']) && in_array(strtolower($REQUEST['_order']), array('desc', 'asc'))) {
            $options['order'] = '`' . $REQUEST['_field'] . '` ' . $REQUEST['_order'];
        } elseif ($order === '' && empty($options['order']) && !empty($pk)) {
            $options['order'] = $pk . ' desc';
        } elseif ($order) {
            $options['order'] = $order;
        }
        unset($REQUEST['_order'], $REQUEST['_field']);

        $options['where'] = array_filter(array_merge((array)$base, /*$REQUEST,*/
            (array)$where), function ($val) {
            if ($val === '' || $val === null) {
                return false;
            } else {
                return true;
            }
        });
        if (empty($options['where'])) {
            unset($options['where']);
        }
        $options = array_merge((array)$OPT->getValue($model), $options);
        $total = $model->where($options['where'])->count();

        if (isset($REQUEST['r'])) {
            $listRows = (int)$REQUEST['r'];
        } else {
            $listRows = C('LIST_ROWS') > 0 ? C('LIST_ROWS') : 10;
        }
        $page = new \Think\Page($total, $listRows, $REQUEST);
        if ($total > $listRows) {
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        }
        $p = $page->show();
        $this->assign('_page', $p ? $p : '');
        $this->assign('_total', $total);
        $options['limit'] = $page->firstRow . ',' . $page->listRows;

        $model->setProperty('options', $options);

        return $model->field($field)->select();
    }

    public function  _empty(){
        $this->error('404，找不到您想要的页面。');
    }

    public function getReport(){

        $result = S('os_report');
        if(!$result){
            $url = '/index.php?s=/report/index/check.html';
            $result = $this->visitUrl($url);
            S('os_report',$result,60*60);
        }
        $report = json_decode($result[1],true);
        $ctime = filemtime("version.ini");
        $check_exists = file_exists('./Application/Admin/Data/'.$report['title'].'.txt');
        if(!$check_exists ){
            $this_update = explode("\n",$report['this_update']);
            $future_update = explode("\n",$report['future_update']);
            $this->assign('this_update',$this_update);
            $this->assign('future_update',$future_update);
            $this->assign('report',$report);
        }

    }
    public function submitReport(){
        $aQ1 =  $data['q1'] =I('post.q1','','op_t');
        $aQ2 =  $data['q2']=I('post.q2','','op_t');
        $aQ3 =  $data['q3']=I('post.q3','','op_t');
        $aQ4 =  $data['q4']=I('post.q4','','op_t');

        if(empty($aQ1)|| empty($aQ2)|| empty($aQ3)||empty($aQ4)){
            $this->error('请确保已经答完所有题目了~');
        }

        $data['host'] = 'http://'.$_SERVER['HTTP_HOST'].__ROOT__;
        $data['ip'] = get_client_ip(1);
        $url = '/index.php?s=/report/index/addFeedback.html';
        $result = $this->visitUrl($url,$data);
        $res = json_decode($result[1],true);
        if($res['status']){
            file_put_contents('./Application/Admin/Data/'.$res['data']['report_name'].'.txt',$result[1]);
            $this->success('报告提交成功，非常感谢您的合作！');
        }
        else{
            $this->error($res['info']);
        }

    }
    private function visitUrl($url,$data='')
    {
        $host = 'http://demo.ocenter.cn';
        $url = $host.$url;
        $requester = new requester($url);
        $requester->charset = "utf-8";
        $requester->content_type = 'application/x-www-form-urlencoded';
        $requester->data = http_build_query($data);
        $requester->enableCookie = true;
        $requester->enableHeaderOutput = false;
        $requester->method = "post";
        $arr = $requester->request();
        return $arr;
    }
}