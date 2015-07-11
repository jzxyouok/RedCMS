<?php

/**
 *
 * Config(系统配置文件)
 *
 */
namespace Admin\Controller;
class WapController extends BaseController {

    protected $db;
    protected $config;
    protected $seo_config;
    protected $user_config;
    protected $weibo_config;
    protected $ditu_config;
    protected $liul_config;
    protected $wap_config;
    protected $site_config;
    protected $mail_config;
    protected $attach_config;


    public function config()
    {

        $config = M('config')->select();

        foreach($config as $key=>$r) {
            if($r['groupid']==11)
                $this->wap_config[$r['varname']]=$r;
        }

        $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
        $yzh_auth = authcode('1-1-0-1-jpeg,jpg,png,gif-3-0', 'ENCODE',$yzh_auth_key);
        $this->assign('yzh_auth',$yzh_auth);

        $this->assign('wap_config',$this->wap_config);
        $this->assign($this->Config);
        $this->display();
    }


    public function insert()
    {

        if(APP_LANG)
          $_POST['lang']=LANG_ID;

        if(false === $this->db->create()) {
          $this->error ( $this->db->getError () );
        }
        //保存当前数据对象
        $list=$this->db->add ();
        savecache('Config');
        if ($list!==false) {
          $this->success (L('add_ok'));
        }else{
          $this->error (L('add_error'));
        }
    }

    public function dosite()
    {
        if(C('TOKEN_ON') && !$this->db->autoCheckToken($_POST))
          $this->error(L('_TOKEN_ERROR_'));

        if(APP_LANG && in_array($_POST['groupid'], array(1,2)))
          $where = ' and lang='.LANG_ID;


        foreach($_POST as $key=>$value){
          $data['value']=$value;
          $f = $this->db->where("varname='".$key."'".$where)->save($data);
        }
        $f = savecache(ucfirst(MODULE_NAME));

        if($_POST['DEFAULT_LANG'])
            routes_cache($_POST['URL_URLRULE']);

        if($f){
            $this->success(L('do_ok'));
        }else{
            $this->error(L('do_error'));
        }
    }


    function picmanage()
    {
        $fid = intval($_REQUEST['fid']);
        if(!$fid){
          $this->error(L('do_empty'));
        }

        $map = array();
        if(APP_LANG){
            $map['lang'] = array('eq',LANG_ID);
        }

        $slide = D('Slide')->find($fid);

        $map['fid'] = array('eq',$fid);
        $list = D('slide_data')->where($map)->order("listorder ASC ,id DESC ")->select();
        $this->assign('list', $list);
        $this->assign('fid', $fid);
        $this->assign('slide', $slide);

        $this->display();

    }

    public function editblock() {

        $pos = strip_tags($_REQUEST['pos']);
        $model = M('Block');
        $pk = ucfirst($model->getPk());
        $id = $_REQUEST[$model->getPk()];

        if(empty($id))
            $this->error(L('do_empty'));

        if($pos){
            $map['pos']=array('eq',$pos);
            if(APP_LANG)$map['lang']=array('eq',LANG_ID);

            $vo = $model->where($map)->find();
        }else{
            $do='getBy'.$pk;
            $vo = $model->$do ( $id );
        }

        $this->assign('vo', $vo);
        $this->display();
    }

}