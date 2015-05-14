<?php
/**
 *
 * Attachment(附件管理)
 */
namespace Home\Controller;
use Home\Base;
class AttachmentAction extends  Action {

  protected $lang;
  protected $db;
  protected $Config;
  protected $sysConfig;
  protected $isadmin = 0;
  protected $userid = 0;
  protected $groupid = 0;


  function _initialize() {
    $this->isadmin= $_REQUEST['isadmin'] ? $_REQUEST['isadmin'] : 0;
    $this->sysConfig = F('sys.config');
    if(APP_LANG){
      $this->Lang = F('Lang');
      $this->assign('Lang',$this->Lang);
      if($_GET['l']){
        if(!$this->Lang[$_GET['l']]['status'])$this->error ( L ( 'NO_LANG' ) );
        $this->lang=$_GET['l'];
      }else{
        $this->lang=$this->sysConfig['DEFAULT_LANG'];
      }
      define('LANG_ID', $this->Lang[$this->lang]['id']);

      $this->Config = F('Config_'.$this->lang);
    }else{
      $this->Config = F('Config');
    }

    if($_POST['PHPSESSID'] && $_POST['swf_auth_key'] && $_POST['userid']){
      if($_POST['swf_auth_key']==sysmd5($_POST['PHPSESSID'].$_POST['userid'],$this->sysConfig['ADMIN_ACCESS'])){
        $this->userid = $_POST['userid'];
        if(APP_LANG) $this->Config = F('Config_'.$_POST['lang']);
      }
    }
    if(!$this->userid){
      if($this->isadmin){
        import('@.Action.Adminbase');
        $Adminbase=new AdminbaseAction();
        $Adminbase->_initialize();
        $this->userid=  $_SESSION[C('USER_AUTH_KEY')];
        $this->groupid=  $_SESSION['groupid'];
      }else{
        C('ADMIN_ACCESS',$this->sysConfig['ADMIN_ACCESS']);
        if($_COOKIE['ww_auth']){
          if(!strstr($_SERVER['HTTP_USER_AGENT'],'Flash'))cookie('ww_cookie',$_SERVER['HTTP_USER_AGENT']);
          $HTTP_USER_AGENT = strstr($_SERVER['HTTP_USER_AGENT'],'Flash') ? $_COOKIE['ww_cookie'] : $_SERVER['HTTP_USER_AGENT'];
          $ww_auth_key = sysmd5($this->sysConfig['ADMIN_ACCESS'].$HTTP_USER_AGENT);
          list($userid, $groupid ,$password) = explode("-", authcode($_COOKIE['ww_auth'], 'DECODE', $ww_auth_key));
          $this->userid = $userid;
          $this->groupid = $groupid;
        }
        if(!$this->userid){
          $this->assign('jumpUrl',U('User/Login/index'));
          $this->error(L('no_login'));
        }
      }
    }
    $this->assign($this->Config);

    $this->db=M('Attachment');
    }


  public function index(){
        /*
    $auth = str_replace(' ','+',$_REQUEST['auth']) ;

    $postd=array('isadmin','more','isthumb','file_limit','file_types','file_size','moduleid');
    foreach((array)$_REQUEST as $key=>$res){
      if(in_array($key,$postd))$postdata[$key]=$res;
    }
    $upsetup = implode('-',$postdata);
    $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
    $enupsetup = authcode($auth, 'DECODE', $yzh_auth_key);
    print_r($enupsetup);exit;
    if(!$enupsetup || $upsetup!=$enupsetup)  $this->error (L('do_empty'));*/

    $sessid = time();

    $count = $this->db->where('status=0 and userid ='.$this->userid)->count();
    $this->assign('no_use_files',$count);
    $this->assign('small_upfile_limit',$_REQUEST['file_limit'] - $count);


    $types = '*.'.str_replace(",",";*.",$_REQUEST['file_types']);
    if($_REQUEST['file_types']=='csv') $this->assign('csv',$_REQUEST['file_types']);
    $this->assign('moduleid',$_REQUEST['moduleid']);
    $this->assign('file_size',$_REQUEST['file_size']);
    $this->assign('file_limit',$_REQUEST['file_limit']);
    $this->assign('file_types',$types);
    $this->assign('isthumb',$_REQUEST['isthumb']);
    $this->assign('isadmin',$this->isadmin);
    $this->assign('sessid',$sessid);
    $this->assign('lang',$this->lang);
    $this->assign('userid',$this->userid);
    $swf_auth_key = sysmd5($sessid.$this->userid);

    $this->assign('swf_auth_key',$swf_auth_key);
    $this->assign('more',$_GET['more']);
    $this->display();
  }

