<?php 
namespace smartedutech\smaes\component;
 
class Variable{
    public string $_name;
    public string $_type;
    public  $_value;
    public bool $_readonly;
    /**
     * @value : 
     *  In : variable d'entrer 
     *  Out: variable de sortie
     */
    public string $InOut;
    public function __construct($name,$value,$type="")
    {
        $this->_name=$name;
        $this->_type=$type;
        $this->_value=$value;
    }
/**
 * @param $value si le valeur passé a cette fonction n'est null alors la verification sera
 * faite sur la valeur passé a cette variable sinon celle affecter l'heur de l'intance de class
 * @return 
 */
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
