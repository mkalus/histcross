-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Juli 2009 um 21:20
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET NAMES utf8 */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;

--
-- Datenbank: `histcross2`
--

--
-- Daten für Tabelle `hc_pictograms`
--

INSERT INTO `hc_pictograms` (`id`, `title`) VALUES
(1, 'Coat-of-Arms: Portugal'),
(2, 'Coat-of-Arms: Venice'),
(3, 'Coat-of-Arms: Empire'),
(4, 'Coat-of-Arms: Hamburg'),
(5, 'Coat-of-Arms: Lübeck'),
(6, 'Coat-of-Arms: Bremen'),
(7, 'Coat-of-Arms: Antwerp'),
(8, 'Coat-of-Arms: England'),
(9, 'Coat-of-Arms: France'),
(10, 'Coat-of-Arms: Netherlands'),
(11, 'Coat-of-Arms: Augsburg'),
(12, 'Coat-of-Arms: Nuremberg'),
(42, 'Maps: Globe'),
(14, 'Persons: Jakob Fugger'),
(16, 'Coat-of-Arms: Florence'),
(18, 'Coat-of-Arms: Lisbon'),
(19, 'Coat-of-Arms: Porto'),
(20, 'Coat-of-Arms: Spain'),
(23, 'Coat-of-Arms: Madrid'),
(24, 'Coat-of-Arms: Sevilla'),
(25, 'Coat-of-Arms: Valladolid'),
(26, 'Coat-of-Arms: Italy'),
(27, 'Attributes: Catholic'),
(28, 'Attributes: Protestant'),
(29, 'Things: Globs'),
(30, 'Things: Hour Glass'),
(31, 'Things: Signs'),
(32, 'Things: Wheel'),
(33, 'Things: Barrel'),
(34, 'Things: Letter'),
(36, 'Things: Building'),
(37, 'Things: City'),
(38, 'Persons: Group'),
(39, 'Persons: Person blue'),
(40, 'Persons: Person orange'),
(41, 'Persons: Company'),
(43, 'Things: Token'),
(44, 'Things: Axe'),
(45, 'Things: Crown'),
(46, 'Attributes: Religion'),
(48, 'Maps: City'),
(49, 'Maps: Place'),
(50, 'Actions: sink'),
(51, 'Attributes: Nationality'),
(52, 'Things: Treaty'),
(53, 'Maps: Empire'),
(54, 'Maps: Island'),
(56, 'Karte: Region'),
(58, 'Attributes: Condition'),
(59, 'Box: red'),
(60, 'Box: blue'),
(61, 'Box: green'),
(62, 'Box: yellow'),
(63, 'Box: brown'),
(64, 'Box: purple'),
(65, 'Box: orange'),
(66, 'Persons: Fugger'),
(69, 'Persons: Group Augsburg'),
(70, 'Persons: Group Nuremberg'),
(71, 'Attributes: David Star'),
(72, 'Attributes: Christão-novos'),
(73, 'Persons: Vaaz de Souza (Lisbon)'),
(74, 'Persons: Ximenes'),
(75, 'Persons: Tinoco [e Fernandes] (Porto/Lisbon)'),
(76, 'Persons: Teixeira de Sampaio'),
(80, 'Persons: Rodrigues d\\''Évora'),
(78, 'Persons: Soares d\\''Orta (Lisbon)'),
(79, 'Persons: Silveira (Lisbon)'),
(81, 'Persons: Pinto (Lisbon)'),
(82, 'Persons: Ribeiro d\\''Olivares'),
(83, 'Persons: Rodrigues de Lisboa (Lisbon)'),
(84, 'Persons: Rodrigues de Mello e Tovar (Lisbon)'),
(85, 'Persons: Rodrigues de Moraes'),
(86, 'Persons: Gomes Denis e Solis (Lisbon)'),
(87, 'Persons: Fernandes (Lisbon)'),
(88, 'Persons: Dias Henriques (Oporto/Lisbon)'),
(89, 'Persons: Brandão (Lisbon)'),
(90, 'Persons: Angel (Lisbon)'),
(91, 'Attributes: Gouvernor or Viceking'),
(92, 'Things: Postal Horn'),
(93, 'Coat-of-Arms: Ulm'),
(94, 'Coat-of-Arms: Amsterdam'),
(95, 'Coat-of-Arms: Brussels'),
(96, 'Coat-of-Arms: Frankfurt'),
(97, 'Coat-of-Arms: Cologne'),
(98, 'Coat-of-Arms: Middelburg'),
(100, 'Actions: married'),
(101, 'Actions: fatherhood'),
(102, 'Actions: motherhood'),
(103, 'Actions: sibling'),
(104, 'Actions: located in'),
(105, 'Actions: died'),
(106, 'Actions: born'),
(107, 'Actions: commerical'),
(108, 'Actions: participation'),
(109, 'Actions: leading'),
(110, 'Actions: star'),
(112, 'Things: topaz'),
(113, 'Persons: Welser'),
(116, 'Things: pepper sack'),
(118, 'Actions: capturing'),
(120, 'Actions: animosity'),
(124, 'Things: letter'),
(123, 'Actions: referring to'),
(125, 'Actions: in contact with'),
(126, 'Things: Goblet'),
(127, 'Things: 2 tokens'),
(128, 'Persons: working for'),
(129, 'Actions: using'),
(130, 'Actions: owning'),
(133, 'Actions: related by marriage'),
(135, 'Actions: cousin'),
(136, 'Actions: uncle/aunt'),
(137, 'Actions: father/mother in law'),
(138, 'Actions: guardian'),
(139, 'Things: bicorn'),
(143, 'Attributes: question mark'),
(144, 'Actions: greeting'),
(145, 'Coat-of-Arms: Rome'),
(146, 'Things: copper ingot');


--
-- Daten für Tabelle `hc_table_updates`
--

INSERT INTO `hc_table_updates` (`id`, `key`, `status`) VALUES
(1, 'indexer_vertices_updated', 0),
(2, 'indexer_relations_updated', 0);

--
-- Daten für Tabelle `hc_inference_types`
--

INSERT INTO `hc_inference_types` (`id`, `is_xy`, `connects`, `comment`, 
`img`) VALUES
(1, 1, 'yz', 'A(x,y) ∧ B(x,z) ⇒ C(y,z)', 'xz_yz'),
(2, 1, 'xz', 'A(x,y) ∧ B(x,z) ⇒ C(x,z)', 'xz_xz'),
(3, 1, 'xy', 'A(x,y) ∧ B(x,z) ⇒ C(x,y)', 'xz_xy'),
(4, 0, 'xz', 'A(x,y) ∧ B(y,z) ⇒ C(x,z)', 'yz_xz'),
(5, 0, 'yz', 'A(x,y) ∧ B(y,z) ⇒ C(y,z)', 'yz_yz'),
(6, 0, 'xy', 'A(x,y) ∧ B(y,z) ⇒ C(x,y)', 'yz_xy');


--
-- Daten für Tabelle `hc_users`
--

INSERT INTO `hc_users` (`id`, `username`, `password`, `created`, `modified`, `lastlogin`, `name`, `deleted`, `group`, `always_show_network`) VALUES
(1, 'mkalus', 'xxx', '2005-12-22 09:19:18', '2008-12-29 22:29:13', '2009-07-08 13:13:54', 'Maximilian Kalus', 0, 'admin', 0),
(2, 'user', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2009-06-19 08:46:28', '2009-06-19 08:46:28', NULL, 'Testbenutzer', 0, 'admin', 0);

