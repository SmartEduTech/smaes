<?php

namespace smartedutech\smaes\methods;
abstract class Methods {
    public static function SUM()
    {
        $numargs = func_num_args();
        $arg_list = func_get_args();
        $sum = 0;
        if($numargs >= 1){
            $sum += array_sum($arg_list);
            return $sum;
        }else{
            return 0;
        }
    }
}
