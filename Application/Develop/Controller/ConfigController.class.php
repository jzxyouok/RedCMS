<?php
/**
 *
 * Config(系统配置文件)
 *
 */
class ConfigController extends DevelopbaseController {

  protected $db;
  protected $config;
  protected $seo_config;
  protected $user_config;
  protected $weibo_config;
  protected $ditu_config;
  protected $liul_config;
  protected $shouji_config;
  protected $site_config;
  protected $mail_config;
  protected $attach_config;

  function _initialize() {
    parent::_initialize();
    $this->db = M('config');
    $this->assign($this->Config);
  }

  public function index() {

    $config = $this->db->select();
    foreach($config as $key=>$r) {
      if($r['groupid']==1)
        $this->weibo_config[$r['varname']]=$r;
    }

    $this->assign('weibo_config',$this->weibo_config);

    foreach($config as $key=>$r) {

      if($r['groupid']==2){
        if(APP_LANG){
          if($r['lang']==LANG_ID)
            $this->site_config[$r['varname']]=$r;
        }else{
          $this->site_config[$r['varname']]=$r;
        }
      }
    }
    $sysconfig = F("sys.config");
    $Urlrule=array();
    foreach((array)$this->Urlrule as $key => $r){
      $urls=$r['showurlrule'].':::'.$r['listurlrule'];
      if(empty($r['ishtml']))$Urlrule[$urls]=L('URL_SHOW_URLRULE').":".$r['showexample'].", ".L('URL_LIST_URLRULE').":".$r['listexample'];
    }
    $this->assign('Urlrule',$Urlrule);

    $this->assign('Lang',F('Lang'));
    $this->assign('yesorno',array(0 => L('no'),1  => L('yes')));
    $this->assign('openarr',array(0 => L('close_select'),1  => L('open_select')));
    $this->assign('enablearr',array(0 => L('disable'),1  => L('enable')));
    $this->assign('urlmodelarr',array(0 => L('URL_MODEL0').'(m=module&a=action&id=1)',1  => L('URL_MODEL1').'(index.php/Index_index_id_1)',2 => L('URL_MODEL2').'(Index_index_id_1)' ,3=>L("URL_MODEL3") ));
    $this->assign('readtypearr', array(0=>'readfile',1=> 'redirect'));
    $this->assign($sysconfig);
    $this->assign('site_config',$this->site_config);

    if(APP_LANG)$where = ' and lang='.LANG_ID;
    $config = $this->db->where("groupid=3".$where)->select();
    $this->assign('member_config',$config);

    $this->assign('nav1','system');
    $this->assign('nav2',1);
    $this->display();
  }

  public function liul() {

    $this->config = $this->db->select();

    foreach($this->config as $key=>$r) {
      if($r['groupid']==10)
        $this->liul_config[$r['varname']]=$r;

    }
    $this->assign('liul_config',$this->liul_config);
    $this->assign('nav1','addon');
    $this->assign('nav2',3);
    $this->display();
  }

  public function shouji() {

    $config = $this->db->select();

    foreach($config as $key=>$r) {
      if($r['groupid']==11)
        $this->shouji_config[$r['varname']]=$r;
    }

    $this->assign('shouji_config',$this->shouji_config);
    $this->assign('nav1','wap');
    $this->assign('nav2',1);
    $this->display();
  }

  public function add() {
    $this->display();
  }

  public function insert() {

    if(APP_LANG)
      $_POST['lang']=LANG_ID;

    if(false === $this->db->create()) {
      $this->error( $this->db->getError () );
    }
    //保存当前数据对象
    $list=$this->db->add ();
    savecache('Config');
    if ($list!==false) {
      $this->success(L('add_ok'));
    }else{
      $this->error(L('add_error'));
    }
  }


  public function dosite() {
    if(C('TOKEN_ON') && !$this->db->autoCheckToken($_POST))$this->error (L('_TOKEN_ERROR_'));

    if(APP_LANG && $_POST['site_name'])$where = ' and lang='.LANG_ID;
    foreach($_POST as $key=>$value){
      $data['value']=$value;
      $f = $this->db->where("varname='".$key."'".$where)->save($data);
    }
    $f = savecache(ucfirst(MODULE_NAME));
    if($_POST['DEFAULT_LANG'])routes_cache($_POST['URL_URLRULE']);

    if($f){
      $this->success(L('do_ok'));
    }else{
      $this->error (L('do_error'));
    }
  }

  public function testmail(){

    $mailto = $_GET['mail_to'];
    $message = 'test mail';
    $r = sendmail($mailto,$this->Config['site_name'],$message,$_POST);

    if($r==true){
      $this->ajaxReturn($r,L('mailsed_ok'),1);
    }else{
      $this->ajaxReturn(0,L('mailsed_error').$r,1);
    }
  }

}