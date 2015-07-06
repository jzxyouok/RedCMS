<?php
namespace Admin\Controller;
use Admin\Public;
class RoleAction extends AdminController {


    function _initialize() {
        parent::_initialize();
    }

    function add(){
        $access = M('Access');

        $node = M('Node');

        $r = $node->where("pid=0 and status=1")->select();

        $this->assign('topnode', $r);

        $groups[0] = array('id'=>0,'name'=>L('ACCESS_PUBLIC'));
        foreach($this->menudata as $key=>$r){
            if($r['parentid'] == 0)
            $groups[$r[id]]=$r;
        }
        $this->assign('groups', $groups);

        foreach($groups as $key=>$res){
            $result=$node->where("groupid=$res[id] and status=1")->select();
            $array=array();
            foreach($result as $r) {
                $r['parentid'] = $r['pid'];
                $array[] = $r;
            }
            $nodes[$res['id']]['data'] = $array;
            $nodes[$res['id']]['groupinfo'] = $res;
        }

        $node_app = $access->where("pid=0")->select();
        $this->assign('node_app', $node_app);

        $this->assign('alist', $alist);
        $this->assign('node', $nodes);

        $role = M('Role');
        $pk = ucfirst($role->getPk());
        $id = $_REQUEST[$role->getPk()];

        $do = 'getBy'.$pk;
        $vo = $role->$do( $id );

        if($vo['setup'])
            $vo['setup'] = string2array($vo['setup']);

        $this->assign('vo', $vo);
        $this->display();
    }


    function edit(){
        $access = M('Access');

        $rid = intval($_GET['id']);

        $alist = $access->where('role_id = '.$rid)->getField('node_id,role_id');

        $node = M('Node');

        $r = $node->where("pid=0 and status=1")->select();

        $this->assign('topnode', $r);

        $groups[0] = array('id'=>0,'name'=>L('ACCESS_PUBLIC'));

        foreach($this->menudata as $key=>$r){
            if($r['parentid'] == 0)
            $groups[$r[id]]=$r;
        }

        $this->assign('groups', $groups);

        foreach($groups as $key=>$res){
            $result=$node->where("groupid=$res[id] and status=1")->select();
            $array=array();
            foreach($result as $r) {
                $r['parentid'] = $r['pid'];
                $r['selected'] = array_key_exists($r['id'],$alist) ? 'checked' : '';
                $array[] = $r;
            }
            $nodes[$res['id']]['data'] = $array;
            $nodes[$res['id']]['groupinfo'] = $res;
        }

        $node_app = $access->where("pid=0")->select();
        $this->assign('node_app', $node_app);

        $this->assign('alist', $alist);
        $this->assign('node', $nodes);
        $this->assign('rid', $rid);


        $role = M('Role');
        $pk = ucfirst($role->getPk());
        $id = $_REQUEST[$role->getPk()];

        if(empty($id))
            $this->error(L('do_empty'));

        $do = 'getBy'.$pk;
        $vo = $role->$do( $id );

        if($vo['setup'])
            $vo['setup'] = string2array($vo['setup']);

        $this->assign('vo', $vo);
        $this->display();
    }

    function update(){
        $access = M('Access');

        if($_POST['setup'])
            $_POST['setup'] = array2string($_POST['setup']);


        $model = D('Role');

        if (false === $model->create ()) {
            $this->error( $model->getError () );
        }

        $id = $model->add();

        if ($id !==false) {

            if(in_array($name,$this->cache_model))
                savecache($name);

            if($_POST['aid']){

                $Attachment =M('attachment');
                $aids = implode(',',$_POST['aid']);
                $data['id']= $id;
                $data['catid']= intval($_POST['catid']);
                $data['status']= '1';
                $Attachment->where("aid in (".$aids.")")->save($data);
            }

            $jumpUrl = $_POST['forward'] ? $_POST['forward'] : U(MODULE_NAME.'/index');

            $this->assign ( 'jumpUrl',$jumpUrl );

        }


        $rid = $_POST['id'];
        $nid = $_POST['nid'];

        if(!empty($rid)){
            if($nid){

                $node_id=implode(',',$nid);
                $node=M('Node');
                $list=$node->where('id in('.$node_id.')')->select();
                $access->where('role_id = '.$rid)->delete();
                foreach($list as $key=> $node){
                    $data[$key]['role_id']=$rid;
                    $data[$key]['node_id']=$node['id'];
                    $data[$key]["level"]=$node['level'];
                    $data[$key]["pid"]=$node['pid'];
                }

                $r = $access->addAll($data);

            }else{

                $r = $access->where('role_id = '.$rid)->delete();
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
}