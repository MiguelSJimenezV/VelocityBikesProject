-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2025 a las 00:06:14
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
-- Base de datos: `velocitybikes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_producto`
--

CREATE TABLE `carrito_producto` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito_producto`
--

INSERT INTO `carrito_producto` (`id`, `usuario_id`, `producto_id`, `cantidad`) VALUES
(151, 66690000, 1, 2),
(152, 66690000, 3, 6),
(154, 66690000, 5, 1),
(0, 66786, 1, 18),
(0, 66786, 2, 2),
(0, 6679, 3, 6),
(0, 6679, 4, 6),
(0, 6679, 6, 5),
(0, 6679, 5, 2),
(0, 667, 2, 1),
(0, 66805345, 1, 5),
(0, 6680587, 1, 10),
(0, 1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Línea Joven'),
(2, 'Línea Selección'),
(3, 'Pequeñas Partidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedido`
--

CREATE TABLE `detalles_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_pedido`
--

INSERT INTO `detalles_pedido` (`id`, `pedido_id`, `producto_id`, `cantidad`, `precio_unitario`, `usuario_id`) VALUES
(7, 13, 2, 5, 3950.00, 2),
(8, 13, 3, 1, 4600.00, 2),
(9, 13, 1, 1, 4500.00, 2),
(10, 14, 7, 1, 6000.00, 2),
(11, 14, 6, 4, 5800.00, 2),
(12, 15, 2, 5, 3950.00, 2),
(13, 15, 1, 1, 4500.00, 2),
(14, 16, 2, 1, 3950.00, 4),
(15, 16, 1, 1, 4500.00, 4),
(16, 16, 3, 1, 4600.00, 4),
(17, 16, 5, 1, 4500.00, 4),
(18, 17, 1, 6, 4500.00, 4),
(19, 18, 5, 10, 4500.00, 2),
(20, 18, 4, 2, 4500.00, 2),
(21, 19, 2, 4, 3950.00, 1),
(22, 20, 1, 4, 150.00, 2),
(23, 20, 2, 18, 300.00, 2),
(24, 21, 1, 2, 150.00, 2),
(25, 22, 1, 5, 150.00, 2),
(26, 23, 1, 11, 150.00, 2),
(27, 24, 1, 71, 150.00, 2),
(28, 25, 2, 4, 300.00, 2),
(29, 26, 2, 12, 300.00, 2),
(30, 26, 1, 4, 150.00, 2),
(31, 27, 1, 39, 150.00, 1),
(32, 27, 3, 2, 100.00, 1),
(33, 27, 2, 13, 300.00, 1),
(34, 28, 1, 5, 150.00, 2),
(35, 29, 1, 7, 150.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `metodo_pago` enum('efectivo','tarjeta') NOT NULL DEFAULT 'efectivo',
  `envio` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `total`, `direccion`, `fecha`, `metodo_pago`, `envio`) VALUES
