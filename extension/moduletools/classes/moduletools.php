<?php

class ModuleTools
{
	private $CurrentView = false;
	private $Variables = array();

	function ModuleTools($Module)
	{
		$this->Name = $Module->Module['name'];
		$this->Module = $Module;
		$this->ViewList = $Module->attribute('views');
		$this->LeftMenu = isset($Module->Module['left_menu'])?$Module->Module['left_menu']:'design:moduletools/menu.tpl';
		$this->CurrentView = $this->current('view',true);
	}

	function current($Option='module', $asObject=false){
		switch($Option){
			case 'module':{
				return $this->Module;
			}
			case 'view':{
				return $asObject?ModuleViewTools::instance($this->Module):ModuleViewTools::instance($this->Module)->View;
			}
		}
	}

	function result(){
		$this->setTemplateVariable('ModuleView',$this->CurrentView->View);
		$parameters=func_num_args()?func_get_args():array(array());
		return array_merge(array(
			'content'=>$this->CurrentView->template(is_string($parameters[0])?$parameters[0]:false,is_array($parameters[0])?$parameters[0]:$parameters[1]),
			'left_menu'=>$this->LeftMenu,
			'path'=>$this->CurrentView->path(true)
		),$this->Variables);
	}

	function setTemplateVariable($var,$val,$namespace=false){
		$this->CurrentView->setTemplateVariable($var,$val,$namespace);
	}

	function setVariable($var,$val){
		$this->Variables[$var]=$val;
	}

	static function instance($Module=false){
		return $Module?new ModuleTools($Module):false;
	}

	static function navigationPart($TopAdminMenu){
		return SiteUtils::configSetting("Topmenu_$TopAdminMenu",'NavigationPartIdentifier','menu.ini');
	}

	static function moduleList($alphaSort=false){
		$List = SiteUtils::configSetting('ModuleSettings','ModuleList','module.ini');
		if($alphaSort){sort($List);}
		return $List;
	}

	static function moduleFunction($FunctionName, $FunctionParameters, $ModuleName='moduletools'){
		$ModuleFunction = new eZModuleFunctionInfo($ModuleName);
		$ModuleFunction->loadDefinition();
		return $ModuleFunction->execute($FunctionName, $FunctionParameters);
	}

}

?>