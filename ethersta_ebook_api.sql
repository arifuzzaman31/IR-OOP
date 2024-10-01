-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2024 at 02:53 AM
-- Server version: 10.5.26-MariaDB-cll-lve
-- PHP Version: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ethersta_ebook_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `circular`
--

CREATE TABLE `circular` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `template_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `jury_members` longtext DEFAULT NULL,
  `cover_image_id` int(11) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `circular`
--

INSERT INTO `circular` (`id`, `slug`, `template_id`, `title`, `description`, `jury_members`, `cover_image_id`, `deadline`, `status`, `created_at`, `updated_at`) VALUES
(1, '4071723025604', 5, 'abc', NULL, '[\"10\"]', NULL, '2024-08-01', 1, '2024-08-07 14:13:24', '2024-08-07 10:13:24'),
(2, '7981723356153', 3, 'Test Circular', NULL, '{\"1\":\"8\",\"2\":\"13\"}', NULL, '2024-08-13', 1, '2024-08-11 10:02:33', '2024-08-11 06:05:29'),
(3, '8681723612773', 2, 'Facere facere eiusmo', NULL, '[\"8\",\"10\",\"11\"]', 42, '1978-09-12', 1, '2024-08-14 09:19:33', '2024-08-14 05:19:33'),
(4, '6241723612814', 7, 'Qui autem voluptatem', NULL, '[\"6\",\"10\",\"11\",\"3\"]', 43, '2025-10-11', 1, '2024-08-14 09:20:14', '2024-08-14 05:25:34'),
(5, '2081723612817', 7, 'Qui autem voluptatem', NULL, '[\"6\",\"10\",\"11\",\"3\"]', 43, '2025-10-11', 1, '2024-08-14 09:20:17', '2024-08-14 05:26:44'),
(7, '6741723972778', 6, 'Culpa pariatur Arc test', NULL, '[\"8\",\"3\",\"13\"]', 45, '2025-01-11', 1, '2024-08-18 13:19:38', '2024-08-29 06:48:38'),
(8, '8121724909410', 4, 'NEW EBOOK', NULL, '[\"3\"]', 49, '2024-12-30', 1, '2024-08-29 09:30:10', '2024-08-29 05:30:10'),
(9, '2341724910026', 2, 'Testing Ebook', NULL, '[\"3\"]', 50, '2024-09-19', 1, '2024-08-29 09:40:26', '2024-08-29 05:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `template_id` bigint(20) UNSIGNED DEFAULT NULL,
  `circular_id` int(11) DEFAULT NULL,
  `author_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cover_image_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(999) DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `form_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`form_data`)),
  `slug` varchar(255) DEFAULT NULL,
  `jury_members` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `approval_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `template_id`, `circular_id`, `author_id`, `cover_image_id`, `title`, `author_name`, `date`, `form_data`, `slug`, `jury_members`, `approval_status`, `approved_by`, `approved_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, 7, 41, 'Lorem Ipsum', 'Alisa', '2024-08-11', '{\"_token\":\"cjc30A5gnR6M6XE8qQilFPEA1Q4y95uE0j60bAIt\",\"ebook_title\":\"Lorem Ipsum\",\"ebook_author_name\":\"Alisa\",\"ebook_date\":\"2024-08-11\",\"cover_image_id\":\"41\",\"ebook_abstract\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"ebook_intro\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"ebook_literature_review\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"ebook_method\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"ebook_rd\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"ebook_cr\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"ebook_reference\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"slug\":\"6831723365915\",\"method\":\"edit\",\"type\":\"Article\",\"template_id\":\"3\",\"templete_type\":\"article\",\"circular_id\":\"2\",\"submission_type\":\"submit\"}', '6831723365915', NULL, 'Published', NULL, NULL, 1, '2024-08-11 12:45:15', '2024-08-12 16:03:46'),
(2, 7, 4, 1, 44, 'Fuga Et architecto', 'Kiona Cobb', '1990-04-09', '{\"_token\":\"wsokAUOvi9ZIrjmPjW6oQFRekOTVOMehkJd3jmTt\",\"ebook_title\":\"Fuga Et architecto\",\"ebook_author_name\":\"Kiona Cobb\",\"ebook_date\":\"1990-04-09\",\"cover_image_id\":\"44\",\"introduction\":\"Corrupti adipisci n\",\"key_achievement\":\"Eos autem esse vel\",\"participants_benifited\":\"Quod odio aliquid qu\",\"strategy\":\"Magni accusantium du\",\"leason_learned\":\"Earum odio aut sunt\",\"action_photo\":\"Delectus culpa rem\",\"method\":\"create\",\"type\":\"Promising Practices\",\"template_id\":\"7\",\"templete_type\":\"proomising_practices\",\"circular_id\":\"4\",\"submission_type\":\"submit\"}', '9771723612989', NULL, 'Published', NULL, NULL, 1, '2024-08-14 09:23:09', '2024-08-18 09:22:03'),
(4, 6, 7, 1, 47, 'Consectetur id sunt', 'Octavius Schultz', '2002-04-14', '{\"_token\":\"ZIgaKOTPHGQXrkYjCKkYucWBFznKlTpEcWxoMo0y\",\"ebook_title\":\"Consectetur id sunt\",\"ebook_author_name\":\"Octavius Schultz\",\"ebook_date\":\"2002-04-14\",\"cover_image_id\":\"47\",\"introduction\":\"Sint magna iusto ap\",\"problem_solution\":\"Ipsum exercitationem\",\"organization_contribution\":\"Sapiente aperiam sun\",\"community_contribution\":\"Fugiat culpa velit\",\"sustain_success\":\"Voluptatem Proident\",\"participants_quotes\":\"Neque et cupidatat q\",\"action_photo\":\"Eligendi molestiae i\",\"method\":\"create\",\"type\":\"Sucesss Story\",\"template_id\":\"6\",\"templete_type\":\"success_story\",\"circular_id\":\"7\",\"submission_type\":\"submit\"}', '6561723974235', NULL, 'Published', NULL, NULL, 1, '2024-08-18 13:43:55', '2024-09-02 09:24:31'),
(5, 7, 4, 7, 48, 'Test-Promising Practices - Qui autem voluptatem', 'Alisa', '2024-08-29', '{\"_token\":\"eyby4mQN75TrWcPt1mRnauw5DhgIaHd6VZjnTjP8\",\"ebook_title\":\"Test-Promising Practices - Qui autem voluptatem\",\"ebook_author_name\":\"Alisa\",\"ebook_date\":\"2024-08-29\",\"cover_image_id\":\"48\",\"introduction\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"key_achievement\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"participants_benifited\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"strategy\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"leason_learned\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"action_photo\":\"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\",\"method\":\"create\",\"type\":\"Promising Practices\",\"template_id\":\"7\",\"templete_type\":\"proomising_practices\",\"circular_id\":\"4\",\"submission_type\":\"submit\"}', '9861724907591', NULL, 'InReview', NULL, NULL, 1, '2024-08-29 08:59:51', '2024-08-29 09:08:38'),
(6, 6, 7, 7, NULL, 'Test Sucesss Story - Culpa pariatur Arc test', 'Alisa', '2024-08-29', '{\"_token\":\"eyby4mQN75TrWcPt1mRnauw5DhgIaHd6VZjnTjP8\",\"ebook_title\":\"Test Sucesss Story - Culpa pariatur Arc test\",\"ebook_author_name\":\"Alisa\",\"ebook_date\":\"2024-08-29\",\"cover_image_id\":null,\"introduction\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\",\"problem_solution\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\",\"organization_contribution\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as oppose\",\"community_contribution\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as oppose\",\"sustain_success\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as oppose\",\"participants_quotes\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as oppose\",\"action_photo\":\"It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as oppose\",\"method\":\"create\",\"type\":\"Sucesss Story\",\"template_id\":\"6\",\"templete_type\":\"success_story\",\"circular_id\":\"7\",\"submission_type\":\"submit\"}', '9741724907703', NULL, 'InReview', NULL, NULL, 1, '2024-08-29 09:01:43', '2024-08-29 09:08:22'),
(7, 6, 7, 4, NULL, 'abc', 'abc', '2024-08-30', '{\"_token\":\"bbhQJq6fRH8fzYtmv9AHfz094W18e5s1enl1JInw\",\"ebook_title\":\"abc\",\"ebook_author_name\":\"abc\",\"ebook_date\":\"2024-08-30\",\"cover_image_id\":null,\"introduction\":\"abc\",\"problem_solution\":\"abc\",\"organization_contribution\":\"abc\",\"community_contribution\":\"abc\",\"sustain_success\":\"abc\",\"participants_quotes\":\"abc\",\"action_photo\":\"abc\",\"method\":\"create\",\"type\":\"Sucesss Story\",\"template_id\":\"6\",\"templete_type\":\"success_story\",\"circular_id\":\"7\",\"submission_type\":\"submit\"}', '4091724908981', NULL, 'Pending', NULL, NULL, 1, '2024-08-29 09:23:01', '2024-08-29 09:23:01'),
(8, 4, 8, 4, NULL, 'abc', 'Masum', '2024-09-12', '{\"_token\":\"bbhQJq6fRH8fzYtmv9AHfz094W18e5s1enl1JInw\",\"ebook_title\":\"abc\",\"ebook_author_name\":\"Masum\",\"ebook_date\":\"2024-09-12\",\"cover_image_id\":null,\"problem\":\"test\",\"why_innovative\":\"test\",\"participants\":\"test\",\"how_work\":\"test\",\"look_like\":\"test\",\"benifits_participants\":\"test\",\"benefit_organization\":\"test\",\"scale_up\":\"test\",\"method\":\"create\",\"type\":\"Innovative Idea\",\"template_id\":\"4\",\"templete_type\":\"innovative_idea\",\"circular_id\":\"8\",\"submission_type\":\"submit\"}', '7631724909513', NULL, 'InReview', NULL, NULL, 1, '2024-08-29 09:31:53', '2024-08-29 09:33:20'),
(9, 2, 9, 4, NULL, 'Testing', 'test', '2024-08-30', '{\"_token\":\"bbhQJq6fRH8fzYtmv9AHfz094W18e5s1enl1JInw\",\"ebook_title\":\"Testing\",\"ebook_author_name\":\"test\",\"ebook_date\":\"2024-08-30\",\"cover_image_id\":null,\"ebook_abstract\":\"abc\",\"ebook_intro\":\"abc\",\"ebook_literature_review\":\"abc\",\"ebook_method\":\"xyz\",\"ebook_rd\":\"xyz\",\"ebook_cr\":\"xyz\",\"ebook_reference\":\"xyz\",\"method\":\"create\",\"type\":\"Research\",\"template_id\":\"2\",\"templete_type\":\"research\",\"circular_id\":\"9\",\"submission_type\":\"submit\"}', '9051724910150', NULL, 'InReview', NULL, NULL, 1, '2024-08-29 09:42:30', '2024-08-29 09:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE `evaluation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jury_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ebook_id` bigint(20) UNSIGNED DEFAULT NULL,
  `evaluation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`evaluation`)),
  `total_mark` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`total_mark`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`id`, `jury_id`, `ebook_id`, `evaluation`, `total_mark`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '[{\"field\":\"ebook_abstract\",\"ebook_comment\":\"good\",\"ebook_mark\":\"4\"}]', '4', 1, '2024-08-12 15:24:35', '2024-08-12 15:24:35'),
