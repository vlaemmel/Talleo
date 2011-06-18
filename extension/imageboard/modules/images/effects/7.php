<?php

$ShadowWidth = 0;
$ImagePos = ($ShadowWidth*2);
$CornerRadius = 4;
			if ($ImageData[mime_type] == 'image/png') {
				
				$Image = new Imagick();
				$Image->newImage($ImageData['width'], $ImageData['height'], "#FFFFFF", 'png');
				$Image->compositeImage($BaseImage, Imagick::COMPOSITE_OVER, 0, 0);
				$BaseImage = $Image;
				
			}

			
			$BaseImage->resizeImage($ImageData['width']-$ImagePos*2,$ImageData['height']-$ImagePos*2,Imagick::COMPOSITE_NO,0);

			$BaseImage->roundCorners($CornerRadius,$CornerRadius);
			$Image = $BaseImage->clone();

			$Image->setImageBackgroundColor(new ImagickPixel('#000000'));
//			$Image->shadowImage(60, $ShadowWidth, 0, 0);
			$Image->compositeImage($BaseImage, Imagick::COMPOSITE_OVER, $ImagePos, $ImagePos);

			$Image->setImageDepth(8);
			$Image->setImageResolution(72,72);
			$Image->setImageCompression(Imagick::COMPRESSION_UNDEFINED);
			$Image->setImageFormat("png");
//			if(isset($ImageFileURL)){$Image->writeImage($ImageFileURL);}

			$ContentType = "image/png";
//			unset($ImageFileURL);
?>