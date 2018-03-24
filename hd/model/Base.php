<?php
/**
 * Created by PhpStorm.
 * User: guo
 * Date: 2018/3/22
 * Time: 20:48
 */
namespace hd\model;
use PDO;
use Exception;
class Base
{
    private static $pdo =null ;
    private  $table;                     //操作数据表
    private $where='';                   //where条件
    private  $order='';                  //order排序
    private  $limit='';                  //limit条件
    private  $col='';
    //列
    public function __construct($class)
    {
        //链接数据库
        //p(get_called_class ());
        if(is_null(self::$pdo)){

            try {
                //echo 1;die;
                //p(c('database.host'));
                $dsn   = 'mysql:host=' . c ( 'database.host' ) . ';dbname=' . c ( 'database.name' );
                //echo 1;die;
                self::$pdo = new PDO( $dsn , c ( 'database.user' ) , c ( 'database.pass' ) );

                self::$pdo->query ( 'set names utf8' );
                self::$pdo->setAttribute ( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION );
            } catch ( Exception $e ) {
                throw new Exception( $e->getMessage () );
            }
        }
        //获取对应的模型名称
        $this->table = strtolower ( ltrim ( strrchr ( $class , '\\' ) , '\\' ) );
        //p($this->table);
    }

    public function  get(){
        //echo 1111;
        $sql =" select ".$this->col. "from ".$this->table . $this ->where . $this->order . $this->limit;
        p($sql);
         return $this->query($sql);
    }

    public function col($col){
        $this->col = $col ?  $col : '';
        return $this;
    }

    public  function where($where){
           //echo  111;
           //p($where);

           $this->where= $where ? ' where ' . $where : '';
           //p($this->where);

           return $this;
    }

    public function orderBy($order){
        //p($order);
        $this->order = $order ? ' order by ' . $order : '';
        return $this;
    }

    public function limit($limit){
        $this->limit=$limit ? ' limit ' . $limit : '';
        return $this ;
    }

    public function query ($sql)
    {
        try{
            $res = self::$pdo->query ($sql);
            return $res->fetchAll (PDO::FETCH_ASSOC);
        }catch (Exception $e){
            throw new Exception($e->getMessage ());
        }
    }

    public function find($pri){
        $priField = $this->getPriField();
        $sql = "select * from " . $this->table . ' where '.$priField.'=' . $pri;
        return current ($this->query ( $sql ));

    }

    private function getPriField(){
        //查看表结构
        $res = $this->query ('desc ' . $this->table);
        foreach ($res as $v){
            if($v['Key'] == 'PRI'){
                return $v['Field'];
            }
        }
    }

    public function exec($sql){
        try{
            return  self::$pdo->exec  ($sql);
        }catch (Exception $e){
            throw new Exception($e->getMessage ());
        }
    }


}