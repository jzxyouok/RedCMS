<?php

namespace Admin\Controller;
use Admin\Adminbase;
class FieldAction extends AdminbaseAction {

  protected $db,$moduleid;

  function _initialize() {
    parent::_initialize();
    $this->moduleid = intval($_REQUEST ['moduleid']);
    $this->assign('moduleid', $this->moduleid);
    $this->db = D('Field');
    $field_pattern = array(
      '0'           => L(please_chose),
      'email'       => L(pattern_email),
      'url'         => L(pattern_url),
      'date'        => L(pattern_date),
      'number'      => L(pattern_number),
      'digits'      => L(pattern_digits),
      'creditcard'  => L(pattern_creditcard),
      'equalTo'     => L(pattern_equalTo),
      'ip4'         => L(pattern_ip4),
      'mobile'      => L(pattern_mobile),
      'zipcode'     => L(pattern_zipcode),
      'qq'          => L(pattern_qq),
      'idcard'      => L(pattern_idcard),
      'chinese'     => L(pattern_chinese),
      'cn_username' => L(pattern_cn_username),
      'tel'         => L(pattern_tel),
      'english'     => L(pattern_english),
      'en_num'      => L(pattern_en_num),
    );
    $this->assign('field_pattern', $field_pattern);
    $this->assign('options', array(1=>L('yes'),0=>L('no')));
    $role = F('Role');
    foreach((array)$role as $key=>$c){
      $usergroup[$key]=$c['name'];
    }
    $this->assign('usergroup', $usergroup);
  }

  public function index(){
    $this->assign('sysfield',array('catid','userid','username','title','thumb','keywords','description','posid','url'));
    $this->assign('nodostatus',array('catid','title','status','createtime'));
    $list = $this->db->where("moduleid=".$this->moduleid)->order('listorder ASC')->select();
    $this->assign('list', $list);
    $this->assign('nav1',1);
    $this->assign('nav2',5);
    $this->display();
  }


  public function _before_add(){
    if(empty($this->moduleid))$this->error(L('do_empty'));
    if($_GET['isajax']){
      $this->assign($_GET);
      $this->assign($_POST);
      $this->display('type');
      exit;
    }
  }

  function delete() {
    $id = intval($_GET['id']);
    $r = $this->db->find($id);
    if(empty($r))
      $this->error(L('do_empty'));

    $moduleid = $r['moduleid'];
    $field = $r['field'];
    $tablename = C('DB_PREFIX').strtolower($this->module[$moduleid]['name']);
    //echo "ALTER TABLE `$tablename` DROP `$field`";exit;
    $this->db->execute("ALTER TABLE `$tablename` DROP `$field`");
    $this->db->delete($id);
    savecache(MODULE_NAME,$moduleid);
    $this->success (L('delete_ok'));
  }

  public function status(){
    $id =intval($_GET['id']);
    if($this->db->save($_GET)){
      $r = $this->db->find($id);
      savecache(MODULE_NAME,$r['moduleid']);
      $this->success(L('do_ok'));
    }else{
      $this->error(L('do_error'));
    }
  }

  function insert() {
    if($_GET['isajax']){//检测字段是否已经存在
      $name=$_GET['field'];
      $moduleid=intval($_GET['moduleid']);
      $tablename=C('DB_PREFIX').$this->module[$moduleid]['name'];
      $db=D('');
      $db =   DB::getInstance();
      $tables = $db->getTables();
      $Fields=$db->getFields($tablename);
      foreach ( $Fields as $key =>$r){
        if($key==$name) $ishave=1;
      }
      if($ishave) { echo 'false';}else{echo 'true';}
      exit;
    }
    $addfieldsql =$this->get_tablesql($_POST,'add');
    if($_POST['setup']) $_POST['setup']=array2string($_POST['setup']);
    $_POST['unpostgroup'] = $_POST['unpostgroup'] ?  implode(',',$_POST['unpostgroup']) : '';
    $_POST['status'] =1;
    $name = MODULE_NAME;
    $model = D ($name);
    if (false === $model->create ()) {
      $this->error ( $model->getError () );
    }
    if ($model->add() !==false) {
      savecache(MODULE_NAME,$_POST['moduleid']);

      if(is_array($addfieldsql)){
        foreach($addfieldsql as $sql){
        $model->execute($sql);
        }
      }else{
        if($addfieldsql)$model->execute($addfieldsql);
      }
      $this->assign ( 'jumpUrl', U(MODULE_NAME.'/index',array('moduleid' => $this->moduleid))) ;
      $this->success (L('add_ok'));
    } else {
      $this->error (L('add_error').': '.$model->getDbError());
    }
  }

