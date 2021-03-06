<?php
/*********************************************************
 * histcross v2.0
 * File: search.ctp
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//additional messages...
if (isset($messages) && is_array($messages))
	foreach($messages as $message)
		echo '<div class="searchmessage">'.__($message, true).'</div>';

//Top information
?>
<h2><?php __('Search Results'); ?></h2>
<cake:nocache>
<p><?php printf(__('Search for &quot;%s&quot;', true), Sanitize::html($search)); ?></p>
<?php if ($hits == 0) : ?>
<p><strong><?php __('Nothing was found!'); ?></strong></p>
<p><?php echo $html->link(__('Back', true), $backlink); ?>
<?php else : ?>
<p><strong><?php printf(__('Found %s matches. Showing page %s of %s.', true), $hits, $current, $pages); ?></strong></p>
<ul class="searchmatches">
<?php	foreach ($matches as $match) : ?>
<li><?php
	echo $hcSupport->getIconHTML($match['pictogram_id'], true).$html->link($match['title'], array('controller' => $match['url'], 'action' => 'view', $match['id'], 'hl' => urlencode($search), 'hltype' => $highlighttype), array('class' => 'matchtitle', 'title' => __('Relevance: ', true).$match['relevance']));
	if (isset($match['typetitle'])) echo ' <span class="typetitle">('.Sanitize::html($match['typetitle']).')</span>';
	if (isset($match['text'])) echo '<div class="searchtext">'.$match['text'].'</div>';
?></li>
<?php	endforeach; ?>
</ul>
<div class="paging">
<?php
	//Pagination
	$additions = array('url' => array('s' => $search), 'model' => 'Search');
	echo $paginator->prev('« '.__('previous', true), am(array('escape' => false, 'class'=>'enabled'), $additions), null, array('class'=>'disabled'));
	echo ' '.$paginator->numbers(am(array('separator' => ' '), $additions)).' ';
	echo $paginator->next(__('next', true).' »', am(array('escape' => false, 'class'=>'enabled'), $additions), null, array('class'=>'disabled'));
?>
</div>
<?php endif; ?>
</cake:nocache>
