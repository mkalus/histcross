<?
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<div class="viewentry">
	<div class="bibliographies view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($pictogram['Pictogram']['id'],
				'icon_link.gif',
				 __('Pictogram/Icon', true)).
				 $hcSupport->getIconHTML($pictogram['Pictogram']['id'], true).
				 Sanitize::html($pictogram['Pictogram']['title']);?><br />
			<span style="font-size:smaller;"><?php  __('Pictogram/Icon');?></span>
		</h2>
		
		<dl class="dataentry">
			<dt><?php  __('Icons');?></dt>
			<dd>
				<? __('Big: '); echo $hcSupport->getIconHTML($pictogram['Pictogram']['id'], true); ?>
				<? __('Small: '); echo $hcSupport->getIconHTML($pictogram['Pictogram']['id'], false); ?>
			</dd>
		</dl>
	</div>
</div>
