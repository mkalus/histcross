-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Juli 2009 um 21:20
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `histcross2`
--

--
-- Daten für Tabelle `hc_pictograms`
--

INSERT INTO `hc_pictograms` (`id`, `title`) VALUES
(1, 'Wappen: Portugal'),
(2, 'Wappen: Venedig'),
(3, 'Wappen: HRR'),
(4, 'Wappen: Hamburg'),
(5, 'Wappen: Lübeck'),
(6, 'Wappen: Bremen'),
(7, 'Wappen: Antwerpen'),
(8, 'Wappen: England'),
(9, 'Wappen: Frankreich'),
(10, 'Wappen: Niederlande'),
(11, 'Wappen: Augsburg'),
(12, 'Wappen: Nürnberg'),
(42, 'Karten: Globus'),
(14, 'Personen: Jakob Fugger'),
(16, 'Wappen: Florenz'),
(18, 'Wappen: Lissabon'),
(19, 'Wappen: Porto'),
(20, 'Wappen: Spanien'),
(23, 'Wappen: Madrid'),
(24, 'Wappen: Sevilla'),
(25, 'Wappen: Valladolid'),
(26, 'Wappen: Italien'),
(27, 'Attribute: katholisch'),
(28, 'Attribute: protestantisch'),
(29, 'Dinge: Globus'),
(30, 'Dinge: Stundenglas'),
(31, 'Dinge: Schilder'),
(32, 'Dinge: Steuerrad'),
(33, 'Dinge: Fass'),
(34, 'Dinge: Buchstabe'),
(36, 'Dinge: Gebäude'),
(37, 'Dinge: Stadt'),
(38, 'Personen: Gruppe'),
(39, 'Personen: Person blau'),
(40, 'Personen: Person orange'),
(41, 'Personen: Firma'),
(43, 'Dinge: Spielkegel'),
(44, 'Dinge: Axt'),
(45, 'Dinge: Krone'),
(46, 'Attribute: Religion'),
(48, 'Karten: Stadt'),
(49, 'Karten: Ort'),
(50, 'Tätigkeit: sinken'),
(51, 'Attribute: Nationalität'),
(52, 'Dinge: Vertrag'),
(53, 'Karten: Reich'),
(54, 'Karten: Insel'),
(56, 'Karte: Region'),
(58, 'Attribute: Zustand'),
(59, 'Box: rot'),
(60, 'Box: blau'),
(61, 'Box: grün'),
(62, 'Box: gelb'),
(63, 'Box: braun'),
(64, 'Box: lila'),
(65, 'Box: orange'),
(66, 'Personen: Fugger'),
(69, 'Personen: Gruppe Augsburg'),
(70, 'Personen: Gruppe Nürnberg'),
(71, 'Attribute: Davidstern'),
(72, 'Attribute: Christão-novos'),
(73, 'Personen: Vaaz de Souza (Lissabon)'),
(74, 'Personen: Ximenes'),
(75, 'Personen: Tinoco [e Fernandes] (Porto/Lissabon)'),
(76, 'Personen: Teixeira de Sampaio'),
(80, 'Personen: Rodrigues d\\''Évora'),
(78, 'Personen: Soares d\\''Orta (Lissabon)'),
(79, 'Personen: Silveira (Lissabon)'),
(81, 'Personen: Pinto (Lissabon)'),
(82, 'Personen: Ribeiro d\\''Olivares'),
(83, 'Personen: Rodrigues de Lisboa (Lissabon)'),
(84, 'Personen: Rodrigues de Mello e Tovar (Lissabon)'),
(85, 'Personen: Rodrigues de Moraes'),
(86, 'Personen: Gomes Denis e Solis (Lissabon)'),
(87, 'Personen: Fernandes (Lissabon)'),
(88, 'Personen: Dias Henriques (Oporto/Lissabon)'),
(89, 'Personen: Brandão (Lissabon)'),
(90, 'Personen: Angel (Lissabon)'),
(91, 'Attribute: Gouverneur oder Vizekönig'),
(92, 'Dinge: Posthorn'),
(93, 'Wappen: Ulm'),
(94, 'Wappen: Amsterdam'),
(95, 'Wappen: Brüssel'),
(96, 'Wappen: Frankfurt'),
(97, 'Wappen: Köln'),
(98, 'Wappen: Middelburg'),
(100, 'Tätigkeit: verheiratet sein'),
(101, 'Tätigkeit: Vater sein'),
(102, 'Tätigkeit: Mutter sein'),
(103, 'Tätigkeit: Bruder/Schwester sein'),
(104, 'Tätigkeit: in Ort sein'),
(105, 'Tätigkeit: sterben'),
(106, 'Tätigkeit: geboren werden'),
(107, 'Tätigkeit: Geschäfte'),
(108, 'Trätigkeit: Beteiligung'),
(109, 'Tätigkeit: leiten'),
(110, 'Tätigkeit: Stern'),
(112, 'Dinge: Topaz'),
(113, 'Personen: Welser'),
(116, 'Dinge: Pfeffersack'),
(118, 'Tätigkeit: kapern'),
(120, 'Tätigkeit: verfeindet sein'),
(124, 'Dinge: Brief'),
(123, 'Tätigkeit: sich beziehen auf'),
(125, 'Tätigkeit: in Verbindung stehen'),
(126, 'Dinge: Kelch'),
(127, 'Dinge: 2 Spielkegel'),
(128, 'Personen: Chef-Angestellter'),
(129, 'Tätigkeit: benutzen'),
(130, 'Tätigkeit: besitzen'),
(133, 'Tätigkeit: verschwägert sein'),
(135, 'Tätigkeit: Cousin/Cousine sein'),
(136, 'Tätigkeit: Onkel/Tante sein'),
(137, 'Tätigkeit: Schwiegervater/-mutter sein'),
(138, 'Tätigkeit: Vormund sein'),
(139, 'Dinge: Zweispitz'),
(143, 'Attribute: Fragezeichen'),
(144, 'Tätigkeit: händeschüttlen'),
(145, 'Wappen: Rom'),
(146, 'Dinge: Kupferbarren');

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

