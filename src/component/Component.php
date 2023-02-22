<?php
namespace smartedutech\smaes\component;

use smartedutech\smaes\component\Component;
use  smartedutech\smaes\component\variables\Variable;
 use smartedutech\smaes\component\rules\Rules;

/**
 * Summary of Component
 * A component contains a set of evaluation rules (R1, R2...) and evaluation variables(input_variables, output_variables)
 * ([as indicated in the JSON file])
 */
class Component
{
    protected $_Rules;
    protected $_Variables;
    protected string $_Title;
    protected string $_name;
    protected string $_ID;
    protected string $_description;
    protected $_subcomps;


    public function __construct( $JsonComponenet)
    {
        $this->set_name($JsonComponenet->name);
        $this->set_Title($JsonComponenet->title);
        $this->set_description($JsonComponenet->description);
        $this->set_ID($JsonComponenet->ID);
       // $this->set_subcomps($JsonComponenet->subcomps);
        foreach($JsonComponenet->input_variables as $keyName => $info){
            $this->_Variables[$keyName]= new Variable($keyName , $info);
        } 

        foreach($JsonComponenet->Rules as $keyRule => $Rule){
            $this->_Rules[$keyRule]= new Rules($keyRule,$Rule);
        }
        if(isset($JsonComponenet->subcomps) && !empty($JsonComponenet->subcomps)){
            foreach ($JsonComponenet->subcomps as $key=>$subcomp) {
                $this->_subcomps[$key] = new Component($subcomp);
            }
        }
      
        
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
     * Get the value of _description
     *
     * @return string
     */
    public function get_description(): string
    {
        return $this->_description;
    }

    /**
     * Set the value of _description
     *
     * @param string $_description
     *
     * @return self
     */
    public function set_description(string $_description): self
    {
        $this->_description = $_description;

        return $this;
    }

    /**
     * Get the value of _Rules
     */
    public function get_Rules()
    {
        return $this->_Rules;
    }

    /**
     * Set the value of _Rules
     */
    public function set_Rules($_Rules): self
    {
        $this->_Rules = $_Rules;

        return $this;
    }

    /**
     * Get the value of _Variables
     */
    public function get_Variables()
    {
        return $this->_Variables;
    }

    /**
     * Set the value of _Variables
     */
    public function set_Variables($_Variables): self
    {
        $this->_Variables = $_Variables;

        return $this;
    }

    /**
     * Get the value of _subcomps
     */
    public function get_subcomps()
    {
        return $this->_subcomps;
    }

    /**
     * Set the value of _subcomps
     */
    public function set_subcomps($_subcomps): self
    {
        $this->_subcomps = $_subcomps;

        return $this;
    }
}
