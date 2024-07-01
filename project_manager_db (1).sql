-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-07-2024 a las 17:23:18
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `title`, `description`, `created_at`) VALUES
(1, 8, 'desarrollo de esta aplicación', 'programar...', '2024-06-30 21:01:10'),
(2, 8, 'desarrollo', 'programar', '2024-06-30 21:04:51'),
(3, 8, 'desarrollo', 'programar', '2024-06-30 21:04:55'),
(4, 7, 'hola', '', '2024-07-01 14:57:46'),
(5, 7, 'hola2', '.', '2024-07-01 15:00:49'),
(6, 7, 'a', 'a', '2024-07-01 15:06:38'),
(7, 7, 'axas', 'xasx', '2024-07-01 15:10:54');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(8, 'user', '$2y$10$D40J/G3mZTC3fY1AWjH0BeUtFhdTyt.E/x3bPdp2MenwBJJo5/Mma', '2024-06-30 17:54:23', 'user@gmail.com');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
