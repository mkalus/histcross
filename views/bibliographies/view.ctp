<?
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="viewentry">
	<div class="bibliographies view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($bibliography['Bibliography']['id'],
				'icon_book.gif',
				 __('Bibliographic Entry', true)).
				 Sanitize::html($bibliography['Bibliography']['shorttitle']);?><br />
			<span style="font-size:smaller;"><?php  __('Bibliographic Entry');?></span>
		</h2>
		
		<dl class="dataentry">
			<dt class="bibentry"><?php  __('Full Bibliographic Entry');?></dt>
			<dd class="bibentry"><?php echo Sanitize::html(str_replace('--', '—', $bibliography['Bibliography']['longtitle'])); ?></dd>
			<dt class="bibshort"><?php  __('Short Reference');?></dt>
			<dd class="bibshort"><?php echo Sanitize::html($bibliography['Bibliography']['shortref']); ?></dd>
	<? if ($bibliography['Bibliography']['comment'] != '') : ?>
			<dt class="comment"><?php  __('Comment');?></dt>
			<dd class="comment"><?php echo $hcFormat->format($bibliography['Bibliography']['comment'], false); ?></dd>
	<? endif ?>
		</dl>
	</div>

<?
//Show related vertices and relations
echo $this->element('list_vertices_bib', array('elementtitle' => __('Vertices connected to this Bibliographic Entry', true), 'data' => $vertices));
echo $this->element('list_relations_bib', array('elementtitle' => __('Relations connected to this Bibliographic Entry', true), 'data' => $relations));


//Add Footer
echo $this->element('footer_editinfo',
	array(
		'data' => $bibliography,
		'model' => 'Bibliography'
	));
?>
</div>
