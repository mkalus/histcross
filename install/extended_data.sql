-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. Juli 2009 um 21:21
-- Server Version: 5.0.51
-- PHP-Version: 5.2.4-2ubuntu5.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `histcross2`
--

--
-- Daten für Tabelle `hc_inferences`
--

INSERT INTO `hc_inferences` (`id`, `created`, `modified`, `creator_id`, 
`changer_id`, `deleted`, `p1_id`, `p1_dir_from`, `p2_id`, `p2_dir_from`, 
`p3_id`, `p3_dir_from`, `inference_type_id`) VALUES
(1, '2006-02-22 09:32:24', '2006-02-22 09:32:24', 1, 1, 0, 13, 1, 13, 1, 
13, 1, 4),
(2, '2006-02-24 10:57:29', '2006-02-24 10:57:29', 1, 1, 0, 12, 1, 6, 0, 
12, 1, 4),
(3, '2006-02-24 11:04:19', '2006-02-24 11:04:19', 1, 1, 0, 6, 1, 12, 0, 
12, 0, 4),
(4, '2006-02-24 11:09:35', '2006-02-24 11:09:35', 1, 1, 0, 37, 1, 29, 1, 
6, 1, 4),
(5, '2006-02-24 11:14:19', '2006-02-24 11:14:19', 1, 1, 0, 5, 1, 5, 1, 
6, 1, 2),
(6, '2006-02-24 11:17:45', '2009-01-02 14:32:44', 1, 1, 0, 18, 1, 2, 0, 
2, 0, 1),
(7, '2006-02-24 11:18:50', '2006-02-24 11:18:50', 1, 1, 0, 18, 1, 2, 0, 
2, 0, 4),
(8, '2006-02-24 11:21:08', '2006-02-24 11:21:08', 1, 1, 0, 18, 1, 1, 0, 
1, 0, 1),
(9, '2006-02-24 11:21:40', '2006-02-24 11:21:40', 1, 1, 0, 18, 1, 1, 0, 
1, 0, 4),
(10, '2006-02-24 11:23:39', '2006-02-24 11:23:39', 1, 1, 0, 2, 1, 18, 1, 
2, 1, 4),
(11, '2006-02-24 11:24:32', '2006-02-24 11:24:32', 1, 1, 0, 2, 1, 18, 0, 
2, 1, 4),
(12, '2006-02-24 11:25:25', '2006-02-24 11:25:25', 1, 1, 0, 1, 1, 18, 1, 
1, 1, 4),
(13, '2006-02-24 11:25:31', '2006-02-24 11:25:31', 1, 1, 0, 1, 1, 18, 0, 
1, 1, 4),
(14, '2006-02-24 11:27:44', '2006-02-24 11:27:44', 1, 1, 0, 2, 1, 1, 0, 
36, 1, 4),
(15, '2006-02-24 11:29:09', '2006-02-24 11:29:09', 1, 1, 0, 1, 1, 2, 0, 
36, 0, 4),
(16, '2006-02-24 11:32:46', '2006-02-24 11:33:58', 1, 1, 0, 36, 1, 18, 
1, 38, 1, 1),
(17, '2006-02-24 11:32:58', '2006-02-24 11:36:10', 1, 1, 0, 36, 1, 18, 
0, 38, 1, 1),
(18, '2006-02-24 11:33:14', '2006-02-24 11:36:16', 1, 1, 0, 36, 1, 18, 
1, 38, 1, 4),
(19, '2006-02-24 11:33:21', '2006-02-24 11:36:23', 1, 1, 0, 36, 1, 18, 
0, 38, 1, 4),
(20, '2006-02-24 11:47:47', '2006-02-24 11:47:47', 1, 1, 0, 2, 1, 18, 0, 
17, 0, 1),
(21, '2006-02-24 11:47:56', '2006-06-08 14:28:11', 1, 1, 0, 2, 1, 18, 1, 
17, 0, 1),
(22, '2006-03-03 14:05:41', '2006-03-03 14:06:44', 1, 1, 1, 2, 0, 18, 1, 
17, 0, 4),
(23, '2006-03-03 14:09:35', '2006-03-03 14:09:35', 1, 1, 0, 18, 1, 2, 1, 
17, 1, 1),
(24, '2006-03-03 14:09:43', '2006-03-03 14:09:43', 1, 1, 0, 18, 1, 2, 1, 
17, 1, 4),
(25, '2006-03-03 14:12:56', '2006-03-03 14:12:56', 1, 1, 0, 18, 1, 18, 
1, 18, 1, 1),
(26, '2006-03-03 14:13:04', '2006-03-03 14:13:04', 1, 1, 0, 18, 1, 18, 
1, 18, 1, 4),
(27, '2006-06-08 11:22:43', '2006-06-08 11:22:43', 1, 1, 0, 36, 1, 2, 1, 
1, 1, 1),
(28, '2006-06-08 11:23:33', '2006-06-08 11:23:33', 1, 1, 0, 36, 0, 1, 1, 
2, 1, 4),
(29, '2006-06-08 13:45:03', '2006-06-08 13:47:00', 1, 1, 0, 18, 1, 16, 
1, 16, 1, 4),
(30, '2006-06-08 13:45:38', '2006-06-08 13:47:11', 1, 1, 0, 18, 1, 37, 
1, 37, 1, 4),
(31, '2006-06-08 14:10:13', '2006-06-08 14:12:38', 1, 1, 0, 1, 1, 36, 0, 
2, 0, 1),
(32, '2006-06-08 14:15:02', '2006-06-08 14:15:02', 1, 1, 0, 1, 1, 18, 1, 
17, 0, 1),
(33, '2006-06-08 14:15:44', '2006-06-08 14:15:44', 1, 1, 0, 1, 1, 18, 0, 
17, 0, 1),
(34, '2006-06-08 14:18:08', '2006-06-08 14:18:08', 1, 1, 0, 2, 1, 36, 1, 
1, 0, 1),
(35, '2006-06-08 14:22:44', '2006-06-08 14:22:44', 1, 1, 0, 18, 1, 17, 
0, 17, 0, 1),
(36, '2006-06-08 17:57:40', '2006-06-08 17:57:40', 1, 1, 0, 2, 1, 16, 1, 
16, 1, 1),
(37, '2006-06-08 17:58:48', '2006-06-08 17:58:48', 1, 1, 0, 1, 1, 16, 1, 
16, 1, 1),
(38, '2006-06-08 17:59:14', '2006-06-08 17:59:14', 1, 1, 0, 2, 1, 37, 1, 
37, 1, 1),
(39, '2006-06-08 17:59:31', '2006-06-08 17:59:31', 1, 1, 0, 1, 1, 37, 1, 
37, 1, 1),
(40, '2006-06-08 18:08:06', '2006-06-08 18:11:22', 1, 1, 0, 18, 1, 36, 
1, 38, 1, 4),
(41, '2006-06-08 18:09:47', '2006-06-08 18:11:31', 1, 1, 0, 18, 1, 36, 
0, 38, 1, 4),
(42, '2006-06-08 18:12:02', '2006-06-08 18:12:02', 1, 1, 0, 18, 1, 36, 
1, 38, 1, 1),
(43, '2006-06-08 18:12:19', '2006-06-08 18:12:19', 1, 1, 0, 18, 1, 36, 
0, 38, 1, 1),
(44, '2006-06-08 18:52:10', '2006-06-08 18:52:10', 1, 1, 0, 2, 1, 2, 1, 
18, 1, 1),
(45, '2006-06-08 18:52:16', '2006-06-08 18:52:37', 1, 1, 0, 1, 1, 1, 1, 
18, 1, 1),
(46, '2006-06-12 16:46:36', '2006-06-12 16:46:36', 1, 1, 0, 18, 1, 16, 
1, 16, 1, 1),
(47, '2006-06-12 16:47:35', '2006-06-12 16:47:35', 1, 1, 0, 18, 1, 37, 
1, 37, 1, 1),
(48, '2006-06-20 10:28:08', '2006-06-20 10:28:08', 1, 1, 0, 36, 1, 2, 0, 
3, 0, 1),
(49, '2006-06-20 10:28:19', '2006-06-20 10:28:19', 1, 1, 0, 36, 1, 1, 0, 
3, 0, 1),
(50, '2006-06-20 10:28:45', '2006-06-20 10:28:45', 1, 1, 0, 36, 0, 2, 0, 
3, 0, 4),
(51, '2006-06-20 10:28:50', '2006-06-20 10:28:50', 1, 1, 0, 36, 0, 1, 0, 
3, 0, 4),
(52, '2006-12-12 11:56:56', '2006-12-12 11:56:56', 1, 1, 0, 18, 1, 6, 1, 
6, 1, 1),
(53, '2006-12-12 11:58:01', '2006-12-12 11:58:01', 1, 1, 0, 18, 1, 6, 1, 
6, 1, 4),
(54, '2006-12-12 12:04:23', '2007-01-25 14:58:29', 1, 1, 0, 16, 1, 2, 1, 
16, 0, 1),
(55, '2006-12-12 12:04:54', '2007-01-25 14:58:23', 1, 1, 0, 16, 1, 1, 1, 
16, 0, 1),
(56, '2006-12-12 12:05:09', '2007-01-25 14:54:02', 1, 1, 0, 16, 1, 18, 
1, 16, 0, 1),
(57, '2006-12-12 12:05:38', '2007-01-25 14:58:17', 1, 1, 0, 16, 1, 17, 
1, 16, 0, 1),
(58, '2006-12-12 12:06:25', '2006-12-12 12:06:25', 1, 1, 0, 6, 1, 2, 1, 
6, 1, 1),
(59, '2006-12-12 12:06:39', '2006-12-12 12:06:39', 1, 1, 0, 6, 1, 1, 1, 
6, 1, 1),
(60, '2006-12-12 12:06:58', '2006-12-12 12:06:58', 1, 1, 0, 6, 1, 18, 1, 
6, 1, 1),
(61, '2006-12-12 12:07:09', '2006-12-12 12:07:09', 1, 1, 0, 6, 1, 17, 1, 
6, 1, 1),
(62, '2006-12-12 12:07:26', '2006-12-12 12:07:26', 1, 1, 0, 6, 1, 42, 1, 
6, 1, 1),
(63, '2006-12-12 12:07:42', '2007-01-25 14:58:06', 1, 1, 0, 16, 1, 42, 
1, 16, 0, 1),
(64, '2006-12-14 13:11:45', '2006-12-14 13:13:48', 1, 1, 0, 2, 1, 12, 0, 
12, 0, 1),
(65, '2006-12-14 13:12:29', '2006-12-14 13:13:59', 1, 1, 0, 2, 1, 12, 0, 
12, 0, 4),
(66, '2006-12-14 13:14:47', '2006-12-14 13:14:47', 1, 1, 0, 1, 1, 12, 0, 
12, 0, 1),
(67, '2006-12-14 13:15:38', '2006-12-14 13:15:38', 1, 1, 0, 1, 1, 12, 0, 
12, 0, 4),
(68, '2006-12-14 13:16:57', '2006-12-14 13:16:57', 1, 1, 0, 12, 1, 2, 1, 
12, 1, 4),
(69, '2006-12-14 13:18:42', '2006-12-14 13:18:42', 1, 1, 0, 12, 1, 2, 0, 
12, 1, 4),
(70, '2006-12-14 13:19:28', '2006-12-14 13:19:28', 1, 1, 0, 12, 1, 1, 1, 
12, 1, 4),
(71, '2006-12-14 13:19:49', '2006-12-14 13:19:49', 1, 1, 0, 12, 1, 1, 0, 
12, 1, 4),
(72, '2006-12-14 13:20:33', '2006-12-14 13:20:33', 1, 1, 0, 12, 1, 18, 
1, 12, 1, 4),
(73, '2006-12-14 13:20:58', '2006-12-14 13:20:58', 1, 1, 0, 12, 1, 18, 
0, 12, 1, 4),
(74, '2006-12-19 15:31:37', '2006-12-19 15:31:37', 1, 1, 0, 2, 1, 6, 1, 
6, 1, 1),
(75, '2006-12-19 15:32:17', '2006-12-19 15:32:17', 1, 1, 0, 1, 1, 6, 1, 
6, 1, 1),
(76, '2007-01-03 16:07:42', '2007-01-03 16:07:42', 1, 1, 0, 43, 1, 43, 
1, 43, 1, 1),
(77, '2007-01-03 16:08:15', '2007-01-03 16:08:15', 1, 1, 0, 43, 1, 43, 
1, 43, 1, 4),
(78, '2007-01-03 16:11:09', '2007-01-03 16:11:09', 1, 1, 0, 43, 1, 43, 
0, 43, 0, 1),
(79, '2007-01-03 16:11:16', '2007-01-03 16:11:16', 1, 1, 0, 43, 1, 43, 
0, 43, 0, 4),
(80, '2007-01-23 16:00:26', '2007-01-23 16:00:26', 1, 1, 0, 2, 1, 6, 1, 
6, 1, 4),
(81, '2007-01-23 16:01:07', '2007-01-23 16:01:07', 1, 1, 0, 2, 1, 16, 1, 
16, 1, 4),
(82, '2007-01-25 14:52:19', '2007-01-25 14:52:19', 1, 1, 0, 18, 1, 17, 
0, 17, 0, 4),
(83, '2007-01-25 14:57:00', '2007-01-25 14:57:14', 1, 1, 0, 16, 1, 18, 
0, 16, 0, 1);

