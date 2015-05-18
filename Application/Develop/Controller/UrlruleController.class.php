<?php

class UrlruleController extends DevelopbaseController {

	protected $db;

  function _initialize() {
		parent::_initialize();
		$this->db = D('admin/urlrule');
  }
}