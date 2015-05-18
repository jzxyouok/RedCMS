<?php

namespace Develop\Controller;
use Develop\Developbase;
class IndexController extends DevelopbaseController{

  protected $cache_model;

  public function index() {

    $role = F("Role");
    $this->assign('usergroup',$role[$_SESSION['groupid']]['name']);

    if(!empty($_SESSION['_ACCESS_LIST']['ADMIN'])){

      foreach((array)$_SESSION['_ACCESS_LIST']['ADMIN'] as $key=>$r){
        $modules[]=ucwords(strtolower($key));
      }
      $modules=implode("','",$modules);
      $alltopnode = M('Node')->field('groupid')->where("name in('$modules') and level=2")->group('groupid')->select();

      foreach((array)$alltopnode as $key=>$r){
        $GroupAccessids[]=$r['groupid'];
      }
    }

    $this->assign($this->Config);

    $db = D('');
    $db = DB::getInstance();
    $tables = $db->getTables();

    $info = array(
            'SERVER_SOFTWARE'=>PHP_OS.' '.$_SERVER["SERVER_SOFTWARE"],
            'mysql_get_server_info'=>php_sapi_name(),
            'MYSQL_VERSION' => mysql_get_server_info(),
            'upload_max_filesize'=> ini_get('upload_max_filesize'),
            'max_execution_time'=>ini_get('max_execution_time').L('miao'),
            'disk_free_space'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
           );

    $this->assign('server_info',$info);

    foreach ((array)$this->module as $rw){
      if($rw['type']==1){
        $molule = M($rw['name']);
        $rw['counts'] = $molule->count();;
        $mdata['moduledata'][] = $rw;
      }
    }

    $admin= M('Admin');
    $counts = $admin->count();
    $userinfos = $admin->find($_SESSION['adminid']);
    $mdata['moduledata'][] = array('title'=>L('user_counts'),'counts'=>$counts);

    $molule = M('Category');
    $counts = $molule->count();

    $mdata['moduledata'][] = array('title'=>L('Category_counts'),'counts'=>$counts);
    $this->assign($mdata);

    $role = F('Role');

    $userinfo = array(
      'username'=>$userinfos['username'],
      'groupname'=>$role[$userinfos['groupid']]['name'],
      'logintime'=>toDate($userinfos['last_logintime']),
      'last_ip'=>$userinfos['last_ip'],
      'login_count'=>$userinfos['login_count'].L('ci'),
    );

    $this->assign('userinfo',$userinfo);
    $this->assign('nav1','dashboard');
    $this->assign('nav2',1);
    $this->display();
  }

  //二维码生成
  public function qr(){
    $this->assign('nav1','addon');
    $this->assign('nav2',6);
    $this->display();
  }

  public function shoulu(){
    $this->assign('nav1','addon');
    $this->assign('nav2',8);
    $this->display();
  }

  public function cs(){
    $this->display();
  }

  public function zhengshu() {

    $role = F("Role");

    $this->assign('usergroup',$role[$_SESSION['groupid']]['name']);

    foreach((array)$_SESSION['_ACCESS_LIST']['ADMIN'] as $key=>$r){$modules[]=ucwords(strtolower($key));}

    $modules=implode("','",$modules);

    $alltopnode= M('Node')->field('groupid')->where("name in('$modules') and level=2")->group('groupid')->select();

    foreach((array)$alltopnode as $key=>$r){
      $GroupAccessids[]=$r['groupid'];
    }

    $this->assign($this->Config);
    $this->display();
  }

  public function cache() {

    dir_delete(RUNTIME_PATH.'Html/');
    dir_delete(RUNTIME_PATH.'Cache/');

    if(is_file(RUNTIME_PATH.'~runtime.php')){
      @unlink(RUNTIME_PATH.'~runtime.php');
    }
    if(is_file(RUNTIME_PATH.'~allinone.php')){
      @unlink(RUNTIME_PATH.'~allinone.php');
    }

    R('Category/repair');

    foreach($this->cache_model as $r){
      savecache($r);
    }

    $this->ajaxReturn(L('do_success'));
  }

  // 更换密码
  public function password(){

    if(IS_POST){

      if($_POST['password'] != $_POST['repassword']){
        $this->error(L('password_repassword'));
      }

      $map = array();
      $map['password'] = sysmd5($_POST['oldpassword']);

      if(isset($_POST['username'])) {
        $map['username'] = $_POST['username'];
      }elseif(isset($_SESSION['adminid'])) {
        $map['id'] = $_SESSION['adminid'];
      }

      //检查用户
      $User = M("user");

      if(!$User->where($map)->field('id')->find()) {
        $this->error(L('error_oldpassword'));
      }else {
        $User->updatetime = time();
        $User->password = sysmd5($_POST['password']);
        $User->save();
        $this->success(L('do_success'));
        exit;
      }
    }
    $this->assign('nav2','3');
    $this->display();
  }


  // 修改资料
  public function profile() {

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
      $this->display();
    }
  }
}