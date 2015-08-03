<?php
/**
 *
 * Base (前台公共模块)
 *
 */
namespace Home\Controller;
use Think\Controller;
use Org\Util\Form;
use Org\Util\Online;
class BaseController extends Controller {

    protected $Config;
    protected $sysConfig;
    protected $categorys;
    protected $module;
    protected $moduleid;
    protected $mod;
    protected $db;
    protected $Type;
    protected $Role;
    protected $_userid;
    protected $_groupid;
    protected $_email;
    protected $_username;
    protected $forward;
    protected $user_menu;
    protected $Lang;
    protected $member_config;


    public function _initialize()
    {
        $this->sysConfig = F('sys.config');
        $this->module    = F('Module');
        $this->Role      = F('Role');
        $this->Type      = F('Type');
        $this->mod       = F('Mod');

        if(APP_LANG){
            $this->Lang = F('Lang');
            $this->assign('Lang',$this->Lang);
            if(isset($_GET['l'])){
                //if(!$this->Lang[$_GET['l']]['status']) $this->error ( L ( 'NO_LANG' ) );
                $lang = $_GET['l'];
            }else{
                $lang = $this->sysConfig['DEFAULT_LANG'];
            }
            define('LANG_NAME', $lang);
            define('LANG_ID', $this->Lang[$lang]['id']);
            $this->categorys = F('Category_'.$lang);
            $this->Config = F('Config_'.$lang);
            $this->assign('l',$lang);
            $this->assign('langid',LANG_ID);
            $T = F('config_'.$lang,'', './Themes/Home/'.$this->sysConfig['DEFAULT_THEME'].'/');
            C('TMPL_CACHFILE_SUFFIX',$lang.C('TMPL_CACHFILE_SUFFIX'));
            cookie('think_language',$lang);
        }else{
            $T = F('config_'.$this->sysConfig['DEFAULT_LANG'],'', './Themes/Home/'.$this->sysConfig['DEFAULT_THEME'].'/');
            $this->categorys = F('Category');
            $this->Config = F('Config');
            cookie('think_language',$this->sysConfig['DEFAULT_LANG']);
        }

        $_GET['id'] = !empty($_GET['id'])?$_GET['id']:0;
        $c_atid = !empty($_GET['catid'])?$_GET['catid']:$_GET['id'];
        $c_atid = intval($c_atid);

        if(empty($c_atid)){
            $Cat = F('Cat_'.$lang);
            $c_atid = $Cat[I('get.catdir')];
        }

        if(array_key_exists($c_atid,$this->categorys)){
            $parencats = explode(',',$this->categorys[$c_atid]['arrparentid']);
            $max_parent_catid = empty($parencats[1]) ? $c_atid : $parencats[1];
            $this->assign('max_parent_catid',$max_parent_catid);
            $this->assign('max_parent_catname',$this->categorys[$max_parent_catid]['catname']);
        }

        $this->assign('T',$T);
        $this->assign($this->Config);
        $this->assign('Role',$this->Role);
        $this->assign('Type',$this->Type);
        $this->assign('Module',$this->module);
        $this->assign('Cats',$this->categorys);
        $form = new \Org\Util\Form();
        $this->assign('form', $form);

        C('PAGE_LISTROWS',$this->sysConfig['PAGE_LISTROWS']);
        C('URL_M',$this->sysConfig['URL_MODEL']);
        C('URL_M_PATHINFO_DEPR',$this->sysConfig['URL_PATHINFO_DEPR']);
        C('URL_M_HTML_SUFFIX',$this->sysConfig['URL_HTML_SUFFIX']);
        C('URL_LANG',$this->sysConfig['DEFAULT_LANG']);
        C('DEFAULT_THEME_NAME',$this->sysConfig['DEFAULT_THEME']);

        $session = new \Org\Util\Online();

        if($_COOKIE['ww_auth']){
            $yzh_auth_key = sysmd5($this->sysConfig['ADMIN_ACCESS'].$_SERVER['HTTP_USER_AGENT']);

            list($userid,$groupid, $password) = explode("-", authcode($_COOKIE['ww_auth'], 'DECODE', $yzh_auth_key));
            $_SESSION['yzh_member']['userid'] = $userid;
            $this->_username = $_COOKIE['ww_username'];
            $this->_groupid = $groupid;
            $this->_email = $_COOKIE['ww_email'];
        }else{
            $this->_groupid = $_COOKIE['ww_groupid'] = 4;
            $this->_userid = 0;
        }

        $this->assign('username',$this->_username);

        foreach((array)$this->module as $r){
            if($r['issearch'])$search_module[$r['name']] = L($r['name']);
            if($r['ispost'] && (in_array($this->_groupid,explode(',',$r['postgroup']))))
                $this->user_menu[$r['id']]=$r;
        }

        $this->assign('search_module',$search_module);
        $this->assign('module_name',CONTROLLER_NAME);
        $this->assign('action_name',ACTION_NAME);

        if($_SERVER['HTTP_X_REWRITE_URL']){
             $current = $_SERVER['HTTP_X_REWRITE_URL'];
        }else{
             $current = $_SERVER['REQUEST_URI'];
        }

        $this->assign('current',$current);
    }

