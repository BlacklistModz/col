-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2017 at 07:29 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `col`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assess_report`
--

CREATE TABLE `tbl_assess_report` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `ass_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_assess_report`
--

INSERT INTO `tbl_assess_report` (`id`, `topic`, `ass_status`) VALUES
(1, 'กิตติกรรมประกาศ (Acknowledgement)', 0),
(2, 'บทคัดย่อ (Abstract)', 0),
(3, 'สารบัญ สารบัญรูป และสารบัญตาราง (Table of Contents)', 0),
(4, 'วัตถุประสงค์ (Objectives)', 0),
(5, 'บทที่ 1 บทนํา (Introduction)', 0),
(6, 'บทที่ 2 ปัญหาและขอบเขต (Problem and Scope)', 0),
(7, 'บทที่ 3 การวิเคราะห์และออกแบบ (Analysis and Design)', 0),
(8, 'บทที่ 4 ต้นแบบและการพัฒนา (Prototype and Implementation)', 0),
(9, 'บทที่ 5 บทสรุปและข้อเสนอแนะ (Conclusion and Recommendation)', 0),
(10, 'สํานวนการเขียน และการสื่อความหมาย (Idiom and Meaning)', 0),
(11, 'ความถูกต้องตัวสะกด (Spelling)', 0),
(12, 'รูปแบบ และความสวยงาม ของรูปเล่ม (Pattern)', 0),
(13, 'เอกสารอ้างอิง (References)', 0),
(14, 'ภาคผนวก (Appendix)', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assess_sub`
--

