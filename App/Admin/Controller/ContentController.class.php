<?php

namespace Admin\Controller;
use Admin\Adminbase;
class ContentController extends AdminbaseController {

  protected  $db,$fields;

  public function _initialize() {

    parent::_initialize();

    $this->db = D(CONTROLLER_NAME);

    $fields = F($this->moduleid.'_Field');

    foreach($fields as $key => $res){
      $res['setup'] = string2array($res['setup']);
      $this->fields[$key] = $res;
    }

    unset($fields);
    unset($res);
    $this->assign('fields',$this->fields);
    $this->assign('module',$this->module);
  }

  /**
   * 列表
   *
   */
  public function index()  {
    $template = file_exists(MODULE_PATH.'View/Defalut/'.CONTROLLER_NAME.'/index.html') ? MODULE_NAME.':index' : 'Content:index';

    $m=$this->db->max('id');

    $maxid=empty($m)?0:$m;

    $this->assign('maxid',$maxid);

    $this->_list(CONTROLLER_NAME);

    $this->display($template);
  }


  public function add() {

    $form = new \Org\Util\Form();

    $this->assign('form', $form );

    $template = file_exists(MODULE_PATH.CONTROLLER_NAME.'/edit.html') ? MODULE_NAME.':edit' : 'Content:edit';

    $this->display($template);
  }


  public function edit() {

    $id = $_REQUEST['id'];

    $vo = $this->db->getById($id);

    if(MODULE_NAME == 'Resume'||MODULE_NAME =='Feedback'){
      $data['status']=1;
      $this->db->where('id='.$id)->save($data);
    }

    $vo['content'] = htmlspecialchars($vo['content']);

    $form = new \Org\Util\Form($vo);

    $this->assign($_REQUEST);
    $this->assign('vo', $vo);
    $this->assign('form', $form);
    $template = file_exists(MODULE_PATH.CONTROLLER_NAME.'/edit.html') ? MODULE_NAME.':edit' : 'Content:edit';

    $this->display($template);
  }


  /**
   * 录入
   *
   */
  public function insert($module='',$fields=array(),$userid=0,$username='',$groupid=0) {

    $model = $module ? M($module) : $this->db;

    $fields = $fields ? $fields : $this->fields ;

    if($fields['verifyCode']['status'] && (md5($_POST['verifyCode']) != $_SESSION['verify'])){
      $this->assign('jumpUrl','javascript:history.go(-1);');
      $this->error(L('error_verify'));
    }

    $_POST = checkfield($fields,$_POST);

    if(empty($_POST)){
      $this->ajaxReturn(L('do_empty'));
    }

    $_POST['createtime'] = time();
    $_POST['updatetime'] = $_POST['createtime'];
    $_POST['userid'] = $module ? $userid : $_SESSION['userid'];
    $_POST['username'] = $module ? $username : $_SESSION['username'];

    if($_POST['style_color']){
      $_POST['style_color'] = 'color:'.$_POST['style_color'];
    }

    if($_POST['style_bold']){
      $_POST['style_bold'] = ';font-weight:'.$_POST['style_bold'];
    }

    if($_POST['style_color'] || $_POST['style_bold'] ){
      $_POST['title_style'] = $_POST['style_color'].$_POST['style_bold'];
    }

    $module = $module? $module : MODULE_NAME ;

    if(GROUP_NAME=='user')
      $_POST['status'] = $this->Role[$groupid]['allowpostverify'] ? 1 : 0;

    if (false === $model->create()) {
      $this->error($model->getError());
    }

    $_POST['id'] = $id= $model->add();

    if ($id !==false) {

      $catid = $module =='Page' ? $id : $_POST['catid'];

      if($_POST['aid']) {

        $Attachment = M('attachment');

        $aids = implode(',',$_POST['aid']);
        $data['id']=$id;
        $data['catid']= $catid;
        $data['status']= '1';
        $Attachment->where("aid in (".$aids.")")->save($data);
      }


      $data='';
      $cat = $this->categorys[$catid];
      $url = geturl($cat,$_POST,$this->Urlrule);

      $data['id']= $id;
      $data['url']= $url[0];

      $model->save($data);

      if($_POST['keywords'] && $module !='Page'){
        $keywordsarr=explode(',',$_POST['keywords']);
        $i=0;

        $tagsdata =M('Tags_data');
        $tagsdata->where("id=".$id)->delete();

        foreach((array)$keywordsarr as $tagname){

          if($tagname){

            $tagidarr=$tagdatas=$where=array();
            $where['name']=array('eq',$tagname);
            $where['moduleid']=array('eq',$cat['moduleid']);
            $tagid=M('Tags')->where($where)->field('id')->find();
            $tagidarr['id']=$id;

            if($tagid){
              $num = $tagsdata->where("tagid=".$tagid[id])->count();
              $tagdatas['num']=$num+1;
              M('Tags')->where("id=".$tagid[id])->save($tagdatas);
              $tagidarr['tagid']=$tagid['id'];
            }else{
              $tagdatas['moduleid']=$cat['moduleid'];
              $tagdatas['name'] = $tagname;
              $tagdatas['slug'] = Pinyin($tagname);
              $tagdatas['num']=1;
              $tagdatas['lang']=$_POST['lang'];
              $tagdatas['module']= $cat['module'];
              $tagidarr['tagid']=M('Tags')->add($tagdatas);
            }
            $i++;
            $tagsdata->add($tagidarr);
          }
        }
      }

      if($cat['presentpoint']){
        $user =M('User');
        if($cat['presentpoint']>0)
          $user->where("id=".$_POST['userid'])->setInc('point',$cat['presentpoint']);

        if($cat['presentpoint']<0)
          $user->where("id=".$_POST['userid'])->setDec('point',$cat['presentpoint']);

      }


      if($cat['ishtml'] && $_POST['status']){

        if($module!='page' && $_POST['status'])
          $this->create_show($id,$module);

        if($this->sysConfig['HOME_ISHTML'])
          $this->create_index();

        $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

        foreach($arrparentid as $catid) {
          if($this->categorys[$catid]['ishtml'])  $this->clisthtml($catid);
        }
      }

      if(GROUP_NAME=='Admin'){
        $this->assign('jumpUrl', U($module.'/index') );
      }elseif(GROUP_NAME=='User'){
        $this->assign('jumpUrl',$_SERVER['HTTP_REFERER']);
        //$this->assign ( 'jumpUrl', U(GROUP_NAME.'-'.MODULE_NAME.'/add?moduleid='.$cat['moduleid']) );
      }

      $this->ajaxReturn(1);
    } else {
      $this->ajaxReturn(L('add_error').': '.$model->getDbError());
    }
  }

