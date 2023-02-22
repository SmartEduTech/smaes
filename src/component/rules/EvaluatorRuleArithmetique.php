<?php

namespace smartedutech\smaes\component\rules;


class EvaluatorRuleArithmetique implements IEvaluator{
    protected string $_Condition;
    protected $_Name;
    protected $_component;
    protected  $output;
    
    const $DetectVariable="(\{[_A-Za-z0-9:@*#*]+\})";

    public function __construct(string $name, $EvaluatorRuleInfor, Component &$JsonComponenet){
        $this->_component = $JsonComponenet;
        $this->_Name = $name;
        $this->$output = $EvaluatorRuleInfor->output;
        $this->$_Condition = $EvaluatorRuleInfor->Condition;
       
    }


//
    public function evaluate(){

        preg_match_all($DetectVariable,$this->_Condition,$vars);
        foreach($vars => $leVar)
        {
            //Netoyage : eliminer les @ et les {}
            $Varibalenetoyer = str_ireplace(array("{","}","@"),array("","",""),$leVar);
            $LaValeur=$this->_component->_Variables[$Varibalenetoyer]->get_value();
            if($this->_component->_Variables[$Varibalenetoyer]->get_type()=="string"){
                $this->$_Condition=str_ireplace($leVar, "'".$LaValeur."'",$this->$_Condition);
            }else{
                $this->$_Condition=str_ireplace($leVar, $LaValeur,$this->$_Condition);
            }
           
        }       


    }
    /**
     * Get the value of Condition
     *
     * @return string
     */
    public function getCondition(): string
    {
        return $this->Condition;
    }

    /**
     * Set the value of Condition
     *
     * @param string $Condition
     *
     * @return self
     */
    public function setCondition(string $Condition): self
    {
        $this->Condition = $Condition;
        
        return $this;
    }

    /**
     * Get the value of output
     *
     * @return stdClass
     */
    public function getOutput(): stdClass
    {
        return $this->output;
    }

    /**
     * Set the value of output
     *
     * @param stdClass $output
     *
     * @return self
     */
    public function setOutput(stdClass $output): self
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Get the value of bind
     *
     * @return stdClass
     */
    public function getBind(): stdClass
    {
        return $this->bind;
    }

    /**
     * Set the value of bind
     *
     * @param stdClass $bind
     *
     * @return self
     */
    public function setBind(stdClass $bind): self
    {
        $this->bind = $bind;

        return $this;
    }
}