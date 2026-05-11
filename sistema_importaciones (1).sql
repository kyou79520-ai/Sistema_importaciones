-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2026 a las 05:45:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_importaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agente_aduanal`
--

CREATE TABLE `agente_aduanal` (
  `id_agente` int(11) NOT NULL,
  `nombre_agente` varchar(200) DEFAULT NULL,
  `num_patente` varchar(20) DEFAULT NULL,
  `aduana_adscrita` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `RFC_agente` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agente_aduanal`
--

INSERT INTO `agente_aduanal` (`id_agente`, `nombre_agente`, `num_patente`, `aduana_adscrita`, `telefono`, `RFC_agente`) VALUES
(1, 'Carlos Perez', 'PAT001', 'Manzanillo', '5554444444', 'RFCAGENTE123'),
(2, 'Maria Lopez', 'PAT002', 'Veracruz', '5558888888', 'RFCAGENTE456'),
(3, 'Jorge Ramirez', 'PAT003', 'Lázaro Cárdenas', '5559999999', 'RFCAGENTE789'),
(4, 'Roberto Estrada Cano', 'PAT004', 'Altamira', '8331122334', 'EECR760815H10'),
(5, 'Beatriz Solorio Vega', 'PAT005', 'Nuevo Laredo', '8672233445', 'SOVB820423M20'),
(6, 'Hector Aguilar Melendez', 'PAT006', 'Tijuana', '6649988776', 'AUMH700312H30'),
(7, 'Diana Quiroz Pacheco', 'PAT007', 'Ciudad Juárez', '6566677889', 'QUPD850901M40'),
(8, 'Alfredo Pineda Romero', 'PAT008', 'Progreso', '9991122334', 'PIRA790605H50'),
(9, 'Mariana Cervantes Luna', 'PAT009', 'Mazatlán', '6699988877', 'CELM880712M60'),
(10, 'Sergio Mejía Vargas', 'PAT010', 'Ensenada', '6464455667', 'MEVS810218H70'),
(11, 'Lourdes Trejo Morales', 'PAT011', 'Manzanillo', '3145566778', 'TRML871028M80'),
(12, 'Javier Olivares Camacho', 'PAT012', 'Veracruz', '2299988877', 'OICJ770104H90'),
(13, 'Norma Galván Espinosa', 'PAT013', 'Lázaro Cárdenas', '7531122334', 'GAEN830519M01'),
(14, 'Raúl Domínguez Bravo', 'PAT014', 'Reynosa', '8993344556', 'DOBR740806H11'),
(15, 'Carolina Pérez Solís', 'PAT015', 'Matamoros', '8689988776', 'PESC890227M21'),
(16, 'Tomás Aranda Gutiérrez', 'PAT016', 'Aeropuerto CDMX', '5567788990', 'AAGT720915H31'),
(17, 'Esperanza Ruiz Hernández', 'PAT017', 'Aeropuerto MTY', '8155566778', 'RUHE860410M41'),
(18, 'Pablo Marín Acosta', 'PAT018', 'Aeropuerto GDL', '3322334455', 'MAAP800723H51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditoria`
--

CREATE TABLE `auditoria` (
  `id_auditoria` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `accion` varchar(50) NOT NULL,
  `tabla_afectada` varchar(100) NOT NULL,
  `valores_anteriores` longtext DEFAULT NULL CHECK (json_valid(`valores_anteriores`)),
  `valores_nuevos` longtext DEFAULT NULL CHECK (json_valid(`valores_nuevos`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `auditoria`
--

INSERT INTO `auditoria` (`id_auditoria`, `id_usuario`, `accion`, `tabla_afectada`, `valores_anteriores`, `valores_nuevos`, `ip_address`, `fecha_hora`) VALUES
(1, 1, 'CREATE', 'importacion', NULL, '{\"numero\":\"IMP-2026-016\",\"estado\":\"borrador\"}', '127.0.0.1', '2026-04-15 15:30:00'),
(2, 13, 'UPDATE', 'importacion', '{\"estado\":\"borrador\"}', '{\"estado\":\"en_tramite\"}', '192.168.1.15', '2026-04-16 17:00:00'),
(3, 13, 'UPDATE', 'importacion', '{\"estado\":\"en_tramite\"}', '{\"estado\":\"en_aduana\"}', '192.168.1.15', '2026-04-19 20:30:00'),
(4, 13, 'UPDATE', 'importacion', '{\"estado\":\"en_aduana\"}', '{\"estado\":\"liberada\"}', '192.168.1.15', '2026-04-22 16:00:00'),
(5, 6, 'CREATE', 'documento', NULL, '{\"tipo\":\"Factura\",\"imp\":17}', '192.168.1.20', '2026-04-19 17:15:00'),
(6, 8, 'UPDATE', 'documento', '{\"validado\":false}', '{\"validado\":true}', '192.168.1.22', '2026-04-19 22:00:00'),
(7, 7, 'CREATE', 'pago', NULL, '{\"monto\":62500,\"imp\":19}', '192.168.1.18', '2026-04-15 20:00:00'),
(8, 13, 'UPDATE', 'usuario', '{\"activo\":true}', '{\"activo\":false,\"id\":14}', '127.0.0.1', '2026-04-20 16:00:00'),
(9, 1, 'CREATE', 'rol_permiso', NULL, '{\"rol\":2,\"permisos_count\":9}', '127.0.0.1', '2026-04-01 14:00:00'),
(10, 13, 'DELETE', 'documento', '{\"id\":50,\"tipo\":\"Otro\"}', NULL, '192.168.1.15', '2026-04-25 22:00:00'),
(11, 9, 'CREATE', 'importacion', NULL, '{\"numero\":\"IMP-2026-021\",\"valor\":215000}', '192.168.1.30', '2026-05-01 16:00:00'),
(12, 13, 'UPDATE', 'importacion', '{\"estado\":\"borrador\"}', '{\"estado\":\"cancelada\",\"id\":34}', '192.168.1.15', '2026-04-21 17:30:00'),
(13, 11, 'CREATE', 'item_importacion', NULL, '{\"imp\":24,\"cant\":3000,\"desc\":\"Aceite oliva\"}', '192.168.1.40', '2026-04-29 17:00:00'),
(14, 7, 'LOGIN', 'usuario', NULL, '{\"usuario\":\"ricardo\"}', '189.203.45.122', '2026-04-28 18:45:00'),
(15, 6, 'LOGIN', 'usuario', NULL, '{\"usuario\":\"karen\"}', '189.203.45.122', '2026-04-28 23:22:00'),
(16, 1, 'LOGIN', 'usuario', NULL, '{\"usuario\":\"admin\"}', '127.0.0.1', '2026-04-29 11:30:00'),
(17, 8, 'UPDATE', 'documento', '{\"validado\":false}', '{\"validado\":true,\"id\":35}', '192.168.1.22', '2026-04-19 23:30:00'),
(18, 13, 'CREATE', 'permiso', NULL, '{\"nombre\":\"Aprobar\",\"modulo\":\"Importacion\"}', '127.0.0.1', '2026-04-01 14:30:00'),
(19, 10, 'UPDATE', 'importacion', '{\"total_cif\":0}', '{\"total_cif\":38500.00,\"id\":22}', '192.168.1.50', '2026-04-14 15:45:00'),
(20, 11, 'CREATE', 'pago', NULL, '{\"monto\":78000,\"imp\":25}', '192.168.1.40', '2026-04-26 20:15:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costo_importacion`
--

CREATE TABLE `costo_importacion` (
  `id_costo` bigint(20) UNSIGNED NOT NULL,
  `id_importacion` int(11) NOT NULL,
  `concepto` varchar(255) NOT NULL,
  `monto` decimal(15,2) NOT NULL,
  `moneda` varchar(10) NOT NULL DEFAULT 'MXN',
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `costo_importacion`
--

INSERT INTO `costo_importacion` (`id_costo`, `id_importacion`, `concepto`, `monto`, `moneda`, `descripcion`) VALUES
(1, 16, 'Flete marítimo', 1800.00, 'USD', 'Flete Hamburgo - Manzanillo'),
(2, 16, 'Seguro de carga', 850.00, 'USD', '1% del valor CIF'),
(3, 16, 'Maniobras puerto', 1200.00, 'MXN', 'Descarga en Manzanillo'),
(4, 16, 'Honorarios agente', 2500.00, 'MXN', 'Patente PAT004'),
(5, 17, 'Flete marítimo', 1500.00, 'USD', 'Ho Chi Minh - Manzanillo'),
(6, 17, 'Maniobras puerto', 900.00, 'MXN', NULL),
(7, 18, 'Flete marítimo', 1100.00, 'USD', 'Santos - Veracruz'),
(8, 18, 'Almacenaje', 600.00, 'MXN', '3 días en aduana'),
(9, 19, 'Flete aéreo', 4500.00, 'USD', 'Nueva Delhi - CDMX vía MEX'),
(10, 19, 'Seguro especial', 1250.00, 'USD', 'Seguro farmacéuticos'),
(11, 19, 'Honorarios agente', 6000.00, 'MXN', NULL),
(12, 20, 'Flete marítimo', 1400.00, 'USD', 'Génova - Veracruz'),
(13, 20, 'Maniobras puerto', 850.00, 'MXN', NULL),
(14, 21, 'Flete aéreo', 8500.00, 'USD', 'Tokio - CDMX (carga delicada)'),
(15, 21, 'Seguro especial', 2150.00, 'USD', '1% valor CIF + extra robótica'),
(16, 22, 'Flete marítimo', 1600.00, 'USD', 'Shanghai - Manzanillo'),
(17, 23, 'Flete marítimo', 1200.00, 'USD', 'Santos - Veracruz'),
(18, 24, 'Flete marítimo', 900.00, 'USD', 'Valencia - Veracruz'),
(19, 25, 'Flete aéreo', 3200.00, 'USD', 'París - CDMX'),
(20, 25, 'Seguro de carga', 780.00, 'USD', NULL),
(21, 26, 'Flete marítimo', 2400.00, 'USD', 'Hamburgo - Altamira'),
(22, 26, 'Maniobras puerto', 1800.00, 'MXN', 'Carga sobredimensionada'),
(23, 27, 'Flete marítimo', 1700.00, 'USD', 'Busan - Manzanillo'),
(24, 28, 'Flete marítimo', 1100.00, 'USD', 'Shanghai - Manzanillo'),
(25, 29, 'Flete marítimo', 800.00, 'USD', 'Bangkok - Manzanillo'),
(26, 30, 'Flete marítimo', 1500.00, 'USD', 'Vancouver - Ensenada'),
(27, 30, 'Almacenaje', 1200.00, 'MXN', '5 días pendiente liberación'),
(28, 31, 'Flete marítimo', 1000.00, 'USD', 'Shanghai - Manzanillo'),
(29, 32, 'Flete aéreo', 5500.00, 'USD', 'Taipéi - CDMX (chips)'),
(30, 32, 'Seguro especial', 1680.00, 'USD', NULL),
(31, 33, 'Flete marítimo', 1100.00, 'USD', 'Buenos Aires - Veracruz'),
(32, 35, 'Flete aéreo', 3800.00, 'USD', 'Mumbai - CDMX'),
(33, 35, 'Honorarios agente', 3500.00, 'MXN', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id_documento` int(11) NOT NULL,
  `id_importacion` int(11) DEFAULT NULL,
  `id_usuario_subida` int(11) DEFAULT NULL,
  `id_usuario_validador` int(11) DEFAULT NULL,
  `tipo_documento` varchar(50) DEFAULT NULL,
  `ruta_archivo` varchar(500) DEFAULT NULL,
  `fecha_subida` datetime DEFAULT NULL,
  `validado` tinyint(1) DEFAULT NULL,
  `fecha_validacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id_documento`, `id_importacion`, `id_usuario_subida`, `id_usuario_validador`, `tipo_documento`, `ruta_archivo`, `fecha_subida`, `validado`, `fecha_validacion`) VALUES
(1, 1, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(2, 2, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(3, 3, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(4, 4, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(5, 5, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(6, 6, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(7, 7, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(8, 8, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(9, 9, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(10, 10, 1, 2, 'Factura', '/docs/factura.pdf', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29'),
(16, 11, 4, 1, 'Factura', '/docs/imp011_factura.pdf', '2026-02-15 19:00:47', 1, '2026-02-15 19:00:47'),
(17, 12, 5, 2, 'Factura', '/docs/imp012_factura.pdf', '2026-02-15 19:00:47', 1, '2026-02-15 19:00:47'),
(18, 13, 4, 1, 'Factura', '/docs/imp013_factura.pdf', '2026-02-15 19:00:47', 1, '2026-02-15 19:00:47'),
(19, 14, 5, 3, 'Factura', '/docs/imp014_factura.pdf', '2026-02-15 19:00:47', 1, '2026-02-15 19:00:47'),
(20, 15, 1, 2, 'Factura', '/docs/imp015_factura.pdf', '2026-02-15 19:00:47', 1, '2026-02-15 19:00:47'),
(21, 16, 6, 13, 'Factura', 'documentos/16/factura_imp016.pdf', '2026-04-16 09:00:00', 1, '2026-04-16 14:00:00'),
(22, 16, 6, 13, 'Pedimento', 'documentos/16/pedimento_imp016.pdf', '2026-04-20 10:00:00', 1, '2026-04-20 16:30:00'),
(23, 16, 6, 13, 'BL', 'documentos/16/bl_imp016.pdf', '2026-04-15 08:30:00', 1, '2026-04-15 11:00:00'),
(24, 17, 6, 8, 'Factura', 'documentos/17/factura_imp017.pdf', '2026-04-19 11:15:00', 1, '2026-04-19 16:00:00'),
(25, 17, 6, 8, 'Packing List', 'documentos/17/packing_imp017.pdf', '2026-04-19 11:20:00', 0, NULL),
(26, 18, 7, 8, 'Factura', 'documentos/18/factura_imp018.pdf', '2026-04-26 10:00:00', 0, NULL),
(27, 18, 7, NULL, 'Certificado de Origen', 'documentos/18/certificado_imp018.pdf', '2026-04-26 10:05:00', 0, NULL),
(28, 19, 7, 13, 'Factura', 'documentos/19/factura_imp019.pdf', '2026-04-13 09:00:00', 1, '2026-04-13 17:00:00'),
(29, 19, 7, 13, 'Pedimento', 'documentos/19/pedimento_imp019.pdf', '2026-04-17 14:00:00', 1, '2026-04-18 09:30:00'),
(30, 19, 7, 13, 'BL', 'documentos/19/bl_imp019.pdf', '2026-04-12 12:00:00', 1, '2026-04-13 08:00:00'),
(31, 20, 9, 12, 'Factura', 'documentos/20/factura_imp020.pdf', '2026-04-09 11:00:00', 1, '2026-04-09 14:30:00'),
(32, 20, 9, 12, 'Pedimento', 'documentos/20/pedimento_imp020.pdf', '2026-04-14 10:30:00', 1, '2026-04-15 11:00:00'),
(33, 21, 9, NULL, 'Factura', 'documentos/21/factura_imp021.pdf', '2026-05-01 10:00:00', 0, NULL),
(34, 22, 10, 12, 'Factura', 'documentos/22/factura_imp022.pdf', '2026-04-14 09:30:00', 1, '2026-04-14 15:00:00'),
(35, 22, 10, 12, 'Pedimento', 'documentos/22/pedimento_imp022.pdf', '2026-04-19 13:00:00', 1, '2026-04-19 17:30:00'),
(36, 23, 10, 8, 'Factura', 'documentos/23/factura_imp023.pdf', '2026-04-22 11:45:00', 1, '2026-04-22 16:00:00'),
(37, 24, 11, NULL, 'Factura', 'documentos/24/factura_imp024.pdf', '2026-04-29 10:30:00', 0, NULL),
(38, 25, 11, 12, 'Factura', 'documentos/25/factura_imp025.pdf', '2026-04-24 09:00:00', 1, '2026-04-24 13:30:00'),
(39, 25, 11, 12, 'Pedimento', 'documentos/25/pedimento_imp025.pdf', '2026-04-29 11:00:00', 1, '2026-04-30 09:00:00'),
(40, 27, 7, 13, 'Factura', 'documentos/27/factura_imp027.pdf', '2026-04-20 10:00:00', 1, '2026-04-20 16:00:00'),
(41, 28, 9, 8, 'Factura', 'documentos/28/factura_imp028.pdf', '2026-04-27 14:30:00', 1, '2026-04-27 17:00:00'),
(42, 29, 10, 12, 'Factura', 'documentos/29/factura_imp029.pdf', '2026-04-13 10:00:00', 1, '2026-04-13 14:00:00'),
(43, 29, 10, 12, 'Pedimento', 'documentos/29/pedimento_imp029.pdf', '2026-04-18 09:30:00', 1, '2026-04-18 13:30:00'),
(44, 31, 13, 12, 'Factura', 'documentos/31/factura_imp031.pdf', '2026-04-17 11:00:00', 1, '2026-04-17 15:00:00'),
(45, 32, 13, 8, 'Factura', 'documentos/32/factura_imp032.pdf', '2026-04-23 09:00:00', 1, '2026-04-23 16:30:00'),
(46, 32, 13, 8, 'Packing List', 'documentos/32/packing_imp032.pdf', '2026-04-23 09:10:00', 0, NULL),
(47, 35, 9, NULL, 'Factura', 'documentos/35/factura_imp035.pdf', '2026-04-30 11:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `ApellidoPaterno` varchar(255) NOT NULL,
  `ApellidoMaterno` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `Foto` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `correo`, `Foto`, `created_at`, `updated_at`) VALUES
(2, 'Kanye', 'Omari', 'West', 'jhdjd@gmail.com', 'uploads/ORiKAGceUZkyh5vgrBpqoM14Fbe5Y9OhqJvyqC4G.png', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_extranjera`
--

CREATE TABLE `empresa_extranjera` (
  `id_empresa` int(11) NOT NULL,
  `nombre_empresa` varchar(200) DEFAULT NULL,
  `pais_origen` varchar(100) DEFAULT NULL,
  `contacto` varchar(200) DEFAULT NULL,
  `moneda_default` varchar(10) DEFAULT NULL,
  `num_tax_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa_extranjera`
--

INSERT INTO `empresa_extranjera` (`id_empresa`, `nombre_empresa`, `pais_origen`, `contacto`, `moneda_default`, `num_tax_id`) VALUES
(1, 'Tech China Ltd', 'China', 'Li Wei', 'USD', 'TAX123'),
(2, 'Maquinarias USA Corp', 'Estados Unidos', 'John Miller', 'USD', 'TAXUSA456'),
(3, 'Electronica Korea Ltd', 'Corea del Sur', 'Kim Soo', 'USD', 'TAXKOR789'),
(4, 'Shanghai Electronics Co. Ltd.', 'China', 'Chen Wei', 'USD', 'TAX-CN-2024-001'),
(5, 'Bavaria Automotive Parts GmbH', 'Alemania', 'Hans Schmidt', 'EUR', 'DE123456789'),
(6, 'Milano Textile Industries SpA', 'Italia', 'Giovanni Rossi', 'EUR', 'IT04567891234'),
(7, 'Tokyo Robotics Corporation', 'Japón', 'Takashi Yamamoto', 'USD', 'JP-9988-7766'),
(8, 'Vietnam Garment Export Co.', 'Vietnam', 'Nguyen Thi Lan', 'USD', 'VN-554433221'),
(9, 'Brasil Café Premium Ltda.', 'Brasil', 'Carlos Silva', 'USD', 'BR-12345678901'),
(10, 'India Pharma Solutions Pvt.', 'India', 'Rajesh Kumar', 'USD', 'IN-AAACI1234D'),
(11, 'Spain Olive Oil Producers SL', 'España', 'Carmen García', 'EUR', 'ES-B12345678'),
(12, 'Canada Lumber & Wood Inc.', 'Canadá', 'Michael Thompson', 'USD', 'CA-789456123'),
(13, 'France Cosmetics Beauté SAS', 'Francia', 'Sophie Dubois', 'EUR', 'FR-12-345678901'),
(14, 'Taiwan Semiconductor Mfg.', 'Taiwán', 'Lin Hsiao-ming', 'USD', 'TW-23456789'),
(15, 'Argentina Wine Bodegas SA', 'Argentina', 'Lucas Fernández', 'USD', 'AR-30-12345678-9'),
(16, 'Thailand Rubber Industries Ltd.', 'Tailandia', 'Somchai Phongphan', 'USD', 'TH-0105543000123'),
(17, 'Netherlands Flower Auctions BV', 'Países Bajos', 'Jan van der Berg', 'EUR', 'NL-987654321B01'),
(18, 'South Korea Display Tech Inc.', 'Corea del Sur', 'Park Min-jun', 'USD', 'KR-211-87-12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_importadora`
--

CREATE TABLE `empresa_importadora` (
  `id_empresa_mx` int(11) NOT NULL,
  `RFC_empresa` varchar(13) DEFAULT NULL,
  `razon_social` varchar(300) DEFAULT NULL,
  `padron_importadores` varchar(50) DEFAULT NULL,
  `giro_comercial` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa_importadora`
--

INSERT INTO `empresa_importadora` (`id_empresa_mx`, `RFC_empresa`, `razon_social`, `padron_importadores`, `giro_comercial`) VALUES
(1, 'RFCEMPRESA01', 'Importadora MX SA', 'PAD001', 'Electrónicos'),
(2, 'RFCEMPRESA02', 'Comercializadora del Norte SA', 'PAD002', 'Maquinaria Industrial'),
(3, 'RFCEMPRESA03', 'Tecnologia Global MX', 'PAD003', 'Componentes Electrónicos'),
(4, 'AGM910515AB3', 'Automotriz Guadalupe del Mar SA de CV', 'PAD004', 'Refacciones Automotrices'),
(5, 'TIN850720XY7', 'Textiles Industriales del Norte SA de CV', 'PAD005', 'Textiles y Confección'),
(6, 'AMP000412KL2', 'Alimentos y Más Productos SA de CV', 'PAD006', 'Alimentos Procesados'),
(7, 'FRM981203QR9', 'Farmacéutica Renovación Médica SAPI', 'PAD007', 'Productos Farmacéuticos'),
(8, 'CER050308MN5', 'Cerámicas y Revestimientos México SA', 'PAD008', 'Materiales de Construcción'),
(9, 'EQG020617ST6', 'Equipo Quirúrgico de Guanajuato SA', 'PAD009', 'Equipo Médico'),
(10, 'JTM880925VW1', 'Juguetes y Tiendas de Mayoreo SA de CV', 'PAD010', 'Juguetería'),
(11, 'BCM110730CD4', 'Bebidas y Café Mundial SA de CV', 'PAD011', 'Bebidas y Cafetería'),
(12, 'DEC960215EF8', 'Decoración y Estilos del Caribe SA', 'PAD012', 'Decoración del Hogar'),
(13, 'PEM030522GH7', 'Perfumería Élite Mexicana SA de CV', 'PAD013', 'Cosméticos y Perfumería'),
(14, 'MIN780611IJ5', 'Maquinaria Industrial Norteña SA', 'PAD014', 'Maquinaria Pesada'),
(15, 'SAA920418KL3', 'Seguridad y Alarmas Avanzadas SAPI', 'PAD015', 'Sistemas de Seguridad'),
(16, 'DEV041019MN6', 'Distribuidora Eléctrica Vega SA de CV', NULL, 'Material Eléctrico'),
(17, 'HER070825OP8', 'Herramientas Especializadas Reyes SA', 'PAD017', 'Herramientas Industriales'),
(18, 'LEC120304QR0', 'Lencería y Telas Carmín SA de CV', NULL, 'Hogar y Textiles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importacion`
--

CREATE TABLE `importacion` (
  `id_importacion` int(11) NOT NULL,
  `id_empresa_mx` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_usuario_creador` int(11) DEFAULT NULL,
  `numero_importacion` varchar(50) DEFAULT NULL,
  `proveedor` varchar(200) DEFAULT NULL,
  `pais_origen` varchar(100) DEFAULT NULL,
  `fecha_arribo` date DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `total_cif` decimal(15,2) DEFAULT NULL,
  `total_impuestos` decimal(15,2) DEFAULT NULL,
  `total_aduanales` decimal(15,2) DEFAULT NULL,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `importacion`
--

INSERT INTO `importacion` (`id_importacion`, `id_empresa_mx`, `id_empresa`, `id_usuario_creador`, `numero_importacion`, `proveedor`, `pais_origen`, `fecha_arribo`, `estado`, `total_cif`, `total_impuestos`, `total_aduanales`, `notas`) VALUES
(1, 1, 1, 1, 'IMP001', 'Tech China Ltd', 'China', '2025-01-01', 'En proceso', 10000.00, 1600.00, 500.00, 'Primera importación'),
(2, 1, 1, 2, 'IMP002', 'Tech China Ltd', 'China', '2025-01-05', 'En proceso', 12000.00, 1920.00, 600.00, 'Segunda'),
(3, 1, 1, 2, 'IMP003', 'Tech China Ltd', 'China', '2025-01-10', 'En proceso', 15000.00, 2400.00, 750.00, 'Tercera'),
(4, 1, 1, 3, 'IMP004', 'Tech China Ltd', 'China', '2025-01-15', 'En proceso', 18000.00, 2880.00, 900.00, 'Cuarta'),
(5, 1, 1, 1, 'IMP005', 'Tech China Ltd', 'China', '2025-01-20', 'En proceso', 20000.00, 3200.00, 1000.00, 'Quinta'),
(6, 1, 1, 2, 'IMP006', 'Tech China Ltd', 'China', '2025-01-25', 'En proceso', 22000.00, 3520.00, 1100.00, 'Sexta'),
(7, 1, 1, 3, 'IMP007', 'Tech China Ltd', 'China', '2025-02-01', 'En proceso', 25000.00, 4000.00, 1200.00, 'Séptima'),
(8, 1, 1, 1, 'IMP008', 'Tech China Ltd', 'China', '2025-02-05', 'En proceso', 28000.00, 4480.00, 1400.00, 'Octava'),
(9, 1, 1, 2, 'IMP009', 'Tech China Ltd', 'China', '2025-02-10', 'En proceso', 30000.00, 4800.00, 1500.00, 'Novena'),
(10, 1, 1, 3, 'IMP010', 'Tech China Ltd', 'China', '2025-02-15', 'En proceso', 35000.00, 5600.00, 1700.00, 'Décima'),
(11, 2, 2, 4, 'IMP011', 'Maquinarias USA Corp', 'Estados Unidos', '2025-03-01', 'En proceso', 40000.00, 6400.00, 2000.00, 'Maquinaria pesada'),
(12, 2, 2, 5, 'IMP012', 'Maquinarias USA Corp', 'Estados Unidos', '2025-03-05', 'En proceso', 45000.00, 7200.00, 2200.00, 'Refacciones industriales'),
(13, 3, 3, 4, 'IMP013', 'Electronica Korea Ltd', 'Corea del Sur', '2025-03-10', 'En proceso', 30000.00, 4800.00, 1500.00, 'Tarjetas electrónicas'),
(14, 3, 3, 5, 'IMP014', 'Electronica Korea Ltd', 'Corea del Sur', '2025-03-15', 'En proceso', 35000.00, 5600.00, 1700.00, 'Microchips'),
(15, 2, 3, 1, 'IMP015', 'Electronica Korea Ltd', 'Corea del Sur', '2025-03-20', 'En proceso', 25000.00, 4000.00, 1300.00, 'Componentes mixtos'),
(16, 4, 5, 6, 'IMP-2026-016', 'Bavaria Automotive Parts GmbH', 'Alemania', '2026-04-22', 'liberada', 85000.00, 13600.00, 4250.00, 'Refacciones para línea premium'),
(17, 5, 8, 6, 'IMP-2026-017', 'Vietnam Garment Export Co.', 'Vietnam', '2026-04-25', 'en_aduana', 42000.00, 6720.00, 2100.00, 'Camisetas algodón orgánico'),
(18, 6, 9, 7, 'IMP-2026-018', 'Brasil Café Premium Ltda.', 'Brasil', '2026-05-02', 'en_tramite', 28500.00, 4560.00, 1425.00, 'Café arábica gourmet'),
(19, 7, 10, 7, 'IMP-2026-019', 'India Pharma Solutions Pvt.', 'India', '2026-04-18', 'liberada', 125000.00, 20000.00, 6250.00, 'Lote de antibióticos'),
(20, 8, 6, 9, 'IMP-2026-020', 'Milano Textile Industries SpA', 'Italia', '2026-04-15', 'entregada', 68000.00, 10880.00, 3400.00, 'Telas de lino premium'),
(21, 9, 7, 9, 'IMP-2026-021', 'Tokyo Robotics Corporation', 'Japón', '2026-05-08', 'borrador', 215000.00, 34400.00, 10750.00, 'Brazos robóticos médicos'),
(22, 10, 4, 10, 'IMP-2026-022', 'Shanghai Electronics Co. Ltd.', 'China', '2026-04-20', 'liberada', 38500.00, 6160.00, 1925.00, 'Juguetes electrónicos navideños'),
(23, 11, 9, 10, 'IMP-2026-023', 'Brasil Café Premium Ltda.', 'Brasil', '2026-04-28', 'en_aduana', 52000.00, 8320.00, 2600.00, 'Café orgánico fair trade'),
(24, 12, 11, 11, 'IMP-2026-024', 'Spain Olive Oil Producers SL', 'España', '2026-05-05', 'en_tramite', 45000.00, 7200.00, 2250.00, 'Aceite de oliva extra virgen'),
(25, 13, 13, 11, 'IMP-2026-025', 'France Cosmetics Beauté SAS', 'Francia', '2026-04-30', 'liberada', 78000.00, 12480.00, 3900.00, 'Línea de cosméticos importada'),
(26, 14, 5, 6, 'IMP-2026-026', 'Bavaria Automotive Parts GmbH', 'Alemania', '2026-05-12', 'borrador', 180000.00, 28800.00, 9000.00, 'Maquinaria de soldadura'),
(27, 15, 18, 7, 'IMP-2026-027', 'South Korea Display Tech Inc.', 'Corea del Sur', '2026-04-26', 'entregada', 92000.00, 14720.00, 4600.00, 'Pantallas LCD para alarmas'),
(28, 4, 4, 9, 'IMP-2026-028', 'Shanghai Electronics Co. Ltd.', 'China', '2026-05-03', 'en_aduana', 56000.00, 8960.00, 2800.00, 'Sensores automotrices'),
(29, 5, 16, 10, 'IMP-2026-029', 'Thailand Rubber Industries Ltd.', 'Tailandia', '2026-04-19', 'liberada', 35000.00, 5600.00, 1750.00, 'Hules para suelas'),
(30, 8, 12, 11, 'IMP-2026-030', 'Canada Lumber & Wood Inc.', 'Canadá', '2026-05-10', 'borrador', 75000.00, 12000.00, 3750.00, 'Madera laminada para pisos'),
(31, 16, 4, 13, 'IMP-2026-031', 'Shanghai Electronics Co. Ltd.', 'China', '2026-04-23', 'liberada', 42000.00, 6720.00, 2100.00, 'Cables y conectores eléctricos'),
(32, 17, 14, 13, 'IMP-2026-032', 'Taiwan Semiconductor Mfg.', 'Taiwán', '2026-04-29', 'en_aduana', 168000.00, 26880.00, 8400.00, 'Microchips para industria'),
(33, 11, 15, 7, 'IMP-2026-033', 'Argentina Wine Bodegas SA', 'Argentina', '2026-05-15', 'borrador', 62000.00, 9920.00, 3100.00, 'Vinos malbec premium'),
(34, 18, 17, 6, 'IMP-2026-034', 'Netherlands Flower Auctions BV', 'Países Bajos', '2026-04-21', 'cancelada', 18500.00, 0.00, 500.00, 'Cancelado por proveedor'),
(35, 7, 10, 9, 'IMP-2026-035', 'India Pharma Solutions Pvt.', 'India', '2026-05-06', 'en_tramite', 98000.00, 15680.00, 4900.00, 'Vitaminas y suplementos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importacion_agente`
--

CREATE TABLE `importacion_agente` (
  `id_imp_agente` int(11) NOT NULL,
  `id_importacion` int(11) DEFAULT NULL,
  `id_agente` int(11) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `importacion_agente`
--

INSERT INTO `importacion_agente` (`id_imp_agente`, `id_importacion`, `id_agente`, `fecha_asignacion`) VALUES
(1, 1, 1, '2026-02-15 18:53:29'),
(2, 2, 1, '2026-02-15 18:53:29'),
(3, 3, 1, '2026-02-15 18:53:29'),
(4, 4, 1, '2026-02-15 18:53:29'),
(5, 5, 1, '2026-02-15 18:53:29'),
(6, 6, 1, '2026-02-15 18:53:29'),
(7, 7, 1, '2026-02-15 18:53:29'),
(8, 8, 1, '2026-02-15 18:53:29'),
(9, 9, 1, '2026-02-15 18:53:29'),
(10, 10, 1, '2026-02-15 18:53:29'),
(16, 11, 2, '2026-02-15 19:00:47'),
(17, 12, 2, '2026-02-15 19:00:47'),
(18, 13, 3, '2026-02-15 19:00:47'),
(19, 14, 3, '2026-02-15 19:00:47'),
(20, 15, 2, '2026-02-15 19:00:47'),
(45, 16, 4, '2026-04-15 10:00:00'),
(46, 16, 5, '2026-04-15 10:00:00'),
(47, 17, 8, '2026-04-18 11:30:00'),
(48, 18, 12, '2026-04-25 09:15:00'),
(49, 19, 11, '2026-04-12 14:20:00'),
(50, 19, 13, '2026-04-12 14:25:00'),
(51, 20, 12, '2026-04-08 10:00:00'),
(52, 21, 16, '2026-05-01 11:00:00'),
(53, 21, 17, '2026-05-01 11:05:00'),
(54, 22, 11, '2026-04-13 13:45:00'),
(55, 23, 13, '2026-04-21 15:00:00'),
(56, 24, 14, '2026-04-28 12:30:00'),
(57, 25, 15, '2026-04-23 09:45:00'),
(58, 26, 6, '2026-05-05 14:00:00'),
(59, 27, 7, '2026-04-19 10:20:00'),
(60, 28, 11, '2026-04-26 16:00:00'),
(61, 28, 18, '2026-04-26 16:00:00'),
(62, 29, 6, '2026-04-12 11:30:00'),
(63, 30, 14, '2026-05-03 09:00:00'),
(64, 31, 4, '2026-04-16 13:00:00'),
(65, 32, 17, '2026-04-22 14:15:00'),
(66, 33, 9, '2026-05-08 10:30:00'),
(67, 34, 12, '2026-04-14 11:00:00'),
(68, 35, 11, '2026-04-29 15:40:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuesto`
--

CREATE TABLE `impuesto` (
  `id_impuesto` int(11) NOT NULL,
  `id_item` int(11) DEFAULT NULL,
  `tipo_impuesto` varchar(50) DEFAULT NULL,
  `base_imponible` decimal(15,2) DEFAULT NULL,
  `tasa_porcentaje` decimal(5,2) DEFAULT NULL,
  `monto` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `impuesto`
--

INSERT INTO `impuesto` (`id_impuesto`, `id_item`, `tipo_impuesto`, `base_imponible`, `tasa_porcentaje`, `monto`) VALUES
(1, 1, 'IVA', 10000.00, 16.00, 1600.00),
(2, 2, 'IVA', 10000.00, 16.00, 1600.00),
(3, 3, 'IVA', 10000.00, 16.00, 1600.00),
(4, 4, 'IVA', 10000.00, 16.00, 1600.00),
(5, 5, 'IVA', 10000.00, 16.00, 1600.00),
(6, 6, 'IVA', 10000.00, 16.00, 1600.00),
(7, 7, 'IVA', 10000.00, 16.00, 1600.00),
(8, 8, 'IVA', 10000.00, 16.00, 1600.00),
(9, 9, 'IVA', 10000.00, 16.00, 1600.00),
(10, 10, 'IVA', 10000.00, 16.00, 1600.00),
(16, 16, 'IVA', 40000.00, 16.00, 6400.00),
(17, 17, 'IVA', 45000.00, 16.00, 7200.00),
(18, 18, 'IVA', 30000.00, 16.00, 4800.00),
(19, 19, 'IVA', 35000.00, 16.00, 5600.00),
(20, 20, 'IVA', 25000.00, 16.00, 4000.00),
(21, 21, 'IVA', 30000.00, 16.00, 4800.00),
(22, 22, 'IVA', 35000.00, 16.00, 5600.00),
(23, 23, 'IVA', 20000.00, 16.00, 3200.00),
(24, 24, 'IVA', 30000.00, 16.00, 4800.00),
(25, 25, 'IVA', 12000.00, 16.00, 1920.00),
(26, 26, 'IVA', 22500.00, 16.00, 3600.00),
(27, 27, 'IVA', 6000.00, 16.00, 960.00),
(28, 28, 'IVA', 90000.00, 16.00, 14400.00),
(29, 29, 'IVA', 24000.00, 16.00, 3840.00),
(30, 30, 'IVA', 11000.00, 16.00, 1760.00),
(31, 31, 'IVA', 68000.00, 16.00, 10880.00),
(32, 32, 'IVA', 175000.00, 16.00, 28000.00),
(33, 33, 'IVA', 40000.00, 16.00, 6400.00),
(34, 34, 'IVA', 38500.00, 16.00, 6160.00),
(35, 35, 'IVA', 52000.00, 16.00, 8320.00),
(36, 36, 'IVA', 45000.00, 16.00, 7200.00),
(37, 37, 'IVA', 48000.00, 16.00, 7680.00),
(38, 38, 'IVA', 30000.00, 16.00, 4800.00),
(39, 39, 'IVA', 144000.00, 16.00, 23040.00),
(40, 40, 'IVA', 36000.00, 16.00, 5760.00),
(41, 41, 'IVA', 92000.00, 16.00, 14720.00),
(42, 42, 'IVA', 56000.00, 16.00, 8960.00),
(43, 43, 'IVA', 35000.00, 16.00, 5600.00),
(44, 44, 'IVA', 75000.00, 16.00, 12000.00),
(45, 45, 'IVA', 25500.00, 16.00, 4080.00),
(46, 46, 'IVA', 16500.00, 16.00, 2640.00),
(47, 47, 'IVA', 168000.00, 16.00, 26880.00),
(48, 48, 'IVA', 62000.00, 16.00, 9920.00),
(49, 49, 'IVA', 18500.00, 16.00, 0.00),
(50, 50, 'IVA', 63000.00, 16.00, 10080.00),
(51, 51, 'IVA', 35000.00, 16.00, 5600.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_importacion`
--

CREATE TABLE `item_importacion` (
  `id_item` int(11) NOT NULL,
  `id_importacion` int(11) DEFAULT NULL,
  `numero_linea` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad` decimal(12,2) DEFAULT NULL,
  `valor_unitario` decimal(12,2) DEFAULT NULL,
  `peso_kg` decimal(10,2) DEFAULT NULL,
  `codigo_hs` varchar(20) DEFAULT NULL,
  `unidad_medida` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `valor_total` decimal(15,2) GENERATED ALWAYS AS (`cantidad` * `valor_unitario`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `item_importacion`
--

INSERT INTO `item_importacion` (`id_item`, `id_importacion`, `numero_linea`, `descripcion`, `cantidad`, `valor_unitario`, `peso_kg`, `codigo_hs`, `unidad_medida`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(2, 2, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(3, 3, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(4, 4, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(5, 5, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(6, 6, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(7, 7, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(8, 8, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(9, 9, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(10, 10, 1, 'Laptop Lenovo', 10.00, 1000.00, 50.00, '847130', 'PZA', NULL, NULL),
(16, 11, 1, 'Maquina CNC', 2.00, 20000.00, 1500.00, '845710', 'PZA', NULL, NULL),
(17, 12, 1, 'Motor Industrial', 5.00, 9000.00, 800.00, '850152', 'PZA', NULL, NULL),
(18, 13, 1, 'Tarjeta Madre Industrial', 100.00, 300.00, 200.00, '847330', 'PZA', NULL, NULL),
(19, 14, 1, 'Microchip Procesador', 500.00, 70.00, 100.00, '854231', 'PZA', NULL, NULL),
(20, 15, 1, 'Modulo Electronico', 200.00, 125.00, 120.00, '853890', 'PZA', NULL, NULL),
(21, 16, 1, 'Pastillas de freno cerámicas', 50.00, 600.00, 95.00, '870830', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(22, 16, 2, 'Bujías de iridio premium', 200.00, 175.00, 25.00, '851110', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(23, 16, 3, 'Filtros de aire deportivos', 100.00, 200.00, 45.00, '842123', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(24, 17, 1, 'Camisetas algodón orgánico unisex', 2000.00, 15.00, 480.00, '610910', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(25, 17, 2, 'Camisetas algodón infantiles', 1500.00, 8.00, 240.00, '610910', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(26, 18, 1, 'Granos de café arábica tostado', 500.00, 45.00, 500.00, '090121', 'KG', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(27, 18, 2, 'Café molido especialidad', 300.00, 20.00, 300.00, '090121', 'KG', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(28, 19, 1, 'Amoxicilina 500mg blister', 5000.00, 18.00, 200.00, '300420', 'CAJA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(29, 19, 2, 'Cefalexina 250mg jarabe', 2000.00, 12.00, 400.00, '300420', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(30, 19, 3, 'Material de empaque farmacéutico', 1.00, 11000.00, 150.00, '481910', 'JUEGO', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(31, 20, 1, 'Tela de lino italiano por metro', 1700.00, 40.00, 850.00, '530710', 'MT', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(32, 21, 1, 'Brazo robótico médico 6 ejes', 5.00, 35000.00, 1200.00, '847989', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(33, 21, 2, 'Sistema de control para robot', 5.00, 8000.00, 150.00, '853710', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(34, 22, 1, 'Juguetes electrónicos navideños', 3500.00, 11.00, 420.00, '950300', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(35, 23, 1, 'Café orgánico fair trade premium', 650.00, 80.00, 650.00, '090121', 'KG', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(36, 24, 1, 'Aceite oliva extra virgen 1L', 3000.00, 15.00, 3000.00, '150910', 'LT', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(37, 25, 1, 'Set cosmética facial premium', 1500.00, 32.00, 180.00, '330499', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(38, 25, 2, 'Perfumes línea Beauté 50ml', 600.00, 50.00, 90.00, '330300', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(39, 26, 1, 'Soldadora MIG/MAG industrial', 12.00, 12000.00, 1800.00, '854511', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(40, 26, 2, 'Electrodos de tungsteno premium', 2000.00, 18.00, 400.00, '854511', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(41, 27, 1, 'Pantalla LCD 7 pulgadas industrial', 400.00, 230.00, 120.00, '852852', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(42, 28, 1, 'Sensores automotrices ABS', 800.00, 70.00, 80.00, '903289', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(43, 29, 1, 'Hule sintético para suelas en planchas', 700.00, 50.00, 1400.00, '400510', 'KG', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(44, 30, 1, 'Madera de pino laminada', 500.00, 150.00, 4500.00, '441012', 'M3', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(45, 31, 1, 'Cable eléctrico THHN calibre 12', 3000.00, 8.50, 900.00, '854442', 'MT', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(46, 31, 2, 'Conectores RJ45 industriales', 5000.00, 3.30, 50.00, '853669', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(47, 32, 1, 'Microchips ARM Cortex-M4', 1200.00, 140.00, 3.00, '854231', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(48, 33, 1, 'Vino Malbec reserva 750ml', 2480.00, 25.00, 1860.00, '220421', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(49, 34, 1, 'Flores frescas mixtas', 100.00, 185.00, 120.00, '060312', 'CAJA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(50, 35, 1, 'Multivitamínico premium 60 cápsulas', 3500.00, 18.00, 525.00, '210610', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19'),
(51, 35, 2, 'Vitamina C 1000mg 100 tab', 2000.00, 17.50, 200.00, '210610', 'PZA', '2026-04-30 04:07:19', '2026-04-30 04:07:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
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
(5, '2026_03_14_171308_create_empleados_table', 2),
(6, '2026_01_01_000001_create_usuario_table', 3),
(7, '2026_01_01_000002_create_rol_table', 3),
(8, '2026_01_01_000003_create_permiso_table', 3),
(9, '2026_01_01_000004_create_rol_permiso_table', 3),
(10, '2026_01_01_000005_create_usuario_rol_table', 3),
(11, '2026_01_01_000006_create_empresa_extranjera_table', 3),
(12, '2026_01_01_000007_create_empresa_importadora_table', 3),
(13, '2026_01_01_000008_create_agente_aduanal_table', 3),
(14, '2026_01_01_000009_create_importacion_table', 3),
(15, '2026_01_01_000010_create_importacion_agente_table', 3),
(16, '2026_01_01_000011_create_item_importacion_table', 3),
(17, '2026_01_01_000012_create_documento_table', 3),
(18, '2026_01_01_000013_create_impuesto_table', 3),
(19, '2026_01_01_000014_create_costo_importacion_table', 3),
(20, '2026_01_01_000015_create_pago_table', 3),
(21, '2026_01_01_000016_create_reporte_table', 3),
(22, '2026_01_01_000017_create_auditoria_table', 3),
(23, '2026_01_01_000018_create_log_sistema_externo_table', 3),
(24, '2026_04_28_100000_add_remember_token_to_usuario_table', 4),
(25, '2026_04_29_000001_create_modulos_extra_tables', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` bigint(20) UNSIGNED NOT NULL,
  `id_importacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `monto` decimal(15,2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `num_comprobante` varchar(100) DEFAULT NULL,
  `moneda` varchar(10) NOT NULL DEFAULT 'MXN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `id_importacion`, `id_usuario`, `monto`, `fecha_pago`, `metodo_pago`, `num_comprobante`, `moneda`) VALUES
(1, 16, 6, 85000.00, '2026-04-18', 'SPEI', 'SPEI-2026-0416-001', 'MXN'),
(2, 16, 6, 13600.00, '2026-04-20', 'SPEI', 'SPEI-2026-0420-002', 'MXN'),
(3, 17, 6, 20000.00, '2026-04-22', 'Transferencia', 'TRF-789456', 'MXN'),
(4, 17, 6, 22000.00, '2026-04-25', 'Transferencia', 'TRF-789457', 'MXN'),
(5, 19, 7, 62500.00, '2026-04-15', 'SPEI', 'SPEI-2026-0415-005', 'MXN'),
(6, 19, 7, 62500.00, '2026-04-17', 'SPEI', 'SPEI-2026-0417-008', 'MXN'),
(7, 19, 7, 20000.00, '2026-04-18', 'SPEI', 'SPEI-2026-0418-011', 'MXN'),
(8, 20, 9, 68000.00, '2026-04-12', 'Cheque', 'CHQ-001234', 'MXN'),
(9, 20, 9, 10880.00, '2026-04-14', 'Cheque', 'CHQ-001245', 'MXN'),
(10, 22, 10, 38500.00, '2026-04-19', 'SPEI', 'SPEI-2026-0419-022', 'MXN'),
(11, 22, 10, 6160.00, '2026-04-21', 'SPEI', 'SPEI-2026-0421-023', 'MXN'),
(12, 25, 11, 78000.00, '2026-04-26', 'Transferencia', 'TRF-901234', 'MXN'),
(13, 25, 11, 12480.00, '2026-04-28', 'Transferencia', 'TRF-901241', 'MXN'),
(14, 27, 7, 92000.00, '2026-04-22', 'SPEI', 'SPEI-2026-0422-030', 'MXN'),
(15, 27, 7, 14720.00, '2026-04-24', 'SPEI', 'SPEI-2026-0424-031', 'MXN'),
(16, 29, 10, 35000.00, '2026-04-15', 'Tarjeta', 'TC-VISA-7890', 'MXN'),
(17, 31, 13, 42000.00, '2026-04-19', 'SPEI', 'SPEI-2026-0419-040', 'MXN'),
(18, 31, 13, 6720.00, '2026-04-21', 'SPEI', 'SPEI-2026-0421-041', 'MXN'),
(19, 18, 7, 15000.00, '2026-04-28', 'SPEI', 'SPEI-2026-0428-050', 'MXN'),
(20, 23, 10, 26000.00, '2026-04-25', 'Transferencia', 'TRF-902301', 'MXN'),
(21, 28, 9, 30000.00, '2026-05-01', 'SPEI', 'SPEI-2026-0501-001', 'MXN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `modulo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre`, `descripcion`, `modulo`) VALUES
(1, 'Crear', 'Crear registros', 'Importacion'),
(2, 'Editar', 'Editar registros', 'Importacion'),
(3, 'Eliminar', 'Eliminar registros', 'Importacion'),
(94, 'Ver', 'Consultar registros', 'Importacion'),
(95, 'Aprobar', 'Aprobar cambios de estado', 'Importacion'),
(96, 'Crear Documento', 'Subir documentos', 'Documento'),
(97, 'Validar Documento', 'Validar documentos cargados', 'Documento'),
(98, 'Eliminar Documento', 'Eliminar documentos', 'Documento'),
(99, 'Crear Pago', 'Registrar pagos', 'Pago'),
(100, 'Ver Pago', 'Consultar pagos', 'Pago'),
(101, 'Crear Costo', 'Registrar costos adicionales', 'Costo'),
(102, 'Crear Usuario', 'Crear nuevos usuarios', 'Admin'),
(103, 'Editar Usuario', 'Modificar usuarios', 'Admin'),
(104, 'Asignar Rol', 'Asignar roles a usuarios', 'Admin'),
(105, 'Ver Reporte', 'Consultar reportes', 'Reporte'),
(106, 'Generar Reporte', 'Generar nuevos reportes', 'Reporte'),
(107, 'Ver Auditoria', 'Ver bitácora del sistema', 'Auditoria'),
(108, 'Configurar Sistema', 'Modificar configuraciones globales', 'Admin'),
(124, 'Ver', 'Consultar registros', 'Importacion'),
(125, 'Aprobar', 'Aprobar cambios de estado', 'Importacion'),
(126, 'Crear Documento', 'Subir documentos', 'Documento'),
(127, 'Validar Documento', 'Validar documentos cargados', 'Documento'),
(128, 'Eliminar Documento', 'Eliminar documentos', 'Documento'),
(129, 'Crear Pago', 'Registrar pagos', 'Pago'),
(130, 'Ver Pago', 'Consultar pagos', 'Pago'),
(131, 'Crear Costo', 'Registrar costos adicionales', 'Costo'),
(132, 'Crear Usuario', 'Crear nuevos usuarios', 'Admin'),
(133, 'Editar Usuario', 'Modificar usuarios', 'Admin'),
(134, 'Asignar Rol', 'Asignar roles a usuarios', 'Admin'),
(135, 'Ver Reporte', 'Consultar reportes', 'Reporte'),
(136, 'Generar Reporte', 'Generar nuevos reportes', 'Reporte'),
(137, 'Ver Auditoria', 'Ver bitácora del sistema', 'Auditoria'),
(138, 'Configurar Sistema', 'Modificar configuraciones globales', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` bigint(20) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_reporte` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(500) DEFAULT NULL,
  `formato` enum('PDF','Excel','CSV','HTML') NOT NULL DEFAULT 'PDF',
  `parametros` longtext DEFAULT NULL CHECK (json_valid(`parametros`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reporte`
--

INSERT INTO `reporte` (`id_reporte`, `id_usuario`, `nombre_reporte`, `titulo`, `ruta_archivo`, `formato`, `parametros`) VALUES
(1, 1, 'reporte_mensual', 'Resumen Mensual Abril 2026', 'reportes/abril_2026.pdf', 'PDF', '{\"mes\":\"04\",\"anio\":2026}'),
(2, 13, 'reporte_estado', 'Importaciones En Trámite', 'reportes/en_tramite_20260428.pdf', 'PDF', '{\"estado\":\"en_tramite\"}'),
(3, 13, 'reporte_pais', 'Importaciones por País', 'reportes/pais_2026q1.xlsx', 'Excel', '{\"trimestre\":1,\"anio\":2026}'),
(4, 6, 'reporte_proveedor', 'Top Proveedores Q1 2026', 'reportes/top_proveedores_q1.xlsx', 'Excel', '{\"top\":10,\"trimestre\":1}'),
(5, 7, 'reporte_pagos', 'Estado de Pagos Abril', 'reportes/pagos_abril.csv', 'CSV', '{\"mes\":\"04\",\"anio\":2026}'),
(6, 8, 'reporte_auditoria', 'Auditoría Documentos Abril', 'reportes/audit_docs_abril.pdf', 'PDF', '{\"tipo\":\"documentos\"}'),
(7, 12, 'reporte_validacion', 'Documentos Sin Validar', 'reportes/sin_validar.pdf', 'PDF', '{\"validado\":false}'),
(8, 13, 'reporte_costos', 'Costos por Importación', 'reportes/costos_2026.xlsx', 'Excel', '{\"agrupar\":\"importacion\"}'),
(9, 1, 'reporte_aduana', 'Importaciones por Aduana', 'reportes/aduanas_2026.pdf', 'PDF', '{\"anio\":2026}'),
(10, 11, 'reporte_giro', 'Importaciones por Giro Comercial', 'reportes/giros_2026.html', 'HTML', '{\"anio\":2026}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`, `descripcion`) VALUES
(1, 'Administrador', 'Control total'),
(2, 'Operador', 'Gestiona importaciones'),
(3, 'Auditor', 'Supervisa operaciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id_rol_permiso` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `id_permiso` int(11) DEFAULT NULL,
  `asignado_en` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id_rol_permiso`, `id_rol`, `id_permiso`, `asignado_en`) VALUES
(487, 1, 1, '2026-04-29 22:03:24'),
(488, 1, 2, '2026-04-29 22:03:24'),
(489, 1, 3, '2026-04-29 22:03:24'),
(490, 1, 94, '2026-04-29 22:03:24'),
(491, 1, 95, '2026-04-29 22:03:24'),
(492, 1, 96, '2026-04-29 22:03:24'),
(493, 1, 97, '2026-04-29 22:03:24'),
(494, 1, 98, '2026-04-29 22:03:24'),
(495, 1, 99, '2026-04-29 22:03:24'),
(496, 1, 100, '2026-04-29 22:03:24'),
(497, 1, 101, '2026-04-29 22:03:24'),
(498, 1, 102, '2026-04-29 22:03:24'),
(499, 1, 103, '2026-04-29 22:03:24'),
(500, 1, 104, '2026-04-29 22:03:24'),
(501, 1, 105, '2026-04-29 22:03:24'),
(502, 1, 106, '2026-04-29 22:03:24'),
(503, 1, 107, '2026-04-29 22:03:24'),
(504, 1, 108, '2026-04-29 22:03:24'),
(505, 2, 1, '2026-04-29 22:03:24'),
(506, 2, 2, '2026-04-29 22:03:24'),
(507, 2, 94, '2026-04-29 22:03:24'),
(508, 2, 96, '2026-04-29 22:03:24'),
(509, 2, 99, '2026-04-29 22:03:24'),
(510, 2, 100, '2026-04-29 22:03:24'),
(511, 2, 101, '2026-04-29 22:03:24'),
(512, 2, 105, '2026-04-29 22:03:24'),
(513, 2, 106, '2026-04-29 22:03:24'),
(514, 3, 94, '2026-04-29 22:03:24'),
(515, 3, 97, '2026-04-29 22:03:24'),
(516, 3, 100, '2026-04-29 22:03:24'),
(517, 3, 105, '2026-04-29 22:03:24'),
(518, 3, 107, '2026-04-29 22:03:24');

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

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4uOfzmnD7x1mC9oXeDJSYKGNpJ5h998bCuq9ACDp', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVzEyMnNZZzNBVHByVnFpR2FBVGZlaThlcEpabDZ5S1ZKWW1MV3RFTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbXBvcnRhY2lvbiI7czo1OiJyb3V0ZSI7czoxNzoiaW1wb3J0YWNpb24uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc3NzQ0MzM5Nzt9fQ==', 1777443465),
('QOElm5TDfhI4kYAYWn1nPTu4BX7KQ2Rn5uF3wfUT', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkZOdXlsUE9zRVZPOXZxQm11Y2t1dUhaWHJEdEM1VTBkUzhxUGtBOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cDovL2xvY2FsaG9zdC9zaXN0ZW1hX2ltcG9ydGFjaW9uZXMvcHVibGljL2VtcGxlYWRvIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2lzdGVtYV9pbXBvcnRhY2lvbmVzL3B1YmxpYy9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777441210),
('QPlFdSDpq94Xj9DsLqPwGwhDbdzzlxWJBOBLMROT', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiampDS0U1dWtBMFU4RUR5S0RaenhGSWdLVzZTeGpPcEkwWE1rbm43SiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cDovL2xvY2FsaG9zdC9zaXN0ZW1hX2ltcG9ydGFjaW9uZXMvcHVibGljL2VtcGxlYWRvIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3Qvc2lzdGVtYV9pbXBvcnRhY2lvbmVzL3B1YmxpYy9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1777522914),
('V5RRMn41yRglJKM8XsFiX1WPOKmFH2915hDb1gFG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid0pDb2Zxc2FRWkVuOFdPMVlqSTBPT2ZwY2ZNMDVWTnpOYnpCTUxmTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbXBvcnRhY2lvbi8zNSI7czo1OiJyb3V0ZSI7czoxNjoiaW1wb3J0YWNpb24uc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzc3NTIyNDU2O319', 1777522949);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2026-04-27 20:48:08', '$2y$12$e3Ct33Co1V.tCTIbmums/u26w3FLxsqr11SvABYkLj/n17pA7x9.S', 'djENMXfkKv', '2026-04-27 20:48:08', '2026-04-27 20:48:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) DEFAULT NULL,
  `hash_contrasena` varchar(255) DEFAULT NULL,
  `nombre_completo` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `RFC` varchar(13) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre_usuario`, `hash_contrasena`, `nombre_completo`, `email`, `telefono`, `RFC`, `fecha_creacion`, `activo`, `ultimo_acceso`, `remember_token`) VALUES
(1, 'admin', '$2y$12$oCM0j5GbZUfSLPA80rgLAOCGxLBs24qULGPS6Tph0thL0AVIrnpFO', 'Admin General', 'admin@mail.com', '5551111111', 'RFCADMIN12345', '2026-02-15 18:53:29', 1, '2026-04-30 04:14:17', NULL),
(2, 'oper1', '123', 'Operador Uno', 'oper1@mail.com', '5552222222', 'RFCOPER123456', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29', NULL),
(3, 'oper2', '123', 'Operador Dos', 'oper2@mail.com', '5553333333', 'RFCOPER654321', '2026-02-15 18:53:29', 1, '2026-02-15 18:53:29', NULL),
(4, 'oper3', '123', 'Operador Tres', 'oper3@mail.com', '5556666666', 'RFCOPER333333', '2026-02-15 19:00:46', 1, '2026-02-15 19:00:46', NULL),
(5, 'oper4', '123', 'Operador Cuatro', 'oper4@mail.com', '5557777777', 'RFCOPER444444', '2026-02-15 19:00:46', 1, '2026-02-15 19:00:46', NULL),
(6, 'karen', 'Cambiar123!', 'Karen Ramírez Soto', 'karen.ramirez@imp.mx', '5544112233', 'RAMK850412M11', '2026-04-01 09:15:00', 1, '2026-04-28 17:22:00', NULL),
(7, 'ricardo', 'Cambiar123!', 'Ricardo Mendoza García', 'ricardo.mendoza@imp.mx', '5566778899', 'MEGR780630H22', '2026-04-02 10:00:00', 1, '2026-04-28 12:45:00', NULL),
(8, 'patricia', 'Cambiar123!', 'Patricia Velázquez Núñez', 'patricia.velazquez@imp.mx', '5511223344', 'VENP921105M33', '2026-04-03 11:30:00', 1, '2026-04-27 18:30:00', NULL),
(9, 'fernando', 'Cambiar123!', 'Fernando Torres Aguilar', 'fernando.torres@imp.mx', '5599887766', 'TOAF830728H44', '2026-04-04 08:20:00', 1, '2026-04-28 09:10:00', NULL),
(10, 'lucia', 'Cambiar123!', 'Lucía Hernández Domínguez', 'lucia.hernandez@imp.mx', '5522334455', 'HEDL870219M55', '2026-04-05 14:45:00', 1, '2026-04-26 16:20:00', NULL),
(11, 'miguel', 'Cambiar123!', 'Miguel Castro Reyes', 'miguel.castro@imp.mx', '5533445566', 'CARM900315H66', '2026-04-08 09:00:00', 1, '2026-04-28 11:00:00', NULL),
(12, 'sofia', 'Cambiar123!', 'Sofía Jiménez Ortega', 'sofia.jimenez@imp.mx', '5544556677', 'JIOS940822M77', '2026-04-10 10:30:00', 1, '2026-04-27 14:15:00', NULL),
(13, 'eduardo', 'Cambiar123!', 'Eduardo Salazar Pineda', 'eduardo.salazar@imp.mx', '5555667788', 'SAPE810607H88', '2026-04-12 16:00:00', 1, '2026-04-28 08:45:00', NULL),
(14, 'gabriela', 'Cambiar123!', 'Gabriela Ríos Mendoza', 'gabriela.rios@imp.mx', '5566778800', 'RIMG891114M99', '2026-04-15 11:20:00', 0, NULL, NULL),
(15, 'andres', 'Cambiar123!', 'Andrés Vargas Morales', 'andres.vargas@imp.mx', '5577889911', 'VAMA760903H10', '2026-04-18 13:40:00', 1, '2026-04-28 10:30:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_asignacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario_rol`, `id_usuario`, `id_rol`, `fecha_asignacion`) VALUES
(17, 6, 2, '2026-04-01 09:20:00'),
(18, 7, 2, '2026-04-02 10:05:00'),
(19, 8, 3, '2026-04-03 11:35:00'),
(20, 9, 2, '2026-04-04 08:25:00'),
(21, 9, 3, '2026-04-04 08:30:00'),
(22, 10, 2, '2026-04-05 14:50:00'),
(23, 11, 2, '2026-04-08 09:05:00'),
(24, 12, 3, '2026-04-10 10:35:00'),
(25, 13, 1, '2026-04-12 16:05:00'),
(26, 14, 2, '2026-04-15 11:25:00'),
(27, 15, 2, '2026-04-18 13:45:00'),
(28, 1, 1, '2026-02-15 18:53:29'),
(29, 2, 2, '2026-02-15 18:53:29'),
(30, 3, 2, '2026-02-15 18:53:29'),
(31, 4, 2, '2026-02-15 19:00:46'),
(32, 5, 3, '2026-02-15 19:00:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agente_aduanal`
--
ALTER TABLE `agente_aduanal`
  ADD PRIMARY KEY (`id_agente`);

--
-- Indices de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id_auditoria`),
  ADD KEY `idx_auditoria_usuario` (`id_usuario`),
  ADD KEY `idx_auditoria_fecha` (`fecha_hora`),
  ADD KEY `idx_auditoria_tabla` (`tabla_afectada`);

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
-- Indices de la tabla `costo_importacion`
--
ALTER TABLE `costo_importacion`
  ADD PRIMARY KEY (`id_costo`),
  ADD KEY `idx_costo_importacion` (`id_importacion`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id_documento`),
  ADD KEY `id_importacion` (`id_importacion`),
  ADD KEY `id_usuario_subida` (`id_usuario_subida`),
  ADD KEY `id_usuario_validador` (`id_usuario_validador`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa_extranjera`
--
ALTER TABLE `empresa_extranjera`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `empresa_importadora`
--
ALTER TABLE `empresa_importadora`
  ADD PRIMARY KEY (`id_empresa_mx`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `importacion`
--
ALTER TABLE `importacion`
  ADD PRIMARY KEY (`id_importacion`),
  ADD KEY `id_empresa_mx` (`id_empresa_mx`),
  ADD KEY `id_empresa` (`id_empresa`),
  ADD KEY `id_usuario_creador` (`id_usuario_creador`);

--
-- Indices de la tabla `importacion_agente`
--
ALTER TABLE `importacion_agente`
  ADD PRIMARY KEY (`id_imp_agente`),
  ADD KEY `id_importacion` (`id_importacion`),
  ADD KEY `id_agente` (`id_agente`);

--
-- Indices de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`id_impuesto`),
  ADD KEY `id_item` (`id_item`);

--
-- Indices de la tabla `item_importacion`
--
ALTER TABLE `item_importacion`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_importacion` (`id_importacion`);

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
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `idx_pago_importacion` (`id_importacion`),
  ADD KEY `idx_pago_usuario` (`id_usuario`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `idx_reporte_usuario` (`id_usuario`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id_rol_permiso`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_permiso` (`id_permiso`);

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
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario_rol`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agente_aduanal`
--
ALTER TABLE `agente_aduanal`
  MODIFY `id_agente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id_auditoria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `costo_importacion`
--
ALTER TABLE `costo_importacion`
  MODIFY `id_costo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empresa_extranjera`
--
ALTER TABLE `empresa_extranjera`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `empresa_importadora`
--
ALTER TABLE `empresa_importadora`
  MODIFY `id_empresa_mx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `importacion`
--
ALTER TABLE `importacion`
  MODIFY `id_importacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `importacion_agente`
--
ALTER TABLE `importacion_agente`
  MODIFY `id_imp_agente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `id_impuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `item_importacion`
--
ALTER TABLE `item_importacion`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  MODIFY `id_rol_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `fk_auditoria_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `costo_importacion`
--
ALTER TABLE `costo_importacion`
  ADD CONSTRAINT `fk_costo_importacion` FOREIGN KEY (`id_importacion`) REFERENCES `importacion` (`id_importacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_importacion`) REFERENCES `importacion` (`id_importacion`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_usuario_subida`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `documento_ibfk_3` FOREIGN KEY (`id_usuario_validador`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `importacion`
--
ALTER TABLE `importacion`
  ADD CONSTRAINT `importacion_ibfk_1` FOREIGN KEY (`id_empresa_mx`) REFERENCES `empresa_importadora` (`id_empresa_mx`),
  ADD CONSTRAINT `importacion_ibfk_2` FOREIGN KEY (`id_empresa`) REFERENCES `empresa_extranjera` (`id_empresa`),
  ADD CONSTRAINT `importacion_ibfk_3` FOREIGN KEY (`id_usuario_creador`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `importacion_agente`
--
ALTER TABLE `importacion_agente`
  ADD CONSTRAINT `importacion_agente_ibfk_1` FOREIGN KEY (`id_importacion`) REFERENCES `importacion` (`id_importacion`),
  ADD CONSTRAINT `importacion_agente_ibfk_2` FOREIGN KEY (`id_agente`) REFERENCES `agente_aduanal` (`id_agente`);

--
-- Filtros para la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD CONSTRAINT `impuesto_ibfk_1` FOREIGN KEY (`id_item`) REFERENCES `item_importacion` (`id_item`);

--
-- Filtros para la tabla `item_importacion`
--
ALTER TABLE `item_importacion`
  ADD CONSTRAINT `item_importacion_ibfk_1` FOREIGN KEY (`id_importacion`) REFERENCES `importacion` (`id_importacion`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_importacion` FOREIGN KEY (`id_importacion`) REFERENCES `importacion` (`id_importacion`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pago_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `fk_reporte_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
