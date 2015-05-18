<?php
/**
 *
 * Empty (空模块)
 */
class EmptyController extends Controller {

  public function _empty() {
    //空操作 空模块
    if(MODULE_NAME!='Urlrule'){
      $Mod = F('Mod');
      $m = strtolower(MODULE_NAME);
      if(!$m){
        throw_exception('404');
      }
    }

    R('Develop/Content/'.ACTION_NAME);

  }
}