(2, 1, 2, '[{\"field\":\"ebook_title\",\"ebook_comment\":\"dfgdfg\",\"ebook_mark\":\"4\"},{\"field\":\"key_achievement\",\"ebook_comment\":\"dfgdfgd\",\"ebook_mark\":\"6\"}]', '10', 1, '2024-08-14 09:27:31', '2024-08-14 09:27:31'),
(3, 3, 8, '[{\"field\":\"problem\",\"ebook_comment\":\"ankjsa\",\"ebook_mark\":\"8\"},{\"field\":\"why_innovative\",\"ebook_comment\":null,\"ebook_mark\":\"17\"}]', '25', 1, '2024-08-29 09:34:24', '2024-08-29 09:34:24'),
(4, 3, 9, '[{\"field\":\"ebook_abstract\",\"ebook_comment\":null,\"ebook_mark\":\"5\"},{\"field\":\"ebook_intro\",\"ebook_comment\":null,\"ebook_mark\":\"4\"},{\"field\":\"ebook_literature_review\",\"ebook_comment\":null,\"ebook_mark\":\"8\"}]', '17', 1, '2024-08-29 09:44:22', '2024-08-29 09:44:22'),
(5, 13, 6, '[{\"field\":\"introduction\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"3\"},{\"field\":\"problem_solution\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"7\"},{\"field\":\"organization_contribution\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"1\"},{\"field\":\"community_contribution\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"4\"},{\"field\":\"sustain_success\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"5\"},{\"field\":\"participants_quotes\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"6\"},{\"field\":\"action_photo\",\"ebook_comment\":\"What is Lorem Ipsum?\",\"ebook_mark\":\"8\"},{\"field\":\"evaluation\",\"ebook_comment\":\"What is Lorem Ipsum?\\nWhat is Lorem Ipsum?\\nWhat is Lorem Ipsum?\\nWhat is Lorem Ipsum?\\nWhat is Lorem Ipsum?\",\"ebook_mark\":\"10\"},{\"field\":\"ebook_title\",\"ebook_comment\":\"Title perfect\",\"ebook_mark\":\"7\"}]', '51', 1, '2024-08-29 11:17:50', '2024-08-29 11:17:50'),
(6, 8, 4, '[{\"field\":\"ebook_title\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"8\"},{\"field\":\"introduction\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"3\"},{\"field\":\"problem_solution\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"5\"},{\"field\":\"organization_contribution\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"1\"},{\"field\":\"community_contribution\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"6\"},{\"field\":\"sustain_success\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"7\"},{\"field\":\"participants_quotes\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"7\"},{\"field\":\"action_photo\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"8\"},{\"field\":\"evaluation\",\"ebook_comment\":\"If you use this site regularly and would like to help keep the site on the Internet, please consider donating a small sum to help pay for the hosting and bandwidth bill. There is no minimum donation, any sum is appreciated\",\"ebook_mark\":\"9\"}]', '54', 1, '2024-08-29 12:45:23', '2024-08-29 12:45:23'),
(7, 13, 4, '[{\"field\":\"ebook_title\",\"ebook_comment\":\"dfgdgdgfgf\",\"ebook_mark\":\"3\"},{\"field\":\"introduction\",\"ebook_comment\":\"xvccvbcvb\",\"ebook_mark\":\"3\"},{\"field\":\"problem_solution\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"7\"},{\"field\":\"organization_contribution\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"1\"},{\"field\":\"community_contribution\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"5\"},{\"field\":\"sustain_success\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"3\"},{\"field\":\"participants_quotes\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"7\"},{\"field\":\"action_photo\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"6\"},{\"field\":\"evaluation\",\"ebook_comment\":\"dvgfgbfxfhfgh\",\"ebook_mark\":\"7\"}]', '42', 1, '2024-09-02 09:11:31', '2024-09-02 09:11:31');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `title`, `file_name`, `file_type`, `file_path`, `file_size`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pexels-photo-1433052.jpeg', 'mave_u8BnDg.jpg', 'image/jpeg', 'media/mave_u8BnDg.jpg', NULL, 1, '2024-04-03 06:56:21', '2024-04-03 06:56:21'),
(2, 'pexels-photo-1433052.jpeg', 'mave_YfZTBG.jpg', 'image/jpeg', 'media/mave_YfZTBG.jpg', NULL, 1, '2024-04-03 07:03:25', '2024-04-03 07:03:25'),
(3, 'pexels-photo-1433052.jpeg', 'mave_xT0ZzD.jpg', 'image/jpeg', 'media/mave_xT0ZzD.jpg', NULL, 1, '2024-04-03 07:04:47', '2024-04-03 07:04:47'),
(4, 'pexels-photo-1388069.jpeg', 'mave_GRNCkc.jpg', 'image/jpeg', 'media/mave_GRNCkc.jpg', NULL, 1, '2024-04-03 07:07:47', '2024-04-03 07:07:47'),
(5, 'pexels-photo-1324803.jpeg', 'mave_VW3yFF.jpg', 'image/jpeg', 'media/mave_VW3yFF.jpg', NULL, 1, '2024-04-03 07:15:10', '2024-04-03 07:15:10'),
(6, 'pexels-photo-1388069.jpeg', 'mave_eOMYqg.jpg', 'image/jpeg', 'media/mave_eOMYqg.jpg', NULL, 1, '2024-04-04 01:56:21', '2024-04-04 01:56:21'),
(7, 'pexels-photo-1388069.jpeg', 'mave_oK4Ch9.jpg', 'image/jpeg', 'media/mave_oK4Ch9.jpg', NULL, 1, '2024-04-04 02:02:26', '2024-04-04 02:02:26'),
(8, 'pexels-photo-1388069.jpeg', 'mave_5nn8OC.jpg', 'image/jpeg', 'media/mave_5nn8OC.jpg', NULL, 1, '2024-04-04 02:03:09', '2024-04-04 02:03:09'),
(9, 'pexels-photo-2406382.jpeg', 'mave_Nhi3Mr.jpg', 'image/jpeg', 'media/mave_Nhi3Mr.jpg', NULL, 1, '2024-04-04 02:33:08', '2024-04-04 02:33:08'),
(10, 'pexels-photo-1519088.jpeg', 'mave_zD36iE.jpg', 'image/jpeg', 'media/mave_zD36iE.jpg', NULL, 1, '2024-04-04 02:34:02', '2024-04-04 02:34:02'),
(11, 'pexels-photo-1519088.jpeg', 'mave_OxtoTN.jpg', 'image/jpeg', 'media/mave_OxtoTN.jpg', NULL, 1, '2024-04-17 06:15:35', '2024-04-17 06:15:35'),
(12, 'pexels-photo-1519088.jpeg', 'mave_tKpQ6J.jpg', 'image/jpeg', 'media/mave_tKpQ6J.jpg', NULL, 1, '2024-04-17 06:22:51', '2024-04-17 06:22:51'),
(13, 'pexels-photo-1519088.jpeg', 'mave_sxiynQ.jpg', 'image/jpeg', 'media/mave_sxiynQ.jpg', NULL, 1, '2024-04-17 06:24:33', '2024-04-17 06:24:33'),
(14, 'pexels-photo-1563355.jpeg', 'mave_StIxqc.jpg', 'image/jpeg', 'media/mave_StIxqc.jpg', NULL, 1, '2024-04-17 06:25:20', '2024-04-17 06:25:20'),
(15, 'pexels-photo-1433052.jpeg', 'mave_doOgj8.jpg', 'image/jpeg', 'media/mave_doOgj8.jpg', NULL, 1, '2024-04-17 06:27:12', '2024-04-17 06:27:12'),
(16, 'pexels-photo-1388069.jpeg', 'mave_1SO3Ge.jpg', 'image/jpeg', 'media/mave_1SO3Ge.jpg', NULL, 1, '2024-04-17 06:27:29', '2024-04-17 06:27:29'),
(17, 'pexels-photo-1519088.jpeg', 'mave_soOoVn.jpg', 'image/jpeg', 'media/mave_soOoVn.jpg', NULL, 1, '2024-04-17 07:08:45', '2024-04-17 07:08:45'),
(18, 'pexels-photo-101667.jpeg', 'mave_yz761o.jpg', 'image/jpeg', 'media/mave_yz761o.jpg', NULL, 1, '2024-04-17 10:18:07', '2024-04-17 10:18:07'),
(19, 'pexels-photo-1324803.jpeg', 'mave_ffiOWs.jpg', 'image/jpeg', 'media/mave_ffiOWs.jpg', NULL, 1, '2024-04-22 05:55:31', '2024-04-22 05:55:31'),
(20, 'pexels-photo-1388069.jpeg', 'mave_tbyMOg.jpg', 'image/jpeg', 'media/mave_tbyMOg.jpg', NULL, 1, '2024-04-22 05:56:04', '2024-04-22 05:56:04'),
(21, 'pexels-photo-2406382.jpeg', 'mave_6Bpmni.jpg', 'image/jpeg', 'media/mave_6Bpmni.jpg', NULL, 1, '2024-04-22 06:11:03', '2024-04-22 06:11:03'),
(22, 'pexels-photo-103123.jpeg', 'mave_g90NkW.jpg', 'image/jpeg', 'media/mave_g90NkW.jpg', NULL, 1, '2024-04-22 06:13:29', '2024-04-22 06:13:29'),
(23, 'pexels-photo-1388069.jpeg', 'mave_nrzccI.jpg', 'image/jpeg', 'media/mave_nrzccI.jpg', NULL, 1, '2024-04-22 06:14:41', '2024-04-22 06:14:41'),
(24, 'pexels-photo-103123.jpeg', 'mave_WRD4Eb.jpg', 'image/jpeg', 'media/mave_WRD4Eb.jpg', NULL, 1, '2024-04-23 10:16:30', '2024-04-23 10:16:30'),
(25, 'pexels-photo-101667.jpeg', 'mave_XS1UUp.jpg', 'image/jpeg', 'media/mave_XS1UUp.jpg', NULL, 1, '2024-05-06 12:18:21', '2024-05-06 12:18:21'),
(26, '437546014_1248112846165598_5371636502426091569_n.jpg', 'mave_JwLzfC.jpg', 'image/jpeg', 'media/mave_JwLzfC.jpg', NULL, 1, '2024-05-07 08:53:58', '2024-05-07 08:53:58'),
(27, 'Tonello wash machine.JPG', 'mave_h3YfjR.jpg', 'image/jpeg', 'media/mave_h3YfjR.jpg', NULL, 1, '2024-05-07 12:06:21', '2024-05-07 12:06:21'),
(28, 'pexels-photo-1324803.jpeg', 'mave_0izibR.jpg', 'image/jpeg', 'media/mave_0izibR.jpg', NULL, 1, '2024-05-16 13:24:11', '2024-05-16 13:24:11'),
(29, 'pexels-photo-2406382.jpeg', 'mave_uW7VVq.jpg', 'image/jpeg', 'media/mave_uW7VVq.jpg', NULL, 1, '2024-05-16 13:24:24', '2024-05-16 13:24:24'),
(30, 'ActionAid_First Draft_GLA Endline Evaluation_14052024.pdf', 'mave_9nOjKH.pdf', 'application/pdf', 'media/mave_9nOjKH.pdf', NULL, 1, '2024-05-21 10:47:31', '2024-05-21 10:47:31'),
(31, 'Picture1.jpg', 'mave_mczbeC.jpg', 'image/jpeg', 'media/mave_mczbeC.jpg', NULL, 1, '2024-05-23 08:14:37', '2024-05-23 08:14:37'),
(32, 'pexels-photo-103123.jpeg', 'mave_JmyPXL.jpg', 'image/jpeg', 'media/mave_JmyPXL.jpg', NULL, 1, '2024-05-30 10:44:00', '2024-05-30 10:44:00'),
(33, 'pexels-photo-2406382.jpeg', 'mave_GRQgFt.jpg', 'image/jpeg', 'media/mave_GRQgFt.jpg', NULL, 1, '2024-06-02 16:23:37', '2024-06-02 16:23:37'),
(34, 'pexels-photo-1906658.jpeg', 'mave_WF9K1n.jpg', 'image/jpeg', 'media/mave_WF9K1n.jpg', NULL, 1, '2024-06-02 16:24:23', '2024-06-02 16:24:23'),
(35, 'Cover Image_40 years-1.jpg', 'mave_47LfmX.jpg', 'image/jpeg', 'media/mave_47LfmX.jpg', NULL, 1, '2024-07-03 07:19:36', '2024-07-03 07:19:36'),
(36, 'Shahin Update.png', 'mave_17Kfhh.png', 'image/png', 'media/mave_17Kfhh.png', NULL, 1, '2024-07-03 07:24:12', '2024-07-03 07:24:12'),
(37, '2.png', 'mave_IaiFFt.webp', 'image/png', 'media/mave_IaiFFt.webp', NULL, 1, '2024-08-07 01:44:41', '2024-08-07 01:44:41'),
(38, '1.png', 'mave_dMBydg.webp', 'image/png', 'media/mave_dMBydg.webp', NULL, 1, '2024-08-07 08:43:42', '2024-08-07 08:43:42'),
(39, 'Sky.jpeg', 'mave_IMkLHs.jpg', 'image/jpeg', 'media/mave_IMkLHs.jpg', NULL, 1, '2024-08-11 09:55:18', '2024-08-11 09:55:18'),
(40, 'Appraisal.jpg', 'mave_FlFcFC.jpg', 'image/jpeg', 'media/mave_FlFcFC.jpg', NULL, 1, '2024-08-11 10:04:59', '2024-08-11 10:04:59'),
(41, 'Tea Box.jpg', 'mave_OrRnIJ.jpg', 'image/jpeg', 'media/mave_OrRnIJ.jpg', NULL, 1, '2024-08-11 12:44:26', '2024-08-11 12:44:26'),
(42, 'pexels-photo-1388069.jpeg', 'mave_iRBmHR.jpg', 'image/jpeg', 'media/mave_iRBmHR.jpg', NULL, 1, '2024-08-14 09:19:31', '2024-08-14 09:19:31'),
(43, 'pexels-photo-1433052.jpeg', 'mave_ab2t3F.jpg', 'image/jpeg', 'media/mave_ab2t3F.jpg', NULL, 1, '2024-08-14 09:20:07', '2024-08-14 09:20:07'),
(44, 'pexels-photo-101667.jpeg', 'mave_XwcmSp.jpg', 'image/jpeg', 'media/mave_XwcmSp.jpg', NULL, 1, '2024-08-14 09:22:59', '2024-08-14 09:22:59'),
(45, 'pexels-photo-101667.jpeg', 'mave_n4Qu6K.jpg', 'image/jpeg', 'media/mave_n4Qu6K.jpg', NULL, 1, '2024-08-18 13:19:18', '2024-08-18 13:19:18'),
(46, '437546014_1248112846165598_5371636502426091569_n.jpg', 'mave_0ezqVE.jpg', 'image/jpeg', 'media/mave_0ezqVE.jpg', NULL, 1, '2024-08-18 13:22:07', '2024-08-18 13:22:07'),
(47, 'pexels-photo-1324803.jpeg', 'mave_I15o33.jpg', 'image/jpeg', 'media/mave_I15o33.jpg', NULL, 1, '2024-08-18 13:43:47', '2024-08-18 13:43:47'),
(48, 'AA Logo.jpg', 'mave_dOmG7m.jpg', 'image/jpeg', 'media/mave_dOmG7m.jpg', NULL, 1, '2024-08-29 08:59:13', '2024-08-29 08:59:13'),
(49, 'hamburger.png', 'mave_xo8Lkn.png', 'image/png', 'media/mave_xo8Lkn.png', NULL, 1, '2024-08-29 09:30:05', '2024-08-29 09:30:05'),
(50, 'Screenshot 2024-08-28 153403.png', 'mave_0ZRI8v.png', 'image/png', 'media/mave_0ZRI8v.png', NULL, 1, '2024-08-29 09:40:19', '2024-08-29 09:40:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_21_063347_create_templates_table', 1),
(6, '2024_03_21_063437_create_ebooks_table', 1),
(7, '2024_03_21_063448_create_evaluation_table', 1),
(8, '2024_03_21_063459_create_roles_table', 1),
(9, '2024_03_21_063515_create_permissions_table', 1),
(10, '2024_03_21_063704_create_media_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `updated_at`, `created_at`) VALUES
('nashita.iftekhar@webable.digital', 'Y7aLttxLz9EBh6p3UiavEWx5YVuGERjx9NNreHh95rW07kxbSeLpuaUQeUs9', '2024-06-02 12:49:52', '2024-06-02 16:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permissions`)),
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `permissions`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, 1, NULL, NULL),
(2, 'Admin', NULL, 1, NULL, NULL),
(3, 'Jury', NULL, 1, NULL, NULL),
(4, 'Author', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `structure` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`structure`)),
  `evaluation_criteria` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`evaluation_criteria`)),
  `jury_members` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`jury_members`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `slug`, `title`, `structure`, `evaluation_criteria`, `jury_members`, `created_at`, `updated_at`) VALUES
