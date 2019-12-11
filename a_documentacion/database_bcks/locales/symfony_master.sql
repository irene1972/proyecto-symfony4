-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2019 a las 09:55:10
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.2.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `symfony_master`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `priority` varchar(20) DEFAULT NULL,
  `hours` int(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `content`, `priority`, `hours`, `created_at`) VALUES
(1, 1, 'Tarea 1', 'Contenido de prueba 1', 'hight', 40, '2019-12-05 20:31:50'),
(2, 1, 'Tarea 2', 'Contenido de prueba 2', 'low', 20, '2019-12-05 20:31:50'),
(3, 2, 'Tarea 3', 'Contenido de prueba 3', 'medium', 10, '2019-12-05 20:31:50'),
(4, 3, 'Tarea 4', 'Contenido de prueba 4', 'hight', 50, '2019-12-05 20:31:50'),
(6, 5, 'aaa6', 'bbb6', 'medium', 66, '2019-12-10 20:47:43'),
(9, 7, 'aaa111', 'bbb111', 'medium', 11, '2019-12-10 22:36:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `surname`, `email`, `password`, `created_at`) VALUES
(1, 'ROLE_USER', 'Irene', 'Olgo', 'ire@ire.es', 'password', '2019-12-05 20:21:18'),
(2, 'ROLE_USER', 'Ariadna', 'Bool', 'ari@ari.com', 'password2', '2019-12-05 20:21:18'),
(3, 'ROLE_USER', 'Carlos', 'Perea', 'carlos@carlos.es', 'password3', '2019-12-05 20:21:18'),
(4, 'ROLE_USER', 'aaa', 'bbb', 'ccc@ccc.es', '$2y$04$R6KoJ/mF1Cco0CoO0.jtKujMl6JoLpUXUqoLpjWp4Z5L4790ad356', '2019-12-09 17:33:42'),
(5, 'ROLE_USER', 'Paco', 'Martinez', 'paco@paco.es', '$2y$04$Iw1jayHlhC//g8dm7Jmcx.C/QhcIf4bJx4hUzyLAMcVf7ZoyD8.3W', '2019-12-09 18:59:51'),
(6, 'ROLE_USER', 'Mario', 'Casas', 'mario@mario.es', '$2y$04$f1bPE6IahhoMeauukZAMdeUbo4d1CCFg0xl384acJdozMx28wb6qi', '2019-12-09 19:14:42'),
(7, 'ROLE_USER', 'Emilia', 'Gogu', 'emi@emi.es', '$2y$04$rTMEFAq.6wlxeKI0z31dB.rQPVVMvrr/aIdY/yV9E2jIVe98dyaHm', '2019-12-10 21:35:05'),
(8, 'ROLE_USER', 'Oscar', 'Olgoz', 'oscar@oscar.com', '$2y$04$21chad.J5xEvJAdY3le9Quq.QWrfZFwMTUVXvkHN7XmXkJmNnGSwK', '2019-12-11 09:08:26');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_task_user` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_task_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
