-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2024 a las 21:32:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `project_manager_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cover_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `title`, `description`, `created_at`, `cover_name`) VALUES
(23, 8, 'project 1', 'this is the description project', '2024-07-06 18:08:04', 'php.png'),
(24, 8, 'project 2', 'hello, i\'m the second project', '2024-07-06 18:20:24', 'programar.jpg'),
(25, 8, 'project 3', 'Soy el proyecto 3', '2024-07-06 18:32:51', 'php.png'),
(26, 8, 'project 4', 'sigo completando mi portafolio de proyectos', '2024-07-06 19:11:27', 'C.jpg'),
(28, 8, 'project 5', 'This is the 5 project in this floder and in the project mangement of the user', '2024-07-06 20:22:22', 'software.jpg.webp'),
(29, 8, 'project 6', 'THis is the six project of the user and its the lastpne but not less important', '2024-07-06 20:25:52', 'images.jpg'),
(32, 7, 'esto es un proyect', 'esto es un refutado poryecto', '2024-07-06 21:29:55', 'programar.jpg'),
(33, 10, 'esto es un proyecto creado', '', '2024-07-06 21:36:47', 'C.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `end_date` date DEFAULT NULL,
  `priority` enum('Low','Medium','High') DEFAULT 'Medium',
  `notes` text DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `project_id`, `title`, `description`, `status`, `created_at`, `end_date`, `priority`, `notes`, `tags`) VALUES
(1, 23, 'sdcdcsdc', 'scdsc', 'Pending', '2024-07-06 20:11:15', NULL, 'Medium', NULL, NULL),
(2, 23, 'hola', 'x', 'Pending', '2024-07-06 20:11:38', NULL, 'Medium', 'hola soy una nota\nhola soy otra nota\r\n', NULL),
(3, 23, 'kcsdmc', 'csdsc', 'Pending', '2024-07-06 20:12:14', NULL, 'Medium', NULL, NULL),
(4, 23, 'tarea 3', 'esta es la descripción de la tarea 3', 'Pending', '2024-07-06 20:13:26', NULL, 'Medium', NULL, NULL),
(5, 23, 'esto es una tarea', 'que paso mi loco', 'Pending', '2024-07-06 20:19:02', NULL, 'Medium', NULL, NULL),
(6, 23, 'login regidter', 'tieenes que usar el metodo post para guardar todo en la basa de datos', 'Pending', '2024-07-06 21:27:12', NULL, 'Medium', NULL, NULL),
(7, 32, 'esta es tu primera tarea', '', 'Pending', '2024-07-06 21:30:07', NULL, 'Medium', NULL, NULL),
(8, 23, 'primera tarea con fecha de final', 'esta tarea es la primera en ser creada con fechas de finalización y esto es la descripción de dicha tarea', 'Pending', '2024-07-07 08:42:37', NULL, 'Medium', NULL, NULL),
(9, 23, 'aa', 'xsaxax', 'Pending', '2024-07-07 08:44:02', '2024-07-10', 'Medium', NULL, NULL),
(10, 23, 'task with high priority', 'this is a priority task adn here is the description', 'Pending', '2024-07-07 08:50:57', '2024-07-10', 'High', NULL, NULL),
(11, 28, 'class', 'tarea', 'Pending', '2024-07-07 09:36:34', '2024-07-09', 'High', NULL, NULL),
(12, 28, 'sdfcdc', 'sdccsc', 'Pending', '2024-07-07 09:36:46', '2024-07-10', 'Medium', NULL, NULL),
(13, 28, 'a', '', 'Pending', '2024-07-07 09:41:11', '2024-07-08', 'Low', NULL, NULL),
(14, 28, 'esto es una tarea', '', 'Pending', '2024-07-07 09:52:52', '2024-07-24', 'High', NULL, NULL),
(15, 28, 'task title', 'esto es la descripcion de mi tarea', 'Pending', '2024-07-07 10:11:50', '2024-07-16', 'High', 'probando porbando\nesto es una nota', 'work, php, concentración , programación'),
(16, 28, 'cdsc', 'sdcsc', 'Pending', '2024-07-07 10:13:32', '2024-07-08', 'Medium', NULL, 'tag');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `email`) VALUES
(2, 'xxxx', '$2y$10$YcZNVfV92QPAmirrQ.1YoOZpWSAULCEDJUZZnjYVbeZwFP2Z5siuW', '2024-06-29 18:31:56', 'x@gmail.com'),
(3, 'root', '$2y$10$7ct68u5YG4V17jAJRXSvK.pyoiogDXdQPFmyWxO7K9HiD107QWiHu', '2024-06-29 18:33:52', 'root@gmail.com'),
(4, '1234', '$2y$10$TKJqQftP5d4PhKRqsBh.BOaZYNDU/vWXLKNMwjBrvU5oG9ZUOuwA6', '2024-06-29 18:48:02', '1234@gmail.com'),
(5, 'dddwe', '$2y$10$zErnETS/JnJUBPTVHj73Qu.hQ/UayeqzXniJ5AH4X/RyHU0cHP5A6', '2024-06-30 14:27:43', 'wedwd@gmail.com'),
(6, 'aaaa', '$2y$10$GmTt2u1rPUqhSp5si3JlOeMKeBWfXt0irqB5A/uRyRyEeKI5VfYPS', '2024-06-30 14:41:07', 'aaaa@aaaa.com'),
(7, 'loco', '$2y$10$.XnxOZfHdTO6u9fbE/wgceDyfm2NWLICOYPwg9vNA3t3ycwXff/jS', '2024-06-30 14:47:30', 'loco@gmail.com'),
(8, 'user', '$2y$10$D40J/G3mZTC3fY1AWjH0BeUtFhdTyt.E/x3bPdp2MenwBJJo5/Mma', '2024-06-30 17:54:23', 'user@gmail.com'),
(10, 'martin', '$2y$10$TGP98naEA9pkWRX6SY3IZOh.SGbg7.3Xx2hLXokyP1/suQ8sk.pS.', '2024-07-06 21:33:30', 'martin@gmail.com'),
(11, 'hola', '$2y$10$74ESE/DMI/PWtmsNFzkyheo8gxJX8tTJiURRXiashISvh2u.or4GK', '2024-07-06 21:35:00', 'hola@gmail.com'),
(12, 'gote', '$2y$10$gQEBGmUyzFgCjJrYCel5I.JZ6DII8d33lhdJU9IinMSMIW2UhSuzu', '2024-07-07 17:12:59', 'goteelisa@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
