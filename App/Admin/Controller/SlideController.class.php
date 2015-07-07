<?php
namespace Admin\Controller;

class SlideController extends BaseController {

    protected  $Tplpath,$Flashpath,$Xmlpath;

    function _initialize() {
        parent::_initialize();
        $this->Tplpath = TMPL_PATH.'/Home/'.$this->sysConfig['DEFAULT_THEME'].'/';
        //$this->Flashpath = TMPL_PATH.$this->sysConfig['DEFAULT_THEME'].'/Public/flash/';
        $this->Xmlpath = TMPL_PATH.'/Home/'.$this->sysConfig['DEFAULT_THEME'].'/public/xml/';

        if(I('get.fid')==1){
            $this->assign('nav1','content');
            $this->assign('nav2','2');
        }
        if(I('get.fid')==2){
            $this->assign('nav1','wap');
            $this->assign('nav2','1');
        }
    }

    /**
     * 默认操作
     *
     */
    public function index() {
        $slide = M('Slide');
        if(empty($_REQUEST['where'])){
            $list = $slide->select();
        }else{
            $list = $slide->where($_REQUEST['where'])->select();
        }
        $this->assign('list', $list);
        $this->display();
    }

    function _before_add(){
        $Tpl = template_file('Slide');
        $this->assign('Tpl', $Tpl);
    }

    function _before_edit(){
        $Tpl = template_file('Slide');
        $this->assign('Tpl', $Tpl);
    }

    function edittpl(){
        $file = $this->Tplpath.'Slide_'.$_REQUEST['tpl'].'.html';
        if($_POST['content']){
            file_put_contents($file,htmlspecialchars_decode(stripslashes($_POST['content'])));
            $this->success(L('do_ok'));
        }else{
            $content = htmlspecialchars(file_get_contents($file));
            echo ' <form method="post" id="myform" action="'.U('Slide/edittpl').'">Slide_'.$_GET['tpl'].'.html<input type="hidden" name="tpl" value="'.$_GET['tpl'].'"/><textarea  name="content" id="content" style="width:100%;height:500px;"  >'.$content.'</textarea>  <input type="hidden" name="isajax" value="1" />
             <input name="dosubmit" type="submit" value="1" style="display:none;"class="hidden" id="dosubmit"> </form>';
        }
    }

    function picmanage(){
        $fid = intval($_REQUEST['fid']);
        if(!$fid){
            $this->error(L('do_empty'));
        }

        $map = array();
        if(APP_LANG){
            $map['lang'] = array('eq',LANG_ID);
        }

        $slide = D('Slide')->find($fid);

        $map['fid'] = array('eq',$fid);
        $list = D('slide_data')->where($map)->order("listorder ASC ,id DESC ")->select();
        $this->assign('list', $list);
        $this->assign('fid', $fid);
        $this->assign('slide', $slide);

        if(I('get.fid')==2){
            $this->display('Slide:picmanage_wap');
        }else{
            $this->display();
        }
    }

    function addpic()
    {
        $fid = intval($_REQUEST['fid']);
        if(!$fid) $this->error(L('do_empty'));
        $map = array();
        if(APP_LANG){
            $map['lang']=array('eq',LANG_ID);
        }

        $slide = D('slide')->find($id);
        $map['fid']=array('eq',$id);
        $list = D('slide_data')->where($map)->order(" listorder ASC ,id DESC ")->select();


        $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
        $yzh_auth = authcode('1-1-0-10-jpeg,jpg,png,gif-5-230', 'ENCODE',$yzh_auth_key);
        $this->assign('yzh_auth',$yzh_auth);

        $vo['status'] = 1;
        $this->assign('vo', $vo);
        $this->assign('list', $list );
        $this->assign('fid', $fid );
        $this->assign('slide', $slide );

        $this->display('Slide:editpic');

    }

