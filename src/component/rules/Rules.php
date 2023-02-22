<?php
namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\rules\ItemRule;

class Rules
{
    protected string $_IDR;
    protected array $_Items;
    protected string $_title;
    protected string $_type;
    protected string $_Name;
    public function __construct(string $name, $RulesInfor)
    {
        $this->set_Name($name);
        foreach($RulesInfor as $key=>$value){
        $this->_Items[$key] = new ItemRule($key, $value);
        }
        
        
       
    }
    public function getIDR()
    {
        return $this->_IDR;
    }
    public function getTitle()
    {
        return $this->_title;
    }
    public function getType()
    {
        return $this->_type;
    }
    public function setIDR($id)
    {
        $this->_IDR = $id;
    }
    public function setTitle($title)
    {
        $this->_title = $title;
    }
    public function setType($type)
    {
        $this->_type = $type;
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

    /**
     * Get the value of _Items
     *
     * @return array
     */
    public function get_Items(): array
    {
        return $this->_Items;
    }

    /**
     * Set the value of _Items
     *
     * @param array $_Items
     *
     * @return self
     */
    public function set_Items(array $_Items): self
    {
        $this->_Items = $_Items;

        return $this;
    }
}