  // 空模块的ajax内容录入
  public function ajax_content_insert(){

    $id=intval(trim($_POST['id']));

    $data=$this->db->find($id);

    if($data){

      $_POST['updatetime'] = time();
      unset($_POST['id']);
      $sres=$this->db->save($_POST,array('where'=>'id="'.$id.'"'));
      $result['issu']=$sres? '更新成功' : '更新失败';

    }else{
      $_POST['createtime'] = time();
      $_POST['status'] = 1;
      $_POST['lang'] = LANG_ID;
      $r=$this->db->add($_POST);
      $result['issu']=$r? L('add_ok') : L('add_error');
    }

    echo json_encode($result);
    exit;
  }


  function update($module='',$fields=array(),$userid=0,$username='')  {

    $model = $module ? M($module) : $this->db;

    $fields = $fields ? $fields : $this->fields ;

    if($fields['verifyCode']['status'] && (md5($_POST['verifyCode']) != $_SESSION['verify'])){

      $this->assign('jumpUrl','javascript:history.go(-1);');

      $this->error(L('error_verify'));

    }

    $_POST = checkfield($fields,$_POST);

    if(!array_key_exists('posid',$_POST))
      $_POST['posid']=0;

    if(empty($_POST)) $this->error (L('do_empty'));

    $_POST['updatetime'] = time();

    if($_POST['style_color'])
      $_POST['style_color'] = 'color:'.$_POST['style_color'];

    if($_POST['style_bold'])
      $_POST['style_bold'] =  ';font-weight:'.$_POST['style_bold'];

    if($_POST['style_color'] || $_POST['style_bold'] )
      $_POST['title_style'] = $_POST['style_color'].$_POST['style_bold'];


    $cat = $this->categorys[$_POST['catid']];

    $module = $module? $module : MODULE_NAME ;

    $_POST['url'] = geturl($cat,$_POST,$this->Urlrule);

    $_POST['url'] =$_POST['url'][0];


    if (false === $model->create()) {
      $this->error ( $model->getError () );
    }

    // 更新数据
    $list=$model->save();

    if (false !== $list) {

      $id= $_POST['id'];

      $catid = $module =='page' ? $id : $_POST['catid'];

      if($_POST['keywords']  && $module !='page'){

        $keywordsarr=explode(',',$_POST['keywords']);

        $i=0;

        $tagsdata =M('Tags_data');

        $tagsdata->where("id=".$id)->delete();

        foreach((array)$keywordsarr as $tagname){

          if($tagname){

            $tagidarr=$tagdatas=$where=array();
            $where['name']=array('eq',$tagname);
            $where['moduleid']=array('eq',$cat['moduleid']);
            $tagid=M('Tags')->where($where)->field('id')->find();
            $tagidarr['id']=$id;

            if($tagid['id']>0){
              $num = $tagsdata->where("tagid=".$tagid[id])->count();
              $tagdatas['num']=$num+1;
              M('Tags')->where("id=".$tagid[id])->save($tagdatas);
              $tagidarr['tagid']=$tagid['id'];
            }else{
              $tagdatas['moduleid']=$cat['moduleid'];
              $tagdatas['name'] = $tagname;
              $tagdatas['slug'] = Pinyin($tagname);
              $tagdatas['num']=1;
              $tagdatas['lang']=$_POST['lang'];
              $tagdatas['module']= $cat['module'];
              $tagidarr['tagid']=M('Tags')->add($tagdatas);
            }

            $i++;
            $tagsdata->add($tagidarr);
          }
        }
      }

      if($_POST['aid']) {

        $Attachment =M('attachment');

        $aids =  implode(',',$_POST['aid']);

        $data['id']= $id;
        $data['catid']= $catid;
        $data['status']= '1';
        $Attachment->where("aid in (".$aids.")")->save($data);
      }

      $cat = $this->categorys[$catid];

      if($cat['ishtml']){

        if($module!='page'  && $_POST['status'])  $this->create_show($_POST['id'],$module);

        if($this->sysConfig['HOME_ISHTML']) $this->create_index();

        $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

        foreach($arrparentid as $catid) {

          if($this->categorys[$catid]['ishtml'])  $this->clisthtml($catid);

        }

       }

      $this->assign( 'jumpUrl', $_POST['forward'] );
      $this->ajaxReturn(L('edit_ok'));

    } else {
      //错误提示
      $this->ajaxReturn(L('edit_error').': '.$model->getDbError());
    }

  }


