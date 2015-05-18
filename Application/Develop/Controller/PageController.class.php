<?php

class PageController extends ContentController {

  public function _initialize() {
    parent::_initialize();

    $fields = F($this->moduleid.'_Field');

    foreach($fields as $key => $res){
      $res['setup']=string2array($res['setup']);
      $data[$key]=$res;
    }

    $this->assign ('fields',$data);
  }

  /**
   * 列表
   *
   */
  public function index() {

    $data = array();
    $data_ids = D('Page')->field('id')->select();
    $ids=array();
    foreach($data_ids as $data_id){
      $ids[]=$data_id['id'];
    }

    foreach($this->categorys as $d){
      if(($d['module']=='Page'&&$d['parentid']==0)||($d['parentid']==0&&$d['moduleid']==0)){
        $parent[]=$d['id'];
        $parent_no[]=$d['moduleid']==0?$d['id']:'';
      }
    }

    foreach($parent as $p){
      $ps = explode(',',$this->categorys[$p]['arrchildid']);
      foreach($ps as $pc){
        if($this->categorys[$pc]['module']!='Page')
          continue;
        if(!in_array($pc,$parent_no)){
          $action = in_array($pc,$ids)?'edit':'add';
          $data[] = array('catname'=>$this->categorys[$pc]['catname'],'id'=>$pc,'action'=>$action);
        }
      }
    }

    $this->assign ('list',$data);
    $this->display();
  }

  /**
   * 添加
   *
   */
  function add() {
    $r = M('Category')->find($_GET['id']);
    $vo = array();
    $vo['title'] = $r['catname'];
    $vo['content'] = '';
    $this->assign('vo',$vo);
    $this->display('edit');
  }

  public function edit() {

    $id = $_REQUEST['id'];

    if(MODULE_NAME=='Page'){

      $Page=D('Page');
      $p = $Page->find($id);

      if(empty($p)){
        $data['id']=$id;
        $data['title'] = $this->categorys[$id]['catname'];
        $data['keywords'] = $this->categorys[$id]['keywords'];
        $Page->add($data);
      }

    }

    $vo = $this->db->getById($id);

    $vo['content'] = htmlspecialchars($vo['content']);

    $form=new Form($vo);

    $this->assign('vo', $vo);
    $this->assign('form', $form);
    $template = file_exists(THEME_PATH.MODULE_NAME.'_edit.html') ? MODULE_NAME.':edit' : 'Content:edit';

    $this->display($template);
  }

}