-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 11:54 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `society`
--
CREATE DATABASE IF NOT EXISTS `society` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `society`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$12$81096039005d2f785fe92uoqTDSm2nXDsBCL.d3veRSYdy6FD1s3u'),
(2, 'tiisetsojohnmasemola@yahoo.com', '$2y$12$58969717715d362b01748u9p9j.xlYTC.yfnyTIX2WgF16DIzTjQO'),
(3, 'mogano@gmail.com', '$2y$12$95278411665d484a1fbf1O/hzoAEQPUPMjhJw.ofwpSd9pYavgHWS');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `province_id` int(255) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=422 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `province_id`) VALUES
(3, 'Pretoria', 2),
(4, 'Johannesburg', 2),
(5, 'Midrand', 2),
(6, 'Centurion', 2),
(7, 'Randburg', 2),
(8, 'Soweto', 2),
(9, 'Sandton', 2),
(10, 'Alberton', 2),
(11, 'Akasia', 2),
(12, 'Soshanguve', 2),
(13, 'Boksburg', 2),
(14, 'Katlehong', 2),
(15, 'Brakpan', 2),
(16, 'Kempton Park ', 2),
(17, 'Springs', 2),
(18, 'Krugersdorp', 2),
(19, 'Edenvale', 2),
(20, 'Nigel', 2),
(21, 'Vereeniging', 2),
(22, 'Eikenhof', 2),
(23, 'Walkerville', 2),
(24, 'Evaton', 2),
(25, 'Randburg Aldara Park', 2),
(26, 'Westonaria', 2),
(27, 'Fochville', 2),
(28, 'Randfontein', 2),
(29, 'Wonderboom ', 2),
(30, 'Ga Rankuwa', 2),
(31, 'Umhlanga', 5),
(32, 'Pietermaritzburg', 5),
(33, 'Durban ', 5),
(34, 'Phoenix', 5),
(35, 'Ballito', 5),
(36, 'Westville', 5),
(37, 'Richards Bay', 5),
(38, 'Amanzimtoti', 5),
(39, 'Inanda', 5),
(40, 'Port Nolloth', 5),
(41, 'Douglas', 5),
(42, 'Kuruman ', 7),
(43, 'Kimberley ', 7),
(44, 'Upington ', 7),
(45, 'Springbok', 7),
(46, 'Hopetwon ', 7),
(47, 'Philipstown ', 7),
(48, 'Barkly West', 7),
(49, 'Hotazel ', 7),
(50, 'Calvinia', 7),
(51, 'Jan Kempdorp', 7),
(52, 'Pofadder', 7),
(53, 'Britstown ', 7),
(54, 'Kathu', 7),
(55, 'Hartswater', 7),
(56, 'Postmasburg ', 7),
(57, 'Carnarvon ', 7),
(58, 'Keimoes', 7),
(59, 'Richmond', 7),
(60, 'Kakamas', 7),
(61, 'Hopetown ', 7),
(62, 'Danielskuil', 7),
(63, 'Ritchie', 7),
(64, 'Groblershoop', 7),
(65, 'Marydale', 7),
(66, 'Vioolsdrif', 7),
(67, 'Hanover', 7),
(68, 'Victoria West', 7),
(69, 'Nieuwoudtville', 7),
(70, 'Noupoort', 7),
(71, 'Warrenton ', 7),
(72, 'Loeriesfontein', 7),
(73, 'Garies ', 7),
(74, 'Sutherland', 7),
(75, 'Polokwane', 1),
(76, 'Tzaneen', 1),
(77, 'Bela Bela', 1),
(78, 'Bochum', 1),
(79, 'Burgersfort', 1),
(80, 'Groblersdal', 1),
(81, 'Hoedspruit', 1),
(82, 'Lephalale', 1),
(83, 'Trichardt', 1),
(84, 'Marble Hall', 1),
(85, 'Modimolle', 1),
(86, 'Mokopane ', 1),
(87, 'Mookgopong', 1),
(88, 'Musina ', 1),
(89, 'Mutale', 1),
(90, 'Phalaborwa', 1),
(91, 'Thabazimbi', 1),
(92, 'Thohoyandou', 1),
(93, 'nebo', 1),
(94, 'Alldays', 1),
(95, 'Giyani', 1),
(96, 'Malamulele', 1),
(97, 'Middelburg', 8),
(98, 'Secunda', 8),
(99, 'White River ', 8),
(100, 'Ermelo', 8),
(101, 'Delmas', 8),
(102, 'Dullstroom ', 8),
(103, 'Lydenburg ', 8),
(104, 'Nelspruit', 8),
(105, 'Witbank ', 8),
(106, 'Bushbuckridge', 8),
(107, 'Graskop', 8),
(108, 'Standerton', 8),
(109, 'Carolina', 8),
(110, 'Belfast', 8),
(111, 'Barberton', 8),
(112, 'Kwaggafontein', 8),
(113, 'Kwamhlanga', 8),
(114, 'Siyabuswa', 8),
(115, 'Malelane', 8),
(116, 'Nsikazi', 8),
(117, 'Amersfoort ', 8),
(118, 'Amsterdam', 8),
(119, 'Balfour', 8),
(120, 'Bethal', 8),
(121, 'Hazyview', 8),
(122, 'Hectorspruit', 8),
(123, 'Kriel', 8),
(124, 'Piet Retief', 8),
(125, 'Sabie', 8),
(126, 'Waterval Boven', 8),
(127, 'Bloemfontein', 3),
(128, 'Bethlehem', 3),
(129, 'Brandfort', 3),
(130, 'Frankfort', 3),
(131, 'Hobhouse', 3),
(132, 'Parys', 3),
(133, 'Sasolburg', 3),
(134, 'Virginia ', 3),
(135, 'Welkom', 3),
(136, 'Wepener', 3),
(137, 'Odendaalsrus', 3),
(138, 'Harrismith', 3),
(139, 'Kroonstad', 3),
(140, 'Ficksburg', 3),
(141, 'Heilbron', 3),
(142, 'Fouriesburg ', 3),
(143, 'Hennenman', 3),
(144, 'Fauresmith', 3),
(145, 'Excelsior', 3),
(146, 'Dewetsdorp', 3),
(147, 'Dealesville', 3),
(148, 'Bultfontein', 3),
(149, 'Bothaville', 3),
(150, 'Boshof', 3),
(151, 'Hertzogville', 3),
(152, 'Hoopstad', 3),
(153, 'Jacobsdal', 3),
(154, 'Petrusburg', 3),
(155, 'Philippolis', 3),
(156, 'Phuthaditjhaba', 3),
(157, 'Aberdeen', 4),
(158, 'Adelaide', 4),
(159, 'Alexandria', 4),
(160, 'Alice', 4),
(161, 'Alicedale', 4),
(162, 'Aliwal North', 4),
(163, 'Barkly East', 4),
(164, 'Bathurst', 4),
(165, 'Bedford', 4),
(166, 'Bhisho', 4),
(167, 'Bizana', 4),
(168, 'Boesmansriviermond', 4),
(169, 'Boknesstrand', 4),
(170, 'Burgersdorp', 4),
(171, 'Butterworth', 4),
(172, 'Cala', 4),
(173, 'Cannon Rocks', 4),
(174, 'Cathcart', 4),
(175, 'Cedarville', 4),
(176, 'Cintsa', 4),
(177, 'Comfimvaba', 4),
(178, 'Colchester', 4),
(179, 'Cradock', 4),
(180, 'Cape st francis', 4),
(181, 'cookhouse', 4),
(182, 'Despatch', 4),
(183, 'Dordrecht', 4),
(184, 'Elliot ', 4),
(185, 'Elliotdale', 4),
(186, 'Engcobo', 4),
(187, 'Flagstaff', 4),
(188, 'Fort Beaufort ', 4),
(189, 'Gamtoos Mouth', 4),
(190, 'Graff Reinet ', 4),
(191, 'Graaff Reinet', 4),
(192, 'Haga Haga', 4),
(193, 'Hamburg ', 4),
(194, 'Hankey', 4),
(195, 'Hewu', 4),
(196, 'Hofmeyr', 4),
(197, 'Hogsback', 4),
(198, 'Humansdorp', 4),
(199, 'Idutywa', 4),
(200, 'Indwe', 4),
(201, 'Jamestown', 4),
(202, 'Janseville', 4),
(203, 'Joubertina', 4),
(204, 'Kareedouw', 4),
(205, 'Kaysers Beach', 4),
(206, 'Kei Mouth', 4),
(207, 'Keiskammahoek ', 4),
(208, 'Kenton On Sea', 4),
(209, 'Kirkwood', 4),
(210, 'Kleinemonde', 4),
(211, 'Klipplaat', 4),
(212, 'Komga', 4),
(213, 'Lady Frere', 4),
(214, 'Lady Grey', 4),
(215, 'Libode', 4),
(216, 'Lusikisiki', 4),
(217, 'macleantown ', 4),
(218, 'Maclear', 4),
(219, 'Maluti', 4),
(220, 'Matatiele', 4),
(221, 'Mazeppa Bay', 4),
(222, 'King Williams Town', 4),
(223, 'St Francis Bay', 4),
(224, 'Port Alfred', 4),
(225, 'Grahamstown ', 4),
(226, 'Uitenhage', 4),
(227, 'Jeffreys bay ', 4),
(228, 'East London ', 4),
(229, 'Port Elizabeth', 4),
(230, 'Zwelitsha', 4),
(231, 'Willowvale', 4),
(232, 'Whittlesea', 4),
(233, 'Venterstad', 4),
(234, 'Ugie', 4),
(235, 'Tsomo', 4),
(236, 'Tsolo', 4),
(237, 'Thornhill', 4),
(238, 'Tarkastad', 4),
(239, 'Tabankulu', 4),
(240, 'Stutterheim', 4),
(241, 'Steytlerville', 4),
(242, 'Steynsburg ', 4),
(243, 'Sterkstroom', 4),
(244, 'Sterkspruit', 4),
(245, 'Seymour', 4),
(246, 'Riebeek East', 4),
(247, 'Qumbu', 4),
(248, 'Queenstown', 4),
(249, 'Qolora Mouth', 4),
(250, 'Port St John', 4),
(251, 'Peddie', 4),
(252, 'Pearston', 4),
(253, 'Oyster Bay', 4),
(254, 'Ngqeleni', 4),
(255, 'Mthatha', 4),
(256, 'Paterson', 4),
(257, 'Mount Frere', 4),
(258, 'Mount Fletcher', 4),
(259, 'Mount Ayliff', 4),
(260, 'Morgans Bay', 4),
(261, 'Molteno', 4),
(262, 'Atamelang', 6),
(263, 'Bloemhof', 6),
(264, 'Christiana', 6),
(266, 'Coligny', 6),
(267, 'Delareyville', 6),
(268, 'Ganyesa', 6),
(269, 'Groot Marico', 6),
(270, 'Hartbeesfontein', 6),
(271, 'Itsoseng', 6),
(272, 'Koster', 6),
(273, 'Leeudoringstad', 6),
(274, 'Lichtenburg', 6),
(275, 'Makwassie', 6),
(276, 'Mankwe ', 6),
(277, 'Mogwase', 6),
(278, 'Mooinooi', 6),
(279, 'Orkney', 6),
(280, 'Ottosdal', 6),
(281, 'Reivilo', 6),
(282, 'Schweizer Reneke', 6),
(283, 'Stella', 6),
(284, 'Swartruggens', 6),
(285, 'Taung', 6),
(286, 'Ventersdorp', 6),
(287, 'Wolmaransstad', 6),
(288, 'Zeerust', 6),
(289, 'Rustenburg', 6),
(290, 'Potchefstroom', 6),
(291, 'Klerksdorp', 6),
(292, 'Hartbeespoort', 6),
(293, 'Brits', 6),
(294, 'Stilfontein', 6),
(295, 'Vryburg', 6),
(297, 'Mafikeng', 6),
(298, 'Agulhas', 9),
(299, 'Albertinia', 9),
(300, 'Arniston', 9),
(301, 'Ashton', 9),
(302, 'Atlantis', 9),
(303, 'Aurora', 9),
(304, 'Baardskeerdersbos', 9),
(305, 'Barrydale', 9),
(306, 'Beaufort West', 9),
(307, 'Bettys Bay', 9),
(308, 'Blackheath', 9),
(309, 'Bitterfontein', 9),
(310, 'Blouberg', 9),
(311, 'Blue Downs', 9),
(312, 'Bonnievale', 9),
(313, 'Bot River', 9),
(314, 'Brackenfell', 9),
(315, 'Bredasdorp', 9),
(316, 'Caledon', 9),
(317, 'Calitzdorp', 9),
(318, 'Ceres', 9),
(319, 'Citrusdal', 9),
(320, 'Clanwilliam', 9),
(321, 'Darling', 9),
(322, 'De Doorns', 9),
(323, 'Delft', 9),
(324, 'Eersterivier', 9),
(325, 'Elands Bay', 9),
(326, 'Elsies River', 9),
(327, 'Fish Hoek', 9),
(328, 'Franschhoek', 9),
(329, 'Gansbaai', 9),
(330, 'George', 9),
(331, 'Goodwood', 9),
(332, 'Gordons Bay', 9),
(333, 'Gouritsmond', 9),
(334, 'Graafwater', 9),
(335, 'Grabouw', 9),
(336, 'Groot Brakrivier', 9),
(337, 'Hartenbos', 9),
(338, 'Heidelberg', 9),
(339, 'Hermanus', 9),
(340, 'Cape Town ', 9),
(341, 'Somerset West', 9),
(342, 'Stellenbosch', 9),
(343, 'Hout Bay', 9),
(344, 'Strand ', 9),
(345, 'Durbanville', 9),
(346, 'Paarl ', 9),
(347, 'Bellville ', 9),
(348, 'Hopefield  ', 9),
(349, 'Khayelitsha', 9),
(350, 'Klein Brak Rivier', 9),
(351, 'Kleinmond', 9),
(352, 'Klipheuwel', 9),
(353, 'Knysna', 9),
(354, 'Kommetjie', 9),
(355, 'Kraaifontein', 9),
(356, 'Kuils River', 9),
(357, 'Ladismith', 9),
(358, 'Laingsburg', 9),
(359, 'Langebaan', 9),
(360, 'Macassar', 9),
(361, 'Malmesbury', 9),
(362, 'Melkbosstrand', 9),
(363, 'Milnerton', 9),
(364, 'Mitchells Plain', 9),
(365, 'Montagu', 9),
(366, 'Moorreesburg', 9),
(367, 'Mossel Bay', 9),
(368, 'Murraysburg', 9),
(369, 'Noordhoek', 9),
(370, 'Oudtshoorn', 9),
(371, 'Parow', 9),
(372, 'Paternoster', 9),
(373, 'Piketberg', 9),
(374, 'Plettenberg Bay', 9),
(375, 'Prince Albert', 9),
(376, 'Pringle Bay', 9),
(377, 'Riebeek Valley', 9),
(378, 'Riversdale', 9),
(379, 'Robertson', 9),
(380, 'Saldanha', 9),
(381, 'Scarborough', 9),
(382, 'Sedgefield', 9),
(383, 'Simons Town', 9),
(384, 'St Helena Bay', 9),
(385, 'Stanford', 9),
(386, 'Stilbaai', 9),
(387, 'Strandfontein', 9),
(388, 'Struisbaai', 9),
(389, 'Swellendam', 9),
(390, 'Touws River', 9),
(391, 'Tulbagh', 9),
(392, 'Uniondale', 9),
(393, 'Vanrhynsdorp', 9),
(394, 'Velddrif', 9),
(395, 'Victoria Bay ', 9),
(396, 'Villiersdorp', 9),
(397, 'Vleesbaai', 9),
(398, 'Vredenburg', 9),
(399, 'Vredendal', 9),
(400, 'Wellington', 9),
(401, 'Wilderness', 9),
(402, 'Wolseley', 9),
(403, 'Worcester', 9),
(404, 'Yzerfontein', 9),
(405, 'Cofimvaba', 4),
(406, 'Jansenville', 4),
(407, 'Willowmore', 4),
(408, 'Reddersburg', 3),
(409, 'Reitz', 3),
(410, 'Rouxville', 3),
(411, 'Senekal', 3),
(412, 'Springfontein', 3),
(413, 'Theunissen', 3),
(414, 'Trompsburg', 3),
(415, 'Viljoenskroon', 3),
(416, 'Vredefort', 3),
(417, 'Warden', 3),
(418, 'Lindley', 3),
(419, 'Ladybrand', 3),
(420, 'Koppies', 3),
(421, 'Koffiefontein', 3);

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expenses_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `name` varchar(255) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `expense_date` date NOT NULL,
  PRIMARY KEY (`expenses_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expenses_id`, `description`, `amount`, `name`, `categories`, `expense_date`) VALUES
