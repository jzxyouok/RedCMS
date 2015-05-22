<?php
/**
 *
 * Base (前台公共模块)
 *
 */
namespace Home\Controller;
use Home\Base;
class ProductController extends BaseController {


  public function index($catid='',$module='') {
    $this->Urlrule = F('Urlrule');

    if(empty($catid))
      $catid = intval($_REQUEST['id']);

    $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);
    if($catid){
      $cat = $this->categorys[$catid];
      $bcid = explode(",",$cat['arrparentid']);
      $bcid = $bcid[1];
      if($bcid == '')
        $bcid=intval($catid);

      if(empty($module))
        $module=$cat['module'];

      $this->assign('module_name',$module);
      unset($cat['id']);
      $this->assign($cat);
      $cat['id']=$catid;
      $this->assign('catid',$catid);
      $this->assign('bcid',$bcid);
    }

    $fields = F($this->mod[$module].'_Field');

    foreach($fields as $key=>$r){
      $fields[$key]['setup'] = string2array($fields[$key]['setup']);
    }

    $this->assign( 'fields', $fields);

    $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
    $this->assign('seo_title',$seo_title);
    $this->assign('seo_keywords',$cat['keywords']);
    $this->assign('seo_description',$cat['description']);

    if($catid){

      $where = " status=1 ";

      if($cat['child']){
        $where .= " and catid in(".$cat['arrchildid'].")";
      }else{
        $where .=  " and catid=".$catid;
      }

      if(!empty($_GET['brand'])){
        $where .= " and brand=".$_GET['brand'];
      }

      if(empty($cat['listtype'])){

        $this->db= M($module);

        $count = $this->db->where($where)->count();

        if($count){
          import( "@.ORG.Page" );
          $listRows =  !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
          $page = new Page ( $count, $listRows );

          $page->urlrule = geturl($cat,'',$this->Urlrule);
          $pages = $page->show();

          $field =  $this->module[$this->mod[$module]]['listfields'];

          $field =  $field ? $field : 'id,catid,userid,url,username,title,title_style,keywords,description,thumb,createtime,hits';

          $list = $this->db->field($field)->where($where)->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();

          $this->assign('pages',$pages);
          $this->assign('list',$list);
        }
        $template_r = 'list';
      }

    }else{
      $template_r = 'list';
    }
    $template = $cat['template_list'] ? $cat['template_list'] : $template_r;

