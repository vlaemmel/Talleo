<?php

$FunctionList = array(); 

$FunctionList['result'] = array(
			'name' => 'Module Result',
			'call_method' => array('include_file'=>'modulefunctions.php', 'class'=>'ModuleFunctions', 'method'=>'result'),
			'parameter_type' => 'standard',
			'parameters' => array(
					array('name'=>'module', 'type'=>'string', 'required'=>true),
					array('name'=>'view', 'type'=>'string', 'required'=>true),
					array('name'=>'parameters', 'type'=>'array', 'required'=>true)
				)
);

$FunctionList['menu'] = array(
			'name' => 'Module Result',
			'call_method' => array('include_file'=>'modulefunctions.php', 'class'=>'ModuleFunctions', 'method'=>'menu'),
			'parameter_type' => 'standard',
			'parameters' => array(
					array('name'=>'module', 'type'=>'string', 'required'=>true)
				)
);

$FunctionList['classlist'] = array(
			'name' => 'Class List',
			'call_method' => array('include_file'=>'modulefunctions.php', 'class'=>'ModuleFunctions', 'method'=>'classList'),
			'parameter_type' => 'standard',
			'parameters' => array(
					array('name'=>'filter', 'type'=>'array', 'required'=>false, 'default'=>false),
					array('name'=>'type', 'type'=>'string', 'required'=>false, 'default'=>'exclude')
				)
);

?>