<?php

	class ModuleFunctions
{
	
	function result($module, $view, $parameters){
	$ModuleResult = eZModule::findModule($module)->run($view,$parameters);
		return array('result'=>$ModuleResult['content']);
	}

	function menu($module){
	$Module = eZModule::findModule($module);
	$ModuleData = $Module->Module;
	$Heading = isset($ModuleData['left_menu_heading'])?$Module->Module['left_menu_heading']:$module;

//	eZDebug::writeDebug($Module,'Module');
	

		return array('result'=>array(
				'heading'=>$Heading,
				'hasCategories'=>(isset($ModuleData['left_menu_categories']) && count($ModuleData['left_menu_categories']))
			));
	}

	function classList($filter=false, $type='exclude'){
		eZDebug::writeDebug($filter,"Filter: $type");
		$sorts=null;
		$classFilter=null;
		$contentClassList = eZContentClass::fetchList(0, true, false, $sorts, null, $classFilter);

		eZDebug::writeDebug($contentClassList,'Class List: '.count($contentClassList));

		return array('result'=>'');
	}

}
/*
    function fetchClassList( $classFilter, $sortBy )
    {
        $sorts = null;
        if ( $sortBy &&
             is_array( $sortBy ) &&
             count( $sortBy ) == 2 &&
             in_array( $sortBy[0], array( 'id', 'name' ) ) )
        {
            $sorts = array( $sortBy[0] => ( $sortBy[1] )? 'asc': 'desc' );
        }
        $contentClassList = array();
        if ( is_array( $classFilter ) and count( $classFilter ) == 0)
        {
            $classFilter = false;
        }
        if ( !is_array( $classFilter ) or
             count( $classFilter ) > 0 )
        {
            $contentClassList = eZContentClass::fetchList( 0, true, false,
                                                            $sorts, null,
                                                            $classFilter );
        }
        if ( $contentClassList === null )
            return array( 'error' => array( 'error_type' => 'kernel',
                                            'error_code' => eZError::KERNEL_NOT_FOUND ) );
        return array( 'result' => $contentClassList );
    }
*/
?>