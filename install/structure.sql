-- phpMyAdmin SQL Dump
-- version 3.1.2deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 21. September 2009 um 16:28
-- Server Version: 5.0.75
-- PHP-Version: 5.2.6-3ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `histcross2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_bibliographies`
--

CREATE TABLE `hc_bibliographies` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `shorttitle` varchar(255) NOT NULL default '',
  `longtitle` text NOT NULL,
  `shortref` varchar(32) NOT NULL default '',
  `comment` text,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `shortref` (`shortref`),
  KEY `shorttitle` (`shorttitle`(12)),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Bibliographic data';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_bibliographies_relations`
--

CREATE TABLE `hc_bibliographies_relations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `relation_id` int(11) unsigned NOT NULL default '0',
  `bibliography_id` int(11) unsigned NOT NULL default '0',
  `pages` varchar(32) NOT NULL default '',
  `deleted` tinyint(1) NOT NULL default '0',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq` (`relation_id`,`bibliography_id`),
  KEY `deleted` (`deleted`),
  KEY `relation_id` (`relation_id`),
  KEY `bibliography_id` (`bibliography_id`),
  KEY `pages` (`pages`(8))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Connects relation to bibliography';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_bibliographies_vertices`
--

CREATE TABLE `hc_bibliographies_vertices` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `vertex_id` int(11) unsigned NOT NULL default '0',
  `bibliography_id` int(11) unsigned NOT NULL default '0',
  `pages` varchar(32) default NULL,
  `deleted` tinyint(1) NOT NULL default '0',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq` (`vertex_id`,`bibliography_id`),
  KEY `deleted` (`deleted`),
  KEY `vertex_id` (`vertex_id`),
  KEY `bibliography_id` (`bibliography_id`),
  KEY `pages` (`pages`(8))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Connects objects to bibliography';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_inferences`
--

CREATE TABLE `hc_inferences` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `p1_id` int(11) unsigned NOT NULL default '0',
  `p1_dir_from` tinyint(1) NOT NULL default '1',
  `p2_id` int(11) unsigned NOT NULL default '0',
  `p2_dir_from` tinyint(1) NOT NULL default '1',
  `p3_id` int(11) unsigned NOT NULL default '0',
  `p3_dir_from` tinyint(1) NOT NULL default '1',
  `inference_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `deleted` (`deleted`),
  KEY `p1_id` (`p1_id`),
  KEY `p2_id` (`p2_id`),
  KEY `p3_id` (`p3_id`),
  KEY `inference_type_id` (`inference_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps data of inferences';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_inference_types`
--

CREATE TABLE `hc_inference_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `is_xy` tinyint(1) NOT NULL default '1',
  `connects` varchar(2) NOT NULL,
  `comment` varchar(128) NOT NULL,
  `img` varchar(8) default NULL,
  PRIMARY KEY  (`id`),
  KEY `is_xy` (`is_xy`,`connects`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Typification of inferences';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_pictograms`
--

CREATE TABLE `hc_pictograms` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(128) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`(12))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps data of icons';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_relations`
--

