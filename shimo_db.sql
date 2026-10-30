-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 22, 2026 at 06:34 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shimo`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_token_free`
--

CREATE TABLE `buy_token_free` (
  `id` int(11) NOT NULL,
  `product_id` varchar(225) NOT NULL,
  `student_id` varchar(225) NOT NULL,
  `lesson_id` varchar(225) NOT NULL,
  `teacher_id` varchar(225) NOT NULL,
  `token_price` varchar(225) NOT NULL,
  `token_type` varchar(225) NOT NULL,
  `system_date` varchar(225) NOT NULL,
  `real_date` varchar(225) NOT NULL,
  `real_time` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name_of_class` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `lesson_date` varchar(225) NOT NULL,
  `lesson_time` varchar(225) NOT NULL,
  `charge` varchar(225) NOT NULL,
  `no_of_students` varchar(225) NOT NULL,
  `teacher_id` varchar(225) NOT NULL,
  `posted_time` varchar(225) NOT NULL,
  `posted_date` varchar(225) NOT NULL,
  `teacher_link` text NOT NULL,
  `student_link` text NOT NULL,
  `other_link` text NOT NULL,
  `pdf` varchar(225) NOT NULL,
  `change_streaming_type` text NOT NULL,
  `blocked_by_admin` varchar(225) NOT NULL,
  `archive_by_admin` varchar(225) NOT NULL,
  `active` int(11) NOT NULL,
  `type_of_programe` varchar(225) NOT NULL,
  `target_audience` varchar(225) NOT NULL,
  `date2` varchar(225) NOT NULL,
  `time2` varchar(225) NOT NULL,
  `marketing_commencement_date` varchar(225) NOT NULL,
  `additional_information` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `currency` varchar(225) NOT NULL,
  `virutual_or_full` varchar(225) NOT NULL,
  `content_of_the_program` text NOT NULL,
  `youtube_link` text NOT NULL,
  `brochure` text NOT NULL,
  `cover_page` text NOT NULL,
  `large_flyer` text NOT NULL,
  `course_objectives` text NOT NULL,
  `target_audience_full` text NOT NULL,
  `additional_information_full` text CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `category` varchar(225) NOT NULL,
  `program` varchar(225) NOT NULL,
  `partial_payment` int(11) NOT NULL,
  `complete_payment` varchar(225) NOT NULL,
  `any_time_link` varchar(225) NOT NULL,
  `specific_time_link` varchar(225) NOT NULL,
  `zoom_meeting_id` text NOT NULL,
  `zoom_meeting_data` text NOT NULL,
  `zoom_email_id` text NOT NULL,
  `zoom_email_address` text NOT NULL,
  `zoom_api_key` text NOT NULL,
  `zoom_api_secret` text NOT NULL,
  `zoom_url` text NOT NULL,
  `note` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_sinhala_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name_of_class`, `description`, `lesson_date`, `lesson_time`, `charge`, `no_of_students`, `teacher_id`, `posted_time`, `posted_date`, `teacher_link`, `student_link`, `other_link`, `pdf`, `change_streaming_type`, `blocked_by_admin`, `archive_by_admin`, `active`, `type_of_programe`, `target_audience`, `date2`, `time2`, `marketing_commencement_date`, `additional_information`, `currency`, `virutual_or_full`, `content_of_the_program`, `youtube_link`, `brochure`, `cover_page`, `large_flyer`, `course_objectives`, `target_audience_full`, `additional_information_full`, `category`, `program`, `partial_payment`, `complete_payment`, `any_time_link`, `specific_time_link`, `zoom_meeting_id`, `zoom_meeting_data`, `zoom_email_id`, `zoom_email_address`, `zoom_api_key`, `zoom_api_secret`, `zoom_url`, `note`) VALUES