(1, 'Casket', 400, 'Kabelo Ledwaba', 'Refreshments', '2019-08-05'),
(4, 'On our way to Gauteng we bought some coldrinks .', 300, 'Kabelo Ledwaba', 'Cleaning Materials', '2019-08-06'),
(6, 'We ran out of petrol when we were on our way to Durban', 200, 'Kabelo Ledwaba', 'Wages', '2019-08-06'),
(7, 'On our way Gauteng we paid 5 tollgates.', 150, 'Tiisetso Masemola', 'Tollgate', '2019-08-06'),
(12, 'All members contributed to this stationary', 500, 'Makgotso', 'Petrol', '2019-08-09'),
(14, 'All members contributed ', 10000, 'Oupa', 'Transport', '2019-08-09'),
(15, 'This Key can be used to open a door', 1500, 'Bokamoso', 'Grave-Mark', '2019-08-16'),
(17, 'This money is for transport and food', 500, 'Pabalelo', 'Refreshments', '2019-08-19'),
(18, 'this money is for church building', 600, 'Oupa', 'Sundries', '2019-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `family_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_member_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `relation` varchar(15) DEFAULT NULL,
  `date_inception` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `deceased` varchar(3) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`family_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `funeral`
--

CREATE TABLE IF NOT EXISTS `funeral` (
  `funeral_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `society_id` int(11) NOT NULL,
  `informant_first_name` varchar(25) NOT NULL,
  `informant_surname` varchar(25) NOT NULL,
  `informant_id_number` varchar(13) NOT NULL,
  `informant_contact_number` varchar(10) NOT NULL,
  `informant_street` varchar(35) NOT NULL,
  `informant_suburb` varchar(25) NOT NULL,
  `informant_city` varchar(25) NOT NULL,
  `informant_province` varchar(25) NOT NULL,
  `name_of_deceased` varchar(55) NOT NULL,
  `flower_amount` int(15) DEFAULT NULL,
  `coffin_amount` int(15) DEFAULT NULL,
  `grave_marker_amount` int(15) DEFAULT NULL,
  `transport_amount` int(15) NOT NULL,
  `funeral_service_amount` int(15) DEFAULT NULL,
  `funeral_time` int(11) NOT NULL,
  `date_of_funeral` date NOT NULL,
  `street` varchar(35) NOT NULL,
  `suburb` varchar(35) NOT NULL,
  `city` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL,
  `new_balance` int(15) NOT NULL,
  `total_package` int(15) NOT NULL,
  `type_of_package` varchar(8) NOT NULL,
  PRIMARY KEY (`funeral_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `invoice_date` date NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `description`, `name`, `amount`, `invoice_date`) VALUES
(2, 'This money is for transport and food', 'John Masemola', 5800, '2019-07-30'),
(4, 'this money is for church building', 'Mathabo', 20000, '2019-08-03'),
(6, 'this money is for church building', 'Oupa', 3500, '2019-08-16'),
(7, 'This money is for transport and food', 'Pholosho', 1500, '2019-08-16'),
(9, 'All members contributed ', 'Bokamoso', 500, '2019-08-21'),
(10, 'scX ', 'scX', 500, '2019-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `logo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(11) NOT NULL,
  `logo_img` varchar(255) NOT NULL,
  PRIMARY KEY (`logo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`logo_id`, `user_id`, `logo_img`) VALUES
(2, '1', '0logo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `main_member`
--

CREATE TABLE IF NOT EXISTS `main_member` (
  `main_member_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `id_number` bigint(13) NOT NULL,
  `contact_number` varchar(10) NOT NULL,
  `province` varchar(15) NOT NULL,
  `city` varchar(25) NOT NULL,
  `suburb` varchar(25) NOT NULL,
  `street` varchar(35) NOT NULL,
  `plan_type` varchar(25) NOT NULL,
  `premium` int(25) NOT NULL,
  `cover` int(25) NOT NULL,
  `policy_number` varchar(15) NOT NULL,
  `inception_date` int(11) NOT NULL,
  PRIMARY KEY (`main_member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `main_member`
--

INSERT INTO `main_member` (`main_member_id`, `user_id`, `first_name`, `last_name`, `gender`, `id_number`, `contact_number`, `province`, `city`, `suburb`, `street`, `plan_type`, `premium`, `cover`, `policy_number`, `inception_date`) VALUES
(1, 9, 'Arthur', 'Makofane', 'Male', 9806195497089, '0793359595', 'Limpopo', 'Polokwane ', 'Lebowakgomo  ', '125 David Street', 'Silver', 2500, 400, '8452evfs', 1571695933),
(2, 12, 'Oupa', 'Mosotho', 'Male', 9501021452147, '0742589654', 'Limpopo', 'Polokwane ', 'Flora Park', '125 Marshall Street', 'Bronze', 2500, 150, 'dc41cda', 1572367229),
(3, 13, 'Morwakoma', 'Matabane', 'Male', 9301478545123, '0745896321', 'Limpopo', 'Polokwane ', 'Central', '82 Divinish Street', 'Platinum', 15000, 15000, 'hujnklm41', 1573232924),
(4, 14, 'rfsvcdac', 'edascxads', 'Male', 9505312547856, '0798541254', 'Free State', 'Aberdeen ', 'dacxz', 'sadcx', 'Bronze', 643, 7542, '452regfsdv', 1574886236),
(5, 15, 'jhgf', 'hgfd', 'Male', 1111111111111, '0748521212', 'Eastern Cape', 'Alldays ', 'kjhg', 'hgf', 'Silver', 500, 2000, 'kjhgf1', 1575483730),
(6, 16, 'hgfdsa', 'gfds', 'Male', 9630051478555, '0745896582', 'Eastern Cape', 'gfdsa', 'gfdsa', 'gfdsa', 'Silver', 500, 500, 'gfx52', 1575504269);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `society_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact_num` varchar(10) NOT NULL,
  `id_number` varchar(13) NOT NULL,
  `deceased` varchar(3) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `society_id`, `society_name`, `first_name`, `last_name`, `gender`, `contact_num`, `id_number`, `deceased`) VALUES
(20, 11, 'Selemo', 'Mathabo Pretty', 'Matabanes', 'Female', '0725858585', '9703097456321', 'Yes'),
(21, 12, 'Morudu', 'Thabang', 'Morudu', 'Male', '0765241526', '2514253695888', 'No'),
(22, 13, 'Morule', 'Bokamoso', 'Masemola', 'Female', '0793359593', '9695896431250', 'No'),
(23, 14, 'Mahlogonolo', 'Oupa', 'Mahlogonolo', 'Male', '0793359595', '125478963222', 'No'),
(24, 14, 'Mahlogonolo', 'Enicca', 'Kgasago', 'Male', '0715824715', '9685748596555', 'Yes'),
(25, 11, 'Selemo', 'Bokamoso', 'Moloko', 'Female', '0715896524', '7458745874587', 'Yes'),
(26, 15, 'Johns Society', 'Tiisetso', 'Masemola', 'Male', '0793359595', '9706195397087', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `member_statement`
--

CREATE TABLE IF NOT EXISTS `member_statement` (
  `member_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `deceased_name` varchar(25) DEFAULT NULL,
  `date_transaction` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `credit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `paid_for` varchar(255) NOT NULL,
  PRIMARY KEY (`member_payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `member_statement`
--

INSERT INTO `member_statement` (`member_payment_id`, `member_id`, `deceased_name`, `date_transaction`, `name`, `credit`, `debit`, `balance`, `paid_for`) VALUES
(78, 1, NULL, 0, 'John', 150, 0, 5150, ''),
(79, 1, NULL, 2019, 'John', 150, 0, 5300, ''),
(80, 1, NULL, 2019, 'John', 700, 0, 6000, ''),
(81, 1, NULL, 1572997029, NULL, 1500, 0, 7500, 'April 2019'),
(82, 1, NULL, 1572997142, 'Arthur Makofane', 1500, 0, 9000, 'April 2019'),
(83, 1, NULL, 1572997823, 'Arthur Makofane', 1500, 0, 10500, 'May 2019'),
(84, 2, NULL, 1573074734, 'Oupa Mosotho', 2500, 0, 2500, 'May 2019'),
(85, 3, NULL, 1573234467, 'Morwakoma Matabane', 600, 0, 600, 'June 2019'),
(88, 1, 'hhhhh mmmmm', 2019, 'admin', 0, 3000, 1500, '2019-11-23'),
(89, 2, 'aaaaaa sssssssss', 2019, 'admin', 0, 700, 1800, '2019-11-23'),
(90, 1, 'sddc casXcs', 2019, 'admin', 0, 900, 600, '2019-01-01'),
(91, 1, 'fvscad gd fsc', 2019, 'admin', 0, 500, 100, '2019-01-01'),
(92, 1, 'fvscad gd fsc', 2019, 'admin', 0, 500, -400, '2019-01-01'),
(93, 1, 'fvscad gd fsc', 2019, 'admin', 0, 500, -900, '2019-01-01'),
(94, 1, 'fvscad gd fsc', 2019, 'admin', 0, 500, -1400, '2019-01-01'),
(95, 1, 'hbgvfd gfd', 2019, 'Funeral arrangement', 0, 2500, -3900, '2019-01-01'),
(96, 1, 'hbgvfd gfd', 2019, 'Funeral arrangement', 0, 2500, -6400, '2019-01-01'),
(97, 1, 'hbgvfd gfd', 2019, 'Funeral arrangement', 0, 2500, -8900, '2019-01-01'),
(98, 1, 'hbgvfd gfd', 2019, 'Funeral arrangement', 0, 2500, -11400, '2019-01-01'),
(99, 1, 'gfdddcx gfdscd', 2019, 'admin', 0, 500, -11900, '2019-01-01'),
(100, 1, 'gfdddcx gfdscd', 2019, 'admin', 0, 500, -12400, '2019-01-01'),
(101, 1, 'gfdddcx gfdscd', 2019, 'admin', 0, 500, -12900, '2019-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE IF NOT EXISTS `package` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `flower` double NOT NULL,
  `coffin` double NOT NULL,
  `grave_marker` double NOT NULL,
  `transport` double NOT NULL,
  `funeral_service` double NOT NULL,
  `programmes` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `package_created` date NOT NULL,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `society_id`, `flower`, `coffin`, `grave_marker`, `transport`, `funeral_service`, `programmes`, `total`, `package_created`) VALUES
(2, 8, 5000, 3500, 0, 500, 1500, '1500', 12000, '2019-07-30'),
(3, 9, 350, 18000, 650, 4500, 5000, '0', 28500, '2019-07-30'),
(4, 4, 1500, 5000, 1500, 0, 0, '75', 8000, '0000-00-00'),
(6, 11, 500, 500, 100, 1000, 900, '900', 3000, '2019-08-01'),
(7, 12, 750, 8500, 1500, 3500, 3500, '0', 17750, '2019-08-01'),
(8, 13, 5000, 500, 1000, 1000, 0, 'No Amount', 7500, '2019-08-01'),
(9, 14, 2500, 5000, 5000, 0, 2500, 'No Amount', 15000, '2019-08-01'),
(10, 14, 2500, 5000, 5000, 0, 2500, 'No Amount', 15000, '2019-08-01'),
(11, 14, 2500, 5000, 5000, 5000, 2500, 'No Amount', 20000, '2019-08-01'),
(12, 14, 2500, 0, 0, 5000, 2500, 'No Amount', 10000, '2019-08-01'),
(13, 1, 500, 100, 750, 5000, 750, 'No Amount', 7100, '2019-08-02'),
(14, 2, 0, 0, 0, 0, 0, 'No Amount', 0, '2019-08-02'),
(15, 15, 3500, 12000, 3000, 2500, 1200, 'No Amount', 22200, '2019-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `policy_holder_funeral`
--

CREATE TABLE IF NOT EXISTS `policy_holder_funeral` (
  `policy_holder_funeral_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_member_id` int(11) NOT NULL,
  `informant_first_name` varchar(35) NOT NULL,
  `informant_surname` varchar(35) NOT NULL,
  `informant_id_number` varchar(13) NOT NULL,
  `informant_contact_number` varchar(10) NOT NULL,
  `informant_street` varchar(25) NOT NULL,
  `informant_suburb` varchar(25) NOT NULL,
  `informant_city` varchar(25) NOT NULL,
  `informant_province` varchar(25) NOT NULL,
  `id_number_of_deceased` varchar(13) NOT NULL,
  `flower_amount` int(11) NOT NULL,
  `coffin_amount` int(11) NOT NULL,
  `grave_marker_amount` int(11) NOT NULL,
  `transport_amount` int(11) NOT NULL,
  `funeral_service_amount` int(11) NOT NULL,
  `funeral_time` int(11) NOT NULL,
  `date_of_funeral` date NOT NULL,
  `street` varchar(35) NOT NULL,
  `suburb` varchar(35) NOT NULL,
  `city` varchar(35) NOT NULL,
  `province` varchar(30) NOT NULL,
  `new_balance` int(15) NOT NULL,
  `total_package` int(15) NOT NULL,
  `type_of_package` varchar(8) NOT NULL,
  `member_id` int(11) NOT NULL,
  `member_type` varchar(25) NOT NULL,
  `deceased` varchar(3) NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`policy_holder_funeral_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int(11) NOT NULL AUTO_INCREMENT,
  `province_name` varchar(255) NOT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
(1, 'Limpopo'),
(2, 'Gauteng'),
(3, 'Free State'),
(4, 'Eastern Cape'),
(5, 'Kwazulu Natal'),
(6, 'North West'),
(7, 'Northern Cape'),
(8, 'Mpumalanga'),
(9, 'Western Cape');

-- --------------------------------------------------------

--
-- Table structure for table `society`
--

CREATE TABLE IF NOT EXISTS `society` (
  `society_id` int(11) NOT NULL AUTO_INCREMENT,
  `society_name` varchar(255) NOT NULL,
  `addr1` varchar(255) NOT NULL,
  `addr2` varchar(255) NOT NULL,
  `addr3` varchar(255) NOT NULL,
  `addr4` varchar(255) NOT NULL,
  `init_capital` int(11) NOT NULL,
  `date_inception` date NOT NULL,
  PRIMARY KEY (`society_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `society`
--

INSERT INTO `society` (`society_id`, `society_name`, `addr1`, `addr2`, `addr3`, `addr4`, `init_capital`, `date_inception`) VALUES
(10, 'Moloto Society', '135 Zone F', 'Lebowakgomo', 'Polokwane', 'Limpopo', 10000, '2019-06-30'),
(11, 'Selemo', '125 Zone R', 'Polokwane', 'Limpopo', '', 1500, '2019-07-31'),
(12, 'Morudu', 'House No 1737', 'Lephalale', 'Limpopo', '', 15000, '2010-06-19'),
(13, 'Morule', '125 Zone R', 'Lephalale', 'Limpopo', '', 10000, '2019-07-22'),
(14, 'Mahlogonolo', '82 Marshall Street', 'Ivy Park', 'Polokwane', 'Limpopo', 15000, '2019-08-01'),
(15, 'Johns Society', '75 Thabo Mbeki Street', 'Flora Park', 'Polokwane', 'Limpopo', 5000, '1997-06-19'),
(16, 'Mahlogonolooooo', 'House No 1737 Zone A', 'Polokwane', 'Limpopo', 'South Africa', 251, '2019-07-28'),
(17, 'Thabaneng', 'House No 1737 Zone A', 'Lebowakgomo', 'Limpopo', 'Limpopo', 500, '2019-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `statement`
--

CREATE TABLE IF NOT EXISTS `statement` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `deceased_name` varchar(255) NOT NULL,
  `society_id` int(255) NOT NULL,
  `society_name` varchar(255) NOT NULL,
  `date_transaction` date NOT NULL,
  `credit` int(11) NOT NULL,
  `debit` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `statement`
--

INSERT INTO `statement` (`payment_id`, `name`, `deceased_name`, `society_id`, `society_name`, `date_transaction`, `credit`, `debit`, `balance`) VALUES
(11, 'Initial Capital', '', 3, 'hlakanang', '2019-07-17', 2000, 0, 2000),
(12, 'John', '', 3, 'hlakanang', '2019-07-17', 1000, 0, 3000),
(14, 'Mathabo', '', 3, 'hlakanang', '2019-07-22', 0, 1500, 1500),
(15, 'Initial Capital', '', 4, 'Masemola', '2019-07-23', 3580, 0, 3580),
(16, 'Initial Capital', '', 5, 'Mashabela', '2019-07-23', 1500, 0, 1500),
(17, 'Initial Capital', '', 6, 'Maropeng', '2019-07-23', 10000, 0, 10000),
(18, 'John', '', 6, 'Maropeng', '2019-07-23', 500, 0, 10500),
(19, 'Oupa', '', 6, 'Maropeng', '2019-07-23', 0, 600, 9900),
(33, 'Makgotso', '', 6, 'Maropeng', '2019-07-30', 1500, 0, 11400),
(38, 'Initial Capital', '', 7, 'Mphahlele', '2019-07-30', 1500, 0, 1500),
(39, 'Initial Capital', '', 8, 'Makofane', '2019-07-30', 5000, 0, 5000),
(40, 'Initial Capital', '', 9, 'Makgahlelas', '2019-07-30', 3500, 0, 3500),
(42, 'Initial Capital', '', 10, 'Moloto', '2019-07-31', 10000, 0, 10000),
(43, 'admin', '', 0, '', '2019-08-01', 0, 400, 1500),
(46, 'Initial Capital', '', 12, 'Morudu', '2019-08-01', 15000, 0, 15000),
(47, 'Initial Capital', '', 13, 'Morule', '2019-08-01', 10000, 0, 10000),
(48, 'Opening Balance', '', 14, 'Mahlogonolo', '2019-08-01', 15000, 0, 15000),
(49, 'John', '', 14, 'Mahlogonolo', '2019-08-01', 500, 0, 15500),
(50, 'John', '', 14, 'Mahlogonolo', '2019-08-01', 600, 0, 16100),
(51, 'John', '', 12, 'Morudu', '2019-08-01', 0, 500, 14500),
(53, 'Opening Balance', '', 15, 'Johns Society', '2019-08-03', 5000, 0, 5000),
(54, 'John', 'Lebo Makgahlela', 15, 'Johns Society', '2019-08-03', 0, 25000, -20000),
(55, 'John', '', 15, 'Johns Society', '2019-08-03', 5000, 0, -15000),
(56, 'John', '', 15, 'Johns Society', '2019-08-05', 1500, 0, -13500),
(57, 'Oupa', '', 14, 'Mahlogonolo', '2019-08-05', 1200, 0, 17300),
(64, 'Oupa', '', 12, 'Morudu', '2019-08-08', 600, 0, 15100),
(65, 'Opening Balance', '', 17, 'Thabaneng', '2019-08-09', 500, 0, 500),
(71, 'John', '', 10, 'Moloto Society', '2019-09-16', 1500, 0, 11500),
(72, 'John', '', 10, 'Moloto Society', '2019-09-16', 1500, 0, 13000),
(73, 'Martha Dinoko', 'Edwin Dinoko', 10, 'Moloto Society', '2019-10-25', 0, 3000, 10000),
(74, 'Martha Dinoko', 'Buddy Dinoko', 10, 'Moloto Society', '2019-10-25', 0, 3000, 7000),
(75, 'Martha Dinoko', 'Rusty Dinoko', 10, 'Moloto Society', '2019-10-25', 0, 8000, -1000),
(113, 'Funeral arrangement', 'Bokamoso Moloko', 11, 'Selemo', '2019-12-05', 0, 4500, -4500);

-- --------------------------------------------------------

--
-- Table structure for table `updated_package`
--

CREATE TABLE IF NOT EXISTS `updated_package` (
  `updated_package_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `total` double NOT NULL,
  `date_of_updated_package` date NOT NULL,
  PRIMARY KEY (`updated_package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `updated_package`
--

INSERT INTO `updated_package` (`updated_package_id`, `package_id`, `total`, `date_of_updated_package`) VALUES
(10, 8, 7500, '2019-08-01'),
(11, 6, 3000, '2019-08-01'),
(12, 5, 30000, '2019-08-01'),
(13, 8, 7500, '2019-08-01'),
(14, 9, 25000, '2019-08-01'),
(15, 9, 15000, '2019-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip` varchar(32) NOT NULL,
  `time` int(11) NOT NULL,
  `email_code` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `ip`, `time`, `email_code`, `type`) VALUES
(1, 'tiisetsojohnmasemola@yahoo.com', 'Tiisetso Masemola', '$2y$12$0738672585d374b40328cOM2ieF2rwgnc6vh6MbZeryZj8gzUXU3.', '0', 225959, '0', 'manager'),
(6, 'admin@mytrend.co.za', 'Admin', '$2y$12$11809040225d5c7e97dffuwl9cE6EhTvDGb13.UEoBDCjFeHRHFOC', '::1', 1566342807, 'code_5d5c7e97dbbcf2.08533568', 'Admin'),
(9, 'arthur@gmail.com', 'Arthur', '$2y$12$29050515895db749b73a3uZhHl8.qwlQcglztRZV8NVDZQNLarR1i', '::1', 1571693339, 'code_5dae231bbd66d1.05103376', 'user'),
(12, 'oupa@gmail.com', 'Oupa', '$2y$12$14171158465db868310b2uuHVRssnhDQkdDBJKC3iRrRJfMHE3upe', '::1', 1572366385, 'code_5db868310b2524.54292607', 'user'),
(16, 'jhgfdsa@gmail.com', 'jhgfdsa', '$2y$12$51766243415de8496acbeu.dPGzzF0JLrx/m8I5gGDBPMJCDfHD8m', '::1', 1575504234, 'code_5de8496acbe8e3.61351865', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
