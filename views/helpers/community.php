<?php
/*********************************************************
 * histcross v2.0
 * File: community.php
 * Created: 24.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

class CommunityHelper extends AppHelper
{
    var $helpers = array('Html');
    
    function menu($links = array(),$htmlAttributes = array(),$type = 'ul')
    {      
        $this->tags['ul'] = '<ul%s>%s</ul>';
        $this->tags['ol'] = '<ol%s>%s</ol>';
        $this->tags['li'] = '<li%s>%s</li>';
        $out = array();        
        foreach ($links as $title => $link)
        {
        	$title = __($title,true);
        	$myurl = $this->url($link);
            //if($this->url($link) == $this->here)
            if ((strlen($myurl) < 2 && $this->url($link) == $this->here) ||
            	(strlen($myurl) >= 2 && strpos($this->here, $myurl) === 0))
            {
                //$out[] = sprintf($this->tags['li'],' class="current"',$this->Html->link($title, $link));
                $out[] = sprintf($this->tags['li'],' class="current"','<a href="'.$link.'">'.$title.'</a>');
            }
            else
            {
//                $out[] = sprintf($this->tags['li'],'',$this->Html->link($title, $link));
                $out[] = sprintf($this->tags['li'],'','<a href="'.$link.'">'.$title.'</a>');
            }
        }
        $tmp = join("\n", $out);
        return $this->output(sprintf($this->tags[$type],$this->_parseAttributes($htmlAttributes), $tmp));
    }
}
?>