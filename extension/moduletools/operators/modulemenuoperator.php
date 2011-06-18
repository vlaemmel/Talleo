<?php

class ModuleMenuOperator
{
	var $Operators;

	function ModuleMenuOperator()
	{
		$this->Operators = array('module_menu','module_menu_header');
	}

	function &operatorList()
	{
		return $this->Operators;
	}

	function namedParameterPerOperator()
	{
		return true;
	}

	function namedParameterList()
	{
		return array(
			'module_menu' => array('module' => array('type'=>'string', 'required'=>true, 'default'=>'')),
			'module_menu_header' => array('module' => array('type'=>'string', 'required'=>true, 'default'=>''))
			);
	}

	function modify(&$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters)
	{
		$Module=eZModule::findModule($namedParameters['module']);
		switch ($operatorName){
			case 'module_menu':{
				$operatorValue = array();
				foreach($Module->attribute('views') as $ModuleView){
					if(isset($ModuleView['left_menu']) && $ModuleView['left_menu']){
						array_push($operatorValue, $ModuleView);
					}
				}
				sort($operatorValue);
				return true;
				break;
			}
			case 'module_menu_header':{
				$ModuleDefinition = $Module->Module;
				$operatorValue = isset($ModuleDefinition['left_menu_heading'])?$ModuleDefinition['left_menu_heading']:$ModuleDefinition['name'];
				return true;
				break;
			}
		}
	}

}

?>
