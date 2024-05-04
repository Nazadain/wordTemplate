-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 04 2024 г., 07:38
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
-- База данных: `wordTemplateDb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `company_practice_leader`
--

CREATE TABLE `company_practice_leader` (
  `id` int NOT NULL,
  `full_name` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `company_practice_leader`
--

INSERT INTO `company_practice_leader` (`id`, `full_name`, `job_title`, `role_name`, `user_id`) VALUES
(1, 'Змеев Денис Олегович', 'доцент', 'company_leader', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `contract`
--

CREATE TABLE `contract` (
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `contract`
--

INSERT INTO `contract` (`type`) VALUES
('Учебный');

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE `course` (
  `num` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `course`
--

INSERT INTO `course` (`num`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Структура таблицы `direction`
--

CREATE TABLE `direction` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `institute_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `direction`
--

INSERT INTO `direction` (`id`, `name`, `institute_id`) VALUES
(1, 'Информатика и вычислительная техника', 1),
(2, 'Программная инженерия', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` int NOT NULL,
  `num` varchar(10) NOT NULL,
  `direction_id` int NOT NULL,
  `course_num` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `num`, `direction_id`, `course_num`) VALUES
(1, '1121б', 1, 2),
(2, '1521б', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `institute`
--

CREATE TABLE `institute` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `institute`
--

INSERT INTO `institute` (`id`, `name`) VALUES
(1, 'Инженерная школа цифровых технологий');

-- --------------------------------------------------------

--
-- Структура таблицы `is_paid`
--

CREATE TABLE `is_paid` (
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `is_paid`
--

INSERT INTO `is_paid` (`value`) VALUES
('Да'),
('Нет');

-- --------------------------------------------------------

--
-- Структура таблицы `practice`
--

CREATE TABLE `practice` (
  `id` int NOT NULL,
  `year` int NOT NULL,
  `term` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `name` varchar(50) NOT NULL,
  `order` varchar(100) NOT NULL,
  `group_id` int NOT NULL,
  `company_leader_id` int NOT NULL,
  `USU_leader_id` int NOT NULL,
  `practice_type` varchar(50) NOT NULL,
  `practice_vid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `practice`
--

INSERT INTO `practice` (`id`, `year`, `term`, `name`, `order`, `group_id`, `company_leader_id`, `USU_leader_id`, `practice_type`, `practice_vid`) VALUES
(1, 2024, '22.04.2024 - 18.05.2024', 'Учебная практика', '№2-222  от 06.03.2024', 1, 1, 1, 'Ознакомительная', 'Учебная');

-- --------------------------------------------------------

--
-- Структура таблицы `practice_place`
--

CREATE TABLE `practice_place` (
  `id` int NOT NULL,
  `address` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `practice_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `practice_place`
--

INSERT INTO `practice_place` (`id`, `address`, `name`, `practice_id`) VALUES
(1, 'г. Ханты-Мансийск, ул. Чехова, д.16', 'Югорский государственный университет', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `practice_type`
--

CREATE TABLE `practice_type` (
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `practice_type`
--

INSERT INTO `practice_type` (`type`) VALUES
('Ознакомительная');

-- --------------------------------------------------------

--
-- Структура таблицы `practice_vid`
--

CREATE TABLE `practice_vid` (
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `practice_vid`
--

INSERT INTO `practice_vid` (`type`) VALUES
('Учебная');

-- --------------------------------------------------------

--
-- Структура таблицы `program_leader`
--

CREATE TABLE `program_leader` (
  `id` int NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `institute_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `program_leader`
--

INSERT INTO `program_leader` (`id`, `full_name`, `job_title`, `institute_id`, `user_id`) VALUES
(1, 'Самарина Ольга Владимировна', 'доцент', 1, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`name`) VALUES
('admin'),
('bpep_leader'),
('company_leader'),
('student'),
('usu_leader');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `group_id` int NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `full_name`, `group_id`, `role_name`, `user_id`) VALUES
(1, 'Павловский Никита Вячеславович', 1, 'student', 1),
(2, 'Пономаренко Егор Сергеевич', 1, 'student', 4),
(3, 'Богданов Никита Алексеевич', 1, 'student', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `student_practice`
--

CREATE TABLE `student_practice` (
  `id` int NOT NULL,
  `practice_id` int NOT NULL,
  `student_id` int NOT NULL,
  `contract_type` varchar(50) NOT NULL,
  `is_paid` varchar(50) NOT NULL,
  `tasks_id` int NOT NULL,
  `qualities` text NOT NULL,
  `comments` text NOT NULL,
  `workload` text NOT NULL,
  `difficults` text NOT NULL,
  `mark` int NOT NULL,
  `company_leader_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `student_practice`
--

INSERT INTO `student_practice` (`id`, `practice_id`, `student_id`, `contract_type`, `is_paid`, `tasks_id`, `qualities`, `comments`, `workload`, `difficults`, `mark`, `company_leader_id`) VALUES
(1, 1, 1, 'Учебный', 'Нет', 1, 'пунктуальность, ответственность', 'нет', 'частично', 'с трудом', 2, 1),
(2, 1, 2, 'Учебный', 'Нет', 3, 'пунктуальность', 'нет', 'частично', 'с трудом', 2, 1),
(3, 1, 3, 'Учебный', 'Нет', 2, 'ответственность', 'нет', 'частично', 'с трудом', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`) VALUES
(1, 'Верстка страницы доставки: 26/04/2024;\r\nНаписание скриптов для страниц: 26/04/2024;\r\nРедактирование API:26/04/2024;'),
(2, 'Заполнение readme: 26/04/2024;\r\nНачальная верстка страниц: 26/04/2024;\r\nРедактирование API: 26/04/2024;'),
(3, 'Настройка API: 26/04/2024;\r\nПодключение бд: 26/04/2024;\r\nСоздание бд: 26/04/2024;\r\nСоздание сервера: 26/04/2024;');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role_name`) VALUES
(1, 'pnv140402', '202cb962ac59075b964b07152d234b70', 'student'),
(2, 'bna070404', '202cb962ac59075b964b07152d234b70', 'student'),
(3, 'admin', '202cb962ac59075b964b07152d234b70', 'admin'),
(4, 'pes250804', '202cb962ac59075b964b07152d234b70', 'student'),
(6, 'zdo123', '202cb962ac59075b964b07152d234b70', 'company_leader'),
(7, 'sva123', '202cb962ac59075b964b07152d234b70', 'usu_leader'),
(8, 'sov123', '202cb962ac59075b964b07152d234b70', 'bpep_leader');

-- --------------------------------------------------------

--
-- Структура таблицы `USU_practice_leader`
--

CREATE TABLE `USU_practice_leader` (
  `id` int NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `USU_practice_leader`
--

INSERT INTO `USU_practice_leader` (`id`, `full_name`, `job_title`, `role_name`, `user_id`) VALUES
(1, 'Самарин Валерий Анатольевич', 'доцент', 'usu_leader', 7);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company_practice_leader`
--
ALTER TABLE `company_practice_leader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`type`);

--
-- Индексы таблицы `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`num`);

--
-- Индексы таблицы `direction`
--
ALTER TABLE `direction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intitute_id` (`institute_id`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `direction_id` (`direction_id`),
  ADD KEY `course_num` (`course_num`);

--
-- Индексы таблицы `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `is_paid`
--
ALTER TABLE `is_paid`
  ADD PRIMARY KEY (`value`);

--
-- Индексы таблицы `practice`
--
ALTER TABLE `practice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practice_type` (`practice_type`),
  ADD KEY `practice_vid` (`practice_vid`),
  ADD KEY `USU_leader_id` (`USU_leader_id`),
  ADD KEY `company_leader_id` (`company_leader_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Индексы таблицы `practice_place`
--
ALTER TABLE `practice_place`
  ADD PRIMARY KEY (`id`),
  ADD KEY `practice_id` (`practice_id`);

--
-- Индексы таблицы `practice_type`
--
ALTER TABLE `practice_type`
  ADD PRIMARY KEY (`type`);

--
-- Индексы таблицы `practice_vid`
--
ALTER TABLE `practice_vid`
  ADD PRIMARY KEY (`type`);

--
-- Индексы таблицы `program_leader`
--
ALTER TABLE `program_leader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institute_id` (`institute_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `student_practice`
--
ALTER TABLE `student_practice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_id` (`tasks_id`),
  ADD KEY `contract_type` (`contract_type`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `company_leader_id` (`company_leader_id`),
  ADD KEY `is_paid` (`is_paid`),
  ADD KEY `practice_id` (`practice_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_name` (`role_name`);

--
-- Индексы таблицы `USU_practice_leader`
--
ALTER TABLE `USU_practice_leader`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `company_practice_leader`
--
ALTER TABLE `company_practice_leader`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `direction`
--
ALTER TABLE `direction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `practice`
--
ALTER TABLE `practice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `practice_place`
--
ALTER TABLE `practice_place`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `program_leader`
--
ALTER TABLE `program_leader`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `student_practice`
--
ALTER TABLE `student_practice`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `company_practice_leader`
--
ALTER TABLE `company_practice_leader`
  ADD CONSTRAINT `company_practice_leader_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `direction`
--
ALTER TABLE `direction`
  ADD CONSTRAINT `direction_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`),
  ADD CONSTRAINT `direction_ibfk_2` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`);

--
-- Ограничения внешнего ключа таблицы `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`direction_id`) REFERENCES `direction` (`id`),
  ADD CONSTRAINT `group_ibfk_2` FOREIGN KEY (`course_num`) REFERENCES `course` (`num`),
  ADD CONSTRAINT `group_ibfk_3` FOREIGN KEY (`direction_id`) REFERENCES `direction` (`id`),
  ADD CONSTRAINT `group_ibfk_4` FOREIGN KEY (`course_num`) REFERENCES `course` (`num`);

--
-- Ограничения внешнего ключа таблицы `practice`
--
ALTER TABLE `practice`
  ADD CONSTRAINT `practice_ibfk_1` FOREIGN KEY (`practice_type`) REFERENCES `practice_type` (`type`),
  ADD CONSTRAINT `practice_ibfk_2` FOREIGN KEY (`practice_vid`) REFERENCES `practice_vid` (`type`),
  ADD CONSTRAINT `practice_ibfk_3` FOREIGN KEY (`USU_leader_id`) REFERENCES `USU_practice_leader` (`id`),
  ADD CONSTRAINT `practice_ibfk_4` FOREIGN KEY (`company_leader_id`) REFERENCES `company_practice_leader` (`id`),
  ADD CONSTRAINT `practice_ibfk_5` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Ограничения внешнего ключа таблицы `practice_place`
--
ALTER TABLE `practice_place`
  ADD CONSTRAINT `practice_place_ibfk_1` FOREIGN KEY (`practice_id`) REFERENCES `practice` (`id`);

--
-- Ограничения внешнего ключа таблицы `program_leader`
--
ALTER TABLE `program_leader`
  ADD CONSTRAINT `program_leader_ibfk_1` FOREIGN KEY (`institute_id`) REFERENCES `institute` (`id`),
  ADD CONSTRAINT `program_leader_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ограничения внешнего ключа таблицы `student_practice`
--
ALTER TABLE `student_practice`
  ADD CONSTRAINT `student_practice_ibfk_1` FOREIGN KEY (`tasks_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `student_practice_ibfk_2` FOREIGN KEY (`contract_type`) REFERENCES `contract` (`type`),
  ADD CONSTRAINT `student_practice_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_practice_ibfk_4` FOREIGN KEY (`tasks_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `student_practice_ibfk_5` FOREIGN KEY (`contract_type`) REFERENCES `contract` (`type`),
  ADD CONSTRAINT `student_practice_ibfk_6` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `student_practice_ibfk_7` FOREIGN KEY (`company_leader_id`) REFERENCES `company_practice_leader` (`id`),
  ADD CONSTRAINT `student_practice_ibfk_8` FOREIGN KEY (`is_paid`) REFERENCES `is_paid` (`value`),
  ADD CONSTRAINT `student_practice_ibfk_9` FOREIGN KEY (`practice_id`) REFERENCES `practice` (`id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_name`) REFERENCES `role` (`name`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`role_name`) REFERENCES `role` (`name`);

--
-- Ограничения внешнего ключа таблицы `USU_practice_leader`
--
ALTER TABLE `USU_practice_leader`
  ADD CONSTRAINT `usu_practice_leader_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
