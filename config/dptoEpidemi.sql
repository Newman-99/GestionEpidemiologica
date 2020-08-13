-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-08-2020 a las 04:04:45
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dptoEpidemi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `usuarioAlias` varchar(20) NOT NULL,
  `idBitacora` int(11) NOT NULL,
  `bitacoraCodigo` varchar(15) NOT NULL,
  `bitacoraFecha` date NOT NULL,
  `bitacoraHoraInicio` varchar(12) NOT NULL,
  `bitacoraHoraFinal` varchar(12) DEFAULT NULL,
  `bitacoraNivelUsuario` int(1) NOT NULL,
  `bitacoraYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`usuarioAlias`, `idBitacora`, `bitacoraCodigo`, `bitacoraFecha`, `bitacoraHoraInicio`, `bitacoraHoraFinal`, `bitacoraNivelUsuario`, `bitacoraYear`) VALUES
('newman206', 11, 'CB449735041', '2020-07-27', '01:12:02 pm', '01:14:07 pm', 1, 2020),
('newman206', 12, 'CB358134751', '2020-07-27', '01:28:03 pm', '01:28:45 pm', 1, 2020),
('newman206', 13, 'CB137859431', '2020-07-27', '01:43:44 pm', NULL, 1, 2020),
('newman206', 14, 'CB912782951', '2020-07-27', '01:43:44 pm', '01:25:40 pm', 1, 2020),
('newman206', 15, 'CB709469381', '2020-07-30', '09:43:29 am', NULL, 1, 2020),
('newman206', 16, 'CB618991241', '2020-08-05', '10:39:06 am', '10:43:07 am', 1, 2020),
('newman206', 19, 'CB023296871', '2020-08-05', '10:47:43 am', NULL, 1, 2020),
('newman206', 20, 'CB211937011', '2020-08-06', '11:05:26 am', NULL, 1, 2020),
('newman206', 21, 'CB137064001', '2020-08-08', '02:30:26 pm', '03:16:15 pm', 1, 2020),
('calito_22', 22, 'CB982181261', '2020-08-08', '03:16:47 pm', '03:21:38 pm', 2, 2020),
('calito_22', 23, 'CB958073031', '2020-08-08', '03:21:55 pm', '03:26:30 pm', 2, 2020),
('calito_22', 24, 'CB735908831', '2020-08-08', '03:28:16 pm', NULL, 2, 2020),
('calito_22', 25, 'CB948644451', '2020-08-08', '03:28:17 pm', NULL, 2, 2020),
('calito_22', 26, 'CB915972731', '2020-08-08', '03:28:18 pm', NULL, 2, 2020),
('calito_22', 27, 'CB894161641', '2020-08-08', '03:28:19 pm', NULL, 2, 2020),
('calito_22', 28, 'CB078568371', '2020-08-08', '03:30:12 pm', NULL, 2, 2020),
('calito_22', 29, 'CB241443491', '2020-08-08', '03:30:13 pm', NULL, 2, 2020),
('calito_22', 30, 'CB463941011', '2020-08-08', '03:30:31 pm', NULL, 2, 2020),
('calito_22', 31, 'CB069558741', '2020-08-08', '03:30:33 pm', NULL, 2, 2020),
('calito_22', 32, 'CB372764091', '2020-08-08', '03:30:33 pm', NULL, 2, 2020),
('calito_22', 33, 'CB315862961', '2020-08-08', '03:31:43 pm', NULL, 2, 2020),
('calito_22', 34, 'CB337940531', '2020-08-08', '03:31:45 pm', NULL, 2, 2020),
('calito_22', 35, 'CB078026991', '2020-08-08', '03:31:46 pm', NULL, 2, 2020),
('calito_22', 36, 'CB870457541', '2020-08-08', '03:32:28 pm', NULL, 2, 2020),
('calito_22', 37, 'CB285728281', '2020-08-08', '03:32:30 pm', NULL, 2, 2020),
('calito_22', 38, 'CB901737481', '2020-08-08', '03:32:30 pm', NULL, 2, 2020),
('calito_22', 39, 'CB153459361', '2020-08-08', '03:33:34 pm', NULL, 2, 2020),
('calito_22', 40, 'CB899944271', '2020-08-08', '03:33:35 pm', NULL, 2, 2020),
('calito_22', 41, 'CB532979341', '2020-08-08', '03:34:39 pm', NULL, 2, 2020),
('calito_22', 42, 'CB492094831', '2020-08-08', '03:34:40 pm', NULL, 2, 2020),
('calito_22', 43, 'CB484681921', '2020-08-08', '03:35:44 pm', NULL, 2, 2020),
('calito_22', 44, 'CB614558721', '2020-08-08', '03:35:46 pm', NULL, 2, 2020),
('calito_22', 45, 'CB798534621', '2020-08-08', '03:35:46 pm', NULL, 2, 2020),
('calito_22', 46, 'CB826827441', '2020-08-08', '03:35:47 pm', NULL, 2, 2020),
('calito_22', 47, 'CB495412711', '2020-08-08', '03:35:47 pm', NULL, 2, 2020),
('calito_22', 48, 'CB690307501', '2020-08-08', '03:35:47 pm', NULL, 2, 2020),
('calito_22', 49, 'CB427297061', '2020-08-08', '03:35:48 pm', NULL, 2, 2020),
('calito_22', 50, 'CB596283131', '2020-08-08', '03:36:33 pm', NULL, 2, 2020),
('calito_22', 51, 'CB504969041', '2020-08-08', '03:36:35 pm', NULL, 2, 2020),
('calito_22', 52, 'CB430402331', '2020-08-08', '03:36:36 pm', NULL, 2, 2020),
('calito_22', 53, 'CB433164901', '2020-08-08', '03:36:36 pm', NULL, 2, 2020),
('calito_22', 54, 'CB367040031', '2020-08-08', '03:36:43 pm', '03:41:20 pm', 2, 2020),
('calito_22', 55, 'CB836691311', '2020-08-08', '03:41:38 pm', NULL, 2, 2020),
('calito_22', 56, 'CB428175571', '2020-08-08', '03:41:38 pm', NULL, 2, 2020),
('calito_22', 57, 'CB204654381', '2020-08-08', '03:41:40 pm', NULL, 2, 2020),
('calito_22', 58, 'CB543912551', '2020-08-08', '03:42:23 pm', '03:43:05 pm', 2, 2020),
('calito_22', 59, 'CB623267821', '2020-08-08', '03:43:15 pm', '03:53:18 pm', 2, 2020),
('calito_22', 60, 'CB227122041', '2020-08-08', '03:53:29 pm', NULL, 2, 2020);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casosEpidemiologicos`
--

