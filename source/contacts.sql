SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `contacts`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `firstname` char(128) NOT NULL,
  `lastname` char(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_contacts_1` (`is_deleted`),
  KEY `IX_contacts_2` (`firstname`),
  KEY `IX_contacts_3` (`lastname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `contacts`
--

INSERT INTO `contacts` (`id`, `is_deleted`, `firstname`, `lastname`) VALUES
(1, 0, 'Erich', 'Gamma'),
(2, 0, 'Richard', 'Helm'),
(3, 0, 'Dennis', 'Ritchie'),
(4, 0, 'Douglas', 'Crockford'),
(5, 0, 'Donald', 'Knuth'),
(6, 0, 'Robert', 'Martin'),
(7, 0, 'Guido', ' van Rossum'),
(8, 0, 'Yukihiro', 'Matsumoto'),
(9, 0, 'Zeev', 'Suraski'),
(10, 0, 'Andi', 'Gutmans');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contact_details`
--

CREATE TABLE IF NOT EXISTS `contact_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) unsigned NOT NULL,
  `field_type_id` int(10) unsigned NOT NULL,
  `is_deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `value` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_contact_details_1` (`is_deleted`),
  KEY `IX_contact_details_2` (`is_deleted`,`value`),
  KEY `FK_contact_details_1` (`contact_id`),
  KEY `FK_contact_details_2` (`field_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Zrzut danych tabeli `contact_details`
--

INSERT INTO `contact_details` (`id`, `contact_id`, `field_type_id`, `is_deleted`, `value`) VALUES
(1, 1, 1, 0, '732-757-2923'),
(2, 1, 2, 0, '999-0000'),
(3, 1, 3, 0, 'eg@example.com'),
(4, 1, 5, 0, 'Praesent ut mattis quam. Nam at accumsan sapien. Maecenas tempor aliquam ullamcorper. Sed quis quam ut elit fringilla cursus sit amet sit amet urna. Proin vitae odio sem. Nunc vulputate dolor et quam consectetur elementum. Praesent at mauris justo. Maecen'),
(5, 2, 4, 0, 'http://example.com'),
(6, 2, 5, 0, 'In venenatis sapien a urna lacinia a accumsan mi blandit. Quisque quis tellus auctor turpis dignissim semper. Phasellus faucibus mi eu nisi cursus ut laoreet nunc aliquam. Phasellus libero libero, convallis sit amet adipiscing a, iaculis eget risus. Sed a'),
(7, 3, 2, 0, '504-200-9999'),
(8, 4, 2, 0, '999-0000'),
(9, 5, 1, 0, '555-555-5555'),
(10, 6, 2, 0, '873 54321'),
(16, 7, 2, 0, '234-0001'),
(17, 8, 1, 0, '421-9998'),
(18, 9, 1, 0, '1234567890'),
(19, 10, 1, 0, '555-333-333'),
(20, 6, 5, 0, 'Curabitur auctor arcu in leo vehicula placerat. Quisque pulvinar ullamcorper odio, non laoreet dui dignissim sit amet. Suspendisse vehicula aliquet lacinia.'),
(21, 7, 4, 0, 'http://dummyuri.org'),
(22, 8, 4, 0, 'http://test.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `field_types`
--

CREATE TABLE IF NOT EXISTS `field_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_active` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `field_type` char(32) NOT NULL,
  `name` char(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_field_types_1` (`is_active`),
  KEY `IX_field_types_2` (`field_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Zrzut danych tabeli `field_types`
--

INSERT INTO `field_types` (`id`, `is_active`, `field_type`, `name`) VALUES
(1, 1, 'phone', 'Phone'),
(2, 1, 'mobile', 'Mobile'),
(3, 1, 'email', 'E-mail'),
(4, 1, 'homepage_uri', 'Homepage URI'),
(5, 1, 'note', 'Note');

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `FK_contact_details_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_contact_details_2` FOREIGN KEY (`field_type_id`) REFERENCES `field_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
