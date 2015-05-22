<?php
/**
 *
 * Product
 *
 */
namespace Develop\Controller;
use Think\Developbase;
class ProductAction extends ContentAction {

  public function _initialize() {
    parent::_initialize();

  }

  public function batch(){

    if($_POST['plist']){
      if(MODULE_NAME!='Product') return '';
      $model = $this->db;

      $lang=$_POST['lang'];
      $forward=$_POST['forward'];
      $hash=$_POST['__hash__'];
      unset($_POST['lang']);
      unset($_POST['forward']);
      unset($_POST['__hash__']);

      foreach($_POST['plist'] as $insert){
        $insert['lang']=$lang;
        $insert['__hash__']=$hash;
        $insert['forward']=$forward;
        $insert = checkfield($this->fields,$insert);
        $insert['createtime'] = time();
        $insert['updatetime'] = $insert['createtime'];
        $insert['userid'] = $module ? $userid : $_SESSION['userid'];
        $insert['username'] = $module ? $username : $_SESSION['username'];

        $id= $model->add($insert);

        if($insert['aid']){
          $Attachment =M('Attachment');
          $aids =  implode(',',$insert['aid']);
          $data['id']=$id;
          $data['catid']= $insert['catid'];
          $data['status']= '1';
          $Attachment->where("aid in (".$aids.")")->save($data);
        }
        $data='';
        $cat = $this->categorys[$insert['catid']];
        $url = geturl($cat,$insert,$this->Urlrule);
        $data['id']= $id;
        $data['url']= $url[0];
        $model->save($data);

      }//end foreach

      $this->success (L('add_ok'));
    }

    $this->display();
  }

  public function import() {
    $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
    $yzh_auth = authcode('1-0-0-1-csv-2-3', 'ENCODE',$yzh_auth_key);
    $this->assign('yzh_auth',$yzh_auth);

    $this->display();
  }
}