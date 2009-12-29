<?php
/*********************************************************
 * histcross v2.0
 * File: list_relations_bib.ctp
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
		<th><?php __('From Vertex'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('To Vertex'); ?></th>
		<th><?php __('From'); ?></th>
		<th><?php __('To'); ?></th>
	</tr>
<?php $row = 0; 
foreach($data as $val): ?>
<?php
$startdate = $hcSupport->dateformat($val['Relation']['start_time_entry'], $val['Relation']['start_time_ca'], $val['Relation']['start_time_questionable'], $val['Relation']['start_time_julian']);
$stopdate = $hcSupport->dateformat($val['Relation']['stop_time_entry'], $val['Relation']['stop_time_ca'], $val['Relation']['stop_time_questionable'], $val['Relation']['stop_time_julian']);
if ($startdate == '') $startdate = '----';
if ($stopdate == '') $stopdate = '----';
$details = __('Details', true);
$edit = __('Edit', true);
?>
	<tr<?php if ($row++ % 2 == 0) echo ' class="altrow"'; ?>>
		<td class="nobreak"><a href="/relations/view/<?php echo $val['Relation']['id']; ?>" title="<?php echo $details; ?>"><img src="/img/icons/icon_relation.gif" width="16" height="16" alt=" title="<?php echo $details; ?>" /></a>
		<?php
		//Edit Icon?
		if ($auth->sessionValid()) {
    		//Check Access
    		if (AccessKeeper::checkAccess('Relation', 'edit', $auth->user('group'))) {
		    	echo $html->link(
		    		$html->image(
						'icons'.DS.'icon_edit.png',
						array('width' => '16', 'height' => '16')
					),
					array(
						'controller' => 'relations',
						'action'=>'edit',
						$val['Relation']['id']
					),
		    		array('title' => $edit),
		    		false,
		    		false
		    	);
    		}
		}
		?>
		</td>
		<td class="number"><?php echo $val['BibliographiesRelation']['pages']; ?>&nbsp;&nbsp;</td>
		<td><?php echo $hcSupport->getIconHTML($val['VertexFrom']['pictogram_id']!=0?$val['VertexFrom']['pictogram_id']:$val['VertexTypeFrom']['pictogram_id']).
			' <a href="/vertices/view/'.$val['Relation']['from_vertex_id'].'">'.$val['VertexFrom']['title'].'</a>'; ?></td>
		<td><?php echo $hcSupport->getIconHTML($val['RelationType']['pictogram_id']).
			' <a href="/relation_types/view/'.$val['Relation']['relation_type_id'].'">'.$val['RelationType']['title_from'].'</a>'; ?></td>
		<td><?php echo $hcSupport->getIconHTML($val['VertexTo']['pictogram_id']!=0?$val['VertexTo']['pictogram_id']:$val['VertexTypeTo']['pictogram_id']).
			' <a href="/vertices/view/'.$val['Relation']['to_vertex_id'].'">'.$val['VertexTo']['title'].'</a>'; ?></td>
		<td class="number"><?php echo $startdate; ?></td>
		<td class="number"><?php echo $stopdate; ?></td>
	</tr>
<?php endforeach; ?>
</table>