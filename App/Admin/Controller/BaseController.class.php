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

}