<?php
namespace Org\Util;
use Think\Think;
class Tree extends Think {
  /**
   * 生成树型结构所需要的2维数组
   * @var array
   */
  public $arr = array();

  /**
   * 生成树型结构所需修饰符号，可以换成图片
   * @var array
   */
  public $icon = array('│','├','└');

  /**
   * @access private
   */
  public $ret = '';

  public $nbsp = "&nbsp;";
  public $level = 0;

  /**
   * 构造函数，初始化类
   * @param array 2维数组，例如：
   * array(
   *      1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
   *      2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
   *      3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
   *      4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
   *      5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
   *      6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
   *      7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二')
   *      )
   */
  public function __construct($arr=array()) {
    $this->arr = $arr;
    $this->ret = '';
  }

  public function get_child($bid){
    $newarr = array();
    if(is_array($this->arr)){
      foreach($this->arr as $key => $val){
        if($val['parentid'] == $bid) 
          $newarr[$key] = $val;
      }
    }
    return $newarr ? $newarr : false;
  }
/*
  function get_tree($bid, $str, $sid = 0, $adds = '', $strgroup = ''){
    $number = 1;
    $child = $this->get_child($bid);

    if(is_array($child)){
        $total = count($child);

      foreach($child as $id=>$a){
        $j=$k='';
        $leve=count(explode(',',$a['arrparentid']));
        
        $one = $leve == 2 ? '&nbsp;&nbsp;&nbsp;' : '';
        
        if($number==$total){
          $j .= $one;
          $j .= $this->icon[2];  
          $class_id = "id='".$a['id']."'";
        }else{
          $j .= $one;
          $j .= $this->icon[1];
          $k = $adds ? $one.$this->icon[0] : '';
        }

        $class_css="distinguish_".$a['parentid'];
        
        $spacer = $adds ? $adds.$j : '';

        @extract($a);
        if(empty($a['selected'])){
          $selected = $id==$sid ? 'selected' : '';
        }

        $parentid == 0 && $strgroup ? eval("\$newstr = \"$strgroup\";") : eval("\$newstr = \"$str\";");
        $this->ret .= $newstr;
        $nbsp = $this->nbsp;
        $this->get_tree($id, $str, $sid, $adds.$k.$nbsp,$strgroup);
        $number++;
        
      }
    }

    return $this->ret;
  }
*/
  /**
   * -------------------------------------
   *  得到树型结构
   * -------------------------------------
   * @param $myid 表示获得这个ID下的所有子级
   * @param $str 生成树形结构基本代码, 例如: "<option value=\$id \$select>\$spacer\$name</option>"
   * @param $sid 被选中的ID, 比如在做树形下拉框的时候需要用到
   * @param $adds
   * @param $str_group
   * @return unknown_type
   */
  function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '')
  {
    $number=1;
    $child = $this->get_child($myid);
    if(is_array($child))
    {
      $total = count($child);
      foreach($child as $id=>$a)
      {
        $j=$k='';
        if($number==$total)
        {
            $j .= $this->icon[2];
        }
        else
        {
          $j .= $this->icon[1];
          $k = $adds ? $this->icon[0] : '';
        }
        $class_css="distinguish_".$a['parentid'];
        $spacer = $adds ? $adds.$j : '';
        @extract($a);
        if(empty($a['selected'])){
          $selected = $id==$sid ? 'selected' : '';
        }
        $parentid == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
        $this->ret .= $nstr;
        $this->get_tree($id, $str, $sid, $adds.$k.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$str_group);
        $number++;
      }
    }
    return $this->ret;
  }


  function get_nav($bid,$maxlevel,$effected_id='navlist',$style='filetree ' ,$homefont='',$recursion=FALSE ,$child='',$enhomefont='',$lang='') {
  
    if($enhomefont) $indexen =  '<em>'.$enhomefont.'</em>';
    if($homefont) $homefont='<li id="nav_0"><span class="fl_ico"></span><a href="'.URL().'"><span class="fl">'.L(HOME_FONT).'</span>'.$indexen.'</a></li>';
   
    $number=1;
    if(!$child) $child = $this->get_child($bid);
    $total = count($child);
    $effected = $effected_id ?  ' id="'.$effected_id.'_box"' : '';
    $class=  $style? ' class="'.$style.'"' : '';
        if(!$recursion)  $this->ret .='<ul'.$effected.$class.'>'.$homefont;
        foreach($child as $id=>$a) {
          @extract($a);
      if(!$this->level){  
        $this->level= $level ? $level+$maxlevel-1 : $maxlevel;
      }

      $ischild =$this->get_child($id);
      $foldertype =  $ischild ? 'folder' : 'file';
          $floder_status = ' id="'.$effected_id.'_'.$id.'"';
      $first = $number==1 ?   'first ' : '';
      $floder_status .=  $number==$total ?  ' class="foot '.$foldertype.'"' :  ' class="'.$first.$foldertype.'"';
      $this->ret .= $recursion ? '<ul><li'.$floder_status.'>' : '<li'.$floder_status.'>';
            $recursion = FALSE;
      if($enhomefont){
        $enzm = $enname ? '<em>'.$enname.'</em>' :  '<em>'.$catdir.'</em>';
      }
      if($ischild && $level < $this->level){
      $this->ret .= '<span class="fd_ico"></span><a href="'.$url.'"><span class="fd">'.$catname.'</span>'.$enzm.'</a>';
              $this->get_nav($id,$maxlevel,$effected_id,$style,'',TRUE,$ischild,$enhomefont,$lang);
          } else {
       $this->ret .= '<span class="fl_ico"></span><a href="'.$url.'"><span class="fl">'.$catname.'</span>'.$enzm.'</a>';
          }
         $this->ret .=$recursion ? '</li></ul>': '</li>';
     $number++;
      }
      if(!$recursion)  $this->ret .='</ul>';
      return $this->ret;
  }

  function get_navs($root=0,$level){

    $childs = $this->get_child($root);//取回下级子栏目
    //$html = '<li><a href="/">首页</a></li>';
    $html = '';
    $i=0;

    foreach($childs as $id=>$child){
      $i++;


      $ischld=$this->get_child($child['id']);
             
      if(!empty($ischld)){//有子栏目
         $html.='<div class="sitemap_main"><h2 class="gr_left"><a href="'.$child['url'].'">'.$child['catname'].'</a></h2><ul class="gr_right">'.$this->nav_to_html($ischld,$level).'</ul></div>';
         
       }else{
         $html.='<div class="sitemap_main"><h2 class="gr_left"><a href="'.$child['url'].'">'.$child['catname'].'</a></h2></div>';
       }
       
    }
    return $html;
  }

  function nav_to_html($ar=array(),$level){
    //if($level==1) return false;
    $html = '';
    foreach($ar as $a){
      if($a['child']){
        $end=$this->nav_to_html($this->get_child($a['id']));
        $html.='<li><a href="'.$a['url'].'">'.$a['catname'].'</a>'.$end.'</li>';
      }else{
        $html.='<li><a href="'.$a['url'].'">'.$a['catname'].'</a></li>';
      }
       
    }

    return $html;
  }
}