    function editpic()
    {
        $id=intval($_REQUEST['id']);
        $fid=intval($_REQUEST['fid']);
        if(!$id) $this->error(L('do_empty'));
        $slide = D('Slide')->find($fid);

        //isadmin,more,isthumb,file_limit,file_types,file_size,moduleid,
        $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
        $yzh_auth = authcode('1-1-0-10-jpeg,jpg,png,gif-5-230', 'ENCODE',$yzh_auth_key);
        $this->assign('yzh_auth',$yzh_auth);

        $vo = D('slide_data')->find($id);
        $this->assign ( 'fid', $fid );
        $this->assign ( 'vo', $vo );
        $this->assign ( 'slide', $slide );

        if(I('get.fid')==2){
            $this->display('Slide:editpic_wap');
        }else{
            $this->display();
        }

    }

    function insertpic(){

        if(APP_LANG)
            $_POST['lang']=LANG_ID;
        //if($_POST['setup']) $_POST['setup']=array2string($_POST['setup']);
        $name = 'Slide_data';
        $model = D ($name);
        if (false === $model->create ()) {
            $this->error ( $model->getError () );
        }
        $_POST['id'] = $id= $model->add();
        if ($id !==false) {

            if($_POST['aid']){
                $Attachment =M('attachment');
                $aids =  implode(',',$_POST['aid']);
                $data['id']= $_POST['id'];
                $data['catid']= $_POST['fid'];
                $data['status']= '1';
                $Attachment->where("aid in (".$aids.")")->save($data);
            }

            $this->assign ( 'jumpUrl', U('slide/picmanage?fid='.$_POST['fid']) );
            $this->success (L('add_ok'));
        } else {
            $this->error (L('add_error').': '.$model->getDbError());
        }
    }

    function updatepic(){

        $model = D('slide_data');
        if (false === $model->create ()) {
            $this->error($model->getError());
        }

        if (false !== $model->save ()) {

            if($_POST['aid']){
                $Attachment = M('attachment');
                $aids = implode(',',$_POST['aid']);
                $data['id']= $_POST['id'];
                $data['catid']= $_POST['fid'];
                $data['status']= '1';
                $Attachment->where("aid in (".$aids.")")->save($data);
            }
            $this->assign( 'jumpUrl', U('Slide/picmanage','&fid='.$_POST['fid']));
            $this->success(L('edit_ok'));
        } else {
            $this->success(L('edit_error').': '.$model->getDbError());
        }
    }

    function param() {
        $files = glob(LANG_NAMEpath.'*');
        $lang_files=array();
        foreach($files as $key => $file) {
            //$filename = basename($file);
            $filename = pathinfo($file);
             $lang_files[$key]['filename'] = $filename['filename'];
            $lang_files[$key]['filepath'] = $file;
            $temp = explode('_',$filename);
            $lang_files[$key]['name'] = count($temp)>1 ? $temp[0].L('LANG_module') : L('LANG_common') ;
        }
        $this->assign ( 'id', $id );
        $this->assign ( 'lang', LANG_NAME );
        $this->assign ( 'files', $lang_files );
        $this->display();

    }


    function listorder(){
        $name ='slide_data';
        $model = M ( $name );
        $pk = $model->getPk ();
        $ids = $_POST['listorders'];
        foreach($ids as $key=>$r) {
            $data['listorder']=$r;
            $model->where($pk .'='.$key)->save($data);
        }
        $this->success (L('do_ok'));

    }


    function delete(){
        $name = MODULE_NAME;
        $model = M( $name );
        $pk = $model->getPk ();
        $id = $_REQUEST [$pk];

        if (isset ( $id )) {
            if(false!==$model->delete($id)){
                $name ='slide_data';
                $model = M ( $name );
                $model->where("fid=".$id)->delete();
                delattach(array('moduleid'=>'230','catid'=>$id));
                $this->success(L('delete_ok'));
            }else{
                $this->error(L('delete_error').': '.$model->getDbError());
            }
        }else{
            $this->error (L('do_empty'));
        }
    }

    function deletepic(){
        $model = M('slide_data');
        $pk = $model->getPk ();
        $id = $_REQUEST[$pk];

        if(isset($id)) {
            if(false!==$model->delete($id)){
                delattach(array('moduleid'=>'230','id'=>$id));
                $this->success(L('delete_ok'));
            }else{
                $this->error(L('delete_error').': '.$model->getDbError());
            }
        }else{
            $this->error(L('do_empty'));
        }
    }
}