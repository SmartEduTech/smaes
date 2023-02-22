<?php

namespace smartedutech\smaes\component\rules;

class Bind{

    protected $_VarName;
    protected $_VarValue;

    public function __construct($name, $val){
        $this->set_VarName($name);
        $this->set_VarValue($val);

    }

    /**
     * Get the value of _VarName
     */
    public function get_VarName()
    {
        return $this->_VarName;
    }

    /**
     * Set the value of _VarName
     */
    public function set_VarName($_VarName): self
    {
        $this->_VarName = $_VarName;

        return $this;
    }

    /**
     * Get the value of _VarValue
     */
    public function get_VarValue()
    {
        return $this->_VarValue;
    }

    /**
     * Set the value of _VarValue
     */
    public function set_VarValue($_VarValue): self
    {
        $this->_VarValue = $_VarValue;

        return $this;
    }
}