<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/21
 * Time: 14:26
 */
//命名空间为Hd下的core目录
namespace hd\core;
//框架 启动类
class Boot{
    //定义一个静态方法，执行应用
    public static  function  run(){
        //测试是否正常运行
        //p("ss"); die;
        //初始框架
        self::init();
        //执行应用类
        self::appRun();

    }
    public static function  init(){
        //echo 9999;
        //测试代码是否被运行
        //头部
        //设置时区
        //开启session(如果有session_id()，说明已开启session，没有session_id，再开启session)
        header(c('prc.type'));
        date_default_timezone_get(c('prc.sh'));
        session_id()||session_start();
    }
    public static function appRun(){
        //测试代码是否运行到这一步
        //echo 555;die;
        // 实例化home下IndexController和ArticleController类，调用index方法
        //实例化admin下indexcontroller  调用index
        //( new \app\home\controller\IndexController())->index();
        //( new \app\home\controller\ArticleController())->index();
        //( new \app\admin\controller\IndexController())->index();
        if(isset($_GET['s'])){
          $s=$_GET['s'];
          //p($s);
          //判断地址栏参数是否存在
          //  用/拆分接受到的数组
          $info =explode('/',$s);
          //p($info);
            $m = $info[ 0 ];
            $c = $info[ 1 ];
            $a = $info[ 2 ];

        }else{
            $m ='home';
            $c='index';
            $a='index';
        }
        //设置全局变量
        define('MODULE',$m);
        define('CONTROLLER',strtolower($c));
        define('ACTION',$a);
        //( new \app\home\controller\IndexController())->index();
        $controller ='app\\'.$m.'\controller\\'.ucfirst($c).'Controller';
        call_user_func_array ( [ new $controller , $a ] , [] );


}
}