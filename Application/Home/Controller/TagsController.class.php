<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
namespace Home\Controller;
use Home\Base;
class TagsController extends BaseController {

  public function index() {
    $slug = $tag ? $tag : $_REQUEST['tag'];

    $module = $_REQUEST['module'];

    $module = $_REQUEST['moduleid'] ? $this->module[$_REQUEST['moduleid']]['name'] : '';
    $module = $_REQUEST['module'] ? $_REQUEST['module'] : $module;
    $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);

    $prefix = C( "DB_PREFIX" );
    $Tags = M('Tags');
    $Tags_data = M('Tags_data');
    $where= APP_LANG ? " lang=".LANG_ID : 1 ;

    if($slug){
      $module = $module ? $module :'Article';
      $moduleid = $this->mod[$module];

      $data = $Tags->where($where." and moduleid = $moduleid and slug='".$slug."'")->find();

      $this->assign ('seo_title',$data['name']);
      $this->assign ('seo_keywords',$data['name']);
      $this->assign ('seo_description',$data['name']);
      $this->assign ('moduleid',$moduleid);

      $tagid = $data['id'];
      $this->assign ('data',$data);
      $mtable = $prefix.strtolower($module);
      $count = $Tags_data->table($prefix.'tags_data as a')->join($mtable." as b on a.id=b.id ")->where("a.tagid=".$tagid)->count();
      if($count){
        import ( "@.ORG.Page" );
        $listRows =  C('PAGE_LISTROWS'); //C('PAGE_LISTROWS')
        $page = new Page ( $count, $listRows,$p );
        $page->urlrule = TAGURL($data,1);
        $pages = $page->show();
        $field = 'b.id,b.catid,b.userid,b.url,b.username,b.content,b.title,b.keywords,b.description,b.thumb,b.createtime';
        $list = $Tags_data->field($field)->table($prefix.'tags_data as a')->join($mtable." as b on a.id=b.id")->where($where." and a.tagid=".$tagid)->order('b.listorder desc,b.id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('pages',$pages);

        $this->assign('list',$list);
      }
    }else{
      $moduleid=$this->mod[$module];
      $where .= $moduleid ? ' and moduleid='.$moduleid : '';
      $count = $Tags->where($where)->count();
      if($count){
        import ( "@.ORG.Page" );
        $listRows = 50;
        $page = new Page ( $count, $listRows );
        $page->urlrule = TAGURL(array('moduleid'=>$moduleid),1);
        $pages = $page->show();
        $list = $Tags->where($where)->order('id desc')->limit($page->firstRow . ',' . $page->listRows)->select();

        foreach($list as $key=>$r){
        	$list[$key]['module'] = $this->module[$r['moduleid']]['name'];
        }
        $this->assign('pages',$pages);
        $this->assign('list',$list);
      }
    }

    $template = $slug ? 'list' : 'index';

    $this->display("Tags:".$template);
  }

}
