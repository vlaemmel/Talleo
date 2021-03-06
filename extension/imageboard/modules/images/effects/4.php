<?php

$ShadowWidth = 3;
$ImagePos = ($ShadowWidth*2);
$TargetImageData = array('width'=>96,'height'=>64);
$ImageData = $TargetImageData;
$BaseImageDimension = $BaseImage->getImageGeometry();

      if($BaseImageDimension['width']>$BaseImageDimension['height']){
	$ResizeRatio = $TargetImageData['width']/$BaseImageDimension['width'];
	      if($BaseImageDimension['height']*$ResizeRatio < $TargetImageData['height']){
		$ResizeRatio = $TargetImageData['height']/$BaseImageDimension['height'];
	   }
   } else{
	$ResizeRatio = $TargetImageData['height']/$BaseImageDimension['height'];
	      if($BaseImageDimension['width']*$ResizeRatio < $TargetImageData['width']){
		$ResizeRatio = $TargetImageData['width']/$BaseImageDimension['width'];
	   }
   }

	$BaseImage->resizeImage($BaseImageDimension['width']*$ResizeRatio,$BaseImageDimension['height']*$ResizeRatio,Imagick::FILTER_UNDEFINED,0);
	$BaseImage->cropImage($TargetImageData['width'],$TargetImageData['height'],0,0);
	$BaseImageDimension = $BaseImage->getImageGeometry();

$CornerRadius = (int) max($ImageData['width'],$ImageData['height'])*.02;
			$BaseImage->resizeImage($BaseImageDimension['width']-$ImagePos*2,$BaseImageDimension['height']-$ImagePos*2,Imagick::FILTER_UNDEFINED,0);

			$BaseImage->roundCorners($CornerRadius,$CornerRadius);
			$Image = $BaseImage->clone();

			$Image->setImageBackgroundColor(new ImagickPixel('#000000'));
			$Image->shadowImage(60, $ShadowWidth, 0, 0);
			$Image->compositeImage($BaseImage, Imagick::COMPOSITE_OVER, $ImagePos, $ImagePos);

			$OverlayImage = new Imagick(SiteUtils::configSetting('EffectID_4','OverlayImage','imageboard.ini'));
			$OverlayImageDimension = $OverlayImage->getImageGeometry();
			$Image->compositeImage($OverlayImage, Imagick::COMPOSITE_OVER, ($ImageData['width']-$OverlayImageDimension['width'])/2, ($ImageData['height']-$OverlayImageDimension['height'])/2);

			$Image->setImageDepth(8);
			$Image->setImageResolution(72,72);
			$Image->setImageCompression(Imagick::COMPRESSION_UNDEFINED);
			$Image->setImageFormat("png");
//			if(isset($ImageFileURL)){$Image->writeImage($ImageFileURL);}

			$ContentType = "image/png";

?>