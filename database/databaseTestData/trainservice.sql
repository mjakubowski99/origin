-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Paź 2020, 19:27
-- Wersja serwera: 10.1.40-MariaDB
-- Wersja PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `trainservice`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `arrives`
--

CREATE TABLE `arrives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `arrive_id` bigint(20) NOT NULL,
  `ID_TRAIN` bigint(20) NOT NULL,
  `ID_STATION` bigint(20) NOT NULL,
  `BEGIN_DATE` datetime NOT NULL,
  `ARRIVE_DATE` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `arrives`
--

INSERT INTO `arrives` (`id`, `arrive_id`, `ID_TRAIN`, `ID_STATION`, `BEGIN_DATE`, `ARRIVE_DATE`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 1, '2020-10-10 12:30:00', '2020-10-10 12:35:00', NULL, NULL),
(7, 1, 1, 2, '2020-10-10 13:20:00', '2020-10-10 13:25:00', NULL, NULL),
(8, 1, 1, 3, '2020-10-10 14:20:00', '2020-10-10 14:25:00', NULL, NULL),
(9, 2, 1, 4, '2020-10-10 12:20:00', '2020-10-10 12:30:00', NULL, NULL),
(10, 2, 1, 5, '2020-10-10 13:00:00', '2020-10-10 13:05:00', NULL, NULL),
(11, 3, 3, 6, '2020-10-10 13:25:00', '2020-10-10 13:29:00', NULL, NULL),
(12, 3, 3, 7, '2020-10-10 14:05:00', '2020-10-10 14:10:00', NULL, NULL),
(13, 3, 3, 8, '2020-10-10 14:50:00', '2020-10-10 14:55:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_24_144133_create_tickets', 1),
(5, '2020_07_24_162451_create_trace', 1),
(6, '2020_07_24_162555_create_station', 1),
(7, '2020_07_24_162720_create_place', 1),
(8, '2020_07_27_210829_create_train_places', 1),
(9, '2020_07_27_211014_create_arrives', 1),
(10, '2020_07_27_211617_create_train', 1),
(11, '2020_07_27_221037_create_roles', 1),
(12, '2020_07_27_221832_create_roles_has_users', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CAR` bigint(20) NOT NULL,
  `NUMBER` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `places`
--

