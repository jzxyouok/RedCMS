<?php
namespace Home\Controller;
use Home\Base;
class IndexController extends BaseController {

  public function index() {
    $this->display();
  }


  public function form(){
    $this->assign('cpname',$_GET['cpname']);
    $this->assign('cpurl',$_GET['cpurl']);
    $this->display();
  }

  public function login(){
    $this->display();
  }
}