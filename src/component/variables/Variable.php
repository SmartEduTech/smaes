<?php 
namespace smartedutech\smaes\component\variables;
 
class Variable{
    
    protected string $_name;
    protected string $_type;
    protected string $_value;
    protected bool $_readonly;
    protected string $InOut;

    public function __construct(string $name, $information){
        $this->set_name($name);
        $this->set_type($information->type);
        $this->set_value($information->value);
    }

   /* public function __construct($type="")
    {
        $this->_type=$type;
    }*/


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

    /**
     * Get the value of InOut
     *
     * @return string
     */
    public function getInOut(): string
    {
        return $this->InOut;
    }

    /**
     * Set the value of InOut
     *
     * @param string $InOut
     *
     * @return self
     */
    public function setInOut(string $InOut): self
    {
        $this->InOut = $InOut;

        return $this;
    }

    /**
     * Get the value of _readonly
     *
     * @return bool
     */
    public function get_readonly(): bool
    {
        return $this->_readonly;
    }

    /**
     * Set the value of _readonly
     *
     * @param bool $_readonly
     *
     * @return self
     */
    public function set_readonly(bool $_readonly): self
    {
        $this->_readonly = $_readonly;

        return $this;
    }

    /**
     * Get the value of _value
     *
     * @return string
     */
    public function get_value(): string
    {
        return $this->_value;
    }

    /**
     * Set the value of _value
     *
     * @param string $_value
     *
     * @return self
     */
    public function set_value(string $_value): self
    {
        $this->_value = $_value;

        return $this;
    }

    /**
     * Get the value of _type
     *
     * @return string
     */
    public function get_type(): string
    {
        return $this->_type;
    }

    /**
     * Set the value of _type
     *
     * @param string $_type
     *
     * @return self
     */
    public function set_type(string $_type): self
    {
        $this->_type = $_type;

        return $this;
    }

    /**
     * Get the value of _name
     *
     * @return string
     */
    public function get_name(): string
    {
        return $this->_name;
    }

    /**
     * Set the value of _name
     *
     * @param string $_name
     *
     * @return self
     */
    public function set_name(string $_name): self
    {
        $this->_name = $_name;

        return $this;
    }
}