INSERT INTO `places` (`id`, `CAR`, `NUMBER`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 2, 1, NULL, NULL),
(14, 2, 2, NULL, NULL),
(15, 2, 3, NULL, NULL),
(16, 2, 4, NULL, NULL),
(17, 2, 5, NULL, NULL),
(18, 2, 6, NULL, NULL),
(19, 2, 7, NULL, NULL),
(20, 2, 8, NULL, NULL),
(21, 2, 9, NULL, NULL),
(22, 2, 10, NULL, NULL),
(23, 2, 11, NULL, NULL),
(24, 2, 12, NULL, NULL),
(25, 1, 1, NULL, NULL),
(26, 1, 2, NULL, NULL),
(27, 1, 3, NULL, NULL),
(28, 1, 4, NULL, NULL),
(29, 1, 5, NULL, NULL),
(30, 1, 6, NULL, NULL),
(31, 1, 7, NULL, NULL),
(32, 1, 8, NULL, NULL),
(33, 1, 9, NULL, NULL),
(34, 1, 10, NULL, NULL),
(35, 1, 11, NULL, NULL),
(36, 1, 12, NULL, NULL),
(37, 1, 13, NULL, NULL),
(38, 2, 1, NULL, NULL),
(39, 2, 2, NULL, NULL),
(40, 2, 3, NULL, NULL),
(41, 2, 4, NULL, NULL),
(42, 2, 5, NULL, NULL),
(43, 2, 6, NULL, NULL),
(44, 2, 7, NULL, NULL),
(45, 2, 8, NULL, NULL),
(46, 2, 9, NULL, NULL),
(47, 2, 10, NULL, NULL),
(48, 2, 11, NULL, NULL),
(49, 2, 12, NULL, NULL),
(50, 2, 13, NULL, NULL),
(51, 1, 1, NULL, NULL),
(52, 1, 2, NULL, NULL),
(53, 1, 3, NULL, NULL),
(54, 1, 4, NULL, NULL),
(55, 1, 5, NULL, NULL),
(56, 1, 6, NULL, NULL),
(57, 1, 7, NULL, NULL),
(58, 1, 8, NULL, NULL),
(59, 1, 9, NULL, NULL),
(60, 1, 10, NULL, NULL),
(61, 1, 11, NULL, NULL),
(62, 1, 12, NULL, NULL),
(63, 2, 1, NULL, NULL),
(64, 2, 2, NULL, NULL),
(65, 2, 3, NULL, NULL),
(66, 2, 4, NULL, NULL),
(67, 2, 5, NULL, NULL),
(68, 2, 6, NULL, NULL),
(69, 2, 7, NULL, NULL),
(70, 2, 8, NULL, NULL),
(71, 2, 9, NULL, NULL),
(72, 2, 10, NULL, NULL),
(73, 2, 11, NULL, NULL),
(74, 2, 12, NULL, NULL),
(75, 2, 13, NULL, NULL),
(76, 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `roles_has_users`
--

CREATE TABLE `roles_has_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_roles` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `roles_has_users`
--

INSERT INTO `roles_has_users` (`id`, `id_user`, `id_roles`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `stations`
--

CREATE TABLE `stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ID_TRACE` bigint(20) NOT NULL,
  `STATION_IN_ORDER` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `stations`
--

INSERT INTO `stations` (`id`, `NAME`, `ID_TRACE`, `STATION_IN_ORDER`, `created_at`, `updated_at`) VALUES
(1, 'Lublin', 1, 1, NULL, NULL),
(2, 'Radom', 1, 2, NULL, NULL),
(3, 'Warszawa', 1, 3, NULL, NULL),
(4, 'Lublin', 2, 1, NULL, NULL),
(5, 'Siedlce', 2, 2, NULL, NULL),
(6, 'Siedlce', 3, 1, NULL, NULL),
(7, 'Ząbki', 3, 2, NULL, NULL),
(8, 'Warszawa', 3, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ID_TRAIN_PLACES` bigint(20) NOT NULL,
  `ID_ARRIVE` bigint(20) NOT NULL,
  `ID_USER` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `traces`
--

CREATE TABLE `traces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `traces`
--

INSERT INTO `traces` (`id`, `NAME`, `created_at`, `updated_at`) VALUES
(1, 'Lublin-Warszawa', NULL, NULL),
(2, 'Lublin-Siedlce', NULL, NULL),
(3, 'Siedlce-Warszawa', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `trains`
--

CREATE TABLE `trains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `trains`
--

INSERT INTO `trains` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'tlk200', NULL, NULL),
(2, 'tlk200', NULL, NULL),
(3, 'tlk300', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `train_places`
--

CREATE TABLE `train_places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `TRAIN_ID` bigint(20) NOT NULL,
  `PLACE_ID` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `train_places`
--

INSERT INTO `train_places` (`id`, `TRAIN_ID`, `PLACE_ID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 1, 17, NULL, NULL),
(18, 1, 18, NULL, NULL),
(19, 1, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 1, 22, NULL, NULL),
(23, 1, 23, NULL, NULL),
(24, 1, 24, NULL, NULL),
(25, 2, 25, NULL, NULL),
(26, 2, 26, NULL, NULL),
(27, 2, 27, NULL, NULL),
(28, 2, 28, NULL, NULL),
(29, 2, 29, NULL, NULL),
(30, 2, 30, NULL, NULL),
(31, 2, 31, NULL, NULL),
(32, 2, 32, NULL, NULL),
(33, 2, 33, NULL, NULL),
(34, 2, 34, NULL, NULL),
(35, 2, 35, NULL, NULL),
(36, 2, 36, NULL, NULL),
(37, 2, 37, NULL, NULL),
(38, 2, 38, NULL, NULL),
(39, 2, 39, NULL, NULL),
(40, 2, 40, NULL, NULL),
(41, 2, 41, NULL, NULL),
(42, 2, 42, NULL, NULL),
(43, 2, 43, NULL, NULL),
(44, 2, 44, NULL, NULL),
(45, 2, 45, NULL, NULL),
(46, 2, 46, NULL, NULL),
(47, 2, 47, NULL, NULL),
(48, 2, 48, NULL, NULL),
(49, 2, 49, NULL, NULL),
(50, 2, 50, NULL, NULL),
(51, 3, 51, NULL, NULL),
(52, 3, 52, NULL, NULL),
(53, 3, 53, NULL, NULL),
(54, 3, 54, NULL, NULL),
(55, 3, 55, NULL, NULL),
(56, 3, 56, NULL, NULL),
(57, 3, 57, NULL, NULL),
(58, 3, 58, NULL, NULL),
(59, 3, 59, NULL, NULL),
(60, 3, 60, NULL, NULL),
(61, 3, 61, NULL, NULL),
(62, 3, 62, NULL, NULL),
(63, 3, 63, NULL, NULL),
(64, 3, 64, NULL, NULL),
(65, 3, 65, NULL, NULL),
(66, 3, 66, NULL, NULL),
(67, 3, 67, NULL, NULL),
(68, 3, 68, NULL, NULL),
(69, 3, 69, NULL, NULL),
(70, 3, 70, NULL, NULL),
(71, 3, 71, NULL, NULL),
(72, 3, 72, NULL, NULL),
(73, 3, 73, NULL, NULL),
(74, 3, 74, NULL, NULL),
(75, 3, 75, NULL, NULL),
(76, 3, 76, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@example.com', NULL, '$2y$10$J/mG99ZTpjyTo4FLKlTNE.mGaRALbvmKkM0ikFn7dO0pdlVFGRsye', NULL, '2020-09-27 14:50:17', '2020-09-27 14:50:17');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `arrives`
--
ALTER TABLE `arrives`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeksy dla tabeli `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `roles_has_users`
--
ALTER TABLE `roles_has_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `traces`
--
ALTER TABLE `traces`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `trains`
--
ALTER TABLE `trains`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `train_places`
--
ALTER TABLE `train_places`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `arrives`
--
ALTER TABLE `arrives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT dla tabeli `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `roles_has_users`
--
ALTER TABLE `roles_has_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `stations`
--
ALTER TABLE `stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `traces`
--
ALTER TABLE `traces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `trains`
--
ALTER TABLE `trains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `train_places`
--
ALTER TABLE `train_places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
