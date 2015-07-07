<?php
/**
 *
 * Empty (空模块)
 */
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {

	public function _empty() {

		$a = ACTION_NAME?ACTION_NAME:"index";

		//空操作 空模块
		if(CONTROLLER_NAME!='Urlrule'){
			$Mod = F('Mod');

			if(!$Mod[CONTROLLER_NAME]){
				header("HTTP/1.0 404 Not Found");
				$this->display();
			}
		}

		$id = intval($_REQUEST['id']);
		$catid = intval($_REQUEST['catid']);
		$moduleid = intval($_REQUEST['moduleid']);

		if(CONTROLLER_NAME=='Urlrule'){
			if(APP_LANG){
				$lang = $_REQUEST['l'] ? '_'.$_REQUEST['l'] : '_'.C('DEFAULT_LANG');
			}
			if($_REQUEST['catdir']){
				$Cat = F('Cat'.$lang);

				$catid = $catid ? $catid : $Cat[$_REQUEST['catdir']];
				unset($Cat);
			}

			if($_REQUEST['module']){
				$m = $_REQUEST['module'];
			}elseif($moduleid){
				$Module = F('Module');
				$m = $Module[$moduleid]['module'];
				unset($Module);
			}elseif($catid){
				$Category = F('Category'.$lang);
				$m = $Category[$catid]['module'];
				unset($Category);
			}else{
				header("HTTP/1.0 404 Not Found");
				$this->display();
			}
			if($a=='index') $id=$catid;
		}else{
			if(empty($id)){
				$Cat = F('Cat'.$lang);
				$id = $Cat[$_REQUEST['id']];
				unset($Cat);
			}
			$m = CONTROLLER_NAME;
		}

		$myclass = $m.'Controller';
		if(class_exists($myclass)){
			$bae = new $myclass();

			if(!method_exists($bae,$a)){
				header("HTTP/1.0 404 Not Found");
				$this->display();
			}
			$_GET['id'] = $id;
			$bae->$a($id,$m);
		}else{

			$bae = new BaseController();

			$bae->$a($id,$m);
		}
	}

}