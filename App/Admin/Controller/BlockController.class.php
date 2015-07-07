<?php

namespace Admin\Controller;
use Org\Util\Page;
class BlockController extends BaseController {

    function _initialize() {
        parent::_initialize();
        $pos = !empty($_REQUEST['pos'])?$_REQUEST['pos']:'';

        if($pos == 'wap_youshi'){
        $this->assign('nav1','wap');
        $this->assign('nav2',3);
        }

        if($pos == 'wap_about_index'){
        $this->assign('nav1','wap');
        $this->assign('nav2',4);
        }

    }


    public function index() {

        if(APP_LANG)
        $map['lang']=array('eq',LANG_ID);

        $modelname = CONTROLLER_NAME;
        $map = '';
        $sortBy = '';
        $asc = false;
        $listRows = 15;
        $model = M($modelname);
        $id = $model->getPk();
        $this->assign('pkid', $id );
        if (isset ( $_REQUEST ['order'] )) {
            $order = $_REQUEST ['order'];
        } else {
            $order = !empty ( $sortBy ) ? $sortBy : $id;
        }

        if (isset ( $_REQUEST ['sort'])) {
            $_REQUEST ['sort']=='asc' ? $sort = 'asc' : $sort = 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }

        $_REQUEST['sort'] = $sort;
        $_REQUEST['order'] = $order;
        $keyword    = $_REQUEST['keyword'];
        $searchtype = $_REQUEST['searchtype'];
        $groupid    = intval($_REQUEST['groupid']);
        $catid      = intval($_REQUEST['catid']);
        $posid      = intval($_REQUEST['posid']);
        $typeid     = intval($_REQUEST['typeid']);

        if(APP_LANG)
            if($this->moduleid)
                $map['lang']=array('eq',LANG_ID);

        if(!empty($keyword) && !empty($searchtype)){
            $map[$searchtype]=array('like','%'.$keyword.'%');
        }

        if($groupid)
            $map['groupid']=$groupid;

        if($catid)
            $map['catid']=$catid;

        if($posid)
            $map['posid']=$posid;

        if($typeid)
            $map['typeid']=$typeid;

        $tables = $model->getDbFields();

        foreach($_REQUEST['map'] as $key=>$res){
            if( ($res==='0' || $res>0) || !empty($res) ){
                if($_REQUEST['maptype'][$key]){
                    $map[$key]=array($_REQUEST['maptype'][$key],$res);
                }else{
                    $map[$key]=intval($res);
                }
                $_REQUEST[$key]=$res;
            }else{
                unset($_REQUEST[$key]);
            }
        }
        $this->assign($_REQUEST);

        //取得满足条件的记录总数
        $count = $model->where ( $map )->count ( $id );//echo $model->getLastsql();

        if ($count > 0) {
            import ( "@.ORG.Page" );
            //创建分页对象
            if (! empty ( $_REQUEST ['listRows'] )) {
                $listRows = $_REQUEST ['listRows'];
            }

            $p = new Page ( $count, $listRows );

            //分页查询数据
            $field=$this->module[$this->moduleid]['listfields'];
            $field= (empty($field) || $field=='*') ? '*' : 'id,catid,url,posid,title,thumb,title_style,userid,username,hits,createtime,updatetime,status,listorder' ;
            $voList = $model->field($field)->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );

            //分页跳转的时候保证查询条件
            foreach ( $map as $key => $val ) {
                if (! is_array ( $val )) {
                    $p->parameter .= "$key=" . urlencode ( $val ) . "&";
                }
            }
            $map[C('VAR_PAGE')]='{$page}';

            $page->urlrule = U($modelname.'/index', $map);
            //分页显示
            $page = $p->show ();
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式

            //模板赋值显示
            $this->assign ( 'list', $voList );
            $this->assign ( 'page', $page );
        }
        $this->display();
    }

    public function _before_insert() {
        if(APP_LANG) {
            $_POST['lang']=LANG_ID;
        }
    }

    public function edit() {

        $pos = strip_tags($_REQUEST['pos']);
        $model = M('Block');
        $pk = ucfirst($model->getPk());
        $id = $_REQUEST[$model->getPk()];

        if(empty($id))
            $this->error(L('do_empty'));

        if($pos){
            $map['pos'] = array('eq',$pos);
            if(APP_LANG) {
                $map['lang']=array('eq',LANG_ID);
            }

            $vo = $model->where($map)->find();
        }else{
            $do='getBy'.$pk;
            $vo = $model->$do ( $id );
        }

        if($vo['setup']) {
            $vo['setup']=string2array($vo['setup']);
        }

        $this->assign('vo', $vo);
        $this->display();
    }


    function insert() {

        $model = D('Block');

        if (false === $model->create ()) {
            $this->error ( $model->getError () );
        }

        $id = $model->add();

        if ($id !==false) {

            if(in_array($name,$this->cache_model))
                savecache($name);

            if(in_array($_POST['pos'],array('wap_about','wap_about_index','wap_service','wap_recruitment','wap_contact')))
                $jumpUrl = $_POST['forward'];
            else
            $jumpUrl = U('Block/index');

            $this->assign ( 'jumpUrl',$jumpUrl );
            $this->success (L('add_ok'));
        } else {
            $this->error (L('add_error').': '.$model->getDbError());
        }
    }


    function delete(){

        $Block = M('Block');
        $pk = $Block->getPk();
        $id = $_REQUEST [$pk];

        if (isset( $id )) {

            if(false!==$Block->delete($id)){
                delattach(array('moduleid'=>'231','id'=>$id));
                $this->assign( 'jumpUrl', U(MODULE_NAME.'/index') );
                $this->success(L('delete_ok'));
            }else{
                $this->error(L('delete_error').': '.$Block->getDbError());
            }
        }else{
            $this->error (L('do_empty'));
        }
    }
}