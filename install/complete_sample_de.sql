-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Juli 2009 um 13:26
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET NAMES utf8 */;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;

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

--
-- Daten für Tabelle `hc_bibliographies`
--

INSERT INTO `hc_bibliographies` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `shorttitle`, `longtitle`, `shortref`, `comment`) VALUES
(1, '2006-01-03 15:38:28', '2006-01-04 10:34:24', 1, 1, 0, 'Knabe, Kaufleute in Indien', 'Knabe, Wolfgang (Hrsg. und Verfasser): Auf den Spuren der ersten deutschen Kaufleute in Indien. Forschungsexpedition mit der Mercator entlang der Westküste und zu den Aminen, Anhausen 1993.', 'knabe:kaufleute', 'Knabe legte dieses Buch als Ergebnis einer Forschungsreise an. Teile davon sind von anderen Autoren (z.B. Mathew).'),
(2, '2006-01-03 15:52:52', '2006-01-04 10:36:22', 1, 1, 0, 'Hildebrandt, Georg Fuggerische Erben', 'Hildebrandt, Reinhard: Die "Georg Fuggerischen Erben". Kaufmännische Tätigkeit und sozialer Status 1555-1600 (Schriften zur Wirtschafts- und Sozialgeschichte, Bd. 6), Berlin 1966.', 'hb:erben', 'Das wohl im Moment umfassendste Werk zum Indienhandel der Fuggerischen Erben.'),
(3, '2006-01-03 15:55:18', '2006-01-04 10:35:42', 1, 1, 0, 'Dobel, Pfefferhandel', 'Dobel, Friedrich: Über einen Pfefferhandel der Fugger und Welser 1586-91, in: ZHVSN 13 (1886), S. 125-38.', 'dobel:pfefferhandel', 'Dobel war Archivar im Fuggerarchiv in Dillingen. Er fand in den 80er Jahren des 19. Jahrhunderts die Unterlagen zum Indienhandel (die Kopierbücher der Fuggerischen Erben) und veröffentlichte seine Erkenntnisse in diesem Artikel.'),
(4, '2006-01-03 15:57:45', '2006-01-04 10:40:39', 1, 1, 0, 'Reinhard, Augsburger Eliten', 'Reinhard, Wolfgang (Hrsg.): Augsburger Eliten des 16. Jahrhunderts. Prosopographie wirtschaftlicher und politischer Führungsgruppen 1500-1620. Bearbeitet von Mark Häberlein, Urlich Klinkert, Katarina Sieh-Burens und Reihnard Wendt, Berlin 1996.', 'reinhard:eliten', 'Umfassendes Nachschlagewerk, das Personen aus der Augsburger Führungsschicht identifiziert und miteinander in Verbindung setzt - eine semantische Datenbank in Buchform, sozusagen...'),
(5, '2006-01-03 15:58:17', '2006-01-04 10:37:04', 1, 1, 0, 'Hildebrandt, Informationsprobleme', 'Hildebrandt, Reinhard: Informationsprobleme im interkontinentalen Handel des 16. Jahrhunderts, in: Gömmel, Rainer/Markus Denzel (Hrsg.): Weltwirtschaft und Wirtschaftsordnung. Festschrift für Jürgen Schneider zum 65. Geburtstag, Stuttgart 2002, S. 57-67.', 'hb:informationsprobleme', 'Erwähnt einige Beispiele zu Informationsproblemen im Indienhandel.'),
(6, '2006-02-07 16:12:16', '2006-02-07 16:12:16', 1, 1, 0, 'Behringer, Fugger und Taxis', 'Behringer, Volker: Fugger und Taxis. Der Anteil der Augsburger Kaufleute an der Entstehung des europäischen Kommunikationssystems, in: Burkhardt, Johannes (Hrsg.): Augsburger Handelshäuser im Wandel des historischen Urteils (Colloquia Augustana, Bd. 3), Berlin 1996, S. 241-248.', 'behringer:taxis', '- sehr kurze Zusammenfassung der Postentwicklung\r\n- kritische Neubewertung der Bedeutung von Fuggern und Taxis in der Entwicklung des europäischen Postsystems'),
(7, '2006-02-08 11:24:45', '2006-02-08 11:25:38', 1, 1, 0, 'Hildebrandt, Diener und Herrn', 'Hildebrandt, Reinhard: Diener und Herrn. Zur Anatomie großer Unternehmen im Zeitalter der Fugger, in: Burkhardt, Johannes (Hrsg.): Augsburger Handelshäuser im Wandel des historischen Urteils (Colloquia Augustana, Bd. 3), Berlin 1996, S. 149-174.', 'hb:diener', 'Erkenntnisse zur Organisation von Firmen in der FNZ'),
(8, '2006-02-21 10:49:05', '2006-02-21 10:49:05', 1, 1, 0, 'Behringer: Thurn und Taxis', 'Behringer, Wolfgang: Thurn und Taxis. Die Geschichte ihrer Post und ihrer Unternehmen, München/Zürich 1990.', 'behringer:post', NULL),
(9, '2006-03-03 10:36:29', '2006-03-03 10:40:27', 1, 1, 0, 'Behringer, Merkur', 'Behringer, Wolfgang: Im Zeichen des Merkur. Reichspost und Kommunikationsrevolution in der Frühen Neuzeit (Veröffentlichungen des MPI für Geschichte, Bd. 189), Göttingen 2003.', 'behringer:merkur', 'Umfangreiches Werk, das die frühe Geschichte des Postwesens so ziemlich komplett darstellt.'),
(10, '2006-05-08 14:19:25', '2007-07-10 14:29:01', 1, 1, 0, 'Boyajian, Trade under the Habsburgs', 'Boyajian, James C.: Portuguese Trade in Asia under the Habsburgs 1580–1640, Baltimore/London 1993.', 'boy:habsburgs', 'Zwei Schwerpunkte:\r\n- private Cape trade\r\n- New Christians in Asia'),
(11, '2006-06-06 10:56:26', '2006-06-06 10:58:32', 1, 1, 0, 'Boxer, Tragic History', 'Boxer, Charles R. (ed./transl.): The Tragic History of the Sea, Millwood (NY) 1986, orig. 1959.', 'boxer:tragichistory1', 'Erster Teil in der Anthologie Boxer, Charles R. (ed./transl.): "The Tragic History of the Sea", Minneapolis 2001.'),
(12, '2006-06-06 10:58:21', '2006-06-07 10:24:42', 1, 1, 0, 'Coelho, Duarte Gomes Solis', 'Coelho, António Borges: Duarte Gomes Solis. Portugal e o Império, Lissabon 1996.', 'coelho:duarte', '12-seitige Veröffentlichung der Academia de Marinha.'),
(13, '2006-06-07 10:42:39', '2006-06-07 10:42:39', 1, 1, 0, 'Boyajian, Portuguese Bankers', 'Boyajian, James C.: Portuguese Bankers at the Court of Spain 1626-1650, New Brunswick 1983.', 'boy:bankers', 'Hier sind vor allem die Stammbäume der portugiesischen Neuchristen interessant!'),
(14, '2006-06-15 20:59:23', '2006-06-15 20:59:23', 1, 1, 0, 'Malekandathil, Germans', 'Malekandathil, Pius: The Germans, the Portuguese and India (Periplus Parerga, Bd. 6), Münster 1999.', 'male:germans', NULL),
(15, '2006-06-20 09:53:59', '2006-06-20 09:53:59', 1, 1, 0, 'Kellenbenz, Ferdinand Ximenes', 'Kellenbenz, Hermann: Die Geschäfte der Firma "Ferdinand Ximenes und Erben des Rui Nunes" in Köln, in: Rosa, Luigi de (Hg.): Ricerche storiche ed economiche in memoria di Corrado Barbagallo, Bd. 2, Neapel 1970, 291-314.', 'kb:ximenes', NULL),
(16, '2006-06-20 09:59:17', '2006-06-20 09:59:17', 1, 1, 0, 'Kellenbenz, Sephardim', 'Kellenbenz, Hermann: Sephardim an der unteren Elbe. Ihre wirtschaftliche und politische Bedeutung vom Ende des 16. bis zum Beginn des 18. Jahrhunderts (VSWG Beiheft 40), Wiesbaden 1958.', 'kb:sephardim', NULL),
(17, '2006-06-21 15:12:13', '2006-06-21 15:12:13', 1, 1, 0, 'Thimme, Handel Kölns', 'Thimme, Hermann: Der Handel Kölns am Ende des 16. Jahrhunderts und die internationale Zusammensetzung der Kälner Kaufmannschaft, in: Westdeutsche Zeitschrift für Geschichte und Kunst 32 (1912), S. 389-473.', 'thimme:handelkoelns', NULL),
(18, '2006-06-30 13:01:29', '2006-06-30 13:01:29', 1, 1, 0, 'Moreland, India', 'Moreland, William Harrison: India at the Death of Akbar. An Economic Study, Delhi 1999, reprint of 1920.', 'moreland:akbar', 'Ashin Das Gupta sagt über Moreland (in: Moreland Hypothesis): "he was concerned to show the superiority of the British Empire" + "one ocean" idea'),
(19, '2006-06-30 14:16:12', '2006-06-30 14:16:12', 1, 1, 0, 'Kellenbenz, Unternehmerkräfte', 'Kellenbenz, Hermann: Unternehmerkräfte im Hamburger Portugal- und Spanienhandel 1590--1625 (Veröffentlichungen der Wirtschaftsgeschichtlichen Forschungsstelle e.V., Bd. 10), Hamburg 1954.', 'kb:hamburg', NULL),
(20, '2006-07-05 16:31:31', '2006-07-06 09:07:29', 1, 1, 0, 'Häberlein, Fugger und Welser', 'Häberlein, Mark: Fugger und Welser: Kooperation und Konkurrenz 1496-1614, in: Häberlein Mark/Burkhardt Johannes: Die Welser. Forschungen zur Geschichte und Kultur des oberdeutschen Handelshauses (Colloquia Augustana, Bd. 16), Berlin 2002, S. 223-239', 'haeberlein:fuggerundwelser', 'HIS:OV:580:2002'),
(21, '2006-07-05 16:40:04', '2006-07-06 09:07:16', 1, 1, 0, 'Hildebrandt, Niedergang der Welser', 'Hildebrandt, Mark: Der Niedergang der Augsburger Welser-Firma (1560-1614), in: Häberlein Mark/Burkhardt Johannes: Die Welser. Forschungen zur Geschichte und Kultur des oberdeutschen Handelshauses (Colloquia Augustana, Bd. 16), Berlin 2002, S. 265-281', 'hb:niedergang', 'HIS:OV:580:2002'),
(22, '2006-07-10 15:09:28', '2008-11-25 17:05:51', 1, 1, 0, 'Ehrenberg, Zeitalter der Fugger, Bd. 1', 'Ehrenberg, Richard: Das Zeitalter der Fugger. Geldkapital und Creditverkehr im 16. Jahrhundert, Bd. 1: Die Geldmächte des 16. Jahrhunderts, Jena 1898.', 'ehrenberg:zf1', ''),
(23, '2006-07-10 15:09:53', '2006-07-10 15:09:53', 1, 1, 0, 'Ehrenberg, Zeitalter der Fugger, Bd. 2', 'Ehrenberg, Richard: Das Zeitalter der Fugger. Geldkapital und Creditverkehr im 16. Jahrhundert, Bd. 2: Die Weltbörden und Finanzkrisen des 16. Jahrhunderts, Jena 1898.', 'ehrenberg:zf2', NULL),
(24, '2006-07-20 12:28:27', '2006-07-20 12:28:27', 1, 1, 0, 'Gramulla, Kölner Kaufleute', 'Gramulla, Gertrud Susanna: Handelsbeziehungen Kölner Kaufleute zwischen 1500 und 1650 (Forschungen zur internationalen Sozial- und Wirtschaftsgeschichte, Bd. 4), Köln 1972.', 'gramulla:koelnerkaufleute', NULL),
(25, '2006-07-20 13:53:04', '2006-07-20 13:53:04', 1, 1, 0, 'Kellenbenz, Pfeffermarkt', 'Kellenbenz, Hermann: Der Pfeffermarkt um 1600 und die Hansestädte, in Hansische Geschichtsblätter 74 (1956), S. 28-49.', 'kb:pfeffermarkt', NULL),
(26, '2006-08-15 09:47:24', '2008-09-12 16:09:01', 1, 1, 0, 'de Prada, Lettres d''Anvers III', 'Prada, Valentín Vazquez de: Lettres Marchandes d''Anvers, Tome III (École pratique des hautes études - VIe section centre de recherches historiques, affaires et gens d''affaires, 18.2), Paris 1961.', 'prada:anvers3', 'hauptsächlich Geldgeschäfte - Handel spielt eine etwas untergeordnete Rolle.'),
(27, '2006-08-17 12:20:57', '2008-09-12 16:08:48', 1, 1, 0, 'de Prada, Lettres d''Anvers IV', 'Prada, Valentín Vazquez de: Lettres Marchandes d''Anvers, Tome III (École pratique des hautes études - VIe section centre de recherches historiques, affaires et gens d''affaires, 18.3), Paris 1961.', 'prada:anvers4', 'ab 1586 Berichte über englische Kaperfahrer & Engländer in Indien\r\n\r\n1588 Februar: Berichte über spanische Armada'),
(28, '2006-11-07 15:54:23', '2006-11-22 14:16:56', 1, 1, 0, 'Boxer, Seaborne Empire', 'Boxer, Charles R.: The Portuguese Seaborne Empire. 1415-1825, Manchester 1997, Reprint of original edition of 1969', 'boxer:empire', '"Klassiker", allerdings umstrittene Thesen\r\n\r\nz.B. "pax Lusitanica" (Christian Century in Japan, S. 105): Europäer nicht so wichtig...'),
(29, '2006-11-10 12:26:48', '2006-11-22 14:23:08', 1, 1, 0, 'Newitt, Portuguese Overseas Expansion', 'Newitt, Malyn: A History of Portuguese Overseas Expansion 1400-1668, Oxon/New York 2005.', 'newitt:history', 'Neuere Zusammenfassung der portugiesischen Expansion.\r\n\r\nKritik meinerseits:\r\n- Portugiesen zu sehr im Fokus, die nicht-Portugiesen spielen im Prinzip keine Rolle, auch in den "Communities" nicht\r\n- er stellt zwar die wichtigkeit des "informal empire" heraus, hat aber eine relativ konservative Ansicht zum "formal empire"\r\n- meint dazu [261f:], dass es vor allem die Portugiesen waren, die das weltweite Handelsnetz bauten, keine anderen => Rolle der anderen Händler nicht so wichtig (was m.E. nicht stimmt)\r\n=> Frage nach Nationalitäten: Rolle der Portugiesen wichtig, dennoch fragt sich selbst Newitt, inwieweit eine nationale Identität existierte (s. hier auch Neuchristen)\r\n- "Epocheneinteilung" bei S. 252ff kritisch - 1550-80 nennt er die "Privatisierungsphase", wobei noch 1580 die Pfeffermonopole groß privatisiert wurden.\r\n\r\n[267:] Berechtigte Frage: "How could such small number of Europeans from a poor and underdeveloped country establish themselves as a power in three continents and maintain this power for so long against richer and much more numerous opponents."? => hier greift seine Argumentation zu kurz; klar Kriegstechnologie und Dreistigkeit spielten eine wichtige Rolle, aber private Netzwerke und der Einfluss der Bankiers darf auf keinen Fall unterschätzt werden - das ist ein Manko der englischsprachigen Literatur... auch klar: Die Könige und Entdecker posaunen ihre großen Taten frei heraus, während die Bankhäuser diskret im Hintergrund stehen, was nicht bedeutet, dass sie untätig zusehen.'),
(30, '2006-11-23 13:15:03', '2006-11-23 13:15:03', 1, 1, 0, 'Cimino/Scialpi: India and Italy', 'Cimino, Rosa Maria/Scialpi, Fabio: India and Italy. Exhibition organized in collaboration with the Archaeological Survey of India and the Indian Council for Cultural Relations (organized by the Istituto Italiano per il Medio ed Estremo Oriente), Rom 1974', 'cimino:indiaanditaly', 'kunsthistorisches Werk, enthält jedoch die Namen und Kurzbiographien vieler Italiener, die in Indien waren'),
(31, '2006-11-23 14:46:44', '2008-11-26 17:24:25', 1, 1, 0, 'Das Gupta, Maritime Merchant of Medieval India', 'Das Gupta, Ashin: The Maritime Merchant [of Medieval India], c. 1500-1800 (Proceedings of the Indian History Congress, Presidential Address to the Medieval Section, 35th Session 1974, Jadavput University Calcutta. University of Dhelhi, 1974), in: Das Gupta, Ashin: Merchants of Maritime India. 1500-1800 (Variorum Collected Studies Series, CS 441), Aldershot 1994, article III.', 'gupta:maritimemerchant', '3 Probleme in der Forschung [3:]:\r\n- was ist am "mittelalterlichen Handel anders als davor?"\r\n- kein wirklich gutes Quellenmaterial\r\n- indische Handelsgeschichte kann nur im Kontext der Geschichte des Indischen Ozeans geschrieben werden\r\nVorurteile (v.a. Van Leur) [5:]:\r\n- Kleinhändler\r\n- nur Luxushandel\r\n- statische Welt (nur Routen, etc. ändern sich, Struktur nicht)\r\n\r\n=> das Gupta sagt:\r\n-> Textilhandel und Korn wurden gehandelt, eher weniger Luxushandel [5f:]\r\n-> Allgemeingüter werden gehandelt, z.T. zu festen Zeiten (Monsun) [6:]\r\n-> [7f:] man kann die Behauptung des Kleinhändler durchaus halten Stellung des Händlers in der Gesellschaft nicht so super ([11:] fringe of a vast continental society), tw. Großreiche mit despotischer Kontrolle (Herrscherferne), wenig Interesse der landverbundenen Aristokratie am Handel auf See.\r\n-> aber: lokale Administratoren und einzelne Adelige beteiligen sich am Handel => v.a. Investitionen [9f:]\r\n-> [14:] Änderung über Zeit: schwer festzustellen, aber grundsätzlich über das cartaz-Sytem wurden kleinere Schiffe bevorzugt bzw. Schiffsplatz auf großen -> Kleinhändler im Aufwind'),
(32, '2006-11-23 15:28:19', '2006-11-23 15:36:09', 1, 1, 0, 'Das Gupta, Changing Faces', 'Das Gupta, Ashin: Changing Faces of the Maritime Merchant (Emporia, Commodities and Entrepreneurs in Asian Maritime Trade c. 1400-1750, ed. R. Ptak and D. Rothermund, Wiesbaden: Franz Steiner Verlag, 1991), in: Das Gupta, Ashin: Merchants of Maritime India. 1500-1800 (Variorum Collected Studies Series, CS 441), Aldershot 1994, article IV.', 'gupta:changingfaces', '2 Gruppen nach Van Leur:\r\na) Schiffsbesitzer (Handel als Beruf)\r\nb) Geldbsitzer(Kapital investieren)\r\n\r\nnennt auch einige Namen, allerdings v.a. offenbar aus dem 17. Jh.'),
(33, '2006-12-06 09:59:07', '2006-12-06 09:59:07', 1, 1, 0, 'Das Gupta, Maritime Merchant and Indian History', 'Das Gupta, Ashin: The Maritime Merchant and Indian History, in: Das Gupta, Uma (ed.): The World of the Indian Ocean Merchant 1500-1800. Collected Essays of Ashin Das Gupta, New Delhi 2001, pp. 23-33.', 'gupta:merchantandhistory', NULL),
(34, '2006-12-06 13:28:04', '2006-12-06 13:28:54', 1, 1, 0, 'Das Gupta, India and the Ocean', 'Das Gupta, Ashin: India and the Indian Ocean, c. 1500--1800: The Story, in: Das Gupta, Uma (ed.): The World of the Indian Ocean Merchant 1500-1800. Collected Essays of Ashin Das Gupta, New Delhi 2001, pp. 34-58.', 'gupta:indiaandocean', NULL),
(35, '2006-12-06 14:35:42', '2009-01-06 18:13:23', 1, 1, 0, 'Das Gupta, Indian Merchants', 'Das Gupta, Ashin: Indian Marchants and Trade in the Indian Ocean, c. 1500-1750, in: Das Gupta, Uma (Hrsg.): The World of the Indian Ocean Merchant 1500-1800. Collected Essays of Ashin Das Gupta, Neu-Delhi 2001, S. 59-87.', 'gupta:indianmerchants', ''),
(36, '2006-12-11 18:05:23', '2006-12-12 10:15:14', 1, 1, 0, 'Carletti, Reise', 'Carletti, Francesco: Reise um die Welt 1594. Erlebnisse eines Florentiner Kaufmanns (Übersetzung aus dem Italienischen von Ernst Bluth), Tübingen/Basel 1978.', 'carletti:1594', 'Reise über Amerika, Indien einmal um die Welt, viele Details zu Kulturen, Gegebenheiten, etc. Interessiert sich jedoch offenbar hauptsächlich für Frauen...'),
(37, '2006-12-13 15:42:26', '2007-04-23 18:14:26', 1, 1, 0, 'Kellenbenz, Die fremden Kaufleute', 'Kellenbenz, Hermann: Die fremden Kaufleute auf der iberischen Halbinsel vom 15. Jahrhundert bis zum Ende des 16. Jahrhunderts, in: Kellenbenz, Hermann (Hrsg.): Fremde Kaufleute auf der iberischen Halbinsel (Kölner Kolloquien zur internationalen Sozial- und Wirtschaftsgeschichte, Bd. 1), Köln 1970, S. 265-376.', 'kb:fremdekaufleute_art', NULL),
(38, '2006-12-19 10:45:43', '2007-06-25 16:53:23', 1, 1, 0, 'Schaper, Hirschvogel', 'Schaper, Christa: Die Hirschvogel von Nürnberg und ihr Handelshaus (Nürnberger Forschungen, Bd. 18), Nürnberg 1973.', 'schaper:hirschvogel', NULL),
(39, '2006-12-21 09:44:13', '2006-12-23 13:00:57', 1, 1, 0, 'Rohr, Neue Quellen zur zweiten Indienfahrt', 'von Rohr, Christine: Neue Quellen zur zweiten Indienfahrt Vasca da Gamas (Quellen und Forschungen zur Geschichte der Geographie und Völkerkunde, Bd. 3), Leipzig 1939.', 'rohr:indienfahrt', 'Texte: Nationalbibliothek Wien, Handschriftenkatalog Nr. 6948 (Hist. prof. 856): portugiesischer und deutscher Text zur 2. Indienfahrt von Vasco da Gama -> 1502.\r\nAußerdem: dt. Übersetzung des Themé Lopes-Textes'),
(40, '2006-12-21 10:37:11', '2006-12-21 10:37:11', 1, 1, 0, 'Krása/Polišenský/Ratkoš, Bratislava Manuscript', 'iloslav Krása and Josef Polišenský and Peter Ratkoš: he Voyages of Discovery in the Bratislava Manuscript Lyc.515/8 (Codex Bratislavensis). European Expansion 1494-1519, Prag 1986.', 'krasa:manuscript', NULL),
(41, '2006-12-21 15:34:44', '2007-03-22 11:19:50', 1, 1, 0, 'Kellenbenz, Fugger in Spanien und Portugal', 'Kellenbenz, Hermann: Die Fugger in Spanien und Portugal bis 1560. Ein Großunternehmen des 16. Jahrhunderts (Schwäbische Forschungsgemeinschaft bei der Kommission für Bayerische Landesgeschichte, Reihe 4, Band 23/1, 23/2 und 24. Studien zur Fuggergeschichte, Bd. 32/1, 32/2 und 33), 3 Bde. (Darstellung, Anmerkungen, Dokumente), München 1990 (Kellenbenz, Die Fugger in Spanien und Portugal).', 'kb:spanien', NULL),
(42, '2007-01-02 11:17:40', '2007-01-02 12:43:14', 1, 1, 0, 'Linschoten, Voyage 1', 'Linschoten, Jan Huygen van: The Voyage of John Huyghen van Linschoten to the East Indies. From the old English translation of 1598 (Reprint of the editon of Arthur Coke Burnell), volume 1, New Delhi 1988.', 'linschoten:1', 'englische Übersetzung durch Bernhard ten Broecke (Paulandus), der war selbst in Syrien und Ägypten.'),
(43, '2007-01-02 11:18:20', '2007-01-02 11:18:20', 1, 1, 0, 'Linschoten, Voyage 2', 'Linschoten, Jan Huygen van: The Voyage of John Huyghen van Linschoten to the East Indies. From the old English translation of 1598 (Reprint of the editon of P. A. Tiele), volume 2, New Delhi 1988.', 'linschoten:2', NULL),
(44, '2007-01-04 13:29:40', '2007-01-04 13:29:40', 1, 1, 0, 'Pieris/Fitzler, Ceylon and Portugal', 'Pieris, Paulus Edward/Fitzler Hedwig: Ceylon and Portugal. Part 1: Kings and Christians 1539--1552. From the Original Documents at Lisboa, Leipzig 1927.', 'pieris:ceylon', NULL),
(45, '2007-01-19 17:50:02', '2007-01-19 17:53:06', 1, 1, 0, 'Calcoen-Bericht', 'Berjean, J. Ph. (Übersetzer): Calcoen. A Dutch Narrative of the Second Voyage of Vasco da Gama to Calicut. Printed at Antwerp circe 1504 (Facsimile und übersetzte Version), London 1874.', 'calcoen', 'Bericht eines unbekannten Holländers 1502\r\n\r\nUnter anderem:\r\n- Berichte über skrupellose christliche Händler im Mittelmeer, die an Araber verkaufen\r\n- Zusammenhänge des Gewürzhandels Asien--Europa offenbar allgemein bekannt, denn der Seemann berichtet davon.\r\n- Christen und Juden in Indien, auch Zahl\r\n- Kampf gegen die Ungläubigen\r\n\r\naber: keine wirtschaftlichen Zusammenhänge erklärt'),
(46, '2007-01-22 16:08:03', '2007-01-23 09:50:54', 1, 1, 0, 'Schaper, Faktoren', 'Schaper, Christa: Die Hirschvogel von Nürnberg und ihre Faktoren in Lissabon und Sevilla, in: Kellenbenz, Hermann: Fremde Kaufleute auf der iberischen Halbinsel (Kölner Kolloquien zur internationalen Sozial- und Wirtschaftsgeschichte, Bd. 1), Köln 1970, S. 176-196.', 'schaper:faktoren', NULL),
(47, '2007-01-23 09:50:30', '2007-01-23 09:54:35', 1, 1, 0, 'Konetzke, Verhaltensweisen', 'Konetzke, Christa: Die spanischen Verhaltensweisen zum Handel als Voraussetzungen für das Vordringen der ausländischen Kaufleute in Spanien, in: Kellenbenz, Hermann: Fremde Kaufleute auf der iberischen Halbinsel (Kölner Kolloquien zur internationalen Sozial- und Wirtschaftsgeschichte, Bd. 1), Köln 1970, S. 4-14.', 'konetzke:verhaltensweisen', 'interessanter Artikel zum kulturellen Hintergrund => Spanier sind nicht unbedingt auf Sparsamkeit bedacht, gilt als schändlicher Geiz...'),
(48, '2007-01-23 10:26:29', '2007-01-23 10:26:29', 1, 1, 0, 'Rau, Privilégios', 'Rau, Virginia: Privilégios e legislacão portuguesa refernetes a mercadores estrangeiros (séculos XV e XVI), in: Kellenbenz, Hermann: Fremde Kaufleute auf der iberischen Halbinsel (Kölner Kolloquien zur internationalen Sozial- und Wirtschaftsgeschichte, Bd. 1), Köln 1970, S. 15-30.', 'rau:privilegios', NULL),
(49, '2007-02-01 10:21:02', '2007-02-01 10:21:02', 1, 1, 0, 'Fernberger, Reisetagebuch', 'Fernberger, Georg Christoph: Reisetagebuch (1588--1593) Sinai, Babylon, Indien, Heiliges Land, Osteuropa. Lateinisch--Deutsch. Kritische Edition und Übersetzung von Ronald Burger und Robert Wallisch (Beiträge zur Neueren Geschichte Österreichs, Vol. 12), Frankfurt (Main) 1999.', 'fernberger:1588', NULL),
(50, '2007-02-05 10:23:37', '2007-02-05 10:23:37', 1, 1, 0, 'Kammerer/Nebinger, Eberz und Furtenbach', 'Kammerer, J./Nebinger G.: Die schwäbischen Patriziergeschlechter Eberz und Furtenbach, Neustadt a. d. Aisch 1955 (aus: Genealogisches Handbuch des in Bayern immatrikulierten Adels. Bd. 5).', 'geschlechter:furtenbach', NULL),
(51, '2007-02-05 13:26:54', '2007-02-05 13:27:00', 1, 1, 0, 'Melis, Marcanti Italiani', 'Melis, Federigo: I mercanti italiani dell''Europa medievale e rinascimentale (Opere sparse di Federigo Melis, Bd. 2), Florenz 1990.', 'melis:marcanti', NULL),
(52, '2007-02-05 15:47:26', '2007-02-05 15:47:26', 1, 1, 0, 'Varthema, Reisen', 'Varthema, Ludovico de: Reisen im Orient. Übersetzung von Folker Reichert (Fremde Kulturen in alten Berichten, Bd. 2), Sigmaringen 1996.', 'varthema:reisen', NULL),
(53, '2007-02-06 12:38:28', '2008-12-02 21:29:47', 1, 1, 0, 'Archivio Biografico Italiano', 'Archivio Biografico Italiano', 'abi', ''),
(54, '2007-02-19 11:05:02', '2007-02-19 11:05:02', 1, 1, 0, 'Chaudhuri, Trade and Civilisation', 'Chaudhuri, K. N.: Trade and Civilisation in the Indian Ocean. An Economic History from the Rise of Islam to 1750, Cambridge 1985.', 'chaudhuri:tradeandcivilisation', NULL),
(55, '2007-03-14 15:35:06', '2007-03-14 15:35:06', 1, 1, 0, 'Lapeyre, Simon Ruiz', 'Lapeyre, Henri: Simon Ruiz et les Asientos de Philippe II (Affaires et Gens d''affaires, Bd. VI), Paris 1953.', 'lapeyre:simonruiz', NULL),
(56, '2007-04-05 11:43:44', '2007-04-24 10:41:11', 1, 1, 0, 'Zunckel, Frischer Wind', 'Zunckel, Julia: Frischer Wind in alte Segel. Neue Perspektiven zur hansischen Mittelmeerfahrt (1590 - 1650), in: Hamburger Wirtschafts-Chronik Neue Folge 3 (2003), S. 7-43.', 'zunckel:wind', NULL),
(57, '2007-05-04 17:08:29', '2008-07-18 14:06:11', 1, 1, 0, 'Subrahmanyam, Portuguese Empire', 'Subrahmanyam, Sanjay: The Portuguese Empire in Asia 1500-1700. A Political and Economic History, London/New York 1993.', 'subrahmanyam:portugueseempire', NULL),
(58, '2007-05-15 12:35:40', '2007-05-15 12:35:40', 1, 1, 0, 'Rau, Lucas Giraldi', 'Rau, Virginia: Um grande mercador-banquiero italiano em Portugal: Lucas Giraldi (Sonderdruck aus Estudos Italianos em Portugal, 24), [Lissabon] 1965.', 'rau:giraldi', NULL),
(59, '2007-05-18 19:04:17', '2007-05-18 19:04:17', 1, 1, 0, 'Kellenbenz, Melchior Manlich to Ferdinand Cron', 'Kellenbenz, Hermann: From Melchior Manlich to Ferdinand Cron. German Levantine and Oriental Trade Relations (Scond Half of XVIth and Beginning of XVIIth Centuries, in: The Journal of European Economic History 19 (1990), S. 611-622.', 'kb:levantine', NULL),
(60, '2007-05-21 15:15:57', '2007-05-21 15:15:57', 1, 1, 0, 'Schirmer, Kursächsische Staatsfinanzen', 'Schirmer, Uwe: Kursächsische Staatsfinanzen (1456-1656). Strukturen, Verfassung, Funktionseliten (Quellen und Forschungen zur sächsischen Geschichte, Bd. 28), Stuttgart 2006.', 'schirmer:staatsfinanzen', NULL),
(61, '2007-05-22 20:49:13', '2007-05-22 20:49:13', 1, 1, 0, 'Bauer, Unternehmung', 'Bauer, Clemens: Unternehmung und Unternehmungsformen im Spätmittelalter und in der beginnenden Neuzeit (München Volkswirtschaftliche Studien, Neue Folge, Bd. 23), Jena 1936.', 'bauer:unternehmung', NULL),
(62, '2007-06-21 16:14:28', '2007-06-21 16:14:28', 1, 1, 0, 'Pohle, Deutschland und die überseeische Expansion', 'Pohle, Jürgen: Deutschland und die überseeische Expansion Portugals im 15. und 16. Jahrhundert (Historia profana et ecclesiastica. Geschichte und Kirchengeschichte zwischen Mittelalter und Moderne, Bd. 2), Köln 1999.', 'pohle:deutschland', NULL),
(63, '2007-06-27 08:23:24', '2007-06-27 13:26:19', 1, 1, 0, 'Mathew, Indo-Portuguese Trade and the Fuggers', 'Mathew, Kuzhippalli Skaria: Indo-Portuguese Trade and the Fuggers of Germany. Sixteenth Century, New Delhi 1997.', 'mathew:fuggers', 'Anhang: Privilegien für die Deutschen als Transkript + Asienkontrakt 1585, Fuggerzeitungen (Briefe aus Indien)'),
(64, '2007-07-11 10:35:32', '2009-01-26 11:33:59', 1, 1, 0, 'Westermann, Saigerhandel', 'Westermann, Ekkehard: Die Nürnberger Welser und der mitteldeutsche Saigerhandel des 16. Jahrhunderts in seinen europäischen Verflechtungen, in: Häberlein, Mark/Burkhardt, Johannes: Die Welser. Forschungen zur Geschichte und Kultur des oberdeutschen Handelshauses (Colloquia Augustana, Bd. 16), Berlin 2002, S. 240-264.', 'westermann:saigerhandel', ''),
(65, '2007-07-11 12:04:47', '2007-07-11 12:04:47', 1, 1, 0, 'Meder''sches Handelsbuch', 'Kellenbenz, Hermann (Hrsg.): Handersbräuche des sechzehnten Jahrhunderts. Das Meder''sche Handelsbuch und die Welserschen Nachträge (Deutsche Handelsakten des Mittelalters und der Neuzeit, Bd. 15), Wiesbaden 1974.', 'meder', NULL),
(66, '2007-07-11 13:53:47', '2007-07-11 14:18:31', 1, 1, 0, 'Hildebrandt, Paler und Rehlinger', 'Hildebrandt, Reinhard: Quellen und Regesten zu den Augsburger Handelshäusern Paler und Rehlinger 1539--1642 (Deutsche Handelsakten des Mittelalters und der Neuzeit, Bd. 19), Teil 1: 1539-1623, Stuttgart 1996.', 'hb:palerrehlinger', '# bei den Angaben bedeutet Nummer der Quelle oder des Regests'),
(67, '2007-07-12 10:58:13', '2007-07-12 10:59:17', 1, 1, 0, 'Westermann, Kupferhalbfabrikate', 'Westermann, Ekkehard: Kupferhalbfabrikate vor dem Tor zur Welt. Zum Hamburger Kupfermarkt an der Wende vom 16. zum 17. Jahrhundert, in: Gömmel, Rainer/Denzel, Markus: Weltwirtschaft und Wirtschaftsordnung. Festschrift für Jürgen Schneider zum 65. Geburtstag (VSWG-Beihefte, Bd. 159), Stuttgart 2002, S. 85-100.', 'westermann:kupferhalbfabrikate', NULL),
(68, '2007-08-07 10:01:41', '2007-08-07 10:01:41', 1, 1, 0, 'Lutz, Peutinger', 'Lutz, Heinrich: Conrad Peutinger. Beiträge zu einer politischen Biographie (Abhandlungen zur Geschichte der Stadt Augsburg, Bd. 9), Augsburg 1958.', 'lutz:peutinger', NULL),
(69, '2007-08-09 10:02:32', '2007-08-09 10:02:32', 1, 1, 0, 'Mauro, Merchant Communities', 'Mauro, Frédéric: Merchant Communities 1350-1750, in: Tracy, James (Hrsg.): The Rise of Merchant Empires. Long Distance Trade in the Early Modern World. 1350–1750, Cambridge 1993, S. 255-286.', 'mauro:communities', NULL),
(70, '2007-08-09 17:08:37', '2007-08-09 17:08:37', 1, 1, 0, 'Hildebrand, Fernhandel', 'Hildebrand, Reinhard: Fernhandel und Geldverkehr im Dreißigjährigen Krieg. Ein Beitrag zur Geschichte der Schwendendöfer und Jenisch, in: Zwahr Hartmut/Schirmer, Uwe/Steinführer, Henning (Hrsg.): Leipzig, Mitteldeutschland und Europa. Festgabe für Manfred Straube und Manfred Unger zum 70. Geburtstag, Beucha 2000, S. 379-385.', 'hb:fernhandel', NULL),
(71, '2007-08-16 15:01:56', '2007-08-16 15:02:09', 1, 1, 0, 'Mathew, Taxation', 'Mathew, Kuzhippalli Skaria: Taxation in the Coastal Towns of Western India and the Portuguese in the Sixteenth Century, in: ders. (Hrsg.): Mariners, Merchants and Oceans. Studies in Maritime History, New Delhi 1995, S. 143-162.', 'mathew:taxation', NULL),
(72, '2007-08-16 16:41:45', '2007-08-16 16:41:45', 1, 1, 0, 'Subrahmanyam, Vasco Da Gama', 'Subrahmanyam, Sanjay: The Career and Legend of Vasco Da Gama, Cambridge 1997.', 'subrahmanyam:vasco', NULL),
(73, '2007-09-11 16:55:40', '2007-09-11 16:55:40', 1, 1, 0, 'Subrahmanyam, Mughals', 'Subrahmanyam, Sanjay: Mughals and Franks (Explorations in Connected History), New Delhi 2005.', 'subrahmanyam:mughals', NULL),
(74, '2007-09-13 15:23:54', '2007-09-13 15:26:55', 1, 1, 0, 'Pearson, World of the Indian Ocean', 'Person, Michael N.: The World of the Indian Ocean 1500--1800. Studies in Economic, Social and Cultural History (Variorum Collected Studies Series), Aldershot/Burlington 2005', 'pearson:worldofindianocean', NULL),
(75, '2007-09-14 14:28:08', '2007-09-14 14:28:08', 1, 1, 0, 'van der Wee, Antwerp market I', 'van der Wee, Herman: The Growth of the Antwerp market and the European Economy. Volume I: Statistics, Louvain 1962.', 'vanderwee:AntwerpI', NULL),
(76, '2007-09-14 14:28:45', '2007-09-14 14:28:45', 1, 1, 0, 'van der Wee, Antwerp market II', 'van der Wee, Herman: The Growth of the Antwerp market and the European Economy. Volume II: Interpretation, Louvain 1962.', 'vanderwee:AntwerpII', NULL),
(77, '2007-09-17 08:52:01', '2007-09-17 08:52:01', 1, 1, 0, 'Salomon, De Pinto', 'Salomon, H.P.: The ''De Pinto'' Manuscript, in: Studia Rosenthaliana 9 (1975), S. 1-62.', 'salomon:pinto', NULL),
(78, '2007-09-20 11:14:31', '2007-09-20 11:14:51', 1, 1, 0, 'Diffie/Winius, Foundations', 'Diffie, Bailey W./Winius, George D.: Foundations of the Portguese Empire 1415--1580, Minneapolis 1977.', 'diffiewinius:foundations', NULL),
(79, '2007-09-20 12:35:38', '2009-01-06 18:12:46', 1, 1, 0, 'Mathew, Giloni', 'Mathew, Kuzhippalli Skaria: Khwaja Shams-ud-din Giloni. A Sixteenth Century Entrepreneur in Portuguese India, in: Ptak, Roderich/Rothermund, Dietmar (Hrsg.): Commodities and Entrepreneurs in Asian Maritime Trade c. 1400-1750 (Beiträge zur Südasienforschung, Bd. 141), Wiesbaden 1991, S. 363-371.', 'mathew:giloni', ''),
(80, '2007-09-20 13:01:46', '2007-09-20 13:03:10', 1, 1, 0, 'Subrahmanyam, Cron', 'Subrahmanyam, Sanjay: An Augsburger in Ásia Portuguese. Further Light on the Commercial World of Ferdinand Cron. 1587-1624, in: Ptak, Roderich/Rothermund Dietmar (Hrsg.): Commodities and Entrepreneurs in Asian Maritime Trade c. 1400-1750 (Beiträge zur Südasienforschung, Vol. 141), Wiesbaden 1991, S. 401-425.', 'subrahmanyam:cron', 'ein paar neue Quellen, die noch einmal die Zusammenarbeit von Kron und den Vizekönigen unterstreichen'),
(81, '2007-10-15 13:04:45', '2007-10-15 13:04:45', 1, 1, 0, 'Mathew, Gujarat', 'Mathew, Kuzhippalli Skaria: Portuguese and the Sultanate of Gujarat (1500-1573), Delhi 1986.', 'mathew:gujarat', NULL),
(82, '2007-10-15 15:42:19', '2007-10-15 15:42:19', 1, 1, 0, 'Malekandathil, Portuguese Cochin', 'Malekandathil, Pius: Portuguese Cochin and Maritime Trade of India 1500-1663 (Heidelberg University South Asian Studies, Bd. 39), New Delhi 2001.', 'male:cochin', NULL),
(83, '2008-03-05 09:57:15', '2008-03-05 09:57:15', 1, 1, 0, 'Haebler, Konrad Rott', 'Haebler, Konrad: Konrad Rott und die Thüringische Gesellschaft, in: NASG 16 (1895), S. 177-218.', 'haebler:rott', NULL),
(84, '2008-03-10 10:08:59', '2008-03-10 10:08:59', 1, 1, 0, 'Disney, Smugglers and Smuggling', 'Disney, Anthony: Smugglers and Smuggling in the Western Half of the Estado da India in the Late Sixteenth and Early Seventeenth Centuries, in: Indica 26 (1989), S. 57-75.', 'disney:smugglers', NULL),
(85, '2008-03-12 16:59:13', '2008-03-12 17:06:12', 1, 1, 0, 'Seibold, Manlich', 'Seibold, Gerhard: Die Manlich. Geschichte einer Augsburger Kaufmannsfamilie (Abhandlungen zur Geschichte der Stadt Augsburg, Bd. 35), Sigmaringen 1995.', 'seibold:manlich', NULL),
(86, '2008-05-08 08:21:13', '2008-05-08 08:21:39', 1, 1, 0, 'Michaelsen, German Participation', 'Michaelsen, Stephan: German Participation in the India Fleet in 1505/06, in: Malekandathil, Pius/Mohammed, Jamal: The Portuguese, Indian Ocean and European Bridgeheads 1500-1800. Festschrift in Honour of Prof. K.S. Mathew (Institute for Research in Social Sciences and Humanities of Meshar, Bd. 2), Tellicherry 2001, S. 86-98.', 'michaelsen:participation', 'kurze und gute Zusammenfassung des deutschen Außenhandels um 1500'),
(87, '2008-05-26 14:50:32', '2008-05-26 14:50:32', 1, 1, 0, 'Malekandathil, Merchants', 'Malekandathil, Pius: Merchants, Markets and Commodities. Some Aspekts of Portuguese Commerce with Malabar, in: Malekandathil, Pius/Mohammed, Jamal: The Portuguese, Indian Ocean and European Bridgeheads 1500-1800. Festschrift in Honour of Prof. K.S. Mathew (Institute for Research in Social Sciences and Humanities of Meshar, Bd. 2), Tellicherry 2001, S. 241-268.', 'male:merchants', 'Zusammenarbeit von Portugiesen und einheimischen (indischen) Händlern'),
(88, '2008-05-27 13:14:39', '2008-05-27 13:15:16', 1, 1, 0, 'Teles e Cunha, Riches', 'Teles e Cunha, João: Hunting the Riches. Goa''s Gem Trade in the Early Modern Age, in: Malekandathil, Pius/Mohammed, Jamal: The Portuguese, Indian Ocean and European Bridgeheads 1500-1800. Festschrift in Honour of Prof. K.S. Mathew (Institute for Research in Social Sciences and Humanities of Meshar, Bd. 2), Tellicherry 2001, S. 269-304.', 'telesecunha:riches', NULL),
(89, '2008-05-29 11:56:17', '2008-05-29 11:56:17', 1, 1, 0, 'Ehrenberg, Handelsgeschichte', 'Ehrenberg, Richard: Aus der Hamburgischen Handelsgeschichte, in: ZVHG 10 (1899), S. 1-40.', 'ehrenberg:handelsgeschichte', NULL),
(90, '2008-06-24 13:57:43', '2008-06-24 13:57:43', 1, 1, 0, 'Haebler, Gewürzhandel', 'Haebler, Konrad: Die Fugger und der spanische Gewürzhandel, in: ZHVSN 19 (1892), S. 25-44.', 'haebler:gewuerzhandel', NULL),
(91, '2008-06-24 15:09:14', '2008-06-24 15:09:14', 1, 1, 0, 'Denucé, L''Afrique', 'Denucé, Jean: L''Afrique au XVIe Siècle et le Commerce Anversois. Avec réproduction de la Carte Murale de Blaeu-Verbiest de 1644 (Collection de documents pour l''histoire du commerce, Bd. II), Antwerpen 1937.', 'denuce:afrique', NULL),
(92, '2008-07-16 11:43:24', '2008-07-16 11:43:24', 1, 1, 0, 'Subrahmanyam, Stozzi', 'Subrahmanyam, Sanjay: "Um Bom Homem de Tratar". Piero Strozzi, a Florentine in Portuguese Asia, 1510-1522, in: Journal of European Economic History 16 (1987), S. 511-526.', 'subrahmanyam:strozzi', NULL),
(93, '2008-07-18 14:07:24', '2008-07-18 14:07:24', 1, 1, 0, 'Subrahmanyam, Political Economy', 'Subrahmanyam, Sanjay: The Political Economy of Commerce. Southern India 1500-1650, Cambridge 1990.', 'subrahmanyam:politicaleconomy', NULL),
(94, '2008-07-29 14:00:23', '2008-07-29 14:00:23', 1, 1, 0, 'Haebler, Unternehmungen der Welser', 'Haebler, Konrad: Die überseeischen Unternehmungen der Welser und ihrer Gesellschafter, Leipzig 1903.', 'haebler:welser', NULL),
(95, '2008-07-29 15:07:38', '2008-07-29 15:08:12', 1, 1, 0, 'Haebler, Fugger''sche Handlung in Spanien', 'Haebler, Konrad: Die Geschichte der Fugger''schen Handlung in Spanien (Socialpolitische Forschungen. Ergänzungshefte zur Zeitschrift für Social- und Wirthschaftsgeschichte, Bd. 1), Weimar 1897.', 'haebler:handlung', NULL),
(96, '2008-07-30 11:02:05', '2008-07-30 11:02:05', 1, 1, 0, 'Strieder, Notariatsarchive', 'Strieder, Jakob: Aus Antwerpener Notariatsarchiven. Quellen zur deutschen Wirtschaftsgeschichte des 16. Jahrhunderts (Deutsche Handelsakten des Mittelalters und der Neuzeit, Bd. IV), Wiesbaden 1962.', 'strieder:notariatsarchive', NULL),
(97, '2008-07-31 10:22:17', '2008-07-31 10:22:17', 1, 1, 0, 'Harreld, German Merchants', 'Harreld, Donald: German Merchants and their Trade in Sixteenth-Century Antwerp, in: Stabel, Peter, Blondé, Peter, Greve, Anke (Hrsg.): International Trade in the Low Countries (14th - 16th centuries). Merchants, Organisation, Infrastructure. Proceedings of the International Conference Ghent-Antwerp, 12th-13th January 1997 (Studies in urban social, economic and political history of the medieval and early modern Low Countries, Bd. 10), Leuven-Apeldoor 2000.\r\n', 'harreld:merchants', NULL),
(98, '2008-07-31 12:56:00', '2008-07-31 15:20:42', 1, 1, 0, 'Hildebrandt, Wirtschaftsentwicklung und Konzentration', 'Hildebrandt, Reinhard: Wirtschaftsentwicklung und Konzentration im 16. Jahrhundert. Konrad Roth und die Finanzierungsprobleme seines interkontinentalen Handels, in: Scripta Mercaturae 1970/I, S. 25.50.', 'hb:rott', NULL),
(99, '2008-08-12 14:29:28', '2008-08-12 14:29:28', 1, 1, 0, 'Kellenbenz, Cron', 'Kellenbenz, Hermann: Ferdinand Cron, in: Lebensbilder aus dem Bayerischen Schwaben, Bd. 9 (Schwäbische Forschungsgemeinschaft bei der Kommission für bayerische Landesgeschichte, Reihe 3, Bd. 9), München 1966, S. 194-210.', 'kb:kron', NULL),
(100, '2008-08-13 09:10:36', '2008-08-13 09:10:36', 1, 1, 0, 'Kellenbenz, Beziehungen Nürnbergs', 'Kellenbenz, Hermann: Die Beziehungen Nürnbergs zur Iberischen Halbinsel, besonders im 15. und in der ersten Hälfte des 16 Jahrhunderts, in: Beiträge zur Wirtschaftsgeschichte Nürnbergs, Bd. 1 (Beiträge zur Geschichte und Kultur der Stadt Nürnbergs, Bd. 11/I), Nürnberg 1967, S. 456-493.', 'kb:nuernberg', NULL),
(101, '2008-08-13 13:57:47', '2008-08-13 13:57:47', 1, 1, 0, 'Kellenbenz, Briefe', 'Kellenbenz, Hermann: Briefe über Pfeffer und Kupfer, in: Hassinger, Erich/Müller, J. Heinz/Ott, Hugo: Geschichte, Wirtschaft, Gesellschaft. Festschrift für Clemens Bauer zum 75. Geburtstag, Berlin 1974, S. 205-227.', 'kb:briefe', NULL);

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

