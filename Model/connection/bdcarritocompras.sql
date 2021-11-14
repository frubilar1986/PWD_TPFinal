-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2021 a las 21:43:52
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdcarritocompras`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` bigint(20) NOT NULL,
  `cofecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idusuario` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestado`
--

CREATE TABLE `compraestado` (
  `idcompraestado` bigint(20) UNSIGNED NOT NULL,
  `idcompra` bigint(11) NOT NULL,
  `idcompraestadotipo` int(11) NOT NULL,
  `cefechaini` timestamp NOT NULL DEFAULT current_timestamp(),
  `cefechafin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraestadotipo`
--

CREATE TABLE `compraestadotipo` (
  `idcompraestadotipo` int(11) NOT NULL,
  `cetdescripcion` varchar(50) NOT NULL,
  `cetdetalle` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compraestadotipo`
--

INSERT INTO `compraestadotipo` (`idcompraestadotipo`, `cetdescripcion`, `cetdetalle`) VALUES
(1, 'iniciada', 'cuando el usuario : cliente inicia la compra de uno o mas productos del carrito'),
(2, 'aceptada', 'cuando el usuario administrador da ingreso a uno de las compras en estado = 1 '),
(3, 'enviada', 'cuando el usuario administrador envia a uno de las compras en estado =2 '),
(4, 'cancelada', 'un usuario administrador podra cancelar una compra en cualquier estado y un usuario cliente solo en estado=1 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compraitem`
--

CREATE TABLE `compraitem` (
  `idcompraitem` bigint(20) UNSIGNED NOT NULL,
  `idproducto` bigint(20) NOT NULL,
  `idcompra` bigint(20) NOT NULL,
  `cicantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `idmenu` bigint(20) NOT NULL,
  `menombre` varchar(50) NOT NULL COMMENT 'Nombre del item del menu',
  `medescripcion` varchar(124) NOT NULL COMMENT 'Descripcion mas detallada del item del menu',
  `idpadre` bigint(20) DEFAULT NULL COMMENT 'Referencia al id del menu que es subitem',
  `medeshabilitado` timestamp NULL DEFAULT current_timestamp() COMMENT 'Fecha en la que el menu fue deshabilitado por ultima vez'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idmenu`, `menombre`, `medescripcion`, `idpadre`, `medeshabilitado`) VALUES
(7, 'nuevo', 'kkkkk', NULL, NULL),
(8, 'nuevo', 'kkkkk', NULL, NULL),
(9, 'nuevo', 'kkkkk', 7, NULL),
(10, 'nuevo', 'kkkkk', NULL, NULL),
(11, 'nuevo', 'kkkkk', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menurol`
--

CREATE TABLE `menurol` (
  `idmenu` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `pronombre` varchar(50) NOT NULL,
  `prodetalle` varchar(2500) NOT NULL,
  `procantstock` int(11) NOT NULL,
  `proprecio` int(7) NOT NULL,
  `propreciooferta` int(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `pronombre`, `prodetalle`, `procantstock`, `proprecio`, `propreciooferta`) VALUES
(2, 'LG K41s', '\"marca\" => \"LG\", \"desc1\" => \"El LG K41S se define como un smartphone todoterreno: en primer lugar, cuenta con un sistema de cinco cámaras muy versátil para capturar infinidades de momentos, desde ángulos completamente distintos. Además, viene con 32GB de almacenamiento los cuales son necesarios para atesorar en el celu todos los recuerdos que realmente importan.\",\"desc2\" => \"Además, el LG K41S es sinónimo de autonomía garantizada, ya que la energía que tiene dura todo el día. Su batería de 4,000 mAh te acompaña desde el amanecer hasta el anochecer para transmitir en vivo, chatear, jugar o sacar fotos sin preocuparse por el cargador.\",\"Cámara principal\" => \"13 mpx con flash LED | Cuádruple | Zoom digital 4x\",\"Display\" => \"6.5\'\' HD+\",\"Procesador\" => \"Octa Core 2.0 GHz\",\"Celular Liberado\" => \"Si\",\"Modelo\" => \"LM-K410HM\",\"Cámara frontal\" => \"8 mpx\",\"Sistema Operativo\" => \"Android 10\",\"Tipo de SIM\" => \"Nano-SIM\",\"Red\" => \"2G, 3G, 4G\",\"Frecuencia 2G\" => \"850/900/1800/1900 MHz\",\"Frecuencia 3G\" => \"Bandas 1, 2, 4, 5 y 8.\",\"Frecuencia 4G\" => \"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 28, 38 y 66.\",\"Batería\" => \"4000 mAh\",\"Memoria RAM\" => \"3 GB\",\"Memoria Interna\" => \"32 GB | Disponibles 13 GB\",\"Memoria Externa\" => \"MicroSD hasta 2TB\",\"Peso\" => \"189 gr\",\"Dimensión del equipo\" => \"165,8 x 76,4 x 8,2 mm\",\"NFC\" => \"No\",\"Auriculares Incluidos\" => \"No\",\"Cargador Incluido\" => \"Si\",\"Cable USB Incluido\" => \"Si. Tipo C.\",\"Cover Incluido\" => \"Si\",\"Otros Accesorios Incluidos\" => \"No\",', 5, 23999, 17999),
(3, 'LG K22', '\"marca\" => \"LG\", \"desc1\" => \"El LG K22 promete una mejor y más grande experiencia visual que otros modelos. De hecho, la compañía afirma haber creado una gran pantalla para ver todo. Este equipo permite realizar videollamadas, jugar, reproducir películas y series todo en una pantalla HD+ de 6.2 pulgadas 19:9 con V notch que va de extremo a extremo.\",  \"desc2\" => \"Además, el LG K22 permite hacer más cosas a la vez, como por ejemplo cambiar entre aplicaciones y tareas sin interrupciones, ni problemas. Esto es posible gracias a la plataforma móvil Qualcomm 215 con procesador Quad-core de 1.3GHz el cual mejora el rendimiento para que todo funcione de forma rápida y eficaz.\",  \"Cámara principal\" => \"13 mpx con flash LED | Dual | Zoom Digital 8x\",  \"Display\" => \"6.2 HD+ IPS\",  \"Procesador\" => \"Quad Core 1.3 GHz\",  \"Celular Liberado\" => \"Si\",  \"Modelo\" => \"LM-K200HM\",  \"Cámara frontal\" => \"5 mpx\",  \"Sistema Operativo\" => \"Android 10\",  \"Tipo de SIM\" => \"Nano-SIM\",  \"Red\" => \"2G, 3G, 4G\",  \"Frecuencia 2G\" => \"850/900/1800/1900 MHz\",  \"Frecuencia 3G\" => \"Bandas 1, 2, 4, 5 y 8.\",  \"Frecuencia 4G\" => \"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 28, 38 y 66.\",  \"Batería\" => \"3000 mAh\",  \"Batería en modo Stand By\" => \"545 h\",  \"Tiempo de conversación\" => \"10 h\",  \"Memoria RAM\" => \"2 GB\",  \"Memoria Interna\" => \"32 GB | Disponibles 18 GB\",  \"Memoria Externa\" => \"MicroSD hasta 32 GB\",  \"Peso\" => \"169,5 g\",  \"Dimensión del equipo\" => \"157,7 x 75,4 x 8,4 mm\",  \"Llamadas por WiFi\" => \"Si\",  \"NFC\" => \"No\",  \"Auriculares Incluidos\" => \"No\",  \"Cargador Incluido\" => \"Si\",  \"Cable USB Incluido\" => \"Si. MicroUSB.\",  \"Cover Incluido\" => \"Si\",  \"Otros Accesorios Incluidos\" => \"No\",', 5, 18999, 14249),
(4, 'LG K50s', '\"marca\" => \"LG\", \"desc1\" => \"La línea K de los LG trae cada vez más funciones como es el caso del nuevo LG K50S. Pantalla full vision, sonido envolvente y, como si fuera poco, una batería que dura todo el día.\",\"desc2\" => \"Además, el LG K50S cuenta con un sistema de triple cámara con el que vas a poder sacar fotos extremadamente nítidas y de calidad. Con todas estas funciones, el LG K50S no tiene nada que envidiar a celulares de alta gama y podés encontrarlo a un precio más que accesible.\",\"Cámara principal\" => \"13 mpx con Flash LED | Triple | Zoom digital 4x | Zoom óptico 1x\",\"Display\" => \"6.5\'\' HD+\",\"Procesador\" => \"Octa Core 2.0 GHz\",\"Celular Liberado\" => \"Si\",\"Modelo\" => \"LM-X540HM\",\"Cámara frontal\" => \"13 mpx\",\"Sistema Operativo\" => \"Android 9.0\",\"Tipo de SIM\" => \"Nano-SIM\",\"Red\" => \"2G, 3G, 4G\",\"Frecuencia 2G\" => \"850/900/1800/1900 MHz\",\"Frecuencia 3G\" => \"Bandas 1, 2, 4, 5, 8.\",\"Frecuencia 4G\" => \"Bandas 1, 2, 3, 4, 5, 7, 8, 12, 13, 17, 28, 40, 66.\",\"Batería\" => \"4000 mAh\",\"Batería en modo Stand By\" => \"360 h\",\"Tiempo de conversación\" => \"11 h\",\"Memoria RAM\" => \"3 GB\",\"Memoria Interna\" => \"32 GB | Disponibles 19.4 GB\",\"Memoria Externa\" => \"MicroSD hasta 1 TB\",\"Peso\" => \"194 g\",\"Dimensión del equipo\" => \"165.8 x 77.5 x 8.2 mm\",\"Llamadas por WiFi\" => \"Si\",\"NFC\" => \"No\",\"Auriculares Incluidos\" => \"No\",\"Cargador Incluido\" => \"Si\",\"Cable USB Incluido\" => \"Si. Tipo C.\",\"Cover Incluido\" => \"No\",\"Otros Accesorios Incluidos\" => \"No\",', 3, 25999, NULL),
(5, 'Moto E7i Power', '\"marca\" => \"Motorola\", \"desc1\" => \"El nuevo Moto E7i Power permite aprovechar tu celular como nunca antes gracias a la gran batería de 5000 mAh que dura más de 40 horas con una única carga. Este modelo no solo porta un diseño elegante y dinámico para el agarre sino también una resistencia única ya que es repelente al agua: se mantiene protegido de derrames, salpicaduras y bajo la lluvia.\", \"desc2\" => \"Además, el Moto E7i Power cuenta con una impresionante pantalla ultra ancha de 6,5 pulgadas Max Vision HD+ para disfrutar de todo el contenido con la mejor calidad. Ahora podés jugar, mirar y videochatear con la mejor calidad gracias a su relación de aspecto 20:9 y una gran proporción pantalla-cuerpo.\", \"Cámara principal\" => \"13 mpx con flash LED | Dual | Zoom digital 4x\", \"Display\" => \"6.5\'\' IPS HD+\", \"Procesador\" => \"Octa Core 1.6 GHz\", \"Celular Liberado\" => \"Si\", \"Modelo\" => \"XT2097-12\", \"Cámara frontal\" => \"5 mpx\", \"Sistema Operativo\" => \"Android 10\", \"Tipo de SIM\" => \"Nano-SIM\", \"Red\" => \"2G, 3G, 4G\", \"Frecuencia 2G\" => \"850/900/1800/1900 MHz\", \"Frecuencia 3G\" => \"Bandas 1, 2, 4, 5, 6 y 8.\", \"Frecuencia 4G\" => \"Bandas 1, 2, 3, 4, 5, 7, 8, 19, 28 y 66.\", \"Batería\" => \"5000 mAh\", \"Memoria RAM\" => \"2 GB\", \"Memoria Interna\" => \"32 GB | Disponibles 24 GB\", \"Memoria Externa\" => \"MicroSD hasta 1 TB\", \"Peso\" => \"200 gr\", \"Dimensión del equipo\" => \"165 x 75,8 x 9,2 mm\", \"NFC\" => \"No\", \"Auriculares Incluidos\" => \"No\", \"Cargador Incluido\" => \"Si\", \"Cable USB Incluido\" => \"Si. Tipo C.\", \"Cover Incluido\" => \"No\", \"Otros Accesorios Incluidos\" => \"No\",', 3, 22999, 20699);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `rodescripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL,
  `usnombre` varchar(50) NOT NULL,
  `uspass` int(11) NOT NULL,
  `usmail` varchar(50) NOT NULL,
  `usdeshabilitado` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariorol`
--

CREATE TABLE `usuariorol` (
  `idusuario` bigint(20) NOT NULL,
  `idrol` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD UNIQUE KEY `idcompra` (`idcompra`),
  ADD KEY `fkcompra_1` (`idusuario`);

--
-- Indices de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD PRIMARY KEY (`idcompraestado`),
  ADD UNIQUE KEY `idcompraestado` (`idcompraestado`),
  ADD KEY `fkcompraestado_1` (`idcompra`),
  ADD KEY `fkcompraestado_2` (`idcompraestadotipo`);

--
-- Indices de la tabla `compraestadotipo`
--
ALTER TABLE `compraestadotipo`
  ADD PRIMARY KEY (`idcompraestadotipo`);

--
-- Indices de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD PRIMARY KEY (`idcompraitem`),
  ADD UNIQUE KEY `idcompraitem` (`idcompraitem`),
  ADD KEY `fkcompraitem_1` (`idcompra`),
  ADD KEY `fkcompraitem_2` (`idproducto`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idmenu`),
  ADD UNIQUE KEY `idmenu` (`idmenu`),
  ADD KEY `fkmenu_1` (`idpadre`);

--
-- Indices de la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD PRIMARY KEY (`idmenu`,`idrol`),
  ADD KEY `fkmenurol_2` (`idrol`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD UNIQUE KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`),
  ADD UNIQUE KEY `idrol` (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD PRIMARY KEY (`idusuario`,`idrol`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compraestado`
--
ALTER TABLE `compraestado`
  MODIFY `idcompraestado` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compraitem`
--
ALTER TABLE `compraitem`
  MODIFY `idcompraitem` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `idmenu` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fkcompra_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraestado`
--
ALTER TABLE `compraestado`
  ADD CONSTRAINT `fkcompraestado_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraestado_2` FOREIGN KEY (`idcompraestadotipo`) REFERENCES `compraestadotipo` (`idcompraestadotipo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compraitem`
--
ALTER TABLE `compraitem`
  ADD CONSTRAINT `fkcompraitem_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkcompraitem_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fkmenu_1` FOREIGN KEY (`idpadre`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `menurol`
--
ALTER TABLE `menurol`
  ADD CONSTRAINT `fkmenurol_1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkmenurol_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuariorol`
--
ALTER TABLE `usuariorol`
  ADD CONSTRAINT `fkmovimiento_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON UPDATE CASCADE,
  ADD CONSTRAINT `usuariorol_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
