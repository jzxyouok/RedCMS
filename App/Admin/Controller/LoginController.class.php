<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
class LoginController extends Controller {

    private $sysConfig;
    private $cache_model;
    private $Config;
    private $menudata;

    function _initialize()
    {
        $this->sysConfig = F('sys.config');
        C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);
        import('@.TagLib.TagLibGr');
    }

    public function index()
    {
        $this->menudata = F('Menu');

        if(!empty($_SESSION['adminid'])){
            $this->redirect('Index/index');
        }

        $this->display();
    }

    public function doLogin()
    {
        $user = M('User');

        if(C('TOKEN_ON') && !$user->autoCheckToken($_POST)){
            $this->error('表单令牌错误');
        }

        if(empty($this->sysConfig['ADMIN_ACCESS'])) {
            $this->error(L('NO SYSTEM CONFIG FILE'));
        }

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $verifyCode = trim($_POST['verifyCode']);
/*
        if (empty($username) || empty($password)) {
            $this->error('用户名和密码不能为空！');
        } elseif (md5($verifyCode) != $_SESSION['verify']){
            $this->error(L('error_verify'));
        }
*/
        $condition = array();
        $condition['username'] = array('eq',$username);
        import('@.ORG.RBAC');
        $authInfo = RBAC::authenticate($condition,'Admin');
        //使用用户名、密码和状态的方式进行认证
        if (false === $authInfo) {
            $this->error(L('empty_userid'));
        } else {
            if($authInfo['password'] != sysmd5($_POST['password'])) {
                $this->error(L('password_error'));
            }
            $_SESSION['username'] = $authInfo['username'];
            $_SESSION['adminid'] = $_SESSION['userid'] = $authInfo['id'];
            $_SESSION['roleid'] = $authInfo['role_id'];
            $_SESSION['adminaccess'] = C('ADMIN_ACCESS');
            $_SESSION[C('USER_AUTH_KEY')] = $authInfo['id'];
            $_SESSION['email'] = $authInfo['email'];
            $_SESSION['lastLoginTime'] = $authInfo['last_logintime'];
            $_SESSION['login_count'] = $authInfo['login_count']+1;

            if($authInfo['role_id']==1) {
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
            if ($_POST['ajax']) {
                $authInfo['info'] = '登陆成功';
                $this->ajaxReturn($authInfo);
            } else {
                $this->assign('jumpUrl',U('index/index'));
                $this->success('登陆成功');
            }
        }
    }

    function lostpassword()
    {
        if(IS_POST){
            $yzh_auth = authcode($uid."-".$username."-".$email, 'ENCODE',$this->sysConfig['ADMIN_ACCESS'],3600*24*3);//3天有效期
            $url = 'http://'.$_SERVER['HTTP_HOST'].U('User/Login/regcheckemail?code='.$yzh_auth);

            $click = "<a href=\"$url\" target=\"_blank\">".L('CLICK_THIS')."</a>";

            $message = str_replace(array('{click}','{url}','{sitename}'),array($click,$url,$this->Config['site_name']),$this->member_config['member_emailchecktpl']);

            $r = sendmail($email,L('USER_REGISTER_CHECKEMAIL').'-'.$this->Config['site_name'],$message,$this->Config);
            if($r){
                $this->assign('send_ok',1);
                $this->assign('username',$username);
                $this->assign('email',$email);
                $this->display('Login_emailcheck');
                exit;
            }

        }

        $this->display();
    }

    /**
     * 退出登录
     *
     */
    public function logout()
    {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {

            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->ajaxReturn('安全退出');
        }else {
            $this->assign('jumpUrl',U('login/index'));
            $this->error(L('logined'));
        }
    }

    function checkEmail()
    {
        $user = M('User');
        $email = $_GET['email'];

        $userid = intval($_GET['userid']);

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

    function check_verify($code, $id = '')
    {
            $verify = new \Think\Verify();
            return $verify->check($code, $id);
    }

    public function verify()
    {
        ob_clean();
        header("Content-type: image/png");
        $config =    array(
            // 'imageW'    =>    120,    // 验证码宽度
            // 'imageH'      =>    50,     // 验证码高度
            'length'=>4,
            'useNoise' => false,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

}