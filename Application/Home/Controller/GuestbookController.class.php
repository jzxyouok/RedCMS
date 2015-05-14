<?php
/**
 *
 * Base (前台公共模块)
 *
 */
class GuestbookController extends BaseController {


  public function index() {
    //获取路由规则
    $this->Urlrule =F('Urlrule');
    $catid = intval($_REQUEST['id']);
    $module = MODULE_NAME;

    if(empty($catid))
      $catid =  intval($_REQUEST['id']);

    $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);

    if($catid){
      $cat = $this->categorys[$catid];
      $bcid = explode(",",$cat['arrparentid']);
      $bcid = $bcid[1];
      if($bcid == '') $bcid=intval($catid);
      if(empty($module))$module=$cat['module'];
      $this->assign('module_name',$module);
      unset($cat['id']);
      $this->assign($cat);
      $cat['id']=$catid;
      $this->assign('catid',$catid);
      $this->assign('bcid',$bcid);
    }

    $fields = F($this->mod[$module].'_Field');

    foreach($fields as $key=>$r){
      $fields[$key]['setup'] =string2array($fields[$key]['setup']);
    }

    $this->assign ( 'fields', $fields);

    $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
    $this->assign ('seo_title',$seo_title);
    $this->assign ('seo_keywords',$cat['keywords']);
    $this->assign ('seo_description',$cat['description']);

    $where['status']=array('eq',1);
    $this->db = M($module);
    $count = $this->db->where($where)->count();

    if($count){
      import ( "@.ORG.Page" );
      $listRows =  !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
      $page = new Page ( $count, $listRows );
      $page->urlrule = geturl($cat,'');
      $pages = $page->show();
      $field =  $this->module[$cat['moduleid']]['listfields'];
      $field =  $field ? $field : '*';
      $list = $this->db->field($field)->where($where)->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
      $this->assign('pages',$pages);
      $this->assign('list',$list);
    }
    $template = $cat['module']=='Guestbook' && $cat['template_list'] ? $cat['template_list'] : 'index';
    $this->display(THEME_PATH.$module.'_'.$template.'.html');
  }

}