/**
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 * General JS functions
*/

function changeFormIcon(icon) {
	var myicon = 'default.png'
	if (icon != '')
		myicon = 'b' + icon + '.png';
	document.getElementById("iconcontainer").src = '/img/pictograms/' + myicon;
}

function showInferenceList() {
	if ($('tableinferencelist'))
		$('tableinferencelist').select('.inference_maps').invoke('show');
	$('inferencelistadd').hide();
	$('inferencelistremove').show();
}

function hideInferenceList() {
	if ($('tableinferencelist')) {
		$('tableinferencelist').select('.inference_maps').invoke('hide');
		$('inferencelistadd').show();
	} else
		$('inferencelistadd').hide();
	$('inferencelistremove').hide();
}
