<?php
/**
 *
 * SearchAction.class.php (前台搜索功能)
 */
namespace Home\Controller;
use Home\Controller\BaseController;
class SearchController extends BaseController {

  function _initialize() {
    parent::_initialize();
  }

  public function index() {
    //搜索
    $catid   = intval($_REQUEST['id']);
    $p       = intval($_REQUEST[C('VAR_PAGE')]);
    $keyword = $_REQUEST['keyword'];
    $module  = $_REQUEST['module'] ? $_REQUEST['module'] : 'Product' ;

    $this->assign($_REQUEST);
    $this->assign('bcid',0);

    $where   = " status=1 ";
    if(APP_LANG){
      $lang = LANG_NAME;
      $langid= LANG_ID;
      $where .=" and lang= $langid";
      $this->assign('lang',$lang);
      $this->assign('langid',$langid);
    }

    if($catid){
      $cat = $this->categorys[$catid];
      $bcid = explode(",",$cat['arrparentid']);
      $bcid = $bcid[1];
      if($bcid == '') $bcid=intval($catid);
      if(empty($module))$module=$cat['module'];
      unset($cat['id']);
      $this->assign($cat);
      $cat['id']=$catid;
      $this->assign('catid',$catid);
      $this->assign('bcid',$bcid);


      if($cat['child']){
        $where .= " and catid in(".$cat['arrchildid'].")";
      }else{
        $where .=  " and catid=".$catid;
      }

    }

    $where .= ' and title like "%'.$keyword.'%"';

    $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
    $this->assign('seo_title',$keyword.' '.$seo_title);
    $this->assign('seo_keywords',$keyword.$cat['keywords']);
    $this->assign('seo_description',$keyword.$cat['description']);

    $d = M($module)->where($where)->select();

    $count = count($d);

    if($count){

      import( "@.ORG.Page" );
      $listRows =  !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
      $page = new Page( $count, $listRows );
      $_REQUEST['p'] = '{$page}';
      $page->urlrule =  URL('Home-search/index',$_REQUEST);
      $pages = $page->show();

      $list = array_slice($d,$page->listRows*$p,$page->listRows);

      $this->assign('pages',$pages);
      $this->assign('list',$list);
    }
    $this->assign('keyword',$keyword);
    $this->display();
  }
}