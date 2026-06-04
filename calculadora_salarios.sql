-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-06-2026 a las 20:58:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `calculadora_salarios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calculos`
--

CREATE TABLE `calculos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salario_base` decimal(10,2) NOT NULL,
  `isss` decimal(10,2) DEFAULT NULL,
  `afp` decimal(10,2) DEFAULT NULL,
  `renta` decimal(10,2) DEFAULT NULL,
  `salario_neto` decimal(10,2) DEFAULT NULL,
  `aguinaldo` decimal(10,2) DEFAULT NULL,
  `vacaciones` decimal(10,2) DEFAULT NULL,
  `indemnizacion` decimal(10,2) DEFAULT NULL,
  `tipo_calculo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `renuncia_voluntaria` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `calculos`
--

INSERT INTO `calculos` (`id`, `user_id`, `salario_base`, `isss`, `afp`, `renta`, `salario_neto`, `aguinaldo`, `vacaciones`, `indemnizacion`, `tipo_calculo`, `created_at`, `updated_at`, `renuncia_voluntaria`) VALUES
(9, 1, 800.00, 24.00, 58.00, 34.47, 683.53, NULL, NULL, NULL, 'salario', '2026-06-05 01:01:44', '2026-06-05 01:57:10', NULL),
(10, 1, 800.00, 16.00, 58.00, 35.27, 690.73, NULL, NULL, NULL, 'salario', '2026-06-05 01:06:19', '2026-06-05 01:06:19', NULL),
(13, 1, 1500.00, 30.00, 123.25, 190.30, 1356.44, NULL, NULL, NULL, 'salario', '2026-06-05 02:02:05', '2026-06-05 02:02:05', NULL),
(14, 1, 1200.00, 30.00, 87.00, 97.55, 985.45, NULL, NULL, NULL, 'salario', '2026-06-05 02:20:01', '2026-06-05 02:20:01', NULL),
(15, 1, 800.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'prestaciones', '2026-06-05 02:21:11', '2026-06-05 02:21:11', NULL),
(16, 1, 800.00, NULL, NULL, NULL, NULL, 157.81, 120.00, 315.62, 'prestaciones', '2026-06-05 02:26:32', '2026-06-05 02:26:32', 0.00),
(17, 1, 800.00, NULL, NULL, NULL, NULL, 157.81, 120.00, 315.62, 'prestaciones', '2026-06-05 02:27:36', '2026-06-05 02:27:36', 0.00),
(18, 1, 600.00, NULL, NULL, NULL, NULL, 118.36, 90.00, 236.71, 'prestaciones', '2026-06-05 02:31:34', '2026-06-05 02:31:34', 0.00),
(19, 1, 700.00, NULL, NULL, NULL, NULL, 350.00, 105.00, 700.00, 'prestaciones', '2026-06-05 02:33:16', '2026-06-05 02:44:07', 700.00),
(20, 1, 300.00, NULL, NULL, NULL, NULL, 150.00, 45.00, 300.00, 'prestaciones', '2026-06-05 02:33:24', '2026-06-05 02:44:47', 300.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `isss` decimal(8,4) NOT NULL DEFAULT 0.0300,
  `afp` decimal(8,4) NOT NULL DEFAULT 0.0725,
  `techo_afp` decimal(10,2) NOT NULL DEFAULT 7045.06,
  `techo_isss` decimal(10,2) NOT NULL DEFAULT 1000.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `isss`, `afp`, `techo_afp`, `techo_isss`, `created_at`, `updated_at`) VALUES
(1, 0.0300, 0.0725, 7045.06, 1000.00, '2026-06-05 00:16:58', '2026-06-05 01:56:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_03_161527_create_calculos_table', 2),
(5, '2026_06_04_175001_add_role_to_users_table', 3),
(6, '2026_06_04_181439_create_descuentos_table', 4),
(7, '2026_06_04_182606_add_user_id_to_calculos_table', 5),
(8, '2026_06_04_194009_add_renuncia_voluntaria_to_calculos_table', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('fabio@gmail.com', '$2y$12$NTmyi4j8uKCqipBjDSRs6OjrSglgyTDbHExGbDNWi/U0.yXFJ/b2e', '2026-06-04 08:45:53'),
('melisa@gmail.com', '$2y$12$3S6S5FAUmQHGhQgmhjIsDeC95xvBetnhsxnFnlVhyeJB7QThNYsHG', '2026-06-05 01:22:49'),
('oswaldo.199704@gmail.com', '$2y$12$SjH5V4ohGeAOfQPwPvNWLeobQLSYibJLm6.u7FFn7FuEVD45uBAbi', '2026-06-04 08:47:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('usuario','admin') NOT NULL DEFAULT 'usuario',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fabio', 'fabio@gmail.com', 'admin', NULL, '$2y$12$OnyPdtwb66CQK0vCkoxwluv4Mk2y7/NZaHD1niOueaynaggTd1BSq', NULL, '2026-06-04 00:02:36', '2026-06-04 23:54:29'),
(2, 'Melisa', 'melisa@gmail.com', 'usuario', NULL, '$2y$12$Ld.rpAcxQIDZGslvkw9wKOiIPhENouhSDRgELd5h8/9ZY3v/6J/Ue', NULL, '2026-06-04 02:39:53', '2026-06-04 02:39:53'),
(3, 'Camila', 'camila1@gmail.com', 'usuario', NULL, '$2y$12$GAQDfbu9Evl4rmOTv.JVtuaQwX6lzX6S.qQgyYXKX85kw22PUQ8Ai', NULL, '2026-06-04 03:11:09', '2026-06-04 03:11:09'),
(4, 'Bryan Argueta', 'oswaldo.199704@gmail.com', 'usuario', NULL, '$2y$12$YiiBLPJyXOGzY5ShFiGWEOLdc6EMe3gXYkUWWL3tVoelizUiP/hby', 'EMU5zLQTf5O6Pm1gSf67FRHo4paaVFZJXzO96w2T3Z2t1MPEBimrQCp24fGe', '2026-06-04 08:47:21', '2026-06-04 08:47:21'),
(5, 'Fernanda', 'fernanda@gmail.com', 'admin', NULL, '$2y$12$.zZYVs6sfR63WXVZiiutUOiVPMWjQvheHwV53XOX2lzUL8BjW8YP6', NULL, '2026-06-05 02:56:11', '2026-06-05 02:56:11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `calculos`
--
ALTER TABLE `calculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calculos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calculos`
--
ALTER TABLE `calculos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calculos`
--
ALTER TABLE `calculos`
  ADD CONSTRAINT `calculos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
