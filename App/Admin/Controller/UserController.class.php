<?php
/**
 */
namespace Admin\Controller;
use Admin\Public;
class UserController extends AdminController {

    public $usergroup;

    function _initialize(){
        parent::_initialize();

        $this->usergroup = F('Role');

        if($_SESSION['groupid']!=1){
            unset($this->usergroup[1]);
        }

        $this->assign('usergroup',$this->usergroup);
    }

    function index(){

        $keyword = $_GET['keyword'];
        $searchtype = $_GET['searchtype'];
        $groupid = intval($_GET['groupid']);

        $this->assign($_GET);

        if(!empty($keyword) && !empty($searchtype)){
            $where[$searchtype]=array('like','%'.$keyword.'%');
        }

        if($groupid)$where['groupid']=$groupid;

        $user = D('Admin');
        $count = $user->where($where)->count();
        $page = new \Org\Util\Page($count,20);
        $show =$page->show();
        $this->assign("page",$show);

        $list = $user->order('id')->where($where)->limit($page->firstRow.','.$page->listRows)->select();

        if($_SESSION['groupid']!=1){
            unset($list[0]);
        }

        $this->assign('ulist',$list);
        $this->display();
    }


    function _before_add(){
        $this->assign('rlist',$this->usergroup);
    }
    /**
     * 添加
     *
     */
    function add() {
        $this->display();
    }

    function insert(){
        $user = D('Admin');

/*    if(empty($_POST['password'])){
            $this->error('密码不能为空');
        }elseif($_POST['password']!=$_POST['repassword']){
            $this->error('两次密码不一致');
        }else{
            $_POST['password'] = sysmd5($_POST['password']);
        }
        */
        if($data = $user->create()){
            if(false!==$user->add()){
                $uid = $user->getLastInsID();
                $ru['role_id'] = $_POST['groupid'];
                $ru['user_id'] = $uid;
                $roleuser = M('RoleUser');
                $roleuser->add($ru);
                $data['status'] = 1;
                $data['info'] = L('add_ok');
                $this->ajaxReturn($data);
            }else{
                $this->error(L('add_error'));
            }
        }else{
            $this->error($user->getError());
        }
    }


    function _before_edit(){
        $this->assign('rlist',$this->usergroup);
    }

    /**
     * 更新
     *
     */
    function edit() {

        $model = M('Admin');
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

    function update(){
        $user = D('Admin');

        if(empty($_POST['pwd'])){
            $_POST['password'] = $_POST['opwd'];
        }elseif($_POST['pwd']!=$_POST['repwd']){
            $this->error('两次密码不一致');
        }else{
            $_POST['password'] = sysmd5($_POST['pwd']);
        }

        if($data=$user->create()){
            if(!empty($data['id'])){
                if(false!==$user->save()){
                    $ru['user_id']=$_POST['id'];
                    $ru['role_id']=$_POST['groupid'];
                    $roleuser=M('RoleUser');
                    $roleuser->where('user_id='.$_POST['id'])->delete();
                    $roleuser->where('user_id='.$_POST['id'])->add($ru);
                    $data['status']=1;
                    $this->ajaxReturn($data);
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


    function delete(){
        $id=$_GET['id'];
        $user=D('Admin');
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
            $user=D('Admin');
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