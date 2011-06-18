<?php

class GetFooterOperator
{
	var $Operators;

	function GetFooterOperator(){
	$this->Operators = array("get_footer", "color_footer");
	}

	function &operatorList(){
	return $this->Operators;
	}

	function namedParameterPerOperator(){
	return true;
	}

	function namedParameterList(){
	return array(
		'get_footer' => array(
			'reset' => array('type'=>'boolean', 'required'=>false, 'default'=>false)
			),
		'color_footer' => array()
		);
	}

	function modify(&$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters){
		if ($operatorName == "color_footer") {
			if (strpos($operatorValue, '.jpg') > 0) {
			$im = imagecreatefromjpeg($operatorValue);
			} elseif (strpos($operatorValue, '.png') > 0) {
			$im = imagecreatefrompng($operatorValue);
			} elseif (strpos($operatorValue, '.gif') > 0) {
			$im = imagecreatefromgif($operatorValue);
			} else {
				$operatorValue = false;
				return false;
			}
			$rgb = imagecolorat($im, 10, 15);
	        $r = ($rgb >> 16) & 0xFF;
	        $g = ($rgb >> 8) & 0xFF;
	        $b = $rgb & 0xFF;
	        $operatorValue =  '#'.str_pad(dechex($r), 2, '0', STR_PAD_LEFT).str_pad(dechex($g), 2, '0', STR_PAD_LEFT).str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
			return true;
		}
		$DesignKeys = $tpl->Resources['design']->Keys;
		$FooterParameters = array('ClassFilterType'=>'include','ClassFilterArray'=>array('footer'),'Depth'=>1);
		$ObjectNodeID = ($namedParameters['reset'] && array_key_exists('node',$DesignKeys))?$DesignKeys['node']:SiteUtils::configSetting('NodeSettings','RootNode','content.ini');
			if ($namedParameters['reset']){
				$ObjectNode = eZContentObjectTreeNode::fetch($ObjectNodeID);
				foreach(array_reverse($ObjectNode->pathArray()) as $PathNodeID){
					if($FooterList = eZContentObjectTreeNode::subTreeByNodeID($FooterParameters,$PathNodeID)){break;}
				}
			}else{
				$FooterList = eZContentObjectTreeNode::subTreeByNodeID($FooterParameters, $ObjectNodeID);
			}
		$operatorValue = $FooterList[0];
		return true;
	}
}

?>