<?php
namespace Admin\Controller;
use Org\Util\Form;
class CategoryController extends AdminController {

    protected $db;
    protected $categorys;
    protected $module;

    function _initialize() {

        parent::_initialize();

        foreach((array)$this->module as $rw){
            if($rw['type']==1 && $rw['status']==1) {
                $data['module'][$rw['id']] = $rw;
            }
        }

        $this->module = $data['module'];

        $this->assign($data);
        unset($data);
        $this->db = D('Category');
    }

    /**
     * 列表
     *
     */
    public function index()  {
        if($this->categorys){
            foreach($this->categorys as $r) {
                $leves = count(explode(',',$r['arrparentid']));

                $childnums = count(explode(',',$r['arrchildid']))-1;

                if($leves == 1 && $_SESSION['groupid']!=1){
                    $r['str_manage'] = '<a class="btn btn-primary btn-xs" onclick="add_cat('.$r['id'].','.$leves.',this);" >'.L('add_catname').'</a>
                <a class="btn btn-primary btn-xs" onclick="edit_cat('.$r['id'].','.$r['type'].',this);" >编辑</a> ';

                }else{
                    $r['str_manage'] = '<a class="btn btn-primary btn-xs" onclick="add_cat('.$r['id'].','.$leves.',this);" >'.L('add_catname').'</a>
<a class="btn btn-primary btn-xs" onclick="edit_cat('.$r['id'].','.$r['type'].',this);" >编辑</a>
<a class="btn btn-danger btn-xs" href="javascript:confirm_delete(\''.U('category/delete',array( 'id' => $r['id'])).'\')">'.L('delete').'</a> ';
                }
                $modulName = $this->module[$r['moduleid']]['title'];
                $r['modulename'] = !empty($modulName) ? $modulName : L('Module_url');
                $r['dis'] = $r['ismenu'] ? '<font color="green">'.L('display_yes').'</font>' : '<font color="red">'.L('display_no').'</font>' ;
                $array[] = $r;
            }

            $str = "<tr \$class_id class='\$class_css'>
                    <td  class='table-cell-1'>
                    <input name='listorders[\$id]' type='text' value='\$listorder' class='input-text-c'></td>
                    <td>
                        <span class='spp'>\$spacer</span>\$catname
                    </td>
                    <td>
                        \$modulename<input type='hidden' name='module' value='\$moduleid'>
                    </td>
                    <td>\$dis</td>
                    <td><a href='\$url' target='_blank'>".L('fangwen')."</a></td>
                    <td class='center table-cell-3'>\$str_manage</td>
                </tr>";

            $tree = new \Org\Util\Tree($array);
            $tree->icon = array(L('tree_1'),L('tree_2'),L('tree_3'));
            $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
            $categorys = $tree->get_tree(0, $str);

            $this->assign('categorys', $categorys);

        }

        $m = $this->db->max('id');

        $mid = empty($m)?0:$m;

        $this->assign('maxid',$mid);
        $this->display();
    }



    public function _before_add() {
        foreach((array)$this->Urlrule as $key =>$r){
            if($r['ishtml'])$Urlrule[$key]=$r;
        }
        $this->assign('Urlrule', $Urlrule);
        $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
        $yzh_auth = authcode('1-1-0-1-jpeg,jpg,png,gif-3-0', 'ENCODE',$yzh_auth_key);
        $this->assign('yzh_auth',$yzh_auth);
        $templates = template_file();
        $this->assign ( 'templates',$templates );
        $parentid =  intval($_GET['parentid']);
        $vo['ismenu']=1;
        $vo['moduleid'] =$this->categorys[$parentid]['moduleid'];
        $this->assign('vo', $vo);
        foreach($this->categorys as $r) {
            $array[] = $r;
        }

        $str  = "<option value='\$id' \$selected>\$spacer \$catname</option>";
        $tree = new \Org\Util\Tree($array);
        $select_categorys = $tree->get_tree(0, $str,$parentid);
        $usergroup=F('Role');
        $this->assign('rlist',$usergroup);
        $this->assign('select_categorys', $select_categorys);
    }

