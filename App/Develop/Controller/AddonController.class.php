<?php

/**
 *
 * Config(系统配置文件)
 *
 */
namespace Develop\Controller;
use Think\Developbase;
class AddonController extends DevelopbaseController {

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


  public function ditu() {
    $this->assign('nav1','addon');
    $this->assign('nav2',9);
    $this->display();
  }

  public function liul() {

    $this->config = $this->db->select();

    foreach($this->config as $key=>$r) {
      if($r['groupid']==10)
        $this->liul_config[$r['varname']]=$r;

    }
    $this->assign('liul_config',$this->liul_config);
    $this->display();
  }


  public function insert() {

    if(APP_LANG)
      $_POST['lang']=LANG_ID;

    if(false === $this->db->create()) {
      $this->error ( $this->db->getError () );
    }
    //保存当前数据对象
    $list=$this->db->add ();
    savecache('Config');
    if ($list!==false) {
      $this->success (L('add_ok'));
    }else{
      $this->error (L('add_error'));
    }
  }

  public function member() {

    if(APP_LANG)$where = ' and lang='.LANG_ID;
    $config = $this->db->where("groupid=3".$where)->select();
    $this->assign('member_config',$config);
    $this->display();
  }

  public function mail() {
    $this->display();
  }

  public function dosite() {
    if(C('TOKEN_ON') && !$this->db->autoCheckToken($_POST))
      $this->error (L('_TOKEN_ERROR_'));

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