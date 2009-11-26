<h3><?php __('Visualized Network'); ?></h3>

<applet code="org.histcross.radar.Radar" archive="/files/HistcrossRadar.jar" width="720" height="720">
	<param name="id" value="<?php echo $vertex_id; ?>" />
	<param name="siteUrl" value="<?php echo $hostname; ?>" />
	<param name="lang" value="<?php __('en'); ?>" />
</applet>

<p><?php echo $html->link(__('Hide network view', true), array(
						'controller' => Inflector::tableize($model),
						'action'=>'view',
						$vertex_id,
						'viewnetworkapplet' => 'no'
					)
		); ?></p>
