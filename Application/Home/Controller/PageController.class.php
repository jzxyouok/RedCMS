<?php
/**
 *
 * Base (前台公共模块)
 *
 */
namespace Home\Controller;
use Home\Base;
class PageController extends BaseController {

  public function index($catid='',$module='')
  {
    //获取路由规则
    $this->Urlrule = F('Urlrule');

    if(empty($catid))
      $catid = intval($_REQUEST['id']);

    $module = 'Page';


    if(empty($catid))
      $catid = intval($_REQUEST['id']);

    $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);

    if($catid){
      $cat = $this->categorys[$catid];
      $bcid = explode(",",$cat['arrparentid']);
      $bcid = $bcid[1];
      if($bcid == '')
        $bcid=intval($catid);

      $this->assign('module_name',$module);
      unset($cat['id']);
      $this->assign($cat);
      $cat['id']=$catid;
      $this->assign('catid',$catid);
      $this->assign('bcid',$bcid);
    }

    if($cat['readgroup'] && $this->_groupid!=1 && !in_array($this->_groupid,explode(',',$cat['readgroup']))){
      $this->assign('jumpUrl',URL('User-Login/index'));
      $this->error (L('NO_READ'));
    }

    $fields = F($this->mod[$module].'_Field');
    foreach($fields as $key=>$r){
      $fields[$key]['setup'] =string2array($fields[$key]['setup']);
    }

    $this->assign( 'fields', $fields);

    $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
    $this->assign('seo_title',$seo_title);
    $this->assign('seo_keywords',$cat['keywords']);
    $this->assign('seo_description',$cat['description']);

    $modle = M('Page');

    $data = $modle->find($catid);
    unset($data['id']);

    $cnumf = M('feedback')->where('status=1 and posid=1')->count();
    $cnumg = M('guestbook')->where('status=1 and posid=1')->count();
    $this->assign ('cnumf',$cnumf);
    $this->assign ('cnumg',$cnumg);

    $fields = F($this->mod[$module].'_Field');
    foreach($data as $key=>$c_d){
      $setup='';
      $fields[$key]['setup'] =$setup=string2array($fields[$key]['setup']);
      if($setup['fieldtype']=='varchar' && $fields[$key]['type']!='text'){
        $data[$key.'_old_val'] =$data[$key];
        $data[$key]=fieldoption($fields[$key],$data[$key]);
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
    //分页
    $CONTENT_POS = strpos($data['content'], '[page]');
    if($CONTENT_POS !== false) {
      $urlrule    = geturl($cat,'',$this->Urlrule);
      $urlrule[0] = urldecode($urlrule[0]);
      $urlrule[1] = urldecode($urlrule[1]);
      $contents   = array_filter(explode('[page]',$data['content']));
      $pagenumber = count($contents);
      for($i=1; $i<=$pagenumber; $i++) {
        $pageurls[$i] = str_replace('{$page}',$i,$urlrule);
      }
      $pages = content_pages($pagenumber,$p, $pageurls);
      //判断[page]出现的位置
      if($CONTENT_POS<7) {
        $data['content'] = $contents[$p];
      } else {
        $data['content'] = $contents[$p-1];
      }
      $this->assign('pages',$pages);
    }

    $template = $cat['template_list'] ? $cat['template_list'] : 'index' ;
    $this->assign($data);

    $this->display('Page:'.$template);
  }

}