<?php
namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\rules\EvaluationConditionAndOutput;


class ItemRule{
    protected string $_ID;
    protected string $_Title;
    protected string $_Rule_Type;
    protected  $_Evaluation;
    protected string $_Name;

    public function __construct(string $name,  $info){
     
        $this->set_Name($name);
        $this->set_ID($info->Id);
        $this->set_Title($info->title);
        $this->set_RuleType($info->Rule_Type);
      if(isset($info->Evaluation->output)){
        //ici a utiliser le RuleFactory selon le rule type RuleFactory::
        // $rule = RulesFactory::getRule($this->get_RuleType());
        //$result = $rule->evaluate();
        $this->_Evaluation =  new EvaluationConditionAndOutput($info->Evaluation->Condition, $info->Evaluation->output);
      }else if(!isset($info->Evaluation->output)){
        $this->_Evaluation =  new EvaluationConditionAndOutput($info->Evaluation->Condition, null);

      }
      //$this->_Evaluation = new Evaluator($info->Evaluation);
      
    }



    /**
     * Get the value of _ID
     *
     * @return string
     */
    public function get_ID(): string
    {
        return $this->_ID;
    }

    /**
     * Set the value of _ID
     *
     * @param string $_ID
     *
     * @return self
     */
    public function set_ID(string $_ID): self
    {
        $this->_ID = $_ID;

        return $this;
    }

    /**
     * Get the value of _Title
     *
     * @return string
     */
    public function get_Title(): string
    {
        return $this->_Title;
    }

    /**
     * Set the value of _Title
     *
     * @param string $_Title
     *
     * @return self
     */
    public function set_Title(string $_Title): self
    {
        $this->_Title = $_Title;

        return $this;
    }

    /**
     * Get the value of _Rule_Type
     *
     * @return string
     */
    public function get_RuleType(): string
    {
        return $this->_Rule_Type;
    }

    /**
     * Set the value of _Rule_Type
     *
     * @param string $_Rule_Type
     *
     * @return self
     */
    public function set_RuleType(string $_Rule_Type): self
    {
        $this->_Rule_Type = $_Rule_Type;

        return $this;
    }

    /**
     * Get the value of _Evaluation
     *
     * @return string
     */
    public function get_Evaluation()
    {
        return $this->_Evaluation;
    }

    /**
     * Set the value of _Evaluation
     *
     * @param string $_Evaluation
     *
     * @return self
     */
    public function set_Evaluation($_Evaluation)
    {
        $this->_Evaluation = $_Evaluation;

        return $this;
    }

    /**
     * Get the value of _Name
     *
     * @return string
     */
    public function get_Name(): string
    {
        return $this->_Name;
    }

    /**
     * Set the value of _Name
     *
     * @param string $_Name
     *
     * @return self
     */
    public function set_Name(string $_Name): self
    {
        $this->_Name = $_Name;

        return $this;
    }
}