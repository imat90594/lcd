-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2015 at 09:08 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clefsdor`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `album_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_title` varchar(45) NOT NULL DEFAULT 'New Album',
  `album_folder` varchar(250) NOT NULL,
  `sorting_number` int(11) NOT NULL,
  `is_used` int(11) DEFAULT NULL,
  PRIMARY KEY (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`album_id`, `album_title`, `album_folder`, `sorting_number`, `is_used`) VALUES
(6, 'Members', 'Members_album', 0, NULL),
(7, 'Hotels', 'Hotels_album', 0, NULL),
(8, 'Banners', 'Banners_album', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `album_image_sizes`
--

CREATE TABLE IF NOT EXISTS `album_image_sizes` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `dimensions` varchar(20) NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`size_id`),
  KEY `fk_size_album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `album_image_sizes`
--

INSERT INTO `album_image_sizes` (`size_id`, `dimensions`, `album_id`) VALUES
(9, '500x500', 6),
(10, '1000x1000', 7),
(11, '2000x2000', 8);

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `applicant_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_details` longtext,
  `application_form_path` varchar(250) DEFAULT NULL,
  `date_applied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`applicant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=916 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `applicant_details`, `application_form_path`, `date_applied`) VALUES
(913, '{"job_id":"37","first_name":"John","middle_name":"Valdez","last_name":"Smith","address":"Leyete St. Malate, Manila","mobile_number":"09100000444","landline_number":"42054654","email":"raymart.marasigan@starfi.sh","confirm_email":"raymart.marasigan@starfi.sh","rank_applied":"My rank","nationality":"Filipino","preferred_ship_type":"My ship","salary_expectation":"$3000","passport_number":"13245789","seamans_number":"234234234","coc_number":"234234234","coc_level":"Management","us_visa":"123423","additional_skills":"This is my additional skills acquired. Sample.","service":{"1":{"ship_name":"lsdkjf","ship_type":"lfkj","grt":"klfj","rank":"fj","flag":"jf","manning_agency":"jlj","principal":"lfj","engine_make":"fjk","engine_kw":"flkj","from_date_days":"18","from_date_months":"Feb","from_date_years":"1970","to_date_days":"1","to_date_months":"Feb","to_date_years":"1970"}},"recaptcha_challenge_field":"03AHJ_VusGnIiR_xP5FxZmfCtkWeRX7UVfqXGO1jQa-o5SZKSVgrSl3Zkxw_bWzVPKUrlU-ggH7Dlnp2pHdozEA5j-uqmuzqCf3WOOQu1dM7YOOfxI3MChV8xN54ewhoDbH0Tgw5N_hZ48iHZQRGNZLEm8_wkctV7l_iW79TkIqcthF8czHC7Y5dK9rcWcmT7EomCqAJahrafE5Pvd6F4NBjlNsTAUq8zJ-eXB7QW-KLmqxuhUjokx2CXBaQbXiU3UAHMkXkAej6IS","recaptcha_response_field":"which lebrito","date_of_birth":"27-May-1993","available_date":"20-Jun-2014","coc_validity":"12-Nov-2014","passport_validity":"10-Dec-2015","seamans_validity":"11-Feb-2016","us_visa_validity":"11-Jan-2016"}', '554dcbad8e278.xls', '2015-05-09 08:56:23'),
(914, '{"job_id":"37","first_name":"John","middle_name":"Valdez","last_name":"Smith","address":"Leyete St. Malate, Manila","mobile_number":"09100000444","landline_number":"42054654","email":"raymart.marasigan@starfi.sh","confirm_email":"raymart.marasigan@starfi.sh","rank_applied":"My rank","nationality":"Filipino","preferred_ship_type":"My ship","salary_expectation":"$3000","passport_number":"13245789","seamans_number":"234234234","coc_number":"234234234","coc_level":"Management","us_visa":"123423","additional_skills":"This is my additional skills acquired. Sample.","service":{"1":{"ship_name":"sldkfj","ship_type":"lkfj","grt":"kljfj","rank":"f","flag":"jfk","manning_agency":"jfj","principal":"fkj","engine_make":"fj","engine_kw":"jfj","from_date_days":"1","from_date_months":"Jan","from_date_years":"1970","to_date_days":"2","to_date_months":"Jan","to_date_years":"1970"}},"recaptcha_challenge_field":"03AHJ_Vuv-KsxPqc0A_g9zbVDXu5KZRX4nom5ZJoj4MGfkp7I15Yhue1FbnGcbuAPQaKtPiDUtqv0BRe8OwHh-5SdSJJlROCQWNG6-l7x8KDdHKVjBZltQWuU44BY4Rv12JiqDpaQiDre2m0FbymblshuEN6wp3sRljMHLda69hiqSTj0eNqml9jIyHD6-c_FvUybu8wmlElM08EI0aDUeqDvxJKbDTj2RHoIMsPxRUP5y4lvIgYnylvVjRG-50d5OMFaK3_3RAp_j","recaptcha_response_field":"migne","date_of_birth":"27-May-1993","available_date":"20-Jun-2014","coc_validity":"12-Nov-2014","passport_validity":"10-Dec-2015","seamans_validity":"11-Feb-2016","us_visa_validity":"11-Jan-2016"}', '554dcc1cb919a.xls', '2015-05-09 08:58:14'),
(915, '{"job_id":"28","first_name":"John","middle_name":"Valdez","last_name":"Smith","address":"Leyete St. Malate, Manila","mobile_number":"09100000444","landline_number":"42054654","email":"raymart.marasigan@starfi.sh","confirm_email":"raymart.marasigan@gmail.com","rank_applied":"My rank","nationality":"Filipino","preferred_ship_type":"My ship","salary_expectation":"$3000","passport_number":"13245789","seamans_number":"234234234","coc_number":"234234234","coc_level":"Management","us_visa":"123423","additional_skills":"This is my additional skills acquired. Sample.","service":{"1":{"ship_name":"sldfkj","ship_type":"ljf","grt":"kljfj","rank":"ljfl","flag":"kjfkl","manning_agency":"fk","principal":"kljf","engine_make":"jfklj","engine_kw":"f","from_date_days":"2","from_date_months":"Jan","from_date_years":"1970","to_date_days":"2","to_date_months":"Jan","to_date_years":"1972"}},"recaptcha_challenge_field":"03AHJ_VuugDvb5NnGWekYiQuu-xGBvLOEk0xcmV2qM-AypFR6MuM8fhRHvz5lhpcXEUr4vwLEKAzQ4T80tCCwte2WmxdWaXYROQd_h3FYTUwn3yh0EIfH_PchPOMdGDpesdYD-R55FRwyia4K92QsZ96542ZzfHlbDPmRMaT1ww-elWkMGas6PTuqXt38HZ8l62WpjiXUwVevkGr2Sia5om-HarpEBrcOs3C0P-A2uRhChMIW0PIrZYoEYWBwGfLy_nKgXRvu8Kyko","recaptcha_response_field":"insve","date_of_birth":"27-May-1993","available_date":"20-Jun-2014","coc_validity":"12-Nov-2014","passport_validity":"10-Dec-2015","seamans_validity":"11-Feb-2016","us_visa_validity":"11-Jan-2016"}', '554dcd1d0f274.xls', '2015-05-09 09:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NOT NULL,
  `article_category_id` int(11) NOT NULL,
  `article_type` varchar(50) NOT NULL,
  `article_title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(50) NOT NULL,
  `is_publish` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `metadata` varchar(250) NOT NULL,
  `downloadables_path` varchar(100) NOT NULL,
  `image_id` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `hotel_image_id` int(11) DEFAULT NULL,
  `hotel_name` varchar(100) DEFAULT NULL,
  `hotel_description` text,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `route_id`, `article_category_id`, `article_type`, `article_title`, `content`, `author`, `is_publish`, `date_created`, `date_modified`, `metadata`, `downloadables_path`, `image_id`, `position`, `hotel_image_id`, `hotel_name`, `hotel_description`) VALUES
(1, 1, 0, 'news', 'Test Article Director 1a', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1388962800, 1389002376, 'dsf', '0', 26, '', NULL, NULL, NULL),
(2, 2, 0, 'news', 'Test Article Director 2', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002377, 1389002377, '', '0', 26, '', NULL, NULL, NULL),
(3, 3, 0, 'news', 'Test Article Director 3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002378, 1389002378, '', '0', 26, '', NULL, NULL, NULL),
(4, 4, 0, 'news', 'Test Article Director 4', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002379, 1389002379, '', '0', 26, '', NULL, NULL, NULL),
(5, 5, 0, 'news', 'Test Article Director 5', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002380, 1389002380, '', '0', 26, '', NULL, NULL, NULL),
(6, 6, 0, 'news', 'Test Article Director 6', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002381, 1389002381, '', '0', 26, '', NULL, NULL, NULL),
(8, 8, 0, 'news', 'Test Article Director 8', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002383, 1389002383, '', '0', 26, '', NULL, NULL, NULL),
(9, 9, 0, 'news', 'Test Article Director 9', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002384, 1389002384, '', '0', 26, '', NULL, NULL, NULL),
(11, 11, 0, 'news', 'Test Article Director 11', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002386, 1389002386, '', '0', 26, '', NULL, NULL, NULL),
(12, 12, 0, 'news', 'Test Article Director 12', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002387, 1389002387, '', '0', 26, '', NULL, NULL, NULL),
(13, 13, 0, 'news', 'Test Article Director 13', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002388, 1389002388, '', '0', 26, '', NULL, NULL, NULL),
(14, 14, 0, 'csr', 'Test Article Director 14', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002389, 1389002389, '', '0', 26, '', NULL, NULL, NULL),
(15, 15, 0, 'news', 'Test Article Director 15', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002390, 1389002390, '', '0', 26, '', NULL, NULL, NULL),
(16, 16, 0, 'news', 'Test Article Director 16', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002391, 1389002391, '', '0', 26, '', NULL, NULL, NULL),
(17, 17, 0, 'seafarers', 'Test Article Director 17', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002392, 1389002392, '', '0', 26, '', NULL, NULL, NULL),
(18, 18, 0, 'seafarers', 'Test Article Director 18', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002393, 1389002393, '', '0', 26, '', NULL, NULL, NULL),
(19, 19, 0, 'news', 'Test Article Director 19', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002394, 1389002394, '', '0', 26, '', NULL, NULL, NULL),
(20, 20, 0, 'csr', 'Test Article Director 20', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002395, 1389002395, '', '0', 26, '', NULL, NULL, NULL),
(21, 21, 0, 'csr', 'Test Article Design 21', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002887, 1389002887, '', '0', 26, '', NULL, NULL, NULL),
(22, 22, 0, 'news', 'Test Article Design 22', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002888, 1389002888, '', '0', 26, '', NULL, NULL, NULL),
(23, 23, 0, 'seafarers', 'Test Article Design 23', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002889, 1389002889, '', '0', 26, '', NULL, NULL, NULL),
(24, 24, 0, 'seafarers', 'Test Article Design 24', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002890, 1389002890, '', '0', 26, '', NULL, NULL, NULL),
(25, 25, 0, 'seafarers', 'Test Article Design 25', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002891, 1389002891, '', '0', 26, '', NULL, NULL, NULL),
(26, 26, 0, 'news', 'Test Article Design 26', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002892, 1389002892, '', '0', 26, '', NULL, NULL, NULL),
(27, 27, 0, 'news', 'Test Article Design 27', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1389002893, 1389002893, '', '0', 26, '', NULL, NULL, NULL),
(29, 29, 0, 'csr', 'Test Article Design 29', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1388962800, 1389002895, '.', '0', 26, '', NULL, NULL, NULL),
(31, 31, 0, 'news', 'dghfghfg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1393455600, 0, '', '', 26, '', NULL, NULL, NULL),
(34, 32, 0, 'news', 'Testsdf', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1393455600, 0, '', '', 26, '', NULL, NULL, NULL),
(35, 33, 0, 'csr', 'campaign 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1393455600, 0, 'sdfsdf', '', 26, '', NULL, NULL, NULL),
(37, 35, 0, 'news', 'jhgjhg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1393455600, 0, '', '', 26, '', NULL, NULL, NULL),
(38, 36, 0, 'news', 'Surf', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1396330980, 0, '', '', 26, '', NULL, NULL, NULL),
(39, 37, 0, 'csr', 'Test Member 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1412200800, 0, '', '', 26, '', NULL, NULL, NULL),
(40, 38, 0, 'news', 'Award 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1412287200, 0, '', '', 26, '', NULL, NULL, NULL),
(41, 42, 0, 'seafarers', 'Test Pacific Product 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1414969200, 0, '', '', 26, '', NULL, NULL, NULL),
(43, 44, 0, 'news', 'Test Pacific Product 3', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1414969200, 0, '', '', 26, '', NULL, NULL, NULL),
(44, 45, 0, 'csr', 'Test News 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'Kevin Baisas', '1', 1415660400, 0, '', '', 26, '', NULL, NULL, NULL),
(45, 46, 0, 'seafarers', 'Test News 2', '<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>', 'Kevin Baisas', '1', 1415660400, 0, '', '', 26, '', NULL, NULL, NULL),
(46, 47, 0, 'csr', 'Test Recipe 1', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>\r\n', '', '1', 1415660400, 0, '', '', 26, '', NULL, NULL, NULL),
(47, 48, 0, 'csr', 'Test Article Last', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', '', '1', 1415746800, 0, '.', '', 26, '', NULL, NULL, NULL),
(48, 49, 16, 'members', 'Mayumi Hayakawa-Marcelo', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint natus itaque ex laborum praesentium soluta velit repudiandae deserunt magni ut dolorem obcaecati labore voluptatem reiciendis placeat tempora nisi ab laboriosam.</p>\r\n', '', '1', 1434492000, 0, '', '', 27, 'position', 30, '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint natus itaque ex laborum praesentium soluta velit repudiandae deserunt magni ut dolorem obcaecati labore voluptatem reiciendis placeat tempora nisi ab laboriosam.</p>\r\n'),
(49, 50, 17, 'members', 'Noey Villasabas', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint natus itaque ex laborum praesentium soluta velit repudiandae deserunt magni ut dolorem obcaecati labore voluptatem reiciendis placeat tempora nisi ab laboriosam.</p>\r\n', '', '1', 1434492000, 0, '', '', 29, 'Position', 30, 'test', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint natus itaque ex laborum praesentium soluta velit repudiandae deserunt magni ut dolorem obcaecati labore voluptatem reiciendis placeat tempora nisi ab laboriosam.</p>\r\n'),
(50, 51, 0, 'hotels', 'Peninsula', '', '', '1', 1436479200, 0, '', '', 30, '', 0, '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint natus itaque ex laborum praesentium soluta velit repudiandae deserunt magni ut dolorem obcaecati labore voluptatem reiciendis placeat tempora nisi ab laboriosam.</p>\r\n'),
(51, 52, 0, 'hotels', 'Fairmont', '', '', '1', 1436479200, 0, '', '', 30, '', 0, '', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint natus itaque ex laborum praesentium soluta velit repudiandae deserunt magni ut dolorem obcaecati labore voluptatem reiciendis placeat tempora nisi ab laboriosam.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

CREATE TABLE IF NOT EXISTS `article_categories` (
  `article_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `metadata` varchar(250) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  PRIMARY KEY (`article_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`article_category_id`, `parent_id`, `category_type`, `category_name`, `description`, `metadata`, `permalink`) VALUES
(16, 0, 'members', 'Full Members', '', '', 'full-members'),
(17, 0, 'members', 'Adherent Members', '', '', 'adherent-members');

-- --------------------------------------------------------

--
-- Table structure for table `article_comments`
--

CREATE TABLE IF NOT EXISTS `article_comments` (
  `article_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `article_type` varchar(10) DEFAULT NULL,
  `author` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `content` text,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`article_comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `article_comments`
--

INSERT INTO `article_comments` (`article_comment_id`, `article_id`, `article_type`, `author`, `email`, `content`, `date_created`) VALUES
(1, 44, 'articles', 'Kevin Baisas', 'kevin.baisas@starfi.sh', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1415574000),
(2, 46, 'articles', 'Kevin Baisas', 'kevin.baisas@starfi.sh', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 1415574000),
(3, 46, 'articles', 'Micah Angeles', 'micah.angeles@starfi.sh', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', 1415574000);

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_settings`
--

CREATE TABLE IF NOT EXISTS `enterprise_settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `use_smtp` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_host` varchar(45) NOT NULL,
  `smtp_username` varchar(45) NOT NULL,
  `smtp_pass` varchar(45) NOT NULL,
  `smtp_auth` tinyint(4) NOT NULL DEFAULT '0',
  `smtp_port` varchar(45) NOT NULL,
  `from_email` varchar(45) NOT NULL,
  `from_name` varchar(45) NOT NULL,
  `to_email` varchar(45) NOT NULL,
  `to_name` varchar(45) NOT NULL,
  `google_analytics` text NOT NULL,
  `google_verification` text,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `enterprise_settings`
--

INSERT INTO `enterprise_settings` (`settings_id`, `username`, `password`, `use_smtp`, `smtp_host`, `smtp_username`, `smtp_pass`, `smtp_auth`, `smtp_port`, `from_email`, `from_name`, `to_email`, `to_name`, `google_analytics`, `google_verification`) VALUES
(1, 'admin', 'fe703d258c7ef5f50b71e06565a65aa07194907f', 1, 'mail.s177138.gridserver.com', 'mailer@starfi.sh', '123Mana!', 1, '25', '', '', 'raymart.marasigan@gmail.com', 'Raymart Marasigan', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `image_title` varchar(250) NOT NULL,
  `image_caption` varchar(500) NOT NULL DEFAULT 'Place caption here.',
  `filename` varchar(120) NOT NULL,
  `filename_ext` varchar(4) NOT NULL,
  `path` text NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sorting_number` int(11) NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `fk_images_album_id` (`album_id`),
  KEY `fk_images_size_id` (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `album_id`, `size_id`, `image_title`, `image_caption`, `filename`, `filename_ext`, `path`, `date_created`, `sorting_number`) VALUES
(27, 6, 9, 'Default Title.', 'Default image caption.', 'download.jpg', 'jpg', '55814893ab81a697.jpg', '2015-06-17 10:14:43', 0),
(29, 6, 9, 'Default Title.', 'Default image caption.', '11003_1632137560354581_2696532758174898502_n.jpg', 'jpg', '5581512a0300d92.jpg', '2015-06-17 10:51:23', 0),
(30, 7, 10, 'Default Title.', 'Default image caption.', 'Night-skyscrapers.jpg', 'jpg', '558151f32d457652.jpg', '2015-06-17 10:54:46', 0),
(31, 8, 11, 'Default Title.', 'Default image caption.', 'about-us-banner.jpg', 'jpg', '559f6716e10e1114.jpg', '2015-07-10 06:32:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(200) NOT NULL,
  `job_description` text,
  `date_created` int(11) DEFAULT NULL,
  `job_permalink` varchar(200) DEFAULT NULL,
  `is_published` tinyint(1) DEFAULT NULL,
  `email_receiver` varchar(250) DEFAULT NULL,
  `priority_number` int(11) DEFAULT NULL,
  `job_metadata` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_title`, `job_description`, `date_created`, `job_permalink`, `is_published`, `email_receiver`, `priority_number`, `job_metadata`) VALUES
(26, 'OFFSHORE - LIFTBOATS : All ranks', '<p>EXPERIENCED LIFTBOAT CREW ALL RANKS</p>\r\n\r\n<p>We are in process of expanding our pool of &nbsp;offshore crew WITH LIFT BOAT experience for delivery of two lift boats operating in the Arabian Gulf.&nbsp;</p>\r\n\r\n<p>Competitive rates, Officers 70 days on/off, Ratings 70 days on/35 days off.</p>\r\n\r\n<p>All offshore crew with experience on liftboats are invited to apply. &nbsp;Selected candidates may be called in for interview with Principal in June.</p>\r\n\r\n<p>For more details contact Capt Rene Ranara : 0920 9163106</p>\r\n', 1398129462, 'offshore-liftboats', 1, 'reneranara@aviormarine.com,apply.aviormarine@gmail.com', 7, 'crew for offshore liftboats'),
(27, 'LPG Tanker (4045 T) China - PH Trade', '<p>FOR LPG TANKER (4045TS) WITH REGULAR PORTCALLS IN PHILIPPINES</p>\r\n\r\n<p>Regular openings for CE and Capt with at least 6 months LPG experience</p>\r\n\r\n<p>For June dispatch from port in the Philippines 4th Eng and Oiler with at least 6 months LPG experience</p>\r\n\r\n<p>Officers &amp; Crew with LPG experience in domestic trade are also invited to apply.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1398134421, 'lpg-tanker', 1, 'seatrans@aviormarine.com,reneranara@aviormarine.com,apply.aviormarine@gmail.com', 5, 'crew for lpg tanker'),
(28, 'Bulk Carrier ', '<p>MASTER ($8300) CHIEF ENG ($8200) CHIEF OFFICER AND 2ND ENGINEER ($6500)</p>\r\n\r\n<p>For our fleet of moden bulkcarriers (Panamax, Camsamax, Handy Max (wood)</p>\r\n\r\n<p>Master /Chief Officer must have at leaset have 24 months Experience in rank on bulk carrier.</p>\r\n\r\n<p>Chief Engineer and 2nd Engineer must have at least 24 months expereince with large two stroke engines</p>\r\n\r\n<p>Benefits :&nbsp;8 month contract, signing bonus, rejoiner bonus, cash advance.</p>\r\n', 1398135156, 'bulk', 1, 'joey.paz@aviormarine.com,apply.aviormarine@gmail.com,bulk@aviormarine.com', 4, 'crew for bulk carrier'),
(32, 'Small Reefers (phil trade - SE Asia)', '<p>We have regular openings for Officers and &quot;icemen&quot; on board small reefer ships (4000-10000 Ts) with regular port calls in General Santos city. For more details pls contact Ms Elika Andrada : tel : 843-3277 ext 126 or email : elika.andrada@aviormarine.com.</p>\r\n\r\n<p>Especially Officers with experience on domestic reefer or fishing fleet are invited to apply.</p>\r\n', 1402635871, 'small-reefers-crew', 1, 'daeil@aviormarine.com,apply.aviormarine@gmail.com', 1, 'crew for small reefer ships'),
(35, 'TUGS ASD Captains & Chief Officers', '<p>For a renowned wordwide operator of Azimuth Stern Drive Tugs we are pooling Captains and Chief Offiers with a minimum of 1.5 years of experience in ASD tugs and experience in &quot;Static towing&quot;, &quot;Tow back&quot; and &quot;General supply&quot;.</p>\r\n\r\n<p>Selected candidates will be requested for interview with operator in January. Very good terms and wages. Good prospect for long term employment.</p>\r\n', 1418287680, 'tugs-asd', 0, 'apply.aviormarine@gmail.com,info@aviormarine.com', 3, 'vacancies Tug'),
(36, 'OSV seismic survey', '<p>For a new offshore project starting in April/May we are looking for Captain, Chief Officer, 2nd Officer, Chief Engineer, 2nd Engineer, 3rd Engineer, AB and Cook. Attractrive Salary and benefits are offered.</p>\r\n\r\n<p>Applicants with experience on Offshore Support Vessels (seismic survey) will be given priority.</p>\r\n\r\n<p>For more information contact : Capt Rene Ranara - cell 0919-8263460</p>\r\n', 1423186313, 'vacancy-offshore-seismic-survey-vessel', 1, 'apply.aviormarine@gmail.com,offshore@aviormarine.com,reneranara@aviormarine.com', 2, 'Vacany offshore seismic survey vessel'),
(37, 'APPLY ON LINE (all functions)', '<p>If you wish to apply for any vacancy you can click below to complete the on line application process. Be sure to enter all seaservice starting with most recent service first. Thanks for applying.</p>\r\n', 1430730926, 'apply-on-line', 1, 'apply.aviormarine@gmail.com,jes.agabayani@aviormarine.com', 6, 'apply on line vacancies at sea');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `route_id` int(11) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_description` text NOT NULL,
  `is_publish` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` int(11) NOT NULL,
  `date_modified` int(11) NOT NULL,
  `metadata` varchar(250) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `product_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `metadata` varchar(250) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  PRIMARY KEY (`product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE IF NOT EXISTS `route` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `permalink` varchar(500) NOT NULL,
  `page_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`route_id`),
  UNIQUE KEY `permalink_UNIQUE` (`permalink`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `permalink`, `page_id`) VALUES
(1, 'test-article-disrector-1a', NULL),
(2, 'test-article-director-2', 'articles'),
(3, 'test-article-director-3', 'articles'),
(4, 'test-article-director-4', 'articles'),
(5, 'test-article-director-5', 'articles'),
(6, 'test-article-director-6', 'articles'),
(8, 'test-article-director-8', 'articles'),
(9, 'test-article-director-9', 'articles'),
(11, 'test-article-director-11', 'articles'),
(12, 'test-article-director-12', 'articles'),
(13, 'test-article-director-13', 'articles'),
(14, 'test-article-director-14', 'articles'),
(15, 'test-article-director-15', 'articles'),
(16, 'test-article-director-16', 'articles'),
(17, 'test-article-director-17', 'articles'),
(18, 'test-article-director-18', 'articles'),
(19, 'test-article-director-19', 'articles'),
(20, 'test-article-director-20', 'articles'),
(21, 'test-article-design-21', 'articles'),
(22, 'test-article-design-22', 'articles'),
(23, 'test-article-design-23', 'articles'),
(24, 'test-article-design-24', 'articles'),
(25, 'test-article-design-25', 'articles'),
(26, 'test-article-design-26', 'articles'),
(27, 'test-article-design-27', 'articles'),
(29, 'test-article-design-29', 'articles'),
(31, 'dghfghfg', 'article'),
(32, 'testsdf', 'article'),
(33, 'campaign-1', 'article'),
(34, 'campaign-2', 'article'),
(35, 'jhgjhg', 'article'),
(36, 'surf', 'article'),
(37, 'test-member-1', 'team'),
(38, 'award-1', 'credentials'),
(39, 'fish-1', 'product'),
(40, 'fish-2', 'product'),
(41, 'fish-3', 'product'),
(42, 'test-pacific-product-1', 'pacific'),
(44, 'test-pacific-product-3', 'pacific'),
(45, 'test-news-1', 'news'),
(46, 'test-news-2', 'news'),
(47, 'test-recipe-1', 'recipes'),
(48, 'test-article-last', 'articles'),
(49, 'mayumi-hayakawa-marcelo', 'members'),
(50, 'noey-villasabas', 'members'),
(51, 'peninsula', 'hotels'),
(52, 'fairmont', 'hotels');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_image_sizes`
--
ALTER TABLE `album_image_sizes`
  ADD CONSTRAINT `album_image_sizes_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
