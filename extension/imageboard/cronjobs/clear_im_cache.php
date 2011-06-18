<?php

/*! \file
*/

 function process_dir($dir,$recursive = FALSE) {
   if (is_dir($dir)) {
     for ($list = array(),$handle = opendir($dir); (FALSE !== ($file = readdir($handle)));) {
       if (($file != '.' && $file != '..') && (file_exists($path = $dir.'/'.$file))) {
         if (is_dir($path) && ($recursive)) {
           $list = array_merge($list, process_dir($path, TRUE));
         } else {
           $entry = array('filename' => $file, 'dirpath' => $dir);
           do if (!is_dir($path)) {
	
	        $con_cache = eZExpiryHandler::getTimestamp('content-view-cache',-1);

			$last_write = @filemtime( $path );
			
			if ($con_cache > $last_write ) {
				unlink($path);
				print_r("Deleted $path ");
			}



 if (strstr(pathinfo($path,PATHINFO_BASENAME),'log')) {
   if (!$entry['handle'] = fopen($path,r)) $entry['handle'] = "FAIL";
 }
 
             break;
           } else {

             break;
           } while (FALSE);
           $list[] = $entry;
         }
       }
     }
     closedir($handle);
     return $list;
   } else return FALSE;
 }

process_dir('var/cache/imageboard/images', true);


?>