--
-- Daten für Tabelle `hc_bibliographies_relations`
--

INSERT INTO `hc_bibliographies_relations` (`id`, `relation_id`, `bibliography_id`, `pages`, `deleted`, `created`, `modified`, `creator_id`, `changer_id`) VALUES
(1, 2, 2, '145/84', 0, '2009-07-08 13:20:34', '2009-07-08 13:20:34', 1, 1),
(2, 3, 2, '145', 0, '2009-07-08 13:22:47', '2009-07-08 13:22:47', 1, 1);

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

--
-- Daten für Tabelle `hc_bibliographies_vertices`
--

INSERT INTO `hc_bibliographies_vertices` (`id`, `vertex_id`, `bibliography_id`, `pages`, `deleted`, `created`, `modified`, `creator_id`, `changer_id`) VALUES
(1, 1, 23, '7', 0, '2009-07-08 13:17:36', '2009-07-08 13:17:36', 1, 1),
(2, 1, 24, '318,360', 0, '2009-07-08 13:17:44', '2009-07-08 13:17:54', 1, 1),
(3, 1, 29, '99f', 0, '2009-07-08 13:18:09', '2009-07-08 13:18:09', 1, 1),
(4, 1, 28, '61', 0, '2009-07-08 13:18:18', '2009-07-08 13:18:18', 1, 1),
(5, 4, 2, '', 0, '2009-07-08 13:21:49', '2009-07-08 13:21:49', 1, 1),
(6, 4, 3, '', 0, '2009-07-08 13:21:57', '2009-07-08 13:21:57', 1, 1);

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

