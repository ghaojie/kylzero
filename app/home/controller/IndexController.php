<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/21
 * Time: 14:32
 */
namespace  app\home\controller;

use hd\core\Controller;
use hd\model\Model;
use hd\view\View;
use system\model\Stu;

//继承controlle类
class IndexController extends Controller
{
    public function index(){
        //echo 3333333;
        //测试是否进入
    //    parent::index();
    //    调用父类方法
    //    View::make();
    //    view调用make函数
    //    (new View())->make();
    //    p(View::with());
    //   设置两个变量传参
        $test ='hdw';
        $hd=[1,2,3];
        //echo一个对象，可以使————tostring生效，链式操作不受顺序影响
       echo View::with(compact('test','hd'))->make('welcome');
        return $this;
    //model测试



    }
    public function  add()
    {
        //parent::message();
        //$this->message();
        $this->setRedirect('?s=home/article/index')->message('添加成功');
    }
    public function test(){
        //echo 2222;                                 //测试是否进入
        //$res =c('database');                       //测试c（）函数
        //p($res);
        //$res =c('databae.name');
        //p($res);
        //$data = Model::query('select * from student');
        //p($data);                                   //测试数据库是否连接
        // return  View::make();
        //$data=Stu::find(2);
        //p(get_called_class ());
        //$data = Stu::where('id=1')->get();
        //$data = Stu::where('sex = "man" ')->orderBy('id desc')->get();
        $data = Stu::where('sex = "man" ')->col('name , age ')->orderBy('id desc')->limit(3)->get();
        p($data);
    }
}