-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Sie 2021, 15:15
-- Wersja serwera: 10.4.20-MariaDB
-- Wersja PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `laravel`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Konsole i gry', 0, '2021-08-25 14:23:31', '2021-08-31 10:48:54'),
(2, 'PlayStation 5', 1, '2021-08-25 14:23:46', '2021-08-31 11:01:49'),
(3, 'Dla graczy', 53, '2021-08-25 14:24:00', '2021-08-31 11:00:20'),
(6, 'Asus', 3, '2021-08-25 14:27:21', '2021-08-31 11:00:33'),
(8, 'TUF GAMING', 6, '2021-08-25 14:31:10', '2021-08-31 11:00:53'),
(10, 'Gadżety', 0, '2021-08-25 14:47:07', '2021-08-31 10:50:39'),
(15, 'Smartfony', 0, '2021-08-26 08:59:23', '2021-08-31 10:49:45'),
(32, 'AGD Małe', 0, '2021-08-29 13:53:57', '2021-08-31 10:52:03'),
(35, 'AGD Duże', 0, '2021-08-30 11:47:52', '2021-08-31 10:47:40'),
(49, 'Akcesoria', 45, '2021-08-30 16:56:18', '2021-08-30 16:57:09'),
(51, 'Audio', 0, '2021-08-31 06:34:03', '2021-08-31 10:51:19'),
(52, 'Komputery i tablety', 0, '2021-08-31 09:34:35', '2021-08-31 10:48:30'),
(53, 'Laptopy', 52, '2021-08-31 09:34:49', '2021-08-31 10:59:59'),
(55, 'Biznesowe', 53, '2021-08-31 10:31:03', '2021-08-31 11:01:08'),
(56, 'RTV', 0, '2021-08-31 10:34:32', '2021-08-31 10:51:02'),
(58, 'Wyposażenie kuchni', 35, '2021-08-31 10:54:32', '2021-08-31 10:54:32'),
(59, 'Lodówki i zamrażarki', 35, '2021-08-31 10:54:50', '2021-08-31 10:54:50'),
(60, 'Wolnostojące', 58, '2021-08-31 10:55:47', '2021-08-31 10:55:47'),
(61, 'Do zabudowy', 58, '2021-08-31 10:56:02', '2021-08-31 10:56:02'),
(62, 'Zmywarki', 60, '2021-08-31 10:56:27', '2021-08-31 10:57:48'),
(63, 'Zmywarki do zabudowy', 61, '2021-08-31 10:57:12', '2021-08-31 10:57:12'),
(64, 'Bosh', 62, '2021-08-31 10:58:08', '2021-08-31 10:58:08'),
(65, 'Konsole PS5', 2, '2021-08-31 11:10:31', '2021-08-31 11:10:31'),
(66, 'Akcesoria PS5', 2, '2021-08-31 11:11:00', '2021-08-31 11:11:00'),
(67, 'Kino domowe', 51, '2021-08-31 11:11:25', '2021-08-31 11:11:25'),
(68, 'Soundbary', 67, '2021-08-31 11:11:34', '2021-08-31 11:11:34'),
(69, 'Subwoofery', 67, '2021-08-31 11:12:17', '2021-08-31 11:12:17'),
(70, 'Drony', 10, '2021-08-31 11:12:42', '2021-08-31 11:12:42'),
(71, 'Telewizory', 56, '2021-08-31 11:13:13', '2021-08-31 11:13:13'),
(72, 'LED', 71, '2021-08-31 11:13:26', '2021-08-31 11:13:26'),
(73, 'Samsung', 72, '2021-08-31 11:13:38', '2021-08-31 11:13:38');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