  function update() {
    $editfieldsql =$this->get_tablesql($_POST,'edit');
    if($_POST['setup']) $_POST['setup']=array2string($_POST['setup']);
    $_POST['unpostgroup'] = $_POST['unpostgroup'] ?  implode(',',$_POST['unpostgroup']) : '';
    $name = MODULE_NAME;
    $model = D ( $name );
    if (false === $model->create ()) {
      $this->error ( $model->getError () );
    }
    if (false !== $model->save ()) {
      savecache(MODULE_NAME,$_POST['moduleid']);
      if(is_array($editfieldsql)){
        foreach($editfieldsql as $sql){
        $model->execute($sql);
        }
      }else{
        $r=$model->execute($editfieldsql);
      }
      $this->success (L('edit_ok'));
    } else {
      $this->success (L('edit_error').': '.$model->getDbError());
    }
  }

  public function _before_edit(){
    if(empty($this->moduleid))
      $this->error(L('do_empty'));
  }


  public function get_tablesql($info,$do){

    $fieldtype = $info['type'];
    if($info['setup']['fieldtype']){
      $fieldtype=$info['setup']['fieldtype'];
    }
    $moduleid = $info['moduleid'];
    $default = $info['setup']['default'];
    $field = $info['field'];
    $tablename = C('DB_PREFIX').strtolower($this->module[$moduleid]['name']);
    $maxlength = intval($info['maxlength']);
    $minlength = intval($info['minlength']);
    $numbertype = $info['setup']['numbertype'];
    $oldfield = $info['oldfield'];

    if($do == 'add'){
      $do = ' ADD ';
    }else{
      $do = " CHANGE `$oldfield` ";
    }


    switch($fieldtype) {
      case 'varchar':
        if(!$maxlength) $maxlength = 255;
        $maxlength = min($maxlength, 255);
        $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( $maxlength ) NOT NULL DEFAULT '$default'";
      break;

      case 'title':
        if(!$maxlength) $maxlength = 255;
        $maxlength = min($maxlength, 255);
        $sql[] = "ALTER TABLE `$tablename` $do `title` VARCHAR( $maxlength ) NOT NULL DEFAULT '$default'";
        $sql[] = "ALTER TABLE `$tablename` $do `title_style` VARCHAR( 40 ) NOT NULL DEFAULT ''";
        $sql[] = "ALTER TABLE `$tablename` $do `thumb` VARCHAR( 100 ) NOT NULL DEFAULT ''";
      break;

      case 'catid':
        $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'";
      break;

      case 'number':
        $decimaldigits = $info['setup']['decimaldigits'];
        $default = $decimaldigits == 0 ? intval($default) : floatval($default);
        $sql = "ALTER TABLE `$tablename` $do `$field` ".($decimaldigits == 0 ? 'INT' : 'decimal( 10,'.$decimaldigits.' )')." ".($numbertype ==1 ? 'UNSIGNED' : '')."  NOT NULL DEFAULT '$default'";
      break;

      case 'tinyint':
        if(!$maxlength) $maxlength = 3;
        $maxlength = min($maxlength,3);
        $default = intval($default);
        $sql = "ALTER TABLE `$tablename` $do `$field` TINYINT( $maxlength ) ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
      break;


      case 'smallint':
        $default = intval($default);
        if(!$maxlength) $maxlength = 8;
        $maxlength = min($maxlength,8);
        $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT( $maxlength ) ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
      break;

      case 'int':
        $default = intval($default);
        $sql = "ALTER TABLE `$tablename` $do `$field` INT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
      break;

      case 'mediumint':
        $default = intval($default);
        $sql = "ALTER TABLE `$tablename` $do `$field` INT ".($numbertype ==1 ? 'UNSIGNED' : '')." NOT NULL DEFAULT '$default'";
      break;

      case 'mediumtext':
        $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
      break;

      case 'text':
        $sql = "ALTER TABLE `$tablename` $do `$field` TEXT NOT NULL";
      break;

      case 'posid':
        $sql = "ALTER TABLE `$tablename` $do `$field` TINYINT(2) UNSIGNED NOT NULL DEFAULT '0'";
      break;

      case 'typeid':
        $sql = "ALTER TABLE `$tablename` $do `$field` SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0'";
      break;

      case 'datetime':
        $sql = "ALTER TABLE `$tablename` $do `$field` INT(11) UNSIGNED NOT NULL DEFAULT '0'";
      break;

      case 'editor':
        $sql = "ALTER TABLE `$tablename` $do `$field` TEXT NOT NULL";
      break;

      case 'image':
        $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
      break;

      case 'images':
        $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
      break;

      case 'file':
        $sql = "ALTER TABLE `$tablename` $do `$field` VARCHAR( 80 ) NOT NULL DEFAULT ''";
      break;

      case 'files':
        $sql = "ALTER TABLE `$tablename` $do `$field` MEDIUMTEXT NOT NULL";
      break;
    }
    return $sql;
  }

}