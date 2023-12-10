-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 10 2023 г., 20:11
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Restaraunt`
--
CREATE DATABASE IF NOT EXISTS `Restaraunt` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `Restaraunt`;

DELIMITER $$
--
-- Функции
--
DROP FUNCTION IF EXISTS `calculate_order_count_by_day`$$
CREATE DEFINER=`root`@`%` FUNCTION `calculate_order_count_by_day` (`day_param` DATE) RETURNS INT  BEGIN
    DECLARE total_count INT;
    SELECT COUNT(*) INTO total_count FROM orders WHERE DATE(order_date) = day_param;
    RETURN total_count;
END$$

DROP FUNCTION IF EXISTS `calculate_order_count_by_month`$$
CREATE DEFINER=`root`@`%` FUNCTION `calculate_order_count_by_month` (`month_param` DATE) RETURNS INT  BEGIN
    DECLARE total_count INT;

    SELECT COUNT(*) INTO total_count
    FROM orders
    WHERE EXTRACT(YEAR_MONTH FROM order_date) = EXTRACT(YEAR_MONTH FROM month_param);

    RETURN total_count;
END$$

DROP FUNCTION IF EXISTS `calculate_order_sum_by_day`$$
CREATE DEFINER=`root`@`%` FUNCTION `calculate_order_sum_by_day` (`day_param` DATE) RETURNS DECIMAL(10,2)  BEGIN
    DECLARE total_sum DECIMAL(10, 2);

    SELECT SUM(D.price) INTO total_sum
    FROM orders AS O
    JOIN OrderedDishes AS OD ON O.id = OD.order_id
    JOIN dishes AS D ON OD.dish_id = D.id
    WHERE DATE(O.order_date) = day_param;

    RETURN total_sum;
END$$

DROP FUNCTION IF EXISTS `calculate_order_sum_by_month`$$
CREATE DEFINER=`root`@`%` FUNCTION `calculate_order_sum_by_month` (`month_param` DATE) RETURNS DECIMAL(10,2)  BEGIN
    DECLARE total_sum DECIMAL(10, 2);

    SELECT SUM(D.price) INTO total_sum
    FROM orders AS O
    JOIN OrderedDishes AS OD ON O.id = OD.order_id
    JOIN dishes AS D ON OD.dish_id = D.id
    WHERE DATE_FORMAT(O.order_date, '%Y-%m') = DATE_FORMAT(month_param, '%Y-%m');

    RETURN total_sum;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `Dishes`
--

DROP TABLE IF EXISTS `Dishes`;
CREATE TABLE `Dishes` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Dishes`
--

