<?php
namespace Develop\Controller;
use Think\Developbase;
class MemberController extends DevelopbaseController {

  public $db,$usergroup;

  function _initialize() {
    parent::_initialize();
    $this->db = D('User');
    $this->usergroup=F('Role');

      if($_SESSION['groupid']!=1){
      unset($this->usergroup[1]);
    }
    $this->assign('usergroup',$this->usergroup);
  }


  function index(){
    import('@.ORG.Page');

    $keyword=$_GET['keyword'];
    $searchtype=$_GET['searchtype'];
    $groupid =intval($_GET['groupid']);

    $this->assign($_GET);

    if(!empty($keyword) && !empty($searchtype)){
      $where[$searchtype]=array('like','%'.$keyword.'%');
    }
    if($groupid)$where['groupid']=$groupid;

    $user=$this->db;
    $count=$user->where($where)->count();
    $page=new Page($count,20);
    $show=$page->show();
    $this->assign("page",$show);
    $list=$user->order('id')->where($where)
    ->limit($page->firstRow.','.$page->listRows)->select();
        if($_SESSION['groupid']!=1){
      unset($list[0]);
    }
    $this->assign('ulist',$list);
    $this->display();
  }

  function insert(){
    $user=$this->db;
    $_POST['password'] = sysmd5($_POST['pwd']);
    if($data=$user->create()){
      if(false!==$user->add()){
        $uid=$user->getLastInsID();
        $ru['role_id']=$_POST['groupid'];
        $ru['user_id']=$uid;
        $roleuser=M('RoleUser');
        $roleuser->add($ru);
        $this->success(L('add_ok'));
      }else{
        $this->error(L('add_error'));
      }
    }else{
      $this->error($user->getError());
    }
  }

  function update(){
    $user=$this->db;
    $_POST['password'] = $_POST['pwd'] ? sysmd5($_POST['pwd']) : $_POST['opwd'];
    if($data=$user->create()){
      if(!empty($data['id'])){
        if(false!==$user->save()){
          $ru['user_id']=$_POST['id'];
          $ru['role_id']=$_POST['groupid'];
          $roleuser=M('RoleUser');
          $roleuser->where('user_id='.$_POST['id'])->delete();
          $roleuser->where('user_id='.$_POST['id'])->add($ru);
          $this->success(L('edit_ok'));
        }else{
          $this->error(L('edit_error').$user->getDbError());
        }
      }else{
        $this->error(L('do_error'));
      }
    }else{
      $this->error($user->getError());
    }
  }


  function _before_add(){
    $this->assign('rlist',$this->usergroup);
  }

  function _before_edit(){
    $this->assign('rlist',$this->usergroup);
  }


  function delete(){
    $id=$_GET['id'];
    $user=$this->db;
    if(false!==$user->delete($id)){
      $roleuser=M('RoleUser');
      $roleuser->where('user_id ='.$id)->delete();
      delattach(array('moduleid'=>0,'catid'=>0,'id'=>0,'userid'=>$id));
      $this->success(L('delete_ok'));
    }else{
      $this->error(L('delete_error').$user->getDbError());
    }
  }

  function deleteall(){
    $ids=$_POST['ids'];
    if(!empty($ids) && is_array($ids)){
      $user=$this->db;
      $id=implode(',',$ids);
      if(false!==$user->delete($id)){
        $roleuser=M('RoleUser');
        $roleuser->where('user_id in('.$id.')')->delete();
        delattach("moduleid=0 and catid=0 and id=0 and userid in($id)");
        $this->success(L('delete_ok'));
      }else{
        $this->error(L('delete_error'));
      }
    }else{
      $this->error(L('do_empty'));
    }
  }
}