  //针对产品
  public function uploadcsv(){
    import("@.ORG.UploadFile");
    $upload = new UploadFile();
    $upload->maxSize = $this->Config['attach_maxsize'];
    $upload->autoSub = false;
    $upload->subType = 'date';
    $upload->dateFormat = 'Ym';
    //设置上传文件类型
    $upload->allowExts = explode(',', $this->Config['attach_allowext']);
    //设置附件上传目录
    $upload->savePath = UPLOADCSV_PATH;
    //设置上传文件规则
    $upload->saveRule = 'pcsv';
    if (!$upload->upload()) {

      $this->ajaxReturn(0,$upload->getErrorMsg(),0);
    } else {
      $uploadList = $upload->getUploadFileInfo();

      $returndata['filename'] = $uploadList[0]['name'];
      $returndata['filepath'] = __ROOT__.substr($uploadList[0]['savepath'].strtolower($uploadList[0]['savename']),1);
      $model = M('Attachment');
      $idmax=M('Product')->max('id');
      $datas = fopen(substr($returndata['filepath'],1),"r");
      $i=0;
      //$test=fopen('test.txt',"w");

      $att=null;
      while($data=fgetcsv($datas,1000,',')){
        ++$i;
        if($i!=1){
         ++$idmax;
         $ext=fileext($data[2]);
         $filename=uniqid();//唯一
                 rename(UPLOAD_PATH.date('Ym',time()).'/'.$data[2],UPLOAD_PATH.date('Ym',time()).'/'.$filename.'.'.$ext);
         if(!empty($data[3])){

           $pics=explode(',',$data[3]);
           $kid=1;
           $images=null;
           foreach($pics as $pic){

           if(@file_exists(UPLOAD_PATH.date('Ym',time()).'/'.$pic)){
           $picext=fileext($pic);//文件后缀
           rename(UPLOAD_PATH.date('Ym',time()).'/'.$pic,UPLOAD_PATH.date('Ym',time()).'/'.$filename.'_'.$kid.'.'.$picext);
                     $sg=$kid==1?'':':::';
           $images.=$sg.UPLOAD_PATH.date('Ym',time()).'/'.$filename.'_'.$kid.'.'.$picext;
           }
           $kid+=1;
           }
         }
         //fwrite($test,$images."\r");
           //上传的产品图片管理
           $att['moduleid'] = 3;
         $att['id']     = $idmax;
           $att['catid'] =  $data[4];
           $att['userid'] = 1;
           $att['filename'] = $data[2];
           $thumb=$att['filepath'] = UPLOAD_PATH.date('Ym',time()).'/'.$filename.'.'.$ext;
           $att['fileext'] = $ext;
           $att['isimage'] = 1;
           $att['isthumb'] = 1;
           $att['createtime'] = time();
           $att['uploadip'] = get_client_ip();
         $att['filesize']=filesize($thumb);
         $att['status']=1;
           $aid = $model->add($att);
         unset($att);

                 //产品模型
         $Product=M('Product');
         $_POST['id']=$idmax;
         $_POST['title']  =$data[0];//标题
         $_POST['content']=$data[1];//内容
         $_POST['thumb']  =$thumb;  //缩略图
         $_POST['pics']   =$images;      //图片列表
         $_POST['catid']  =$data[4];      //栏目ID
         $categorys=F('Category_'.$this->lang);
         $cat=$categorys[$data[4]];
                 $url = geturl($cat,$_POST,F('Urlrule'));//产品地址
         // fwrite($test,$url[0].'\n');
         $_POST['url']= $url[0];//产品地址
                 $_POST['lang'] =  $data[5];        //语言
         $Product->add($_POST);
        }
      }
     // fclose($datas);


      //fclose($test);
      $this->ajaxReturn($returndata,L('upload_ok'), '1');

    }



  }

