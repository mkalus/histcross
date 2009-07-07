<h2><? __('Documentation') ?></h2>

<p><? __('To access the documentation of histcross, visit the following web site:') ?></p>

<p><a href="http://www.histcross.org/documentation/" taget="_blank">http://www.histcross.org/documentation/</a></p>

<h3><? __('histcross Version'); ?></h3>
<p>
<?
$svn = File('.svn/entries');
__('This is histcross version: '); echo Configure::read('HC.version').'.'.$svn[3];
unset($svn);
?>
<p>