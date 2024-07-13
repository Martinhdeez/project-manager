S-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2024 a las 10:07:05
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
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`, `created_at`) VALUES
(1, 'martinherzgon@gmail.com', '8ed56ccb73d7f21a092cb09afab2f208110dcf28e9fee55932f50a826762534fdc0243e32c6c26618b1f0ca54a6321bf4e04', '2024-07-12 15:32:05', '2024-07-12 14:32:05'),
(2, 'martinherzgon@gmail.com', 'bfe8b1384b25563f57fea99035091f8c199824b1b1c3b2d879e60d6e7ac823a2139b0a51d786b15224c5e7aeae2c63fcd683', '2024-07-13 09:03:31', '2024-07-13 08:03:31');

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
(23, 8, 'project 1', 'this is the description project', '2024-07-06 18:08:04', '23 class=.jpeg'),
(26, 8, 'project 4', 'sigo completando mi portafolio de proyectos', '2024-07-06 19:11:27', '26 class=.jpeg'),
(28, 8, 'projectjibiuibkbibub', 'This is the 5 project in this floder and in the project mangement of the user', '2024-07-06 20:22:22', '28 class=.jpeg'),
(32, 7, 'esto es un proyect', 'esto es un refutado poryecto', '2024-07-06 21:29:55', 'programar.jpg'),
(33, 10, 'esto es un proyecto creado', '', '2024-07-06 21:36:47', '33 class=.jpeg'),
(39, 8, 'holaesto es mi proyecto', 'esto es un project', '2024-07-09 16:01:39', '39 class=.jpg'),
(42, 8, 'project XY', 'thisi is the project XY', '2024-07-09 16:31:34', '42 class=.jpeg'),
(43, 8, 'project', 'this is a project', '2024-07-09 16:47:43', '43 class=.jpg');

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
(3, 23, 'kcsdmc', 'csdsc', 'Pending', '2024-07-06 20:12:14', '2024-07-11', 'Medium', '', 'label, tags , # , loco , .'),
(7, 32, 'esta es tu primera tarea', '', 'Pending', '2024-07-06 21:30:07', NULL, 'Medium', NULL, NULL),
(9, 23, 'aa', 'esto es la description\r\n', 'Completed', '2024-07-07 08:44:02', '2024-07-10', 'Low', 'hola soy una nota', 'not urgent'),
(10, 23, 'task with high priority', 'this is a priority task adn here is the description', 'Completed', '2024-07-07 08:50:57', '2024-07-10', 'High', '', ''),
(11, 28, 'class', 'tarea', 'Pending', '2024-07-07 09:36:34', '2024-07-09', 'High', NULL, NULL),
(12, 28, 'sdfcdc', 'sdccsc', 'Pending', '2024-07-07 09:36:46', '2024-07-10', 'Medium', 'esto es una nota pendiente\r\n', ''),
(13, 28, 'a', '', 'Pending', '2024-07-07 09:41:11', '2024-07-08', 'Low', NULL, NULL),
(14, 28, 'esto es una tarea', '', 'Completed', '2024-07-07 09:52:52', '2024-07-24', 'High', NULL, NULL),
(16, 28, 'cdsc', 'sdcsc', 'Pending', '2024-07-07 10:13:32', '2024-07-08', 'Medium', NULL, 'tag'),
(22, 26, 'title', '', 'Completed', '2024-07-09 11:56:23', '0000-00-00', 'Medium', '', 'work, abc, xyc'),
(23, 23, 'newTASK', 'This is a new task', 'Completed', '2024-07-09 12:24:01', '2024-07-12', 'Low', 'acabo de tener un dejabau o como se escriba', 'work'),
(24, 39, 'tarea 1', 'esto es una tarea', 'Pending', '2024-07-09 16:03:38', '2024-07-10', 'High', '-urgente', 'pequeñita, importanrt, urgent'),
(25, 39, 'hola', '', 'Pending', '2024-07-11 18:05:29', '0000-00-00', 'Medium', '', '');

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
(12, 'gote', '$2y$10$gQEBGmUyzFgCjJrYCel5I.JZ6DII8d33lhdJU9IinMSMIW2UhSuzu', '2024-07-07 17:12:59', 'goteelisa@gmail.com'),
(13, 'prueba', '$2y$10$sjOfJIPZDBsPwB9lSOEFoOAiLvrOWpSf1PsF/u92t6q6WTftRF4VC', '2024-07-07 19:35:31', 'prueba@gmail.com'),
(14, 'confirm', '$2y$10$k5N.pVqJ6tgEjmOjBE4YEOA3g3hnGiX4Xi5j8ACr.t6.em6zVy5Oq', '2024-07-12 10:28:08', 'confirm@gmail.com'),
(15, 'martinhdeez', '$2y$10$37CzoO9jHaPo8MALBfn8yOxGPSW2sI1bO2kA7eNxetyj9CNzc5foe', '2024-07-12 11:03:00', 'martinherzgon@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
