<?php
namespace Org\Util;
use Think\Think;
class Online extends Think {

  protected $lifeTime='1800' ,$sessionid='' ,$db;


  public function __construct(&$params='') {
    $this->lifeTime = C('EXPIRE_TIME') ?  C('EXPIRE_TIME') : 1800;

    if($_COOKIE['ww_onlineid']){
      $this->sessionid = $_COOKIE['ww_onlineid'];
    }else{
      $this->sessionid = substr(MD5(session_id()), 0, 32);
      cookie('onlineid',$this->sessionid,0);
    }
    $this->db = M('Online');

    $this->write($this->sessionid);
    $this->gc($this->lifeTime);
  }

  public function open($savePath, $sessName) {
    return true;
  }

  public function close() {
    return $this->gc($this->lifetime);
  }

  public function read($sessID) {
    $r = $this->db->find($sessID);
    return $r ? $r['data'] : '';
  }

  public function write($sessID,$sessData) {
    $ip = get_client_ip();
    $username = $_COOKIE['ww_username'] ? $_COOKIE['ww_username'] : '';
    $groupid = $_COOKIE['ww_groupid'] ? intval($_COOKIE['ww_groupid']) : 4;
    $sessiondata = array(
              'sessionid'=>$sessID,
              'userid'=>intval($_COOKIE['ww_userid']),
              'username'=>$username,
              'ip'=>$ip,
              'lastvisit'=>time(),
              'groupid'=> $groupid,
              'data'=> '',
    );
    return $this->db->add($sessiondata,'',true);
  }


  public function destroy($sessID) {
    return $this->db->delete($this->sessionid);
  }

  public function gc($sessMaxLifeTime) {
    $expiretime = time() -$sessMaxLifeTime;
    $r = $this->db->where(" lastvisit < $expiretime")->delete();
    return $r;
  }

}