-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2018 at 04:06 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guset_comment`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment_detail`
--

CREATE TABLE `comment_detail` (
  `comment_id` int(8) NOT NULL,
  `encode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_save` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token_save` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio11` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment11` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio12` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment12` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio13` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment13` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio21` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment21` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio22` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment22` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio23` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment23` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio24` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment24` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio31` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment31` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio310` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment310` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio311` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment311` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio312` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment312` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio32` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment32` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio33` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment33` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio34` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment34` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio35` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment35` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio36` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment36` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio37` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment37` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio38` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment38` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio39` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment39` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio41` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment41` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio42` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment42` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio51` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment51` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio52` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment52` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `radio53` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment53` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Today` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_detail`
--

INSERT INTO `comment_detail` (`comment_id`, `encode`, `num_save`, `token_save`, `radio11`, `comment11`, `radio12`, `comment12`, `radio13`, `comment13`, `radio21`, `comment21`, `radio22`, `comment22`, `radio23`, `comment23`, `radio24`, `comment24`, `radio31`, `comment31`, `radio310`, `comment310`, `radio311`, `comment311`, `radio312`, `comment312`, `radio32`, `comment32`, `radio33`, `comment33`, `radio34`, `comment34`, `radio35`, `comment35`, `radio36`, `comment36`, `radio37`, `comment37`, `radio38`, `comment38`, `radio39`, `comment39`, `radio41`, `comment41`, `radio42`, `comment42`, `radio51`, `comment51`, `radio52`, `comment52`, `radio53`, `comment53`, `firstname`, `lastname`, `telephone`, `email`, `Today`) VALUES
(1, '4250GAAA', '1', 'J2BQvK5KF5aNTmBku2kFSaI90IU74D31RAqTg7IE', 'Yes', 'TEST Comment', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Thitipong', 'Inlom', '0864633160', 'ingnice007@gmail.com', '2018-08-23 09:57:50'),
(2, '4250GAAA', '2', 'xIKzJ3G1zvgWlerKKW9Cg2FPoxF5nMLKfrjTV3Do', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'test', 'test', '0864633160', 'ingnice007@gmail.com', '2018-08-24 13:08:05'),
(3, '4250GAAA', '3', 'xIKzJ3G1zvgWlerKKW9Cg2FPoxF5nMLKfrjTV3Do', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Thitipong', 'Inliom', '0864633160', 'ingnice007@gmail.com', '2018-08-24 13:12:04'),
(4, 'Thitipong_Inlom', '1', 'xIKzJ3G1zvgWlerKKW9Cg2FPoxF5nMLKfrjTV3Do', 'No', '', 'No', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', 'No', '', 'Yes', '', 'Yes', '', 'No', '', 'ฐิติพงษ์', 'อินลม', '+66852884978', 'ingnice009@hotmail.com', '2018-08-24 13:12:48'),
(5, 'Thanachart', '1', 'GQq1feGCWZiRrXLBoFhSR8rEUjSCHVySIgiJGY02', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'Yes', '1', 'test', 'test', 'tt', 't', '2018-08-25 11:13:36'),
(6, 'Thitipong_Inlom', '2', 'rZ8W0s0Tl22UNDXOkCdDveelUuO3WFnNBCZyJ0Xb', 'Yes', '11', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'No', '', 'Yes', '', 'Yes', '', 'Yes', '', '12', '123', '21', '123', '2018-08-25 14:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `create_link`
--

CREATE TABLE `create_link` (
  `link_id` int(8) NOT NULL,
  `link_create` date NOT NULL,
  `link_room` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link_group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_staying_from` date NOT NULL,
  `link_staying_to` date NOT NULL,
  `link_encode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_gust_in` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_th` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `create_link`
--

INSERT INTO `create_link` (`link_id`, `link_create`, `link_room`, `link_group_name`, `link_staying_from`, `link_staying_to`, `link_encode`, `link_gust_in`, `link_en`, `link_th`) VALUES
(1, '2018-08-10', 'Fidella', 'Nice', '2018-08-09', '2018-08-10', '4250GAAA', '200', '/en/4250GAAA', '/th/4250GAAA'),
(2, '2018-08-10', 'Fidella', 'Thitipong Inlom', '2018-08-10', '2018-08-11', 'Thitipong_Inlom', '300', '/en/Thitipong_Inlom', '/th/Thitipong_Inlom'),
(3, '2018-08-23', 'Fidella', 'test1', '2018-08-26', '2018-08-28', 'test1', '30', '/en/test1', '/th/test1'),
(4, '2018-08-23', 'Fidella', 'Thanachart', '2018-08-26', '2018-08-27', 'Thanachart', '50', '/en/Thanachart', '/th/Thanachart'),
(5, '2018-08-25', 'Fidella', 'Test2', '2018-08-25', '2018-08-26', 'Test2', '10', '/en/Test2', '/th/Test2'),
(6, '2018-08-25', 'Fidella', 'Test3', '2018-08-25', '2018-08-26', 'Test3', '10', '/en/Test3', '/th/Test3'),
(8, '2018-08-25', 'Fidella', 'test4', '2018-08-25', '2018-08-26', 'test4', 'test4', '/en/test4', '/th/test4');

-- --------------------------------------------------------

--
-- Table structure for table `head_query`
--

CREATE TABLE `head_query` (
  `id` int(10) UNSIGNED NOT NULL,
  `head_id_sub` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `head_query`
--

INSERT INTO `head_query` (`id`, `head_id_sub`, `lang`, `detail`) VALUES
(1, '1', 'en', 'The Sales Team'),
(2, '1', 'th', 'ทีมขาย'),
(3, '2', 'en', 'Upon Arrival'),
(4, '2', 'th', 'เมื่อเดินทางมาถึง'),
(5, '3', 'en', 'The Function'),
(6, '3', 'th', 'ฟังก์ชั่น'),
(7, '4', 'en', 'The Guest Rooms'),
(8, '4', 'th', 'ห้องพัก'),
(9, '5', 'en', 'The Departure'),
(10, '5', 'th', 'ขาออก');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(8) NOT NULL,
  `room_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_name`) VALUES
(1, 'Fidella'),
(2, 'Fineen'),
(3, 'Fauna'),
(4, 'Falvio'),
(5, 'Tempara'),
(6, 'Magenta');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `Setting_id` int(10) UNSIGNED NOT NULL,
  `Setting_head` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Setting_land` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Setting_detail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`Setting_id`, `Setting_head`, `Setting_land`, `Setting_detail`) VALUES
(1, 'title_web', 'en', 'The Zign Hotel Pattaya'),
(2, 'head_form', 'en', 'Organizer/Group Leader Questionnaire'),
(3, 'title_web', 'th', 'โรงแรมเดอะ ซายน์'),
(4, 'head_form', 'th', 'แบบสอบถามผู้นำองค์กร / กลุ่ม'),
(5, 'foot_form', 'en', 'l\'d like to thank you on behalf of our Management for you feedback and cooperation which we\'ll use to improve our'),
(6, 'foot_form', 'th', 'ในนามของฝ่ายบริหารขอขอบพระคุณสำหรับแบบสอบถาม ทางโรงแรมจะนำไปปรับปรุงเพื่อบริการที่ดียิ่งขึ้น');

-- --------------------------------------------------------

--
-- Table structure for table `sup_query`
--

CREATE TABLE `sup_query` (
  `id` int(8) NOT NULL,
  `head_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sup_num` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sup_query`
--

INSERT INTO `sup_query` (`id`, `head_id`, `lang`, `sup_num`, `query`) VALUES
(1, '1', 'en', '1', 'Has the responsible sales team member been pro-actively supporting you with useful information ?'),
(2, '1', 'th', '1', 'พนักงานฝ่ายขายที่รับผิดชอบหรือติดต่อกับท่านได้ให้การบริการและสนับสนุนในเรื่องของข้อมูลที่เป็นประโยชน์ต่อท่านอย่างกระตือรือร้นหรือไม่ ?'),
(3, '1', 'en', '2', 'Have your inquiries been replied within 24 hours ?'),
(4, '1', 'th', '2', 'หลังจากที่ท่านมีข้อสอบถาม พนักงานฝ่ายขายได้ติดต่อกลับท่านภายใน 24 ชั่วโมงหรือไม่ ?'),
(5, '1', 'en', '3', 'Has discussed information been passed on to the team at the resort without missing any details ?'),
(6, '1', 'th', '3', 'ข้อมูลและรายละเอียดต่างๆที่ได้รับจากท่านได้มีการสื่อสารไปยังทีมงานที่ประจำอยู่ที่โรงแรมหรือไม่ ?'),
(7, '2', 'en', '1', 'Were you introduced to essential contacts such as the Sales Co-coordinator and the Management ?'),
(8, '2', 'th', '1', 'ท่านได้รับการแนะนำให้รู้จักบุคคลต่างๆที่ต้องติดต่อด้วย เช่น ผู้ประสานงานฝ่ายขายและทีมงานบริหารหรือไม่ ?'),
(9, '2', 'en', '2', 'Has everyone been greeted and hearty welcomed with a cold towel and a welcome drink ?'),
(10, '2', 'th', '2', 'ท่านได้รับการต้อนรับอย่างอบอุ่นพร้อมทั้งผ้าเย็นและเครื่องดื่มต้อนรับหรือไม่ ?'),
(11, '2', 'en', '3', 'Was the check-in process smoothly and fast ?'),
(12, '2', 'th', '3', 'ขั้นตอนการลงทะเบียนเข้าพักเป็นไปอย่างราบรื่นและรวดเร็วหรือไม่ ?'),
(13, '2', 'en', '4', 'Has the luggage been delivered promptly ?'),
(14, '2', 'th', '4', 'กระเป๋าเดินทางได้ถูกจัดส่งไปยังห้องพักในเวลาอันรวดเร็วหรือไม่ ?'),
(15, '3', 'en', '1', 'Have you been invited for an inspection of the function area well before the event began ?'),
(16, '3', 'th', '1', 'ท่านได้รับการเชื้อเชิญให้ทำการตรวจเช็คสถานที่จัดเลี้ยงหรือสัมมนาก่อนงานเริ่มหรือไม่ ?'),
(17, '3', 'en', '2', 'Was the function area prepared as per discussed requirements ?'),
(18, '3', 'th', '2', 'สถานที่จัดเลี้ยงหรือสัมมนาได้มีการจัดเตรียมตามที่ได้ตกลงไว้หรือไม่ ?'),
(19, '3', 'en', '3', 'Were the flowers fresh and nicely presented ?'),
(20, '3', 'th', '3', 'ดอกไม้ที่จัดให้เป็นดอกไม้สดและจัดอย่างสวยงามหรือไม่ ?'),
(21, '3', 'en', '4', 'Was there an engineer visibly on stand-by during the entire function ?'),
(22, '3', 'th', '4', 'พนักงานแผนกช่างมีประจำอยู่ระหว่างงานจัดเลี้ยงหรือสัมมนาหรือไม่ ?'),
(23, '3', 'en', '5', 'Have all audio/visual installations worked properly ?'),
(24, '3', 'th', '5', 'ระบบโสตทัศนอุปกรณ์ทำงานเป็นปกติหรือไม่ ?'),
(25, '3', 'en', '6', 'Was the air-condition set and workiong properly ?'),
(26, '3', 'th', '6', 'ระบบเครื่องปรับอากาศทำงานเป็นปกติหรือไม่ ?'),
(27, '3', 'en', '7', 'Was the food ready on time ?'),
(28, '3', 'th', '7', 'อาหารจัดเตรียมตรงตามเวลาหรือไม่ ?'),
(29, '3', 'en', '8', 'Was the food nicely presented ?'),
(30, '3', 'th', '8', 'อาหารมีการจัดวางอย่างสวยงามหรือไม่ ?'),
(31, '3', 'en', '9', 'Was the food fresh and tasty ?'),
(32, '3', 'th', '9', 'อาหารมีความสดและรสชาดเป็นที่พอใจหรือไม่ ?'),
(33, '3', 'en', '10', 'Was there enough food and empty items (buffet) rdfilled ?'),
(34, '3', 'th', '10', 'อาหารเพียงพอและมีการเติมใหม่ในอาหารที่หมดทดแทนหรือไม่ ?'),
(35, '3', 'en', '11', 'Was the beverage service efficient and always present ?'),
(36, '3', 'th', '11', 'การบริการเครื่องดื่มเป็นไปอย่างมีประสิทธิภาพและต่อเนื่องหรือไม่ ?'),
(37, '3', 'en', '12', 'Was the service staff smiling ?'),
(38, '3', 'th', '12', 'พนักงานบริการยิ้มแย้มหรือไม่ ?'),
(39, '4', 'en', '1', 'Were the rooms clean and everything arranged neatly ?'),
(40, '4', 'th', '1', 'ห้องพักสะอาดและมีการจัดเตรียมทุกอย่างเรียบร้อยหรือไม่ ?'),
(41, '4', 'en', '2', 'Have special requests through Housekeeping been fulfilled immediately ?'),
(42, '4', 'th', '2', 'เมื่อมีการร้องขอสิ่งที่ต้องการพิเศษผ่านทางแผนกแม่บ้านท่านได้รับการตอบสนองโดยทันทีหรือไม่ ?'),
(43, '5', 'en', '1', 'Was the check-out process handled in timely manner ?'),
(44, '5', 'th', '1', 'ขั้นตอนการเช็คเอาท์ เป็นไปอย่างรวดเร็วหรือไม่ ?'),
(45, '5', 'en', '2', 'Were all the bills correct and on time ?'),
(46, '5', 'th', '2', 'ท่านได้รับใบเสร็จที่ถูกต้อง และ รวดเร็วหรือไม่ ?'),
(47, '5', 'en', '3', 'Was the luggage brought down in a timely manner ?'),
(48, '5', 'th', '3', 'กระเป๋าเดินทางของท่านได้จัดส่งลงมาอย่างรวดเร็วหรือไม่ ?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Thitipong Inlom', 'ingnice007@gmail.com', 'nice', '$2y$10$V8OnXIkxvtKvIXGHPq9hIep0uWCURTQAMxa.urGSDFtpr.YqkMIBy', '0', 'YhWG6WZSz6GU54AFClKgl6Q3y5hQ3JiENHPaqVTzhhOwKHBVP9KRbxIArVmH', '2018-08-18 09:16:08', '2018-08-27 20:54:12'),
(2, 'staff', '-', 'staff', '$2y$10$q2W.JJ4v7bpBB9jf4Q3ck.XnTaDK7os4MpKWsNwiY2zs69J72iw5m', '1', 'cx4bgPg9SuDP1kCIaESdVJLqZ4shTGONJdEL9neV1DV8CttPP6MfH8ML1XAD', '2018-08-27 20:52:21', '2018-08-27 20:52:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_detail`
--
ALTER TABLE `comment_detail`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `create_link`
--
ALTER TABLE `create_link`
  ADD PRIMARY KEY (`link_id`);

--
-- Indexes for table `head_query`
--
ALTER TABLE `head_query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`Setting_id`);

--
-- Indexes for table `sup_query`
--
ALTER TABLE `sup_query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment_detail`
--
ALTER TABLE `comment_detail`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `create_link`
--
ALTER TABLE `create_link`
  MODIFY `link_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `head_query`
--
ALTER TABLE `head_query`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `Setting_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sup_query`
--
ALTER TABLE `sup_query`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
