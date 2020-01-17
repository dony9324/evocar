
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `box` (
  `id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `box_id2` (
  `id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id` decimal(3,0) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `value` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



INSERT INTO `company` (`id`, `name`, `value`) VALUES
(1, 'iva', '20'),
(2, 'nit', '143141175-5  gimen Simplificado'),
(3, 'cell', '300 528 14 12'),
(4, 'mensaje', ''),
(5, 'direccion', 'Calle 20  Carrera 1  # 179'),
(6, 'nota', 'Plazo de devoluciones  5 días. Presentar factura.');


CREATE TABLE `configuration` (
  `id` int(11) NOT NULL,
  `short` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `kind` int(11) DEFAULT NULL,
  `val` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `iva` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `porcentage` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id` decimal(3,0) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `iva` (`id`, `name`, `porcentage`, `user_id`, `created_at`) VALUES
(3, 'general', '19', '1', '2019-05-29 21:21:24');


CREATE TABLE `operation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT '0' COMMENT 'en caso de que el producuto sea una presentacion segundaria se pone aki',
  `q` float DEFAULT '0',
  `precitotal` int(11) NOT NULL,
  `discount` double DEFAULT NULL,
  `change_price_out` int(11) NOT NULL,
  `change_price_in` int(11) NOT NULL,
  `operation_type_id` int(11) DEFAULT NULL,
  `sell_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `cancel` tinyint(1) DEFAULT NULL COMMENT 'indica si se anula esta factura. 1=si.'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `sell_id` int(50) DEFAULT NULL,
  `user_id` int(50) DEFAULT NULL,
  `payment` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identity` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `address1` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email1` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `phone1` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `phone2` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `company` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `kind` int(11) DEFAULT NULL COMMENT '1 = cliente, 2=proveedor',
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `id_group` int(11) DEFAULT '0',
  `group_amount` double NOT NULL DEFAULT '1',
  `fractions` double NOT NULL DEFAULT '1' COMMENT 'partes a dividir',
  `total_quantity` double NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `extracode` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `trademark_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `type_of_iva_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `other_presentations` tinyint(1) NOT NULL DEFAULT '0',
  `price_in` double DEFAULT NULL,
  `price_out` double DEFAULT NULL,
  `inventary_min` int(11) DEFAULT '10',
  `control_stock` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 es control 0 el burro suelto',
  `divide` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Permitir fracionar producto 1 = si 0 =no',
  `is_active` tinyint(1) DEFAULT '1' COMMENT '1 = si 0 =no',
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


CREATE TABLE `sell` (
  `id` int(20) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `accredit` tinyint(1) DEFAULT '0' COMMENT '0=no 1=si',
  `accreditlast` int(11) DEFAULT '0',
  `total` double DEFAULT NULL,
  `cost` double DEFAULT '0',
  `operation_type_id` int(11) DEFAULT '2' COMMENT '1=entrada 2=salida',
  `discount` double DEFAULT NULL,
  `money_person` double DEFAULT '0',
  `box_id` int(11) DEFAULT NULL,
  `delivery` tinyint(1) DEFAULT '1' COMMENT 'marca si uvo entrega inmediata 1= si , 0=no. no modificar mas',
  `extracode` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'este campo es un identificador interno pensado para las facturas de compras',
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `cancel` tinyint(1) DEFAULT NULL COMMENT 'indica si se anula esta factura. 1=si. '
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `trademark` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `user_id` decimal(3,0) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;



CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `equivalent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abbreviation` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `value_equivalent` int(11) NOT NULL,
  `fractions` int(11) NOT NULL DEFAULT '1',
  `type` int(3) NOT NULL,
  `user_id` decimal(3,0) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `unit` (`id`, `equivalent_id`, `name`, `description`, `abbreviation`, `value_equivalent`, `fractions`, `type`, `user_id`, `created_at`) VALUES
(1, 0, 'Unidad', NULL, 'Ud', 0, 1, 1, '1', '2018-10-31 11:09:39'),
(3, 1, 'Par', NULL, '', 2, 1, 1, '1', '2018-10-31 11:19:06'),
(4, 1, 'Decena', 'Conjunto formado por 10 unidades.', 'Dec', 10, 1, 1, '1', '2018-10-31 11:21:25'),
(5, 1, 'Docena', 'Conjunto formado por 12 unidades.', '', 12, 1, 1, '1', '2018-10-31 11:22:34'),
(6, 0, 'Caja', 'ñá', '', 0, 1, 0, '1', '2018-10-31 11:24:51'),
(7, 0, 'Paquete', 'Paquete', '', 0, 1, 0, '1', '2018-10-31 11:24:51'),
(8, 0, 'Saco', NULL, '', 0, 1, 0, '1', '2018-10-31 11:26:28'),
(9, 0, 'Metro', 'El metro es la unidad coherente de longitud', '', 0, 1, 2, '1', '2018-10-31 11:30:22'),
(10, 8, 'Centimetro', 'Medida de longitud, de símbolo cm, que es igual a la centésima parte de un metro.', '', 1, 100, 2, '1', '2018-10-31 11:31:55'),
(11, 8, 'Milímetro', 'Medida de longitud, de símbolo mm, que es igual a la milésima parte de un metro.', '', 1, 1000, 2, '1', '2018-10-31 11:33:05'),
(12, 8, 'Kilómetro', 'Medida de longitud, de símbolo Km, que es igual a mil metro.', '', 1000, 1, 2, '1', '2018-10-31 11:36:46'),
(13, 0, 'Litro', 'Unidad de volumen del Sistema Internacional, de símbolo l o L, que equivale a 1 decímetro cúbico.', '', 0, 1, 3, '1', '2018-10-31 11:38:18'),
(14, 12, 'Mililitros', 'El mililitro es una unidad de volumen equivalente a la milésima parte de un litro', '', 1, 1000, 3, '1', '2018-10-31 11:40:11'),
(15, 12, 'Metro cúbico', 'El metro cúbico es una unidad de volumen. Se corresponde con el volumen de un cubo de un metro de arista. Es la unidad coherente del Sistema Internacional de Unidades para el volumen. Equivale a un kilolitro', '', 1000, 1, 3, '1', '2018-10-31 11:59:26'),
(16, 0, 'Volqueta', NULL, '', 0, 1, 1, '1', '2018-10-31 12:01:22'),
(17, 0, 'Gramo', 'Medida de masa, de símbolo g, que es igual a la milésima parte de un kilogramo.', '', 0, 1, 4, '1', '2018-10-31 12:02:16'),
(18, 16, 'Kilogramo', 'Unidad de masa del Sistema Internacional, de símbolo kg', '', 1000, 1, 4, '1', '2018-10-31 12:04:17'),
(19, 16, 'Tonelada', 'Unidad de masa del Sistema Internacional, de símbolo t, que es igual a 1 000 kilogramos.', '', 1000000, 1, 4, '1', '2018-10-31 12:05:25'),
(2, 0, 'Unidades', '', 'Uds', 0, 1, 1, '1', '2018-11-04 16:27:49');



CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lastname` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identity` int(50) DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `time` int(5) NOT NULL DEFAULT '600',
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


INSERT INTO `user` (`id`, `name`, `lastname`, `identity`, `username`, `email`, `password`, `image`, `status`, `is_admin`, `time`, `created_at`) VALUES
(1, 'Donaldo ', 'Puentes', 1049939104, 'Donaldo Puentes', 'Donaldo Puentes', 'b0761e2e5aa1306ffb7bac16f5050e27791a482f ', 'user1-160x160.jpg', 1, 1, 6000, '2016-11-02 18:44:44');


ALTER TABLE `box`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `box_id2`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `iva`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `operation`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `trademark`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);



ALTER TABLE `box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `box_id2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `configuration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `iva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `sell`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;


ALTER TABLE `trademark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
