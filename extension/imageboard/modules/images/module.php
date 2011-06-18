<?php


$Module = array(
		'name'=>'Image Board',
		'variable_params'=>true
);

$ViewList = array();

$ViewList['file'] = array(
			'name'=>'Image File',
			'script'=>'file.php',
			'params'=>array('NodeID','ImageAlias','EffectID','AttributeID'));

$ViewList['remotefile'] = array(
			'name'=>'Image Remote File',
			'script'=>'remotefile.php',
			'params'=>array('URI','EffectID'));

$ViewList['curl_file'] = array(
			'name'=>'Image File',
			'script'=>'file.php',
			'params'=>array('NodeID','ImageAlias','EffectID','AttributeID'));


?>