CREATE TABLE `tbl_assess_sub` (
  `id` int(11) NOT NULL,
  `ass_id` int(11) NOT NULL,
  `sub_topic` varchar(255) NOT NULL,
  `sub_detail` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_assess_sub`
--

INSERT INTO `tbl_assess_sub` (`id`, `ass_id`, `sub_topic`, `sub_detail`) VALUES
(1, 1, 'ปริมาณงาน (Quantity of Work)', 'ปริมาณงานที่ปฏิบัติสำเร็จตามหน้าที่หรือตามที่ได้รับมอบหมายภายในระยะเวลาที่กำหนด\r\n(ในระดับที่นักศึกษาจะปฏิบัติได้) และเทียบกับนักศึกษาทั่ว ๆ ไป'),
(2, 1, 'คุณภาพงาน (Quality of Work)', 'ทํางานไดถูกตองครบถวนสมบูรณมีความปราณีตเรียบรอย มีความรอบคอบ\r\nไมเกิดปญหาติดตามมา งานไมคาง ทํางานเสร็จทนเวลาหรือกอนเวลาที่กําหนด'),
(3, 2, 'ความรูความสามารถทางวิชาการ (Academic Ability)', 'นักศึกษามีความรู้ทางวิชาการเพียงพอ ที่จะทำงานตามที่ได้รับมอบหมาย\r\n(ในระดับที่นักศึกษาจะปฏิบัติได้)'),
(4, 2, 'ความสามารถในการเรียนรู้และประยุกตวิชาการ (Ability to Learn and Apply Knowledge)', 'ความรวดเร็วในการเรียนรูเขาใจขอมูล ขาวสารและวิธีการทํางาน ตลอดจนการนําความรูไปประยุกตใชงาน'),
(5, 2, 'ความรูความชํานาญด้านปฏิบัติการ (Practical Ability)', 'เชน การปฏิบัติงานในภาคสนาม ในหองปฏิบัติการ'),
(6, 2, 'วิจารณญาณและการตัดสินใจ (Judgement and Decision Making)', 'ตัดสินใจไดดีถูกตอง รวดเร็ว มีการวิเคราะหขอมูลและปญหาต่างๆ อยางรอบคอบ\r\nกอนการตัดสินใจ สามารถแกปญหาเฉพาะหนา สามารถไววางใจใหตัดสินใจไดดวยตนเอง'),
(7, 2, 'การจัดการและวางแผน (Management and Planning)', ''),
(8, 2, 'ทักษะการสื่อสาร (Communication Skills)', 'ความสามารถในการติดต่อสื่อสาร การพูด การเขียน และการนำเสนอ (Presentation)\r\nสามารถสื่อสารให้เข้าใจง่าย เรียบร้อย ชัดเจน ถูกต้อง รัดกุม มีลำดับขั้นตอนที่ดี\r\nไม่ก่อให้เกิดความสับสนต่อการทำงาน รู้จักสอบถาม รู้จักชี้แจงผลการปฏิบัติงานและข้อขัดข้องให้ทราบ'),
(9, 2, 'การพัฒนาดานภาษาและวัฒนธรรมตางประเทศ (Foreign Language and Cultural  Development)', 'เชน ภาษาอังกฤษ การทํางานกับชาวตางชาติ\r\n(ประเมินเฉพาะสถานประกอบการที่มีชาวต่างชาติ หรือที่ใช้ภาษาต่างประเทศในการติดต่อสื่อสาร)'),
(10, 2, 'ความเหมาะสมตอตําแหนงงานที่ไดรับมอบหมาย (Suitability for Job Position)', 'สามารถพัฒนาตนเองให้ ปฏิบัติงานตาม Job Position และ Job Description ที่มอบหมายไดอยางเหมาะสม\r\nหรือตำแหน่งงานนี้เหมาะสมกับนักศึกษาคนนี้หรือไม่เพียงใด'),
(11, 3, 'ความรับผิดชอบและเปนผูที่ไววางใจได  (Responsibility and Dependability)', 'ดําเนินงานใหสําเร็จลุลวงโดยคำนึงถึงเป้าหมายและความสำเร็จของงานเป็นหลัก\r\nยอมรับผลที่เกิดจากการทำงานอย่างมีเหตุผล สามารถปล่อยให้ทำงาน (กรณีงานประจำ)\r\nได้โดยไม่ต้องควบคุมมากจนเกินไป ความจำเป็นในการตรวจสอบขั้นตอนและผลงานตลอดเวลา\r\nสามารถไว้วางใจให้รับผิดชอบงานที่มากกว่าเวลาประจำ สามารถไว้วางไว้ได้แทบทุกสถานการณ์\r\nหรือในสถานการณ์ปกติ'),
(12, 3, 'ความสนใจ อุตสาหะในการทํางาน (Interest in Work)', 'ความสนใจและความกระตือรือรนในการทํางาน มีความอุตสาหะ ความพยายาม\r\nความตั้งใจที่จะทำงานได้สำเร็จ ความมานะบากบั่น ไม่ย่อท้อต่ออุปสรรคและปัญหา'),
(13, 3, 'ความสามารถเริ่มตนทํางานไดดวยตนเอง (Initiative or Self Starter)', 'เมื่อได้รับคำชี้แนะ สามารถเริ่มทำงานได้เอง โดยไม่ต้องรอคำสั่ง (กรณีงานประจำ) เสนอตัวเข้าช่วยงานแทบทุกอย่าง มาขอรับงานใหม่ๆ ไปทำ ไม่ปล่อยเวลาว่างให้ล่วงเลยไปโดยเปล่าประโยชน์'),
(14, 3, 'การตอบสนองตอการสั่งการ (Response to Supervision)', 'ยินดีรับคำสั่ง คำแนะนำ คำวิจารณ์ ไม่แสดงความอึดอัดใจ เมื่อได้รับคำติเตือนและวิจารณ์\r\nความรวดเร็วในการปฏิบัติตามคำสั่ง การปรับตัวปฏิบัติตามคำแนะนำ ข้อเสนอแนะและวิจารณ์'),
(15, 4, 'บุคลิกภาพและการวางตัว (Personality)', 'มีบุคลิกภาพและวางตัวไดเหมาะสม เชน ทัศนคติวุฒิภาวะ ความออนนอมถอมตน\r\nการแตงกายกิริยาวาจาการตรงตอเวลาและอื่น ๆ'),
(16, 4, 'มนุษยสัมพันธ (Interpersonal Skills)', 'สามารถรวมงานกับผูอื่น การทางานเป็นทีม สรางมนุษยสมพันธ์ไดดี เปนที่รักใคร่\r\nชอบพอของผูรวมงาน เปนผูที่ชวยกอใหเกิดความร่วมมือประสานงาน'),
(17, 4, 'ความมีระเบียบวินัย ปฏิบัติตามวัฒนธรรมขององค์กร (Discipline And Adaptability to Formal Organization)', 'ความสนใจเรียนรู้ ศึกษากฏระเบียบ นโยบาย ต่าง ๆ และปฏิบัติตามโดยเต็มใจ\r\nการปฏิบัติตามระเบียบบริหารงานบุคคล (การเข้างาน ลางาน) ปฏิบัติตามกฏการรักษา\r\nความปลอดภัยในโรงงาน การควบคุมคุณภาพ 5 ส และอื่นๆ'),
(18, 4, 'คุณธรรมและจริยธรรม (Ethics and Morality)', 'มีความซื่อสัตย์ สุจริต มีจิตใจสะอาด รู้จักเสียสละ ไม่เห็นแก่ตัว เอื้อเฟื้อช่วยเหลือผู้อื่น'),
(19, 5, 'ไดประโยชนจากผลงานของนักศึกษาที่ไปปฏิบัติงาน (Benefits from student’s work)', ''),
(20, 5, 'มีโอกาสคัดเลือดพนักงานจริง (Employee recruitment)', ''),
(21, 5, 'มีโอกาสสร้างความร่วมมือทางวิชาการกับมหาวิทยาลัยในอนาคต (Further academic co-operation with the university)', ''),
(22, 6, 'การนิเทศกงานของอาจารย์มีประโยชน์ต่อการปฏิบัติงานของนักศึกษาและสถานประกอบการ (Student supervision by co-op Advisor provides benefits to student’s work and company)', ''),
(23, 6, 'จำนวนครั้งที่อาจารย์มานิเทศก์มีความเพียงพอ (The time of student supervision by co-op Advisor is efficient to the requirement company)', ''),
(24, 6, 'คุณภาพการนิเทศก์งานสหกิจศึกษาของอาจารย์ (Quality of student supervision by co-op Advisor)', ''),
(25, 7, 'ความพึงพอใจต่อการให้บริการ/ประสานงานกับสาขาวิชาฯ', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assess_work`
--

CREATE TABLE `tbl_assess_work` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `ass_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_assess_work`
--

INSERT INTO `tbl_assess_work` (`id`, `topic`, `ass_status`) VALUES
(1, 'ผลสําเร็จของงาน/Work Achievement', 0),
(2, 'ความรูความสามารถ/Knowledge and Ablility', 0),
(3, 'ความรับผิดชอบตอหนาที่/Responsibility', 0),
(4, 'ลักษณะสวนบุคคล/Personality', 0),
(5, 'สหกิจศึกษามีประโยชน์ต่อองค์กรของท่าน', 0),
(6, 'ข้อคิดเห็นต่อการนิเทศน์งานของอาจารย์', 0),
(7, 'ความพึงพอใจ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_authentication`
--

CREATE TABLE `tbl_authentication` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(24) NOT NULL,
  `name` varchar(64) NOT NULL,
  `status_id` int(11) NOT NULL,
  `picture` varchar(192) NOT NULL,
  `create_date` date NOT NULL,
  `accept_year_id` int(11) NOT NULL,
  `last_login` datetime NOT NULL,
  `IP_login` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_authentication`
--

INSERT INTO `tbl_authentication` (`id`, `username`, `password`, `name`, `status_id`, `picture`, `create_date`, `accept_year_id`, `last_login`, `IP_login`) VALUES
(1, 'admin', '123456', 'พชร นันทอาภา', 1, 'Profile_2017-08-18-15-17-12_5996a28857eb76.95578751.jpg', '2016-10-10', 0, '2017-08-28 20:21:40', '::1'),
(29, 'sombra', '1234', 'พชร นันทอาภา', 3, 'Profile_2016-11-03-14-17-47_581ae49b2582d8.27302092.PNG', '2016-11-03', 2, '2017-08-30 00:13:20', '::1'),
(30, '55122660114', '1234', 'พชร นันทอาภา', 4, 'Profile_2016-11-29-15-01-24_583d35d46d6135.42294741.JPG', '2016-11-03', 2, '2016-11-29 13:27:57', '223.204.208.220'),
(44, 'test1', '123456', 'Pachara Nuntharrpa', 0, 'Profile_2016-11-18-12-35-04_582e9308d3b3b7.00084064.jpg', '2016-11-18', 0, '0000-00-00 00:00:00', ''),
(45, 'xblacklistz', '123456789', 'พชร นันทอาภา', 3, 'Profile_2016-11-25-19-42-16_583831a87f8934.23667022.PNG', '2016-11-25', 2, '0000-00-00 00:00:00', ''),
(47, 'bigsofteng', '1234', 'จักรกฤษ แปงเมือง', 3, 'Profile_2016-11-28-12-17-53_583bbe012145e8.79269552.jpg', '2016-11-28', 3, '2016-11-28 13:12:46', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_corporation`
--

CREATE TABLE `tbl_corporation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_th` varchar(64) NOT NULL,
  `name_en` varchar(64) NOT NULL,
  `address` text NOT NULL,
  `province_id` int(11) NOT NULL,
  `zip_code` varchar(5) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `fax` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `business_type` varchar(32) NOT NULL,
  `emp_count` int(11) NOT NULL,
  `work_time` int(11) NOT NULL,
  `manager_name` varchar(64) NOT NULL,
  `mjob_position` varchar(32) NOT NULL,
  `major_require` varchar(32) NOT NULL,
  `stu_academic` text NOT NULL,
  `stu_features` text NOT NULL,
  `staff_name` varchar(64) NOT NULL,
  `sjob_position` varchar(32) NOT NULL,
  `division` varchar(32) NOT NULL,
  `tel` varchar(16) NOT NULL,
  `practice_start` varchar(2) NOT NULL,
  `practice_end` varchar(2) NOT NULL,
  `compensation` text NOT NULL,
  `compensation_status` int(1) NOT NULL,
  `welfare` text NOT NULL,
  `update_date` date NOT NULL,
  `update_user` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `corp_select_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_corporation`
--

INSERT INTO `tbl_corporation` (`id`, `user_id`, `name_th`, `name_en`, `address`, `province_id`, `zip_code`, `phone`, `fax`, `email`, `business_type`, `emp_count`, `work_time`, `manager_name`, `mjob_position`, `major_require`, `stu_academic`, `stu_features`, `staff_name`, `sjob_position`, `division`, `tel`, `practice_start`, `practice_end`, `compensation`, `compensation_status`, `welfare`, `update_date`, `update_user`, `year_id`, `session_id`, `corp_select_status`) VALUES
(3, 29, 'Sombra Overwatch CO,Ltd', 'Sombra Overwatch CO,Ltd', 'ตามบัตรประชาชน', 1, '10120', '0888888888', '0888888888', 'blacklistmodz.ton@gmail.com', 'Software House', 4, 40, 'พชร นันทอาภา', 'ทำทุกอย่าง', 'วิศวกรรมซอฟต์แวร์,วิทยาการคอมพิว', '', '-> ขยัน\r\n-> มีความอดทน\r\n-> มีความเป็นผู้นำ', 'จักรกฤษ แปงเมือง', 'พนักงานขับรถ', 'ซ่อมบำรุง', '0992723554', '1', '4', '200', 0, '', '2016-11-03', 29, 1, '2cr5ssj4pdeo5qk8r03je4l9b3', 0),
(4, 29, 'Sombra Overwatch CO,Ltd', 'Sombra Overwatch CO,Ltd', '414 ม.4 ซ.3 ต.ท่าผา อ.เกาะคา', 40, '52130', '0888888888', '0888888888', 'gg@gg.com', 'Software House', 4, 40, 'พชร นันทอาภา', 'ทำทุกอย่าง', 'วิศวกรรมซอฟต์แวร์,วิทยาการคอมพิว', '', '-> ขยัน\r\n-> มีความอดทน\r\n-> มีความเป็นผู้นำ', 'จักรกฤษ แปงเมือง', 'พนักงานขับรถ', 'ซ่อมบำรุง', '0992723554', '1', '4', '200', 0, '', '2017-08-28', 29, 2, '', 0),
(8, 44, 'Hacking System OW LO,Ltd', '', '', 0, '', '088888888', '088888888', 'blacklistmodz.ton@gmail.com', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 0, 0, '1i7kas9es2b80tmlilnll9uof4', 0),
(10, 46, 'Smile IT Solution', '', '', 0, '', '0992723554', '992723554', 'bigsofteng@gmail.com1', '', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '0000-00-00', 0, 0, 'tof5c04c20nv053t0c199mc864', 0),
(11, 47, 'Smile', 'จักรกฤษ แปงเมือง', '204 หมู่ 11 ต.เสริมขวา\r\nอ.เสริมงาม', 40, '52210', '992723554', '992723554', 'bigsofteng@gmail.com', '์Network', 2, 2, 'จักรกฤษ แปงเมือง', 'นั้นสิ', '1234', '', '1234', 'จักรกฤษ แปงเมือง', 'นั้นสิ', 'อะไรนะ', '0992723554', '1', '6', '200', 0, '', '2016-11-28', 47, 0, 'tof5c04c20nv053t0c199mc864', 0),
(12, 47, 'Smile', 'จักรกฤษ แปงเมือง', '204 หมู่ 11 ต.เสริมขวา\r\nอ.เสริมงาม', 40, '52210', '992723554', '992723554', '', '์Network', 2, 2, 'จักรกฤษ แปงเมือง', 'นั้นสิ', '1234', '', '1234', 'จักรกฤษ แปงเมือง', 'นั้นสิ', 'อะไรนะ', '0992723554', '1', '6', '200', 0, '', '2016-11-28', 47, 2, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_corp_majors`
--

CREATE TABLE `tbl_corp_majors` (
  `corp_id` int(11) NOT NULL,
  `major_id` int(11) NOT NULL,
  `student_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_corp_majors`
--

INSERT INTO `tbl_corp_majors` (`corp_id`, `major_id`, `student_amount`) VALUES
(4, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_corp_welfare`
--

CREATE TABLE `tbl_corp_welfare` (
  `id` int(11) NOT NULL,
  `corp_id` int(11) NOT NULL,
  `wel_id` int(11) NOT NULL,
  `wel_type` int(1) NOT NULL,
  `wel_value` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_corp_welfare`
--

INSERT INTO `tbl_corp_welfare` (`id`, `corp_id`, `wel_id`, `wel_type`, `wel_value`) VALUES
(15, 4, 2, 1, ''),
(16, 4, 4, 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_document`
--

CREATE TABLE `tbl_document` (
  `id` int(11) NOT NULL,
  `doc_name` varchar(255) NOT NULL,
  `doc_file` varchar(100) NOT NULL,
  `doc_date` date NOT NULL,
  `upload_date` date NOT NULL,
  `doc_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_document`
--

INSERT INTO `tbl_document` (`id`, `doc_name`, `doc_file`, `doc_date`, `upload_date`, `doc_status`) VALUES
(1, 'ใบตอบรับนักศึกษาเข้าฝึกงาน', 'Doc_2016-11-08-21-53-19_5821e6df070aa4.52881034.pdf', '0000-00-00', '2016-11-08', 0),
(2, 'แบบแจ้งโครงร่างรายงานปฏิบัติงาน (SE-CO-007)', 'Doc_2016-10-30-17-03-17_5815c565aad843.09652043.pdf', '2017-01-31', '2016-11-07', 2),
(3, 'แบบแจ้งแผนปฏิบัติงานสหกิจศึกษา (SE-CO-008)', 'Doc_2016-10-30-17-06-09_5815c611209cc1.19391777.pdf', '2017-01-31', '2016-11-06', 0),
(4, 'บันทึกการปฏิบัติงานนักศึกษา เดือนที่ 1', 'Doc_2016-11-06-21-45-05_581f41f12ec5b2.09632250.pdf', '2017-02-06', '2016-11-07', 1),
(5, 'บันทึกการปฏิบัติงานนักศึกษา เดือนที่ 2', 'Doc_2016-11-06-21-45-27_581f4207e58587.09674679.pdf', '2017-03-06', '2016-11-07', 1),
(6, 'บันทึกการปฏิบัติงานนักศึกษา เดือนที่ 3', 'Doc_2016-11-06-21-45-44_581f4218a88e38.94732516.pdf', '2017-04-03', '2016-11-07', 1),
(7, 'บันทึกการปฏิบัติงานนักศึกษา เดือนที่ 4 (สุดท้าย)', 'Doc_2016-11-06-21-46-07_581f422fa8b8b5.26960351.pdf', '2017-05-08', '2016-11-07', 1),
(8, 'ส่งสมุดคู่มือ ฯ', 'Doc_2016-11-28-10-58-22_583bab5ebe7677.51507989.pdf', '2016-12-04', '2016-11-29', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_education`
--

CREATE TABLE `tbl_education` (
  `id` int(11) NOT NULL,
  `edu_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_education`
--

INSERT INTO `tbl_education` (`id`, `edu_name`) VALUES
(1, 'ประถมศึกษา'),
(2, 'มัธยมศึกษาตอนต้น'),
(3, 'มัธยมศึกษาตอนปลาย / ประกาศนียบัตรวิชาชีพ (ปวช.)'),
(4, 'ระดับปริญญาตรี');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`faculty_id`, `faculty_name`) VALUES
(1, 'เทคโนโลยีอุตสาหกรรม'),
(2, 'วิทยาศาสตร์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_infomation`
--

CREATE TABLE `tbl_infomation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `info_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_infomation`
--

INSERT INTO `tbl_infomation` (`id`, `name`, `detail`, `info_status`) VALUES
(1, 'หลักการและเหตุผล', '<h1>ทดสอบ หลักการและเหตุผล</h1><p></p><ol><li>ต้องมีวิสัยทัศน์ที่ดี<br></li><li>ต้องมีวินัย</li><li>ต้องมีชีวิต</li></ol><p></p>', 0),
(2, 'วัตถุประสงค์', '', 0),
(3, 'ความหมายของสหกิจศึกษา', '', 0),
(4, 'คุณสมบัติของนักศึกษาสหกิจศึกษา', '', 0),
(5, 'คุณสมบัติของสถานประกอบการ', '', 0),
(6, 'ลำดับขั้นตอนเอกสารสหกิจศึกษา', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_majors`
--

CREATE TABLE `tbl_majors` (
  `major_id` int(11) NOT NULL,
  `major_faculty_id` int(11) NOT NULL,
  `major_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_majors`
--

INSERT INTO `tbl_majors` (`major_id`, `major_faculty_id`, `major_name`) VALUES
(1, 1, 'วิศวกรรมซอฟต์แวร์'),
(2, 1, 'โยธา'),
(3, 2, 'คณิตศาสตร์'),
(4, 2, 'วิทยาศาสตร์');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` int(11) NOT NULL,
  `cate_id` int(1) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `short_detail` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  `news_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `cate_id`, `topic`, `short_detail`, `detail`, `create_date`, `update_date`, `news_status`) VALUES
(9, 2, 'ทดสอบแก้ไขรูปภาพ', '', 'ทดสอบ\r\nทดสอบ\r\nทดสอบ\r\nทดสอบ\r\nทดสอบ\r\nทดสอบ\r\nทดสอบ', '2016-11-18 16:08:47', '2016-11-25 15:27:14', 0),
(10, 1, 'ทดสอบข่าวประชาสัมพันธ์', 'ทดสอบข่าวประชาสัมพันธ์', '<p><b><u>ทดสอบข่าวประชาสัมพันธ์</u></b><br></p><p><b><u>ทดสอบข่าวประชาสัมพันธ์</u></b><br></p><p><b><u>ทดสอบข่าวประชาสัมพันธ์</u></b><br></p><p><b><u>ทดสอบข่าวประชาสัมพันธ์</u></b><br></p><p><b><u>ทดสอบข่าวประชาสัมพันธ์</u></b><br></p><p><br></p>', '2016-11-25 21:24:12', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_img`
--

CREATE TABLE `tbl_news_img` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_news_img`
--

INSERT INTO `tbl_news_img` (`id`, `news_id`, `img`) VALUES
(19, 9, 'News_2016-11-18-16-08-54_582ec526d0bbc8.66566178.jpg'),
(20, 9, 'News_2016-11-18-16-08-55_582ec527044765.56162335.jpg'),
(21, 9, 'News_2016-11-18-16-08-55_582ec527189e74.46690228.jpg'),
(22, 9, 'News_2016-11-18-16-08-55_582ec52724d363.60712519.jpg'),
(23, 9, 'News_2016-11-18-16-12-27_582ec5fb172a50.46770511.jpg'),
(24, 9, 'News_2016-11-18-16-12-27_582ec5fb56e333.52381760.gif'),
(26, 9, 'News_2016-11-18-16-12-27_582ec5fba08aa4.52959043.jpg'),
(27, 9, 'News_2016-11-18-16-17-05_582ec71131ffc7.20267609.png'),
(28, 10, 'News_2016-11-25-21-24-12_5838498c5f29f0.87423073.png'),
(29, 10, 'News_2016-11-25-21-24-12_5838498c6b4ef9.63841033.jpg'),
(30, 10, 'News_2016-11-25-21-24-12_5838498c717f87.25792667.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `id` int(11) NOT NULL,
  `corp_id` int(11) NOT NULL,
  `pos_name` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `stu_count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`id`, `corp_id`, `pos_name`, `job_description`, `stu_count`) VALUES
(1, 3, 'Programming', '-> พัฒนาโปรแกรมโดยใช้ C# , C++ , VB \r\n-> พัฒนาโดยใช้ฐานข้อมูล MS SQL', 4),
(2, 3, 'Website Programming', '-> พัฒนาเว็บไซต์โดยใช้ PHP , CSS3 , HTML5 , JQUERY\r\n-> พัฒนาโดยใช้ฐานข้อมูล MySQLi', 4),
(8, 4, 'Website Programming', '-> พัฒนาเว็บไซต์โดยใช้ PHP , CSS3 , HTML5 , JQUERY\r\n-> พัฒนาโดยใช้ฐานข้อมูล MySQLi', 4),
(35, 12, 'ทดสอบ', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_province`
--

CREATE TABLE `tbl_province` (
  `PROVINCE_ID` int(5) NOT NULL,
  `PROVINCE_CODE` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `PROVINCE_NAME` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `PROVINCE_NAME_ENG` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `GEO_ID` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_province`
--

INSERT INTO `tbl_province` (`PROVINCE_ID`, `PROVINCE_CODE`, `PROVINCE_NAME`, `PROVINCE_NAME_ENG`, `GEO_ID`) VALUES
(1, '10', 'กรุงเทพมหานคร   ', 'Bangkok', 2),
(2, '11', 'สมุทรปราการ   ', 'Samut Prakan', 2),
(3, '12', 'นนทบุรี   ', 'Nonthaburi', 2),
(4, '13', 'ปทุมธานี   ', 'Pathum Thani', 2),
(5, '14', 'พระนครศรีอยุธยา   ', 'Phra Nakhon Si Ayutthaya', 2),
(6, '15', 'อ่างทอง   ', 'Ang Thong', 2),
(7, '16', 'ลพบุรี   ', 'Loburi', 2),
(8, '17', 'สิงห์บุรี   ', 'Sing Buri', 2),
(9, '18', 'ชัยนาท   ', 'Chai Nat', 2),
(10, '19', 'สระบุรี', 'Saraburi', 2),
(11, '20', 'ชลบุรี   ', 'Chon Buri', 5),
(12, '21', 'ระยอง   ', 'Rayong', 5),
(13, '22', 'จันทบุรี   ', 'Chanthaburi', 5),
(14, '23', 'ตราด   ', 'Trat', 5),
(15, '24', 'ฉะเชิงเทรา   ', 'Chachoengsao', 5),
(16, '25', 'ปราจีนบุรี   ', 'Prachin Buri', 5),
(17, '26', 'นครนายก   ', 'Nakhon Nayok', 2),
(18, '27', 'สระแก้ว   ', 'Sa Kaeo', 5),
(19, '30', 'นครราชสีมา   ', 'Nakhon Ratchasima', 3),
(20, '31', 'บุรีรัมย์   ', 'Buri Ram', 3),
(21, '32', 'สุรินทร์   ', 'Surin', 3),
(22, '33', 'ศรีสะเกษ   ', 'Si Sa Ket', 3),
(23, '34', 'อุบลราชธานี   ', 'Ubon Ratchathani', 3),
(24, '35', 'ยโสธร   ', 'Yasothon', 3),
(25, '36', 'ชัยภูมิ   ', 'Chaiyaphum', 3),
(26, '37', 'อำนาจเจริญ   ', 'Amnat Charoen', 3),
(27, '39', 'หนองบัวลำภู   ', 'Nong Bua Lam Phu', 3),
(28, '40', 'ขอนแก่น   ', 'Khon Kaen', 3),
(29, '41', 'อุดรธานี   ', 'Udon Thani', 3),
(30, '42', 'เลย   ', 'Loei', 3),
(31, '43', 'หนองคาย   ', 'Nong Khai', 3),
(32, '44', 'มหาสารคาม   ', 'Maha Sarakham', 3),
(33, '45', 'ร้อยเอ็ด   ', 'Roi Et', 3),
(34, '46', 'กาฬสินธุ์   ', 'Kalasin', 3),
(35, '47', 'สกลนคร   ', 'Sakon Nakhon', 3),
(36, '48', 'นครพนม   ', 'Nakhon Phanom', 3),
(37, '49', 'มุกดาหาร   ', 'Mukdahan', 3),
(38, '50', 'เชียงใหม่   ', 'Chiang Mai', 1),
(39, '51', 'ลำพูน   ', 'Lamphun', 1),
(40, '52', 'ลำปาง   ', 'Lampang', 1),
(41, '53', 'อุตรดิตถ์   ', 'Uttaradit', 1),
(42, '54', 'แพร่   ', 'Phrae', 1),
(43, '55', 'น่าน   ', 'Nan', 1),
(44, '56', 'พะเยา   ', 'Phayao', 1),
(45, '57', 'เชียงราย   ', 'Chiang Rai', 1),
(46, '58', 'แม่ฮ่องสอน   ', 'Mae Hong Son', 1),
(47, '60', 'นครสวรรค์   ', 'Nakhon Sawan', 2),
(48, '61', 'อุทัยธานี   ', 'Uthai Thani', 2),
(49, '62', 'กำแพงเพชร   ', 'Kamphaeng Phet', 2),
(50, '63', 'ตาก   ', 'Tak', 4),
(51, '64', 'สุโขทัย   ', 'Sukhothai', 2),
(52, '65', 'พิษณุโลก   ', 'Phitsanulok', 2),
(53, '66', 'พิจิตร   ', 'Phichit', 2),
(54, '67', 'เพชรบูรณ์   ', 'Phetchabun', 2),
(55, '70', 'ราชบุรี   ', 'Ratchaburi', 4),
(56, '71', 'กาญจนบุรี   ', 'Kanchanaburi', 4),
(57, '72', 'สุพรรณบุรี   ', 'Suphan Buri', 2),
(58, '73', 'นครปฐม   ', 'Nakhon Pathom', 2),
(59, '74', 'สมุทรสาคร   ', 'Samut Sakhon', 2),
(60, '75', 'สมุทรสงคราม   ', 'Samut Songkhram', 2),
(61, '76', 'เพชรบุรี   ', 'Phetchaburi', 4),
(62, '77', 'ประจวบคีรีขันธ์   ', 'Prachuap Khiri Khan', 4),
(63, '80', 'นครศรีธรรมราช   ', 'Nakhon Si Thammarat', 6),
(64, '81', 'กระบี่   ', 'Krabi', 6),
(65, '82', 'พังงา   ', 'Phangnga', 6),
(66, '83', 'ภูเก็ต   ', 'Phuket', 6),
(67, '84', 'สุราษฎร์ธานี   ', 'Surat Thani', 6),
(68, '85', 'ระนอง   ', 'Ranong', 6),
(69, '86', 'ชุมพร   ', 'Chumphon', 6),
(70, '90', 'สงขลา   ', 'Songkhla', 6),
(71, '91', 'สตูล   ', 'Satun', 6),
(72, '92', 'ตรัง   ', 'Trang', 6),
(73, '93', 'พัทลุง   ', 'Phatthalung', 6),
(74, '94', 'ปัตตานี   ', 'Pattani', 6),
(75, '95', 'ยะลา   ', 'Yala', 6),
(76, '96', 'นราธิวาส   ', 'Narathiwat', 6),
(77, '97', 'บึงกาฬ', 'Buogkan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rulejob`
--

CREATE TABLE `tbl_rulejob` (
  `id` int(11) NOT NULL,
  `num_job` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_rulejob`
--

INSERT INTO `tbl_rulejob` (`id`, `num_job`) VALUES
(1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_skill`
--

CREATE TABLE `tbl_skill` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_skill`
--

INSERT INTO `tbl_skill` (`id`, `skill_name`) VALUES
(1, 'คอมพิวเตอร์'),
(2, 'ภาษาต่างประเภท');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slide`
--

CREATE TABLE `tbl_slide` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL,
  `slide_status` int(1) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_slide`
--

INSERT INTO `tbl_slide` (`id`, `img`, `slide_status`, `rank`) VALUES
(2, 'News_2016-10-25-01-52-01_580e58518a64a0.85316844.jpg', 0, 1),
(3, 'News_2016-10-25-01-53-43_580e58b74adf62.79089438.jpg', 1, 3),
(5, 'News_2016-10-25-02-43-57_580e647db52553.37232351.jpg', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id`, `name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'อาจารย์นิเทศ'),
(3, 'สถานประกอบการ'),
(4, 'นักศึกษา'),
(5, 'ผ่านการฝึกสหกิจ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_en` varchar(100) NOT NULL,
  `major_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `gpa` varchar(4) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthplace` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `height` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `id_card` varchar(13) NOT NULL,
  `date_issued` date NOT NULL,
  `expiry_date` date NOT NULL,
  `issued_at` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `nationality` varchar(32) NOT NULL,
  `driving_license` varchar(10) NOT NULL,
  `expiry_driving` date NOT NULL,
  `conscription` varchar(1) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `father_career` varchar(50) NOT NULL,
  `father_workplace` varchar(64) NOT NULL,
  `father_phone` varchar(16) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `mother_career` varchar(50) NOT NULL,
  `mother_workplace` varchar(64) NOT NULL,
  `mother_phone` varchar(16) NOT NULL,
  `parent_address` text NOT NULL,
  `parent_phone` varchar(16) NOT NULL,
  `permanent_address` text NOT NULL,
  `permanent_phone` varchar(16) NOT NULL,
  `contact_address` text NOT NULL,
  `contact_phone` varchar(16) NOT NULL,
  `mobile_phone` varchar(16) NOT NULL,
  `email` varchar(100) NOT NULL,
  `check_address` varchar(2) NOT NULL,
  `emer_name` varchar(100) NOT NULL,
  `emer_address` text NOT NULL,
  `emer_phone` varchar(16) NOT NULL,
  `update_date` date NOT NULL,
  `user_update` int(11) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`id`, `user_id`, `name_en`, `major_id`, `faculty_id`, `gpa`, `gender`, `birthplace`, `birthdate`, `height`, `weight`, `id_card`, `date_issued`, `expiry_date`, `issued_at`, `religion`, `nationality`, `driving_license`, `expiry_driving`, `conscription`, `father_name`, `father_career`, `father_workplace`, `father_phone`, `mother_name`, `mother_career`, `mother_workplace`, `mother_phone`, `parent_address`, `parent_phone`, `permanent_address`, `permanent_phone`, `contact_address`, `contact_phone`, `mobile_phone`, `email`, `check_address`, `emer_name`, `emer_address`, `emer_phone`, `update_date`, `user_update`, `year_id`) VALUES
(1, 30, 'Pachara Nunthaarpa', 1, 1, '3.32', 'M', 'โรงพยาบาลลำปาง', '2536-11-01', '175', '95', '1529900668255', '2559-11-01', '2559-11-01', 'เทศบาลเกาะคา', 'พุทธ', 'ไทย', '1234567891', '2559-11-01', '1', 'ชัชวาลย์ นันทอาภา', 'รับราชการ', 'โรงเรียนเกาะคาวิทยาคม', '0861792233', 'อัญชลี นันทอาภา', 'รับราชการ', 'โรงเรียนไหล่หินวิทยาลัย', '0861875983', '414 ม.4 ซ.3 ต.ท่าผา อ.เกาะคา จ.ลำปาง 52130', '0861792233', '414 ม.4 ซ.3 ต.ท่าผา อ.เกาะคา จ.ลำปาง 52130', '0861875983', '', '', '0861875983', 'blacklistmodz.ton@gmail.com', '', 'ใครก็ได้', 'ไม่รู้เหมือนกัน', '555', '2016-11-29', 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_assreport`
--

CREATE TABLE `tbl_stu_assreport` (
  `id` int(11) NOT NULL,
  `corp_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `assess_date` date NOT NULL,
  `assess_comment` text NOT NULL,
  `year_id` int(11) NOT NULL,
  `total_point` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_assreport`
--

INSERT INTO `tbl_stu_assreport` (`id`, `corp_id`, `stu_id`, `assess_date`, `assess_comment`, `year_id`, `total_point`) VALUES
(3, 4, 30, '2016-11-08', 'ทำได้ดีทุกอย่าง', 2, 65);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_assreport_detail`
--

CREATE TABLE `tbl_stu_assreport_detail` (
  `id` int(11) NOT NULL,
  `assreport_id` int(11) NOT NULL,
  `ass_topic_id` int(11) NOT NULL,
  `assess_point` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_assreport_detail`
--

INSERT INTO `tbl_stu_assreport_detail` (`id`, `assreport_id`, `ass_topic_id`, `assess_point`) VALUES
(377, 3, 1, 5),
(378, 3, 2, 5),
(379, 3, 3, 4),
(380, 3, 4, 5),
(381, 3, 5, 4),
(382, 3, 6, 4),
(383, 3, 7, 5),
(384, 3, 8, 5),
(385, 3, 9, 5),
(386, 3, 10, 4),
(387, 3, 11, 5),
(388, 3, 12, 5),
(389, 3, 13, 5),
(390, 3, 14, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_asswork`
--

CREATE TABLE `tbl_stu_asswork` (
  `id` int(11) NOT NULL,
  `corp_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `stu_strength` text NOT NULL,
  `stu_improvement` text NOT NULL,
  `stu_offer` int(1) NOT NULL,
  `assess_date` date NOT NULL,
  `year_id` int(11) NOT NULL,
  `total_point` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_asswork`
--

INSERT INTO `tbl_stu_asswork` (`id`, `corp_id`, `stu_id`, `stu_strength`, `stu_improvement`, `stu_offer`, `assess_date`, `year_id`, `total_point`) VALUES
(1, 4, 30, 'เยอะแยะ', 'ไม่มี', 1, '2016-11-07', 2, 104);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_asswork_detail`
--

CREATE TABLE `tbl_stu_asswork_detail` (
  `id` int(11) NOT NULL,
  `asswork_id` int(11) NOT NULL,
  `ass_sub_id` int(11) NOT NULL,
  `ass_point` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_asswork_detail`
--

INSERT INTO `tbl_stu_asswork_detail` (`id`, `asswork_id`, `ass_sub_id`, `ass_point`) VALUES
(1, 1, 1, 5),
(2, 1, 2, 4),
(3, 1, 3, 4),
(4, 1, 4, 5),
(5, 1, 5, 4),
(6, 1, 6, 5),
(7, 1, 7, 4),
(8, 1, 8, 4),
(9, 1, 9, 0),
(10, 1, 10, 4),
(11, 1, 11, 5),
(12, 1, 12, 4),
(13, 1, 13, 5),
(14, 1, 14, 4),
(15, 1, 15, 4),
(16, 1, 16, 4),
(17, 1, 17, 5),
(18, 1, 18, 4),
(19, 1, 19, 4),
(20, 1, 20, 5),
(21, 1, 21, 4),
(22, 1, 22, 4),
(23, 1, 23, 4),
(24, 1, 24, 5),
(25, 1, 25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_edu`
--

CREATE TABLE `tbl_stu_edu` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `edu_id` int(11) NOT NULL,
  `edu_academy` varchar(60) NOT NULL,
  `edu_major` varchar(50) NOT NULL,
  `edu_level` varchar(60) NOT NULL,
  `edu_start` varchar(4) NOT NULL,
  `edu_end` varchar(4) NOT NULL,
  `edu_grade` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_edu`
--

INSERT INTO `tbl_stu_edu` (`id`, `stu_id`, `edu_id`, `edu_academy`, `edu_major`, `edu_level`, `edu_start`, `edu_end`, `edu_grade`) VALUES
(13, 1, 1, 'เพ็ญจิตตพงษ์', '-', 'ประถม', '2553', '2553', '2.5'),
(14, 1, 2, 'บุญวาทย์วิทยาลัย', '-', 'มัธยมต้น', '2554', '2554', '2.5'),
(15, 1, 3, 'บุญวาทย์วิทยาลัย', 'ไทย อังกฤษ สังคม', 'มัธยมปลาย', '2555', '2555', '2.5'),
(16, 1, 4, 'มหาวิทยาลัยราชภัฏลำปาง', 'วิศวกรรมซอฟต์แวร์', '-', '2555', '2559', '3.31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_exp`
--

CREATE TABLE `tbl_stu_exp` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `exp_topics` varchar(255) NOT NULL,
  `exp_duration` varchar(20) NOT NULL,
  `exp_responsibility` varchar(255) NOT NULL,
  `exp_award` varchar(255) NOT NULL,
  `exp_agency` varchar(255) NOT NULL,
  `exp_year` date NOT NULL,
  `exp_note` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_job`
--

CREATE TABLE `tbl_stu_job` (
  `id` int(11) NOT NULL,
  `pos_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `job_status` int(1) NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_project`
--

CREATE TABLE `tbl_stu_project` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `year_id` int(11) NOT NULL,
  `project_th` varchar(255) NOT NULL,
  `project_en` varchar(255) NOT NULL,
  `project_detail` text NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_position` varchar(50) NOT NULL,
  `emp_department` varchar(50) NOT NULL,
  `create_date` date NOT NULL,
  `update_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_project`
--

INSERT INTO `tbl_stu_project` (`id`, `stu_id`, `year_id`, `project_th`, `project_en`, `project_detail`, `emp_name`, `emp_position`, `emp_department`, `create_date`, `update_date`) VALUES
(3, 30, 2, 'ทดสอบระบบ', 'Testing System', 'ทดสอบระบบ ทดสอบระบบ', 'ธวัชชัย วัฒนา', 'นักทดสอบระบบ', 'ทดสอบระบบ', '2016-11-08', '2016-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_send`
--

CREATE TABLE `tbl_stu_send` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `send_date` date NOT NULL,
  `year_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_send`
--

INSERT INTO `tbl_stu_send` (`id`, `stu_id`, `doc_id`, `send_date`, `year_id`) VALUES
(1, 30, 3, '2016-11-08', 2),
(4, 30, 2, '2016-11-08', 2),
(5, 30, 4, '2016-11-08', 2),
(6, 30, 5, '2016-11-27', 2),
(9, 30, 6, '2020-11-28', 2),
(11, 30, 8, '2016-11-29', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_send_detail`
--

CREATE TABLE `tbl_stu_send_detail` (
  `id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `doc_file` varchar(100) NOT NULL,
  `upload_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_send_detail`
--

INSERT INTO `tbl_stu_send_detail` (`id`, `send_id`, `doc_file`, `upload_date`) VALUES
(1, 1, '55122660114_3_2016-11-29-16-43-59_583d4ddfb2b3e8.52743349.gif', '2016-11-29'),
(4, 4, '55122660114_2_2016-11-29-20-29-07_583d82a357d242.31105904.pdf', '2016-11-29'),
(8, 6, '55122660114_5_2016-11-27-19-15-02_583ace46244c52.92392007.pdf', '2016-11-27'),
(10, 7, '55122660114_6_2016-11-28-07-20-21_583b784524e8d9.86405431.pdf', '2016-11-28'),
(11, 7, '55122660114_6_2016-11-28-07-20-21_583b7845260851.42512173.pdf', '2016-11-28'),
(12, 7, '55122660114_6_2016-11-28-07-20-21_583b784526d9e0.61651031.pdf', '2016-11-28'),
(14, 7, '55122660114_6_2016-11-28-07-21-10_583b7876f1d121.59894567.pdf', '2016-11-28'),
(36, 5, '55122660114_4_2016-11-29-07-58-52_583cd2cce56b68.62659930.pdf', '2016-11-29'),
(37, 11, '55122660114_8_2016-11-29-14-42-32_583d3168705646.87689137.rar', '2016-11-29'),
(38, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e1245f49.52643488.pdf', '2016-11-29'),
(39, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e125c396.34457330.pdf', '2016-11-29'),
(40, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e12671e5.23526689.pdf', '2016-11-29'),
(41, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e1271627.64225631.pdf', '2016-11-29'),
(42, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e127b018.20345376.pdf', '2016-11-29'),
(43, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e1284eb8.15012799.pdf', '2016-11-29'),
(44, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e128e2f9.62514329.pdf', '2016-11-29'),
(45, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e1299153.55597690.pdf', '2016-11-29'),
(46, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e12a9418.96908319.pdf', '2016-11-29'),
(47, 5, '55122660114_4_2016-11-29-08-12-01_583cd5e12b6515.93056247.pdf', '2016-11-29'),
(49, 9, '55122660114_6_2016-11-29-08-25-14_583cd8fa009989.40276235.pdf', '2016-11-29'),
(50, 5, '55122660114_4_2016-11-29-11-46-12_583d0814522a53.60892472.pdf', '2016-11-29'),
(51, 5, '55122660114_4_2016-11-29-11-46-38_583d082e64bd42.56178231.pdf', '2016-11-29'),
(52, 5, '55122660114_4_2016-11-29-11-46-42_583d083242a1a5.80068368.pdf', '2016-11-29'),
(53, 5, '55122660114_4_2016-11-29-11-49-24_583d08d426eae8.69630061.pdf', '2016-11-29'),
(54, 5, '55122660114_4_2016-11-29-11-54-32_583d0a08031578.65944735.pdf', '2016-11-29'),
(55, 5, '55122660114_4_2016-11-29-11-55-24_583d0a3c6f5483.57463032.pdf', '2016-11-29'),
(56, 6, '55122660114_5_2016-11-29-20-42-34_583d85ca26ea67.74622638.pdf', '2016-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stu_skill`
--

CREATE TABLE `tbl_stu_skill` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `skill_point` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_stu_skill`
--

INSERT INTO `tbl_stu_skill` (`id`, `stu_id`, `sub_id`, `skill_point`) VALUES
(16, 1, 1, 4),
(17, 1, 2, 0),
(18, 1, 3, 4),
(19, 1, 4, 0),
(20, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_skill`
--

CREATE TABLE `tbl_sub_skill` (
  `id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `sub_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sub_skill`
--

INSERT INTO `tbl_sub_skill` (`id`, `skill_id`, `sub_name`) VALUES
(1, 1, 'Word'),
(2, 1, 'Excel'),
(3, 1, 'Internet'),
(4, 2, 'English'),
(5, 2, 'Japanese');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE `tbl_training` (
  `id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `training_topics` varchar(255) NOT NULL,
  `training_agency` varchar(255) NOT NULL,
  `training_duration` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`id`, `stu_id`, `training_topics`, `training_agency`, `training_duration`) VALUES
(4, 1, 'ทดสอบ', 'ทดสอบ', 'มกราคม 2559');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_welfare`
--

CREATE TABLE `tbl_welfare` (
  `id` int(11) NOT NULL,
  `wel_name` varchar(255) NOT NULL,
  `wel_display` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_welfare`
--

INSERT INTO `tbl_welfare` (`id`, `wel_name`, `wel_display`) VALUES
(1, 'ค่าอาหาร', 'disabled'),
(2, 'ที่พัก', 'enabled'),
(3, 'ชุดยูนิฟอร์ม', 'disabled'),
(4, 'ค่าเดินทาง', 'enabled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_year`
--

CREATE TABLE `tbl_year` (
  `id` int(11) NOT NULL,
  `academic_year` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_year`
--

INSERT INTO `tbl_year` (`id`, `academic_year`) VALUES
(1, 2558),
(2, 2559);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_assess_report`
--
ALTER TABLE `tbl_assess_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assess_sub`
--
ALTER TABLE `tbl_assess_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_assess_work`
--
ALTER TABLE `tbl_assess_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_authentication`
--
ALTER TABLE `tbl_authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_corporation`
--
ALTER TABLE `tbl_corporation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_corp_welfare`
--
ALTER TABLE `tbl_corp_welfare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_document`
--
ALTER TABLE `tbl_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_education`
--
ALTER TABLE `tbl_education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `tbl_infomation`
--
ALTER TABLE `tbl_infomation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_majors`
--
ALTER TABLE `tbl_majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news_img`
--
ALTER TABLE `tbl_news_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_province`
--
ALTER TABLE `tbl_province`
  ADD PRIMARY KEY (`PROVINCE_ID`);

--
-- Indexes for table `tbl_rulejob`
--
ALTER TABLE `tbl_rulejob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_skill`
--
ALTER TABLE `tbl_skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_assreport`
--
ALTER TABLE `tbl_stu_assreport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_assreport_detail`
--
ALTER TABLE `tbl_stu_assreport_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_asswork`
--
ALTER TABLE `tbl_stu_asswork`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_asswork_detail`
--
ALTER TABLE `tbl_stu_asswork_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_edu`
--
ALTER TABLE `tbl_stu_edu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_exp`
--
ALTER TABLE `tbl_stu_exp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_job`
--
ALTER TABLE `tbl_stu_job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_project`
--
ALTER TABLE `tbl_stu_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_send`
--
ALTER TABLE `tbl_stu_send`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_send_detail`
--
ALTER TABLE `tbl_stu_send_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stu_skill`
--
ALTER TABLE `tbl_stu_skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sub_skill`
--
ALTER TABLE `tbl_sub_skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_training`
--
ALTER TABLE `tbl_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_welfare`
--
ALTER TABLE `tbl_welfare`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_year`
--
ALTER TABLE `tbl_year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_assess_report`
--
ALTER TABLE `tbl_assess_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_assess_sub`
--
ALTER TABLE `tbl_assess_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_assess_work`
--
ALTER TABLE `tbl_assess_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_authentication`
--
ALTER TABLE `tbl_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tbl_corporation`
--
ALTER TABLE `tbl_corporation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_corp_welfare`
--
ALTER TABLE `tbl_corp_welfare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_document`
--
ALTER TABLE `tbl_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_education`
--
ALTER TABLE `tbl_education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_infomation`
--
ALTER TABLE `tbl_infomation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_majors`
--
ALTER TABLE `tbl_majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_news_img`
--
ALTER TABLE `tbl_news_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `tbl_province`
--
ALTER TABLE `tbl_province`
  MODIFY `PROVINCE_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `tbl_rulejob`
--
ALTER TABLE `tbl_rulejob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_skill`
--
ALTER TABLE `tbl_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_slide`
--
ALTER TABLE `tbl_slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_stu_assreport`
--
ALTER TABLE `tbl_stu_assreport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_stu_assreport_detail`
--
ALTER TABLE `tbl_stu_assreport_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;
--
-- AUTO_INCREMENT for table `tbl_stu_asswork`
--
ALTER TABLE `tbl_stu_asswork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_stu_asswork_detail`
--
ALTER TABLE `tbl_stu_asswork_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tbl_stu_edu`
--
ALTER TABLE `tbl_stu_edu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_stu_exp`
--
ALTER TABLE `tbl_stu_exp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_stu_job`
--
ALTER TABLE `tbl_stu_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_stu_project`
--
ALTER TABLE `tbl_stu_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_stu_send`
--
ALTER TABLE `tbl_stu_send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_stu_send_detail`
--
ALTER TABLE `tbl_stu_send_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `tbl_stu_skill`
--
ALTER TABLE `tbl_stu_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_sub_skill`
--
ALTER TABLE `tbl_sub_skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_training`
--
ALTER TABLE `tbl_training`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_welfare`
--
ALTER TABLE `tbl_welfare`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_year`
--
ALTER TABLE `tbl_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
