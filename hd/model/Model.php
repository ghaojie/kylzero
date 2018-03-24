<?php

namespace hd\model;

class Model
{

    public function __call ( $name , $arguments )
    {
        return self::runParse ( $name , $arguments );
    }

    public static function __callStatic ( $name , $arguments )
    {
        return self::runParse ( $name , $arguments );
    }

    private static function runParse ( $name , $arguments )

    {
        //p(get_called_class ());
        $modelclass=get_called_class ();
        return call_user_func_array ( [ new Base($modelclass) , $name ] , $arguments );
    }
}