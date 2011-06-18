<?php


$ImageRemoteURL = trim(base64_decode($URI));

$INI = eZINI::instance();
$User = eZUser::currentUser();
//$cacheFileArray = eZNodeviewfunctions::generateViewCacheFile($User, 0, 0, false, 'eng-US', false, array('URI'=>$URI,'EffectID'=>$EffectID));

$my_cache_file = "cachedimage.png";
if ($EffectID == 2) $my_cache_file = "cachedimage.jpg";
$my_cache_dir = "var/cache/imageboard/images/remotefile/$URI/$EffectID";
$my_cache_path = $my_cache_dir."/".$my_cache_file;

$cacheFileArray = array ( 'cache_path' => $my_cache_path,  'cache_dir' => $my_cache_dir, 'cache_file' => $my_cache_file );

//eZDebug::writeDebug($cacheFileArray,'Cache File Array');
if(!file_exists($cacheFileArray['cache_dir'])) {
	$perm = octdec($INI->variable('FileSettings', 'StorageDirPermissions'));
	eZDir::mkdir($cacheFileArray['cache_dir'], $perm, true);
}

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
	$BaseImage = new Imagick($ImageRemoteURL);
	      if(isset($EffectID) && $EffectID){
		$ImageData = $BaseImage->getImageGeometry();
		include("effects/$EffectID.php");
	   } else {
		$Image = $BaseImage->clone();
		$ContentType = $Image->getImageMimeType();
	   }
	
	$Image->setImageColorspace(Imagick::COLORSPACE_RGB);
	
	if(isset($ImageFileURL)){$Image->writeImage($ImageFileURL);}
}

header("Content-Type: $ContentType");
echo $Image;
eZExecution::cleanExit();

?>