--
-- Daten für Tabelle `hc_inferences`
--

INSERT INTO `hc_inferences` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `p1_id`, `p1_dir_from`, `p2_id`, `p2_dir_from`, `p3_id`, `p3_dir_from`, `inference_type_id`) VALUES
(1, '2006-02-22 09:32:24', '2006-02-22 09:32:24', 1, 1, 0, 13, 1, 13, 1, 13, 1, 4),
(2, '2006-02-24 10:57:29', '2006-02-24 10:57:29', 1, 1, 0, 12, 1, 6, 0, 12, 1, 4),
(3, '2006-02-24 11:04:19', '2006-02-24 11:04:19', 1, 1, 0, 6, 1, 12, 0, 12, 0, 4),
(4, '2006-02-24 11:09:35', '2006-02-24 11:09:35', 1, 1, 0, 37, 1, 29, 1, 6, 1, 4),
(5, '2006-02-24 11:14:19', '2006-02-24 11:14:19', 1, 1, 0, 5, 1, 5, 1, 6, 1, 2),
(6, '2006-02-24 11:17:45', '2009-01-02 14:32:44', 1, 1, 0, 18, 1, 2, 0, 2, 0, 1),
(7, '2006-02-24 11:18:50', '2006-02-24 11:18:50', 1, 1, 0, 18, 1, 2, 0, 2, 0, 4),
(8, '2006-02-24 11:21:08', '2006-02-24 11:21:08', 1, 1, 0, 18, 1, 1, 0, 1, 0, 1),
(9, '2006-02-24 11:21:40', '2006-02-24 11:21:40', 1, 1, 0, 18, 1, 1, 0, 1, 0, 4),
(10, '2006-02-24 11:23:39', '2006-02-24 11:23:39', 1, 1, 0, 2, 1, 18, 1, 2, 1, 4),
(11, '2006-02-24 11:24:32', '2006-02-24 11:24:32', 1, 1, 0, 2, 1, 18, 0, 2, 1, 4),
(12, '2006-02-24 11:25:25', '2006-02-24 11:25:25', 1, 1, 0, 1, 1, 18, 1, 1, 1, 4),
(13, '2006-02-24 11:25:31', '2006-02-24 11:25:31', 1, 1, 0, 1, 1, 18, 0, 1, 1, 4),
(14, '2006-02-24 11:27:44', '2006-02-24 11:27:44', 1, 1, 0, 2, 1, 1, 0, 36, 1, 4),
(15, '2006-02-24 11:29:09', '2006-02-24 11:29:09', 1, 1, 0, 1, 1, 2, 0, 36, 0, 4),
(16, '2006-02-24 11:32:46', '2006-02-24 11:33:58', 1, 1, 0, 36, 1, 18, 1, 38, 1, 1),
(17, '2006-02-24 11:32:58', '2006-02-24 11:36:10', 1, 1, 0, 36, 1, 18, 0, 38, 1, 1),
(18, '2006-02-24 11:33:14', '2006-02-24 11:36:16', 1, 1, 0, 36, 1, 18, 1, 38, 1, 4),
(19, '2006-02-24 11:33:21', '2006-02-24 11:36:23', 1, 1, 0, 36, 1, 18, 0, 38, 1, 4),
(20, '2006-02-24 11:47:47', '2006-02-24 11:47:47', 1, 1, 0, 2, 1, 18, 0, 17, 0, 1),
(21, '2006-02-24 11:47:56', '2006-06-08 14:28:11', 1, 1, 0, 2, 1, 18, 1, 17, 0, 1),
(22, '2006-03-03 14:05:41', '2006-03-03 14:06:44', 1, 1, 1, 2, 0, 18, 1, 17, 0, 4),
(23, '2006-03-03 14:09:35', '2006-03-03 14:09:35', 1, 1, 0, 18, 1, 2, 1, 17, 1, 1),
(24, '2006-03-03 14:09:43', '2006-03-03 14:09:43', 1, 1, 0, 18, 1, 2, 1, 17, 1, 4),
(25, '2006-03-03 14:12:56', '2006-03-03 14:12:56', 1, 1, 0, 18, 1, 18, 1, 18, 1, 1),
(26, '2006-03-03 14:13:04', '2006-03-03 14:13:04', 1, 1, 0, 18, 1, 18, 1, 18, 1, 4),
(27, '2006-06-08 11:22:43', '2006-06-08 11:22:43', 1, 1, 0, 36, 1, 2, 1, 1, 1, 1),
(28, '2006-06-08 11:23:33', '2006-06-08 11:23:33', 1, 1, 0, 36, 0, 1, 1, 2, 1, 4),
(29, '2006-06-08 13:45:03', '2006-06-08 13:47:00', 1, 1, 0, 18, 1, 16, 1, 16, 1, 4),
(30, '2006-06-08 13:45:38', '2006-06-08 13:47:11', 1, 1, 0, 18, 1, 37, 1, 37, 1, 4),
(31, '2006-06-08 14:10:13', '2006-06-08 14:12:38', 1, 1, 0, 1, 1, 36, 0, 2, 0, 1),
(32, '2006-06-08 14:15:02', '2006-06-08 14:15:02', 1, 1, 0, 1, 1, 18, 1, 17, 0, 1),
(33, '2006-06-08 14:15:44', '2006-06-08 14:15:44', 1, 1, 0, 1, 1, 18, 0, 17, 0, 1),
(34, '2006-06-08 14:18:08', '2006-06-08 14:18:08', 1, 1, 0, 2, 1, 36, 1, 1, 0, 1),
(35, '2006-06-08 14:22:44', '2006-06-08 14:22:44', 1, 1, 0, 18, 1, 17, 0, 17, 0, 1),
(36, '2006-06-08 17:57:40', '2006-06-08 17:57:40', 1, 1, 0, 2, 1, 16, 1, 16, 1, 1),
(37, '2006-06-08 17:58:48', '2006-06-08 17:58:48', 1, 1, 0, 1, 1, 16, 1, 16, 1, 1),
(38, '2006-06-08 17:59:14', '2006-06-08 17:59:14', 1, 1, 0, 2, 1, 37, 1, 37, 1, 1),
(39, '2006-06-08 17:59:31', '2006-06-08 17:59:31', 1, 1, 0, 1, 1, 37, 1, 37, 1, 1),
(40, '2006-06-08 18:08:06', '2006-06-08 18:11:22', 1, 1, 0, 18, 1, 36, 1, 38, 1, 4),
(41, '2006-06-08 18:09:47', '2006-06-08 18:11:31', 1, 1, 0, 18, 1, 36, 0, 38, 1, 4),
(42, '2006-06-08 18:12:02', '2006-06-08 18:12:02', 1, 1, 0, 18, 1, 36, 1, 38, 1, 1),
(43, '2006-06-08 18:12:19', '2006-06-08 18:12:19', 1, 1, 0, 18, 1, 36, 0, 38, 1, 1),
(44, '2006-06-08 18:52:10', '2006-06-08 18:52:10', 1, 1, 0, 2, 1, 2, 1, 18, 1, 1),
(45, '2006-06-08 18:52:16', '2006-06-08 18:52:37', 1, 1, 0, 1, 1, 1, 1, 18, 1, 1),
(46, '2006-06-12 16:46:36', '2006-06-12 16:46:36', 1, 1, 0, 18, 1, 16, 1, 16, 1, 1),
(47, '2006-06-12 16:47:35', '2006-06-12 16:47:35', 1, 1, 0, 18, 1, 37, 1, 37, 1, 1),
(48, '2006-06-20 10:28:08', '2006-06-20 10:28:08', 1, 1, 0, 36, 1, 2, 0, 3, 0, 1),
(49, '2006-06-20 10:28:19', '2006-06-20 10:28:19', 1, 1, 0, 36, 1, 1, 0, 3, 0, 1),
(50, '2006-06-20 10:28:45', '2006-06-20 10:28:45', 1, 1, 0, 36, 0, 2, 0, 3, 0, 4),
(51, '2006-06-20 10:28:50', '2006-06-20 10:28:50', 1, 1, 0, 36, 0, 1, 0, 3, 0, 4),
(52, '2006-12-12 11:56:56', '2006-12-12 11:56:56', 1, 1, 0, 18, 1, 6, 1, 6, 1, 1),
(53, '2006-12-12 11:58:01', '2006-12-12 11:58:01', 1, 1, 0, 18, 1, 6, 1, 6, 1, 4),
(54, '2006-12-12 12:04:23', '2007-01-25 14:58:29', 1, 1, 0, 16, 1, 2, 1, 16, 0, 1),
(55, '2006-12-12 12:04:54', '2007-01-25 14:58:23', 1, 1, 0, 16, 1, 1, 1, 16, 0, 1),
(56, '2006-12-12 12:05:09', '2007-01-25 14:54:02', 1, 1, 0, 16, 1, 18, 1, 16, 0, 1),
(57, '2006-12-12 12:05:38', '2007-01-25 14:58:17', 1, 1, 0, 16, 1, 17, 1, 16, 0, 1),
(58, '2006-12-12 12:06:25', '2006-12-12 12:06:25', 1, 1, 0, 6, 1, 2, 1, 6, 1, 1),
(59, '2006-12-12 12:06:39', '2006-12-12 12:06:39', 1, 1, 0, 6, 1, 1, 1, 6, 1, 1),
(60, '2006-12-12 12:06:58', '2006-12-12 12:06:58', 1, 1, 0, 6, 1, 18, 1, 6, 1, 1),
(61, '2006-12-12 12:07:09', '2006-12-12 12:07:09', 1, 1, 0, 6, 1, 17, 1, 6, 1, 1),
(62, '2006-12-12 12:07:26', '2006-12-12 12:07:26', 1, 1, 0, 6, 1, 42, 1, 6, 1, 1),
(63, '2006-12-12 12:07:42', '2007-01-25 14:58:06', 1, 1, 0, 16, 1, 42, 1, 16, 0, 1),
(64, '2006-12-14 13:11:45', '2006-12-14 13:13:48', 1, 1, 0, 2, 1, 12, 0, 12, 0, 1),
(65, '2006-12-14 13:12:29', '2006-12-14 13:13:59', 1, 1, 0, 2, 1, 12, 0, 12, 0, 4),
(66, '2006-12-14 13:14:47', '2006-12-14 13:14:47', 1, 1, 0, 1, 1, 12, 0, 12, 0, 1),
(67, '2006-12-14 13:15:38', '2006-12-14 13:15:38', 1, 1, 0, 1, 1, 12, 0, 12, 0, 4),
(68, '2006-12-14 13:16:57', '2006-12-14 13:16:57', 1, 1, 0, 12, 1, 2, 1, 12, 1, 4),
(69, '2006-12-14 13:18:42', '2006-12-14 13:18:42', 1, 1, 0, 12, 1, 2, 0, 12, 1, 4),
(70, '2006-12-14 13:19:28', '2006-12-14 13:19:28', 1, 1, 0, 12, 1, 1, 1, 12, 1, 4),
(71, '2006-12-14 13:19:49', '2006-12-14 13:19:49', 1, 1, 0, 12, 1, 1, 0, 12, 1, 4),
(72, '2006-12-14 13:20:33', '2006-12-14 13:20:33', 1, 1, 0, 12, 1, 18, 1, 12, 1, 4),
(73, '2006-12-14 13:20:58', '2006-12-14 13:20:58', 1, 1, 0, 12, 1, 18, 0, 12, 1, 4),
(74, '2006-12-19 15:31:37', '2006-12-19 15:31:37', 1, 1, 0, 2, 1, 6, 1, 6, 1, 1),
(75, '2006-12-19 15:32:17', '2006-12-19 15:32:17', 1, 1, 0, 1, 1, 6, 1, 6, 1, 1),
(76, '2007-01-03 16:07:42', '2007-01-03 16:07:42', 1, 1, 0, 43, 1, 43, 1, 43, 1, 1),
(77, '2007-01-03 16:08:15', '2007-01-03 16:08:15', 1, 1, 0, 43, 1, 43, 1, 43, 1, 4),
(78, '2007-01-03 16:11:09', '2007-01-03 16:11:09', 1, 1, 0, 43, 1, 43, 0, 43, 0, 1),
(79, '2007-01-03 16:11:16', '2007-01-03 16:11:16', 1, 1, 0, 43, 1, 43, 0, 43, 0, 4),
(80, '2007-01-23 16:00:26', '2007-01-23 16:00:26', 1, 1, 0, 2, 1, 6, 1, 6, 1, 4),
(81, '2007-01-23 16:01:07', '2007-01-23 16:01:07', 1, 1, 0, 2, 1, 16, 1, 16, 1, 4),
(82, '2007-01-25 14:52:19', '2007-01-25 14:52:19', 1, 1, 0, 18, 1, 17, 0, 17, 0, 4),
(83, '2007-01-25 14:57:00', '2007-01-25 14:57:14', 1, 1, 0, 16, 1, 18, 0, 16, 0, 1);

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

