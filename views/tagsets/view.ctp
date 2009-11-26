<?php
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 15.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

if ($tagset['Tagset']['group'] != '')
	$title = $tagset['Tagset']['group'].':'.$tagset['Tagset']['title'];
else $title = $tagset['Tagset']['title'];
//define model array
$model_array =  array('data' => $tagset, 'model' => 'Tagset', 'id' => $tagset['Tagset']['id'], 'vertices' => $vertices, 'edges' => $edges);

?>
<div class="viewentry">
	<div class="tagsets view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($tagset['Tagset']['id'],
				'icon_set.gif',
				 __('Tag Set', true)).
				 Sanitize::html($title);?><br />
			<span style="font-size:smaller;"><?php __('Tag Set');?></span>
		</h2>

		<dl class="dataentry">
			<dt><?php  __('Tag Set Elements'); echo ' ('.count($vertices).')'?></dt>
			<dd><?php
				$comma = false;
				foreach($vertices as $key => $val) {
					if ($comma) echo ' | ';
					else $comma = true;
					echo $html->link($val, '/vertices/view/'.$key);
				}
				?></dd>
<?php
//Show coordinate element
echo $this->element('view_network', $model_array);
?>
		</dl>
	</div>
<?php
//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>

<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List all Tag Sets', true), array('action'=>'index')); ?> </li>
	</ul>
</div>
