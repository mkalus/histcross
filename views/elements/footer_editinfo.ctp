<?
/*********************************************************
 * histcross v2.0
 * File: footer_editinfo.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
?>
<div class="editinfo">
	<dl>
		<dt><?php  __('Created');?></dt>
		<dd><?php printf(__('%s by %s', true),
				$time->format(__('d-m-Y H:i:s', true), $data[$model]['created']),
				Sanitize::html($data['Creator']['name'])); ?></dd>
		<dt><?php  __('Changed');?></dt>
		<dd><?php printf(__('%s by %s', true),
				$time->format(__('d-m-Y H:i:s', true), $data[$model]['modified']),
				Sanitize::html($data['Changer']['name'])); ?></dd>
	</dl>
</div>
