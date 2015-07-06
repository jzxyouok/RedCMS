<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
namespace Home\Controller;
use Home\Base;
class ArticleAction extends BaseAction {

    public function index($catid='',$module='') {
        //获取路由规则
        $this->Urlrule = F('Urlrule');

        $module = 'Article';

        if(empty($catid)){
            $catid = intval($_REQUEST['id']);
        }

        $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);

        if($catid){
            $cat = $this->categorys[$catid];
            $bcid = explode(",",$cat['arrparentid']);
            $bcid = $bcid[1];
            if($bcid == ''){
                $bcid=intval($catid);
            }

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


        if($catid){
            $seo_title = $cat['title'] ? $cat['title'] : $cat['catname'];
            $this->assign ('seo_title',$seo_title);
            $this->assign ('seo_keywords',$cat['keywords']);
            $this->assign ('seo_description',$cat['description']);

            $where = " status=1 ";
            if($cat['child']){
                $where .= " and catid in(".$cat['arrchildid'].")";
            }else{
                $where .=  " and catid=".$catid;
            }

            $model = M('Article');
            $count = $model->where($where)->count();


            if(empty($cat['listtype'])){

                if($count){
                    import( "@.ORG.Page" );
                    $listRows =  !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
                    $page = new Page ( $count, $listRows );

                    $page->urlrule = geturl($cat,'',$this->Urlrule);
                    $pages = $page->show();

                    $field =  $this->module[$this->mod[$module]]['listfields'];

                    $field =  $field ? $field : 'id,catid,userid,url,username,title,title_style,keywords,description,thumb,createtime,hits';

                    $list = $model->field($field)->where($where)->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();

                    $this->assign('pages',$pages);
                    $this->assign('list',$list);
                }
                $template_r = 'list';
            }else{

                if($count){
                    import("@.ORG.Page" );
                    $listRows = !empty($cat['pagesize']) ? $cat['pagesize'] : C('PAGE_LISTROWS');
                    $page = new Page ( $count, $listRows );
                    $page->urlrule = geturl($cat,'',$this->Urlrule);
                    $pages = $page->show();
                    $field =  $this->module[$this->mod[$module]]['listfields'];
                    $field =  $field ? $field : 'id,catid,userid,url,username,title,title_style,keywords,description,thumb,createtime,hits';
                    $list = $model->field($field)->where($where)->order('listorder desc,id desc')->limit($page->firstRow . ',' . $page->listRows)->select();
                    $this->assign('pages',$pages);
                    $this->assign('list',$list);

                }#end if
                $template_r = 'index';
            }
        }

        $template = $cat['template_list'] ? $cat['template_list'] : $template_r;

        $this->display('Article:'.$template);
    }


    //文章详细页
    public function show($id='',$module='')
    {
        $this->Urlrule = F('Urlrule');
        $p = max(intval($_REQUEST[C('VAR_PAGE')]),1);
        $id = $id ? $id : intval($_REQUEST['id']);

        if($_GET['chid']) {
            $id = $_GET['chid'];
            $this->assign('chid',$_GET['chid']);
        }

        $module = 'Article';

        $this->assign('module_name',$module);
        $model = M($module);;
        $data = $model->find($id);

        //关联信息
        if(!empty($data['gl'])){
            $gl_data = $model->field('url,title,thumb')->where('id in('.$data['gl'].')')->select();
        }

        $listorder = $data['listorder'];
        //上一个，下一个
        if($listorder!=0){
            $prea = $model->field('title,url')->where('catid="'.$data['catid'].'" AND '.$listorder.' > listorder')->order('listorder desc')->limit('1')->select();
            $next = $model->field('title,url')->where('catid="'.$data['catid'].'" AND '.$listorder.' < listorder')->order('listorder asc')->limit('1')->select();
        } else{
            $prea = $model->field('title,url')->where('catid="'.$data['catid'].'" AND '.$id.' < id')->order('id asc')->limit('1')->select();
            $next = $model->field('title,url')->where('catid="'.$data['catid'].'" AND '.$id.' > id')->order('id desc')->limit('1')->select();
        }

        $this->assign('prea',$prea[0]);
        $this->assign('next',$next[0]);

        $catid = $data['catid'];
        $cat = $this->categorys[$data['catid']];
        if(empty($cat['ishtml']))
            $model->where("id=".$id)->setInc('hits'); //添加点击次数

        $bcid = explode(",",$cat['arrparentid']);
        $bcid = $bcid[1];
        if($bcid == '') $bcid=intval($catid);

        if($data['readgroup']){
            if($this->_groupid!=1 && !in_array($this->_groupid,explode(',',$data['readgroup'])) )$noread=1;
        }elseif($cat['readgroup']){
            if($this->_groupid!=1 && !in_array($this->_groupid,explode(',',$cat['readgroup'])) )$noread=1;
        }

        if($noread==1){
            $this->assign('jumpUrl',URL('User-Login/index'));
            $this->error (L('NO_READ'));
        }

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

            $urlrule = geturl($cat,$data,$this->Urlrule);
            $urlrule =  str_replace('%7B%24page%7D','{$page}',$urlrule);
            $contents = array_filter(explode('[page]',$data['content']));
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

        if(!empty($data['template'])){
            $template = $data['template'];
        }elseif(!empty($cat['template_show'])){
            $template = $cat['template_show'];
        }else{
            $template = 'show';
        }

        $this->assign('catid',$catid);
        $this->assign ($cat);
        $this->assign('bcid',$bcid);
        $this->assign('gl_data',$gl_data);

        $this->assign ($data);
        $this->display('Article:'.$template);
    }

}