<?php
/**
 *
 * Empty (空模块)
 */
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends Controller {

    public function _empty() {

        //空操作 空模块
        if(CONTROLLER_NAME!='Urlrule'){
            $Mod = F('Mod');
            $m = strtolower(CONTROLLER_NAME);
            if(!$m){
                throw_exception('404');
            }
        }

        R('Content/'.ACTION_NAME);

    }
}