CREATE TABLE `casosEpidemiologicos` (
  `idCasoEpidemiologico` int(11) NOT NULL,
  `docIdentidad` varchar(15) NOT NULL,
  `CATALOG_KEY_CIE10` varchar(5) NOT NULL,
  `idParroquia` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `casosEpidemiologicos`
--

INSERT INTO `casosEpidemiologicos` (`idCasoEpidemiologico`, `docIdentidad`, `CATALOG_KEY_CIE10`, `idParroquia`, `direccion`, `telefono`, `fecha`) VALUES
(5, '20293099', 'A000', 958, 'Caracas', '04132938028', '2020-06-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dataCIE10`
--

CREATE TABLE `dataCIE10` (
  `CONSECUTIVO` varchar(10) DEFAULT NULL,
  `LETRA` varchar(1) DEFAULT NULL,
  `CATALOG_KEY` varchar(5) NOT NULL,
  `NOMBRE` varchar(150) DEFAULT NULL,
  `CODIGOX` varchar(50) DEFAULT NULL,
  `LSEX` varchar(5) DEFAULT NULL,
  `LINF` varchar(5) DEFAULT NULL,
  `LSUP` varchar(5) DEFAULT NULL,
  `TRIVIAL` varchar(5) DEFAULT NULL,
  `ERRADICADO` varchar(5) DEFAULT NULL,
  `N_INTER` varchar(5) DEFAULT NULL,
  `NIN` varchar(5) DEFAULT NULL,
  `NINMTOBS` varchar(50) DEFAULT NULL,
  `COD_SIT_LESION` varchar(50) DEFAULT NULL,
  `NO_CBD` varchar(5) DEFAULT NULL,
  `CBD` varchar(5) DEFAULT NULL,
  `NO_APH` varchar(5) DEFAULT NULL,
  `AF_PRIN` varchar(5) DEFAULT NULL,
  `DIA_SIS` varchar(5) DEFAULT NULL,
  `CLAVE_PROGRAMA_SIS` varchar(5) DEFAULT NULL,
  `COD_COMPLEMEN_MORBI` varchar(5) DEFAULT NULL,
  `DEF_FETAL_CM` varchar(5) DEFAULT NULL,
  `DEF_FETAL_CBD` varchar(5) DEFAULT NULL,
  `CLAVE_CAPITULO` varchar(5) DEFAULT NULL,
  `CAPITULO` varchar(100) DEFAULT NULL,
  `LISTA1` varchar(5) DEFAULT NULL,
  `GRUPO1` varchar(5) DEFAULT NULL,
  `LISTA5` varchar(5) DEFAULT NULL,
  `RUBRICA_TYPE` varchar(50) DEFAULT NULL,
  `YEAR_MODIFI` varchar(30) DEFAULT NULL,
  `YEAR_APLICACION` varchar(5) DEFAULT NULL,
  `VALID` varchar(50) DEFAULT NULL,
  `PRINMORTA` varchar(50) DEFAULT NULL,
  `PRINMORBI` varchar(50) DEFAULT NULL,
  `LM_MORBI` varchar(50) DEFAULT NULL,
  `LM_MORTA` varchar(50) DEFAULT NULL,
  `LGBD165` varchar(50) DEFAULT NULL,
  `LOMSBECK` varchar(50) DEFAULT NULL,
  `LGBD190` varchar(50) DEFAULT NULL,
  `NOTDIARIA` varchar(50) DEFAULT NULL,
  `NOTSEMANAL` varchar(50) DEFAULT NULL,
  `SISTEMA_ESPECIAL` varchar(50) DEFAULT NULL,
  `BIRMM` varchar(50) DEFAULT NULL,
  `CVE_CAUSA_TYPE` varchar(50) DEFAULT NULL,
  `CAUSA_TYPE` varchar(50) DEFAULT NULL,
  `EPI_MORTA` varchar(50) DEFAULT NULL,
  `EDAS_E_IRAS_EN_M5` varchar(50) DEFAULT NULL,
  `CSVE_MATERNAS_SEED_EPID` varchar(50) DEFAULT NULL,
  `EPI_MORTA_M5` varchar(50) DEFAULT NULL,
  `EPI_MORBI` varchar(50) DEFAULT NULL,
  `DEF_MATERNAS` varchar(50) DEFAULT NULL,
  `ES_CAUSES` varchar(50) DEFAULT NULL,
  `NUM_CAUSES` varchar(50) DEFAULT NULL,
  `ES_SUIVE_MORTA` varchar(50) DEFAULT NULL,
  `ES_SUIVE_MORB` varchar(50) DEFAULT NULL,
  `EPI_CLAVE` varchar(50) DEFAULT NULL,
  `EPI_CLAVE_DESC` varchar(50) DEFAULT NULL,
  `ES_SUIVE_NOTIN` varchar(50) DEFAULT NULL,
  `ES_SUIVE_EST_EPI` varchar(50) DEFAULT NULL,
  `ES_SUIVE_EST_BROTE` varchar(50) DEFAULT NULL,
  `SINAC` varchar(50) DEFAULT NULL,
  `PRIN_SINAC` varchar(50) DEFAULT NULL,
  `PRIN_SINAC_GRUPO` varchar(50) DEFAULT NULL,
  `DESCRIPCION_SINAC_GRUPO` varchar(50) DEFAULT NULL,
  `PRIN_SINAC_SUBGRUPO` varchar(50) DEFAULT NULL,
  `DESCRIPCION_SINAC_SUBGRUPO` varchar(50) DEFAULT NULL,
  `DAGA` varchar(50) DEFAULT NULL,
  `ASTERISCO` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 KEY_BLOCK_SIZE=8 ROW_FORMAT=COMPRESSED;

--
-- Volcado de datos para la tabla `dataCIE10`
--

INSERT INTO `dataCIE10` (`CONSECUTIVO`, `LETRA`, `CATALOG_KEY`, `NOMBRE`, `CODIGOX`, `LSEX`, `LINF`, `LSUP`, `TRIVIAL`, `ERRADICADO`, `N_INTER`, `NIN`, `NINMTOBS`, `COD_SIT_LESION`, `NO_CBD`, `CBD`, `NO_APH`, `AF_PRIN`, `DIA_SIS`, `CLAVE_PROGRAMA_SIS`, `COD_COMPLEMEN_MORBI`, `DEF_FETAL_CM`, `DEF_FETAL_CBD`, `CLAVE_CAPITULO`, `CAPITULO`, `LISTA1`, `GRUPO1`, `LISTA5`, `RUBRICA_TYPE`, `YEAR_MODIFI`, `YEAR_APLICACION`, `VALID`, `PRINMORTA`, `PRINMORBI`, `LM_MORBI`, `LM_MORTA`, `LGBD165`, `LOMSBECK`, `LGBD190`, `NOTDIARIA`, `NOTSEMANAL`, `SISTEMA_ESPECIAL`, `BIRMM`, `CVE_CAUSA_TYPE`, `CAUSA_TYPE`, `EPI_MORTA`, `EDAS_E_IRAS_EN_M5`, `CSVE_MATERNAS_SEED_EPID`, `EPI_MORTA_M5`, `EPI_MORBI`, `DEF_MATERNAS`, `ES_CAUSES`, `NUM_CAUSES`, `ES_SUIVE_MORTA`, `ES_SUIVE_MORB`, `EPI_CLAVE`, `EPI_CLAVE_DESC`, `ES_SUIVE_NOTIN`, `ES_SUIVE_EST_EPI`, `ES_SUIVE_EST_BROTE`, `SINAC`, `PRIN_SINAC`, `PRIN_SINAC_GRUPO`, `DESCRIPCION_SINAC_GRUPO`, `PRIN_SINAC_SUBGRUPO`, `DESCRIPCION_SINAC_SUBGRUPO`, `DAGA`, `ASTERISCO`) VALUES
('1', 'A', 'A00', 'CÓLERA', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'SI', 'SI', 'NO', 'NO', 'NA', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '002', '001', '001', 'NO', 'NO', 'NO', 'SI', '001', '001', 'NO', 'NO', 'NO', '1', 'NO', 'SI', 'SI', 'SI', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'NO', 'NO', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'SI', 'SI', 'SI', 'NO', '000', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO'),
('2', 'A', 'A000', 'CÓLERA DEBIDO A VIBRIO CHOLERAE 01, BIOTIPO CHOLERAE', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'SI', 'NO', 'SI', 'SI', '1', 'NO', 'NO', 'NO', '01', 'I     CIERTAS ENFERMEDADES INFECCIOSAS Y PARASITARIAS', '002', '001', '001', 'NO', 'NO', 'NO', 'SI', '001', '001', ' 01A', ' 01A', '10', '1', '10', 'SI', 'SI', 'SI', 'NO', '5', 'CAUSAS ÚTILES PARA MORTALIDAD', 'SI', 'NO', 'NO', 'NO', 'SI', '0', 'NO', 'NO', 'SI', 'SI', '01', 'COLERA', 'SI', 'SI', 'SI', 'NO', '999', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `idGenero` int(1) NOT NULL,
  `descripcionGenero` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`idGenero`, `descripcionGenero`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidades`
--

CREATE TABLE `nacionalidades` (
  `idNacionalidad` int(1) NOT NULL,
  `descripcionNacionalidad` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nacionalidades`
--

INSERT INTO `nacionalidades` (`idNacionalidad`, `descripcionNacionalidad`) VALUES
(1, 'Venezolano/a'),
(2, 'Extrangero/a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id_parroquia` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `parroquia` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`id_parroquia`, `id_municipio`, `parroquia`) VALUES
(1, 1, 'Alto Orinoco'),
(2, 1, 'Huachamacare Acanaña'),
(3, 1, 'Marawaka Toky Shamanaña'),
(4, 1, 'Mavaka Mavaka'),
(5, 1, 'Sierra Parima Parimabé'),
(6, 2, 'Ucata Laja Lisa'),
(7, 2, 'Yapacana Macuruco'),
(8, 2, 'Caname Guarinuma'),
(9, 3, 'Fernando Girón Tovar'),
(10, 3, 'Luis Alberto Gómez'),
(11, 3, 'Pahueña Limón de Parhueña'),
(12, 3, 'Platanillal Platanillal'),
(13, 4, 'Samariapo'),
(14, 4, 'Sipapo'),
(15, 4, 'Munduapo'),
(16, 4, 'Guayapo'),
(17, 5, 'Alto Ventuari'),
(18, 5, 'Medio Ventuari'),
(19, 5, 'Bajo Ventuari'),
(20, 6, 'Victorino'),
(21, 6, 'Comunidad'),
(22, 7, 'Casiquiare'),
(23, 7, 'Cocuy'),
(24, 7, 'San Carlos de Río Negro'),
(25, 7, 'Solano'),
(26, 8, 'Anaco'),
(27, 8, 'San Joaquín'),
(28, 9, 'Cachipo'),
(29, 9, 'Aragua de Barcelona'),
(30, 11, 'Lechería'),
(31, 11, 'El Morro'),
(32, 12, 'Puerto Píritu'),
(33, 12, 'San Miguel'),
(34, 12, 'Sucre'),
(35, 13, 'Valle de Guanape'),
(36, 13, 'Santa Bárbara'),
(37, 14, 'El Chaparro'),
(38, 14, 'Tomás Alfaro'),
(39, 14, 'Calatrava'),
(40, 15, 'Guanta'),
(41, 15, 'Chorrerón'),
(42, 16, 'Mamo'),
(43, 16, 'Soledad'),
(44, 17, 'Mapire'),
(45, 17, 'Piar'),
(46, 17, 'Santa Clara'),
(47, 17, 'San Diego de Cabrutica'),
(48, 17, 'Uverito'),
(49, 17, 'Zuata'),
(50, 18, 'Puerto La Cruz'),
(51, 18, 'Pozuelos'),
(52, 19, 'Onoto'),
(53, 19, 'San Pablo'),
(54, 20, 'San Mateo'),
(55, 20, 'El Carito'),
(56, 20, 'Santa Inés'),
(57, 20, 'La Romereña'),
(58, 21, 'Atapirire'),
(59, 21, 'Boca del Pao'),
(60, 21, 'El Pao'),
(61, 21, 'Pariaguán'),
(62, 22, 'Cantaura'),
(63, 22, 'Libertador'),
(64, 22, 'Santa Rosa'),
(65, 22, 'Urica'),
(66, 23, 'Píritu'),
(67, 23, 'San Francisco'),
(68, 24, 'San José de Guanipa'),
(69, 25, 'Boca de Uchire'),
(70, 25, 'Boca de Chávez'),
(71, 26, 'Pueblo Nuevo'),
(72, 26, 'Santa Ana'),
(73, 27, 'Bergantín'),
(74, 27, 'Caigua'),
(75, 27, 'El Carmen'),
(76, 27, 'El Pilar'),
(77, 27, 'Naricual'),
(78, 27, 'San Crsitóbal'),
(79, 28, 'Edmundo Barrios'),
(80, 28, 'Miguel Otero Silva'),
(81, 29, 'Achaguas'),
(82, 29, 'Apurito'),
(83, 29, 'El Yagual'),
(84, 29, 'Guachara'),
(85, 29, 'Mucuritas'),
(86, 29, 'Queseras del medio'),
(87, 30, 'Biruaca'),
(88, 31, 'Bruzual'),
(89, 31, 'Mantecal'),
(90, 31, 'Quintero'),
(91, 31, 'Rincón Hondo'),
(92, 31, 'San Vicente'),
(93, 32, 'Guasdualito'),
(94, 32, 'Aramendi'),
(95, 32, 'El Amparo'),
(96, 32, 'San Camilo'),
(97, 32, 'Urdaneta'),
(98, 33, 'San Juan de Payara'),
(99, 33, 'Codazzi'),
(100, 33, 'Cunaviche'),
(101, 34, 'Elorza'),
(102, 34, 'La Trinidad'),
(103, 35, 'San Fernando'),
(104, 35, 'El Recreo'),
(105, 35, 'Peñalver'),
(106, 35, 'San Rafael de Atamaica'),
(107, 36, 'Pedro José Ovalles'),
(108, 36, 'Joaquín Crespo'),
(109, 36, 'José Casanova Godoy'),
(110, 36, 'Madre María de San José'),
(111, 36, 'Andrés Eloy Blanco'),
(112, 36, 'Los Tacarigua'),
(113, 36, 'Las Delicias'),
(114, 36, 'Choroní'),
(115, 37, 'Bolívar'),
(116, 38, 'Camatagua'),
(117, 38, 'Carmen de Cura'),
(118, 39, 'Santa Rita'),
(119, 39, 'Francisco de Miranda'),
(120, 39, 'Moseñor Feliciano González'),
(121, 40, 'Santa Cruz'),
(122, 41, 'José Félix Ribas'),
(123, 41, 'Castor Nieves Ríos'),
(124, 41, 'Las Guacamayas'),
(125, 41, 'Pao de Zárate'),
(126, 41, 'Zuata'),
(127, 42, 'José Rafael Revenga'),
(128, 43, 'Palo Negro'),
(129, 43, 'San Martín de Porres'),
(130, 44, 'El Limón'),
(131, 44, 'Caña de Azúcar'),
(132, 45, 'Ocumare de la Costa'),
(133, 46, 'San Casimiro'),
(134, 46, 'Güiripa'),
(135, 46, 'Ollas de Caramacate'),
(136, 46, 'Valle Morín'),
(137, 47, 'San Sebastían'),
(138, 48, 'Turmero'),
(139, 48, 'Arevalo Aponte'),
(140, 48, 'Chuao'),
(141, 48, 'Samán de Güere'),
(142, 48, 'Alfredo Pacheco Miranda'),
(143, 49, 'Santos Michelena'),
(144, 49, 'Tiara'),
(145, 50, 'Cagua'),
(146, 50, 'Bella Vista'),
(147, 51, 'Tovar'),
(148, 52, 'Urdaneta'),
(149, 52, 'Las Peñitas'),
(150, 52, 'San Francisco de Cara'),
(151, 52, 'Taguay'),
(152, 53, 'Zamora'),
(153, 53, 'Magdaleno'),
(154, 53, 'San Francisco de Asís'),
(155, 53, 'Valles de Tucutunemo'),
(156, 53, 'Augusto Mijares'),
(157, 54, 'Sabaneta'),
(158, 54, 'Juan Antonio Rodríguez Domínguez'),
(159, 55, 'El Cantón'),
(160, 55, 'Santa Cruz de Guacas'),
(161, 55, 'Puerto Vivas'),
(162, 56, 'Ticoporo'),
(163, 56, 'Nicolás Pulido'),
(164, 56, 'Andrés Bello'),
(165, 57, 'Arismendi'),
(166, 57, 'Guadarrama'),
(167, 57, 'La Unión'),
(168, 57, 'San Antonio'),
(169, 58, 'Barinas'),
(170, 58, 'Alberto Arvelo Larriva'),
(171, 58, 'San Silvestre'),
(172, 58, 'Santa Inés'),
(173, 58, 'Santa Lucía'),
(174, 58, 'Torumos'),
(175, 58, 'El Carmen'),
(176, 58, 'Rómulo Betancourt'),
(177, 58, 'Corazón de Jesús'),
(178, 58, 'Ramón Ignacio Méndez'),
(179, 58, 'Alto Barinas'),
(180, 58, 'Manuel Palacio Fajardo'),
(181, 58, 'Juan Antonio Rodríguez Domínguez'),
(182, 58, 'Dominga Ortiz de Páez'),
(183, 59, 'Barinitas'),
(184, 59, 'Altamira de Cáceres'),
(185, 59, 'Calderas'),
(186, 60, 'Barrancas'),
(187, 60, 'El Socorro'),
(188, 60, 'Mazparrito'),
(189, 61, 'Santa Bárbara'),
(190, 61, 'Pedro Briceño Méndez'),
(191, 61, 'Ramón Ignacio Méndez'),
(192, 61, 'José Ignacio del Pumar'),
(193, 62, 'Obispos'),
(194, 62, 'Guasimitos'),
(195, 62, 'El Real'),
(196, 62, 'La Luz'),
(197, 63, 'Ciudad Bolívia'),
(198, 63, 'José Ignacio Briceño'),
(199, 63, 'José Félix Ribas'),
(200, 63, 'Páez'),
(201, 64, 'Libertad'),
(202, 64, 'Dolores'),
(203, 64, 'Santa Rosa'),
(204, 64, 'Palacio Fajardo'),
(205, 65, 'Ciudad de Nutrias'),
(206, 65, 'El Regalo'),
(207, 65, 'Puerto Nutrias'),
(208, 65, 'Santa Catalina'),
(209, 66, 'Cachamay'),
(210, 66, 'Chirica'),
(211, 66, 'Dalla Costa'),
(212, 66, 'Once de Abril'),
(213, 66, 'Simón Bolívar'),
(214, 66, 'Unare'),
(215, 66, 'Universidad'),
(216, 66, 'Vista al Sol'),
(217, 66, 'Pozo Verde'),
(218, 66, 'Yocoima'),
(219, 66, '5 de Julio'),
(220, 67, 'Cedeño'),
(221, 67, 'Altagracia'),
(222, 67, 'Ascensión Farreras'),
(223, 67, 'Guaniamo'),
(224, 67, 'La Urbana'),
(225, 67, 'Pijiguaos'),
(226, 68, 'El Callao'),
(227, 69, 'Gran Sabana'),
(228, 69, 'Ikabarú'),
(229, 70, 'Catedral'),
(230, 70, 'Zea'),
(231, 70, 'Orinoco'),
(232, 70, 'José Antonio Páez'),
(233, 70, 'Marhuanta'),
(234, 70, 'Agua Salada'),
(235, 70, 'Vista Hermosa'),
(236, 70, 'La Sabanita'),
(237, 70, 'Panapana'),
(238, 71, 'Andrés Eloy Blanco'),
(239, 71, 'Pedro Cova'),
(240, 72, 'Raúl Leoni'),
(241, 72, 'Barceloneta'),
(242, 72, 'Santa Bárbara'),
(243, 72, 'San Francisco'),
(244, 73, 'Roscio'),
(245, 73, 'Salóm'),
(246, 74, 'Sifontes'),
(247, 74, 'Dalla Costa'),
(248, 74, 'San Isidro'),
(249, 75, 'Sucre'),
(250, 75, 'Aripao'),
(251, 75, 'Guarataro'),
(252, 75, 'Las Majadas'),
(253, 75, 'Moitaco'),
(254, 76, 'Padre Pedro Chien'),
(255, 76, 'Río Grande'),
(256, 77, 'Bejuma'),
(257, 77, 'Canoabo'),
(258, 77, 'Simón Bolívar'),
(259, 78, 'Güigüe'),
(260, 78, 'Carabobo'),
(261, 78, 'Tacarigua'),
(262, 79, 'Mariara'),
(263, 79, 'Aguas Calientes'),
(264, 80, 'Ciudad Alianza'),
(265, 80, 'Guacara'),
(266, 80, 'Yagua'),
(267, 81, 'Morón'),
(268, 81, 'Yagua'),
(269, 82, 'Tocuyito'),
(270, 82, 'Independencia'),
(271, 83, 'Los Guayos'),
(272, 84, 'Miranda'),
(273, 85, 'Montalbán'),
(274, 86, 'Naguanagua'),
(275, 87, 'Bartolomé Salóm'),
(276, 87, 'Democracia'),
(277, 87, 'Fraternidad'),
(278, 87, 'Goaigoaza'),
(279, 87, 'Juan José Flores'),
(280, 87, 'Unión'),
(281, 87, 'Borburata'),
(282, 87, 'Patanemo'),
(283, 88, 'San Diego'),
(284, 89, 'San Joaquín'),
(285, 90, 'Candelaria'),
(286, 90, 'Catedral'),
(287, 90, 'El Socorro'),
(288, 90, 'Miguel Peña'),
(289, 90, 'Rafael Urdaneta'),
(290, 90, 'San Blas'),
(291, 90, 'San José'),
(292, 90, 'Santa Rosa'),
(293, 90, 'Negro Primero'),
(294, 91, 'Cojedes'),
(295, 91, 'Juan de Mata Suárez'),
(296, 92, 'Tinaquillo'),
(297, 93, 'El Baúl'),
(298, 93, 'Sucre'),
(299, 94, 'La Aguadita'),
(300, 94, 'Macapo'),
(301, 95, 'El Pao'),
(302, 96, 'El Amparo'),
(303, 96, 'Libertad de Cojedes'),
(304, 97, 'Rómulo Gallegos'),
(305, 98, 'San Carlos de Austria'),
(306, 98, 'Juan Ángel Bravo'),
(307, 98, 'Manuel Manrique'),
(308, 99, 'General en Jefe José Laurencio Silva'),
(309, 100, 'Curiapo'),
(310, 100, 'Almirante Luis Brión'),
(311, 100, 'Francisco Aniceto Lugo'),
(312, 100, 'Manuel Renaud'),
(313, 100, 'Padre Barral'),
(314, 100, 'Santos de Abelgas'),
(315, 101, 'Imataca'),
(316, 101, 'Cinco de Julio'),
(317, 101, 'Juan Bautista Arismendi'),
(318, 101, 'Manuel Piar'),
(319, 101, 'Rómulo Gallegos'),
(320, 102, 'Pedernales'),
(321, 102, 'Luis Beltrán Prieto Figueroa'),
(322, 103, 'San José (Delta Amacuro)'),
(323, 103, 'José Vidal Marcano'),
(324, 103, 'Juan Millán'),
(325, 103, 'Leonardo Ruíz Pineda'),
(326, 103, 'Mariscal Antonio José de Sucre'),
(327, 103, 'Monseñor Argimiro García'),
(328, 103, 'San Rafael (Delta Amacuro)'),
(329, 103, 'Virgen del Valle'),
(330, 10, 'Clarines'),
(331, 10, 'Guanape'),
(332, 10, 'Sabana de Uchire'),
(333, 104, 'Capadare'),
(334, 104, 'La Pastora'),
(335, 104, 'Libertador'),
(336, 104, 'San Juan de los Cayos'),
(337, 105, 'Aracua'),
(338, 105, 'La Peña'),
(339, 105, 'San Luis'),
(340, 106, 'Bariro'),
(341, 106, 'Borojó'),
(342, 106, 'Capatárida'),
(343, 106, 'Guajiro'),
(344, 106, 'Seque'),
(345, 106, 'Zazárida'),
(346, 106, 'Valle de Eroa'),
(347, 107, 'Cacique Manaure'),
(348, 108, 'Norte'),
(349, 108, 'Carirubana'),
(350, 108, 'Santa Ana'),
(351, 108, 'Urbana Punta Cardón'),
(352, 109, 'La Vela de Coro'),
(353, 109, 'Acurigua'),
(354, 109, 'Guaibacoa'),
(355, 109, 'Las Calderas'),
(356, 109, 'Macoruca'),
(357, 110, 'Dabajuro'),
(358, 111, 'Agua Clara'),
(359, 111, 'Avaria'),
(360, 111, 'Pedregal'),
(361, 111, 'Piedra Grande'),
(362, 111, 'Purureche'),
(363, 112, 'Adaure'),
(364, 112, 'Adícora'),
(365, 112, 'Baraived'),
(366, 112, 'Buena Vista'),
(367, 112, 'Jadacaquiva'),
(368, 112, 'El Vínculo'),
(369, 112, 'El Hato'),
(370, 112, 'Moruy'),
(371, 112, 'Pueblo Nuevo'),
(372, 113, 'Agua Larga'),
(373, 113, 'El Paují'),
(374, 113, 'Independencia'),
(375, 113, 'Mapararí'),
(376, 114, 'Agua Linda'),
(377, 114, 'Araurima'),
(378, 114, 'Jacura'),
(379, 115, 'Tucacas'),
(380, 115, 'Boca de Aroa'),
(381, 116, 'Los Taques'),
(382, 116, 'Judibana'),
(383, 117, 'Mene de Mauroa'),
(384, 117, 'San Félix'),
(385, 117, 'Casigua'),
(386, 118, 'Guzmán Guillermo'),
(387, 118, 'Mitare'),
(388, 118, 'Río Seco'),
(389, 118, 'Sabaneta'),
(390, 118, 'San Antonio'),
(391, 118, 'San Gabriel'),
(392, 118, 'Santa Ana'),
(393, 119, 'Boca del Tocuyo'),
(394, 119, 'Chichiriviche'),
(395, 119, 'Tocuyo de la Costa'),
(396, 120, 'Palmasola'),
(397, 121, 'Cabure'),
(398, 121, 'Colina'),
(399, 121, 'Curimagua'),
(400, 122, 'San José de la Costa'),
(401, 122, 'Píritu'),
(402, 123, 'San Francisco'),
(403, 124, 'Sucre'),
(404, 124, 'Pecaya'),
(405, 125, 'Tocópero'),
(406, 126, 'El Charal'),
(407, 126, 'Las Vegas del Tuy'),
(408, 126, 'Santa Cruz de Bucaral'),
(409, 127, 'Bruzual'),
(410, 127, 'Urumaco'),
(411, 128, 'Puerto Cumarebo'),
(412, 128, 'La Ciénaga'),
(413, 128, 'La Soledad'),
(414, 128, 'Pueblo Cumarebo'),
(415, 128, 'Zazárida'),
(416, 113, 'Churuguara'),
(417, 129, 'Camaguán'),
(418, 129, 'Puerto Miranda'),
(419, 129, 'Uverito'),
(420, 130, 'Chaguaramas'),
(421, 131, 'El Socorro'),
(422, 132, 'Tucupido'),
(423, 132, 'San Rafael de Laya'),
(424, 133, 'Altagracia de Orituco'),
(425, 133, 'San Rafael de Orituco'),
(426, 133, 'San Francisco Javier de Lezama'),
(427, 133, 'Paso Real de Macaira'),
(428, 133, 'Carlos Soublette'),
(429, 133, 'San Francisco de Macaira'),
(430, 133, 'Libertad de Orituco'),
(431, 134, 'Cantaclaro'),
(432, 134, 'San Juan de los Morros'),
(433, 134, 'Parapara'),
(434, 135, 'El Sombrero'),
(435, 135, 'Sosa'),
(436, 136, 'Las Mercedes'),
(437, 136, 'Cabruta'),
(438, 136, 'Santa Rita de Manapire'),
(439, 137, 'Valle de la Pascua'),
(440, 137, 'Espino'),
(441, 138, 'San José de Unare'),
(442, 138, 'Zaraza'),
(443, 139, 'San José de Tiznados'),
(444, 139, 'San Francisco de Tiznados'),
(445, 139, 'San Lorenzo de Tiznados'),
(446, 139, 'Ortiz'),
(447, 140, 'Guayabal'),
(448, 140, 'Cazorla'),
(449, 141, 'San José de Guaribe'),
(450, 141, 'Uveral'),
(451, 142, 'Santa María de Ipire'),
(452, 142, 'Altamira'),
(453, 143, 'El Calvario'),
(454, 143, 'El Rastro'),
(455, 143, 'Guardatinajas'),
(456, 143, 'Capital Urbana Calabozo'),
(457, 144, 'Quebrada Honda de Guache'),
(458, 144, 'Pío Tamayo'),
(459, 144, 'Yacambú'),
(460, 145, 'Fréitez'),
(461, 145, 'José María Blanco'),
(462, 146, 'Catedral'),
(463, 146, 'Concepción'),
(464, 146, 'El Cují'),
(465, 146, 'Juan de Villegas'),
(466, 146, 'Santa Rosa'),
(467, 146, 'Tamaca'),
(468, 146, 'Unión'),
(469, 146, 'Aguedo Felipe Alvarado'),
(470, 146, 'Buena Vista'),
(471, 146, 'Juárez'),
(472, 147, 'Juan Bautista Rodríguez'),
(473, 147, 'Cuara'),
(474, 147, 'Diego de Lozada'),
(475, 147, 'Paraíso de San José'),
(476, 147, 'San Miguel'),
(477, 147, 'Tintorero'),
(478, 147, 'José Bernardo Dorante'),
(479, 147, 'Coronel Mariano Peraza '),
(480, 148, 'Bolívar'),
(481, 148, 'Anzoátegui'),
(482, 148, 'Guarico'),
(483, 148, 'Hilario Luna y Luna'),
(484, 148, 'Humocaro Alto'),
(485, 148, 'Humocaro Bajo'),
(486, 148, 'La Candelaria'),
(487, 148, 'Morán'),
(488, 149, 'Cabudare'),
(489, 149, 'José Gregorio Bastidas'),
(490, 149, 'Agua Viva'),
(491, 150, 'Sarare'),
(492, 150, 'Buría'),
(493, 150, 'Gustavo Vegas León'),
(494, 151, 'Trinidad Samuel'),
(495, 151, 'Antonio Díaz'),
(496, 151, 'Camacaro'),
(497, 151, 'Castañeda'),
(498, 151, 'Cecilio Zubillaga'),
(499, 151, 'Chiquinquirá'),
(500, 151, 'El Blanco'),
(501, 151, 'Espinoza de los Monteros'),
(502, 151, 'Lara'),
(503, 151, 'Las Mercedes'),
(504, 151, 'Manuel Morillo'),
(505, 151, 'Montaña Verde'),
(506, 151, 'Montes de Oca'),
(507, 151, 'Torres'),
(508, 151, 'Heriberto Arroyo'),
(509, 151, 'Reyes Vargas'),
(510, 151, 'Altagracia'),
(511, 152, 'Siquisique'),
(512, 152, 'Moroturo'),
(513, 152, 'San Miguel'),
(514, 152, 'Xaguas'),
(515, 179, 'Presidente Betancourt'),
(516, 179, 'Presidente Páez'),
(517, 179, 'Presidente Rómulo Gallegos'),
(518, 179, 'Gabriel Picón González'),
(519, 179, 'Héctor Amable Mora'),
(520, 179, 'José Nucete Sardi'),
(521, 179, 'Pulido Méndez'),
(522, 180, 'La Azulita'),
(523, 181, 'Santa Cruz de Mora'),
(524, 181, 'Mesa Bolívar'),
(525, 181, 'Mesa de Las Palmas'),
(526, 182, 'Aricagua'),
(527, 182, 'San Antonio'),
(528, 183, 'Canagua'),
(529, 183, 'Capurí'),
(530, 183, 'Chacantá'),
(531, 183, 'El Molino'),
(532, 183, 'Guaimaral'),
(533, 183, 'Mucutuy'),
(534, 183, 'Mucuchachí'),
(535, 184, 'Fernández Peña'),
(536, 184, 'Matriz'),
(537, 184, 'Montalbán'),
(538, 184, 'Acequias'),
(539, 184, 'Jají'),
(540, 184, 'La Mesa'),
(541, 184, 'San José del Sur'),
(542, 185, 'Tucaní'),
(543, 185, 'Florencio Ramírez'),
(544, 186, 'Santo Domingo'),
(545, 186, 'Las Piedras'),
(546, 187, 'Guaraque'),
(547, 187, 'Mesa de Quintero'),
(548, 187, 'Río Negro'),
(549, 188, 'Arapuey'),
(550, 188, 'Palmira'),
(551, 189, 'San Cristóbal de Torondoy'),
(552, 189, 'Torondoy'),
(553, 190, 'Antonio Spinetti Dini'),
(554, 190, 'Arias'),
(555, 190, 'Caracciolo Parra Pérez'),
(556, 190, 'Domingo Peña'),
(557, 190, 'El Llano'),
(558, 190, 'Gonzalo Picón Febres'),
(559, 190, 'Jacinto Plaza'),
(560, 190, 'Juan Rodríguez Suárez'),
(561, 190, 'Lasso de la Vega'),
(562, 190, 'Mariano Picón Salas'),
(563, 190, 'Milla'),
(564, 190, 'Osuna Rodríguez'),
(565, 190, 'Sagrario'),
(566, 190, 'El Morro'),
(567, 190, 'Los Nevados'),
(568, 191, 'Andrés Eloy Blanco'),
(569, 191, 'La Venta'),
(570, 191, 'Piñango'),
(571, 191, 'Timotes'),
(572, 192, 'Eloy Paredes'),
(573, 192, 'San Rafael de Alcázar'),
(574, 192, 'Santa Elena de Arenales'),
(575, 193, 'Santa María de Caparo'),
(576, 194, 'Pueblo Llano'),
(577, 195, 'Cacute'),
(578, 195, 'La Toma'),
(579, 195, 'Mucuchíes'),
(580, 195, 'Mucurubá'),
(581, 195, 'San Rafael'),
(582, 196, 'Gerónimo Maldonado'),
(583, 196, 'Bailadores'),
(584, 197, 'Tabay'),
(585, 198, 'Chiguará'),
(586, 198, 'Estánquez'),
(587, 198, 'Lagunillas'),
(588, 198, 'La Trampa'),
(589, 198, 'Pueblo Nuevo del Sur'),
(590, 198, 'San Juan'),
(591, 199, 'El Amparo'),
(592, 199, 'El Llano'),
(593, 199, 'San Francisco'),
(594, 199, 'Tovar'),
(595, 200, 'Independencia'),
(596, 200, 'María de la Concepción Palacios Blanco'),
(597, 200, 'Nueva Bolivia'),
(598, 200, 'Santa Apolonia'),
(599, 201, 'Caño El Tigre'),
(600, 201, 'Zea'),
(601, 223, 'Aragüita'),
(602, 223, 'Arévalo González'),
(603, 223, 'Capaya'),
(604, 223, 'Caucagua'),
(605, 223, 'Panaquire'),
(606, 223, 'Ribas'),
(607, 223, 'El Café'),
(608, 223, 'Marizapa'),
(609, 224, 'Cumbo'),
(610, 224, 'San José de Barlovento'),
(611, 225, 'El Cafetal'),
(612, 225, 'Las Minas'),
(613, 225, 'Nuestra Señora del Rosario'),
(614, 226, 'Higuerote'),
(615, 226, 'Curiepe'),
(616, 226, 'Tacarigua de Brión'),
(617, 227, 'Mamporal'),
(618, 228, 'Carrizal'),
(619, 229, 'Chacao'),
(620, 230, 'Charallave'),
(621, 230, 'Las Brisas'),
(622, 231, 'El Hatillo'),
(623, 232, 'Altagracia de la Montaña'),
(624, 232, 'Cecilio Acosta'),
(625, 232, 'Los Teques'),
(626, 232, 'El Jarillo'),
(627, 232, 'San Pedro'),
(628, 232, 'Tácata'),
(629, 232, 'Paracotos'),
(630, 233, 'Cartanal'),
(631, 233, 'Santa Teresa del Tuy'),
(632, 234, 'La Democracia'),
(633, 234, 'Ocumare del Tuy'),
(634, 234, 'Santa Bárbara'),
(635, 235, 'San Antonio de los Altos'),
(636, 236, 'Río Chico'),
(637, 236, 'El Guapo'),
(638, 236, 'Tacarigua de la Laguna'),
(639, 236, 'Paparo'),
(640, 236, 'San Fernando del Guapo'),
(641, 237, 'Santa Lucía del Tuy'),
(642, 238, 'Cúpira'),
(643, 238, 'Machurucuto'),
(644, 239, 'Guarenas'),
(645, 240, 'San Antonio de Yare'),
(646, 240, 'San Francisco de Yare'),
(647, 241, 'Leoncio Martínez'),
(648, 241, 'Petare'),
(649, 241, 'Caucagüita'),
(650, 241, 'Filas de Mariche'),
(651, 241, 'La Dolorita'),
(652, 242, 'Cúa'),
(653, 242, 'Nueva Cúa'),
(654, 243, 'Guatire'),
(655, 243, 'Bolívar'),
(656, 258, 'San Antonio de Maturín'),
(657, 258, 'San Francisco de Maturín'),
(658, 259, 'Aguasay'),
(659, 260, 'Caripito'),
(660, 261, 'El Guácharo'),
(661, 261, 'La Guanota'),
(662, 261, 'Sabana de Piedra'),
(663, 261, 'San Agustín'),
(664, 261, 'Teresen'),
(665, 261, 'Caripe'),
(666, 262, 'Areo'),
(667, 262, 'Capital Cedeño'),
(668, 262, 'San Félix de Cantalicio'),
(669, 262, 'Viento Fresco'),
(670, 263, 'El Tejero'),
(671, 263, 'Punta de Mata'),
(672, 264, 'Chaguaramas'),
(673, 264, 'Las Alhuacas'),
(674, 264, 'Tabasca'),
(675, 264, 'Temblador'),
(676, 265, 'Alto de los Godos'),
(677, 265, 'Boquerón'),
(678, 265, 'Las Cocuizas'),
(679, 265, 'La Cruz'),
(680, 265, 'San Simón'),
(681, 265, 'El Corozo'),
(682, 265, 'El Furrial'),
(683, 265, 'Jusepín'),
(684, 265, 'La Pica'),
(685, 265, 'San Vicente'),
(686, 266, 'Aparicio'),
(687, 266, 'Aragua de Maturín'),
(688, 266, 'Chaguamal'),
(689, 266, 'El Pinto'),
(690, 266, 'Guanaguana'),
(691, 266, 'La Toscana'),
(692, 266, 'Taguaya'),
(693, 267, 'Cachipo'),
(694, 267, 'Quiriquire'),
(695, 268, 'Santa Bárbara'),
(696, 269, 'Barrancas'),
(697, 269, 'Los Barrancos de Fajardo'),
(698, 270, 'Uracoa'),
(699, 271, 'Antolín del Campo'),
(700, 272, 'Arismendi'),
(701, 273, 'García'),
(702, 273, 'Francisco Fajardo'),
(703, 274, 'Bolívar'),
(704, 274, 'Guevara'),
(705, 274, 'Matasiete'),
(706, 274, 'Santa Ana'),
(707, 274, 'Sucre'),
(708, 275, 'Aguirre'),
(709, 275, 'Maneiro'),
(710, 276, 'Adrián'),
(711, 276, 'Juan Griego'),
(712, 276, 'Yaguaraparo'),
(713, 277, 'Porlamar'),
(714, 278, 'San Francisco de Macanao'),
(715, 278, 'Boca de Río'),
(716, 279, 'Tubores'),
(717, 279, 'Los Baleales'),
(718, 280, 'Vicente Fuentes'),
(719, 280, 'Villalba'),
(720, 281, 'San Juan Bautista'),
(721, 281, 'Zabala'),
(722, 283, 'Capital Araure'),
(723, 283, 'Río Acarigua'),
(724, 284, 'Capital Esteller'),
(725, 284, 'Uveral'),
(726, 285, 'Guanare'),
(727, 285, 'Córdoba'),
(728, 285, 'San José de la Montaña'),
(729, 285, 'San Juan de Guanaguanare'),
(730, 285, 'Virgen de la Coromoto'),
(731, 286, 'Guanarito'),
(732, 286, 'Trinidad de la Capilla'),
(733, 286, 'Divina Pastora'),
(734, 287, 'Monseñor José Vicente de Unda'),
(735, 287, 'Peña Blanca'),
(736, 288, 'Capital Ospino'),
(737, 288, 'Aparición'),
(738, 288, 'La Estación'),
(739, 289, 'Páez'),
(740, 289, 'Payara'),
(741, 289, 'Pimpinela'),
(742, 289, 'Ramón Peraza'),
(743, 290, 'Papelón'),
(744, 290, 'Caño Delgadito'),
(745, 291, 'San Genaro de Boconoito'),
(746, 291, 'Antolín Tovar'),
(747, 292, 'San Rafael de Onoto'),
(748, 292, 'Santa Fe'),
(749, 292, 'Thermo Morles'),
(750, 293, 'Santa Rosalía'),
(751, 293, 'Florida'),
(752, 294, 'Sucre'),
(753, 294, 'Concepción'),
(754, 294, 'San Rafael de Palo Alzado'),
(755, 294, 'Uvencio Antonio Velásquez'),
(756, 294, 'San José de Saguaz'),
(757, 294, 'Villa Rosa'),
(758, 295, 'Turén'),
(759, 295, 'Canelones'),
(760, 295, 'Santa Cruz'),
(761, 295, 'San Isidro Labrador'),
(762, 296, 'Mariño'),
(763, 296, 'Rómulo Gallegos'),
(764, 297, 'San José de Aerocuar'),
(765, 297, 'Tavera Acosta'),
(766, 298, 'Río Caribe'),
(767, 298, 'Antonio José de Sucre'),
(768, 298, 'El Morro de Puerto Santo'),
(769, 298, 'Puerto Santo'),
(770, 298, 'San Juan de las Galdonas'),
(771, 299, 'El Pilar'),
(772, 299, 'El Rincón'),
(773, 299, 'General Francisco Antonio Váquez'),
(774, 299, 'Guaraúnos'),
(775, 299, 'Tunapuicito'),
(776, 299, 'Unión'),
(777, 300, 'Santa Catalina'),
(778, 300, 'Santa Rosa'),
(779, 300, 'Santa Teresa'),
(780, 300, 'Bolívar'),
(781, 300, 'Maracapana'),
(782, 302, 'Libertad'),
(783, 302, 'El Paujil'),
(784, 302, 'Yaguaraparo'),
(785, 303, 'Cruz Salmerón Acosta'),
(786, 303, 'Chacopata'),
(787, 303, 'Manicuare'),
(788, 304, 'Tunapuy'),
(789, 304, 'Campo Elías'),
(790, 305, 'Irapa'),
(791, 305, 'Campo Claro'),
(792, 305, 'Maraval'),
(793, 305, 'San Antonio de Irapa'),
(794, 305, 'Soro'),
(795, 306, 'Mejía'),
(796, 307, 'Cumanacoa'),
(797, 307, 'Arenas'),
(798, 307, 'Aricagua'),
(799, 307, 'Cogollar'),
(800, 307, 'San Fernando'),
(801, 307, 'San Lorenzo'),
(802, 308, 'Villa Frontado (Muelle de Cariaco)'),
(803, 308, 'Catuaro'),
(804, 308, 'Rendón'),
(805, 308, 'San Cruz'),
(806, 308, 'Santa María'),
(807, 309, 'Altagracia'),
(808, 309, 'Santa Inés'),
(809, 309, 'Valentín Valiente'),
(810, 309, 'Ayacucho'),
(811, 309, 'San Juan'),
(812, 309, 'Raúl Leoni'),
(813, 309, 'Gran Mariscal'),
(814, 310, 'Cristóbal Colón'),
(815, 310, 'Bideau'),
(816, 310, 'Punta de Piedras'),
(817, 310, 'Güiria'),
(818, 341, 'Andrés Bello'),
(819, 342, 'Antonio Rómulo Costa'),
(820, 343, 'Ayacucho'),
(821, 343, 'Rivas Berti'),
(822, 343, 'San Pedro del Río'),
(823, 344, 'Bolívar'),
(824, 344, 'Palotal'),
(825, 344, 'General Juan Vicente Gómez'),
(826, 344, 'Isaías Medina Angarita'),
(827, 345, 'Cárdenas'),
(828, 345, 'Amenodoro Ángel Lamus'),
(829, 345, 'La Florida'),
(830, 346, 'Córdoba'),
(831, 347, 'Fernández Feo'),
(832, 347, 'Alberto Adriani'),
(833, 347, 'Santo Domingo'),
(834, 348, 'Francisco de Miranda'),
(835, 349, 'García de Hevia'),
(836, 349, 'Boca de Grita'),
(837, 349, 'José Antonio Páez'),
(838, 350, 'Guásimos'),
(839, 351, 'Independencia'),
(840, 351, 'Juan Germán Roscio'),
(841, 351, 'Román Cárdenas'),
(842, 352, 'Jáuregui'),
(843, 352, 'Emilio Constantino Guerrero'),
(844, 352, 'Monseñor Miguel Antonio Salas'),
(845, 353, 'José María Vargas'),
(846, 354, 'Junín'),
(847, 354, 'La Petrólea'),
(848, 354, 'Quinimarí'),
(849, 354, 'Bramón'),
(850, 355, 'Libertad'),
(851, 355, 'Cipriano Castro'),
(852, 355, 'Manuel Felipe Rugeles'),
(853, 356, 'Libertador'),
(854, 356, 'Doradas'),
(855, 356, 'Emeterio Ochoa'),
(856, 356, 'San Joaquín de Navay'),
(857, 357, 'Lobatera'),
(858, 357, 'Constitución'),
(859, 358, 'Michelena'),
(860, 359, 'Panamericano'),
(861, 359, 'La Palmita'),
(862, 360, 'Pedro María Ureña'),
(863, 360, 'Nueva Arcadia'),
(864, 361, 'Delicias'),
(865, 361, 'Pecaya'),
(866, 362, 'Samuel Darío Maldonado'),
(867, 362, 'Boconó'),
(868, 362, 'Hernández'),
(869, 363, 'La Concordia'),
(870, 363, 'San Juan Bautista'),
(871, 363, 'Pedro María Morantes'),
(872, 363, 'San Sebastián'),
(873, 363, 'Dr. Francisco Romero Lobo'),
(874, 364, 'Seboruco'),
(875, 365, 'Simón Rodríguez'),
(876, 366, 'Sucre'),
(877, 366, 'Eleazar López Contreras'),
(878, 366, 'San Pablo'),
(879, 367, 'Torbes'),
(880, 368, 'Uribante'),
(881, 368, 'Cárdenas'),
(882, 368, 'Juan Pablo Peñalosa'),
(883, 368, 'Potosí'),
(884, 369, 'San Judas Tadeo'),
(885, 370, 'Araguaney'),
(886, 370, 'El Jaguito'),
(887, 370, 'La Esperanza'),
(888, 370, 'Santa Isabel'),
(889, 371, 'Boconó'),
(890, 371, 'El Carmen'),
(891, 371, 'Mosquey'),
(892, 371, 'Ayacucho'),
(893, 371, 'Burbusay'),
(894, 371, 'General Ribas'),
(895, 371, 'Guaramacal'),
(896, 371, 'Vega de Guaramacal'),
(897, 371, 'Monseñor Jáuregui'),
(898, 371, 'Rafael Rangel'),
(899, 371, 'San Miguel'),
(900, 371, 'San José'),
(901, 372, 'Sabana Grande'),
(902, 372, 'Cheregüé'),
(903, 372, 'Granados'),
(904, 373, 'Arnoldo Gabaldón'),
(905, 373, 'Bolivia'),
(906, 373, 'Carrillo'),
(907, 373, 'Cegarra'),
(908, 373, 'Chejendé'),
(909, 373, 'Manuel Salvador Ulloa'),
(910, 373, 'San José'),
(911, 374, 'Carache'),
(912, 374, 'La Concepción'),
(913, 374, 'Cuicas'),
(914, 374, 'Panamericana'),
(915, 374, 'Santa Cruz'),
(916, 375, 'Escuque'),
(917, 375, 'La Unión'),
(918, 375, 'Santa Rita'),
(919, 375, 'Sabana Libre'),
(920, 376, 'El Socorro'),
(921, 376, 'Los Caprichos'),
(922, 376, 'Antonio José de Sucre'),
(923, 377, 'Campo Elías'),
(924, 377, 'Arnoldo Gabaldón'),
(925, 378, 'Santa Apolonia'),
(926, 378, 'El Progreso'),
(927, 378, 'La Ceiba'),
(928, 378, 'Tres de Febrero'),
(929, 379, 'El Dividive'),
(930, 379, 'Agua Santa'),
(931, 379, 'Agua Caliente'),
(932, 379, 'El Cenizo'),
(933, 379, 'Valerita'),
(934, 380, 'Monte Carmelo'),
(935, 380, 'Buena Vista'),
(936, 380, 'Santa María del Horcón'),
(937, 381, 'Motatán'),
(938, 381, 'El Baño'),
(939, 381, 'Jalisco'),
(940, 382, 'Pampán'),
(941, 382, 'Flor de Patria'),
(942, 382, 'La Paz'),
(943, 382, 'Santa Ana'),
(944, 383, 'Pampanito'),
(945, 383, 'La Concepción'),
(946, 383, 'Pampanito II'),
(947, 384, 'Betijoque'),
(948, 384, 'José Gregorio Hernández'),
(949, 384, 'La Pueblita'),
(950, 384, 'Los Cedros'),
(951, 385, 'Carvajal'),
(952, 385, 'Campo Alegre'),
(953, 385, 'Antonio Nicolás Briceño'),
(954, 385, 'José Leonardo Suárez'),
(955, 386, 'Sabana de Mendoza'),
(956, 386, 'Junín'),
(957, 386, 'Valmore Rodríguez'),
(958, 386, 'El Paraíso'),
(959, 387, 'Andrés Linares'),
(960, 387, 'Chiquinquirá'),
(961, 387, 'Cristóbal Mendoza'),
(962, 387, 'Cruz Carrillo'),
(963, 387, 'Matriz'),
(964, 387, 'Monseñor Carrillo'),
(965, 387, 'Tres Esquinas'),
(966, 388, 'Cabimbú'),
(967, 388, 'Jajó'),
(968, 388, 'La Mesa de Esnujaque'),
(969, 388, 'Santiago'),
(970, 388, 'Tuñame'),
(971, 388, 'La Quebrada'),
(972, 389, 'Juan Ignacio Montilla'),
(973, 389, 'La Beatriz'),
(974, 389, 'La Puerta'),
(975, 389, 'Mendoza del Valle de Momboy'),
(976, 389, 'Mercedes Díaz'),
(977, 389, 'San Luis'),
(978, 390, 'Caraballeda'),
(979, 390, 'Carayaca'),
(980, 390, 'Carlos Soublette'),
(981, 390, 'Caruao Chuspa'),
(982, 390, 'Catia La Mar'),
(983, 390, 'El Junko'),
(984, 390, 'La Guaira'),
(985, 390, 'Macuto'),
(986, 390, 'Maiquetía'),
(987, 390, 'Naiguatá'),
(988, 390, 'Urimare'),
(989, 391, 'Arístides Bastidas'),
(990, 392, 'Bolívar'),
(991, 407, 'Chivacoa'),
(992, 407, 'Campo Elías'),
(993, 408, 'Cocorote'),
(994, 409, 'Independencia'),
(995, 410, 'José Antonio Páez'),
(996, 411, 'La Trinidad'),
(997, 412, 'Manuel Monge'),
(998, 413, 'Salóm'),
(999, 413, 'Temerla'),
(1000, 413, 'Nirgua'),
(1001, 414, 'San Andrés'),
(1002, 414, 'Yaritagua'),
(1003, 415, 'San Javier'),
(1004, 415, 'Albarico'),
(1005, 415, 'San Felipe'),
(1006, 416, 'Sucre'),
(1007, 417, 'Urachiche'),
(1008, 418, 'El Guayabo'),
(1009, 418, 'Farriar'),
(1010, 441, 'Isla de Toas'),
(1011, 441, 'Monagas'),
(1012, 442, 'San Timoteo'),
(1013, 442, 'General Urdaneta'),
(1014, 442, 'Libertador'),
(1015, 442, 'Marcelino Briceño'),
(1016, 442, 'Pueblo Nuevo'),
(1017, 442, 'Manuel Guanipa Matos'),
(1018, 443, 'Ambrosio'),
(1019, 443, 'Carmen Herrera'),
(1020, 443, 'La Rosa'),
(1021, 443, 'Germán Ríos Linares'),
(1022, 443, 'San Benito'),
(1023, 443, 'Rómulo Betancourt'),
(1024, 443, 'Jorge Hernández'),
(1025, 443, 'Punta Gorda'),
(1026, 443, 'Arístides Calvani'),
(1027, 444, 'Encontrados'),
(1028, 444, 'Udón Pérez'),
(1029, 445, 'Moralito'),
(1030, 445, 'San Carlos del Zulia'),
(1031, 445, 'Santa Cruz del Zulia'),
(1032, 445, 'Santa Bárbara'),
(1033, 445, 'Urribarrí'),
(1034, 446, 'Carlos Quevedo'),
(1035, 446, 'Francisco Javier Pulgar'),
(1036, 446, 'Simón Rodríguez'),
(1037, 446, 'Guamo-Gavilanes'),
(1038, 448, 'La Concepción'),
(1039, 448, 'San José'),
(1040, 448, 'Mariano Parra León'),
(1041, 448, 'José Ramón Yépez'),
(1042, 449, 'Jesús María Semprún'),
(1043, 449, 'Barí'),
(1044, 450, 'Concepción'),
(1045, 450, 'Andrés Bello'),
(1046, 450, 'Chiquinquirá'),
(1047, 450, 'El Carmelo'),
(1048, 450, 'Potreritos'),
(1049, 451, 'Libertad'),
(1050, 451, 'Alonso de Ojeda'),
(1051, 451, 'Venezuela'),
(1052, 451, 'Eleazar López Contreras'),
(1053, 451, 'Campo Lara'),
(1054, 452, 'Bartolomé de las Casas'),
(1055, 452, 'Libertad'),
(1056, 452, 'Río Negro'),
(1057, 452, 'San José de Perijá'),
(1058, 453, 'San Rafael'),
(1059, 453, 'La Sierrita'),
(1060, 453, 'Las Parcelas'),
(1061, 453, 'Luis de Vicente'),
(1062, 453, 'Monseñor Marcos Sergio Godoy'),
(1063, 453, 'Ricaurte'),
(1064, 453, 'Tamare'),
(1065, 454, 'Antonio Borjas Romero'),
(1066, 454, 'Bolívar'),
(1067, 454, 'Cacique Mara'),
(1068, 454, 'Carracciolo Parra Pérez'),
(1069, 454, 'Cecilio Acosta'),
(1070, 454, 'Cristo de Aranza'),
(1071, 454, 'Coquivacoa'),
(1072, 454, 'Chiquinquirá'),
(1073, 454, 'Francisco Eugenio Bustamante'),
(1074, 454, 'Idelfonzo Vásquez'),
(1075, 454, 'Juana de Ávila'),
(1076, 454, 'Luis Hurtado Higuera'),
(1077, 454, 'Manuel Dagnino'),
(1078, 454, 'Olegario Villalobos'),
(1079, 454, 'Raúl Leoni'),
(1080, 454, 'Santa Lucía'),
(1081, 454, 'Venancio Pulgar'),
(1082, 454, 'San Isidro'),
(1083, 455, 'Altagracia'),
(1084, 455, 'Faría'),
(1085, 455, 'Ana María Campos'),
(1086, 455, 'San Antonio'),
(1087, 455, 'San José'),
(1088, 456, 'Donaldo García'),
(1089, 456, 'El Rosario'),
(1090, 456, 'Sixto Zambrano'),
(1091, 457, 'San Francisco'),
(1092, 457, 'El Bajo'),
(1093, 457, 'Domitila Flores'),
(1094, 457, 'Francisco Ochoa'),
(1095, 457, 'Los Cortijos'),
(1096, 457, 'Marcial Hernández'),
(1097, 458, 'Santa Rita'),
(1098, 458, 'El Mene'),
(1099, 458, 'Pedro Lucas Urribarrí'),
(1100, 458, 'José Cenobio Urribarrí'),
(1101, 459, 'Rafael Maria Baralt'),
(1102, 459, 'Manuel Manrique'),
(1103, 459, 'Rafael Urdaneta'),
(1104, 460, 'Bobures'),
(1105, 460, 'Gibraltar'),
(1106, 460, 'Heras'),
(1107, 460, 'Monseñor Arturo Álvarez'),
(1108, 460, 'Rómulo Gallegos'),
(1109, 460, 'El Batey'),
(1110, 461, 'Rafael Urdaneta'),
(1111, 461, 'La Victoria'),
(1112, 461, 'Raúl Cuenca'),
(1113, 447, 'Sinamaica'),
(1114, 447, 'Alta Guajira'),
(1115, 447, 'Elías Sánchez Rubio'),
(1116, 447, 'Guajira'),
(1117, 462, 'Altagracia'),
(1118, 462, 'Antímano'),
(1119, 462, 'Caricuao'),
(1120, 462, 'Catedral'),
(1121, 462, 'Coche'),
(1122, 462, 'El Junquito'),
(1123, 462, 'El Paraíso'),
(1124, 462, 'El Recreo'),
(1125, 462, 'El Valle'),
(1126, 462, 'La Candelaria'),
(1127, 462, 'La Pastora'),
(1128, 462, 'La Vega'),
(1129, 462, 'Macarao'),
(1130, 462, 'San Agustín'),
(1131, 462, 'San Bernardino'),
(1132, 462, 'San José'),
(1133, 462, 'San Juan'),
(1134, 462, 'San Pedro'),
(1135, 462, 'Santa Rosalía'),
(1136, 462, 'Santa Teresa'),
(1137, 462, 'Sucre (Catia)'),
(1138, 462, '23 de enero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `docIdentidad` varchar(15) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `idNacionalidad` int(1) NOT NULL,
  `idGenero` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`docIdentidad`, `nombres`, `apellidos`, `fechaNacimiento`, `idNacionalidad`, `idGenero`) VALUES
('13453984', 'Carlos Luis', 'Esparza Guerra', '1980-07-10', 1, 1),
('16273686', 'Luis', 'Perez', '2020-06-06', 1, 1),
('1890039', 'Anderson Gregorio', 'Hernandez Silva', '2018-07-09', 1, 1),
('18923993', 'Angel Luis', 'Arteaga Perez', '1992-07-03', 1, 1),
('1902930', 'Karla Maria', 'Verastegui Villaverde', '1990-02-20', 1, 2),
('19283938', 'Maria Angela', 'Perez Ribas', '2020-07-03', 1, 2),
('20293099', 'Carlos', 'Arteaga', '2020-06-05', 1, 1),
('23928298', 'Leandro Jesus', 'Villegas Perez', '1996-08-06', 1, 1),
('23948938', 'Carla Elena', 'Alvarado Prado', '1999-07-24', 1, 1),
('28117206', 'Newman Louis', 'Rodriguez Robles', '1999-06-26', 1, 1),
('28379278', 'Miguel jose', 'Sanchez', '1989-07-01', 1, 1),
('9029345', 'Fernando Jose', 'Perez Zapatero', '1962-07-29', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantillaInforme`
--

CREATE TABLE `plantillaInforme` (
  `idPlantillaInforme` int(11) NOT NULL,
  `ubicacionInforme` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonos`
--

CREATE TABLE `telefonos` (
  `docIdentidad` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `alias` varchar(20) NOT NULL,
  `idNacionalidad` int(1) NOT NULL,
  `docIdentidad` varchar(15) NOT NULL,
  `idNivelPermiso` int(1) NOT NULL,
  `idEstado` int(1) NOT NULL,
  `passEncrypt` varchar(130) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` char(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`alias`, `idNacionalidad`, `docIdentidad`, `idNivelPermiso`, `idEstado`, `passEncrypt`, `email`, `telefono`) VALUES
('angel189', 1, '18923993', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'angelose332@gmail.com', '04129384934'),
('calito_22', 1, '13453984', 2, 1, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'calito_21@gmail.com', '04140363234'),
('carla', 1, '23948938', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'newmanrodriguez1999@gmail.com', '04120340023'),
('ferjose12', 2, '9029345', 3, 0, 'WURsTkRYZnhxdlExUnlrMk9wMTdhZz09', 'ferjose1962@hotmail.com', '02120329039'),
('karla_villa', 1, '1902930', 3, 0, 'MGF5VG42RWVaMGorL01Cb21KMzlSZz09', 'karla_villa112@gmail.com', '02399384938'),
('luisespar_12', 1, '13453984', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'luisespar12@gmail.com', '04120394034'),
('mariaangel_22', 1, '19283938', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'Mariaangel_22@gmail.com', '04122122212'),
('Miguel122', 1, '28379278', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'miguel12@gmail.com', ''),
('newman206', 1, '28117206', 1, 1, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'newman@gmail.com', '04120293034'),
('silva1', 1, '1890039', 3, 0, 'MGF5VG42RWVaMGorL01Cb21KMzlSZz09', 'silva2010@hotmail.com', '04129304039'),
('Villegas122', 1, '23928298', 3, 0, 'Wk8vdWFYT1YwVDV0WGhLVGZ1aVJtZz09', 'Villegas122@hotmail.com', '04129304038');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosEstados`
--

CREATE TABLE `usuariosEstados` (
  `idEstado` int(1) NOT NULL,
  `descripcionEstado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariosEstados`
--

INSERT INTO `usuariosEstados` (`idEstado`, `descripcionEstado`) VALUES
(0, 'Inactivo'),
(1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosNiveles`
--

CREATE TABLE `usuariosNiveles` (
  `idNivelPermiso` int(1) NOT NULL,
  `descripcionNivelPermiso` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariosNiveles`
--

INSERT INTO `usuariosNiveles` (`idNivelPermiso`, `descripcionNivelPermiso`) VALUES
(1, 'Administrador'),
(2, 'Normal'),
(3, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosPreguntas`
--

CREATE TABLE `usuariosPreguntas` (
  `aliasUsuario` varchar(20) NOT NULL,
  `idPregunta` int(1) NOT NULL,
  `respuesta` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariosPreguntas`
--

INSERT INTO `usuariosPreguntas` (`aliasUsuario`, `idPregunta`, `respuesta`) VALUES
('28117206', 1, 'carlos'),
('28117206', 2, 'carlos'),
('angel189', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09'),
('angel189', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09'),
('calito_22', 1, 'aaa'),
('calito_22', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09'),
('carla', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09'),
('carla', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09'),
('ferjose12', 1, 'K1FwSFNzbmxicjBoVmcxOUwzS2lLZz09'),
('ferjose12', 2, 'QmUrb1Q4OHBHbVhoUkN2QnZNaEIxdz09'),
('karla_villa', 1, 'eDJORGNVUURPK2xnS0JnY0xxcFVEdz09'),
('karla_villa', 2, 'QmUrb1Q4OHBHbVhoUkN2QnZNaEIxdz09'),
('mariaangel_22', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09'),
('mariaangel_22', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09'),
('Miguel122', 1, 'no'),
('Miguel122', 2, 'no'),
('newman206', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09'),
('newman206', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09'),
('newman207', 1, 'carlos'),
('newman207', 2, 'jon'),
('newman23', 1, 'jon'),
('newman23', 2, 'pepe'),
('rondaApar0431', 1, 'eDJORGNVUURPK2xnS0JnY0xxcFVEdz09'),
('rondaApar0431', 2, 'QmUrb1Q4OHBHbVhoUkN2QnZNaEIxdz09'),
('roserose23', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09'),
('roserose23', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09'),
('silva1', 1, 'eDJORGNVUURPK2xnS0JnY0xxcFVEdz09'),
('silva1', 2, 'QmUrb1Q4OHBHbVhoUkN2QnZNaEIxdz09'),
('Villegas122', 1, 'dEpha1ZrOFc4OUFvRU5lTWtVRG1kZz09'),
('Villegas122', 2, 'bGMvR2pqWWpPQ29sV1dEUWZtcExmdz09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosPreguntasDisponibles`
--

CREATE TABLE `usuariosPreguntasDisponibles` (
  `idPregunta` int(1) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuariosPreguntasDisponibles`
--

INSERT INTO `usuariosPreguntasDisponibles` (`idPregunta`, `descripcion`) VALUES
(1, '¿Cual fue el nombre de tu primera mascota?'),
(2, '¿Cual es el nombre de tu artista favorita?');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`idBitacora`),
  ADD KEY `usuarioAlias` (`usuarioAlias`);

--
-- Indices de la tabla `casosEpidemiologicos`
--
ALTER TABLE `casosEpidemiologicos`
  ADD PRIMARY KEY (`idCasoEpidemiologico`),
  ADD KEY `docIdentidad` (`docIdentidad`),
  ADD KEY `CATALOG_KEY_CIE10` (`CATALOG_KEY_CIE10`),
  ADD KEY `idParroquia` (`idParroquia`);

--
-- Indices de la tabla `dataCIE10`
--
ALTER TABLE `dataCIE10`
  ADD PRIMARY KEY (`CATALOG_KEY`),
  ADD UNIQUE KEY `CONSECUTIVO` (`CONSECUTIVO`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`idGenero`);

--
-- Indices de la tabla `nacionalidades`
--
ALTER TABLE `nacionalidades`
  ADD PRIMARY KEY (`idNacionalidad`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id_parroquia`),
  ADD KEY `id_municipio` (`id_municipio`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`docIdentidad`),
  ADD KEY `id_nacionalidad` (`idNacionalidad`),
  ADD KEY `idGenero` (`idGenero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`alias`),
  ADD KEY `id_tip_usr` (`idNivelPermiso`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `docIdentidad` (`docIdentidad`),
  ADD KEY `idNacionalidad` (`idNacionalidad`,`docIdentidad`);

--
-- Indices de la tabla `usuariosEstados`
--
ALTER TABLE `usuariosEstados`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `usuariosNiveles`
--
ALTER TABLE `usuariosNiveles`
  ADD PRIMARY KEY (`idNivelPermiso`);

--
-- Indices de la tabla `usuariosPreguntas`
--
ALTER TABLE `usuariosPreguntas`
  ADD PRIMARY KEY (`aliasUsuario`,`idPregunta`),
  ADD KEY `idPregunta` (`idPregunta`);

--
-- Indices de la tabla `usuariosPreguntasDisponibles`
--
ALTER TABLE `usuariosPreguntasDisponibles`
  ADD PRIMARY KEY (`idPregunta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `idBitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `casosEpidemiologicos`
--
ALTER TABLE `casosEpidemiologicos`
  MODIFY `idCasoEpidemiologico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id_parroquia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `bitacora_ibfk_1` FOREIGN KEY (`UsuarioAlias`) REFERENCES `usuarios` (`alias`),
  ADD CONSTRAINT `bitacora_ibfk_2` FOREIGN KEY (`usuarioAlias`) REFERENCES `usuarios` (`alias`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `casosEpidemiologicos`
--
ALTER TABLE `casosEpidemiologicos`
  ADD CONSTRAINT `casosEpidemiologicos_ibfk_1` FOREIGN KEY (`docIdentidad`) REFERENCES `personas` (`docIdentidad`),
  ADD CONSTRAINT `casosEpidemiologicos_ibfk_2` FOREIGN KEY (`CATALOG_KEY_CIE10`) REFERENCES `dataCIE10` (`CATALOG_KEY`),
  ADD CONSTRAINT `casosEpidemiologicos_ibfk_3` FOREIGN KEY (`idParroquia`) REFERENCES `parroquias` (`id_parroquia`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`idGenero`) REFERENCES `generos` (`idGenero`),
  ADD CONSTRAINT `personas_ibfk_2` FOREIGN KEY (`idNacionalidad`) REFERENCES `nacionalidades` (`idNacionalidad`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idNivelPermiso`) REFERENCES `usuariosNiveles` (`idNivelPermiso`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`idNivelPermiso`) REFERENCES `usuariosNiveles` (`idNivelPermiso`),
  ADD CONSTRAINT `usuarios_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `usuariosEstados` (`idEstado`),
  ADD CONSTRAINT `usuarios_ibfk_4` FOREIGN KEY (`idNacionalidad`,`docIdentidad`) REFERENCES `personas` (`idNacionalidad`, `docIdentidad`);

--
-- Filtros para la tabla `usuariosPreguntas`
--
ALTER TABLE `usuariosPreguntas`
  ADD CONSTRAINT `usuariosPreguntas_ibfk_1` FOREIGN KEY (`aliasUsuario`) REFERENCES `usuarios` (`alias`),
  ADD CONSTRAINT `usuariosPreguntas_ibfk_2` FOREIGN KEY (`aliasUsuario`) REFERENCES `usuarios` (`alias`),
  ADD CONSTRAINT `usuariosPreguntas_ibfk_3` FOREIGN KEY (`idPregunta`) REFERENCES `usuariosPreguntasDisponibles` (`idPregunta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
