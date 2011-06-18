<?php
$ShadowWidth = 3;
$ImagePos = ($ShadowWidth*2);
$CornerRadius = (int) max($ImageData['width'],$ImageData['height'])*.02;

			$BaseImage->resizeImage($ImageData['width']-$ImagePos*2,$ImageData['height']-$ImagePos*2,Imagick::FILTER_UNDEFINED,0);
			$BaseImage->roundCorners($CornerRadius,$CornerRadius);

			$Shadow = $BaseImage->clone();
			$Shadow->setImageBackgroundColor(new ImagickPixel('#000000'));
			$Shadow->shadowImage(60, $ShadowWidth, 0, 0);
			$Shadow->compositeImage($BaseImage, Imagick::COMPOSITE_OVER, $ImagePos, $ImagePos);
			$Image = $Shadow;

/*
			$ImageDimension = $BaseImage->getImageGeometry();
			$Image = new Imagick();
			$Image->newImage($ImageData['width'],$ImageData['height'], new ImagickPixel('#ffffff'));
			$Image->compositeImage($Shadow, Imagick::COMPOSITE_OVER, 0, 0);
*/

//			$Image = $BaseImage;
			$Image->setImageDepth(8);
			$Image->setImageResolution(72,72);
			$Image->setImageCompression(Imagick::COMPRESSION_JPEG);
			$Image->setImageFormat("png");
//			if(isset($ImageFileURL)){$Image->writeImage($ImageFileURL);}
			$ContentType = "image/png";
?>