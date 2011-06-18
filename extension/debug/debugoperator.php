<?php

class debugOperator
{
    var $Operators;

    function debugOperator()
    {
	$this->Operators = array( "debug", "kill_debug" );
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
        return array( 'debug' => array('label' => array('type'=>'string', 'required'=>false, 'default'=>'')), 'kill_debug' => array() );
    }


    function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
    {

        switch ( $operatorName )
        {
            case 'kill_debug':
            {
		$GLOBALS['eZDebugEnabled'] =0;
		$operatorValue = '';
		return true;
            } 
            break;

            case 'debug':
            {
		eZDebug::writeDebug( $operatorValue, (isset($namedParameters['label'])?$namedParameters['label']:'') );
		$operatorValue = '';
		return true;
            } 
            break;

	}

    }
}

?>
