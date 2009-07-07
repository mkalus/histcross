<h2><? __('histcross - the Semantic Database for Historians'); ?></h2>

<p><? __('This is <strong>&quot;Historic Crossroads&quot;</strong>, a database for historians who want to store any historical information in a semantic knowledge base. Pieces of information can be connected to each other with semantic relations. The following elements are contained in the databse:'); ?></p>

<ul>
	<li><? __('<strong>Vertices/Objects:</strong> They contain any desired historical information, e.g. persons, locations or events.'); ?></li>
	<li><? __('<strong>Relations:</strong> These connect vertices with each other in specific ways.'); ?></li>
	<li><? __('<strong>Vertex types and classes:</strong> Vertices are defined by types, e.g. &quot;person&quot; or &quot;event&quot;. Types in turn are combined to classes, e.g. &quot;Persons and Groups&quot;.'); ?></li>
	<li><? __('<strong>Relation types and classes:</strong> Relations are also defined by types (&quot;is father of &quot;, &quot;visiting&quot;) and classes (&quot;blood relations&quot;, &quot;person-location-relation&quot;).'); ?></li>
	<li><? __('<strong>Bibliographic references:</strong> They reference the sources.'); ?></li>
</ul>

<p><? __('Select one of the links below to navigate through this database.'); ?></p>

<ul>
<?
$mylinks = array(
	array('icon' => 'icon_vertex.gif', 'title' => __('Vertices', true), 'link' => '/vertices'),
	array('icon' => 'icon_relation.gif', 'title' => __('Relations', true), 'link' => '/relations'),
	array('icon' => 'icon_vertextype.gif', 'title' => __('Vertex Types', true), 'link' => '/vertex_types'),
	array('icon' => 'icon_relationtype.gif', 'title' => __('Relation Types', true), 'link' => '/relation_types'),
	array('icon' => 'icon_vertexclass.gif', 'title' => __('Vertex Classes', true), 'link' => '/vertex_classes'),
	array('icon' => 'icon_relationclass.gif', 'title' => __('Relation Classes', true), 'link' => '/relation_classes'),
	array('icon' => 'icon_set.gif', 'title' => __('Tag Sets', true), 'link' => '/tagsets'),
);

foreach($mylinks as $entry)
	echo '	<li><strong>'.$html->image('icons/'.$entry['icon'], array('width' => '16', 'height' => '16', 'title' => $entry['title'])).' '.$html->link(__($entry['title'], true), $entry['link']).'</strong></li>';
?>
</ul>