  function statusallok(){

    $module = MODULE_NAME;

    $model = M($module);

    $ids = $_POST['ids'];

    if(!empty($ids) && is_array($ids)){

      $id = implode(',',$ids);

      $data = $model->select($id);

      if($data){

        foreach($data as $key=>$r){

          $model->save(array(id=>$r['id'],status=>1));

          if($this->categorys[$r['catid']]['ishtml'] && $r['status'])
            $this->create_show($r['id'],$module);

        }

        $cat = $this->categorys[$r['catid']];

        if($cat['ishtml']){

          if($this->sysConfig['HOME_ISHTML'])
            $this->create_index();

          $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

          foreach($arrparentid as $catid) {

            if($this->categorys[$catid]['ishtml'])
              $this->clisthtml($catid);

          }

        }
        $this->success(L('do_ok'));
      }else{
        $this->error(L('do_error').': '.$model->getDbError());
      }
    }else{
      $this->error(L('do_empty'));
    }
  }

  public function xiugai(){

    $model = D (MODULE_NAME);
    $idss = $_POST['ids'];

    if(!empty($idss) && is_array($idss)){

      $idArr = implode(',',$idss);
      $where = "id in(".$idArr.")";

      $data['status']= '1';

      if(!empty($_POST['catid'])){

        $list = $model->field('id,catid,url')->where($where)->select();

        foreach($list as $r) {
          //if($r['islink']) continue;

          $r['catid']= intval($_POST['catid']);
          $url = geturl($this->categorys[$r['catid']],$r,$this->Urlrule);

          $r['url'] = $url['0'];

          $model->save($r);
        }
      }else{
        $model->where($where)->data($data)->save();



        $this->success (L('do_eds'));
      }



    }else{
      $this->success (L('do_ed'));
    }
    if(in_array($name,$this->cache_model)) savecache($name);
    $this->success (L('do_ok'));
  }


  /*状态*/
  public function status(){

    $module = MODULE_NAME;

    $model = D($module);

    if($model->save($_GET)){

      $_POST ='';

      $_POST = $model->find($_GET['id']);

      $cat =  $this->categorys[$_POST['catid']];

      if($cat['ishtml']){

        if($module!='Page' && $_POST['status'])
          $this->create_show($_POST['id'],$module);

        if($this->sysConfig['HOME_ISHTML']) $this->create_index();

        $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

        foreach($arrparentid as $catid) {

          if($this->categorys[$catid]['ishtml'])  $this->clisthtml($catid);

        }

       }

      $this->success(L('do_ok'));

    }else{
      $this->error(L('do_error'));
    }
  }
}