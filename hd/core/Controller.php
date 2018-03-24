<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/22
 * Time: 14:20
 */
namespace  hd\core;
class Controller
{
  private $url;
  //设置一个类
  public function  index(){
      echo 'hh123';
      //测试
  }
  public  function  message($mes){
      include './view/message.php';
      //引入模板文件
  }
  public function  setRedirect($url=''){
      if($url){
          $this->url=$url;
      }else{
          $this->url='javascript:history.back();';
      }
      return $this;
  }
}
