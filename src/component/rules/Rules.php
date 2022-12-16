<?php
namespace smartedutech\smaes\component\rules;

class Rules
{
    protected string $_IDR;
    protected string $_title;
    protected string $_type;
    public function __construct(string $type)
    {
        $this->_type = $type;
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
}