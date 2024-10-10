-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 10 2024 г., 11:08
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `UchetSotr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Sotr`
--

CREATE TABLE `Sotr` (
  `IdSotr` int(11) NOT NULL,
  `FIO` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `SeriyaNomerPasporta` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomerTelefona` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AdresProjivaniya` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Otdel` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `Doljnost` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `RazmerZP` int(11) NOT NULL,
  `DataPrinyatiyaNaRabotu` date NOT NULL,
  `StatusRaboti` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Sotr`
--
ALTER TABLE `Sotr`
  ADD PRIMARY KEY (`IdSotr`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Sotr`
--
ALTER TABLE `Sotr`
  MODIFY `IdSotr` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
