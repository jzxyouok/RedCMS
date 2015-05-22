<?php

namespace Develop\Controller;
use Develop\Developbase;
class BlockController extends DevelopbaseController {

	protected $db,$Type;

  function _initialize() {
	  parent::_initialize();
	  $this->db = M(MODULE_NAME);
	  $this->Type = F('Type');
	  $pos = !empty($_REQUEST['pos'])?$_REQUEST['pos']:'';
  }

	public function index() {

		if(APP_LANG)
			$map['lang']=array('eq',LANG_ID);

		$this->_list(MODULE_NAME, $map);
      $this->display();
  }

	public function _before_insert() {
		if(APP_LANG)
		 	$_POST['lang']=LANG_ID;
	}

	public function edit() {

		$pos=strip_tags($_REQUEST['pos']);
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

		if($vo['setup'])
			$vo['setup']=string2array($vo['setup']);

		$this->assign('vo', $vo);
		$this->display();
	}


	function insert() {

		$model = D('Block');

		if (false === $model->create ()) {
			$this->error ( $model->getError () );
		}

		$id = $model->add();

		if ($id !==false) {

			if(in_array($name,$this->cache_model))
				savecache($name);

		  $jumpUrl = U('Block/index');

			$this->assign ( 'jumpUrl',$jumpUrl );
			$this->success (L('add_ok'));
		} else {
			$this->error (L('add_error').': '.$model->getDbError());
		}
	}


	function delete(){

		$Block = M('Block');
		$pk = $Block->getPk();
		$id = $_REQUEST [$pk];

		if (isset( $id )) {

			if(false!==$Block->delete($id)){
				delattach(array('moduleid'=>'231','id'=>$id));
				$this->assign( 'jumpUrl', U(MODULE_NAME.'/index') );
				$this->success(L('delete_ok'));
			}else{
				$this->error(L('delete_error').': '.$Block->getDbError());
			}
		}else{
			$this->error (L('do_empty'));
		}
	}
}