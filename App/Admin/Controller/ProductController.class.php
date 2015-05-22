<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
namespace Admin\Controller;
use Admin\Adminbase;
use Org\Util\Form;
class ProductController extends AdminbaseController {

  protected  $db,$fields;

  public function _initialize() {

    parent::_initialize();

    $this->db = D('Product');

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
   * undocumented function
   *
   * @return void
   * @author
   **/
  public function index()
  {

    $m=$this->db->max('id');

    $maxid=empty($m)?0:$m;

    $this->assign('maxid',$maxid);

    $model = M('Product');
    $map = '';
    $sortBy = '';
    $asc = false;
    $listRows = 15;
    $id=$model->getPk();
    $this->assign ( 'pkid', $id );
    if (isset ( $_REQUEST ['order'] )) {
      $order = $_REQUEST ['order'];
    } else {
      $order = !empty ( $sortBy ) ? $sortBy : $id;
    }

    if (isset ( $_REQUEST['sort'])) {
      $_REQUEST['sort']=='asc' ? $sort = 'asc' : $sort = 'desc';
    } else {
      $sort = $asc ? 'asc' : 'desc';
    }

    $_REQUEST['sort']  = $sort;
    $_REQUEST['order'] = $order;
    $keyword    = $_REQUEST['keyword'];
    $searchtype = $_REQUEST['searchtype'];
    $groupid    = intval($_REQUEST['groupid']);
    $catid      = intval($_REQUEST['catid']);
    $posid      = intval($_REQUEST['posid']);
    $typeid     = intval($_REQUEST['typeid']);

    if(APP_LANG)
      if($this->moduleid)
        $map['lang'] = array('eq',LANG_ID);

    if(!empty($keyword) && !empty($searchtype)){
      $map[$searchtype] = array('like','%'.$keyword.'%');
    }

    if($groupid)
      $map['groupid'] = $groupid;

    if($catid)
      $map['catid'] = $catid;

    if($posid)
      $map['posid'] = $posid;

    if($typeid)
      $map['typeid'] = $typeid;

    $tables = $model->getDbFields();

    foreach($_REQUEST['map'] as $key=>$res){
      if( ($res==='0' || $res>0) || !empty($res) ){
        if($_REQUEST['maptype'][$key]){
          $map[$key] = array($_REQUEST['maptype'][$key],$res);
        }else{
          $map[$key] = intval($res);
        }
        $_REQUEST[$key] = $res;
      }else{
        unset($_REQUEST[$key]);
      }
    }

    $this->assign($_REQUEST);

    //取得满足条件的记录总数
    $count = $model->where($map)->count( $id );//echo $model->getLastsql();

    if ($count > 0) {

      //创建分页对象
      if (! empty ( $_REQUEST ['listRows'] )) {
        $listRows = $_REQUEST ['listRows'];
      }

      $p = new \Org\Util\Page( $count, $listRows );

      //分页查询数据
      $field = $this->module[$this->moduleid]['listfields'];
      $field = (empty($field) || $field=='*') ? '*' : 'id,catid,url,posid,title,thumb,title_style,userid,username,hits,createtime,updatetime,status,listorder' ;
      $voList = $model->field($field)->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );

      //分页跳转的时候保证查询条件
      foreach ( $map as $key => $val ) {
        if (! is_array ( $val )) {
          $p->parameter .= "$key=" . urlencode ( $val ) . "&";
        }
      }

      $map[C('VAR_PAGE')] = '{$page}';

      $page->urlrule = U('Product/index', $map);
      //分页显示
      $page = $p->show ();
      //列表排序显示
      $sortImg = $sort; //排序图标
      $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
      $sort = $sort == 'desc' ? 1 : 0; //排序方式

      //模板赋值显示
      $this->assign('list', $voList );
      $this->assign('page', $page );
    }

    $this->display();
  }

  /**
   * undocumented function
   *
   * @return void
   * @author
   **/
  public function add()
  {

    $form = new Form();

    $this->assign('form', $form );

    $this->display('Content:edit');
  }


  public function edit() {

    $id = $_REQUEST['id'];
    $this->assign($_REQUEST);
    $vo = $this->db->getById($id);

    $vo['content'] = htmlspecialchars($vo['content']);

    $form = new Form($vo);

    $this->assign('vo', $vo);
    $this->assign('form', $form);

    $this->display('Content:edit');
  }


  /**
   * 录入
   *
   */
  public function insert($module='',$fields=array(),$userid=0,$username='',$groupid=0) {

    $model = $this->db;

    $fields = $fields ? $fields : $this->fields ;

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

    if (false === $model->create()) {
      $this->error($model->getError());
    }

    $_POST['id'] = $id= $model->add();

    if ($id !==false) {

      $catid = $_POST['catid'];

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


      $this->assign('jumpUrl', U($module.'/index') );


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
      $_POST['createtime']=time();
      $_POST['status']=1;
      $_POST['lang']=LANG_ID;
      $r=$this->db->add($_POST);
      $result['issu']=$r? L('add_ok') : L('add_error');
    }

    echo json_encode($result);
    exit;
  }


  function update($module='',$fields=array(),$userid=0,$username='')
  {

    $model = $module ? M($module) : $this->db;

    $fields = $fields ? $fields : $this->fields ;

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

        $aids = implode(',',$_POST['aid']);

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


  function statusallok()
  {

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

  public function xiugai()
  {

    $model = D('Product');
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
  public function status()
  {

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

  /**
   * undocumented function
   *
   * @return void
   * @author
   **/
  public function batch()
  {

    if($_POST['plist']){
      if(MODULE_NAME!='Product') return '';
      $model =$this->db;

      $lang=$_POST['lang'];
      $forward=$_POST['forward'];
      $hash=$_POST['__hash__'];
      unset($_POST['lang']);
      unset($_POST['forward']);
      unset($_POST['__hash__']);

      foreach($_POST['plist'] as $insert){
        $insert['lang']=$lang;
        $insert['__hash__']=$hash;
        $insert['forward']=$forward;
        $insert = checkfield($this->fields,$insert);
        $insert['createtime'] = time();
        $insert['updatetime'] = $insert['createtime'];
        $insert['userid'] = $module ? $userid : $_SESSION['userid'];
        $insert['username'] = $module ? $username : $_SESSION['username'];

        $id= $model->add($insert);

        if($insert['aid']){
          $Attachment =M('Attachment');
          $aids =  implode(',',$insert['aid']);
          $data['id']=$id;
          $data['catid']= $insert['catid'];
          $data['status']= '1';
          $Attachment->where("aid in (".$aids.")")->save($data);
        }
        $data='';
        $cat = $this->categorys[$insert['catid']];
        $url = geturl($cat,$insert,$this->Urlrule);
        $data['id']= $id;
        $data['url']= $url[0];
        $model->save($data);

      }//end foreach

      $this->success (L('add_ok'));
    }

    $this->display();
  }

  public function import() {
    $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
    $yzh_auth = authcode('1-0-0-1-csv-2-3', 'ENCODE',$yzh_auth_key);
    $this->assign('yzh_auth',$yzh_auth);

    $this->display();
  }
}