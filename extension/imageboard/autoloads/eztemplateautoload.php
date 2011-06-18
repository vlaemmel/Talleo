<?php

$eZTemplateOperatorArray = array();

$eZTemplateOperatorArray[] = array( 'script' => 'extension/imageboard/operators/imagesfileoperator.php',
                                    'class' => 'ImagesFileOperator',
                                    'operator_names' => array('images_file') );

$eZTemplateOperatorArray[] = array( 'script' => 'extension/imageboard/operators/imagesremotefileoperator.php',
                                    'class' => 'ImagesRemoteFileOperator',
                                    'operator_names' => array('images_remote_file') );

?>