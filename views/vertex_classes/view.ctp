<?php
/*********************************************************
 * histcross v2.0
 * File: view.php
 * Created: 23.11.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
//define model array
$model_array =  array('data' => $vertexClass, 'model' => 'VertexClass', 'linkbibs' => false);
?>
<div class="viewentry">
	<div class="vertexclass view">
		<h2><?php
			echo $hcSupport->createIconandEditLink($vertexClass['VertexClass']['id'],
				'icon_vertexclass.gif',
				 __('Vertex Class', true)).
				 Sanitize::html($vertexClass['VertexClass']['title']);?><br />
			<span style="font-size:smaller;"><?php  __('Vertex Class');?></span>
		</h2>
		
	<?php if ($vertexClass['VertexClass']['comment'] != '') : ?>
		<dl class="dataentry">
<?php
//Show comment element
echo $this->element('view_comment', $model_array);
?>
		</dl>
	<?php endif ?>
	</div>

<?php
//Show related verticex types
echo $this->element('list_vertex_types', array('elementtitle' => __('Related Vertex Types', true), 'useajax' => true));

//Add Footer
echo $this->element('footer_editinfo', $model_array);
?>
</div>