<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/22
 * Time: 15:21
 */
namespace hd\view;
class Base{
    private $file;
    private $data=[];
    public function make($tpl=''){
        //echo 1;
        //include '../app/home/view/index/welcome.php';

        $tpl=$tpl?:ACTION;
        $this->file='../app/'.MODULE.'/view/'.CONTROLLER.'/'.$tpl.'.'.c('view.suffix');
        return $this;
    }
    //分配变量
    public function with($var=[]){
        //echo 'ss22';
        //p($var);
        $this->data=$var;
//返回给View里面的runParse方法
        return $this;
    }
    public  function __toString()
    {
        // TODO: Implement __toString() method.
        //将接收到的数组拆分成变量
        extract($this->data);
        //判断文件是否存在
        if (!is_null($this->file)){
            //加载这个模板
            include $this->file;
        }
        return '';
    }


}