INSERT INTO `Dishes` (`id`, `name`, `description`, `price`, `image_path`) VALUES
(3, 'Тирамису', 'итальянский многослойный десерт, в состав которого входят сыр маскарпоне, кофе (обычно эспрессо), куриные яйца, сахар и печенье савоярди. Как правило, десерт припудривают какао-порошком. Возможна вариация с добавлением грецкого ореха.', 300, '../../res/uploads/Тирамису.jpg'),
(5, 'Мохито (безалкогольный)', 'Мохито традиционно состоит из четырёх ингредиентов: газированная вода, сахар, лайм и мята. Для охлаждения напитка в него добавляют колотый лёд. В алкогольный мохито добавляют пятый ингредиент — ром.', 200, '../../res/uploads/Мохито.jpg'),
(6, 'Окономияки', 'Японское блюдо из разряда фастфуда, жареная лепёшка из смеси разнообразных ингредиентов, смазанная специальным соусом и посыпанная очень тонко нарезанным сушёным тунцом (кацуобуси). Жарят окономияки на теппане — горячей металлической плите.', 400, '../../res/uploads/Окономияки.jpg'),
(7, 'Пицца 4 сыра', 'Разновидность пиццы в итальянской кухне, покрытая комбинацией из четырёх видов сыра, обычно расплавленных вместе, с томатным соусом (росса, красный) или без него (бьянка, белый). Этот вид популярен во всем мире, в том числе в Италии.', 600, '../../res/uploads/4сыра.jpg'),
(8, 'Сэндвич с лососем', 'Классическое сочетание солоноватого лосося, нежного творожного сыра, хрустящего огурца и пикантного зелёного лука.', 250, '../../res/uploads/Сендвич.jpg'),
(9, 'Фоккача с песто', 'Итальянская пшеничная лепёшка, которую готовят из различных видов теста с добавлением песто.', 200, '../../res/uploads/Фоккача_песто.jpg'),
(10, 'Домбури', 'Чаша домбури вмещает около двух стандартных порций риса, поверх которого кладутся различные добавки: мясо, рыба, яйца, овощи или какой-либо другой гарнир.', 500, '../../res/uploads/домбури.jpg'),
(11, 'Суп Фо-Бо', 'Блюдо вьетнамской кухни, суп с лапшой, в который при сервировке добавляют говядину, ростки маш, чили, грибы.', 450, '../../res/uploads/Фо_Бо.jpg'),
(12, 'Цезарь', 'Это настоящий король салатов, его пробовал каждый. Прекрасное сочетание нежного мяса, свежих листьев пекинской капусты и легкого соуса приправленных помидорами и перепелиным яйцом под сыром.', 350, '../../res/uploads/цезарь.jpg'),
(13, 'Стейк \"Рибай\"', 'Стейк Рибай означает «край на ребре». А именно он находится с 5 до 12 ребро быка. Это классика мраморного мяса, с которой так или иначе знаком каждый любитель сочной говядины.', 800, '../../res/uploads/Рибай.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `Employee`
--

DROP TABLE IF EXISTS `Employee`;
CREATE TABLE `Employee` (
  `id` int NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `pos_id` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Employee`
--

INSERT INTO `Employee` (`id`, `fullname`, `pos_id`, `email`, `phone`, `address`) VALUES
(4, 'Веселкова Екатерина Геннадиевна', 9, 'EkaterinaVeselkova529@yandex.ru', '79343490847', '172081, г. Райчихинск, ул. Военная Горка (1-я линия), дом 157, квартира 613'),
(5, 'Добронравов Кирилл Денисович', 2, 'KirillDobronravov414@mail.ru', '79270783061', '678370, г. Первомайский, ул. Новороссийская (Выборгский), дом 78, квартира 575'),
(6, 'Амбарцумян Зоя Ильинична', 11, 'ZoyaAmbartsumyan297@gmail.com', '79315309878', '214036, г. Палана, ул. Электропьтовцев, дом 172, квартира 646'),
(7, 'Питерский Осип Семенович', 10, 'OsipPiterskiy894@rambler.com', '79145770987', '392962, г. Ольовка, ул. Мжд Курское 33-й км, дом 86, квартира 989'),
(8, 'Городецкая Ника Тимофеевна', 3, 'NikaGorodetskaya667@yandex.ru', '79963320809', '353354, г. Марьяновка, ул. Серая дача тер, дом 38, квартира 609'),
(9, 'Обломова Эмма Тимофеевна', 3, 'EmmaOblomova822@gmail.com', '792207909113', '618510, г. Атня, ул. Труда пл, дом 186, квартира 472');

--
-- Триггеры `Employee`
--
DROP TRIGGER IF EXISTS `before_employee_insert`;
DELIMITER $$
CREATE TRIGGER `before_employee_insert` BEFORE INSERT ON `Employee` FOR EACH ROW BEGIN
    DECLARE phone_check INT;
    DECLARE email_check INT;
    SET phone_check = 0;
    SET email_check = 0;

    IF NEW.phone REGEXP '^[0-9]+$' != 1 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Некорректный формат номера телефона';
    END IF;

    IF NEW.email NOT REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,}$' THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Некорректный формат электронной почты';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `Halls`
--

DROP TABLE IF EXISTS `Halls`;
CREATE TABLE `Halls` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Halls`
--

INSERT INTO `Halls` (`id`, `name`, `description`) VALUES
(5, 'Фьюжн', 'Лаконичная, близкая к производственной обстановка, стилистика схожа с азиатской, есть противоречивые, дополняющие друг друга элементы'),
(6, 'Модерн', 'Знаменитый художественный стиль, всё природно и натурально, много света и живописи, играет спокойная классическая музыка.\r\n'),
(7, 'Ретро-зал', 'Винтажный привет из 90-х западной стилистики, по среди зала расположен старинный классический масл кар, на стенах висят винилы)'),
(8, 'Азиатский', 'Тёплая цветовая палитра, большое изобилие искусственных растений и различных композиций'),
(9, 'Hi-Tec', 'Множество гладких поверхностей без декора, монохромная цветовая палитра, футуристичные черты'),
(10, 'Неоклассика', 'Старый добрый минимализм, стиль без излишеств, изобилие симметричности и комфортной простоты\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `OrderedDishes`
--

DROP TABLE IF EXISTS `OrderedDishes`;
CREATE TABLE `OrderedDishes` (
  `id` int NOT NULL,
  `dish_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `OrderedDishes`
--

INSERT INTO `OrderedDishes` (`id`, `dish_id`, `order_id`) VALUES
(14, 5, 4),
(15, 6, 4),
(16, 11, 4),
(17, 3, 5),
(18, 5, 5),
(19, 7, 5),
(20, 13, 5),
(21, 12, 5),
(22, 12, 5),
(23, 11, 5),
(24, 5, 5),
(25, 3, 6),
(26, 11, 6),
(27, 8, 6),
(28, 3, 7),
(29, 3, 7),
(30, 5, 7),
(31, 5, 7),
(32, 10, 8),
(33, 5, 8),
(34, 9, 8),
(35, 3, 9),
(36, 13, 9),
(37, 5, 9),
(38, 6, 9),
(39, 7, 9),
(40, 8, 9),
(41, 9, 9),
(42, 10, 9),
(43, 11, 9),
(44, 12, 9),
(45, 8, 10),
(46, 3, 10),
(47, 6, 10),
(48, 3, 11),
(49, 6, 11),
(50, 8, 11),
(51, 7, 11);

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders` (
  `id` int NOT NULL,
  `emp_id` int DEFAULT NULL,
  `table_id` int DEFAULT NULL,
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`id`, `emp_id`, `table_id`, `order_date`) VALUES
(4, 5, 5, '2023-11-12 10:30:00'),
(5, 5, 3, '2023-11-11 13:17:00'),
(6, 8, 16, '2023-11-13 19:18:00'),
(7, 5, 3, '2023-11-09 15:20:00'),
(8, 5, 3, '2023-11-13 19:15:00'),
(9, 9, 3, '2023-11-03 16:00:00'),
(10, 8, 17, '2023-11-13 19:06:00'),
(11, 8, 15, '2023-12-10 18:30:58');

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `orderssummary`
-- (См. Ниже фактическое представление)
--
DROP VIEW IF EXISTS `orderssummary`;
CREATE TABLE `orderssummary` (
`dishes_ordered` text
,`employee_name` varchar(255)
,`order_date` datetime
,`order_id` int
,`table_number` int
,`total_price` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Структура таблицы `Positions`
--

DROP TABLE IF EXISTS `Positions`;
CREATE TABLE `Positions` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `salary` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Positions`
--

INSERT INTO `Positions` (`id`, `name`, `salary`) VALUES
(2, 'Бармен', 27500),
(3, 'Официант', 25000),
(8, 'Охранник', 22500),
(9, 'Су-шеф', 25000),
(10, 'Бренд шеф', 60000),
(11, 'Заготовщик', 22800);

-- --------------------------------------------------------

--
-- Структура таблицы `Tables`
--

DROP TABLE IF EXISTS `Tables`;
CREATE TABLE `Tables` (
  `id` int NOT NULL,
  `number` int DEFAULT NULL,
  `placeCount` int DEFAULT NULL,
  `hall_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Tables`
--

INSERT INTO `Tables` (`id`, `number`, `placeCount`, `hall_id`) VALUES
(3, 1, 4, 5),
(4, 2, 2, 5),
(5, 3, 4, 5),
(6, 4, 2, 5),
(7, 5, 6, 5),
(8, 6, 6, 5),
(9, 7, 2, 6),
(10, 8, 2, 6),
(11, 9, 6, 6),
(12, 10, 8, 6),
(13, 11, 4, 7),
(14, 12, 4, 7),
(15, 13, 8, 7),
(16, 14, 8, 7),
(17, 15, 4, 8),
(18, 16, 4, 8),
(19, 20, 4, 9),
(20, 21, 2, 9),
(21, 22, 6, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `user_type` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `login`, `password_hash`, `user_type`) VALUES
(1, 'admin', '$2y$10$J23JVg4uj7BdzVuk6gXHguFasRL7dyt9BLcw7MU6.BH4pUoFoNRw2', 'admin'),
(2, 'user_test', '$2y$10$fDp2JRJXPuqlNbgYvOhaUelojjBaZKbxZEnbp50dBszNWT2xhY45G', 'user');

-- --------------------------------------------------------

--
-- Структура для представления `orderssummary`
--
DROP TABLE IF EXISTS `orderssummary`;

DROP VIEW IF EXISTS `orderssummary`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `orderssummary`  AS SELECT `O`.`id` AS `order_id`, `O`.`order_date` AS `order_date`, `E`.`fullname` AS `employee_name`, `T`.`number` AS `table_number`, group_concat(`D`.`name` separator ', ') AS `dishes_ordered`, sum(`D`.`price`) AS `total_price` FROM ((((`orders` `O` join `employee` `E` on((`O`.`emp_id` = `E`.`id`))) join `tables` `T` on((`O`.`table_id` = `T`.`id`))) join `ordereddishes` `OD` on((`O`.`id` = `OD`.`order_id`))) join `dishes` `D` on((`OD`.`dish_id` = `D`.`id`))) GROUP BY `O`.`id``id`  ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Dishes`
--
ALTER TABLE `Dishes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_ibfk_1` (`pos_id`);

--
-- Индексы таблицы `Halls`
--
ALTER TABLE `Halls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `OrderedDishes`
--
ALTER TABLE `OrderedDishes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordereddishes_ibfk_1` (`dish_id`),
  ADD KEY `ordereddishes_ibfk_2` (`order_id`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ibfk_1` (`emp_id`),
  ADD KEY `orders_ibfk_2` (`table_id`);

--
-- Индексы таблицы `Positions`
--
ALTER TABLE `Positions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Tables`
--
ALTER TABLE `Tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tables_ifbk_1` (`hall_id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Dishes`
--
ALTER TABLE `Dishes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `Employee`
--
ALTER TABLE `Employee`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Halls`
--
ALTER TABLE `Halls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `OrderedDishes`
--
ALTER TABLE `OrderedDishes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `Positions`
--
ALTER TABLE `Positions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `Tables`
--
ALTER TABLE `Tables`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Employee`
--
ALTER TABLE `Employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`pos_id`) REFERENCES `Positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `OrderedDishes`
--
ALTER TABLE `OrderedDishes`
  ADD CONSTRAINT `ordereddishes_ibfk_1` FOREIGN KEY (`dish_id`) REFERENCES `Dishes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ordereddishes_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `Employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`table_id`) REFERENCES `Tables` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Tables`
--
ALTER TABLE `Tables`
  ADD CONSTRAINT `tables_ifbk_1` FOREIGN KEY (`hall_id`) REFERENCES `Halls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
