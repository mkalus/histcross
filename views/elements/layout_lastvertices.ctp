<?php
/*********************************************************
 * histcross v2.0
 * File: layout_lastvertices.ctp
 * Created: 11.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//prepare list
$list = '';
if ($session->check('VertexList'))
	$vlist = $session->read('VertexList');
else $vlist = array();
//concatenate list
foreach ($vlist as $key => $val) {
	//$list = '<li>'.$hcSupport->getIconHTML($val['pictogram_id']).$html->link($val['title'], '/vertices/view/'.$val['id']).'</li>'.$list;
	$list = '<li>'.$hcSupport->getIconHTML($val['pictogram_id']).'<a href="/vertices/view/'.$val['id'].'">'.$val['title'].'</a></li>'.$list;
}
?>
<div class="lastseen_vertices">
<div class="header"><?php __('Last Vertices:'); ?></div>
<cake:nocache>
<ul>
<?php echo($list); ?>
</ul>
</cake:nocache>
</div>