<?php
/*********************************************************
 * histcross v2.0
 * File: geography.php
 * Created: 08.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class GeographyHelper extends Helper {
   var $helpers = array('Html', 'Time');

	/**
	 * Formats coordinates
	 */
	function formatCoordinates($coord) {
		$latlon = split(' ', $coord);
		return $this->formatLatitude($latlon[1]).' '.$this->formatLongitude($latlon[0]);
	}
	
	/**
     * Returns a latitude string in the format 42&deg;21'29" N
     *
     * @param int $val latitude in decimal form (42.358)
     * @return string formatted latitude (42&deg;21'29" N)
     */
    function formatLatitude($val)
    {
    	$val = str_replace('&#45;', '-', $val);
        $formatVal = $this->_formatLonLat($val);
    
        if($val < 0) 
        {
            $dir = "S";
        }
        else
        {
            $dir = "N";
        }
    
        return $formatVal.$dir;
    }
    
    /**
     * Returns a longitude string in the format 71&deg;03'36" W
     *
     * @param int $val longitude in decimal form (-71.06)
     * @return string formatted longitude (71&deg;03'36" W)
     */
    function formatLongitude($val)
    {
     	$val = str_replace('&#45;', '-', $val);
        $formatVal = $this->_formatLonLat($val);

        if($val < 0) {
            $dir = "W";
        }
        elseif($val > 0) {
            $dir = "E";
        }
    
        return $formatVal.$dir;
    }
    
    /*Private method used to format both latitude and longitude from decimal to degrees*/
    function _formatLonLat($val)
    {
        $deg = floor(abs($val));
        $tempm = (abs($val)-$deg)*100;
        $min = $tempm*.6;
        $temps = round(($min-floor($min))*100);
        $min = floor($min);
        $sec = round(.6*$temps);
        
        if ($min < 10) 
        {
            $min = '0'.$min;
        }
        if ($sec < 10) 
        {
            $sec = '0'.$sec;
        }
        
        return "${deg}°${min}′${sec}ʺ";
    }
    
    /**
     * Helper to create and/or output Globe picture
     */
    function buildGlobe($model, $id, $title, $geo, $modified) {
    	//picture name
    	$picname = 'glob_'.substr(low($model), 0, 1).$id.'.png';
    	//names
    	$localname = APP.'webroot'.DS.'img'.DS.'maps'.DS.$picname;
    	//to Unix-Timestamp....
    	$modified = $this->Time->toUnix($modified);
    	
    	//create new picture?
    	$flagcreate = false;
    	if (file_exists($localname)) {
    		if (filemtime($localname) < $modified) $flagcreate = true;
    	} else $flagcreate = true;
    	
    	//Picture has to be created?
		if ($flagcreate) {
			$this->_createGlobe($localname, $model, $id, $title, $geo);
		}

    	return $this->Html->image('/img/maps/'.$picname,
						array('width' => '455', 'height' => '455',
							'alt' => $title,
							'title' => $title,
							'id' => 'globe_'.$id,
							'onClick' => "Effect.Shrink(globe_${id});",
						)
					);
    }
    
    /**
     * Create a globe picture
     */
    function _createGlobe($localname, $model, $id, $title, $geo) {
    	//Configuration stuff
    	$convert = Configure::read('HC.convert_path');
    	$gmtwrapper = Configure::read('HC.GMTWrapper');
    	
    	if ($convert == '') {
    		__('Error: No ImageMagick available');
    		return;
    	}
    	if ($gmtwrapper == '') {
    		__('Error: No GMT available');
    		return;
    	}

		//temporary name
    	$tmpname = $localname.'.ps';
    	
    	//prepare fork
		$pipes = null;
	 	$descriptorspec = array(
		   0 => array('pipe', 'r'),  // stdin is a pipe that the child will read from
		//   1 => array('pipe', 'w'),  // stdout is a pipe that the child will write to
		   1 => array('file', $tmpname, "a"), // stdout is a file
		   2 => array('pipe', 'r')   // stderr is a pipe that the child will write to
		);
	
		$cwd = APP.'webroot'.DS.'img'.DS.'maps'.DS;
		$env = array('NETCDF' => '/opt/GMT', 'LANDCOLOR' => '230');

		//extract coordinates
		$latlon = split(' ', $geo);
		$x = $latlon[0];
		$y = $latlon[1];

		//coastline
		if (phpversion() < 5) $process = proc_open($gmtwrapper.' pscoast -Rg -JG'.$x.'/'.$y.'/16c -B15g15 -Dc -A5000 -W0.3pt -G230 -P -K', $descriptorspec, $pipes);
		else $process = proc_open($gmtwrapper.' pscoast -Rg -JG'.$x.'/'.$y.'/16c -B15g15 -Dc -A5000 -W0.3pt -G230 -P -K', $descriptorspec, $pipes, $cwd, $env);

		if (is_resource($process)) {
		    $return_value = proc_close($process);
		}
	
		//dots
		if (phpversion() < 5) $process = proc_open($gmtwrapper.' psxy -Rg -JG'.$x.'/'.$y.'/16c -Ss0.15 -G255/0/0 -O -K', $descriptorspec, $pipes);
		else $process = proc_open($gmtwrapper.' psxy -Rg -JG'.$x.'/'.$y.'/16c -Ss0.15 -G255/0/0 -O -K', $descriptorspec, $pipes, $cwd, $env);
	
		if (is_resource($process)) {
		    fwrite($pipes[0], $x.' '.$y.' 10 0 0 1 '.$title);
		    fclose($pipes[0]);
	
		    $return_value = proc_close($process);
		}
	
		//titles
		if (phpversion() < 5) $process = proc_open($gmtwrapper.' pstext -Rg -JG'.$x.'/'.$y.'/16c -G0/0/0 -Dj0.06/0.06 -O', $descriptorspec, $pipes);
		else $process = proc_open($gmtwrapper.' pstext -Rg -JG'.$x.'/'.$y.'/16c -G0/0/0 -Dj0.06/0.06 -O', $descriptorspec, $pipes, $cwd, $env);
	
		if (is_resource($process)) {
		    if (function_exists('mb_convert_encoding'))
			$title = mb_convert_encoding($title, 'ISO-8859-1', 'UTF-8');
		    fwrite($pipes[0], $x.' '.$y.' 10 0 0 1 '.$title);
		    fclose($pipes[0]);
	
		    $return_value = proc_close($process);
		}
	
		//convert stuff
		//exec($HCCONF['ghostscript'].' -dNOPAUSE -sDEVICE=epswrite -dNOCACHE -sOutputFile='.$tmpname.'.eps -q -dBATCH '.$tmpname);
		//exec($HCCONF['convert'].' '.$tmpname.'.eps '.$localname); //here localname to save pic in final place
		//new version works by croping the image to the right proportions...
		exec($convert.' '.$tmpname.' -crop 455x455+70+317 '.$localname);
	
		//delete temporary files
		//chmod($tmpname, 0666);
		unlink($tmpname);
    }
}
?>
