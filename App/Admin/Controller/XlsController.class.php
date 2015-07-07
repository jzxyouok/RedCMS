<?php
/**
 *
 * Xls
 *
 */
namespace Admin\Controller;

class XlsController extends BaseController {

  protected $db,$fields;

  public function _initialize()  {
    parent::_initialize();
    $fields = F($this->moduleid.'_Field');
    $this->db = M(MODULE_NAME);
    foreach($fields as $key => $res){
      $res['setup']=string2array($res['setup']);
      $this->fields[$key]=$res;
    }
    unset($fields);
    unset($res);

    $this->assign ('fields',$this->fields);
  }

  public function index(){
    $template =  file_exists(THEME_PATH.MODULE_NAME.'_index.html') ? MODULE_NAME.':index' : 'Content:index';
    $count=$this->db->where ('status="1"')->count ();
      import ( "@.ORG.Page" );
    $p = new Page ( $count,15);

    $list=$this->db->field('partnumr,brand,datecode,pcs,id')->limit($p->firstRow . ',' . $p->listRows)->select();

    $this->assign ( 'list', $list);
    $this->assign ( 'page', $p->show());
        $this->display ($template);
  }

  public function import(){

    $this->display (MODULE_NAME.':import');
  }

  public function add() {
    $form=new Form();
    $this->assign ( 'form', $form );
    $template =  file_exists(THEME_PATH.MODULE_NAME.'_edit.html') ? MODULE_NAME.':edit' : 'Content:edit';
    $this->display ( $template);
  }

  function insert(){
    $rid=$_POST['rid'];
    $nid=$_POST['nid'];

    if(!empty($rid)){
      if($nid){

        $node_id=implode(',',$nid);
        $node=M('Node');
        $list=$node->where('id in('.$node_id.')')->select();
        $this->db->where('role_id = '.$rid)->delete();
        foreach($list as $key=> $node){
          $data[$key]['role_id']=$rid;
          $data[$key]['node_id']=$node['id'];
          $data[$key]["level"]=$node['level'];
          $data[$key]["pid"]=$node['pid'];
        }

        $r=$this->db->addAll($data);

      }else{

        $r= $this->db->where('role_id = '.$rid)->delete();
      }
      if(false!==$r){
        $this->success(L('role_ok'));
      }else{

        $this->error(L('role_error'));
      }

    }else{
      $this->error(L('do_empty'));
    }
  }

  public function edit() {

    $id = $_REQUEST ['id'];

    $vo = $this->db->getById ($id);
    $vo['content'] = htmlspecialchars($vo['content']);
     $form=new Form($vo);

    $this->assign ( 'vo', $vo );
    $this->assign ( 'form', $form );
    $template =  file_exists(THEME_PATH.MODULE_NAME.'_edit.html') ? MODULE_NAME.':edit' : 'Content:edit';

    $this->display ($template);
  }

  public function export(){

    $kj=0;
    foreach($this->fields as $k=>$v){
     $kj=$kj+1;
     if($kj<5){
     $header[]=strtoupper($k);
         }
    }
    $fields=implode(',',$header);

    $lines=$this->db->field($fields)->select();

    import("@.ORG.Xls");
    $xlsDoc = new xlsDocument('elec6197-BFSTOCK');

    $xlsDoc->output($header, $lines);
     exit;
  }
}