<h2><?php __('Documentation') ?></h2>

<p><?php __('To access the documentation of histcross, visit the following web site:') ?></p>

<p><a href="http://www.histcross.org/documentation/">http://www.histcross.org/documentation/</a></p>

<h3><?php __('histcross Version'); ?></h3>
<p>
<?php
$svn = File('.svn/entries');
__('This is histcross version: '); echo Configure::read('HC.version').'.'.$svn[3];
unset($svn);
?>
<p>