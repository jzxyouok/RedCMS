<?php


namespace Develop\Controller;
use Think\Developbase;
class ContentController extends DevelopbaseController{

  protected  $db,$fields;

  public function _initialize() {

    parent::_initialize();

    defined('THEME_PATH') or define('THEME_PATH', TMPL_PATH.GROUP_NAME.'/'.C('DEFAULT_THEME').'/');

    $this->db = D(MODULE_NAME);

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

    $template = file_exists(THEME_PATH.MODULE_NAME.'/index.html') ? MODULE_NAME.':index' : 'Content:index';

    $m = $this->db->max('id');

    $maxid=empty($m)?0:$m;

    $this->assign('maxid',$maxid);

    $modelname = MODULE_NAME;
    $map = '';
    $sortBy = '';
    $asc = false ;
    $listRows = 15;
    $model = M($modelname);
    $id=$model->getPk ();
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

    if($catid) {
      $map['catid']=$catid;
    }

    if($posid) {
      $map['posid']=$posid;
    }

    if($typeid) {
      $map['typeid']=$typeid;
    }

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
      import("@.ORG.Page");
      //创建分页对象
      if (! empty ( $_REQUEST ['listRows'] )) {
        $listRows = $_REQUEST ['listRows'];
      }

      $p = new Page ( $count, $listRows );

      //分页查询数据
      $field=$this->module[$this->moduleid]['listfields'];
      $field= (empty($field) || $field=='*') ? '*' : 'id,catid,url,posid,title,thumb,title_style,userid,username,hits,createtime,updatetime,status,listorder' ;
      $voList = $model->field($field)->where($map)->order( "`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select ( );
      foreach($voList as $key=>$val){
        $voList[$key]['posid'] = explode(',', $val['posid']);
      }

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
      $this->assign('list', $voList );
      $this->assign('page', $page );
    }

    $this->display($template);
  }


  public function add() {

    $form = new Form();

    $this->assign('form', $form );

    $template = file_exists(THEME_PATH.MODULE_NAME.'/edit.html') ? MODULE_NAME.':edit' : 'Content:edit';

    $this->display($template);
  }


  public function edit() {

    $id = $_REQUEST['id'];

    $vo = $this->db->getById($id);

    $vo['content'] = htmlspecialchars($vo['content']);

    $form = new Form($vo);

    $this->assign('vo', $vo);
    $this->assign('form', $form);
    $template = file_exists(THEME_PATH.MODULE_NAME.'/edit.html') ? MODULE_NAME.':edit' : 'Content:edit';

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
      $this->assign('jumpUrl','javascript:history.go(-1);');
      $this->error(L('do_empty'));
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

        $Attachment =M('attachment');

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
        $keywordsarr = explode(',',$_POST['keywords']);
        $i = 0;

        $tagsdata = M('Tags_data');
        $tagsdata->where("id=".$id)->delete();

        foreach((array)$keywordsarr as $tagname){

          if($tagname){

            $tagidarr = $tagdatas = $where = array();
            $where['name'] = array('eq',$tagname);
            $where['moduleid'] = array('eq',$cat['moduleid']);
            $tagid = M('Tags')->where($where)->field('id')->find();
            $tagidarr['id'] = $id;

            if($tagid){
              $num = $tagsdata->where("tagid=".$tagid[id])->count();
              $tagdatas['num'] = $num+1;
              M('Tags')->where("id=".$tagid[id])->save($tagdatas);
              $tagidarr['tagid'] = $tagid['id'];
            }else{
              $tagdatas['moduleid'] = $cat['moduleid'];
              $tagdatas['name'] = $tagname;
              $tagdatas['slug'] = Pinyin($tagname);
              $tagdatas['num'] = 1;
              $tagdatas['lang'] = $_POST['lang'];
              $tagdatas['module'] = $cat['module'];
              $tagidarr['tagid'] = M('Tags')->add($tagdatas);
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

      $this->success(L('add_ok'));
    } else {
      $this->error(L('add_error').': '.$model->getDbError());
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
      $this->success(L('edit_ok'));

    } else {
      //错误提示
      $this->success(L('edit_error').': '.$model->getDbError());
    }

  }


  function statusallok(){

    $module = MODULE_NAME;

    $model = M ( $module );

    $ids=$_POST['ids'];

    if(!empty($ids) && is_array($ids)){

      $id=implode(',',$ids);

      $data = $model->select($id);

      if($data){

        foreach($data as $key=>$r){

          $model->save(array(id=>$r['id'],status=>1));

          if($this->categorys[$r['catid']]['ishtml'] && $r['status'])$this->create_show($r['id'],$module);

        }

        $cat =  $this->categorys[$r['catid']];

        if($cat['ishtml']){

          if($this->sysConfig['HOME_ISHTML']) $this->create_index();

          $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

          foreach($arrparentid as $catid) {

            if($this->categorys[$catid]['ishtml'])  $this->clisthtml($catid);

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