--
-- Daten für Tabelle `hc_inference_types`
--

INSERT INTO `hc_inference_types` (`id`, `is_xy`, `connects`, `comment`, `img`) VALUES
(1, 1, 'yz', 'A(x,y) ∧ B(x,z) ⇒ C(y,z)', 'xz_yz'),
(2, 1, 'xz', 'A(x,y) ∧ B(x,z) ⇒ C(x,z)', 'xz_xz'),
(3, 1, 'xy', 'A(x,y) ∧ B(x,z) ⇒ C(x,y)', 'xz_xy'),
(4, 0, 'xz', 'A(x,y) ∧ B(y,z) ⇒ C(x,z)', 'yz_xz'),
(5, 0, 'yz', 'A(x,y) ∧ B(y,z) ⇒ C(y,z)', 'yz_yz'),
(6, 0, 'xy', 'A(x,y) ∧ B(y,z) ⇒ C(x,y)', 'yz_xy');

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

--
-- Daten für Tabelle `hc_relations`
--

INSERT INTO `hc_relations` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `start_time_entry`, `stop_time_entry`, `start_time`, `stop_time`, `start_time_ca`, `stop_time_ca`, `start_time_questionable`, `stop_time_questionable`, `start_time_julian`, `stop_time_julian`, `relation_type_id`, `from_vertex_id`, `to_vertex_id`, `comment`, `geo`, `inference_parent_id`) VALUES
(1, '2009-07-08 13:17:11', '2009-07-08 13:17:11', 1, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 13, 1, 2, '', NULL, NULL),
(2, '2009-07-08 13:20:10', '2009-07-08 13:23:40', 1, 1, 0, '1578', '1580', 2297423, 2298518, 0, 0, 0, 0, 0, 0, 29, 3, 1, '[[hb:erben]], 145/84: Fritz leitet Nachrichten weiter aus dieser Stadt.', NULL, NULL),
(3, '2009-07-08 13:22:25', '2009-07-08 13:22:25', 1, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 8, 3, 4, 'als Agent in Köln und Frankfurt', NULL, NULL);

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

