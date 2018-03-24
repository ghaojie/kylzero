<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/22
 * Time: 15:21
 */
namespace hd\view;

class View{
    /**
     * 当调用(在app\home\controller\IndexController()->index()进行的测试)一个不存在的方法时候自动触发
     * @param $name
     * @param $arguments
     * @return mixed
     */
public function __call($name, $arguments)
{
    // TODO: Implement __call() method.
   return self::runParse($name,$arguments);
}
    /**
     * 当静态调用(在app\home\controller\IndexController()->index()进行的测试)一个不存在的方法时候自动触发
     * @param $name			找不到的方法名
     * @param $arguments	该方法的参数
     */
public static function __callStatic($name, $arguments)
{
    // TODO: Implement __callStatic() method.
    return  self::runParse($name,$arguments);
}

    /**
     * 就是为了实例化base调用对应的方法
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function runParse($name,$arguments){
        //echo 111;die;
        //p($arguments);
        //接受Base中$name(with/make)返回值
   return call_user_func_array([new Base(),$name],$arguments);
}
}