(12, 'lesson2', 'ffyu', '2025-02-05', '12:30', '213', '32', '93', '1738739022', '2025-02-05 12:42', '', '', '', '', '', '', '', 9, '', '', '2025-02-05', '12:30', '2025-02-05', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    hggkhyiukhikuguighuyhgyuuhjkhujkhkjuhjkhjkhkujh'),
(13, 'lesson1', ' මෝටර් රථ ප්‍රවාහන පාඨමාලාව', '2025-02-05', '12:42', '4300', '4', '93', '1738748850', '2025-02-05 03:30', '', '', '', '', '', '', '', 1, '', '', '2025-02-05', '12:42', '2025-02-05', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', 'Grade 1 - 11', '', 0, '', '', '', '', '', '', '', '', '', '', '    අපි මෝටර් රථ ප්‍රවාහන කර්මාන්තය සඳහා SSW පුහුණු පාඨමාලාවක් ආරම්භ කරනවා!\r\nආරම්භක දිනය: 1 වන සැසිය: 2025 මාර්තු 2 - මාර්ගගත පාඨමාලාව\r\nවේලාව: සෑම ඉරිදාවකම 9:00 - 12:30\r\nකාලය: මාස 2 (මුළු පාඩම් 8)\r\nමිල: රු. 18,000 ක් පමණයි! \r\n(ඔබ ජපානයේ ජීවත් වන අතර ජපන් බැංකුවක තැන්පත් කරන්නේ නම්: යෙන් 10,000)\r\n\r\nජපන් රියදුරු බලපත්‍ර මධ්‍යස්ථානයේ වෘත්තීය ජපන් උපදේශකයින් සහ ශ්‍රී ලාංකික පරිවර්තක උපදේශකයින් විසින් මෙම පාඨමාලාව උගන්වනු ලැබේ!\r\n\r\n・අපි අපගේ ජපන් අනුබද්ධිත ආයතනය විසින් 2025 මැයි මාසයේදී කොළඹදී රියදුරු SSW විභාගය පවත්වනු ඇත.\r\n・මෝටර් රථ ප්‍රවාහන කර්මාන්ත SSW විභාගය සඳහා අයදුම්පත් භාරගනු ලබන්නේ අපගේ පාඨමාලා හැදෑරූ සිසුන්ගෙන් පමණි.\r\n・මෙම පාඨමාලාවට සහභාගිවන්නන්ට අපගේ ජපන් සමූහ සමාගම්වලින් රියදුරු SSW රැකියා අවස්ථා පිළිබඳ තොරතුරු ලබා දෙනු ඇත.\r\n・රැකියා තොරතුරු: \r\n\"ටෝකියෝ: මාසික වැටුප යෙන් 300,000, ටොන් 2ක ට්‍රක් රථයක් පැදවීම\", \r\n\"කනගාවා ප්‍රාන්තය: මාසික වැටුප යෙන් 330,000, ටොන් 4ක ට්‍රක් රථයක් පැදවීම\", \r\n\"සයිතාමා ප්‍රාන්තය: මාසික වැටුප යෙන් 400,000, \r\nආහාර \"බෙදාහැරීමේ ට්‍රක්\" සහ තවත් බොහෝ ඉහළ වැටුප් සහිත රැකියා අවස්ථා.\r\n\r\nජපානයේ රියදුරන්ට හොඳ වැටුපක් ලැබෙනවා. ටිකක් ධෛර්යය සහ අධ්‍යයනය ඔබේ ජීවිතය වෙනස් කළ හැකිය. ජපානයේ ඇති අවස්ථාවෙන් UPARIMA ප්‍රයෝජන ගන්න.\r\n・මෙම පාඨමාලාව හදාරන අයට අමතර රු. 5,000 ක ගාස්තුවකට N5 මාර්ගගත පාඨමාලාව හැදෑරිය හැකිය.\r\n'),
(14, 'Lesson 1', 'ජපන් භාෂා හා සංස්කෘති පුහුණු පාඨමාලාව!', '2025-02-05', '03:27', '20000', '200', '94', '1738750438', '2025-02-05 03:58', '', '', '', '', '', '', '', 1, '', '', '2025-02-05', '03:27', '2025-02-05', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', 'මෙම පාඨමාලාව වෘත්තීය ජපන් භාෂා උපදේශකයින් සහ ශ්‍රී ලාංකික පරිවර්තක උපදේශකයින් විසින් මෙහෙයවනු ලැබේ. ඔවුන් ජපන් භාෂා ඉගැන්වීමේ සහ සංස්කෘතික පුහුණුවේ අත්දැකීම් ඇති විශේෂඥයින් වේ.\r\n\r\nJFT පාඨමාලාවේ ප්රධාන ලක්ෂණ:\r\nJFT විභාගය සඳහා සූදානම් වීම:\r\n\r\nඅපගේ ජපන් අනුබද්ධිත ආයතනය මැයි 2025 දී කොළඹදී JFT විභාගය පවත්වනු ඇත.\r\n\r\nමෙම පාඨමාලාව සම්පූර්ණ කළ සිසුන්ට පමණක් අපගේ ආයතනය හරහා JFT විභාගය සඳහා අයදුම් කිරීමේ අවස්ථාව ලැබේ.\r\n\r\nජපානයේ රැකියා අවස්ථා:\r\n\r\nසහභාගිවන්නන්ට ජපානයේ රැකියා අවස්ථා පිළිබඳ තොරතුරු ලබා දෙනු ඇත. මෙයට හෝටල් කටයුතු, ඉදිකිරීම්, සෞඛ්‍ය සේවා, සහ කර්මාන්තශාලා රැකියා ඇතුළත් වේ.\r\n\r\nරැකියා උදාහරණ:\r\n\r\nටෝකියෝ: මාසික වැටුප ¥250,000 (හෝටල් කටයුතු හෝ ගනුදෙනු සේවා රැකියා).\r\n\r\nඔසාකා: මාසික වැටුප ¥280,000 (ඉදිකිරීම් හෝ කර්මාන්තශාලා රැකියා).\r\n\r\nෆුකුඔකා: මාසික වැටුප ¥300,000 (සෞඛ්‍ය සේවා හෝ සත්ත්‍ව සේවා රැකියා).\r\n\r\nසංස්කෘතික පුහුණුව:\r\n\r\nජපානයේ වැඩස්ථාන සංස්කෘතිය, ආචාර ධර්ම, සහ සන්නිවේදන කුසලතා ඉගෙන ගන්න.\r\n\r\nඅතිරේක ප්‍රතිලාභ:\r\n\r\nJLPT N5/N4 සඳහා මාර්ගගත සම්පත් වලට ප්‍රවේශය ලබා ගැනීමට අමතර රු. 5,000 ක ගාස්තුවක් ගෙවන්න.\r\n\r\nජපානයට පැමිණීම සඳහා වීසා ක්‍රියාවලිය පිළිබඳ මගපෙන්වීම්.\r\n\r\nමෙම JFT පාඨමාලාව තෝරා ගන්නේ ඇයි?\r\nඔබගේ ජපන් භාෂා හා සංස්කෘතික දැනුම වැඩි දියුණු කර ගන්න.\r\n\r\nජපානයේ ඉහළ වැටුප් රැකියා අවස්ථාවන්ට ප්‍රවේශය ලබා ගන්න.\r\n\r\nJFT විභාගය සඳහා විශ්වාසයෙන් සූදානම් වන්න.\r\n\r\nජපානයේ ජීවිතය වෙනස් කර ගන්න!'),
(15, 'lesson1', 'මෝටර් රථ ප්‍රවාහන පාඨමාලාව', '2025-02-06', '11:38', '1000', '100', '94', '1738822561', '2025-02-06 11:01', '', '', '', '', '', '', '', 1, '', '', '2025-02-06', '11:38', '2025-02-06', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    අපි මෝටර් රථ ප්‍රවාහන කර්මාන්තය සඳහා SSW පුහුණු පාඨමාලාවක් ආරම්භ කරනවා!\r\nආරම්භක දිනය: 1 වන සැසිය: 2025 මාර්තු 2 - මාර්ගගත පාඨමාලාව\r\nවේලාව: සෑම ඉරිදාවකම 9:00 - 12:30\r\nකාලය: මාස 2 (මුළු පාඩම් 8)\r\nමිල: රු. 18,000 ක් පමණයි! \r\n(ඔබ ජපානයේ ජීවත් වන අතර ජපන් බැංකුවක තැන්පත් කරන්නේ නම්: යෙන් 10,000)\r\n\r\nජපන් රියදුරු බලපත්‍ර මධ්‍යස්ථානයේ වෘත්තීය ජපන් උපදේශකයින් සහ ශ්‍රී ලාංකික පරිවර්තක උපදේශකයින් විසින් මෙම පාඨමාලාව උගන්වනු ලැබේ!\r\n\r\n・අපි අපගේ ජපන් අනුබද්ධිත ආයතනය විසින් 2025 මැයි මාසයේදී කොළඹදී රියදුරු SSW විභාගය පවත්වනු ඇත.\r\n・මෝටර් රථ ප්‍රවාහන කර්මාන්ත SSW විභාගය සඳහා අයදුම්පත් භාරගනු ලබන්නේ අපගේ පාඨමාලා හැදෑරූ සිසුන්ගෙන් පමණි.\r\n・මෙම පාඨමාලාවට සහභාගිවන්නන්ට අපගේ ජපන් සමූහ සමාගම්වලින් රියදුරු SSW රැකියා අවස්ථා පිළිබඳ තොරතුරු ලබා දෙනු ඇත.\r\n・රැකියා තොරතුරු: \r\n\"ටෝකියෝ: මාසික වැටුප යෙන් 300,000, ටොන් 2ක ට්‍රක් රථයක් පැදවීම\", \r\n\"කනගාවා ප්‍රාන්තය: මාසික වැටුප යෙන් 330,000, ටොන් 4ක ට්‍රක් රථයක් පැදවීම\", \r\n\"සයිතාමා ප්‍රාන්තය: මාසික වැටුප යෙන් 400,000, \r\nආහාර \"බෙදාහැරීමේ ට්‍රක්\" සහ තවත් බොහෝ ඉහළ වැටුප් සහිත රැකියා අවස්ථා.\r\n\r\nජපානයේ රියදුරන්ට හොඳ වැටුපක් ලැබෙනවා. ටිකක් ධෛර්යය සහ අධ්‍යයනය ඔබේ ජීවිතය වෙනස් කළ හැකිය. ජපානයේ ඇති අවස්ථාවෙන් UPARIMA ප්‍රයෝජන ගන්න.\r\n・මෙම පාඨමාලාව හදාරන අයට අමතර රු. 5,000 ක ගාස්තුවකට N5 මාර්ගගත පාඨමාලාව හැදෑරිය හැකිය.\r\n'),
(16, 'lesson1', 'මෝටර් රථ ප්‍රවාහන පාඨමාලාව', '2025-02-06', '11:43', '20000', '100', '93', '1738822936', '2025-02-06 11:16', '', '', '', '', '', '', '', 1, '', '', '2025-02-06', '11:43', '2025-02-06', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    අපි මෝටර් රථ ප්‍රවාහන කර්මාන්තය සඳහා SSW පුහුණු පාඨමාලාවක් ආරම්භ කරනවා!\r\nආරම්භක දිනය: 1 වන සැසිය: 2025 මාර්තු 2 - මාර්ගගත පාඨමාලාව\r\nවේලාව: සෑම ඉරිදාවකම 9:00 - 12:30\r\nකාලය: මාස 2 (මුළු පාඩම් 8)\r\nමිල: රු. 18,000 ක් පමණයි! \r\n(ඔබ ජපානයේ ජීවත් වන අතර ජපන් බැංකුවක තැන්පත් කරන්නේ නම්: යෙන් 10,000)\r\n\r\nජපන් රියදුරු බලපත්‍ර මධ්‍යස්ථානයේ වෘත්තීය ජපන් උපදේශකයින් සහ ශ්‍රී ලාංකික පරිවර්තක උපදේශකයින් විසින් මෙම පාඨමාලාව උගන්වනු ලැබේ!\r\n\r\n・අපි අපගේ ජපන් අනුබද්ධිත ආයතනය විසින් 2025 මැයි මාසයේදී කොළඹදී රියදුරු SSW විභාගය පවත්වනු ඇත.\r\n・මෝටර් රථ ප්‍රවාහන කර්මාන්ත SSW විභාගය සඳහා අයදුම්පත් භාරගනු ලබන්නේ අපගේ පාඨමාලා හැදෑරූ සිසුන්ගෙන් පමණි.\r\n・මෙම පාඨමාලාවට සහභාගිවන්නන්ට අපගේ ජපන් සමූහ සමාගම්වලින් රියදුරු SSW රැකියා අවස්ථා පිළිබඳ තොරතුරු ලබා දෙනු ඇත.\r\n・රැකියා තොරතුරු: \r\n\"ටෝකියෝ: මාසික වැටුප යෙන් 300,000, ටොන් 2ක ට්‍රක් රථයක් පැදවීම\", \r\n\"කනගාවා ප්‍රාන්තය: මාසික වැටුප යෙන් 330,000, ටොන් 4ක ට්‍රක් රථයක් පැදවීම\", \r\n\"සයිතාමා ප්‍රාන්තය: මාසික වැටුප යෙන් 400,000, \r\nආහාර \"බෙදාහැරීමේ ට්‍රක්\" සහ තවත් බොහෝ ඉහළ වැටුප් සහිත රැකියා අවස්ථා.\r\n\r\nජපානයේ රියදුරන්ට හොඳ වැටුපක් ලැබෙනවා. ටිකක් ධෛර්යය සහ අධ්‍යයනය ඔබේ ජීවිතය වෙනස් කළ හැකිය. ජපානයේ ඇති අවස්ථාවෙන් UPARIMA ප්‍රයෝජන ගන්න.\r\n・මෙම පාඨමාලාව හදාරන අයට අමතර රු. 5,000 ක ගාස්තුවකට N5 මාර්ගගත පාඨමාලාව හැදෑරිය හැකිය.\r\n'),
(17, 'lesson1', 'ජපන් භාෂා හා සංස්කෘති පුහුණු පාඨමාලාව!', '2025-02-06', '11:06', '1000', '100', '94', '1738823081', '2025-02-06 11:41', '', '', '', '', '', '', '', 1, '', '', '2025-02-06', '11:06', '2025-02-06', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    මෙම පාඨමාලාව වෘත්තීය ජපන් භාෂා උපදේශකයින් සහ ශ්‍රී ලාංකික පරිවර්තක උපදේශකයින් විසින් මෙහෙයවනු ලැබේ. ඔවුන් ජපන් භාෂා ඉගැන්වීමේ සහ සංස්කෘතික පුහුණුවේ අත්දැකීම් ඇති විශේෂඥයින් වේ.\r\n\r\nJFT පාඨමාලාවේ ප්රධාන ලක්ෂණ:\r\nJFT විභාගය සඳහා සූදානම් වීම:\r\n\r\nඅපගේ ජපන් අනුබද්ධිත ආයතනය මැයි 2025 දී කොළඹදී JFT විභාගය පවත්වනු ඇත.\r\n\r\nමෙම පාඨමාලාව සම්පූර්ණ කළ සිසුන්ට පමණක් අපගේ ආයතනය හරහා JFT විභාගය සඳහා අයදුම් කිරීමේ අවස්ථාව ලැබේ.\r\n\r\nජපානයේ රැකියා අවස්ථා:\r\n\r\nසහභාගිවන්නන්ට ජපානයේ රැකියා අවස්ථා පිළිබඳ තොරතුරු ලබා දෙනු ඇත. මෙයට හෝටල් කටයුතු, ඉදිකිරීම්, සෞඛ්‍ය සේවා, සහ කර්මාන්තශාලා රැකියා ඇතුළත් වේ.\r\n\r\nරැකියා උදාහරණ:\r\n\r\nටෝකියෝ: මාසික වැටුප ¥250,000 (හෝටල් කටයුතු හෝ ගනුදෙනු සේවා රැකියා).\r\n\r\nඔසාකා: මාසික වැටුප ¥280,000 (ඉදිකිරීම් හෝ කර්මාන්තශාලා රැකියා).\r\n\r\nෆුකුඔකා: මාසික වැටුප ¥300,000 (සෞඛ්‍ය සේවා හෝ සත්ත්‍ව සේවා රැකියා).\r\n\r\nසංස්කෘතික පුහුණුව:\r\n\r\nජපානයේ වැඩස්ථාන සංස්කෘතිය, ආචාර ධර්ම, සහ සන්නිවේදන කුසලතා ඉගෙන ගන්න.\r\n\r\nඅතිරේක ප්‍රතිලාභ:\r\n\r\nJLPT N5/N4 සඳහා මාර්ගගත සම්පත් වලට ප්‍රවේශය ලබා ගැනීමට අමතර රු. 5,000 ක ගාස්තුවක් ගෙවන්න.\r\n\r\nජපානයට පැමිණීම සඳහා වීසා ක්‍රියාවලිය පිළිබඳ මගපෙන්වීම්.\r\n\r\nමෙම JFT පාඨමාලාව තෝරා ගන්නේ ඇයි?\r\nඔබගේ ජපන් භාෂා හා සංස්කෘතික දැනුම වැඩි දියුණු කර ගන්න.\r\n\r\nජපානයේ ඉහළ වැටුප් රැකියා අවස්ථාවන්ට ප්‍රවේශය ලබා ගන්න.\r\n\r\nJFT විභාගය සඳහා විශ්වාසයෙන් සූදානම් වන්න.\r\n\r\nජපානයේ ජීවිතය වෙනස් කර ගන්න!'),
(18, 'lesson1', 'ජපන් භාෂා හා සංස්කෘති පුහුණු පාඨමාලාව!', '2025-02-06', '11:30', '20000', '200', '96', '1738823278', '2025-02-06 11:58', '', '', '', '', '', '', '', 1, '', '', '2025-02-06', '11:30', '2025-02-06', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    මෙම පාඨමාලාව වෘත්තීය ජපන් භාෂා උපදේශකයින් සහ ශ්‍රී ලාංකික පරිවර්තක උපදේශකයින් විසින් මෙහෙයවනු ලැබේ. ඔවුන් ජපන් භාෂා ඉගැන්වීමේ සහ සංස්කෘතික පුහුණුවේ අත්දැකීම් ඇති විශේෂඥයින් වේ.\r\n\r\nJFT පාඨමාලාවේ ප්රධාන ලක්ෂණ:\r\nJFT විභාගය සඳහා සූදානම් වීම:\r\n\r\nඅපගේ ජපන් අනුබද්ධිත ආයතනය මැයි 2025 දී කොළඹදී JFT විභාගය පවත්වනු ඇත.\r\n\r\nමෙම පාඨමාලාව සම්පූර්ණ කළ සිසුන්ට පමණක් අපගේ ආයතනය හරහා JFT විභාගය සඳහා අයදුම් කිරීමේ අවස්ථාව ලැබේ.\r\n\r\nජපානයේ රැකියා අවස්ථා:\r\n\r\nසහභාගිවන්නන්ට ජපානයේ රැකියා අවස්ථා පිළිබඳ තොරතුරු ලබා දෙනු ඇත. මෙයට හෝටල් කටයුතු, ඉදිකිරීම්, සෞඛ්‍ය සේවා, සහ කර්මාන්තශාලා රැකියා ඇතුළත් වේ.\r\n\r\nරැකියා උදාහරණ:\r\n\r\nටෝකියෝ: මාසික වැටුප ¥250,000 (හෝටල් කටයුතු හෝ ගනුදෙනු සේවා රැකියා).\r\n\r\nඔසාකා: මාසික වැටුප ¥280,000 (ඉදිකිරීම් හෝ කර්මාන්තශාලා රැකියා).\r\n\r\nෆුකුඔකා: මාසික වැටුප ¥300,000 (සෞඛ්‍ය සේවා හෝ සත්ත්‍ව සේවා රැකියා).\r\n\r\nසංස්කෘතික පුහුණුව:\r\n\r\nජපානයේ වැඩස්ථාන සංස්කෘතිය, ආචාර ධර්ම, සහ සන්නිවේදන කුසලතා ඉගෙන ගන්න.\r\n\r\nඅතිරේක ප්‍රතිලාභ:\r\n\r\nJLPT N5/N4 සඳහා මාර්ගගත සම්පත් වලට ප්‍රවේශය ලබා ගැනීමට අමතර රු. 5,000 ක ගාස්තුවක් ගෙවන්න.\r\n\r\nජපානයට පැමිණීම සඳහා වීසා ක්‍රියාවලිය පිළිබඳ මගපෙන්වීම්.\r\n\r\nමෙම JFT පාඨමාලාව තෝරා ගන්නේ ඇයි?\r\nඔබගේ ජපන් භාෂා හා සංස්කෘතික දැනුම වැඩි දියුණු කර ගන්න.\r\n\r\nජපානයේ ඉහළ වැටුප් රැකියා අවස්ථාවන්ට ප්‍රවේශය ලබා ගන්න.\r\n\r\nJFT විභාගය සඳහා විශ්වාසයෙන් සූදානම් වන්න.\r\n\r\nජපානයේ ජීවිතය වෙනස් කර ගන්න!'),
(19, 'Unit 01', 'Only for bpaid students', '2026-06-05', '11:29', '2000', '100', '98', '1780637653', '2026-06-05 11:13', '', '', '', '', '', '', '', 1, '', '', '2026-06-05', '11:29', '2026-06-05', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    '),
(20, 'Unit 01', 'test', '2026-06-08', '12:35', '2000', '100', '100', '1780900811', '2026-06-08 12:11', '', '', '', '', '', '', '', 1, '', '', '2026-06-30', '12:35', '2026-06-08', '', 'LKR', 'Virual Training Only - Payment Gateway Free', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '    ');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery_name` varchar(225) NOT NULL,
  `date_and_time` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery_name`, `date_and_time`, `active`) VALUES
(1, 'Our Latest Events', '2025/01/20 - 12:36:52pm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_image`
--

CREATE TABLE `gallery_image` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `file_name` text NOT NULL,
  `image_or_video` varchar(225) NOT NULL,
  `gallery_id` varchar(225) NOT NULL,
  `date_and_time` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_image`
--

INSERT INTO `gallery_image` (`id`, `title`, `description`, `file_name`, `image_or_video`, `gallery_id`, `date_and_time`, `active`) VALUES
(1, 'Image 01', '', '1737356825.png', '1', '1', '2025-01-20 12:05', 1),
(2, 'Image 02', '', '1737356931.png', '1', '1', '2025-01-20 12:51', 1),
(3, 'Image 03', '', '1737356941.png', '1', '1', '2025-01-20 12:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_page`
--

CREATE TABLE `home_page` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `grade` varchar(225) NOT NULL,
  `subject` varchar(225) NOT NULL,
  `medium` varchar(225) NOT NULL,
  `teacher_name` varchar(225) NOT NULL,
  `student_name` varchar(225) NOT NULL,
  `student_grade` varchar(225) NOT NULL,
  `contact_number` varchar(225) NOT NULL,
  `actual_time` varchar(225) NOT NULL,
  `actual_date` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `k`
--

CREATE TABLE `k` (
  `userName` varchar(100) DEFAULT NULL,
  `userName2` text DEFAULT NULL,
  `location` varchar(225) DEFAULT NULL,
  `std_city` varchar(225) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `mobile` varchar(225) DEFAULT NULL,
  `telegram` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `learning_meterials`
--

CREATE TABLE `learning_meterials` (
  `id` int(11) NOT NULL,
  `learning_title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `learning_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_sinhala_ci NOT NULL,
  `file_name` varchar(225) NOT NULL,
  `lesson_id` varchar(225) NOT NULL,
  `lesson_date` varchar(225) NOT NULL,
  `lesson_time` varchar(225) NOT NULL,
  `category` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `learning_meterials`
--

INSERT INTO `learning_meterials` (`id`, `learning_title`, `learning_description`, `file_name`, `lesson_id`, `lesson_date`, `lesson_time`, `category`, `active`) VALUES
(1, 's1', '', '1737189168.png', '', '2025-01-18 02:48', '1737189168', 'slideshow', 0),
(2, 's2', '', '1737189174.png', '', '2025-01-18 02:54', '1737189174', 'slideshow', 0),
(3, 'b1', '', '1737190154.png', '', '2025-01-18 02:14', '1737190154', 'banners', 1),
(4, 'b2', '', '1737190163.png', '', '2025-01-18 02:23', '1737190163', 'banners', 1),
(5, 'b3', '', '1737190172.png', '', '2025-01-18 02:32', '1737190172', 'banners', 1),
(6, 's3', '', '1737354795.png', '', '2025-01-20 12:15', '1737354795', 'slideshow', 0),
(7, 's3', '', '1737354884.png', '', '2025-01-20 12:44', '1737354884', 'slideshow', 0),
(8, 'L1', '', '1737355516.png', '', '2025-01-20 12:16', '1737355516', 'landing', 0),
(9, 's3', '', '1737356380.png', '', '2025-01-20 12:40', '1737356380', 'slideshow', 0),
(10, 's3', '', '1737356530.png', '', '2025-01-20 12:10', '1737356530', 'slideshow', 0),
(11, 'class 01', '7q659O5d9AM', '', '1', '2025-01-22 10:15', '1737523275', '1', 1),
(12, 'class 01', 'new pdf', '1737523354.jpg', '1', '2025-01-22 10:34', '1737523354', '2', 1),
(13, 'Test 01', 'enA-x3d9YcQ', '', '19', '2026-06-05 11:08', '1780637828', '1', 1),
(14, 'first lesson', 'rtw9hQWOfaI&list=RDrtw9hQWOfaI&start_radio=1', '', '20', '2026-06-08 12:58', '1780900978', '1', 0),
(15, 'first lesson', 'RDrtw9hQWOfaI&start_radio=1', '', '20', '2026-06-08 12:32', '1780901012', '1', 0),
(16, 'first lesson', 'rLsWAkeg2AU&list=RDrLsWAkeg2AU&start_radio=1', '', '20', '2026-06-08 12:30', '1780901070', '1', 0),
(17, 'first lesson2', 'RDrLsWAkeg2AU&start_radio=1', '', '20', '2026-06-08 12:37', '1780901137', '1', 0),
(18, 'first lesson', 'es4x5R-rV9s', '', '20', '2026-06-08 12:17', '1780901177', '1', 0),
(19, 'first lesson2', 'RDrLsWAkeg2AU&start_radio', '', '20', '2026-06-08 12:38', '1780901198', '1', 0),
(20, 'first lesson2', 'rLsWAkeg2AU', '', '20', '2026-06-08 12:57', '1780901277', '1', 1),
(21, 'landing', '', '1784085728.jpeg', '', '2026-07-15 08:08', '1784085728', 'landing', 1),
(22, 'slide1', '', '1784096046.png', '', '2026-07-15 11:06', '1784096046', 'slideshow', 0),
(23, 'slide2', '', '1784096151.png', '', '2026-07-15 11:51', '1784096151', 'slideshow', 0),
(24, 'slide3', '', '1784096170.png', '', '2026-07-15 11:10', '1784096170', 'slideshow', 0),
(25, 'banner1', '', '1784101244.png', '', '2026-07-15 01:44', '1784101244', 'slideshow', 1),
(26, 'banner2', '', '1784101264.png', '', '2026-07-15 01:04', '1784101264', 'slideshow', 1),
(27, 'banner3', '', '1784101280.png', '', '2026-07-15 01:20', '1784101280', 'slideshow', 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_of_tutes`
--

CREATE TABLE `list_of_tutes` (
  `id` int(11) NOT NULL,
  `tute_name` varchar(225) NOT NULL,
  `tute_description` varchar(225) NOT NULL,
  `actual_date` varchar(225) NOT NULL,
  `actual_time` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `list_of_tutes_packed_or_not`
--

CREATE TABLE `list_of_tutes_packed_or_not` (
  `id` int(11) NOT NULL,
  `tute_id` varchar(225) NOT NULL,
  `student_id` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `actual_date` varchar(225) NOT NULL,
  `actual_time` varchar(225) NOT NULL,
  `active` int(11) NOT NULL,
  `packed_date` varchar(225) NOT NULL,
  `posted_date` varchar(225) NOT NULL,
  `posted_date_actual_date` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_group`
--

CREATE TABLE `main_group` (
  `id` int(11) NOT NULL,
  `main_group_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_sinhala_ci NOT NULL,
  `actual_date` varchar(225) NOT NULL,
  `actual_time` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `main_group`
--

INSERT INTO `main_group` (`id`, `main_group_name`, `actual_date`, `actual_time`, `active`) VALUES
(1, 'SSW Driving Class', '2025-01-18 02:30', '1737189090', 1),
(2, 'N4 Class', '2025-01-18 02:46', '1737189106', 1),
(3, 'N5 Class', '2025-01-18 02:50', '1737189110', 1),
(4, 'JFT', '2025-01-18 02:57', '1737189117', 1),
(5, 'JLPT', '2025-01-18 02:01', '1737189121', 0),
(6, 'NAT', '2025-01-18 02:05', '1737189125', 0),
(7, 'TOPJ', '2025-01-18 02:09', '1737189129', 0),
(8, 'JLCT', '2025-01-18 02:15', '1737189135', 0),
(9, 'Test 01', '2025-01-22 10:13', '1737522673', 0),
(10, 'grade 6', '2025-01-28 11:04', '1738044424', 0),
(11, 'grade 6', '2025-01-28 11:11', '1738044431', 0),
(12, 'Korean Class', '2026-06-05 11:43', '1780637563', 1),
(13, 'Japanese', '2026-06-06 11:28', '1780768408', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_options`
--

CREATE TABLE `other_options` (
  `id` int(11) NOT NULL,
  `input_1` text NOT NULL,
  `input_2` text NOT NULL,
  `input_3` text NOT NULL,
  `input_4` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `student_id` varchar(225) NOT NULL,
  `lesson_id` varchar(225) NOT NULL,
  `teacher_id` varchar(225) NOT NULL,
  `posted_time` varchar(225) NOT NULL,
  `posted_date` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `paid_date` varchar(225) NOT NULL,
  `paid_marked_by` varchar(225) NOT NULL,
  `comments` text NOT NULL,
  `system_token` varchar(225) NOT NULL,
  `active` int(11) NOT NULL,
  `reference` text NOT NULL,
  `paid_marked_user` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `student_id`, `lesson_id`, `teacher_id`, `posted_time`, `posted_date`, `status`, `paid_date`, `paid_marked_by`, `comments`, `system_token`, `active`, `reference`, `paid_marked_user`) VALUES
(1, '89', '1', '88', '89_1737523064', '2025-01-22 10:49:38am', 'Paid', '', '', '1737523156.jpg', '', 1, '', '1'),
(2, '90', '13', '93', '90_1738747310', '2025-02-05 02:54:02pm', 'Proceed', '', '', '1738747442.jpg', '', 1, '', ''),
(3, '90', '12', '93', '90_1738747378', '2025-02-05 02:52:58pm', 'Proceed', '', '', '', '', 1, '', ''),
(4, '90', '14', '94', '90_1738750658', '2025-02-05 03:47:38pm', 'Proceed', '', '', '', '', 1, '', ''),
(5, '97', '16', '93', '97_1738846687', '2025-02-06 06:29:29pm', 'Proceed', '', '', '1738846769.jpg', '', 1, '', ''),
(6, '99', '19', '98', '99_1780638068', '2026-06-05 11:12:09am', 'Paid', '', '', '1780638086.jpg', '', 1, '', '1'),
(7, '101', '20', '100', '101_1780900865', '2026-06-08 12:18:52pm', 'Paid', '', '', '1780901303.jpg', '', 1, '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `request_for_quote`
--

CREATE TABLE `request_for_quote` (
  `id` int(11) NOT NULL,
  `number_of_empoyees` text NOT NULL,
  `no_of_students` text NOT NULL,
  `number_of_trainers` text NOT NULL,
  `average` text NOT NULL,
  `requirement` text NOT NULL,
  `team_or_webinar` varchar(225) NOT NULL,
  `teacher_id` varchar(225) NOT NULL,
  `posted_time` varchar(225) NOT NULL,
  `posted_date` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students_attendance`
--

CREATE TABLE `students_attendance` (
  `id` int(11) NOT NULL,
  `userSession` int(11) NOT NULL,
  `actual_time` varchar(225) NOT NULL,
  `actual_date` varchar(225) NOT NULL,
  `student_rfid` varchar(225) NOT NULL,
  `active` int(11) NOT NULL,
  `student_name` varchar(225) NOT NULL,
  `userName` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `userName2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userStatus` varchar(225) NOT NULL,
  `tokenCode` varchar(100) NOT NULL,
  `mobile` varchar(225) NOT NULL,
  `whatsapp_or_viber` varchar(225) NOT NULL,
  `selected_ol_al_grade` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `selected_medium` text CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `selected_subject` text CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `subject` text CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `grade` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `location` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `selected_package` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `school` varchar(225) CHARACTER SET utf8mb3 COLLATE utf8mb3_sinhala_ci NOT NULL,
  `batch` varchar(225) NOT NULL,
  `type` varchar(225) NOT NULL,
  `p_picture` varchar(225) NOT NULL,
  `institute_id` varchar(225) NOT NULL,
  `institute_id_verified` varchar(225) NOT NULL,
  `order_by` varchar(225) NOT NULL,
  `telegram` varchar(225) NOT NULL,
  `real_email` varchar(225) NOT NULL,
  `institute_name` varchar(225) NOT NULL,
  `std_city` varchar(225) NOT NULL,
  `actual_time` varchar(225) NOT NULL,
  `actual_date` varchar(225) NOT NULL,
  `student_emboss` varchar(225) NOT NULL,
  `student_rfid` varchar(225) NOT NULL,
  `index_number` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userName2`, `userEmail`, `userPass`, `userStatus`, `tokenCode`, `mobile`, `whatsapp_or_viber`, `selected_ol_al_grade`, `selected_medium`, `selected_subject`, `subject`, `grade`, `location`, `selected_package`, `school`, `batch`, `type`, `p_picture`, `institute_id`, `institute_id_verified`, `order_by`, `telegram`, `real_email`, `institute_name`, `std_city`, `actual_time`, `actual_date`, `student_emboss`, `student_rfid`, `index_number`) VALUES
(1, 'Admin', 'Admin', '0778783728', '202cb962ac59075b964b07152d234b70', 'Y', '70907e1dd3ca6aa88dd1f3d0e7bd2ae0', '0740757788', '', '', '1784088928.jpg', ' lkconfiance@gmail.com', '', 'Student', 'Colombo 03', '', 'CONFIANCE', 'Sinhala', '1', '1784088916.jpg', '', 'N', '', '', '', 'Online Classes', 'Colombo', '1720809977', '2024-07-13 12:16:17am', '', '', ''),
(90, 'tharusha', 'rathnayaka', '0766120661', '202cb962ac59075b964b07152d234b70', 'Y', '99034e6a7aa0a2d2b03b4e03d3a70c80', '0766120661', '', '', '', 'rath@gmail.com', '', 'Student', 'stulugam', '200131502115', 'rcc', '', '3', '', '', 'N', '', '', '12', 'Online Classes', 'Nuwara Eliya', '1738039780', '2025-01-28 10:19:40am', '', '', '25TR2001159'),
(93, 'Group A', '', '1056237357', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Y', '89c7a613ddf94e8ea470171f427102f4', '', '', '1', '', '', 'sinhala', 'Tutor', '', '', 'SSW', '', '2', '', '', 'N', '', '', '', '', '', '', '', '', '', ''),
(94, 'Group A', '', '1014505078', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Y', '5e7be7b818b64152262857be76889e73', '', '', '4', '', '', 'sinhala', 'Tutor', '', '', 'jft', '', '4', '', '', 'N', '', '', '', '', '', '', '', '', '', ''),
(95, 'lesson2', '', '1008789102', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Y', '1a5a8ba855a5faf35bba52cc761df01a', '', '', '4', '', '', 'sinhala', 'Tutor', '', '', 'jft', '', '4', '', '', 'N', '', '', '', '', '', '', '', '', '', ''),
(96, 'Group A', '', '1053873508', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Y', '9b224ac43da55c40ecd95e9c0a5570d1', '', '', '4', '', '', 'sinhala', 'Tutor', '', '', 'jft', '', '2', '', '', 'N', '', '', '', '', '', '', '', '', '', ''),
(97, 'Namal', 'Dissanayake', '0713542887', '9562bdbd47d64c138f838216e30c3f19', 'Y', '9a79350f9c949c7a9b06019bd6a4be9a', '0713542887', '', '', '', 'namalcalifornia@gmail.com', '', 'Student', '', '', '', '', '3', '', '', 'N', '', '', '', 'Online Classes', 'Gampaha', '1738846606', '2025-02-06 06:26:46pm', '', '', ''),
(98, 'Batch 01', '', '1058561584', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Y', '6cb7d76d0f944aa65d4434137b5c33c8', '', '', '12', '', '', 'sinhala', 'Tutor', '', '', 'kOREAN', '', '2', '', '', 'N', '', '', '', '', '', '', '', '', '', ''),
(99, 'Test', 'Test', '0764341448', '202cb962ac59075b964b07152d234b70', 'Y', '0366c196ccc8e7882b59d8251a303155', '4646636552424', '', '', '', 'test@gmail.com', '', 'Student', 'Test', 'Test', 'Test', '', '3', '', '', 'N', '', '', 'Test', 'Online Classes', 'Jaffna', '1780637980', '2026-06-05 11:09:40am', '', '', '26TTTest842'),
(100, 'june batch', '', '1090450066', 'a906449d5769fa7361d7ecc6aa3f6d28', 'Y', '19982604060bb14f439b1a802bea45cb', '', '', '13', 'learn to jap', '', 'sinhala', 'Tutor', '', '', 'jap', '', '2', '1781246745.jpg', '', 'N', '', '', '', '', '', '', '', '', '', ''),
(101, 'Danidu', 'Wanasinghe', '0704680835', '202cb962ac59075b964b07152d234b70', 'Y', '311d328a09ffa34d6ada2a8c12b46945', '0779864845', '', '', '', 'dsaviddhya@gmail.com', '', 'Student', '682, Nachchaduwa Road, Nelumkulama, Anuradhapura', '50036', '', '', '3', '', '', 'N', '', '', 'dsaviddhya@gmail.com', 'Online Classes', 'Anuradhapura', '1780900520', '2026-06-08 12:05:20pm', '', '', '26DW5003479');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_payouts`
--

CREATE TABLE `tutor_payouts` (
  `id` int(11) NOT NULL,
  `teacher_id` varchar(225) NOT NULL,
  `payout_title` varchar(225) NOT NULL,
  `category` varchar(225) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `payout_date_time` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `real_date` varchar(225) NOT NULL,
  `real_time` varchar(225) NOT NULL,
  `status` varchar(225) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `watch_now`
--

CREATE TABLE `watch_now` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `watch_now`
--

INSERT INTO `watch_now` (`id`, `lesson_id`, `video_id`, `student_id`, `active`) VALUES
(1, 1, 11, 89, 0),
(2, 19, 13, 99, 1),
(3, 19, 13, 99, 1),
(4, 20, 20, 101, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zoom_accounts`
--

CREATE TABLE `zoom_accounts` (
  `id` int(11) NOT NULL,
  `email_address` text NOT NULL,
  `zoom_name` text NOT NULL,
  `api_key` text NOT NULL,
  `api_secret` text NOT NULL,
  `actual_date` text NOT NULL,
  `actual_time` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `zoom_accounts`
--

INSERT INTO `zoom_accounts` (`id`, `email_address`, `zoom_name`, `api_key`, `api_secret`, `actual_date`, `actual_time`, `active`) VALUES
(1, 'lkconfiance@gmail.com', 'Confiance_Lk', '_ZC8pLHTzKg3rVp7TNSng', 'FXfno2d7HM5sztBjC6w0OlhIvk2dgtgV', '2026-06-08 11:46', '1780899346', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_token_free`
--
ALTER TABLE `buy_token_free`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_image`
--
ALTER TABLE `gallery_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learning_meterials`
--
ALTER TABLE `learning_meterials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_of_tutes`
--
ALTER TABLE `list_of_tutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_of_tutes_packed_or_not`
--
ALTER TABLE `list_of_tutes_packed_or_not`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_group`
--
ALTER TABLE `main_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_options`
--
ALTER TABLE `other_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_for_quote`
--
ALTER TABLE `request_for_quote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students_attendance`
--
ALTER TABLE `students_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `tutor_payouts`
--
ALTER TABLE `tutor_payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watch_now`
--
ALTER TABLE `watch_now`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zoom_accounts`
--
ALTER TABLE `zoom_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy_token_free`
--
ALTER TABLE `buy_token_free`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery_image`
--
ALTER TABLE `gallery_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `home_page`
--
ALTER TABLE `home_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learning_meterials`
--
ALTER TABLE `learning_meterials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `list_of_tutes`
--
ALTER TABLE `list_of_tutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_of_tutes_packed_or_not`
--
ALTER TABLE `list_of_tutes_packed_or_not`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `main_group`
--
ALTER TABLE `main_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `other_options`
--
ALTER TABLE `other_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_for_quote`
--
ALTER TABLE `request_for_quote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_attendance`
--
ALTER TABLE `students_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `tutor_payouts`
--
ALTER TABLE `tutor_payouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `watch_now`
--
ALTER TABLE `watch_now`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `zoom_accounts`
--
ALTER TABLE `zoom_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
