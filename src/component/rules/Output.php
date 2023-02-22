<?php

namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\rules\Bind;


class Output {
    protected $_TrueOrFalse;
    protected $_Binds;

    public function __construct($name, $binds){
        $this->set_TrueOrFalse($name);
        foreach($binds->bind as $key=>$val){
      $this->_Binds[$key] = new Bind($key,$val);
        }
        

    }

    /**
     * Get the value of _TrueOrFalse
     */
    public function get_TrueOrFalse()
    {
        return $this->_TrueOrFalse;
    }

    /**
     * Set the value of _TrueOrFalse
     */
    public function set_TrueOrFalse($_TrueOrFalse): self
    {
        $this->_TrueOrFalse = $_TrueOrFalse;

        return $this;
    }

    /**
     * Get the value of _Binds
     */
    public function get_Binds()
    {
        return $this->_Binds;
    }

    /**
     * Set the value of _Binds
     */
    public function set_Binds($_Binds): self
    {
        $this->_Binds = $_Binds;

        return $this;
    }
}