<?php
//require_once( 'kernel/classes/ezcontentobjecttreenode.php' );

$ObjectNode = eZContentObjectTreeNode::fetch($NodeID);
$dataMap = $ObjectNode->dataMap();
$AttributeIdentifier = isset($AttributeID)?($AttributeID):'image';
$ImageData = $dataMap[$AttributeIdentifier]->content()->attribute($ImageAlias);

$INI = eZINI::instance();
$User = eZUser::currentUser();
$cacheFileArray = eZNodeviewfunctions::generateViewCacheFile($User, $NodeID, $ObjectNode->attribute('parent_node_id'), false, 'eng-US', false, array('NodeID'=>$NodeID,'ImageAlias'=>$ImageAlias,'EffectID'=>$EffectID,'AttributeID'=>$AttributeID));
//eZDebug::writeDebug($cacheFileArray,'Cache File Array');
if(!file_exists($cacheFileArray['cache_dir'])) {
	$perm = octdec($INI->variable('FileSettings', 'StorageDirPermissions'));
	eZDir::mkdir($cacheFileArray['cache_dir'], $perm, true);
}

//$ImageData['dirpath']
//$ImageFileURL = $cacheFileArray['cache_dir'].'/'.$ImageData['basename'].'_'.$ImageAlias.'_'.base64_encode('EffectID_'.$EffectID).'.png';
$ImageFileURL = $cacheFileArray['cache_path'];
$stillneedimage = true;

if(file_exists($ImageFileURL)) {
	$last_write = @filemtime( $ImageFileURL );
	if (eZExpiryHandler::getTimestamp('content-view-cache',-1) < $last_write && (time() - $last_write) < 60*60 ) {
		$Image = new Imagick();
		$Image->readImage($ImageFileURL);
		$stillneedimage = false;
	}
}

if ($stillneedimage) {
	if(isset($EffectID) && $EffectID) {
		$BaseImage = new Imagick($ImageData['url']);
			include("effects/$EffectID.php");
	} else {
		$Image = new Imagick();
		$Image->readImage($ImageData['url']);
		$ContentType = "image/png";
	}

	$Image->setImageColorspace(Imagick::COLORSPACE_RGB);
}


header("Content-Type: $ContentType");
echo $Image;
eZExecution::cleanExit();




?>