--
-- Daten für Tabelle `hc_relation_classes`
--

INSERT INTO `hc_relation_classes` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `title`, `comment`) VALUES
(1, '2005-11-10 23:13:33', '2006-01-02 16:33:18', 1, 1, 0, 'Verwandtschaftsbeziehung', 'Relation drückt eine Verwandtschaft aus'),
(2, '2005-11-10 23:13:33', '2006-01-04 11:21:50', 1, 1, 0, 'Persönliche Beziehung', 'Relation drückt eine persönliche Beziehung zwischen zwei Personen oder Personengruppen aus.'),
(3, '2005-11-15 21:52:13', '2006-01-02 16:33:18', 1, 1, 0, 'Personen-Ort-Beziehung', 'Verknüpft Orte mit Personen und umgekehrt.'),
(4, '2005-11-15 21:58:37', '2008-12-03 20:55:05', 1, 1, 0, 'Attribut', 'Bestimmt ein Objekt näher'),
(5, '2005-11-15 22:00:02', '2006-01-02 16:33:18', 1, 1, 0, 'Besitzverhältnis', 'Drückt ein Besitzverhältnis aus.'),
(6, '2005-11-15 22:00:34', '2006-01-02 16:33:18', 1, 1, 0, 'Ortsbeziehung', 'Bringt zwei Orte miteinander in Beziehung.'),
(7, '2005-11-16 14:45:46', '2006-01-02 16:33:18', 1, 1, 0, 'Ereignisbeziehung', 'Verknüpft Ereignisse mit anderen Objekten'),
(8, '2005-11-21 10:51:43', '2006-01-02 16:33:18', 1, 1, 0, 'Schriftverkehr', 'Bezeichnet Beziehungen, die mit Schriftverkehr usw. zu tun haben.'),
(9, '2006-05-16 09:27:11', '2006-05-16 09:27:25', 1, 1, 0, 'Rollenverknüpfung', 'Verknüpfungen zu Rollen.');

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