--
-- Daten für Tabelle `hc_relation_classes`
--

INSERT INTO `hc_relation_classes` (`id`, `created`, `modified`, 
`creator_id`, `changer_id`, `deleted`, `title`, `comment`) VALUES
(1, '2005-11-10 23:13:33', '2006-01-02 16:33:18', 1, 1, 0, 
'Verwandtschaftsbeziehung', 'Relation drückt eine Verwandtschaft aus'),
(2, '2005-11-10 23:13:33', '2006-01-04 11:21:50', 1, 1, 0, 'Persönliche 
Beziehung', 'Relation drückt eine persönliche Beziehung zwischen zwei 
Personen oder Personengruppen aus.'),
(3, '2005-11-15 21:52:13', '2006-01-02 16:33:18', 1, 1, 0, 
'Personen-Ort-Beziehung', 'Verknüpft Orte mit Personen und umgekehrt.'),
(4, '2005-11-15 21:58:37', '2008-12-03 20:55:05', 1, 1, 0, 'Attribut', 
'Bestimmt ein Objekt näher'),
(5, '2005-11-15 22:00:02', '2006-01-02 16:33:18', 1, 1, 0, 
'Besitzverhältnis', 'Drückt ein Besitzverhältnis aus.'),
(6, '2005-11-15 22:00:34', '2006-01-02 16:33:18', 1, 1, 0, 
'Ortsbeziehung', 'Bringt zwei Orte miteinander in Beziehung.'),
(7, '2005-11-16 14:45:46', '2006-01-02 16:33:18', 1, 1, 0, 
'Ereignisbeziehung', 'Verknüpft Ereignisse mit anderen Objekten'),
(8, '2005-11-21 10:51:43', '2006-01-02 16:33:18', 1, 1, 0, 
'Schriftverkehr', 'Bezeichnet Beziehungen, die mit Schriftverkehr usw. 
zu tun haben.'),
(9, '2006-05-16 09:27:11', '2006-05-16 09:27:25', 1, 1, 0, 
'Rollenverknüpfung', 'Verknüpfungen zu Rollen.');

--
-- Daten für Tabelle `hc_relation_types`
--

INSERT INTO `hc_relation_types` (`id`, `created`, `modified`, 
`creator_id`, `changer_id`, `deleted`, `relation_class_id`, 
`title_from`, `title_to`, `comment`, `vertex_types_from`, 
`vertex_types_to`, `pictogram_id`, `show_date`, `show_geo`) VALUES
(1, '2005-11-10 23:15:11', '2008-12-30 20:43:12', 1, 1, 0, 1, 'ist 
Mutter von', 'ist Kind der Mutter', 'Person-von ist Mutter von 
Person-zu', '1', '1', 102, 1, 0),
(2, '2005-11-10 23:15:11', '2006-06-28 20:57:26', 1, 1, 0, 1, 'ist Vater 
von', 'ist Kind des Vaters', 'Person_von ist Vater von Person_zu', '1', 
'1', 101, 1, 0),
(3, '2005-11-10 23:16:37', '2006-12-05 09:52:19', 1, 1, 0, 1, 
'Schwiegervater/-mutter von', 'Schwiegersohn/-tochter von', 
'verschwägerungsgrad', '1', '1', 137, 1, 0),
(4, '2005-11-10 23:17:17', '2006-11-22 13:56:29', 1, 1, 0, 2, 
'verfeindet mit', 'verfeindet mit', 'Personen sind verfeindet', '5,1', 
'5,1', 120, 1, 0),
(5, '2005-11-15 21:54:03', '2007-06-28 14:04:56', 1, 1, 1, 3, 'wurde 
geboren in', 'ist Geburtsort von', 'Verknüpft Personen mit einem 
Geburtsort.', '5,1', '11,9,13,8,12,2', 106, 1, 0),
(6, '2005-11-15 21:55:06', '2006-12-15 15:57:50', 1, 1, 0, 3, 'kommt 
aus', 'ist Herkunftsort von', 'Verknüpft Personen zu Orten als Bürger, 
bzw. deren Ursprungsort, etc.', '5,1', '11,2', 36, 1, 0),
(7, '2005-11-15 21:55:52', '2006-06-28 21:05:45', 1, 1, 0, 3, 'hält sich 
auf in', 'ist Aufenthaltsort von', 'Verknüpft einen Ort mit Personen, 
die ihn besucht haben.', '5,1,7', '11,9,13,8,12,2', 104, 1, 0),
(8, '2005-11-15 21:57:28', '2006-06-28 21:21:54', 1, 1, 0, 2, 'arbeitet 
für', 'hat als Angestellten/Agenten', 'Verknüpft Personen in einem 
Arbeitsverhältnis', '5,1', '5,1', 44, 1, 0),
(9, '2005-11-15 21:59:44', '2006-06-27 18:39:08', 1, 1, 0, 4, 'wird 
beruflich ausgeübt von', 'hat Beruf', NULL, '6', '5,1', 44, 1, 0),
(10, '2005-11-15 22:01:50', '2008-03-10 10:39:24', 1, 1, 0, 5, 
'besitzt', 'in Besitz von', 'Bringt ein allgemeines Besitzverhältnis zum 
Ausdruck (nur Gegenstände).', '5,1', '16,7', 130, 1, 0),
(11, '2005-11-15 22:02:43', '2006-06-28 21:08:52', 1, 1, 0, 3, 
'regiert', 'wird regiert von', 'Drückt eine Herrschaftsstellung aus.', 
'5,1', '11,9,13,8,12,2', 45, 1, 0),
(12, '2005-11-15 22:04:36', '2006-06-27 18:41:05', 1, 1, 0, 4, 'besitzt 
als religiösen/konfessionellen Anhänger', 'hat Religion/Konfession', 
'Drückt ein religiöses/konfessionelles Verhältnis aus.', '4', 
'11,5,9,8,1,2', 46, 1, 0),
(13, '2005-11-16 10:51:15', '2006-06-28 21:07:15', 1, 1, 0, 6, 'liegt 
geographisch in', 'umfasst geographisch', 'Geographische Zuordnung von 
Orten: von (das kleinere) liegt in nach (das größere)', 
'11,16,9,13,8,12,2', '11,9,13,8,12,2', 104, 1, 0),
(14, '2005-11-16 10:51:36', '2006-06-28 21:08:11', 1, 1, 0, 6, 'gehört 
politisch zu', 'umfasst politisch', 'Politische Zuordnung von Orten: von 
(das kleinere) liegt in nach (das größere)', '11,9,13,8,12,2', 
'11,9,13,8,12,2', 52, 1, 0),
(15, '2005-11-16 11:25:00', '2006-06-28 21:11:04', 1, 1, 0, 3, 'ist 
gestorben in', 'ist der Sterbeort von', 'Gibt den Sterbeort einer Person 
an.', '5,1', '11,9,13,8,12,2', 105, 1, 0),
(16, '2005-11-16 11:27:11', '2006-06-27 18:40:51', 1, 1, 0, 4, 'besitzt 
Nationalität', 'ist die Nationalität von', 'Verbindet eine Nationalität 
mit einer Person oder Gruppe', '5,1', '14', 51, 1, 0),
(17, '2005-11-16 13:22:12', '2006-12-05 09:50:22', 1, 1, 0, 1, 'ist 
Onkel/Tante von', 'ist Neffe/Nichte von', 'Verknüpft zwei Personen in 
einer Onkel/Neffe-Beziehung', '1', '1', 136, 1, 0),
(18, '2005-11-16 13:24:14', '2006-06-28 21:01:48', 1, 1, 0, 1, 'ist 
Bruder/Schwester von', 'ist Bruder/Schwester von', NULL, '1', '1', 103, 
1, 0),
(19, '2005-11-16 13:41:13', '2006-12-15 13:16:32', 1, 1, 0, 4, 'leitet 
Firma/Unternehmen', 'wird geleitet von', '"Regierer" einer Firma', '1', 
'3,24,5', 109, 1, 0),
(20, '2005-11-16 14:47:19', '2006-12-15 13:17:09', 1, 1, 0, 7, 'bezieht 
sich auf', 'steht in Beziehung mit', 'Ein Ereignis kann auf beliebige 
andere Objekte wirken...', '3,24', '', 123, 1, 0),
(21, '2005-11-16 16:32:30', '2006-12-15 13:16:54', 1, 1, 0, 5, 'ist 
beteiligt an', 'hat als Teilhaber', NULL, '5,1', '3,24,5,7', 108, 1, 0),
(22, '2005-11-16 16:46:18', '2006-06-28 21:37:01', 1, 1, 0, 4, 'trägt 
den Titel', 'wird getragen von', 'Verknüpft Personen und Titel.', '1', 
'15', 110, 1, 0),
(23, '2005-11-16 16:49:20', '2006-06-28 21:26:21', 1, 1, 0, 2, 'in 
geschäftlichem Kontakt mit', 'in geschäftlichem Kontakt mit', 'Zwei 
Personen oder Firmen stehen in Geschäftskontakt miteinander.', '5,19,1', 
'5,19,1', 107, 1, 0),
(24, '2005-11-17 09:52:16', '2006-11-22 13:48:00', 1, 1, 0, 7, 'gekapert 
von', 'kapert', 'Schiffe können von Nationen und anderen Objekten 
gekapert werden.', '7', '8,1,7', 118, 1, 0),
(25, '2005-11-17 10:21:13', '2006-06-28 21:20:31', 1, 1, 0, 3, 'betreibt 
eine Faktorei in', 'hat eine Faktorei von', 'Person oder Unternehmen 
betreibt eine Faktorei oder Handelsniederlassung in einem Ort.', 
'5,8,1', '11,9,13,8,12,2', 37, 1, 0),
(26, '2005-11-17 10:33:44', '2006-06-27 18:40:37', 1, 1, 0, 4, 'besitzt 
den Zustand', 'ist ein Zustand von', 'Weißt einen Zustand einem 
beliebigen Objekt zu.', '', '17', 58, 1, 0),
(27, '2005-11-18 15:13:18', '2006-06-28 21:06:21', 1, 1, 0, 4, 'handelt 
mit', 'ist Handelsgut von', NULL, '6,11,5,9,13,8,1,12,2', '10', 33, 1, 
0),
(28, '2005-11-18 15:15:10', '2006-06-28 21:06:35', 1, 1, 0, 4, 
'produziert', 'wird produziert in', 'Eine Verknüpfung zwischen einem 
Produktionsort und einer Ware.', '6,11,5,16,9,13,8,1,12,2', '10', 44, 1, 
0),
(29, '2005-11-18 15:25:29', '2009-01-05 12:43:44', 1, 1, 0, 7, 'ist 
allgemein verknüpft mit', 'ist allgemein verknüpft mit', 'Allgemeine und 
nicht näher definierte Beziehung zwischen zwei Objekten.', '', '', 125, 
1, 0),
(30, '2005-11-18 15:45:18', '2006-11-22 13:48:37', 1, 1, 0, 7, 'sinkt 
in/vor', 'ist vor/in gesunken', 'Schiff sinkt vor Ort.', '7', 
'11,9,13,8,12,2', 50, 1, 0),
(31, '2005-11-21 10:00:31', '2006-06-28 21:09:14', 1, 1, 0, 3, 'leitet 
die Gemeinde', 'wird geistlich geleitet von', 'Drückt eine geistliche 
Leitung aus.', '5,1,4', '11,16,9,13,8,12,2', 46, 1, 0),
(32, '2005-11-21 10:52:39', '2006-12-05 09:09:45', 1, 1, 0, 8, 'wird 
abgesendet durch', 'ist Absender von', 'Verknüpft einen Absender mit 
einem Schreiben', '18', '5,1', 124, 1, 0),
(33, '2005-11-21 10:53:05', '2006-12-05 09:09:59', 1, 1, 0, 8, 'wird 
empfangen von', 'ist Empfänger von', 'Verknüpft einen Empfänger mit 
einem Schreiben.', '18', '5,1', 124, 1, 0),
(34, '2005-11-21 11:18:53', '2008-12-09 13:43:14', 1, 1, 0, 7, 
'benutzt', 'wird benutzt von', 'Benutzung von Gegenständen duch 
Personen.', '5,1', '10,7,18', 129, 1, 0),
(35, '2005-11-22 09:50:45', '2006-12-05 09:57:05', 1, 1, 0, 1, 'ist 
Vormund von', 'hat als Vormund', 'Keine direkte 
Verwandtschaftsbeziehung, doch aus organisatorischen Gründen sinnvoll 
hier einzugliedern.\r\n[Auch Kurator]', '1', '1', 138, 1, 0),
(36, '2005-11-22 10:29:25', '2006-06-28 20:45:40', 1, 1, 0, 1, 'ist Mann 
von', 'ist Frau von', NULL, '1', '1', 100, 1, 0),
(37, '2005-11-23 11:45:55', '2006-06-28 21:34:03', 1, 1, 0, 4, 'gehört 
zu', 'hat als Mitglied', 'Gruppenzugehörigkeit einer Person.', '1', 
'19', 39, 1, 0),
(38, '2005-11-24 13:47:14', '2006-12-05 09:45:45', 1, 1, 0, 1, 'ist 
verschwägert mit', 'ist verschwägert mit', 'Eingeheiratete 
Verwandtschaftsbeziehung\r\n', '1', '1', 133, 1, 0),
(39, '2005-11-25 17:58:44', '2006-12-05 09:28:52', 1, 1, 0, 2, 'ist 
vorgesetzt', 'ist unterstellt', NULL, '1', '1', 128, 1, 0),
(40, '2006-02-07 16:18:09', '2006-12-05 09:20:07', 1, 1, 0, 2, 'ist 
Taufpate von', 'hat als Taufpaten', NULL, '1', '1', 126, 1, 0),
(41, '2006-05-16 09:28:14', '2006-06-28 21:21:16', 1, 1, 0, 9, 'hat die 
Rolle', 'ist Rolle von', 'Verknüpfung zu einer Rolle', '', '21', 43, 1, 
0),
(42, '2006-06-08 11:41:58', '2006-12-05 09:48:46', 1, 1, 0, 1, 'ist 
Cousin/Cousine von', 'ist Cousin/Cousine von', 'Verwandtschaftsgrad', 
'1', '1', 135, 1, 0),
(43, '2007-01-03 16:02:54', '2007-01-03 16:05:29', 1, 1, 0, 2, 'in 
Kontakt mit', 'in Kontakt mit', NULL, '19,1', '19,1', 144, 1, 0);

--
-- Daten für Tabelle `hc_vertex_classes`
--

INSERT INTO `hc_vertex_classes` (`id`, `created`, `modified`, 
`creator_id`, `changer_id`, `deleted`, `title`, `comment`, `sortkey`) 
VALUES
(1, '2005-11-14 08:48:08', '2006-01-04 10:28:11', 1, 1, 0, 'Menschen', 
'Klasse für Menschen oder Gruppen.', 1),
(2, '2005-11-14 08:48:08', '2006-01-02 22:51:13', 1, 1, 0, 'Vorgänge', 
'Klasse für geschichtliche Vorgänge und andere nicht greifbare Dinge.', 
2),
(3, '2005-11-14 08:48:47', '2006-01-02 22:51:13', 1, 1, 0, 
'Gegenstände', 'Klasse für Gegenstände.', 5),
(4, '2005-11-14 08:51:45', '2006-01-02 22:51:13', 1, 1, 0, 'Orte', 
'Klassen, Orte zu beschreiben', 2),
(5, '2005-11-14 08:51:45', '2006-01-02 22:57:43', 1, 1, 0, 'Attribute', 
'Bestimmen andere Objekte näher.', 10),
(6, '2006-05-16 09:25:59', '2006-05-16 09:26:19', 1, 1, 0, 'rôle', 
'Rolle, die ein Objekt im System spielt', 0);

--
-- Daten für Tabelle `hc_vertex_types`
--

INSERT INTO `hc_vertex_types` (`id`, `created`, `modified`, 
`creator_id`, `changer_id`, `deleted`, `vertex_class_id`, `title`, 
`comment`, `pictogram_id`, `show_date`, `show_geo`) VALUES
(1, '2005-11-10 19:53:37', '2007-04-16 17:00:50', 1, 1, 0, 1, 'Person', 
'Eintrag einer Person oder Persönlichkeit. Im Kommentarfeld könnten 
Lebensdaten oder Hinweise zur Erforschung der Person stehen.', 40, 1, 
1),
(2, '2005-11-10 19:53:37', '2007-04-16 17:00:20', 1, 1, 0, 4, 'Stadt', 
'Bezeichnet eine konkrete Stadt. Genauere Daten können im Kommentarfeld 
abgegeben werden.', 48, 1, 1),
(8, '2005-11-15 13:54:24', '2007-04-16 17:00:31', 1, 1, 0, 4, 
'Land/Reich', 'Bezeichnet ein konkretes Land oder Reich (z.B. Portugal) 
- also eine politisch/geographische Einheit.', 53, 1, 1),
(3, '2005-11-10 20:04:30', '2007-04-16 17:00:37', 1, 1, 0, 2, 
'Ereignis', 'Legt ein generisches Ereignis fest. Genaueres kann in der 
Beschreibung nachgelesen werden.', 30, 1, 1),
(4, '2005-11-10 20:04:30', '2006-06-27 16:36:56', 1, 1, 0, 5, 
'Religion/Konfession', 'Legt eine Religion oder Konfession fest.', 46, 
1, 0),
(5, '2005-11-10 20:06:42', '2007-04-16 17:00:46', 1, 1, 0, 1, 
'Firma/Konsortium', 'Bezeichnet eine Firma oder ein Untenehmen. Im 
Kommentarfeld könnten Informationen zur Firma und Forschungsnotizen 
stehen.\r\n\r\nEs bezeichnet auch Konsortien oder Syndikate.', 41, 1, 
1),
(6, '2005-11-10 20:06:42', '2006-06-27 14:39:08', 1, 1, 0, 5, 'Beruf', 
'Beschreibt einen Beruf, den eine Person ausüben kann.', 44, 1, 0),
(7, '2005-11-10 20:07:58', '2006-06-27 11:09:06', 1, 1, 0, 3, 'Schiff', 
'Beschreibt ein Schiff', 32, 1, 0),
(9, '2005-11-15 14:08:43', '2007-04-16 17:01:10', 1, 1, 0, 4, 
'Großregion', 'Bezeichnet eine größere Region (z.B. Indien, Südeuropa, 
o.ä.), also einen Subkontinent, Kontinent, o.ä.', 42, 1, 1),
(10, '2005-11-15 14:13:38', '2007-01-02 17:19:21', 1, 1, 0, 3, 
'Handelsgut', 'Bezeichnet ein bestimmtes 
Handelsgut.\r\n\r\n[[linschoten:2]]: andere: Amber, bernsteinartige 
Steine (verschiedene Farben)?, Duftstoffe (Almiscar/Mosseliat, 
Algalia/Civet), Myrrhe, Mannan, Rhubarbe (offenbar tatsächlich 
Rabarber), Sandelholz, China-Stechwinde (China root, Smilax China), 
Opium/Amfion, Bango/Haschisch, Tamariono, Mirabolanes/Myrobalanus, 
Perlen, Diamanten, sonstige Edelsteine, Bezearsteine, und viele mehr.', 
33, 1, 0),
(11, '2005-11-15 14:14:25', '2007-04-16 17:01:53', 1, 1, 0, 4, 
'Dorf/Markt/Weiler', 'Bezeichnet ein bestimmtes Dorf, einen Weiler oder 
Marktflecken.', 49, 1, 1),
(12, '2005-11-16 09:57:29', '2007-04-16 17:01:53', 1, 1, 0, 4, 'Region', 
'Eine geographische Region, die politisch durchaus heterogen sein 
kann.', 56, 1, 1),
(13, '2005-11-16 10:46:07', '2007-04-16 17:01:53', 1, 1, 0, 4, 
'Insel(-gruppe)', 'Bezeichnet eine einzelne Insel oder Inselgruppe.', 
54, 1, 1),
(14, '2005-11-16 11:25:36', '2007-04-16 17:01:53', 1, 1, 0, 5, 
'Nationalität', 'Bezeichnet die Nationalität einer Person oder Gruppe.', 
51, 1, 1),
(15, '2005-11-16 16:45:28', '2006-06-27 15:40:34', 1, 1, 0, 5, 'Titel', 
'Adels- oder sonstiger Titel', 45, 1, 0),
(16, '2005-11-17 10:15:50', '2007-04-16 17:01:53', 1, 1, 0, 3, 
'Gebäude', 'Ein Haus, eine Unterkunft, eine spezielle Faktorei, etc.', 
36, 1, 1),
(17, '2005-11-17 10:32:47', '2006-06-27 18:32:03', 1, 1, 0, 5, 
'Zustand', 'Bezeichnet den Zustand eines Objekts.', 58, 1, 0),
(18, '2005-11-21 10:50:44', '2006-06-27 11:55:42', 1, 1, 0, 3, 
'Schriftstück', 'Objekttyp für Schriftstücke, Briefe, Schreben, 
Urkunden, etc.', 34, 1, 0),
(19, '2005-11-23 11:44:44', '2006-06-27 13:38:58', 1, 1, 0, 5, 
'Gesellschaftliche Gruppe', 'Gruppenzugehörigkeit z.B. zu einer Gilde, 
Zunft oder politischen Gruppe.', 38, 1, 0),
(20, '2005-11-24 11:33:21', '2006-01-02 22:51:03', 1, 1, 1, 1, 'Gruppe', 
'Bezeichnet eine informelle Gruppe Menschen.', 0, 1, 0),
(21, '2006-05-16 09:29:53', '2007-04-17 11:59:45', 1, 1, 0, 6, 
'allgemeine Rolle', 'allgemeine Rolle', 43, 1, 0),
(22, '2006-06-15 17:44:18', '2006-06-27 18:14:58', 1, 1, 0, 3, 
'Vertrag', 'Vertragliche Regelungen aller Art', 52, 1, 0),
(23, '2006-12-13 15:46:32', '2006-12-13 15:46:53', 1, 1, 1, 5, 'Jude', 
'Mensch jüdischen Glaubens (auch: Juden, jüdisch)', 71, 1, 0),
(24, '2006-12-15 13:13:33', '2007-04-16 17:01:53', 1, 1, 0, 2, 'Fahrt', 
'Fahrt mit Schiffen...', 32, 1, 1);

