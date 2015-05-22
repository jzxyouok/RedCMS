<?php
namespace Develop\Controller;
use Think\Developbase;
class UrlruleController extends DevelopbaseController {

	protected $db;

  function _initialize() {
		parent::_initialize();
		$this->db = D('admin/urlrule');
  }
}