(13, 2, 28850.00, 'Achaval 505', '2024-06-20 16:20:06', 'efectivo', 'si'),
(14, 2, 29200.00, 'Achaval 606', '2024-06-20 16:21:47', 'tarjeta', 'no'),
(15, 2, 24250.00, 'Achaval 606 cp: 1406 CABA ', '2024-06-20 17:24:36', 'efectivo', 'si'),
(16, 4, 17550.00, 'Araujo 2975', '2024-06-20 17:42:17', 'tarjeta', 'no'),
(17, 4, 27000.00, 'Araujo 2975', '2024-06-20 17:44:03', 'efectivo', 'si'),
(18, 2, 54000.00, 'Reconquista 520', '2024-06-20 17:45:29', 'tarjeta', 'si'),
(19, 1, 15800.00, 'Achaval 505', '2024-06-27 00:22:22', 'efectivo', 'si'),
(20, 2, 6000.00, 'almagro', '2024-06-27 02:00:22', 'efectivo', 'si'),
(21, 2, 300.00, 'almagro', '2024-06-27 02:00:51', 'efectivo', 'si'),
(22, 2, 750.00, 'Buenos Aires CORDOBA', '2024-06-29 18:54:02', 'tarjeta', 'no'),
(23, 2, 1650.00, 'Unicenter', '2024-06-29 18:57:33', 'efectivo', 'si'),
(24, 2, 10650.00, 'almagro', '2024-06-29 18:59:59', 'efectivo', 'si'),
(25, 2, 1200.00, 'almagro', '2024-06-29 19:59:52', 'efectivo', 'si'),
(26, 2, 4200.00, 'almagro', '2024-06-29 20:30:45', 'tarjeta', 'si'),
(27, 1, 9950.00, 'almagro', '2024-06-29 20:33:22', 'efectivo', 'si'),
(28, 2, 750.00, 'almagro', '2024-06-29 20:50:16', 'efectivo', 'si'),
(29, 4, 1050.00, 'almagro', '2025-01-03 23:04:36', 'tarjeta', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `anio_lanzamiento` int(4) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `descripcion_larga` text DEFAULT NULL,
  `material` varchar(255) DEFAULT NULL,
  `talle_disponible` varchar(255) DEFAULT NULL,
  `color_disponible` varchar(255) DEFAULT NULL,
  `cantidad_disponible` int(11) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `marca`, `anio_lanzamiento`, `descripcion`, `descripcion_larga`, `material`, `talle_disponible`, `color_disponible`, `cantidad_disponible`, `imagen`, `categoria`, `precio`) VALUES