CREATE TABLE `hc_relations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `start_time_entry` varchar(11) default NULL,
  `stop_time_entry` varchar(11) default NULL,
  `start_time` int(11) default NULL,
  `stop_time` int(11) default NULL,
  `start_time_ca` tinyint(1) NOT NULL default '0',
  `stop_time_ca` tinyint(1) NOT NULL default '0',
  `start_time_questionable` tinyint(1) NOT NULL default '0',
  `stop_time_questionable` tinyint(1) NOT NULL default '0',
  `start_time_julian` tinyint(1) NOT NULL default '0',
  `stop_time_julian` tinyint(1) NOT NULL default '0',
  `relation_type_id` int(11) unsigned NOT NULL default '0',
  `from_vertex_id` int(11) unsigned NOT NULL default '0',
  `to_vertex_id` int(11) unsigned NOT NULL default '0',
  `comment` text,
  `geo` text,
  `inference_parent_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `starttime` (`start_time`),
  KEY `stoptime` (`stop_time`),
  KEY `relationtype_id` (`relation_type_id`),
  KEY `fromobject_id` (`from_vertex_id`),
  KEY `toobject_id` (`to_vertex_id`),
  KEY `inference_parent_id` (`inference_parent_id`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps relations between objects';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_relation_classes`
--

CREATE TABLE `hc_relation_classes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `comment` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `title` (`title`(6)),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps data on classes of relations';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_relation_types`
--

CREATE TABLE `hc_relation_types` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `relation_class_id` int(11) unsigned NOT NULL default '0',
  `title_from` varchar(255) NOT NULL default '',
  `title_to` varchar(255) NOT NULL default '',
  `comment` text,
  `vertex_types_from` tinytext NOT NULL,
  `vertex_types_to` tinytext NOT NULL,
  `pictogram_id` int(11) NOT NULL default '0',
  `show_date` tinyint(1) NOT NULL default '1',
  `show_geo` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `title` (`title_from`(6)),
  KEY `title_to` (`title_to`(6)),
  KEY `relationclass_id` (`relation_class_id`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps the types of objects';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_table_updates`
--

CREATE TABLE `hc_table_updates` (
  `id` int(10) unsigned NOT NULL,
  `key` varchar(32) NOT NULL,
  `status` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Keeps status updates for external processes.';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_tagsets`
--

CREATE TABLE `hc_tagsets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `changer_id` int(11) NOT NULL,
  `deleted` tinyint(1) NOT NULL,
  `title` varchar(128) NOT NULL,
  `group` varchar(128) default NULL,
  PRIMARY KEY  (`id`),
  KEY `deleted` (`deleted`),
  KEY `title` (`title`(12)),
  KEY `group` (`group`(12))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps sets of vertices and relations.';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_tagsets_vertices`
--

CREATE TABLE `hc_tagsets_vertices` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tagset_id` int(10) unsigned NOT NULL,
  `vertex_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `tagset_id` (`tagset_id`,`vertex_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Connects sets and vertices';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_users`
--

CREATE TABLE `hc_users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `lastlogin` datetime default NULL,
  `name` varchar(128) NOT NULL,
  `deleted` tinyint(1) NOT NULL default '0',
  `group` varchar(16) NOT NULL,
  `always_show_network` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps users';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_vertex_classes`
--

CREATE TABLE `hc_vertex_classes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `comment` text,
  `sortkey` tinyint(3) unsigned NOT NULL default '10',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`(6)),
  KEY `sortkey` (`sortkey`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps data on classes of vertices';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_vertex_types`
--

CREATE TABLE `hc_vertex_types` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `vertex_class_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `comment` text NOT NULL,
  `pictogram_id` int(11) unsigned NOT NULL default '0',
  `show_date` tinyint(1) NOT NULL default '1',
  `show_geo` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`(6)),
  KEY `objectclass_id` (`vertex_class_id`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps data on types of vertices';

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hc_vertices`
--

CREATE TABLE `hc_vertices` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `creator_id` int(11) unsigned NOT NULL default '0',
  `changer_id` int(11) unsigned NOT NULL default '0',
  `deleted` tinyint(1) NOT NULL default '0',
  `start_time_entry` varchar(11) default NULL,
  `stop_time_entry` varchar(11) default NULL,
  `start_time` int(11) default NULL,
  `stop_time` int(11) default NULL,
  `start_time_ca` tinyint(1) NOT NULL default '0',
  `stop_time_ca` tinyint(1) NOT NULL default '0',
  `start_time_questionable` tinyint(1) NOT NULL default '0',
  `stop_time_questionable` tinyint(1) NOT NULL default '0',
  `start_time_julian` tinyint(1) NOT NULL default '0',
  `stop_time_julian` tinyint(1) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `vertex_type_id` int(11) unsigned NOT NULL default '0',
  `comment` text,
  `geo` text,
  `pictogram_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `title` (`title`(6)),
  KEY `starttime` (`start_time`),
  KEY `stoptime` (`stop_time`),
  KEY `deleted` (`deleted`),
  KEY `vertex_type_id` (`vertex_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps semantic vertices';

