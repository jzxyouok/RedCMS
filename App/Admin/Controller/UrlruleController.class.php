<?php
namespace Admin\Controller;
use Admin\Public;
class UrlruleAction extends AdminController {

    protected $db;

    function _initialize() {
        parent::_initialize();
        $this->db = D('admin/urlrule');
    }
}