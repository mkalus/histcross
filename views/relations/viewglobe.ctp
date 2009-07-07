<?php
/*********************************************************
 * histcross v2.0
 * File: viewglobe.ctp
 * Created: 08.12.2008
 * Part of histcross - the semantic database for historians.
 * Copyright (c) 2005-2009, Maximilian Kalus, auxnet.de
 * See licence.txt for details (MIT licence).
 *********************************************************/
 
echo $geography->buildGlobe($model, $data[$model]['id'], 'Relation '.$data[$model]['id'], $data[$model]['geo'], $data[$model]['modified']);
?>