    public function index($catid='',$controller='')
    {
        $this->Urlrule = F('Urlrule');

        if(empty($catid)){
            $catid = intval($_REQUEST['id']);
        }

        $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);
        if($catid){
            $cat = $this->categorys[$catid];
            $bcid = explode(",",$cat['arrparentid']);
            $bcid = $bcid[1];
            if($bcid == '')
                $bcid=intval($catid);

            if(empty($controller))
                $controller = $cat['module'];

            $this->assign('module_name',$controller);
            unset($cat['id']);
            $this->assign($cat);
            $cat['id']=$catid;
            $this->assign('catid',$catid);
            $this->assign('bcid',$bcid);
        }

        if($cat['readgroup'] && $this->_groupid!=1 && !in_array($this->_groupid,explode(',',$cat['readgroup']))){
            $this->assign('jumpUrl',URL('User-Login/index'));
            $this->error(L('NO_READ'));
        }

        $fields = F($this->mod[$controller].'_Field');

        foreach($fields as $key=>$r){
            $fields[$key]['setup'] = string2array($fields[$key]['setup']);
        }

        $this->assign( 'fields', $fields);

        if($catid){
            $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
            $this->assign ('seo_title',$seo_title);
            $this->assign ('seo_keywords',$cat['keywords']);
            $this->assign ('seo_description',$cat['description']);

            //$where = " status=1 ";
            $where = " ";

            if($cat['child']){
                $where .= "  catid in(".$cat['arrchildid'].")";
            }else{
                $where .=  " catid=".$catid;
            }

            if(empty($cat['listtype'])){

                $this->db = M($controller);

                $count = $this->db->where($where)->count();


                if($count){
                    import( "@.ORG.Page" );
                    $listRows =  !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
                    $page = new Page ( $count, $listRows );

                    $page->urlrule = geturl($cat,'',$this->Urlrule);
                    $pages = $page->show();

                    $field =  $this->module[$this->mod[$controller]]['listfields'];

                    $field =  $field ? $field : 'id,catid,userid,url,username,title,title_style,keywords,description,thumb,createtime,hits';

                    $list = $this->db->field($field)->where($where)->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();

                    $this->assign('pages',$pages);
                    $this->assign('list',$list);
                }
                if($controller == 'Page'){
                    $template_r = 'index';
                }else{
                    $template_r = 'list';
                }
            }else{
                $template_r = 'index';
            }
        }else{
            $template_r = 'list';
        }

        $template = $cat['template_list'] ? $cat['template_list'] : $template_r;

