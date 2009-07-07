<?php
/*********************************************************
 * histcross v2.0
 * File: hc_format.php
 * Created: 26.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if (!class_exists('Bibliography')) App::import('Model', 'Bibliography');

/**
 * Class to help formating comment fields in HC - some of the ideas
 * have been taken from Flay-Helper of CakePHP, some are my own
 * devise and taken from histcross 1.0. The code here is much simpler
 * than the one presented in Flay, because hc does not need many of the
 * functions presented there...
 */
class HcFormatHelper extends Helper {
	var $helpers = array('Html', 'Text');
	
	var $entities = array(
		' - ' => ' &ndash; ',
		'--' => ' &mdash; ',
		'(C)' => '&copy;',
		'(R)' => '&reg;',
		'&lt;=&gt;' => '&hArr;',
		'&lt;-&gt;' => '&harr;',
		'&lt;=;' => '&lArr;',
		'&lt;-;' => '&larr;',
		'=&gt;' => '&rArr;',
		'-&gt;' => '&rarr;',
	);
	
	var $biblist = null;
	
	/**
	 * returns formated text
	 */
	function format($text, $bibrefs = true) {
		//Prepare BibRefs
		if ($bibrefs) $this->prepareBibRefs();
		
		// trim whitespace and disable all HTML
		$text = str_replace('<', '&lt;', str_replace('>', '&gt;', trim($text)));
		
		//parse NLs
		$text=preg_replace("/(^|\n)- ([^\n]*)/", "<li>\\2</li>\n", $text);

		// pre-parse newlines
		$text=preg_replace('#\r\n#', "\n", $text);
		$text=preg_replace('#[\n]{2,}#', '%PARAGRAPH%', $text);
		$text=preg_replace('#[\n]{1}#', '%LINEBREAK%', $text);

		//re-parse NLs
		$text=preg_replace("/<\/li>%LINEBREAK%/", "</li>", $text);
		$text=preg_replace("/(%PARAGRAPH%)?<li(>.*?<)\/li>(%PARAGRAPH%|%LINEBREAK%)/", "<ul><li\\2/li></ul>", $text);

		$out ='';

		foreach (split('%PARAGRAPH%', $text)as $line) {
			if ($line) {
				// bold
				$line = ereg_replace("\*([^\*]*)\*", "<strong>\\1</strong>", $line);
				// italic
				$line = ereg_replace("_([^_]*)_", "<em>\\1</em>", $line);
				// underline
				$line = ereg_replace('==([^_]*)==', "<span style=\"text-decoration:underline;\">\\1</span>", $line);
				//replace bibliographic references
				if ($bibrefs)
					$line = str_replace(array_keys($this->biblist), array_values($this->biblist), $line);
				// page notations
				$line = ereg_replace("(\[[0-9f]+:\])", '<span class="bib_page">\\1</span>', $line);

				// entities
				$line = str_replace(array_keys($this->entities), array_values($this->entities), $line);

				$out .= str_replace('%LINEBREAK%', "<br />\n", "<p>{$line}</p>\n");
			}
		}
		$out = str_replace('<p>%QUOTE%</p>', "<blockquote>", $out);
		$out = str_replace('<p>%ENDQUOTE%</p>', "</blockquote>", $out);

		//highlight text
		$out = $this->highlightText($out);

		return $out;
	}
	
	/**
	 * does highlighting of text depending on different search settings
	 */
	function highlightText($text) {
		//get parameters
		if (!key_exists('hl', $this->params['named'])) return $text;
		else $hl = $this->params['named']['hl'];
		
		if (key_exists('hltype', $this->params['named']))
			$type = $this->params['named']['hltype'];
		else $type = 'plain';
		
		//create search token array
		$tokens = explode(' ', $hl);

		//switch by type of highlighting
		switch($type) {
			case 'soundex': //soundex highlighting
				return $this->highlightSoundex($text, $tokens);
			default: //plain text highlighting
				return $this->Text->highlight($text, $tokens);
		}
	}
	
	/**
	 * does soundex highlighting...
	 */
	function highlightSoundex($text, $tokens) {
		$back = '';
		$wdstart = 0;
		$len = 0;
		$inhtml = false; //flag to circumvent html-tags

		$codepage = Configure::read('App.encoding');
		
		//create search token array, if needed
		if (!is_array($tokens)) $tokens = explode(' ', $tokens);
		for ($i = 0; $i < count($tokens); $i++)
			$tokens[$i] = soundex($tokens[$i]);

		//first decode
		$text = html_entity_decode($text, ENT_QUOTES, $codepage);
		
		for ($i = 0; $i < mb_strlen($text, $codepage); $i++) {
			$xchar = mb_substr($text, $i, 1, $codepage);
			//if ($xchar == '') continue;

			if ($inhtml == false) {
				//stop words
				if (mb_strpos(' ,.+/-*#~"!?[]()=%\\&;:1234567890§${}|€<'."'\n\r\t", $xchar, 0, $codepage) !== false) {
					if ($len > 0) { //identified word, now look if it has to be highlighted...
						$word = mb_substr($text, $wdstart, $len, $codepage);

						if (in_array(soundex($word), $tokens)) $back .= '<span class="highlight">'.$word.'</span>';
						else $back .= $word;
					}
					$wdstart = $i+1;
					$len = 0;
					$back .= $xchar;
					if ($xchar == '<') //start of html string
						$inhtml = true;
				} else $len++; //increase length
			} elseif ($xchar == '>') { //end of html string
				$wdstart = $i+1;
				$len = 0;
				$inhtml = false;
				$back .= $xchar;
			} else {
				$back .= $xchar;
				$wdstart = $i+1;
				$len = 0;
			}
		}
		//add rest:
		$back .= mb_substr($text, $wdstart, $len, $codepage);

		return $back;
	}

	/**
	 * Prepare bibliographic entry list
	 */
	function prepareBibRefs() {
		$bib = new Bibliography();
		$bib->recursive = -1;
		$bib->cacheQueries = 1;
		$biblist = $bib->find('all', array('fields' => array('Bibliography.id', 'Bibliography.shorttitle', 'Bibliography.longtitle', 'Bibliography.shortref'), 'conditions' => 'Bibliography.deleted = 0'));
		
		$this->biblist = array();
		
		//now fill replacement string
		foreach($biblist as $ref => $valarr) {
			$id = $valarr['Bibliography']['id'];
			$shorttitle = $valarr['Bibliography']['shorttitle'];
			$longtitle = $valarr['Bibliography']['longtitle'];
			$ref = $valarr['Bibliography']['shortref'];
		
			$this->biblist['[['.$ref.']]'] = '&#x21E8;&thinsp;'.$this->Html->link(
				$shorttitle,
				array(
					'controller'=>'bibliographies',
					'action'=>'view',
					$id
				), array('class' => 'bib_entry', 'title' => $longtitle)
			);
		}
	}
}
?>