<?php
namespace Develop\Controller;
use Think\Controller;
class LoginController extends Controller{
  private $groupid;
  private $sysConfig;
  private $cache_model;
  private $Config;
  private $menudata;

  function _initialize() {
    $this->sysConfig = F('sys.config');
    C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);
    import('@.TagLib.TagLibGr');
  }

  public function index() {
    if(is_file(RUNTIME_PATH.'~app.php'))
      @unlink(RUNTIME_PATH.'~app.php');

    if(is_file(RUNTIME_PATH.'~runtime.php'))
      @unlink(RUNTIME_PATH.'~runtime.php');

    if(is_file(RUNTIME_PATH.'~allinone.php'))
      @unlink(RUNTIME_PATH.'~allinone.php');

    $this->menudata = F('Menu');

    $this->cache_model = array('Lang','Menu','Config','Module','Role','Category','Wapcategory','Posid','Tags','Field','Type','Urlrule','Dbsource');
    if(empty($this->sysConfig['ADMIN_ACCESS']) || empty($this->menudata)){
      foreach($this->cache_model as $r){
        savecache($r);
      }
      $this->sysConfig = F('sys.config');
      C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);
    }
    if(!empty($_SESSION['adminid'])){
      $this->assign('jumpUrl',U('Index/index'));
      $this->success(L('logined'));
      exit;
    }
    $this->display();
  }

  public function doLogin() {
    $user = M('Admin');

    if(C('TOKEN_ON') && !$user->autoCheckToken($_POST)){
      $this->error (L('_TOKEN_ERROR_'));
    }

    if(empty($this->sysConfig['ADMIN_ACCESS'])) {
      $this->error(L('NO SYSTEM CONFIG FILE'));
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $verifyCode = trim($_POST['verifyCode']);

    if(empty($username) || empty($password)){
       $this->error(L('EMPTY_USERNAME_EMPTY_PASSWORD'));
    }elseif(md5($verifyCode) != $_SESSION['verify']){
       $this->error(L('error_verify'));
    }

    $condition = array();
    $condition['username'] = array('eq',$username);
    import('@.ORG.RBAC' );
    $authInfo = RBAC::authenticate($condition,'Admin');

    //使用用户名、密码和状态的方式进行认证
    if(false === $authInfo) {
      $this->error(L('empty_userid'));
    }else {
      if($authInfo['password'] != sysmd5($_POST['password'])) {
        $this->error(L('password_error'));
      }
      $_SESSION['username'] = $authInfo['username'];
      $_SESSION['adminid'] = $_SESSION['userid'] = $authInfo['id'];
      $_SESSION['groupid'] = $authInfo['groupid'];
      $_SESSION['adminaccess'] = C('ADMIN_ACCESS');
      $_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];
      $_SESSION['email'] = $authInfo['email'];
      $_SESSION['lastLoginTime'] = $authInfo['last_logintime'];
      $_SESSION['login_count'] = $authInfo['login_count']+1;

      if($authInfo['groupid']==1) {
        $_SESSION[C('ADMIN_AUTH_KEY')]=true;
      }
      //保存登录信息
      $data = array();
      $data['id']  = $authInfo['id'];
      $data['last_logintime']  = time();
      $data['last_ip'] = get_client_ip();
      $data['login_count'] = array('exp','login_count+1');
      $user->save($data);
      // 缓存访问权限
      RBAC::saveAccessList();
      if($_POST['ajax']){
        $authInfo['info'] = L('login_ok');
        $this->ajaxReturn($authInfo);
      }else{
        $this->assign('jumpUrl',U('index/index'));
        $this->success(L('login_ok'));
      }
    }
  }

  /**
   * 退出登录
   *
   */
  public function logout() {
    if(isset($_SESSION[C('USER_AUTH_KEY')])) {

      unset($_SESSION[C('USER_AUTH_KEY')]);
      unset($_SESSION);
      session_destroy();
      $this->assign('jumpUrl',U('login/index'));
      $this->success(L('loginouted'));

    }else {

      $this->assign('jumpUrl',U('Login/index'));
      $this->error(L('logined'));
    }
  }

  function checkEmail(){
    $user=M('Admin');
        $email=$_GET['email'];

    $userid=intval($_GET['userid']);

    if(empty($userid)){
      if($user->getByEmail($email)){
         echo 'false';
      }else{
        echo 'true';
      }
    }else{

      //判断邮箱是否已经使用
      if($user->where("id!={$userid} and email='{$email}'")->find()){
         echo 'false';
      }else{
        echo 'true';
      }
    }
    exit;
  }

  public function verify() {
    ob_clean();
    header("Content-type: image/png");
    import("@.ORG.Image");
    Image::buildImageVerify(4,1,'png',50,25);
  }

}