(1, 'study', 'Study', '[\n    {\n        \"title\": \"Study Title\",\n        \"form_name\": \"ebook_title\",\n        \"max_word_count\": 20,\n        \"evaluation_query\": \"Study title is aligned with descriptions in the article\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Abstract\",\n        \"form_name\": \"ebook_abstract\",\n        \"max_word_count\": 200,\n        \"evaluation_query\": \"Abstract expressed summary of article as well\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Introduction and Objective\",\n        \"form_name\": \"ebook_intro\",\n        \"max_word_count\": 200,\n        \"evaluation_query\": \"Objective was very specific\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Literature Review\",\n        \"form_name\": \"ebook_literature_review\",\n        \"max_word_count\": 500,\n        \"evaluation_query\": \"Literature review written as per global standard\",\n        \"mark\": 10\n    }, \n    {\n        \"title\": \"Methodology\",\n        \"form_name\": \"ebook_method\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Methodology is clear and sample size mentioned appropriately\",\n        \"mark\": 20\n    }, \n    {\n        \"title\": \"Results & Discussions\",\n        \"form_name\": \"ebook_rd\",\n        \"max_word_count\": 2000,\n        \"evaluation_query\": \"Results & Discussions are much specific with clear figures and table\",\n        \"mark\": 30\n    }, \n    {\n        \"title\": \"Conclusion and Recommendations\",\n        \"form_name\": \"ebook_cr\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Conclusions are clearly mentioned and having specific recommendations\",\n        \"mark\": 10\n    }, \n    {\n        \"title\": \"Reference\",\n        \"form_name\": \"ebook_reference\",\n        \"max_word_count\": 500,\n        \"evaluation_query\": \"References followed global standard\",\n        \"mark\": 10\n    },{\n        \"title\": \"Evaluation\",\n        \"form_name\": \"evaluation\",\n        \"evaluation_query\": \"Whole study writes up followed as per prescribed template and word limits\",\n        \"mark\": 5\n    }\n]', NULL, '[]', NULL, '2024-04-24 12:20:10'),
(2, 'research', 'Research', '[\n    {\n        \"title\": \"Study Title\",\n        \"form_name\": \"ebook_title\",\n        \"max_word_count\": 20,\n        \"evaluation_query\": \"Study title is aligned with descriptions in the article\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Abstract\",\n        \"form_name\": \"ebook_abstract\",\n        \"max_word_count\": 200,\n        \"evaluation_query\": \"Abstract expressed summary of article as well\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Introduction and Objective\",\n        \"form_name\": \"ebook_intro\",\n        \"max_word_count\": 200,\n        \"evaluation_query\": \"Objective was very specific\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Literature Review\",\n        \"form_name\": \"ebook_literature_review\",\n        \"max_word_count\": 500,\n        \"evaluation_query\": \"Literature review written as per global standard\",\n        \"mark\": 10\n    }, \n    {\n        \"title\": \"Methodology\",\n        \"form_name\": \"ebook_method\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Methodology is clear and sample size mentioned appropriately\",\n        \"mark\": 20\n    }, \n    {\n        \"title\": \"Results & Discussions\",\n        \"form_name\": \"ebook_rd\",\n        \"max_word_count\": 2000,\n        \"evaluation_query\": \"Results & Discussions are much specific with clear figures and table\",\n        \"mark\": 30\n    }, \n    {\n        \"title\": \"Conclusion and Recommendations\",\n        \"form_name\": \"ebook_cr\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Conclusions are clearly mentioned and having specific recommendations\",\n        \"mark\": 10\n    }, \n    {\n        \"title\": \"Reference\",\n        \"form_name\": \"ebook_reference\",\n        \"max_word_count\": 500,\n        \"evaluation_query\": \"References followed global standard\",\n        \"mark\": 10\n    },{\n        \"title\": \"Evaluation\",\n        \"form_name\": \"evaluation\",\n        \"evaluation_query\": \"Whole study writes up followed as per prescribed template and word limits\",\n        \"mark\": 5\n    }\n]', NULL, '[\"2\"]', NULL, '2024-04-24 12:25:08'),
(3, 'article', 'Article', '[\n    {\n        \"title\": \"Study Title\",\n        \"form_name\": \"ebook_title\",\n        \"max_word_count\": 20,\n        \"evaluation_query\": \"Study title is aligned with descriptions in the article\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Abstract\",\n        \"form_name\": \"ebook_abstract\",\n        \"max_word_count\": 200,\n        \"evaluation_query\": \"Abstract expressed summary of article as well\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Introduction and Objective\",\n        \"form_name\": \"ebook_intro\",\n        \"max_word_count\": 200,\n        \"evaluation_query\": \"Objective was very specific\",\n        \"mark\": 5\n    }, \n    {\n        \"title\": \"Literature Review\",\n        \"form_name\": \"ebook_literature_review\",\n        \"max_word_count\": 500,\n        \"evaluation_query\": \"Literature review written as per global standard\",\n        \"mark\": 10\n    }, \n    {\n        \"title\": \"Methodology\",\n        \"form_name\": \"ebook_method\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Methodology is clear and sample size mentioned appropriately\",\n        \"mark\": 20\n    }, \n    {\n        \"title\": \"Results & Discussions\",\n        \"form_name\": \"ebook_rd\",\n        \"max_word_count\": 2000,\n        \"evaluation_query\": \"Results & Discussions are much specific with clear figures and table\",\n        \"mark\": 30\n    }, \n    {\n        \"title\": \"Conclusion and Recommendations\",\n        \"form_name\": \"ebook_cr\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Conclusions are clearly mentioned and having specific recommendations\",\n        \"mark\": 10\n    }, \n    {\n        \"title\": \"Reference\",\n        \"form_name\": \"ebook_reference\",\n        \"max_word_count\": 500,\n        \"evaluation_query\": \"References followed global standard\",\n        \"mark\": 10\n    },{\n        \"title\": \"Evaluation\",\n        \"form_name\": \"evaluation\",\n        \"evaluation_query\": \"Whole study writes up followed as per prescribed template and word limits\",\n        \"mark\": 5\n    }\n]', NULL, '[\"2\"]', NULL, '2024-04-24 12:20:51'),
(4, 'innovative_idea', 'Innovative Idea', '[{\"title\":\"Study Title\",\"form_name\":\"ebook_title\",\"max_word_count\":15,\"evaluation_query\":\"Name of idea is aligned with descriptions in the idea document\",\"mark\":10},{\"title\":\"What is the problem?\",\"form_name\":\"problem\",\"max_word_count\":200,\"evaluation_query\":\"StProblem is very clear and specific\",\"mark\":10},{\"title\":\"Why is it innovative?\",\"form_name\":\"why_innovative\",\"max_word_count\":200,\"evaluation_query\":\"Innovativeness of idea to solve the problem\",\"mark\":20},{\"title\":\"Who are the participants?\",\"form_name\":\"participants\",\"max_word_count\":100,\"evaluation_query\":\"Clearly mentioned how participants will get benefit through this idea\",\"mark\":20},{\"title\":\"How it will work?\",\"form_name\":\"how_work\",\"max_word_count\":200,\"evaluation_query\":null,\"mark\":null},{\"title\":\"What will it look like?\",\"form_name\":\"look_like\",\"max_word_count\":200,\"evaluation_query\":null,\"mark\":null},{\"title\":\"What is the benefit for the participants?\",\"form_name\":\"benifits_participants\",\"max_word_count\":100,\"evaluation_query\":null,\"mark\":null},{\"title\":\"What is the benefit for the organization?\",\"form_name\":\"benefit_organization\",\"max_word_count\":100,\"evaluation_query\":\"How will get the benefit AAB as a fragile organization\",\"mark\":10},{\"title\":\"How can be sustainable of your idea or scale up?\",\"form_name\":\"scale_up\",\"max_word_count\":100,\"evaluation_query\":\"Sustainability of idea or scale up approach is clearly mentioned\",\"mark\":20},{\"title\":\"Evaluation\",\"form_name\":\"evaluation\",\"evaluation_query\":\"Whole study writes up followed as per prescribed template and word limits\",\"mark\":10}]', NULL, '[\"2\"]', NULL, '2024-04-29 12:57:11'),
(5, 'case_story', 'Case Story', '[\n    {\n        \"title\": \"Story Title\",\n        \"form_name\": \"ebook_title\",\n        \"max_word_count\": 10,\n        \"evaluation_query\": \"Story title is catchy, touchy and aligned with descriptions\",\n        \"mark\": 10\n    }, \n\n    {\n        \"title\": \"Introduction/Background\",\n        \"form_name\": \"introduction\",\n        \"max_word_count\": 150,\n        \"evaluation_query\": \"A background is mentioned clearly\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Problem & Solution\",\n        \"form_name\": \"problem_solution\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Problem & Solution mentioned with specific evidence\",\n        \"mark\": 30\n    },\n    {\n        \"title\": \"Organization contribution\",\n        \"form_name\": \"organization_contribution\",\n        \"max_word_count\": 100,\n        \"evaluation_query\": \"Organizational contribution is more clear\",\n        \"mark\": 1\n    },\n    {\n        \"title\": \"Community Contribution\",\n        \"form_name\": \"community_contribution\",\n        \"max_word_count\": 100,\n        \"evaluation_query\": \"Community contribution is mentioned\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Sustainability of success\",\n        \"form_name\": \"sustain_success\",\n        \"max_word_count\": 250,\n        \"evaluation_query\": \"Sustainability of success is clearly mentioned\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Participants Quotes\",\n        \"form_name\": \"participants_quotes\",\n        \"max_word_count\": 100,\n        \"evaluation_query\": \"Participants quotes are used\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Evaluation\",\n        \"form_name\": \"evaluation\",\n        \"evaluation_query\": \"Whole story writes up followed as per prescribed template and word limits\",\n        \"mark\": 10\n    }\n]', NULL, NULL, NULL, '2024-04-24 12:22:36'),
(6, 'success_story', 'Sucesss Story', '[\n    {\n        \"title\": \"Story Title\",\n        \"form_name\": \"ebook_title\",\n        \"max_word_count\": 10,\n        \"evaluation_query\": \"Story title is catchy, touchy and aligned with descriptions\",\n        \"mark\": 10\n    }, \n\n    {\n        \"title\": \"Introduction/Background\",\n        \"form_name\": \"introduction\",\n        \"max_word_count\": 150,\n        \"evaluation_query\": \"A background is mentioned clearly\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Problem & Solution\",\n        \"form_name\": \"problem_solution\",\n        \"max_word_count\": 300,\n        \"evaluation_query\": \"Problem & Solution mentioned with specific evidence\",\n        \"mark\": 30\n    },\n    {\n        \"title\": \"Organization contribution\",\n        \"form_name\": \"organization_contribution\",\n        \"max_word_count\": 100,\n        \"evaluation_query\": \"Organizational contribution is more clear\",\n        \"mark\": 1\n    },\n    {\n        \"title\": \"Community Contribution\",\n        \"form_name\": \"community_contribution\",\n        \"max_word_count\": 100,\n        \"evaluation_query\": \"Community contribution is mentioned\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Sustainability of success\",\n        \"form_name\": \"sustain_success\",\n        \"max_word_count\": 250,\n        \"evaluation_query\": \"Sustainability of success is clearly mentioned\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Participants Quotes\",\n        \"form_name\": \"participants_quotes\",\n        \"max_word_count\": 100,\n        \"evaluation_query\": \"Participants quotes are used\",\n        \"mark\": 10\n    },\n    {\n        \"title\": \"Evaluation\",\n        \"form_name\": \"evaluation\",\n        \"evaluation_query\": \"Whole story writes up followed as per prescribed template and word limits\",\n        \"mark\": 10\n    }\n]', NULL, '{\"1\":\"4\"}', NULL, '2024-04-24 12:22:49'),
(7, 'proomising_practices', 'Promising Practices', '[{\"title\":\"Title\",\"form_name\":\"ebook_title\",\"max_word_count\":12,\"evaluation_query\":\"Promising practice title is specific and aligned with descriptions\",\"mark\":10},{\"title\":\"Introduction\\/Background\",\"form_name\":\"introduction\",\"max_word_count\":150,\"evaluation_query\":\"A background is mentioned clearly\",\"mark\":10},{\"title\":\"Key Achievement\",\"form_name\":\"key_achievement\",\"max_word_count\":250,\"evaluation_query\":\"Key achievement mentioned with specific evidence\",\"mark\":30},{\"title\":\"How participants benefited?\",\"form_name\":\"participants_benifited\",\"max_word_count\":200,\"evaluation_query\":\"Participants are benefited which is more clear\",\"mark\":10},{\"title\":\"Which stragety have used?\",\"form_name\":\"strategy\",\"max_word_count\":200,\"evaluation_query\":\"Which strategy have used is mentioned\",\"mark\":10},{\"title\":\"What lessons learned generated?\",\"form_name\":\"leason_learned\",\"max_word_count\":200,\"evaluation_query\":\"Key lessons learned is clearly mentioned\",\"mark\":10},{\"title\":\"Action photo\",\"form_name\":\"leason_learned\",\"max_word_count\":null,\"evaluation_query\":\"Action photo used with clear caption\",\"mark\":10},{\"title\":\"Evaluation\",\"form_name\":\"evaluation\",\"evaluation_query\":\"Whole writes up followed as per prescribed template and word limits\",\"mark\":10}]', NULL, '[]', NULL, '2024-04-29 12:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `raw_pass` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_picture_id` bigint(20) UNSIGNED DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `phone`, `email`, `email_verified_at`, `password`, `raw_pass`, `role_id`, `profile_picture_id`, `biography`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ebook', 'Admin', '01756721388', 'superadmin@admin.com', NULL, '$2y$12$/IvTzttaRKG86Gbb49VCYeKH3uII4sR96RmVmel95Pc/6/5blKmGW', '123456', 1, 24, NULL, 0, NULL, '2024-04-17 06:18:25', '2024-05-02 10:14:35'),
(2, 'Md.', 'Shahinujjaman', '01755557075', 'md.shahinujjaman@actionaid.org', NULL, '$2y$12$O7FG5N1lTCS50chJaZL6V.65hUj9WbVXq3zmxDvehPLEslvSOj3EK', 'Office@365', 2, 36, NULL, 0, NULL, '2024-04-17 06:18:25', '2024-07-03 07:24:40'),
(3, 'Masum', 'Mollah', '01756721388', 'jury@admin.com', NULL, '$2y$12$/IvTzttaRKG86Gbb49VCYeKH3uII4sR96RmVmel95Pc/6/5blKmGW', '123456', 3, 24, NULL, 0, NULL, '2024-04-17 06:18:25', '2024-06-02 16:26:56'),
(4, 'Shamim', 'Patowary', '01756721388', 'author@admin.com', NULL, '$2y$12$/IvTzttaRKG86Gbb49VCYeKH3uII4sR96RmVmel95Pc/6/5blKmGW', '123456', 4, 24, NULL, 0, NULL, '2024-04-17 06:18:25', '2024-06-02 16:25:07'),
(5, 'Hello', 'World', '1546546', 'zeeshan.akhtar@webable.digital', NULL, '$2y$12$t/atlMfHUle0M2qdVFeCCOUXWNIMBwPmIx2BniaFLWS649/w1V/MS', 'zaqxsw', 2, 25, NULL, 0, NULL, '2024-05-02 10:03:01', '2024-06-02 17:54:12'),
(6, 'Arif', 'Zaman', '01812222213', 'abc@gmail.com', NULL, '$2y$12$WXW9yRJGFCnv773Xk3iryuS6SCj1vOfUdVdJRTFa8TmhMaGAZILBi', '7890', 3, 33, NULL, 1, NULL, '2024-05-02 10:12:02', '2024-05-02 17:09:41'),
(7, 'Shahariar Nasrin', 'Chowdhury Alisa', '01521485092', 'shahariar.alisa@actionaid.org', NULL, '$2y$12$VjwNVxL3CzF5W4n0O.eM1OOgcYmJImVVi1kiEulhSXWVYV8wP7jYm', '123456', 4, NULL, NULL, 1, NULL, '2024-05-02 12:41:53', '2024-08-11 10:07:04'),
(8, 'Shahidul', 'Islam', '01755557057', 'shahidul.islam@actionaid.org', NULL, '$2y$12$oKteH2TTLzJA5X76P1fmyedyhBwt1r9SEQXsULsDU2N2XgqMBRXES', '123456', 3, 39, NULL, 1, NULL, '2024-05-07 13:17:43', '2024-08-11 10:03:35'),
(9, 'Nashita', 'iftekhar', '01916287618', 'nashita.iftekhar@webable.digital', NULL, '$2y$12$8rS2NCFkp..AhekO.YdKQOtJhQ/fXbXldLJrIAc7jTY1FpSuFALSu', 'jury123', 3, NULL, NULL, 1, NULL, '2024-06-02 16:49:01', '2024-06-02 16:49:01'),
(10, 'Test', 'Case', '01916287618', 'ebook@gmail.com', NULL, '$2y$12$2Z158mg/au9nPfst1yn4b.yEM5wujlcKyL5mHxFVt/QPx8ba5BjSC', 'ebook123', 3, NULL, NULL, 1, NULL, '2024-07-03 09:05:03', '2024-07-03 09:05:03'),
(11, 'Demo', 'User', '01716201924', 'demo@gmail.com', NULL, '$2y$12$kv73f6543iBPq7WLaUT/uOQ8orpdPNr7HRO9gTt/KIIz2UmISwW6K', '123456', 3, NULL, NULL, 1, NULL, '2024-07-03 09:38:08', '2024-07-03 09:38:08'),
(12, 'Zeeshan', 'Akhtar', '87798465', 'Zeeshan0811@gmail.com', NULL, '$2y$12$egxjOgWjJoTmtIfDGkYDquYhDzra99rsFvhYSNFPf.bJQ74qq/.t2', '123456', 4, NULL, NULL, 1, NULL, '2024-08-07 01:46:23', '2024-08-07 01:46:23'),
(13, 'Monzurul', 'Alam', '01816297949', 'monzurul.alam@actionaid.org', NULL, '$2y$12$vKfJjjnJhwt9cNjb4vR4Aej903l5DmzbdOU2QJPHppPs64sDOURKi', '123456', 3, 40, NULL, 1, NULL, '2024-08-11 10:05:02', '2024-08-11 10:05:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `circular`
--
ALTER TABLE `circular`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `circular`
--
ALTER TABLE `circular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `evaluation`
--
ALTER TABLE `evaluation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