    function add(){

        $catid = !empty($_GET['catid'])?$_GET['catid']:0;
        if($catid){
            $category = $this->db->find($catid);
            if($category['moduleid']){
                $this->assign('category',$category);
                $this->assign('modulename',$this->module[$category['moduleid']]['title']);
            }else{
                $category['moduleid'] = 1;
                $this->assign('category',$category);
                $this->assign('modulename','单页模型');
            }

        }
        $this->assign('parentid',$catid);
        $this->display('Category:add');
    }

    /**
     * 提交录入
     *
     */
    public function insert() {

        if(empty($_POST['urlruleid']) && $_POST['ishtml'])
            $this->error(L('do_empty'));

        $_POST['readgroup'] = '';

        if(empty($_POST['moduleid'])){
            $_POST['module'] = '';
            $_POST['catdir'] = '';
        }else{
            $_POST['module'] = $this->module[$_POST['moduleid']]['name'];
            if(empty($_POST['catdir'])){
                $_POST['catdir'] = $this->getCatdir($_POST['catname']);
            }else{
                if(M('Category')->where("catdir='{$_POST['catdir']}'")->select()){
                    $this->error('此页面命名已存在');
                }
            }
        }

        if(APP_LANG){
            $_POST['lang']=LANG_ID;
        }

        if($this->db->create()) {

            $id = $this->db->add();

            if($id) {

                if($_POST['module']=='Page'){

                    $_POST['id'] = $id;

                    if(empty($_POST['title']))
                        $_POST['title'] = $_POST['catname'];

                    $Page = D('page');

                    if($Page->create()){
                        $Page->add();
                    }
                }

                if($_POST['aid']) {

                    $Attachment = M('attachment');
                    $aids = implode(',',$_POST['aid']);
                    $data['catid']    = $_POST['catid'];
                    $data['moduleid'] = $_POST['moduleid'];
                    $data['status']   = '1';
                    $Attachment->where("aid in (".$aids.")")->save($data);
                }

                $this->repair();
                savecache('Category');

                if($_POST['ishtml']){

                    $this->categorys = F('Category');

                    if($this->sysConfig['HOME_ISHTML']) {
                        $this->create_index();
                    }

                    $cat = $this->categorys[$id];

                    $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

                    foreach($arrparentid as $catid) {
                        if($this->categorys[$catid]['ishtml'])
                            $this->clisthtml($catid);
                    }
                }

                $this->success(L('add_ok'));

            }else{
                $this->error(L('add_error'));
            }

        }else{
            $this->error($this->db->getError());
        }
    }


    /**
     * 编辑
     *
     */
    public function edit() {
        $id = intval($_GET['id']);

        foreach((array)$this->Urlrule as $key =>$r){
            if($r['ishtml'])
                $Urlrule[$key]=$r;
        }

        $this->assign('Urlrule', $Urlrule);
        $yzh_auth_key = sysmd5(C('ADMIN_ACCESS').$_SERVER['HTTP_USER_AGENT']);
        $yzh_auth = authcode('1-1-0-1-jpeg,jpg,png,gif-3-0', 'ENCODE',$yzh_auth_key);
        $this->assign('yzh_auth',$yzh_auth);

        $templates = template_file();
        $this->assign('templates', $templates);

        $record = $this->categorys[$id];

        $record['readgroup'] = explode(',',$record['readgroup']);

        if(empty($id) || empty($record)){
            $this->error(L('do_empty'));
        }

        $parentid = intval($record['parentid']);

        $result = $this->categorys;

        foreach($result as $r) {
            //if($r['type']==1) continue;
            $r['selected'] = $r['id'] == $parentid ? 'selected' : '';
            $array[] = $r;
        }

        $str  = "<option value='\$id' \$selected>\$spacer \$catname</option>";
        $tree = new \Org\Util\Tree($array);
        $select_categorys = $tree->get_tree(0, $str,$parentid);

        $this->assign('select_categorys', $select_categorys);
        $this->assign('vo', $record);

        $usergroup = F('Role');
        $this->assign('rlist',$usergroup);

        $this->display();
    }

