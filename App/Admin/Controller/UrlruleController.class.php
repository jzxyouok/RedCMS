<?php
namespace Admin\Controller;
use Admin\Adminbase;
class UrlruleAction extends AdminbaseAction {

	protected $db;

  function _initialize() {
		parent::_initialize();
		$this->db = D('admin/urlrule');
  }
}