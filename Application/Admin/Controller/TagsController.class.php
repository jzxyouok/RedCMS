<?php
namespace Admin\Controller;
use Admin\Adminbase;
class TagsController extends AdminbaseController {

  protected  $db,$fields;

  public function _initialize() {

    parent::_initialize();

    $this->db = D(CONTROLLER_NAME);

    $fields = F($this->moduleid.'_Field');
    foreach($fields as $key => $res){
      $res['setup'] = string2array($res['setup']);
      $this->fields[$key] = $res;
    }

    $this->assign('fields',$this->fields);
    $this->assign('module',$this->module);
  }

  function index(){

    $list = M('tags')->select();

    $this->assign('list',$list);
    $this->display();
  }

  /**
   * 更新
   *
   */
  function edit() {

    $model = M('Tags');
    $pk = ucfirst($model->getPk());
    $id = $_REQUEST[$model->getPk()];

    if(empty($id))
      $this->error(L('do_empty'));

    $do = 'getBy'.$pk;
    $vo = $model->$do( $id );

    if($vo['setup'])
      $vo['setup'] = string2array($vo['setup']);

    $this->assign('vo', $vo);

    $this->display();
  }

}