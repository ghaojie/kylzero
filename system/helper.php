
<?php
/**
 * 打印函数
 * @param $var	打印的变量
 */
function p($var){
    echo '<pre style="width: 100%;padding: 5px;background: #CCCCCC;border-radius: 5px">';
    if(is_bool ($var) || is_null ($var)){
        var_dump ($var);
    }else{
        print_r ($var);
    }
    echo '</pre>';
}

/**
 * 定义常量:IS_POST
 * 将侧是否为post请求
 */
define ('IS_POST',$_SERVER['REQUEST_METHOD']=='POST'?true:false);


function c($var = null){
    //echo 'cccc';   //测试
    if(is_null($var)){
        $files= glob('../system/config/*');   //扫描config下的文件
        //p($files);                                    //打印扫描出来的
        $data=[];
        foreach ($files as $file){
            $content = include $file;                 //加载文件并接收文件里的数据
            //p($content);                            //打印数据
            $fileName = basename($file);
            //p($fileName);                           //获取文件名
            //p(strpos($fileName,'.php') );           //文件名到后缀名有几位数
            // 截取文件名并打印测试
            $index=substr($fileName,0,(strpos($fileName,'.php')));
            //打印出来的$data为索引数组，将$index传入改为关联数组
            $data[$index]=$content;
            //p($index);
            //p($data);
        }
        return $data;
    }
    $info =explode('.',$var);
    //p(count($info));         // 打印拆分后的数组
    //p($info);                 //打印数组
    //p($var);                  //打印文件名
    //1为database 2为database,names对此进行判断
    if(count($info)==1){
        $file='../system/config/'.$var.'.php';
        return is_file ($file)? include $file : null ;
    }
    if(count($info)==2){
        $file='../system/config/'.$info[0].'.php';
        if(is_file ($file)){
            $data = include $file;
            return isset($data[$info[1]]) ? $data[$info[1]] : null;
        }else{
            return null;
        }
    }

}