  public function upload(){
    //if($_POST['swf_auth_key']!= sysmd5($_POST['PHPSESSID'].$this->userid)) $this->ajaxReturn(0,'1-'.$_POST['PHPSESSID'],0);

    import("@.ORG.UploadFile");
    $upload = new UploadFile();
    //$upload->supportMulti = false;
    //设置上传文件大小
    $upload->maxSize = $this->Config['attach_maxsize'];

    if($_REQUEST['moduleid']=='-1')
      $upload->autoSub = false;
    else
      $upload->autoSub = true;

    $upload->subType = 'date';
    $upload->dateFormat = 'Ym';
    //设置上传文件类型
    $upload->allowExts = explode(',', $this->Config['attach_allowext']);
    //设置附件上传目录
    $upload->savePath = UPLOAD_PATH;
    //设置上传文件规则
    if($_REQUEST['moduleid']=='-1')
      $upload->saveRule = 'logo';
    else
      $upload->saveRule = uniqid;


    //删除原图
    $upload->thumbRemoveOrigin = true;
    if (!$upload->upload()) {
      $this->ajaxReturn(0,$upload->getErrorMsg(),0);
    } else {
      //取得成功上传的文件信息
      $uploadList = $upload->getUploadFileInfo();


      if($_REQUEST['addwater']){ //$this->Config['watermark_enable']  $_REQUEST['addwater']
        import("@.ORG.Image");
        Image::watermark($uploadList[0]['savepath'].$uploadList[0]['savename'],'',$this->Config);
      }

      $imagearr = explode(',', 'jpg,gif,png,jpeg,bmp,ttf,tif');
      $data=array();

      if(strtolower($uploadList[0]['extension'])=='xls'){
          $Xls=M('Xls');
          import("@.ORG.Reader");
          $dataxls = new Spreadsheet_Excel_Reader();
          $dataxls->setOutputEncoding('UTF-8');
          $dataxls->read(substr($uploadList[0]['savepath'].strtolower($uploadList[0]['savename']),2));

          unset($dataxls->sheets[0]['cells'][1]);
          $kj=0;
          $count=count($dataxls->sheets[0]['cells']);
          foreach($dataxls->sheets[0]['cells'] as $sheet){
            $kj=$kj+1;
              $d['partnumr']=$sheet[1];
              $d['brand']=$sheet[2];
              $d['datecode']=$sheet[3];
              $d['pcs']=$sheet[4];
              $d['createtime'] = time();
              $d['status']=1;
                if(!$Xls->add($d)){
          die('第'.$kj.'条导入失败');
        }
      }
        if($count==$kj){
           @unlink(substr($uploadList[0]['savepath'].strtolower($uploadList[0]['savename']),2));
        }


      }else{
      $model = M('Attachment');
      //保存当前数据对象
      $data['moduleid'] = $_REQUEST['moduleid'];
      $data['catid'] = 0;
      $data['userid'] = $_REQUEST['userid'];
      $data['filename'] = $uploadList[0]['name'];
      $data['filepath'] = __ROOT__.substr($uploadList[0]['savepath'].strtolower($uploadList[0]['savename']),1);
      $data['filesize'] = $uploadList[0]['size'];
      $data['fileext'] = strtolower($uploadList[0]['extension']);
      $data['isimage'] = in_array($data['fileext'],$imagearr) ? 1 : 0;
      $data['isthumb'] = intval($_REQUEST['isthumb']);
      $data['createtime'] = time();
      $data['uploadip'] = get_client_ip();
      $aid = $model->add($data);
      $returndata['aid']    = $aid;
      $returndata['filepath'] = $data['filepath'];
      $returndata['fileext']  = $data['fileext'];
      $returndata['isimage']  = $data['isimage'];
      $returndata['filename'] = $data['filename'];
      $returndata['filesize'] = $data['filesize'];
      }
      $this->ajaxReturn($returndata,L('upload_ok'), '1');
        }
  }

  public function filelist(){

    /*$where= $_REQUEST['typeid'] ?  " status=1 " : " status=0 ";*/
    /*$where .=" and userid = ".$this->userid ;*/
    import ( '@.ORG.Page' );
    $count = $this->db->count();
    $page=new Page($count,12);
    $imagearr = explode(',', 'jpg,gif,png,jpeg,bmp,ttf,tif');

    $page->urlrule = 'javascript:ajaxload('.$_REQUEST['typeid'].',{$page},\''.$_REQUEST['inputid'].'\','.$this->isadmin.');';
    $show = $page->show();
    $this->assign("page",$show);
    $list = $this->db->order('aid desc')
    ->limit($page->firstRow.','.$page->listRows)->select();
    foreach((array)$list as $key=>$r){
    $list[$key]['thumb']=in_array($r['fileext'],$imagearr) ? $r['filepath'] : __ROOT__.'/Public/Images/ext/'.$r['fileext'].'.png';
    }
    $this->assign('list',$list);
    /*print_r($list);
    exit;*/
    $this->display();
  }

  function delfile($aid){
    if(empty($aid)){
    $aid=$_REQUEST['aid'];
    }
    $r = delattach(array('aid'=>$aid,'userid'=>$this->userid));
    if($r){
      $this->success ( L ( 'delete_ok' ) );
    }else{
      $this->error ( L ( 'delete_error' ) );
    }

  }

  function cleanfile(){

    $r = delattach(array('status'=>0,'userid'=>$this->userid));
    if($r){
      $this->success ( L ( 'delete_ok' ) );
    }else{
      $this->error ( L ( 'delete_error' ) );
    }
  }

}