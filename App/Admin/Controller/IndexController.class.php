<?php

namespace Admin\Controller;

use Think\DB;
class IndexController extends BaseController {

    protected $cache_model;

    public function shoulu()
    {
        $this->display();
    }

    public function cs()
    {
        $this->display();
    }

    public function index()
    {

        $role = F("Role");
        $this->assign('usergroup',$role[$_SESSION['groupid']]['name']);

        foreach((array)$_SESSION['_ACCESS_LIST']['ADMIN'] as $key=>$r){
            $modules[]=ucwords(strtolower($key));
        }

        $modules=implode("','",$modules);
        $alltopnode= M('Node')->field('groupid')->where("name in('$modules') and level=2")->group('groupid')->select();

        foreach((array)$alltopnode as $key=>$r){
            $GroupAccessids[]=$r['groupid'];
        }

        $this->assign($this->Config);

        $db = D('');
        $db = DB::getInstance();
        $tables = $db->getTables();

        $info = array(
                    'SERVER_SOFTWARE'       => PHP_OS.' '.$_SERVER["SERVER_SOFTWARE"],
                    'mysql_get_server_info' => php_sapi_name(),
                    'MYSQL_VERSION'         => mysql_get_server_info(),
                    'upload_max_filesize'   => ini_get('upload_max_filesize'),
                    'max_execution_time'    => ini_get('max_execution_time').L('miao'),
                    'disk_free_space'       => round((@disk_free_space(".")/(1024*1024)),2).'M',
                    );

        $this->assign('server_info',$info);

        foreach ((array)$this->module as $val){
            if($val['type']==1){
                $molule = M($val['name']);
                $mdata[$val['name']] = $molule->count();
            }
        }

        $molule = M('Admin');
        $counts = $molule->count();
        $userinfos = $molule->find($_SESSION['adminid']);
        $mdata['User'] = $counts;

        $mdata['Category'] = M('Category')->count();
        $mdata['Link'] = M('Link')->count();

        $this->assign('mdata',$mdata);

        $role = F('Role');
        $userinfo=array(
            'username'=>$userinfos['username'],
            'groupname'=>$role[$userinfos['roleid']]['name'],
            'logintime'=>toDate($userinfos['last_logintime']),
            'last_ip'=>$userinfos['last_ip'],
            'login_count'=>$userinfos['login_count'].L('ci'),
        );

        $this->assign('userinfo',$userinfo);
        $this->display();
    }

    // 更换密码
    public function password()
    {

        if($_POST){

            if(md5($_POST['verify']) != $_SESSION['verify']) {
                $this->error(L('error_verify'));
            }

            if($_POST['password'] != $_POST['repassword']){
                $this->error(L('password_repassword'));
            }

            $map = array();
            $map['password']= sysmd5($_POST['oldpassword']);

            if(isset($_POST['username'])) {
                $map['username'] = $_POST['username'];
            }elseif(isset($_SESSION['adminid'])) {
                $map['id'] = $_SESSION['adminid'];
            }

            //检查用户
            $User = M("Admin");

            if(!$User->where($map)->field('id')->find()) {
                $this->error(L('error_oldpassword'));
            }else {
                $User->updatetime = time();
                $User->password  = sysmd5($_POST['password']);
                $User->save();
                $this->success(L('do_success'));
            }
        }else{
            $this->assign('nav2','3');
            $this->display();
        }
    }


    // 修改资料
    public function profile()
    {

        if(IS_POST){
            $User = M("Admin");

            if(!$User->create()) {
                $this->error($User->getError());
            }

            $User->update_time = time();
            $User->last_ip = get_client_ip();
            $result = $User->save();

            if(false !== $result) {
                $this->success(L('do_success'));
            }else{
                $this->error(L('do_error'));
            }
        }else{
            $User = M("Admin");
            $vo = $User->getById($_SESSION['adminid']);
            $this->assign('vo',$vo);
            $this->assign('nav2','2');
            $this->display();
        }
    }
}