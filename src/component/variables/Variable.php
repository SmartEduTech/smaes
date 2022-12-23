<?php 
namespace smartedutech\smaes\component\variables;
 
class Variable{
    
    public string $_name;
    public string $_type;
    public  $_value;
    public bool $_readonly;

    public string $InOut;
    public function __construct($type="")
    {
        $this->_type=$type;
    }

    public function setType($type)
    {
        $this->_type = $type;
    } 

    /**
     * Summary of verifyTypeValue
     * This function checks the type of the introduced variable by its type indicated in the json file
     * @param mixed $value
     * @return bool
     */ 
    public function verifyTypeValue($value=""){
      //  $tmpvalue=!empty($value) ? $value : $this->_value;
        $All_type=explode("|",$this->_type);
        foreach($All_type as $ty){
            if(gettype($value)==$ty){//replaced $tmpvalue with $value 
                return true;
            }
        }
        return false;
    }
}