    /**
     * 提交编辑
     *
     */
    public function update() {

        if(empty($_POST['urlruleid']) && $_POST['ishtml']){
            $this->error(L('do_empty'));
        }

        $_POST['readgroup'] = '';
        $_POST['postgroup'] = '';
        $_POST['module'] = $this->module[$_POST['moduleid']]['name'];
        $_POST['arrparentid'] = $this->getArrParentId($_POST['id']);

        if(empty($_POST['listtype']))
            $_POST['listtype']=0;

        if(empty($_POST['moduleid'])){
            $_POST['module'] = '';
            $_POST['catdir'] = '';
        }else{
            $_POST['module'] = $this->module[$_POST['moduleid']]['name'];
            if(empty($_POST['catdir'])){
                $_POST['catdir'] = $this->getCatdir($_POST['catname'],$_POST['id']);
            }else{
                $r = M('Category')->where("catdir='".$_POST['catdir']."'")->select();
                if(count($r)>1){
                    echo 'a';exit;
                    $this->error('此页面命名已存在');
                }elseif(count($r) == 1 && $r[0]['id'] != $_POST['id']){
                    $this->error('此页面命名已存在');
                }
            }
        }


        if (false === $this->db->create ()) {
            $this->error ( $this->db->getError () );
        }

        if (false !== $this->db->save()) {
            if($_POST['aid']) {
                $Attachment = M('attachment');
                $aids = implode(',',$_POST['aid']);
                $data['moduleid'] = $_POST['moduleid'];
                $data['catid']    = $_POST['id'];
                $data['status']   = '1';
                $Attachment->where("aid in (".$aids.")")->save($data);
            }

            if($_POST['chage_all']){
                $data = array();
                $arrchildid = $this->getArrChildId($_POST['id']);
                $data['urlruleid'] = $_POST['urlruleid'] ? $_POST['urlruleid'] : '0' ;
                $data['postgroup'] = $_POST['postgroup'] ? $_POST['postgroup'] : '';
                $data['ismenu'] = $_POST['ismenu'];
                //$data['ishtml'] = $_POST['ishtml'];
                $data['pagesize'] = $_POST['pagesize'];
                $data['template_list'] = $_POST['template_list'];
                $data['template_show'] = $_POST['template_show'];
                $data['readgroup'] = $_POST['readgroup'] ? $_POST['readgroup'] : '';
                $r = $this->db->where(' id in ('.$arrchildid.')')->data($data)->save();
            }

            $this->repair();
            savecache('Category');

            $model = M($this->module[$_POST['moduleid']]['name']);

            $where = 'catid='.$_POST['id'];
            $list = $model->field('id,catid,url')->where($where)->select();

            foreach($list as $r) {

                $url = geturl($this->categorys[$r['catid']],$r,$this->Urlrule);

                $r['url'] = $url['0'];

                $model->save($r);

            }

            if($_POST['ishtml']){

                $cat=$this->categorys[$_POST['id']];
                if($this->sysConfig['HOME_ISHTML'])
                    $this->create_index();

                $arrparentid = array_filter(explode(',',$cat['arrparentid'].','.$cat['id']));

                foreach($arrparentid as $catid) {
                    if($this->categorys[$catid]['ishtml'])
                        $this->clisthtml($catid);
                }
            }

            $this->assign('jumpUrl', U(MODULE_NAME.'/index') );
            $this->success(L('edit_ok'));
        } else {
            $this->success(L('edit_error').': '.$this->db->getDbError());
        }
    }

    public function repair_cache() {
        $this->repair();
        savecache('Category');
        $this->assign('jumpUrl', U(MODULE_NAME.'/index') );
        $this->success(L('do_success'));
    }

