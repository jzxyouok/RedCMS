<?php
/**
 * undocumented class
 *
 * @package default
 * @author
 **/
namespace Home\Controller;
use Home\Base;
class CartController extends BaseController{

  function _initialize() {
    parent::_initialize();
    $this->checkLogin();
    $this->db = M('Cart');
    $this->sessionid =  cookie('onlineid');
  }

  public function cartnow(){

    $id = $_POST['id'];
    $_SESSION['cart'][$id] = json_encode($_POST);

    $num = intval($_POST['num']);
    $moduleid = intval($_POST['moduleid']);
    $module = $this->module[$moduleid]['name'];

    if(!$module){
      $res['msg']='error';
    }

    $session_info = M('Online')->find($this->sessionid);

    $r = M($module)->find($id);
    $cart = $this->db->where("product_id='{$id}' and sessionid='{$this->sessionid}'")->find();

    if($cart){
      $cart['number']=$cart['number']+$num;
      $cart['price'] = $cart['product_price']*$cart['number'];
      $rs = $this->db->save($cart);
    }else{
      $data=array();
      $data['userid']=$session_info['userid'];
      $data['sessionid']=$session_info['sessionid'];
      $data['product_id']=$r['id'];
      $data['product_thumb']=$r['thumb'];
      $data['product_url']=$r['url'];
      $data['product_name']=$r['title'];
      $data['product_price'] =$r['price'];
      $data['moduleid']=$moduleid;
      $data['number']=$num;
      $data['price']= $data['product_price']*$data['number'];
      $rs = $this->db->add($data);
    }

    $res['data']= $rs ? 1 : 0 ;


    $this->redirect('Cart/index');
  }

  public function index(){
    $cart = $this->db->where("sessionid='{$this->sessionid}'")->select();

    $total = 0;
    foreach($cart as $key=>$val){
      $total += $cart[$key]['price'];
    }

    $this->assign('total', $total);
    $this->assign('list', $cart);
    $this->display();
  }

  public function edit(){
    $id = I('id');
    $num = I('num');

    $_SESSION['cart'][$id] = json_decode($_SESSION['cart'][$id],ture);
    $_SESSION['cart'][$id]['num'] = $num;
    $_SESSION['cart'][$id]['subtotal'] = $num*$_SESSION['cart'][$id]['price'];

  	$condition['userid'] = $_SESSION['yzh_member']['id'];
  	$condition['product_id'] = $id;

    $data = $this->db->where($condition)->find();
    $data['number'] = $num;
    $data['price'] = $data['product_price']*$data['number'];
    $rs = $this->db->save($data);
    $res['data']= $rs ? 1 : 0 ;
    if($res['data'])
      $_SESSION['cart'][$id] = json_encode($_SESSION['cart'][$id]);
  }

  public function del(){
    $id = $_POST['id'];

    $rs = $this->db->delete($id);
    $res['data']= $rs ? 1 : 0 ;
    unset($_SESSION['cart'][$id]);
    echo json_encode($res); exit;
  }

  public function clear(){
    unset($_SESSION['cart']);
    $this->redirect('product/index');
  }
}