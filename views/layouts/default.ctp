<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="de_DE" xml:lang="de_DE">
<!--
 * $Id: default.ctp 114 2009-01-05 21:42:13Z Maximilian Kalus $
 * histcross v2.0
 * File: default.ctp
 * Created: 23.11.2008
 * (c) 2008 Maximilian Kalus
-->
<head>
	<title>
		<?php __('histcross • the Semantic Database for Historians •'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->charset();
		echo $html->meta('icon');
		echo $html->css('cake.debug');
		echo $html->css('yaml.base');
		echo $html->css('nav_roundbuttons');
		echo $html->css('basemod');
		echo $html->css('content');
		echo $html->css('print');
		echo $html->css('histcross');
		echo $javascript->link('scriptaculous-js-1.8.2/lib/prototype');
		echo $javascript->link('scriptaculous-js-1.8.2/src/scriptaculous');
		echo $javascript->link('histcross');
		echo $scripts_for_layout;
	?>
<!--[if lte IE 7]>
<?php
		echo $html->css('yaml.patchie');
?>
<![endif]-->
</head>
<body>

<div id="page_margins">
	<div id="page">
		<div id="header">
			<div id="topnav">
				<span>
<?php
	if ($auth->sessionValid()) {
		printf(__('Logged in as: %s', true), $html->image('icons/user_small.png', array('width' => '11', 'height' => '12', 'alt' => __('User', true))).' '.$html->link(Sanitize::html($auth->user('name')), '/users/view/'.$auth->user('id')));
		echo ' | ';
		echo $html->link(__('Logout', true), '/users/logout');
	} else
		echo $html->link(__('Login', true), '/users/login');
?>
				| <a href="/pages/help"><?php __('Help'); ?></a> | <a href="/pages/imprint"><?php __('Imprint'); ?></a></span>
			</div>
			<div>
				<div id="hclogo" style="float:left; padding-right: 5px;"><?php echo($html->link($html->image('hclogo.gif', array('width' => '46', 'height' => '40', 'alt' => __('histcross', true))), '/', array(), false, false)); ?></div>
				<h1><?php __('historic crossroads'); ?></h1>
				<span><?php __('The Semantic Database for Historians'); ?></span></div>
			</div>
		<!-- begin: main navigation #nav -->
		<div id="nav"> <a id="navigation" name="navigation"></a>
			<!-- skiplink anchor: navigation -->
			<div id="nav_main">
<?php
	//Menü erstellen
	$arrLinks = array(
		'Home' => '/',
		'Vertices' => '/vertices',
		'Relations' => '/relations',
		'Vertex Types' => '/vertex_types',
		'Relation Types' => '/relation_types',
		'Vertex Classes' => '/vertex_classes',
		'Relation Classes' => '/relation_classes',
		'Bibliographies' => '/bibliographies',
	);
	if ($auth->sessionValid() && $auth->user('group') == 'admin') {
		$arrLinks['Users'] = '/users';
		$arrLinks['Pictograms'] = '/pictograms';
	}
	echo $community->menu(
		$arrLinks,
		array('class' => 'submenu')
	);
?>
			</div>
		</div>
		<!-- end: main navigation -->
		<!-- begin: main content area #main -->
		<div id="main">
			<!-- begin: #col1 - first float column -->
			<div id="col1">
				<div id="col1_content" class="clearfix">
<?php
	echo $this->element('layout_search');
	echo $this->element('layout_morelinks');
	echo $this->element('layout_lastvertices');
	echo $this->element('layout_language_select');
?>
				</div>
			</div>
			<!-- end: #col1 -->
			<!-- begin: #col3 static column -->
			<div id="col3">
				<a id="content" name="content"></a>
				<div id="col3_content" class="clearfix">
					<?php
						if ($session->check('Message.flash')):
							$session->flash();
						endif;
						if ($session->check('Message.auth')):
							$session->flash('auth');
						endif;
					?>
					<?php echo $content_for_layout; ?>
				</div>
				<div id="ie_clearing">&nbsp;</div>
				<!-- End: IE Column Clearing -->
			</div>
			<!-- end: #col3 -->
		</div>
		<!-- end: #main -->
		<!-- begin: #footer -->
		<div id="footer">
			<div id="rightfooter"><a href="http://www.yaml.de/"><img src="/img/yaml_layout.png" width="80" height="15" title="Layout based on YAML" alt="Layout based on YAML" /></a> <a href="http://www.cakephp.org/"><img src="/img/cake_power.png" width="87" height="15" title="Powered by CakePHP" alt="Powered by CakePHP" /></a></div>
			<div id="leftfooter">(c) 2005 — <?php echo(date('Y')); ?> by Maximilian Kalus, <a href="http://www.histcross.org">histcross.org</a>, Version <?php echo Configure::read('HC.version'); ?></div>
		</div>
		<!-- end: #footer -->
	</div>
</div>
<?php echo $cakeDebug; ?>

</body>
</html>
