<?php
namespace Admin\Controller;

use Think\Controller;
class MenuController extends BaseController {
    public $db;

    function _initialize()
    {
        parent::_initialize();
        $this->db = D('menu');
    }

    /**
     * 列表
     *
     */
    public function index()
    {
        $result = $this->menudata;

        foreach($result as $r) {
            $r['str_manage'] = '
            <a href="'.U('menu/add',array( 'parentid' => $r['id'])).'">添加子菜单</a> |
            <a href="'.U('menu/edit',array( 'id' => $r['id'])).'">修改</a> |
            <a href="javascript:confirm_delete(\''.U('Menu/delete',array( 'id' => $r['id'])).'\')">删除</a> ';
            $r['status'] ? $r['status']='<font color="green">启用</font>' : $r['status']='<font color="red">禁用</font>' ;
            $array[] = $r;
        }

        $str  = "<tr>
              <td width='40'><input name='listorders[\$id]' type='text' size='3' value='\$listorder'></td>
              <td>\$id</td>
              <td>\$spacer\$name</td>
              <td>\$status</td>
              <td>\$str_manage</td>
            </tr>";

        $tree = new \Org\Util\Tree($array);
        $tree->icon = array('│ &nbsp;&nbsp;&nbsp;', '├─ ', '└─');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $select_categorys = $tree->get_tree(0, $str);
        $this->assign('select_categorys', $select_categorys);
        $this->display();
    }

    /**
     * 提交
     *
     */
    function add()
    {
        $parentid = intval($_GET['parentid']);


        $result = $this->menudata;
        foreach($result as $r) {
            $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
            $array[] = $r;
        }

        $str  = "<option value='\$id' \$selected>\$spacer \$name</option>";

        $tree = new \Org\Util\Tree($array);
        $tree->icon = array('│ &nbsp;&nbsp;&nbsp;', '├─ ', '└─');
        $select_categorys = $tree->get_tree(0, $str,$parentid);
        $this->assign('select_categorys', $select_categorys);
        $this->display('edit');
    }

    function insert()
    {

        $name = CONTROLLER_NAME;

        $model = D('Menu');

        if (false === $model->create ()) {
          $this->error ( $model->getError () );
        }

        $id = $model->add();

        if ($id !==false) {

            savecache('Menu');

            if ($_POST['aid']) {

                $Attachment =M('attachment');
                $aids = implode(',',$_POST['aid']);
                $data['id']= $id;
                $data['catid']= intval($_POST['catid']);
                $data['status']= '1';
                $Attachment->where("aid in (".$aids.")")->save($data);
            }

            $this->assign ( 'jumpUrl',U('Menu/index'));
            $this->success (L('add_ok'));
        } else {
            $this->error (L('add_error').': '.$model->getDbError());
        }
    }

    function edit()
    {

        $id = intval($_GET['id']);;
        $vo = $this->menudata[$id];
        $parentid =  intval($vo['parentid']);

        $result = $this->menudata;
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
            $array[] = $r;
        }
        $str  = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree = new \Org\Util\Tree($array);
        $tree->icon = array('│ &nbsp;&nbsp;&nbsp;', '├─ ', '└─');
        $select_categorys = $tree->get_tree(0, $str,$parentid);
        $this->assign('select_categorys', $select_categorys);
        $this->assign('vo', $vo);
        $this->display();
    }

    /**
     * 删除
     *
     */
    function delete()
    {

        $model = M('Menu');
        $id = $_GET['id'];

        if (isset($id)) {

            if (false!==$model->delete($id)) {
                savecache('Menu');

                $this->assign('jumpUrl', U('Menu/index'));
                $this->success(L('delete_ok'));
            } else {
                $this->error(L('delete_error').': '.$model->getDbError());
            }
        } else {
            $this->error (L('do_empty'));
        }
    }

    /**
     * 批量删除
     *
     */
    function deleteall()
    {

        $model = M('Menu');
        $ids = $_POST['ids'];

        if (!empty($ids) && is_array($ids)) {

          $id = implode(',',$ids);

          if (false!==$model->delete($id)) {

            if(in_array($name,$this->cache_model)) savecache($name);

            if($this->moduleid)delattach("moduleid=$this->moduleid and id in($id)");

            if($name=='Order')M('Order_data')->where('order_id in('.$id.')')->delete();

            $this->success(L('delete_ok'));

            } else {
                $this->error(L('delete_error').': '.$model->getDbError());
            }
        }else{
            $this->error(L('do_empty'));
        }
    }

    function update()
    {

        $model = D('Menu');

        if (false === $model->create()) {
            $this->error($model->getError());
        }

        if (false !== $model->save()) {

            savecache('Menu');

            $this->assign('jumpUrl', U('Menu/index'));
            $this->success('修改成功');
        } else {
            $this->success(L('edit_error').': '.$model->getDbError());
        }
    }
}