--
-- Daten für Tabelle `hc_relation_types`
--

INSERT INTO `hc_relation_types` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `relation_class_id`, `title_from`, `title_to`, `comment`, `vertex_types_from`, `vertex_types_to`, `pictogram_id`, `show_date`, `show_geo`) VALUES
(1, '2005-11-10 23:15:11', '2008-12-30 20:43:12', 1, 1, 0, 1, 'ist Mutter von', 'ist Kind der Mutter', 'Person-von ist Mutter von Person-zu', '1', '1', 102, 1, 0),
(2, '2005-11-10 23:15:11', '2006-06-28 20:57:26', 1, 1, 0, 1, 'ist Vater von', 'ist Kind des Vaters', 'Person_von ist Vater von Person_zu', '1', '1', 101, 1, 0),
(3, '2005-11-10 23:16:37', '2006-12-05 09:52:19', 1, 1, 0, 1, 'Schwiegervater/-mutter von', 'Schwiegersohn/-tochter von', 'verschwägerungsgrad', '1', '1', 137, 1, 0),
(4, '2005-11-10 23:17:17', '2006-11-22 13:56:29', 1, 1, 0, 2, 'verfeindet mit', 'verfeindet mit', 'Personen sind verfeindet', '5,1', '5,1', 120, 1, 0),
(5, '2005-11-15 21:54:03', '2007-06-28 14:04:56', 1, 1, 1, 3, 'wurde geboren in', 'ist Geburtsort von', 'Verknüpft Personen mit einem Geburtsort.', '5,1', '11,9,13,8,12,2', 106, 1, 0),
(6, '2005-11-15 21:55:06', '2006-12-15 15:57:50', 1, 1, 0, 3, 'kommt aus', 'ist Herkunftsort von', 'Verknüpft Personen zu Orten als Bürger, bzw. deren Ursprungsort, etc.', '5,1', '11,2', 36, 1, 0),
(7, '2005-11-15 21:55:52', '2006-06-28 21:05:45', 1, 1, 0, 3, 'hält sich auf in', 'ist Aufenthaltsort von', 'Verknüpft einen Ort mit Personen, die ihn besucht haben.', '5,1,7', '11,9,13,8,12,2', 104, 1, 0),
(8, '2005-11-15 21:57:28', '2006-06-28 21:21:54', 1, 1, 0, 2, 'arbeitet für', 'hat als Angestellten/Agenten', 'Verknüpft Personen in einem Arbeitsverhältnis', '5,1', '5,1', 44, 1, 0),
(9, '2005-11-15 21:59:44', '2006-06-27 18:39:08', 1, 1, 0, 4, 'wird beruflich ausgeübt von', 'hat Beruf', NULL, '6', '5,1', 44, 1, 0),
(10, '2005-11-15 22:01:50', '2008-03-10 10:39:24', 1, 1, 0, 5, 'besitzt', 'in Besitz von', 'Bringt ein allgemeines Besitzverhältnis zum Ausdruck (nur Gegenstände).', '5,1', '16,7', 130, 1, 0),
(11, '2005-11-15 22:02:43', '2006-06-28 21:08:52', 1, 1, 0, 3, 'regiert', 'wird regiert von', 'Drückt eine Herrschaftsstellung aus.', '5,1', '11,9,13,8,12,2', 45, 1, 0),
(12, '2005-11-15 22:04:36', '2006-06-27 18:41:05', 1, 1, 0, 4, 'besitzt als religiösen/konfessionellen Anhänger', 'hat Religion/Konfession', 'Drückt ein religiöses/konfessionelles Verhältnis aus.', '4', '11,5,9,8,1,2', 46, 1, 0),
(13, '2005-11-16 10:51:15', '2006-06-28 21:07:15', 1, 1, 0, 6, 'liegt geographisch in', 'umfasst geographisch', 'Geographische Zuordnung von Orten: von (das kleinere) liegt in nach (das größere)', '11,16,9,13,8,12,2', '11,9,13,8,12,2', 104, 1, 0),
(14, '2005-11-16 10:51:36', '2006-06-28 21:08:11', 1, 1, 0, 6, 'gehört politisch zu', 'umfasst politisch', 'Politische Zuordnung von Orten: von (das kleinere) liegt in nach (das größere)', '11,9,13,8,12,2', '11,9,13,8,12,2', 52, 1, 0),
(15, '2005-11-16 11:25:00', '2006-06-28 21:11:04', 1, 1, 0, 3, 'ist gestorben in', 'ist der Sterbeort von', 'Gibt den Sterbeort einer Person an.', '5,1', '11,9,13,8,12,2', 105, 1, 0),
(16, '2005-11-16 11:27:11', '2006-06-27 18:40:51', 1, 1, 0, 4, 'besitzt Nationalität', 'ist die Nationalität von', 'Verbindet eine Nationalität mit einer Person oder Gruppe', '5,1', '14', 51, 1, 0),
(17, '2005-11-16 13:22:12', '2006-12-05 09:50:22', 1, 1, 0, 1, 'ist Onkel/Tante von', 'ist Neffe/Nichte von', 'Verknüpft zwei Personen in einer Onkel/Neffe-Beziehung', '1', '1', 136, 1, 0),
(18, '2005-11-16 13:24:14', '2006-06-28 21:01:48', 1, 1, 0, 1, 'ist Bruder/Schwester von', 'ist Bruder/Schwester von', NULL, '1', '1', 103, 1, 0),
(19, '2005-11-16 13:41:13', '2006-12-15 13:16:32', 1, 1, 0, 4, 'leitet Firma/Unternehmen', 'wird geleitet von', '"Regierer" einer Firma', '1', '3,24,5', 109, 1, 0),
(20, '2005-11-16 14:47:19', '2006-12-15 13:17:09', 1, 1, 0, 7, 'bezieht sich auf', 'steht in Beziehung mit', 'Ein Ereignis kann auf beliebige andere Objekte wirken...', '3,24', '', 123, 1, 0),
(21, '2005-11-16 16:32:30', '2006-12-15 13:16:54', 1, 1, 0, 5, 'ist beteiligt an', 'hat als Teilhaber', NULL, '5,1', '3,24,5,7', 108, 1, 0),
(22, '2005-11-16 16:46:18', '2006-06-28 21:37:01', 1, 1, 0, 4, 'trägt den Titel', 'wird getragen von', 'Verknüpft Personen und Titel.', '1', '15', 110, 1, 0),
(23, '2005-11-16 16:49:20', '2006-06-28 21:26:21', 1, 1, 0, 2, 'in geschäftlichem Kontakt mit', 'in geschäftlichem Kontakt mit', 'Zwei Personen oder Firmen stehen in Geschäftskontakt miteinander.', '5,19,1', '5,19,1', 107, 1, 0),
(24, '2005-11-17 09:52:16', '2006-11-22 13:48:00', 1, 1, 0, 7, 'gekapert von', 'kapert', 'Schiffe können von Nationen und anderen Objekten gekapert werden.', '7', '8,1,7', 118, 1, 0),
(25, '2005-11-17 10:21:13', '2006-06-28 21:20:31', 1, 1, 0, 3, 'betreibt eine Faktorei in', 'hat eine Faktorei von', 'Person oder Unternehmen betreibt eine Faktorei oder Handelsniederlassung in einem Ort.', '5,8,1', '11,9,13,8,12,2', 37, 1, 0),
(26, '2005-11-17 10:33:44', '2006-06-27 18:40:37', 1, 1, 0, 4, 'besitzt den Zustand', 'ist ein Zustand von', 'Weißt einen Zustand einem beliebigen Objekt zu.', '', '17', 58, 1, 0),
(27, '2005-11-18 15:13:18', '2006-06-28 21:06:21', 1, 1, 0, 4, 'handelt mit', 'ist Handelsgut von', NULL, '6,11,5,9,13,8,1,12,2', '10', 33, 1, 0),
(28, '2005-11-18 15:15:10', '2006-06-28 21:06:35', 1, 1, 0, 4, 'produziert', 'wird produziert in', 'Eine Verknüpfung zwischen einem Produktionsort und einer Ware.', '6,11,5,16,9,13,8,1,12,2', '10', 44, 1, 0),
(29, '2005-11-18 15:25:29', '2009-01-05 12:43:44', 1, 1, 0, 7, 'ist allgemein verknüpft mit', 'ist allgemein verknüpft mit', 'Allgemeine und nicht näher definierte Beziehung zwischen zwei Objekten.', '', '', 125, 1, 0),
(30, '2005-11-18 15:45:18', '2006-11-22 13:48:37', 1, 1, 0, 7, 'sinkt in/vor', 'ist vor/in gesunken', 'Schiff sinkt vor Ort.', '7', '11,9,13,8,12,2', 50, 1, 0),
(31, '2005-11-21 10:00:31', '2006-06-28 21:09:14', 1, 1, 0, 3, 'leitet die Gemeinde', 'wird geistlich geleitet von', 'Drückt eine geistliche Leitung aus.', '5,1,4', '11,16,9,13,8,12,2', 46, 1, 0),
(32, '2005-11-21 10:52:39', '2006-12-05 09:09:45', 1, 1, 0, 8, 'wird abgesendet durch', 'ist Absender von', 'Verknüpft einen Absender mit einem Schreiben', '18', '5,1', 124, 1, 0),
(33, '2005-11-21 10:53:05', '2006-12-05 09:09:59', 1, 1, 0, 8, 'wird empfangen von', 'ist Empfänger von', 'Verknüpft einen Empfänger mit einem Schreiben.', '18', '5,1', 124, 1, 0),
(34, '2005-11-21 11:18:53', '2008-12-09 13:43:14', 1, 1, 0, 7, 'benutzt', 'wird benutzt von', 'Benutzung von Gegenständen duch Personen.', '5,1', '10,7,18', 129, 1, 0),
(35, '2005-11-22 09:50:45', '2006-12-05 09:57:05', 1, 1, 0, 1, 'ist Vormund von', 'hat als Vormund', 'Keine direkte Verwandtschaftsbeziehung, doch aus organisatorischen Gründen sinnvoll hier einzugliedern.\r\n[Auch Kurator]', '1', '1', 138, 1, 0),
(36, '2005-11-22 10:29:25', '2006-06-28 20:45:40', 1, 1, 0, 1, 'ist Mann von', 'ist Frau von', NULL, '1', '1', 100, 1, 0),
(37, '2005-11-23 11:45:55', '2006-06-28 21:34:03', 1, 1, 0, 4, 'gehört zu', 'hat als Mitglied', 'Gruppenzugehörigkeit einer Person.', '1', '19', 39, 1, 0),
(38, '2005-11-24 13:47:14', '2006-12-05 09:45:45', 1, 1, 0, 1, 'ist verschwägert mit', 'ist verschwägert mit', 'Eingeheiratete Verwandtschaftsbeziehung\r\n', '1', '1', 133, 1, 0),
(39, '2005-11-25 17:58:44', '2006-12-05 09:28:52', 1, 1, 0, 2, 'ist vorgesetzt', 'ist unterstellt', NULL, '1', '1', 128, 1, 0),
(40, '2006-02-07 16:18:09', '2006-12-05 09:20:07', 1, 1, 0, 2, 'ist Taufpate von', 'hat als Taufpaten', NULL, '1', '1', 126, 1, 0),
(41, '2006-05-16 09:28:14', '2006-06-28 21:21:16', 1, 1, 0, 9, 'hat die Rolle', 'ist Rolle von', 'Verknüpfung zu einer Rolle', '', '21', 43, 1, 0),
(42, '2006-06-08 11:41:58', '2006-12-05 09:48:46', 1, 1, 0, 1, 'ist Cousin/Cousine von', 'ist Cousin/Cousine von', 'Verwandtschaftsgrad', '1', '1', 135, 1, 0),
(43, '2007-01-03 16:02:54', '2007-01-03 16:05:29', 1, 1, 0, 2, 'in Kontakt mit', 'in Kontakt mit', NULL, '19,1', '19,1', 144, 1, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps status updates for external processes.';

--
-- Daten für Tabelle `hc_table_updates`
--

INSERT INTO `hc_table_updates` (`id`, `key`, `status`) VALUES
(1, 'indexer_vertices_updated', 0),
(2, 'indexer_relations_updated', 0);

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

--
-- Daten für Tabelle `hc_tagsets`
--

INSERT INTO `hc_tagsets` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `title`, `group`) VALUES
(1, '2009-07-08 13:24:30', '2009-07-08 13:24:42', 1, 1, 0, 'Fugger', 'Firma'),
(2, '2009-07-08 13:25:03', '2009-07-08 13:25:16', 1, 1, 0, 'Niederlande', 'Ort');

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

