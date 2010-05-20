<?php
/*********************************************************
 * histcross v2.0
 * File: view_coord.php
 * Created: 08.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

   if ($data[$model]['geo'] != '') : ?>
			<dt class="geo"><?php  __('Coordinates');?></dt>
			<dd class="geo"><?php echo $geography->formatCoordinates($data[$model]['geo']);
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ajax->link(
					$html->image('icons/icon_world.png',
						array('width' => '16', 'height' => '16',
							'alt' => __('Show on Globe', true),
							'title' => __('Show on Globe', true),
						)
					),
					array(
						'controller' => Inflector::tableize($model),
						'action'=>'view',
						$data[$model]['id'],
						'showglobe' => 'yes'
					),
		    		array(
						'url' => array( 'controller' => Inflector::tableize($model),
							'action' => 'viewglobe', $data[$model]['id']),
						'before' => "Element.show('globe_loading');",
						'complete' => "Element.hide('globe_loading');",
						'update' => 'viewglobe'
					),
		    		null,
		    		false
				);
			?></dd>
<?php
			//Has showglobe been set?
			if (isset($this->params['named']['showglobe'])) {
				echo $geography->buildGlobe($model, $data[$model]['id'], $data[$model]['title'], $data[$model]['geo'], $data[$model]['modified']);
			} else {
?>
<div id="viewglobe"></div>
<?php
				echo '<div id="globe_loading" style="display:none;">';
				echo $html->image('ajax-loader.gif');
				echo '</div>';
			}
?>
<?php endif ?>
