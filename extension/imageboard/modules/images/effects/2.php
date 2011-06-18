<?php
			$Image = $BaseImage->clone();
			$Image->cropImage($ImageData['width'],617,0,0);
			$PatternImage = new Imagick(SiteUtils::configSetting('EffectID_2','PatternImage','imageboard.ini'));
			$Image->compositeImage($PatternImage, Imagick::COMPOSITE_OVER, 0, 0);

			$Image->setImageDepth(8);
			$Image->setImageResolution(72,72);
			$Image->setImageCompression(Imagick::COMPRESSION_JPEG2000);
			$Image->setImageFormat("jpg");
			$ContentType = "image/jpg";
?>