--
-- Daten für Tabelle `hc_tagsets_vertices`
--

INSERT INTO `hc_tagsets_vertices` (`id`, `tagset_id`, `vertex_id`) VALUES
(1, 1, 4),
(2, 1, 3),
(3, 2, 2),
(4, 2, 1);

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
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `deleted` (`deleted`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Keeps users';

--
-- Daten für Tabelle `hc_users`
--

INSERT INTO `hc_users` (`id`, `username`, `password`, `created`, `modified`, `lastlogin`, `name`, `deleted`, `group`) VALUES
(1, 'mkalus', 'xxx', '2005-12-22 09:19:18', '2008-12-29 22:29:13', '2009-07-08 13:13:54', 'Maximilian Kalus', 0, 'admin'),
(2, 'user', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2009-06-19 08:46:28', '2009-06-19 08:46:28', NULL, 'Testbenutzer', 0, 'admin');

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

--
-- Daten für Tabelle `hc_vertex_classes`
--

INSERT INTO `hc_vertex_classes` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `title`, `comment`, `sortkey`) VALUES
(1, '2005-11-14 08:48:08', '2006-01-04 10:28:11', 1, 1, 0, 'Menschen', 'Klasse für Menschen oder Gruppen.', 1),
(2, '2005-11-14 08:48:08', '2006-01-02 22:51:13', 1, 1, 0, 'Vorgänge', 'Klasse für geschichtliche Vorgänge und andere nicht greifbare Dinge.', 2),
(3, '2005-11-14 08:48:47', '2006-01-02 22:51:13', 1, 1, 0, 'Gegenstände', 'Klasse für Gegenstände.', 5),
(4, '2005-11-14 08:51:45', '2006-01-02 22:51:13', 1, 1, 0, 'Orte', 'Klassen, Orte zu beschreiben', 2),
(5, '2005-11-14 08:51:45', '2006-01-02 22:57:43', 1, 1, 0, 'Attribute', 'Bestimmen andere Objekte näher.', 10),
(6, '2006-05-16 09:25:59', '2006-05-16 09:26:19', 1, 1, 0, 'rôle', 'Rolle, die ein Objekt im System spielt', 0);

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

--
-- Daten für Tabelle `hc_vertex_types`
--

INSERT INTO `hc_vertex_types` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `vertex_class_id`, `title`, `comment`, `pictogram_id`, `show_date`, `show_geo`) VALUES
(1, '2005-11-10 19:53:37', '2007-04-16 17:00:50', 1, 1, 0, 1, 'Person', 'Eintrag einer Person oder Persönlichkeit. Im Kommentarfeld könnten Lebensdaten oder Hinweise zur Erforschung der Person stehen.', 40, 1, 1),
(2, '2005-11-10 19:53:37', '2007-04-16 17:00:20', 1, 1, 0, 4, 'Stadt', 'Bezeichnet eine konkrete Stadt. Genauere Daten können im Kommentarfeld abgegeben werden.', 48, 1, 1),
(8, '2005-11-15 13:54:24', '2007-04-16 17:00:31', 1, 1, 0, 4, 'Land/Reich', 'Bezeichnet ein konkretes Land oder Reich (z.B. Portugal) - also eine politisch/geographische Einheit.', 53, 1, 1),
(3, '2005-11-10 20:04:30', '2007-04-16 17:00:37', 1, 1, 0, 2, 'Ereignis', 'Legt ein generisches Ereignis fest. Genaueres kann in der Beschreibung nachgelesen werden.', 30, 1, 1),
(4, '2005-11-10 20:04:30', '2006-06-27 16:36:56', 1, 1, 0, 5, 'Religion/Konfession', 'Legt eine Religion oder Konfession fest.', 46, 1, 0),
(5, '2005-11-10 20:06:42', '2007-04-16 17:00:46', 1, 1, 0, 1, 'Firma/Konsortium', 'Bezeichnet eine Firma oder ein Untenehmen. Im Kommentarfeld könnten Informationen zur Firma und Forschungsnotizen stehen.\r\n\r\nEs bezeichnet auch Konsortien oder Syndikate.', 41, 1, 1),
(6, '2005-11-10 20:06:42', '2006-06-27 14:39:08', 1, 1, 0, 5, 'Beruf', 'Beschreibt einen Beruf, den eine Person ausüben kann.', 44, 1, 0),
(7, '2005-11-10 20:07:58', '2006-06-27 11:09:06', 1, 1, 0, 3, 'Schiff', 'Beschreibt ein Schiff', 32, 1, 0),
(9, '2005-11-15 14:08:43', '2007-04-16 17:01:10', 1, 1, 0, 4, 'Großregion', 'Bezeichnet eine größere Region (z.B. Indien, Südeuropa, o.ä.), also einen Subkontinent, Kontinent, o.ä.', 42, 1, 1),
(10, '2005-11-15 14:13:38', '2007-01-02 17:19:21', 1, 1, 0, 3, 'Handelsgut', 'Bezeichnet ein bestimmtes Handelsgut.\r\n\r\n[[linschoten:2]]: andere: Amber, bernsteinartige Steine (verschiedene Farben)?, Duftstoffe (Almiscar/Mosseliat, Algalia/Civet), Myrrhe, Mannan, Rhubarbe (offenbar tatsächlich Rabarber), Sandelholz, China-Stechwinde (China root, Smilax China), Opium/Amfion, Bango/Haschisch, Tamariono, Mirabolanes/Myrobalanus, Perlen, Diamanten, sonstige Edelsteine, Bezearsteine, und viele mehr.', 33, 1, 0),
(11, '2005-11-15 14:14:25', '2007-04-16 17:01:53', 1, 1, 0, 4, 'Dorf/Markt/Weiler', 'Bezeichnet ein bestimmtes Dorf, einen Weiler oder Marktflecken.', 49, 1, 1),
(12, '2005-11-16 09:57:29', '2007-04-16 17:01:53', 1, 1, 0, 4, 'Region', 'Eine geographische Region, die politisch durchaus heterogen sein kann.', 56, 1, 1),
(13, '2005-11-16 10:46:07', '2007-04-16 17:01:53', 1, 1, 0, 4, 'Insel(-gruppe)', 'Bezeichnet eine einzelne Insel oder Inselgruppe.', 54, 1, 1),
(14, '2005-11-16 11:25:36', '2007-04-16 17:01:53', 1, 1, 0, 5, 'Nationalität', 'Bezeichnet die Nationalität einer Person oder Gruppe.', 51, 1, 1),
(15, '2005-11-16 16:45:28', '2006-06-27 15:40:34', 1, 1, 0, 5, 'Titel', 'Adels- oder sonstiger Titel', 45, 1, 0),
(16, '2005-11-17 10:15:50', '2007-04-16 17:01:53', 1, 1, 0, 3, 'Gebäude', 'Ein Haus, eine Unterkunft, eine spezielle Faktorei, etc.', 36, 1, 1),
(17, '2005-11-17 10:32:47', '2006-06-27 18:32:03', 1, 1, 0, 5, 'Zustand', 'Bezeichnet den Zustand eines Objekts.', 58, 1, 0),
(18, '2005-11-21 10:50:44', '2006-06-27 11:55:42', 1, 1, 0, 3, 'Schriftstück', 'Objekttyp für Schriftstücke, Briefe, Schreben, Urkunden, etc.', 34, 1, 0),
(19, '2005-11-23 11:44:44', '2006-06-27 13:38:58', 1, 1, 0, 5, 'Gesellschaftliche Gruppe', 'Gruppenzugehörigkeit z.B. zu einer Gilde, Zunft oder politischen Gruppe.', 38, 1, 0),
(20, '2005-11-24 11:33:21', '2006-01-02 22:51:03', 1, 1, 1, 1, 'Gruppe', 'Bezeichnet eine informelle Gruppe Menschen.', 0, 1, 0),
(21, '2006-05-16 09:29:53', '2007-04-17 11:59:45', 1, 1, 0, 6, 'allgemeine Rolle', 'allgemeine Rolle', 43, 1, 0),
(22, '2006-06-15 17:44:18', '2006-06-27 18:14:58', 1, 1, 0, 3, 'Vertrag', 'Vertragliche Regelungen aller Art', 52, 1, 0),
(23, '2006-12-13 15:46:32', '2006-12-13 15:46:53', 1, 1, 1, 5, 'Jude', 'Mensch jüdischen Glaubens (auch: Juden, jüdisch)', 71, 1, 0),
(24, '2006-12-15 13:13:33', '2007-04-16 17:01:53', 1, 1, 0, 2, 'Fahrt', 'Fahrt mit Schiffen...', 32, 1, 1);

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

