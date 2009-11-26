<?php
/*********************************************************
 * histcross v2.0
 * File: list_vertices_bib.ctp
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/?>
<h2><?php __($elementtitle); ?></h2>

<table class="listtable">
	<tr>
		<th></th>
		<th><?php __('Pages'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('From'); ?></th>
		<th><?php __('To'); ?></th>
	</tr>
<?php $row = 0; 
foreach($data as $val): ?>
<?php
$startdate = $hcSupport->dateformat($val['Vertex']['start_time_entry'], $val['Vertex']['start_time_ca'], $val['Vertex']['start_time_questionable'], $val['Vertex']['start_time_julian']);
$stopdate = $hcSupport->dateformat($val['Vertex']['stop_time_entry'], $val['Vertex']['stop_time_ca'], $val['Vertex']['stop_time_questionable'], $val['Vertex']['stop_time_julian']);
if ($startdate == '') $startdate = '----';
if ($stopdate == '') $stopdate = '----';
$details = __('Details', true);
$edit = __('Edit', true);
?>
	<tr<?php if ($row++ % 2 == 0) echo ' class="altrow"'; ?>>
		<td class="nobreak"><a href="/vertices/view/<?php echo $val['Vertex']['id']; ?>" title="<?php echo $details; ?>"><img src="/img/icons/icon_vertex.gif" width="16" height="16" /></a>
		<?php
		//Edit Icon?
		if ($auth->sessionValid()) {
    		//Check Access
    		if (AccessKeeper::checkAccess('Vertex', 'edit', $auth->user('group'))) {
		    	echo $html->link(
		    		$html->image(
						'icons'.DS.'icon_edit.png',
						array('width' => '16', 'height' => '16')
					),
					array(
						'controller' => 'vertices',
						'action'=>'edit',
						$val['Vertex']['id']
					),
		    		array('title' => $edit),
		    		false,
		    		false
		    	);
    		}
		}
		?>
		</td>
		<td class="number"><?php echo $val['BibliographiesVertex']['pages']; ?>&nbsp;&nbsp;</td>
		<td><?php echo $hcSupport->getIconHTML($val['Vertex']['pictogram_id']!=0?$val['Vertex']['pictogram_id']:$val['VertexType']['pictogram_id']).
			' <a href="/vertices/view/'.$val['Vertex']['id'].'">'.$val['Vertex']['title'].'</a>'; ?></td>
		<td><?php echo $hcSupport->getIconHTML($val['VertexType']['pictogram_id']).
			' <a href="/vertex_types/view/'.$val['Vertex']['vertex_type_id'].'">'.$val['VertexType']['title'].'</a>'; ?></td>
		<td class="number"><?php echo $startdate; ?></td>
		<td class="number"><?php echo $stopdate; ?></td>
	</tr>
<?php endforeach; ?>
</table>
