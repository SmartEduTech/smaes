<?php 
namespace smartedutech\smaes\component;
 
class Variable{
    public string $_name;
    public string $_type;
    public  $_value;
    public bool $_readonly;

    public string $InOut;
    public function __construct($name,$value,$type="")
    {
        $this->_name=$name;
        $this->_type=$type;
        $this->_value=$value;
    }

    public function verifier($value=""){
        $tmpvalue=!empty($value) ? $value : $this->_value; 
        $All_type=explode("|",$this->_type);
        foreach($All_type as $ty){
            if(gettype($tmpvalue)==$ty){
                return true;
            }
        } 
        return false; 
    }
    
}
