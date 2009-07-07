<?php
/*********************************************************
 * histcross v2.0
 * File: form_pictogram.php
 * Created: 04.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/

//Determine fixed icon
if (is_numeric($form->value('pictogram_id')) && $form->value('pictogram_id') != 0) {
	$icon = 'b'.$form->value('pictogram_id').'.png';
} else $icon = 'default.png';

echo '<div style="float: right; margin-right: 300px; margin-top: 15px;">'.$html->image('pictograms'.DS.$icon, array('width' => 24, 'height' => 24, 'id' => 'iconcontainer')).'</div>';

echo $form->input('pictogram_id', array('empty' => __('--- optional select ---', true), 'onKeyup' => 'changeFormIcon(this.options[this.selectedIndex].value);', 'onChange' => 'changeFormIcon(this.options[this.selectedIndex].value);'));
?>