(1, 'Casco integral con visor solar', 'Aerotech', 2023, 'Casco integral con visor solar retractil, sistema de ventilación ajustable y calota aerodinámica.', 'Este casco integral de Aerotech es una opción de alta gama para los motoristas que buscan comodidad y seguridad. Con su visor solar retráctil, puedes adaptarte fácilmente a diferentes condiciones de luz. Además, el sistema de ventilación ajustable garantiza una circulación de aire óptima, manteniéndote fresco en tus viajes. La calota aerodinámica no solo mejora la estética, sino que también reduce la resistencia al viento, proporcionando una experiencia de conducción más suave y estable.', 'Poliéster, policarbonato', 'S, M, L, XL', 'Negro, Blanco, Rojo, Azul', 50, 'assets/img/1.png', '150.0000', 150.00),
(2, 'Chaqueta de cuero estilo retro', 'RiderX', 2022, 'Chaqueta de cuero estilo retro con protecciones en codos y hombros, ideal para un look vintage y seguro.', 'La chaqueta de cuero estilo retro de RiderX combina el clásico diseño vintage con la seguridad moderna. Sus protecciones en codos y hombros brindan una protección adicional en caso de caídas o impactos. Fabricada con cuero de alta calidad, esta chaqueta no solo te brinda un estilo distintivo, sino también durabilidad y resistencia al desgaste.', 'Cuero genuino', 'XS, S, M, L, XL, XXL', 'Negro, Marrón', 30, 'assets/img/2.png', '300.00', 300.00),
(3, 'Filtro de aire deportivo proTapers', 'AirPro', 2024, 'Filtro de aire deportivo de alto flujo para motores de alto rendimiento, mejora la potencia y la respuesta del motor.', 'El filtro de aire deportivo proTapers de AirPro está diseñado para los entusiastas del rendimiento que desean maximizar la potencia de sus motores. Con un diseño de alto flujo, este filtro garantiza una mayor entrada de aire, lo que se traduce en una mejora significativa en la potencia y la respuesta del motor. Además, su construcción de alta calidad garantiza una filtración eficiente para proteger el motor de partículas dañinas.', 'Aluminio, tela filtrante', '', '', 0, 'assets/img/3.png', 'Accesorios de Motor', 100.00),
(4, 'Llantas de fibra de carbono', 'CarbonSpeed', 2023, 'Llantas de fibra de carbono ultraligeras y resistentes, diseñadas para mejorar el rendimiento y la estética de tu moto.', 'Las llantas de fibra de carbono de CarbonSpeed ofrecen una combinación perfecta de rendimiento y estilo. Fabricadas con fibra de carbono de alta calidad, estas llantas son increíblemente ligeras y duraderas. Su diseño aerodinámico no solo mejora el rendimiento de tu moto al reducir el peso no suspendido, sino que también le da un aspecto agresivo y moderno. Con estas llantas, puedes experimentar una conducción más ágil y una apariencia única en la carretera.', 'Fibra de carbono', '', '', 0, 'assets/img/4.png', 'Accesorios de Ruedas', 500.00),
(5, 'Escape de titanio con silenciador', 'TitaniumRacing', 2024, 'Escape de titanio con silenciador desmontable, ofrece un sonido deportivo y un aumento de potencia en tu moto.', 'El escape de titanio con silenciador de TitaniumRacing es una opción premium para los amantes de las altas prestaciones. Fabricado con titanio de alta calidad, este escape es resistente a altas temperaturas y corrosión, lo que garantiza una larga vida útil. Además, su diseño con silenciador desmontable te permite ajustar el sonido de tu moto según tus preferencias. Experimenta un aumento notable en la potencia y un sonido deportivo inigualable con este escape de alto rendimiento.', 'Titanio', '', '', 0, 'assets/img/5.png', 'Sistemas de Escape', 600.00),
(6, 'Guantes de cuero con protecciones', 'RacingGear', 2023, 'Guantes de cuero con protecciones en nudillos y palmas, ofrecen un alto nivel de protección y comodidad para el piloto.', 'Los guantes de cuero con protecciones de RacingGear son la elección perfecta para los motociclistas que valoran la seguridad y la comodidad. Con protecciones en nudillos y palmas, estos guantes ofrecen una excelente protección contra impactos y abrasiones. Fabricados con cuero de alta calidad, proporcionan un ajuste cómodo y una sensación de lujo. Ya sea en un viaje largo o en una carrera emocionante, estos guantes te mantendrán protegido y cómodo en todo momento.', 'Cuero genuino, poliéster, fibra de carbono', 'XS, S, M, L, XL', 'Negro, Blanco', 100, 'assets/img/6.png', '80.00', 80.00),
(7, 'Funda impermeable para moto', 'DryRide', 2022, 'Funda impermeable para moto con material resistente y costuras selladas, protege tu moto de la lluvia y el polvo.', 'La funda impermeable para moto de DryRide es tu aliado contra las inclemencias del tiempo. Confeccionada con material resistente y costuras selladas, esta funda protege tu moto de la lluvia, el polvo y otros elementos dañinos. Su diseño ajustado asegura un ajuste perfecto, mientras que las correas de sujeción garantizan que permanezca en su lugar incluso en condiciones de viento fuerte. Protege tu inversión y mantén tu moto en perfectas condiciones con esta funda impermeable de alta calidad.', 'Poliéster recubierto de PVC', 'Único', 'Negro, Gris', 50, 'assets/img/7.png', '60.00', 60.00),
(8, 'Batería de litio de alta capacidad', 'EcoPower', 2024, 'Batería de litio ultraligera y de alta capacidad, proporciona una mayor autonomía y durabilidad para tu moto.', 'La batería de litio de alta capacidad de EcoPower es la solución perfecta para aquellos que buscan un rendimiento confiable y duradero. Con su diseño ultraligero y compacto, esta batería ofrece una mayor autonomía y durabilidad en comparación con las baterías convencionales. Además, su tecnología de litio garantiza una carga rápida y una descarga estable, lo que la hace ideal para todo tipo de condiciones de conducción. Actualiza tu moto con esta batería de alta calidad y disfruta de un rendimiento excepcional en cada viaje.', 'Celdas de litio', 'M, X, XL', 'Negro, Blanco', 0, 'assets/img/8.png', '200.00', 200.00),
(9, 'Kit de luces LED para motocicleta', 'BrightRider', 2023, 'Kit completo de luces LED para motocicleta, mejora la visibilidad y la seguridad en la carretera, con diseño de bajo consumo de energía.', 'El kit de luces LED para motocicleta de BrightRider es una actualización imprescindible para mejorar la visibilidad y la seguridad en la carretera. Con su diseño de bajo consumo de energía, este kit proporciona una iluminación brillante y duradera que aumenta tu visibilidad tanto de día como de noche. Fácil de instalar y compatible con la mayoría de las motocicletas, este kit te ofrece una mejora significativa en la seguridad sin comprometer el estilo.', 'Plástico, LED', '', '', 0, 'assets/img/9.png', 'Accesorios de Iluminación', 75.00),
(10, 'Asiento deportivo con HidroGel Plus', 'ComfortRide', 2022, 'Asiento deportivo con gel que proporciona comodidad y soporte durante largos viajes en moto, con diseño antideslizante y resistente al agua.', 'El asiento deportivo con HidroGel Plus de ComfortRide es la solución perfecta para los motociclistas que buscan comodidad durante largos viajes. Su diseño ergonómico y elástico se adapta perfectamente a la forma del cuerpo, proporcionando un apoyo óptimo en todo momento. Además, el gel HidroGel Plus integrado en el asiento reduce los puntos de presión y absorbe los impactos, lo que te permite viajar durante horas sin fatiga. Con su diseño antideslizante y resistente al agua, este asiento es la elección ideal para cualquier aventura en carretera.', 'Cuero sintético, gel HidroGel Plus', '', '', 0, 'assets/img/10.png', 'Accesorios de Asiento', 120.00),
(11, 'Protector de tanque transparente', 'ClearGuard', 2023, 'Protector de tanque transparente para motocicleta, protege la pintura contra arañazos y la abrasión.', 'El protector de tanque transparente de ClearGuard es una manera efectiva de mantener la pintura de tu motocicleta en perfectas condiciones. Fabricado con material de alta calidad, este protector es transparente para que puedas mostrar la pintura original de tu moto mientras la proteges contra arañazos y abrasiones. Su diseño duradero y resistente al agua garantiza una protección duradera, manteniendo tu motocicleta con un aspecto impecable durante más tiempo.', 'Vinilo transparente', '', '', 0, 'assets/img/11.png', 'Accesorios de Protección', 35.00),
(12, 'Soporte para teléfono móvil', 'TechMount', 2024, 'Soporte ajustable para teléfono móvil con montaje en manillar, mantiene tu dispositivo seguro y accesible durante el viaje en moto.', 'El soporte para teléfono móvil de TechMount es la solución perfecta para mantener tu dispositivo seguro y accesible mientras conduces. Con su diseño ajustable y resistente, este soporte se adapta fácilmente a cualquier tamaño de teléfono y ofrece una sujeción firme incluso en terrenos irregulares. El montaje en el manillar garantiza un fácil acceso a tu teléfono sin distraerte de la carretera. Ya sea que necesites navegar por GPS o escuchar música mientras conduces, este soporte te ofrece comodidad y seguridad en cada viaje.', 'Plástico ABS, metal', '', '', 0, 'assets/img/12.png', 'Accesorios Electrónicos', 45.00),
(13, 'Cargador USB para motocicleta', 'PowerRide', 2023, 'Cargador USB resistente al agua para motocicleta, carga tus dispositivos electrónicos mientras conduces, con conexión rápida y segura.', 'El cargador USB para motocicleta de PowerRide es el compañero perfecto para mantenerte conectado mientras viajas. Con su diseño resistente al agua y conexión segura, este cargador te permite cargar tus dispositivos electrónicos sin preocuparte por las condiciones climáticas o los terrenos difíciles. Su conexión rápida y segura garantiza una carga eficiente y estable en todo momento, para que puedas disfrutar de tus dispositivos sin interrupciones mientras conduces.', 'Plástico ABS', '', '', 0, 'assets/img/13.png', 'Accesorios Electrónicos', 25.00),
(14, 'Alforjas de cuero vacuno vintage', 'RetroBags', 2022, 'Alforjas de cuero vintage para motocicleta, con diseño clásico y amplio espacio de almacenamiento para tus pertenencias durante el viaje.', 'Las alforjas de cuero vacuno vintage de RetroBags combinan el encanto del viejo mundo con la funcionalidad moderna. Fabricadas con cuero de alta calidad, estas alforjas ofrecen una durabilidad excepcional y un aspecto clásico que complementa perfectamente cualquier estilo de motocicleta. Con su amplio espacio de almacenamiento, puedes llevar contigo todas tus pertenencias esenciales en tus viajes largos o cortos. Ya sea que estés explorando la ciudad o cruzando el país, estas alforjas te acompañarán con estilo y confiabilidad.', 'Cuero vacuno', '', '', 0, 'assets/img/14.png', 'Equipaje y Almacenamiento', 250.00),
(15, 'Cúpula deportiva de fibra de carbono', 'CarbonShield', 2024, 'Cúpula deportiva de fibra de carbono para motocicleta, reduce la resistencia al viento y mejora la aerodinámica, con diseño ligero y resistente.', 'La cúpula deportiva de fibra de carbono de CarbonShield es una adición imprescindible para los motociclistas que buscan mejorar la aerodinámica y el estilo de su moto. Fabricada con fibra de carbono de alta calidad, esta cúpula es increíblemente ligera y resistente, lo que reduce la resistencia al viento y mejora la estabilidad a altas velocidades. Su diseño aerodinámico no solo mejora el rendimiento de tu moto, sino que también le da un aspecto agresivo y deportivo. Con esta cúpula, puedes conquistar la carretera con estilo y confianza.', 'Fibra de carbono', '', '', 0, 'assets/img/15.png', 'Estética y Aerodinámica', 400.00),
(16, 'Amortiguadores traseros ajustables', 'ShockMaster', 2023, 'Amortiguadores traseros ajustables para motocicleta, proporcionan un mejor control y durante la conducción en diferentes condiciones.', 'Los amortiguadores traseros ajustables de ShockMaster son la solución perfecta para aquellos que buscan un mejor control y comodidad en su moto. Con su capacidad de ajuste, puedes personalizar la configuración de los amortiguadores según tu estilo de conducción y las condiciones de la carretera. Ya sea en terrenos accidentados o en carreteras lisas, estos amortiguadores te proporcionarán una conducción suave y estable en todo momento.', 'Metal, resorte', 'M, X, XL', 'Amarillo', 0, 'assets/img/16.png', '350.00', 350.00),
(22, 'Miguel', 'marca', 2, 'kjsjk', 'dlksdj', 'materia', 'tale', 'color', 3, 'oiso', 'cate', 0.05),
(23, 'Miguel', 'marca', 2, 'kjsjk', 'dlksdj', 'materia', 'tale', 'color', 3, 'oiso', 'cate', 0.05),
(24, '', '', 0, '', '', '', '', '', 0, '', '', 0.00),
(25, '', '', 0, '', '', '', '', '', 0, '', '', 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password_user`, `direccion`, `email`, `telefono`, `rol`) VALUES
(1, 'miguel', 'aea862aa22a0f5b829d5795882889c08', 'almagro', 'davinci@gmail.com', 1154108356, 1),
(2, 'nicolas', 'aea862aa22a0f5b829d5795882889c08', 'almagro', 'davinci@gmail.com', 1154108356, 0),
(3, 'admin', 'aea862aa22a0f5b829d5795882889c08', 'almagro', 'davinci@gmail.com', 1154108356, 1),
(4, 'user', 'aea862aa22a0f5b829d5795882889c08', 'almagro', 'davinci@gmail.com', 1154108356, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalles_pedido`
--
ALTER TABLE `detalles_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