        $this->display($module.':'.$template);
    }

    public function show($id='',$module='')
    {
        $this->Urlrule = F('Urlrule');
        $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);
        $id = $id ? $id : intval($_REQUEST['id']);

        if($_GET['chid']) {
            $id = $_GET['chid'];
            $this->assign('chid',$_GET['chid']);
        }

        $module = $module ? $module : CONTROLLER_NAME;
        $this->assign('module_name',$module);
        $this->db= M($module);;
        $data = $this->db->find($id);

        //关联信息
        if(!empty($data['gl'])){
            $gl_data = $this->db->field('url,title,thumb')->where('id in('.$data['gl'].')')->select();
        }

        $listorder = $data['listorder'];

        //上一个，下一个
        if($listorder!=0){
            $prea = $this->db->field('title,url')->where('catid="'.$data['catid'].'" AND '.$listorder.' > listorder')->order('listorder desc')->limit('1')->select();
            $next = $this->db->field('title,url')->where('catid="'.$data['catid'].'" AND '.$listorder.' < listorder')->order('listorder asc')->limit('1')->select();
        } else{
            $prea = $this->db->field('title,url')->where('catid="'.$data['catid'].'" AND '.$id.' < id')->order('id asc')->limit('1')->select();
            $next = $this->db->field('title,url')->where('catid="'.$data['catid'].'" AND '.$id.' > id')->order('id desc')->limit('1')->select();
        }

        $this->assign('prea',$prea[0]);
        $this->assign('next',$next[0]);


        $catid = $data['catid'];
        $cat = $this->categorys[$data['catid']];
        if(empty($cat['ishtml']))
            $this->db->where("id=".$id)->setInc('hits'); //添加点击次数

        $bcid = explode(",",$cat['arrparentid']);
        $bcid = $bcid[1];
        if($bcid == '') $bcid=intval($catid);


        $chargepoint = $data['readpoint'] ? $data['readpoint'] : $cat['chargepoint'];

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

        //手动分页
        $CONTENT_POS = strpos($data['content'], '[page]');
        if($CONTENT_POS !== false) {

            $urlrule    = geturl($cat,$data,$this->Urlrule);
            $urlrule    = str_replace('%7B%24page%7D','{$page}',$urlrule);
            $contents   = array_filter(explode('[page]',$data['content']));
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
            $this->assign ('pages',$pages);
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

        $this->assign ($data);
        $this->display($module.':'.$template);
    }

    public function down()
    {

        $module = $module ? $module : CONTROLLER_NAME;
        $id = $id ? $id : intval($_REQUEST['id']);
        $this->db= M($module);
        $filepath = $this->db->where("id=".$id)->getField('file');
        //$this->db->where("id=".$id)->setInc('downs');

        if(strpos($filepath, ':/')) {
            header("Location: $filepath");
        } else {
            if(!$filename) $filename = basename($filepath);
            $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
            if(strpos($useragent, 'msie ') !== false) $filename = rawurlencode($filename);
            $filetype = strtolower(trim(substr(strrchr($filename, '.'), 1, 10)));
            $filesize = sprintf("%u", filesize($filepath));
            if(ob_get_length() !== false) @ob_end_clean();
            header('Pragma: public');
            header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: pre-check=0, post-check=0, max-age=0');
            header('Content-Transfer-Encoding: binary');
            header('Content-Encoding: none');
            header('Content-type: '.$filetype);
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            header('Content-length: '.$filesize);
            readfile($filepath);
        }
        exit;
    }

    public function hits()
    {
        $module    = $module ? $module : CONTROLLER_NAME;
        $id        = $id ? $id : intval($_REQUEST['id']);
        $this->db = M($module);
        $this->db->where("id=".$id)->setInc('hits');

        if($module=='Download'){
            $r = $this->db->find($id);
            echo '$("#hits").html('.$r['hits'].');$("#downs").html('.$r['downs'].');';
        }else{
            $hits = $this->db->where("id=".$id)->getField('hits');
            echo '$("#hits").html('.$hits.');';
        }
        exit;
    }

    public function verify()
    {
        header('Content-type: image/jpeg');
        $type = isset($_GET['type'])?$_GET['type']:'jpeg';
        import("@.ORG.Image");
        Image::buildImageVerify(4,1,$type);
    }

    function checkLogin()
    {
        if(empty($_SESSION['yzh_member']['username']) ){
            $this->assign('jumpUrl', U('User/login/index') );
            $this->error('你还未登陆网站');
        }
    }
}