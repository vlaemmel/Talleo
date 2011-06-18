<?php

	class ImagesFileOperator
{
	var $Operators;

	function ImagesFileOperator()
	{
		$this->Operators = array("images_file");
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
	return array('images_file' => array(
			'image_alias' => array('type'=>'string', 'required'=>false, 'default'=>SiteUtils::configSetting('GeneralSettings','DefaultImageAlias','imageboard.ini')),
			'params' => array('type'=>'array', 'required'=>false, 'default'=>array())
		));
	}

	function modify(&$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters)
	{
	$ImagesFileURL = false;
	$ObjectNode = is_object($operatorValue)?$operatorValue:(is_string($operatorValue)?eZContentObjectTreeNode::fetch($operatorValue):false);
	      if($ObjectNode){
		$ViewParameters = eZModule::findModule('images')->parameters('file');
		$ImageParameters = array_change_key_case( array_combine($ViewParameters,array($ObjectNode->attribute('node_id'),$namedParameters['image_alias'],false,false)) );
		      foreach(SiteUtils::configSetting('EffectIDSettings','EffectID','imageboard.ini') as $ID) {
			      if(($AliasList = SiteUtils::hasConfigSetting("EffectID_$ID",'AliasList','imageboard.ini')) && in_array($namedParameters['image_alias'],$AliasList)) {
				$ImageParameters[strtolower($ViewParameters[2])] = $ID;
				break;
			   }
		   }
		      if(isset($namedParameters['params']) && !empty($namedParameters['params'])) {
			      foreach($namedParameters['params'] as $Key => $Value){
				$ImageParameters[$Key]=$Value;
			   }
		   }
		$ImagesFileURL = '/images/file/'.implode('/',array_filter($ImageParameters));
	   }
		$operatorValue = $ImagesFileURL;
		return true;
	}
}

?>
