<?php
namespace Develop\Controller;
use Think\Developbase;
class RoleController extends DevelopbaseController {

  function _initialize() {
    parent::_initialize();

  }

  public function _before_insert() {
    $_POST['allowpost'] = $_POST['allowpost'] ? 1 : 0 ;
    $_POST['allowpostverify'] = $_POST['allowpostverify'] ? 1 : 0 ;
    $_POST['allowupgrade'] = $_POST['allowupgrade'] ? 1 : 0 ;
    $_POST['allowsendmessage'] = $_POST['allowsendmessage'] ? 1 : 0 ;
    $_POST['allowattachment'] = $_POST['allowattachment'] ? 1 : 0 ;
    $_POST['allowsearch'] = $_POST['allowsearch'] ? 1 : 0 ;
  }


  public function _before_update() {
    $_POST['allowpost'] = $_POST['allowpost'] ? 1 : 0 ;
    $_POST['allowpostverify'] = $_POST['allowpostverify'] ? 1 : 0 ;
    $_POST['allowupgrade'] = $_POST['allowupgrade'] ? 1 : 0 ;
    $_POST['allowsendmessage'] = $_POST['allowsendmessage'] ? 1 : 0 ;
    $_POST['allowattachment'] = $_POST['allowattachment'] ? 1 : 0 ;
    $_POST['allowsearch'] = $_POST['allowsearch'] ? 1 : 0 ;
  }

}