    public function repair() {
        @set_time_limit(500);

        $this->categorys = array();

        if(APP_LANG)$langwhere =  " and lang = ".LANG_ID;

        $this->categorys = $this->db->where("parentid=0".$langwhere)->Order('listorder ASC,id ASC')->select();
        $this->set_categorys($this->categorys);

        if(is_array($this->categorys)) {

            foreach($this->categorys as $id => $cat) {
                $data = array();
                //if($id == 0 || $cat['type']==1) continue;
                $this->categorys[$id]['arrparentid'] = $arrparentid = $this->getArrParentId($id);
                $this->categorys[$id]['arrchildid'] = $arrchildid = $this->getArrChildId($id);
                $this->categorys[$id]['parentdir'] = $cat['parentdir'] = $parentdir = $this->get_parentdir($id);

                $child = is_numeric($arrchildid) ? 0 : 1;

                if( $cat['type']==1){
                    $data['url'] = $cat['url'];
                }else{
                    $url = geturl($cat,'',$this->Urlrule);
                    $data['url'] = $url[0];
                }

                $data['parentdir'] = $parentdir;
                $data['arrparentid'] = $arrparentid;
                $data['arrchildid'] = $arrchildid;
                $data['child'] = $child;
                $data['id'] = $cat['id'];
                $this->db->save($data);
            }
        }
    }

    public function set_categorys($categorys = array()) {

        if (is_array($categorys) && !empty($categorys)) {

            foreach ($categorys as $id => $c) {

                $this->categorys[$c[id]] = $c;

                if(APP_LANG)
                    $langwhere =  " and lang = ".LANG_ID;

                $r = $this->db->where("parentid = $c[id]".$langwhere)->Order('listorder ASC,id ASC')->select();
                $this->set_categorys($r);
            }
        }
        return true;
    }

    public function get_parentdir($id) {

        if($this->categorys[$id]['parentid']==0)
            return '';

        $arrparentid = $this->categorys[$id]['arrparentid'];

        unset($r);

        if ($arrparentid) {

            $arrparentid = explode(',', $arrparentid);

            $arrcatdir = array();

            foreach($arrparentid as $pid) {

                if($pid==0) continue;

                $arrcatdir[] = $this->categorys[$pid]['catdir'];
            }
            return implode('/', $arrcatdir).'/';
        }
    }

    public function getArrParentId($id, $arrparentid = '') {

        if(!is_array($this->categorys) || !isset($this->categorys[$id])) {
            return false;
        }

        $parentid = $this->categorys[$id]['parentid'];

        $arrparentid = $arrparentid ? $parentid.','.$arrparentid : $parentid;

        if($parentid) {
            $arrparentid = $this->getArrParentId($parentid, $arrparentid);
        } else {
            $this->categorys[$id]['arrparentid'] = $arrparentid;
        }
        return $arrparentid;
    }

    public function getArrChildId($id) {

        $arrchildid = $id;

        if(is_array($this->categorys)) {

            foreach($this->categorys as $catid => $cat) {

                if($cat['parentid'] && $id != $catid) {

                    $arrparentids = explode(',', $cat['arrparentid']);

                    if(in_array($id, $arrparentids))
                        $arrchildid .= ','.$catid;
                }
            }
        }
        return $arrchildid;
    }

    public function delete() {

        $catid = intval($_GET['id']);

        $module = $this->categorys[$catid]['module'];

        if($this->categorys[$catid]['type']==1){

            if($this->categorys[$catid]['arrchildid']!=$catid)
                $this->error(L('category_does_not_allow_delete'));

            $this->db->delete($catid);

            delattach("catid in($catid)");

        }else{

            $module = M($module);

            $arrchildid = $this->categorys[$catid]['arrchildid'];

            $where = "catid in(".$arrchildid.")";

            $count = $module->where($where)->count();

            if($count)
                $this->error(L('category_does_not_allow_delete'));

            $this->db->delete($arrchildid);

            $moduleid = $this->mod[$module];

            delattach("moduleid =$moduleid and catid in($arrchildid)");

            $arr = explode(',',$arrchildid);

            foreach((array)$arr as $r){
                if($this->categorys[$r]['module']=='page'){
                    $module=M('page');
                    $module->delete($r);
                }
            }
        }
        $this->repair();
        savecache('Category');
        $this->success(L('do_success'));
    }

    function getCatdir($catname,$catid=""){
        $catdir = Pinyin(strtolower($catname));

        $r = M('Category')->where("catdir='{$catdir}'")->find();
        if(!empty($r) && $r['id']!=$catid){
            $maxId = !empty($catid)?$catid:$this->db->max('id');
            $catdir = str_replace(" ","",$catdir).$maxId;
         }else{
            $catdir = str_replace(" ","",$catdir);
        }

        return $catdir;
    }

}