--
-- Daten für Tabelle `hc_vertices`
--

INSERT INTO `hc_vertices` (`id`, `created`, `modified`, `creator_id`, `changer_id`, `deleted`, `start_time_entry`, `stop_time_entry`, `start_time`, `stop_time`, `start_time_ca`, `stop_time_ca`, `start_time_questionable`, `stop_time_questionable`, `start_time_julian`, `stop_time_julian`, `title`, `vertex_type_id`, `comment`, `geo`, `pictogram_id`) VALUES
(1, '2009-07-08 13:15:17', '2009-07-08 13:16:28', 1, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'Antwerpen', 2, 'auch: Antorf, Antdorff, Antorff, usw.\r\n\r\nStadt in den Niederlanden\r\n\r\nHier ist auch der Hauptabsatzmarkt für Pfeffer. Deshalb richten die Portugiesen auch hier die "feitoria Portugesa da Flandres" ein. => diese ist wird aber 1549 geschlossen, da die Portugiesen nicht mit den flämischen, deutschen und italienischen Händlern mithalten können, so zumindest [[boxer:empire]], 61.\r\n\r\nbis 1570: Hauptzentrum für Finanzgeschäfte, danach Genua;\r\n1531: neues Börsengebäude, daneben befinden sich die Häuser der Genuesen, Venezianer und Florentiener\r\n\r\n[[ehrenberg:zf2]], 7: Wichtige Antwerpener Güter = ostindische Waren, englische Tuche und ungarisches Kupfer (MK => deshalb auch die Oberdeutschen daran beteiligt).\r\n\r\n[[gramulla:koelnerkaufleute]], 318: "Im Zuge der Bemühungen, das italienische Gewürzmonopol zu brechen, organisierte Portugal den Gewürzhandel als königliches Monopol und errichtete im Jahre 1508 die Feitoria de Flandres als Antwerpener Niederlassung der Casa da India in Lissabon."\r\n\r\n[[gramulla:koelnerkaufleute]], 360: ab 1501 ca. 8000 qtl. Pfeffer jährlich (nach van der Wee, Growth of the Antwerp Market, Bd. II, S. 127).\r\n\r\n[[newitt:history]], 99f : Faktorei der Portugiesen in Antwerpen ab 1515; [100:] "In Antwerp the profits of the pepper monopoly were going to the German, Felmish and Italian bankers and contractors;" [130:] Die Faktorei wird 1549 geschlossen, da sie sich nicht mehr lohnt.', '4.41670 51.21747', 7),
(2, '2009-07-08 13:15:54', '2009-07-08 13:16:17', 1, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'Niederlande/Holland', 12, 'Region in Europa\r\n\r\nFür die hier vorliegende Untersuchung sind Flandern, die Niederlande und Holland in eine geographische Region zusammengefasst.', NULL, 10),
(3, '2009-07-08 13:19:23', '2009-07-08 13:19:23', 1, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 'Fritz, Hans', 1, 'Agent der Fuggerischen Erben, evt. auch für "Gemeinen Handel" tätig in Köln.\r\n\r\nebenso Faktor der Welser in Seeland\r\n\r\n[[hb:erben]], 145: Hans fritz leitete auch die Nachrichten weiter, die aus Antwerpen, England und Middelburg kamen. -> FA 2.1.21b\r\n\r\n-> FA 206,9/237,6/1,2,77ff', NULL, 0),
(4, '2009-07-08 13:21:42', '2009-07-08 13:21:42', 1, 1, 0, '1578', '1605', 2297423, 2307639, 1, 0, 0, 1, 0, 0, 'Georg Fuggerische Erben', 5, 'Teilfirma der Fugger -> Philipp Eduard & Octavian Secundus Fugger der Raymundischen Linie leiten sie\r\n\r\n- fehlende Gründungsurkunde [Hildebrandt, S. 80]\r\n-> genaues Gründungsdatum nicht bekannt, etwa 1578 [H. 11] oder 1580 [Dobel, 125]\r\n-> Rechtsform nicht bekannt [H, S. 80]\r\n- Frage, ob die Erben überhaupt eine offizielle Gesellschaft waren ist durchaus berechtigt [H, S. 80]\r\n\r\n[[dobel:pfefferhandel]]: erst ab 1580 (aber keine Begründung)\r\n\r\n[[hb:erben]], 69f: Voraussetzungen: 1578 Auslösung aus dem Gemeinen Handel => 756009 fl. 22 kr. 1 h., Gesamtvermögen der Brüder = zum 31.12.1578: 1 159 647 fl. 6 kr. 6h., wobei Grundbesitz von 165 955 fl. 30 kr. dabei war und später uneinbringliche "Rentmeisterbriefe" = 98 976 fl. 31 kr. 2h.\r\n[[hb:erben]], 70: Weitere Erbsachen: Erbe von Christoph I. 1579 -> großes Privatvermögen an die Brüder, v.a. Depositen in der "Spanischen Handlung" von über 1 Mio fl. [71:] Ulrich III. stirbt 1584 und hinterlässt den Brüdern etwa 74000 fl.\r\n\r\n[[hb:erben]], 77: 4/5 der Gesamtforderungen an die Stammfirma, da Anton II. ja ausbezalt wird\r\n\r\n[[hb:erben]], 81: Rechtsform der Firma unklar, Erbengemeinschaft; [82] unbeschränkte Solidarhaftung, [82f] allerdings wird Firmen- und Privatkapital getrennt.\r\n\r\n[[hb:erben]], 99: nur insgesamt etwa 15 Diener in der rund 20-jährigen Geschäftszeit; [100:] dafür abe 16 Diener, die z.T. kontinuierlich für die Firma arbeiteten\r\n\r\n[[hb:erben]], 169f: Investitionen im Asien- und Europa-Handel waren schlussendlich ohne Verluste durchzuführen. Bruttogewinn durch Europakontrakt war bestenfalls 5% (Rendite -> allerdings ist das ein gewisses Quellenproblem, wahrscheinlich war die Renite höher), so dass andere Investitionen sicherlich besser waren (7% bei Juros und Censos), aber immerhin. Beim Asien-Kontrakt ist es nicht so klar, wie groß der Gewinn tatächlich war... -> zumindest beschreibt Hildebrandt das nicht so explizit.\r\n\r\n[[kb:hamburg]], 160: Fugger unterhalten eigene Diener in Lissabon (Hartlieb & Eberlein), ansonsten bedienten sie sich aber der Welserschen Leute, wie z.B. in Hamburg und Lübeck.', NULL, 66);
