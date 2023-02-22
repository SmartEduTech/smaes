<?php
namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\rules\Output;

class EvaluationConditionAndOutput {
    protected $_Condition;
    protected $_Output;

    public function __construct($cond, $out){
        $this->set_Condition($cond);
        if(is_object($out)){
            foreach($out as $key=>$val){
                $this->_Output[$key] = new Output($key,$val);
            }
        }else if(!is_object($out)){
            $this->set_Output($out);
        }
    }

    /**
     * Get the value of _Condition
     */
    public function get_Condition()
    {
        return $this->_Condition;
    }

    /**
     * Set the value of _Condition
     */
    public function set_Condition($_Condition): self
    {
        $this->_Condition = $_Condition;

        return $this;
    }

    /**
     * Get the value of _Output
     */
    public function get_Output()
    {
        return $this->_Output;
    }

    /**
     * Set the value of _Output
     */
    public function set_Output($_Output): self
    {
        $this->_Output = $_Output;

        return $this;
    }
}