-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 13 2024 г., 02:33
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `uchetsotr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sotr`
--

CREATE TABLE `sotr` (
  `IdSotr` int(11) NOT NULL,
  `FIO` text NOT NULL,
  `DataRojdeniya` date NOT NULL,
  `SeriyaNomerPasporta` varchar(255) NOT NULL,
  `NomerTelefona` varchar(255) NOT NULL,
  `AdresProjivaniya` text NOT NULL,
  `Otdel` text NOT NULL,
  `Doljnost` text NOT NULL,
  `RazmerZP` int(11) NOT NULL,
  `DataPrinyatiyaNaRabotu` date NOT NULL,
  `StatusRaboti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sotr`
--

INSERT INTO `sotr` (`IdSotr`, `FIO`, `DataRojdeniya`, `SeriyaNomerPasporta`, `NomerTelefona`, `AdresProjivaniya`, `Otdel`, `Doljnost`, `RazmerZP`, `DataPrinyatiyaNaRabotu`, `StatusRaboti`) VALUES
(1, 'Гусева Софья Александровна', '2014-10-01', '4895 623578', '8(960)546 45-67', 'ул. Сайкова д. 13', 'отдел Продаж', 'Консультант', 50000, '2014-10-07', 'Работает'),
(2, 'Александров Георгий Львович', '2024-10-15', '4521 789564', '8(978)456 56-45', 'ул. Первая д. 1', 'Бухгалтерия', 'Бухгалтер', 60000, '2024-10-01', 'Работает'),
(3, 'Михайлова Фатима Ильинична', '2024-10-23', '2345 789345', '8(956)456 34-23', 'ул. Вторая д. 2', 'IT', 'Тестировщик', 45678, '2024-10-02', 'Работает'),
(4, 'Зорин Михаил Кириллович', '1998-06-24', '2345 453453', '8(947)546 67-34', 'ул. Третья д. 3', 'Маркетинг', 'Начальник отдела', 130000, '2008-05-22', 'Уволен'),
(5, 'Пирожочкин василий Иванович', '2024-10-01', '1233 456789', '8(967) 342 34-23', 'ул. Четвертая д. 4', 'Бухгалтерия', 'Начальник отдела', 100000, '2024-10-09', 'Работает'),
(6, 'Пирожочкин василий Иванович', '2024-10-01', '1233 456789', '8(967) 342 34-23', 'ул. Четвертая д. 4', 'Бухгалтерия', 'Начальник отдела', 100000, '2024-10-09', 'Уволен'),
(7, 'Пирожочкин Василий Иванович', '2024-10-01', '1233 456789', '8(967) 342 34-23', 'ул. Четвертая д. 4', 'Бухгалтерия', 'Начальник отдела', 100000, '2024-10-09', 'Уволен'),
(8, 'Семенова Варвара Александровна', '2002-01-13', '2423 876453', '8(986)256-34-21', 'ул. Пятая д. 7', 'IT', 'Программист', 67000, '2020-05-08', 'Работает');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sotr`
--
ALTER TABLE `sotr`
  ADD PRIMARY KEY (`IdSotr`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sotr`
--
ALTER TABLE `sotr`
  MODIFY `IdSotr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