    $this->display('Product:'.$template);

  }

  public function show($id='',$module='') {
    $this->Urlrule = F('Urlrule');
    $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);
    $id = $id ? $id : intval($_REQUEST['id']);

    if($_GET['chid']) {
      $id = $_GET['chid'];
      $this->assign('chid',$_GET['chid']);
    }

    $module = $module ? $module : MODULE_NAME;
    $this->assign('module_name',$module);
    $this->db = M($module);;
    $data = $this->db->find($id);

    //关联信息
    if(!empty($data['gl'])){
      $gl_data = $this->db->field('url,title,thumb')->where('id in('.$data['gl'].')')->select();
    }

    $listorder = $data['listorder'];

    //上一个，下一个
    if($listorder!=0){
      $prea = $this->db->field('title,url')->where('catid="'.$data['id'].'" AND '.$listorder.' > listorder')->order('listorder desc')->limit('1')->select();
      $next = $this->db->field('title,url')->where('catid="'.$data['id'].'" AND '.$listorder.' < listorder')->order('listorder asc')->limit('1')->select();
    } else{
      $prea = $this->db->field('title,url')->where('catid="'.$data['id'].'" AND '.$id.' < id')->order('id asc')->limit('1')->select();
      $next = $this->db->field('title,url')->where('catid="'.$data['id'].'" AND '.$id.' > id')->order('id desc')->limit('1')->select();
    }

    $this->assign('prea',$prea[0]);
    $this->assign('next',$next[0]);

    $catid = $data['catid'];
    $cat = $this->categorys[$data['catid']];
    if(empty($cat['ishtml'])) {
      $this->db->where("id=".$id)->setInc('hits'); //添加点击次数
    }

    $bcid = explode(",",$cat['arrparentid']);
    $bcid = $bcid[1];
    if($bcid == '') {
      $bcid=intval($catid);
    }

    if($chargepoint && $data['userid'] !=$this->_userid){
      $user = M('user');
      $userdata =$user->find($this->_userid);
      if($cat['paytype']==1 && $userdata['point']>=$chargepoint){
        $chargepointok = $user->where("id=".$this->_userid)->setDec('point',$chargepoint);
      }elseif($cat['paytype']==2 && $userdata['amount']>=$chargepoint){
        $chargepointok = $user->where("id=".$this->_userid)->setDec('amount',$chargepoint);
      }else{
        $this->error (L('NO_READ'));
      }
    }

    $seo_title = $data['title'].'-'.$cat['catname'];
    $this->assign('seo_title',$seo_title);
    $this->assign('seo_keywords',$data['keywords']);
    $this->assign('seo_description',$data['description']);
    $this->assign('fields', F($cat['moduleid'].'_Field'));

    $fields = F($this->mod[$module].'_Field');

    foreach($data as $key=>$c_d){
      $setup='';
      $fields[$key]['setup'] = $setup=string2array($fields[$key]['setup']);
      if($setup['fieldtype'] == 'varchar' && $fields[$key]['type']!='text'){
        $data[$key.'_old_val'] = $data[$key];
        $data[$key] = fieldoption($fields[$key],$data[$key]);
      }elseif($fields[$key]['type']=='images' || $fields[$key]['type']=='files'){
        if(!empty($data[$key])){
          $p_data=explode(':::',$data[$key]);
          $data[$key]=array();
          foreach($p_data as $k=>$res){
            $p_data_arr=explode('|',$res);
            $data[$key][$k]['filepath'] = $p_data_arr[0];
            $data[$key][$k]['filename'] = $p_data_arr[1];
          }
          unset($p_data);
          unset($p_data_arr);
        }
      }
      unset($setup);
    }

    $this->assign('fields',$fields);

    //手动分页
    $CONTENT_POS = strpos($data['content'], '[page]');

    if($CONTENT_POS !== false) {

      $urlrule = geturl($cat,$data,$this->Urlrule);
      $urlrule =  str_replace('%7B%24page%7D','{$page}',$urlrule);
      $contents = array_filter(explode('[page]',$data['content']));
      $pagenumber = count($contents);

      for($i=1; $i<=$pagenumber; $i++) {
        $pageurls[$i] = str_replace('{$page}',$i,$urlrule);
      }

      $pages = content_pages($pagenumber,$p, $pageurls);
      //判断[page]出现的位置是否在文章开始
      if($CONTENT_POS<7) {
        $data['content'] = $contents[$p];
      } else {
        $data['content'] = $contents[$p-1];
      }
      $this->assign('pages',$pages);
    }

    //判断模板文件
    if(!empty($data['template'])){
      $template = $data['template'];
    }elseif(!empty($cat['template_show'])){
      $template = $cat['template_show'];
    }else{
      $template = 'show';
    }

    $this->assign('catid',$catid);
    $this->assign($cat);
    $this->assign('bcid',$bcid);
    $this->assign('gl_data',$gl_data);

    $this->assign('product',$data);
    $this->display('Product:'.$template);
  }


  public function hits(){
    $id = $id ? $id : intval($_REQUEST['id']);
    $this->db= M('Product');
    $this->db->where("id=".$id)->setInc('hits');


    $hits = $this->db->where("id=".$id)->getField('hits');
    echo '$("#hits").html('.$hits.');';

    exit;
  }

  function ajax(){
    $map['brand'] = intval($_GET['brand']);
    $map['material'] = intval($_GET['material']);
    //$map['catid'] = 2;
    $catid = 2;
    $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);
    if($catid){
      $cat = $this->categorys[$catid];
      $bcid = explode(",",$cat['arrparentid']);
      $bcid = $bcid[1];
      if($bcid == '')
        $bcid=intval($catid);

      if(empty($module))
        $module=$cat['module'];

      $this->assign('module_name',$module);
      unset($cat['id']);
      $this->assign($cat);
      $cat['id']=$catid;
      $this->assign('catid',$catid);
      $this->assign('bcid',$bcid);
    }

    $fields = F($this->mod[$module].'_Field');

    foreach($fields as $key=>$r){
      $fields[$key]['setup'] = string2array($fields[$key]['setup']);
    }

    $this->assign( 'fields', $fields);

    $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
    $this->assign('seo_title',$seo_title);
    $this->assign('seo_keywords',$cat['keywords']);
    $this->assign('seo_description',$cat['description']);



    $where = " status=1 ";

    if($cat['child']){
      $where .= " and catid in(".$cat['arrchildid'].")";
    }else{
      $where .=  " and catid=".$catid;
    }

    foreach($this->Type as $val){
      if($val['parentid']==1){
        $brandChild[] = $val['typeid'];
      }
      if($val['parentid']==7){
        $materialChild[] = $val['typeid'];
      }
    }
    $brandChild = implode(',',$brandChild);
    $materialChild = implode(',',$materialChild);
    if(!empty($_GET['brand'])&&$_GET['brand']!=1){
      $where .= " and brand=".$_GET['brand'];
    } else {
      $where .= " and brand in(".$brandChild.")";
    }

    if(!empty($_GET['material'])&&$_GET['material']!=7){
      $where .= " and material=".$_GET['material'];
    } else {
      $where .= " and material in(".$materialChild.")";
    }

    if(empty($cat['listtype'])){

      $model = M('Product');

      $count = $model->where($where)->count();

      if($count){
        import( "@.ORG.Page" );
        $listRows =  !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
        $page = new Page ( $count, $listRows );

        $page->urlrule = geturl($cat,'',$this->Urlrule);
        $pages = $page->show();

        $field =  $this->module[$this->mod[$module]]['listfields'];

        $field =  'title,url,thumb,id,description';

        $list = $model->field($field)->where($where)->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
      }
    }

    //$model->getlastsql()
    $this->ajaxReturn($list);
  }

}