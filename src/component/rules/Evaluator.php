<?php

namespace smartedutech\smaes\component\rules;

use smartedutech\smaes\component\Component;
use smartedutech\smaes\component\rules\RulesFactory;



class Evaluator
{

    protected Component $_Composante;
      
    
public function __construct($comp){
$this->set_Composante($comp);
}
    
/**
 * Summary of getConditions
 * This function returns an array of evaluation conditions for the component's rules.
 * @return array<string> An array of string conditions.
 */
public function getConditions(){
    $rules = $this->_Composante->get_Rules();
    $conds = [];
    foreach($rules as $rule){
        foreach($rule->get_Items() as $item){
           
            $conditions[] = $item->get_Evaluation()->get_Condition();
        }}

        return $conditions;
}

/**
*Summary of getVariablesName
*This function returns an array of variable names from the _Composante object.
*@return array<string>
*/
public function getVariablesName(){
    $names = []; 
         $variables = $this->_Composante->get_Variables();
         foreach($variables as $variable){
            $names[] = $variable;
         }
         return $names;

}


/**
     * Summary of getTestConditions
     * this function returns an array of eval conditions
     *@param array $conditions An array of condition strings to be evaluated.
     *@param array $vars An array of variables, each with a name and a value, used to evaluate the conditions.
     *@return array An array of boolean values representing the results of the condition evaluations.
*/
    public function getTestConditions($conditions, $vars)
    {
        $res = [];
        foreach ($conditions as $condition) {
            foreach ($vars as $var) {
                if (str_contains($condition, $var->get_name())) {
                $dataExist = $var->get_value();
                $varname = $var->get_name();
                 $specificCondition = str_ireplace("@$varname", "$dataExist", $condition);
                $test = eval("return $specificCondition;");
                 $converted_test = $test ? 'true' : 'false';
                 $res[$condition] = $converted_test;
                            }
            }
        }
        
     return $res;
    }

    /**
     * Summary of replaceFunctionVars
     * this function get the method in the json ex : method::sum(@tp,@ds) and replace @tp and @ds with their values
     * from the json
     * and returns method::sum(valueTP,valueDS)
     *@param string $data - chaîne de caractères contenant la méthode à modifier
     *@return string - chaîne de caractères contenant la méthode modifiée
     */
public function replaceFunctionVars(string $data)
{  
    $variablesInput = $this->_Composante->get_Variables();
    foreach ($variablesInput as $k) {
        $key = $k->get_name();
        $pattern = '/\{([A-Za-z]+):@' . $key . '\}/';
        $matches = [];
        preg_match($pattern, $data, $matches);
        if (isset($matches[1])) {
            if(!empty($this->get_Composante()->get_subcomps())){
                $vals = [];
            foreach ($this->get_Composante()->get_subcomps() as $comps) {      
                foreach ($comps->get_Variables() as $vars) {
                    if ($key == $vars->get_name()) {
                        $vals[] = $vars->get_value();
                    }
                }
            }
            $replacement = implode(",", $vals);
            $data = str_replace($matches[0], $replacement, $data);
            }
            else{
                $data = 0;
            }
        }
        else {
            $pattern = '/\{([A-Za-z]+):@' . $key . '\*(\d+(?:\.\d+)?)\}/';
            $matches = [];
            preg_match($pattern, $data, $matches);
            if (isset($matches[1])) {
                $vals = [];
                foreach ($this->get_Composante()->get_subcomps() as $comps) {      
                    foreach ($comps->get_Variables() as $vars) {
                        if ($key == $vars->get_name()) {
                            $vals[] = $vars->get_value() * $matches[2];
                        }
                    }
                }
                $replacement = implode(",", $vals);
                $data = str_replace($matches[0], $replacement, $data);
            }
            $pattern = '/@' . $key . '/';
            $replacement = $k->get_value();
            $data = preg_replace($pattern, $replacement, $data);
        }
    }
    return $data;
}


    public function RefactorVarsValues($vars, $data){
foreach ($vars as $var) {
    foreach($data as $k=>$v){
        if($var->get_name()===$k){
            if($var->verifyTypeValue($v)){
                $var->set_value($v);
            }
        }
    }
}
return $vars;
    }

    public function getNameVarWithData($vars){
        $res = [];
        foreach($vars as $v){
        $res[$v->get_name()] =  $v->get_value();
    }
    return $res;
    }

public function evaluer()
{
    $variables = $this->_Composante->get_Variables();
    $conditions = $this->getConditions();
    $res = $this->getTestConditions($conditions, $variables);
    $rules = $this->_Composante->get_Rules();
    
    $subcomps = $this->_Composante->get_subcomps();
    if (!empty($subcomps)) {
        foreach ($subcomps as $subcomp) {
            $subeval = new Evaluator($subcomp);
            $subeval->evaluer();
        }
    }
    foreach($rules as $rule){
        foreach($rule->get_Items() as $item){
            foreach($res as $k=>$r){
                if($item->get_Evaluation()->get_Condition() == $k){
                    if($item->get_Evaluation()->get_Output() !== null){
                        foreach($item->get_Evaluation()->get_Output() as $binds=>$val){
                            if($r == $binds){
                                foreach($val->get_Binds() as $bind=>$vs){
                                    $pos = strpos($bind, '@');
                                    if ($pos !== false) {
                                        $bind = substr_replace($bind, '', $pos, 1);
                                    }
                                    $check = (strpos($vs->get_VarValue(), '{') !== false || strpos($vs->get_VarValue(), '}') !== false) ? true : false;
                                    $use = "use smartedutech\\smaes\\methods\\Methods;";
                                    $ifFunction = $this->replaceFunctionVars($vs->get_VarValue());

                                    $resF = $check ? eval("$use; return $ifFunction;") : $vs->get_VarValue();
                                    $mrkn[] = $bind;
                                    $inputs[] = $resF;
                                    //
                                    // $test = array_combine($mrkn, $inputs);
                                    // $this->RefactorVarsValues($resF, $test);
                                    //
                                    foreach($variables as $v){
                                        if($v->get_name() == $bind){
                                            $v->set_value($vs->get_VarValue());
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    $inputMark = array_combine($mrkn, $inputs);
    $this->RefactorVarsValues($variables, $inputMark);
    return $this->getNameVarWithData($variables);
}



    /**
     * Get the value of _Composante
     *
     * @return Component
     */
    public function get_Composante(): Component
    {
        return $this->_Composante;
    }

    /**
     * Set the value of _Composante
     *
     * @param Component $_Composante
     *
     * @return self
     */
    public function set_Composante(Component $_Composante): self
    {
        $this->_Composante = $_Composante;

        return $this;
    }
 }
