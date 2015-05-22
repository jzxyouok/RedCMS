<?php
namespace Develop\Controller;
use Think\Content;
class ArticleController extends ContentController{

  public function collection(){

    $fields = F($this->mod['article'].'_Field');
    $this->assign('filed_catid',$fields['catid']);
    $this->display('article:collection');
  }

  public function getcollection(){

    $start=!empty($_POST['start'])?$_POST['start']:'';
    if(strpos($start,'\'')){
      $start=str_replace('\'','"',$start);
    }
    $end=!empty($_POST['end'])?$_POST['end']:'';
    if(strpos($end,'/')){
      $end=str_replace('/','\/',$end);
    }

    $title_lable_start=!empty($_POST['title_lable_start'])?$_POST['title_lable_start']:'';
    if(strpos($title_lable_start,'\'')){
      $title_lable_start=str_replace('\'','"',$title_lable_start);
    }
    $title_lable_end=!empty($_POST['title_lable_end'])?$_POST['title_lable_end']:'';
    if(strpos($title_lable_end,'/')){
      $title_lable_end=str_replace('/','\/',$title_lable_end);
    }

    $content_lable_start=!empty($_POST['content_lable_start'])? $_POST['content_lable_start']:'';
    if(strpos($content_lable_start,'\'')){
      $content_lable_start=str_replace('\'','"',$content_lable_start);
    }

    $content_lable_end=!empty($_POST['content_lable_end'])?$_POST['content_lable_end']:'';
    if(strpos($content_lable_end,'/')){
      $content_lable_end=str_replace('/','\/',$content_lable_end);
    }

    if($_POST['http']) $contents=iconv('GB2312','UTF-8',file_get_contents($_POST['http']));
    if(empty($contents)){
      $contents=file_get_contents($_POST['http']);
    }

   preg_match_all('/'.$start.'(.*?)'.$end.'/is',$contents,$list);


    if(!empty($list)) preg_match_all('/href="(.*?)"/i',$list[0][0],$links);

    if(!empty($links[1])){

      $Articles=array();
      $limit=!empty($_POST['limit'])?$_POST['limit']:10;
      $i=0;
      foreach($links[1] as $link){
        $i++;

        $articlecontent=iconv('GB2312','UTF-8',file_get_contents($link));

        preg_match('/'.$title_lable_start.'(.*?)'.$title_lable_end.'/i',$articlecontent,$atitles);//标题

        preg_match('/'.$content_lable_start.'(.*?)'.$content_lable_end.'/is',$articlecontent,$con_s);//内容

        $Articles[]=array('title'=>$atitles[1],'content'=>$con_s[1],'catid'=>$_POST['catid'],'createtime'=> time(),'lang'=>LANG_ID);
         if($i==$limit){break;}
      }

      $Article=M('Article');
      $k=0;
      foreach($Articles as $A){
        $k++;
        if($Article->add($A)===false){
          $this->error('采集第'.$k.'条失败');
        }
      }

      $forward = $_POST['forward'] ? $_POST['forward'] :$this->forward ;
      $this->assign('jumpUrl',$forward);
      $this->success('采集成功');
    }

  }

}