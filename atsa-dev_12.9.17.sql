-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 12-09-2017 a las 11:54:13
-- Versión del servidor: 5.7.19-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.22-2+ubuntu16.04.1+deb.sury.org+4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `atsa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficios`
--

CREATE TABLE `beneficios` (
  `beneficio_ID` int(11) NOT NULL,
  `beneficio_titulo` varchar(250) NOT NULL,
  `beneficio_incluye` varchar(450) NOT NULL DEFAULT '',
  `beneficio_texto` text NOT NULL,
  `beneficio_imagen` varchar(250) NOT NULL DEFAULT '',
  `beneficio_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `beneficios`
--

INSERT INTO `beneficios` (`beneficio_ID`, `beneficio_titulo`, `beneficio_incluye`, `beneficio_texto`, `beneficio_imagen`, `beneficio_orden`) VALUES
(1, 'Subsidio por nacimiento de hijo/a', 'Un ajuar o un cochecito paragüitas o un catre cuna.', '<ul>\n	<li>\n		Partida de Nacimiento del bebé otorgada por el Registro Civil (original y 3 fotocopias).\n	</li>\n	<li>\n		DNI del titular (original y 2 fotocopias).\n	</li>\n	<li>\n		Último recibo de haberes con el descuento sindical del 2% (original y 3 fotocopias).\n	</li>\n	<li>\n		Carnet Sindical (original y 1 fotocopia)\n	</li>\n	<li>\n		La afiliación al Sindicato debe ser con una antigüedad de 4(cuatro) meses a la fecha del nacimiento del bebe.\n	</li>\n	<li>\n		El trámite debe realizarse dentro de los primeros tres (3) meses de ocurrido el nacimiento, es personal, de no poder realizarlo el titular, quién lo gestione deberá traer una autorización por escrito y DNI del autorizado (original y 1 copia).\n	</li>\n</ul>', 'beneficio1.png', 1),
(2, 'Obsequio por nacimiento de nieto/a de hijo/a menor de 21 años a cargo', 'Obsequio que consta de un ajuar o un cochecito paragüitas o un catre cuna.', '<ul>\r\n	<li>\r\n		DNI del titular (original y 1 copia) y DNI del hijo menor a cargo (original y 1 copia)\r\n	</li>\r\n	<li>\r\n		Partida de nacimiento otorgada por el registro civil del nieto e hijo menor a cargo (original y 1 copia)\r\n	</li>\r\n	<li>\r\n		Último recibo de haberes con el descuento sindical del 2% (original y 3 fotocopias).\r\n	</li>\r\n	<li>\r\n		Carnet Sindical (original y 1 fotocopia)\r\n	</li>\r\n	<li>\r\n		El trámite debe realizarse dentro de los primeros tres (3) meses de ocurrido el nacimiento, es personal, de no poder realizarlo el titular, quién lo gestione deberá traer una autorización por escrito y DNI del autorizado (original y 1 copia).\r\n	</li>\r\n</ul>', 'beneficio2.png', 2),
(4, 'Subsidio por fallecimiento', '', '<ul>\n<li>Puede reclamarlo &uacute;nicamente el familiar directo (c&oacute;nyuge - hijos- padres- hermanos) del titular fallecido.</li>\n<li>Si el que lo solicita es el c&oacute;nyuge los requisitos son: certificado de defunci&oacute;n del titular, libreta de matrimonio o acta de matrimonio (actualizado) o certificado de convivencia, &uacute;ltimo recibo de sueldo del titular, carnet sindical (ATSA) y de Obra Social (OSPSA), DNI solicitante.</li>\n<li>Si lo solicita el hijo o los hijos: certificado de defunci&oacute;n del titular, certificado de matrimonio de los padres o acta de convivencia, certificados de nacimiento de cada uno de los hijos (actualizados) y DNI de los mismos, &uacute;ltimo recibo de sueldo del titular, carnet sindical (ATSA) y de Obra Social (OSPSA). Si son varios hermanos, el que realice el tr&aacute;mite deber&aacute; presentar autorizaci&oacute;n por escrito del resto de los hermanos.</li>\n<li>En los dos casos presentar original y 4 fotocopias de cada documentaci&oacute;n requerida.</li>\n</ul>', 'beneficio3.png', 3),
(5, 'Entrega de útiles', 'Kit escolar con mochila, útiles escolares y guardapolvo para chicos de 5 a 17 años.', '<ul>\n<li>Carnet de afiliado</li>\n<li>&Uacute;ltimo recibo de sueldo</li>\n<li>DNI/c&eacute;dula de tu hijo</li>\n<li>Acreditaci&oacute;n de parentesco (partida de nacimiento o libreta de casamiento)</li>\n</ul>', 'beneficio5.png', 5),
(6, 'Viaje de bodas', 'Estadía de Luna de Miel en cualquiera de nuestros hoteles sindicales, en forma totalmente gratuita. Son diez (10) días de estadía con 1/2 pensión. Aquellos compañeros que requieran una estadía menor deberán solicitarlo en el sindicato.', '<ul>\n<li>Antigüedad mínima de un 1 año de afiliación gremial</li>\n<li>Las reservas deberán realizarse con 30 días de anticipación</li>\n<li>Último recibo de sueldo</li>\n<li>Carnet de afiliado</li>\n<li>2 fotocopias de 1era y 2nda hoja del DNI</li>\n<li>Fecha que otorga el Registro Civil para el matrimonio</li>\n</ul>', 'beneficio6.png', 6),
(7, 'Ayuda Mutua', 'Asistencia económica mensual para aquellos compañeros que estén atravesando alguna enfermedad prolongada, por un periodo de seis (6) hasta doce (12) meses según corresponda. Con una antigüedad de 1 a 5 años le corresponde el cobro de 6 meses. Mayor a 5 años corresponde 1 año de cobro.', '<ul>\n<li>Último recibo de sueldo</li>\n<li>Certificado médico (Todos los meses cuando viene a cobrar debe traerlo con fecha actualizada).</li>\n<li>Carnet Sindical (original y 1 fotocopia)</li>\n<li>Carta documento del empleador dando la guarda de puesto.</li>\n</ul>', 'beneficio4.png', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios`
--

CREATE TABLE `convenios` (
  `convenios_id` int(11) NOT NULL,
  `convenios_texto` varchar(250) NOT NULL DEFAULT '',
  `convenios_url` varchar(250) NOT NULL,
  `convenios_orden` int(11) NOT NULL DEFAULT '0',
  `convenios_seccion` varchar(100) NOT NULL DEFAULT '',
  `convenios_post_type` varchar(100) NOT NULL DEFAULT '',
  `convenios_link` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `convenios`
--

INSERT INTO `convenios` (`convenios_id`, `convenios_texto`, `convenios_url`, `convenios_orden`, `convenios_seccion`, `convenios_post_type`, `convenios_link`) VALUES
(1, 'CCT 122/75 - Clínicas y Sanatorios con Internación', '', 1, '122-75', 'section', 0),
(2, 'CCT 120/75 - Droguerías', '', 2, '120-75', 'section', 0),
(3, 'CCT 459/06 - Emergencias Médicas', '', 3, '459-06', 'section', 0),
(4, 'CCT 103/75 - Hospitales Privados', '', 4, '103-75', 'section', 0),
(5, 'CCT 108/75 - Institutos Médicos sin Internación', '', 5, '108-75', 'section', 0),
(6, 'CCT 42/89 - Laboratorios de especialidades medicinales y veterinarias', '', 6, '42-89', 'section', 0),
(7, 'CCT 107/75 - Mutualidades', '', 7, '107-75', 'section', 0),
(8, 'CCT 743/16 - Atención, Cuidado e Internación', '', 8, '743-16', 'section', 0),
(9, 'Convenio Colectivo - 122/75', '122-convenio.pdf', 1, '122-75', 'link', 0),
(10, 'Convenio Colectivo - 120/75', '120-convenio.pdf', 1, '120-75', 'link', 0),
(11, 'Acta Acuerdo y Escala Salarial 2017', '120-acta-acuerdo-y-escala-salarial-2017.pdf', 2, '120-75', 'link', 0),
(14, 'Acta Acuerdo y Escala Salarial 2017', '459_actaacuerdoyescalasalarial_2017.pdf', 2, '459-06', 'link', 0),
(15, 'Convenio Colectivo - 459/06', '459-convenio.pdf', 1, '459-06', 'link', 0),
(16, 'Convenio Colectivo - 103/75', '103-convenio.pdf', 1, '103-75', 'link', 0),
(17, 'Acta Acuerdo y Escala Salarial 2017', '103_actaacuerdoyescalasalarial_2017.pdf', 2, '103-75', 'link', 0),
(19, 'Evolución Salarial', '#', 3, '108-75', 'link', 0),
(20, 'Acta Acuerdo y Escala Salarial 2017', '108-acta-acuerdo-y-escala-salarial-2017.pdf', 2, '108-75', 'link', 0),
(21, 'Convenio Colectivo - 108/75', '108-convenio.pdf', 1, '108-75', 'link', 0),
(22, 'Convenio Colectivo - 42/89', '42-convenio.pdf', 1, '42-89', 'link', 0),
(23, 'Acta Acuerdo y Escala Salarial 2017', '42-acta-acuerdo-y-escala-salarial-2017.pdf', 2, '42-89', 'link', 0),
(24, 'Evolución Salarial', '#', 3, '42-89', 'link', 0),
(25, 'Evolución Salarial', '#', 3, '107-75', 'link', 0),
(26, 'Acta Acuerdo y Escala Salarial 2017', '107_actaacuerdoyescalasalarial_2017.pdf', 2, '107-75', 'link', 0),
(27, 'Convenio Colectivo - 107/75', '107-convenio.pdf', 1, '107-75', 'link', 0),
(28, 'Convenio Colectivo - 743/16', '', 1, '743-16', 'link', 0),
(29, 'Acta Acuerdo y Escala Salarial 2017', '', 2, '743-16', 'link', 0),
(30, 'Evolución Salarial', '', 3, '743-16', 'link', 0),
(31, 'Acta Acuerdo y Escala Salarial 2017', '122-acta-acuerdo-y-escala-salarial-2017.pdf', 2, '122-75', 'link', 0),
(35, 'Evolución Salarial', 'http://atsa.com.ar/uploads/zip/cct122.zip', 3, '122-75', 'link', 1),
(36, 'Evolución Salarial', 'http://atsa.org.ar/uploads/zip/cct120.zip', 3, '120-75', 'link', 1),
(37, 'Evolución Salarial', 'http://atsa.org.ar/uploads/zip/cct459.zip', 3, '459-06', 'link', 1),
(38, 'Evolución Salarial', 'http://atsa.org.ar/uploads/zip/cct103.zip', 3, '103-75', 'link', 1),
(41, 'Ley Nacional de Empleo', 'ley-nacional-de-empleo.pdf', 7, 'leyes', 'link', 0),
(42, 'Sistema Integrado de Jubilaciones y Pensiones', 'sistema-integrado-de-jubilaciones-y-pensiones.pdf', 10, 'leyes', 'link', 0),
(43, 'Ley de Higiene y Seguridad del Trabajo', 'ley-de-higiene-y-seguridad-del-trabajo.pdf', 6, 'leyes', 'link', 0),
(44, 'Ley de Asignaciones Familiares', 'ley-de-asignaciones-familiares.pdf', 2, 'leyes', 'link', 0),
(45, 'Ley Sobre Riesgos de Trabajo', 'ley-sobre-riesgos-de-trabajo.pdf', 8, 'leyes', 'link', 0),
(46, 'Ley de Asociaciones Sindicales', 'ley-de-asociaciones-sindicales.pdf', 3, 'leyes', 'link', 0),
(47, 'Régimen Laboral', 'regimen-laboral.pdf', 9, 'leyes', 'link', 0),
(48, 'Ley de Contrato de Trabajo', 'ley-20744regimen-de-contrato-de-trabajo.pdf', 4, 'leyes', 'link', 0),
(49, 'Decreto Reglamentario Higiene y Seguridad del Trabajo', 'decreto-reglamentario-higiene-y-segurid-del-trabajo.pdf', 1, 'leyes', 'link', 0),
(50, 'Ley de Enfermería', 'ley-de enfermeria.pdf', 5, 'leyes', 'link', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `curso_ID` int(11) NOT NULL,
  `curso_slug` varchar(200) NOT NULL DEFAULT '',
  `curso_titulo` varchar(255) NOT NULL,
  `curso_resumen` varchar(250) NOT NULL DEFAULT '',
  `curso_metodologia` mediumtext NOT NULL,
  `curso_objgeneral` mediumtext NOT NULL,
  `curso_objespecifico` longtext NOT NULL,
  `curso_requisitos` mediumtext NOT NULL,
  `curso_imagen` varchar(200) NOT NULL DEFAULT '',
  `curso_archivo` varchar(200) NOT NULL DEFAULT '',
  `curso_certificado` text NOT NULL,
  `curso_cursada` text NOT NULL,
  `curso_lugar` text NOT NULL,
  `curso_horarios` text NOT NULL,
  `curso_destinatario` mediumtext NOT NULL,
  `curso_dataextra1` varchar(250) NOT NULL DEFAULT '',
  `curso_dataextra2` varchar(250) NOT NULL DEFAULT '',
  `curso_dataextra3` varchar(250) NOT NULL DEFAULT '',
  `curso_destacado` int(11) NOT NULL DEFAULT '0',
  `curso_orden` int(10) NOT NULL DEFAULT '0',
  `curso_tipo` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`curso_ID`, `curso_slug`, `curso_titulo`, `curso_resumen`, `curso_metodologia`, `curso_objgeneral`, `curso_objespecifico`, `curso_requisitos`, `curso_imagen`, `curso_archivo`, `curso_certificado`, `curso_cursada`, `curso_lugar`, `curso_horarios`, `curso_destinatario`, `curso_dataextra1`, `curso_dataextra2`, `curso_dataextra3`, `curso_destacado`, `curso_orden`, `curso_tipo`) VALUES
(1, 'asistencia-respiratoria-mecanica', 'Asistencia Respiratoria Mecánica', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual multimedia, prácticas de gabinete, debates y trabajos prácticos.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Que el alumno sea capaz de: Reconocer los comandos principales comunes a todos los respiradores y realizar programación básica: modalidad, frecuencia, volumen, fio2, peep, alarmas.</p><p>Realizar la técnica de armado del circuito de respirador aplicando criterios científicos e infectológicos.</p><p>Nombrar aspectos clínicos, gasométricos y ventilatorios que indiquen ARM, planificar cuidados de enfermería en el paciente con ARM y desarrollar acciones para las siguientes situaciones problemas: aumento de la presión en la vía aérea, autopeep, alarma de fuga o apnea, hipoventilación.</p>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'asistencia-respiratoria-mecanica.png', '', 'Certificado Oficial', '4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 1, 'formacion_tecnica'),
(2, 'arritmias-cardiacas', 'Arritmias Cardíacas', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual multimedia, prácticas de gabinete, debates y trabajos prácticos.', 'Que los alumnos adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la detección e identificación de los diferentes ritmos cardiacos.', '<p>Que el alumno sea capaz de:</p><ul><li>Mencionar los mecanismos arritmogénicos que originan los diferentes ritmos cardiacos</li><li>Identificar en un monitoreo simulado las arritmias cardiacas más frecuentes que se presentan en el paciente internado en cuidados críticos</li><li>Aplicar el análisis metódico propuesto en el curso a cada ritmo cardiaco.</li><li>Establecer el grado de descompensación de cada arritmia cardiaca y agruparlos en arritmias menores, mayores y mortales.</li><li>Establecer una secuencia de valoración de enfermería en función del tipo de arritmia presente en un paciente</li><li>Mencionar intervenciones de enfermería orientadas al paciente que presenta alteración del ritmo cardiaco.</li><li>Fundamentar la importancia del monitoreo cardíaco en función de la detección precoz de las arritmias cardiacas y el tratamiento inmediato con el objetivo de disminuir la mortalidad.</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'arritmias-cardiacas.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 2, 'formacion_tecnica'),
(3, 'educacion-para-enfermeria', 'Educación para Enfermería', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases prácticas con lectura y análisis crítico de textos, debate, estudio de casos, interpretación de roles y taller.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Que el destinatario sea capaz de:</p><ul></li>Reflexionar acerca de la función educadora cotidiana del técnico-profesional.</li><li>Comprender las características de la Metacomunicación en la tarea educativa</li><li>Apreciar el valor de las diferentes pedagogías utilizadas en función de la enseñanza en servicio.</li><li>Adquirir herramientas que le permitan realizar la selección de contenidos en función del destinatario.</li><li>Diseñar un proyecto educativo aplicable en los usuarios que cuida a diario, utilizando las herramientas adquiridas</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'educacion-enfermeria.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 3, 'formacion_tecnica'),
(4, 'control-de-infecciones', 'Control de Infecciones', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual  y prácticas en una Institución de Salud donde desarrollarán las habilidades y destrezas correspondientes.', 'Que los alumnos adquieran los conocimientos básicos de la especialidad y desarrollen habilidades técnicas y destrezas propias para desempeñarse como (auxiliar/asistente/ técnico) de un Enfermero en Control de Infecciones.', '<p>Que el alumno sea capaz de:</p><ul><li>Describir las definiciones de infecciones asociadas al cuidado de la salud (IACS) del Programa de Vigilancia de Infecciones Hospitalarias de Argentina (VIHDA), del Centers for Disease Control and Prevention (CDC) y National Healthcare Safety Network (NHSN).</li><li>Registrar denominadores y episodios infecciosos en forma manual y en Excel (PC)</li><li>Construir tasas de utilización y de infección asociadas a procedimientos invasivos y de sitio quirúrgico.</li><li>Medir la adherencia a las medidas de prevención de: Bacteriemias asociadas a catéter venoso central, Infecciones urinarias asociadas a sonda vesical, Neumonías asociadas a Asistencia Respiratoria Mecánica e Infecciones del Sitio Quirúrgico.</li><li>Conocer los mecanismos de resistencia microbiana e identificar los gérmenes multiresistentes más comunes.</li><li>Realizar relevamientos y actualización de los pacientes en aislamiento.</li><li>Medir la adherencia al uso de los Elementos de Protección Personal (EPP).</li><li>Explicar los distintos procedimientos de la Higiene Hospitalaria.</li><li>Controlar y medir el cumplimiento de la Higiene Hospitalaria.</li><li>Realizar Prevalencias y relevamientos de áreas.</li><li>Identificar los diferentes tipos de Residuos de Establecimientos de Salud (RES).</li><li>Controlar la segregación adecuada de los RES.</li><li>Identificar las medidas de prevención de los accidentes por punción.</li><li>Medir el cumplimiento de la Higiene de Manos en el personal de salud.</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'control-infecciones.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 4, 'formacion_tecnica'),
(5, 'cuidados-cardiologicos', 'Cuidados cardiológicos', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases Expositivas  teóricas y prácticas con participación activa del alumno.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Que el alumno sea capaz de:</p><ul><li>Mencionar los mecanismos que rigen el funcionamiento cardíaco</li><li>Identificar las patologías cardíacas prevalentes</li><li>Aplicar el proceso de atención de enfermería a pacientes con necesidades cardiológicas insatisfechas</li><li>Establecer el grado de gravedad que revisten algunas patologías cardíacas</li><li>Mencionar intervenciones de enfermería orientadas al paciente que presenta alteración cardíaca</li><li>Fundamentar la importancia del monitoreo cardíaco en función de la detección precoz de problemas cardiacos y el tratamiento inmediato con el objetivo de disminuir la mortalidad</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'cuidados-cardiologicos.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 5, 'formacion_tecnica'),
(6, 'coaching-para-enfermeras', 'Coaching para enfermeras', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual multimedia, prácticas de gabinete, debates y trabajos prácticos.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', 'none', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'enfermeria.jpg', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 6, 'formacion_tecnica'),
(7, 'electrocardiografia', 'Electrocardiografia', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual y prácticas.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Que el estudiante logre:</p><ul><li>Mencionar los mecanismos que originan los diferentes ritmos cardiacos</li><li>Identificar en un monitoreo simulado las variaciones en el electrocardiograma normal.</li><li>Aplicar el análisis metódico propuesto en el curso a cada ritmo cardiaco.</li><li>Establecer el grado de descompensación de cada arritmia cardiaca y agruparlos en arritmias menores, mayores y mortales.</li><li>Establecer una secuencia de valoración de enfermería en función del tipo de arritmia presente en un paciente</li><li>Mencionar intervenciones de enfermería orientadas al paciente que presenta alteración del ritmo cardiaco.</li><li>Fundamentar la importancia del monitoreo cardíaco en función de la detección precoz de las arritmias cardiacas y el tratamiento inmediato con el objetivo de disminuir la mortalidad.</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'electrocardiografia.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 7, 'formacion_tecnica'),
(8, 'computacion-para-enfermeria', 'Computación para enfermería', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual y prácticas en la PC.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Finalizada la cursada del taller, el estudiante será capaz de:</p><ul><li>Organizar programas y archivos en su PC.</li><li>Interactuar en la red de Internet, seleccionando información profesional.</li><li>Confeccionar documentos con el Procesador de Textos cuya apariencia sea profesional</li><li>Diseñar planillas de cálculo inteligentes orientadas a la Estadística</li><li>Confeccionar una presentación audiovisual integrando técnicas multimediales</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'computacion-enfermeras.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 8, 'formacion_tecnica'),
(9, 'uti-basico', 'UTI (nivel básico)', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual, prácticas de gabinete, debates y trabajos prácticos.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Que el alumno sea capaz de:</p><ul><li>Describir la anatomofisiología de las afecciones más frecuentes  que generen interacción en áreas críticas.</li><li>Planificar y fundamentar acciones de enfermería a  en las enfermedades prevalentes en cuidados intensivos</li><li>Describir y realizar la técnica de RCP básica.</li><li>Mencionar signos y síntomas que indiquen alteración aguda respiratoria, cardiológica o neurológica</li><li>Realizar lectura e interpretación de gasometría arterial</li><li>Proporcionar ventilación pulmonar adecuada con bolsa resucitadora (ambu)</li><li>Identificar mediante auscultación los ruidos respiratorios.</li><li>Identificar a través de monitor cardiaco las arritmias mortales.</li><li>Describir un entorno humanizado óptimo en las áreas de cuidados intensivos</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'uti-basico.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 9, 'formacion_tecnica'),
(10, 'uti-avanzado', 'UTI (nivel avanzado)', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Presencial. Clases teóricas expositivas con material audiovisual, prácticas de gabinete y trabajos prácticos.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<p>Que el alumno sea capaz de:</p><ul><li>Describir los procesos anatomofisiológicos que intervienen en la electrofisiología cardiaca, respiratoria normal y regulación hemodinámica y neurológica.</li><li>Exponer los  aspectos fisiológicos que fundamentan el funcionamiento del balón de contrapulsación.</li><li>Nombrar e identificar en un respirador los comandos comunes.</li><li>Describir el seteo inicial de un respirador</li><li>Nombrar los elementos necesarios para la medición de parámetros hemodinámicos a través de  catéter de Swan Ganz.</li><li>Relacionar perfiles hemodinámicos con procesos patológicos.</li><li>Identificar a través de monitor cardiaco las arritmias mortales.</li><li>Establecer diferencias entre cardioversión y desfibrilación.</li><li>Describir la técnica de choque eléctrico.</li><li>Mencionar intervenciones de enfermería en la administración de fármacos de uso frecuente en las Unidades de cuidados intensivos</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'uti-avanzado.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 10, 'formacion_tecnica'),
(11, 'endoscopia-digestiva', 'Endoscopía digestiva', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Consta de una instancia áulica y prácticas en laboratorio.', 'Formar profesionales capacitados en los conocimientos y responsabilidades para responder a  la exigencia actual de la endoscopia. / Crear equipos de trabajos interdisciplinarios para llevar a cabo la actividad. / Fomentar la excelencia de los servicios de Enfermería en endoscopia.', '<ul><li>Enseñanza de la anatomía del aparato digestivo (esófago, estómago, intestino delgado, colon, páncreas e hígado)</li><li>Descripción, discusión de las indicaciones, contraindicaciones y consideraciones de enfermería relacionadas con la endoscopia digestiva alta, baja y colangiografia retrograda.</li><li>Enseñanza de la composición de los diversos endoscopios, de las técnicas de reprocesamiento de los equipos y accesorios, control y prevención de las infecciones.</li><li>Enseñanza de la composición de los distintos endoscopios, con sus diversas técnicas de mantenimiento y prevención.</li><li>Generar herramientas para la educación al paciente y familia sobre su proceso de salud y enfermedad.</li><li>Promover la unificación de registros y documentación cumplimentando la legislación actual.</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'endoscopia-dijestiva.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 11, 'formacion_tecnica'),
(12, 'colangiopancreatografia', 'Colangiopancreatografia', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Consta de una instancia áulica y prácticas en laboratorio.', 'Formar profesionales capacitados en los conocimientos y responsabilidades para responder a  la exigencia actual de la endoscopia. Crear equipos de trabajos interdisciplinarios para llevar a cabo la actividad. Fomentar la excelencia de los servicios de Enfermería en endoscopia.', '<ul><li>Enseñanza de la anatomía del aparato digestivo (esófago, estómago, intestino delgado, colon, páncreas e hígado)</li><li>Descripción, discusión de las indicaciones, contraindicaciones y consideraciones de enfermería relacionadas con la endoscopia digestiva alta, baja y colangiografía retrograda.</li><li>Enseñanza de la composición de los diversos endoscopios, de las técnicas de reprocesamiento de los equipos y accesorios, control y prevención de las infecciones.</li><li>Enseñanza de la composición de los distintos endoscopios, con sus diversas técnicas de mantenimiento y prevención.</li><li>Generar herramientas para la educación al paciente y familia sobre su proceso de salud y enfermedad.Promover la unificación de registros y documentación cumplimentando la legislación actual</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'colangiopancreatografia.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 0, 12, 'formacion_tecnica'),
(13, 'enfermeria-en-cuidados-cardiologicos-avanzados', 'Enfermería en cuidados cardiológicos avanzados', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual  y prácticas.', 'Que los alumnos adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente con patología cardiovascular en estado crítico.', '<p>Que el alumno sea capaz de:</p><ul><li>Describir la anatomofisiología del aparato cardiovascular y relacionarla con las patologías cardiovasculares</li><li>Mencionar e identificar  signos y síntomas que indiquen alteración cardiológica.</li><li>Mencionar el algoritmo de tratamiento del IAM, insuficiencia cardiaca y EAP</li><li>Aplicar la etapa de valoración del proceso de atención de enfermería (PAE) al paciente con patología cardiovascular</li><li>Describir las manifestaciones anterógradas y retrogradas de la falla cardiaca.</li><li>Interpretar las curvas enzimáticas en los síndromes isquémicos</li><li>Aplicar interpretación metódica en las arritmias mortales.</li><li>Programar el cardiodesfibrilador para realizar un choque eléctrico.</li><li>Interpretar y relacionar con cuadro clínicos diferentes perfiles hemodinámicos.</li><li>Interpretar las curvas del balón de contrapulsación.</li><li>Mencionar acción, preparación, administración y cuidados enfermeros en los principales fármacos usados en unidad coronaria</li><li>Describir un entorno humanizado en el desempeño del personal de enfermería en Unidad coronaria</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'enfermeria-cuidados-cardiologicos-avanzados.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 1, 13, 'formacion_tecnica'),
(14, 'enfermeria-situaciones-criticas', 'Enfermeria en situaciones criticas', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Simulaciones clínicas con maniquíes, método de casos y exposición dialogada. En cada encuentro se desarrollaran contenidos teóricos que fundamentarán las simulaciones y técnicas a desarrollar.', 'Los Objetivos Generales son que los estudiantes adquieran y/o actualicen los conocimientos científicos, humanitarios y habilidades en la atención del paciente en estado crítico sometido en asistencia respiratoria mecánica.', '<ul><li>Describir el algoritmo universal para RCP según normas internacionales 2010</li><li>Permeabilizar la vía aérea mediante dispositivo de cánula de Guedel</li><li>Ventilar con bolsa resucitadora según normas actuales.</li><li>Preparar el equipo para manejo avanzado de la vía aérea.</li><li>Realizar intubación orotraqueal en muñeco de simulación de baja dificultad.</li><li>Verificar la correcta colocación del tubo endotraqueal mediante auscultación pulmonar.</li><li>Sujetar en forma segura el tubo endotraqueal</li><li>Describir la secuencia de pasos para realizar un choque eléctrico.</li><li>Realizar choque eléctrico en muñeco de práctica según secuencia  mostrada.</li><li>Mencionar las drogas de primera línea que se usan en el paro cardiorrespiratorio y en el manejo de la vía aérea.</li><li>Mencionar presentación, efectos, dosis, vía de administración y cuidados de enfermería de los fármacos de primera línea.</li><li>Realizar la colocación de collar de estabilización cervical</li><li>Efectuar valoración inicial en el politraumatizado en fase intrahospitalaria</li><li>Realizar las maniobras de manejo inicial del politraumatizado en fase intrahospitalaria.</li><li>Describir un entorno humanizado en el desempeño del personal de enfermería en las situaciones críticas.</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'rol-enfermeria-situaciones-criticas.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', '', '', '', '', 1, 14, 'formacion_tecnica'),
(15, 'densitometria-osea', 'Densitometria osea', 'Modalidad Presencial. 1 vez por semana – 4 meses', 'Clases teóricas expositivas con material audiovisual  y prácticas en instituciones de salud.', 'Que los alumnos adquieran los conocimientos técnicos teórico-prácticos para poder   llevar adelante un Servicio de Densitometría Ósea realizando estudios de calidad.', '<ul><li>Que los alumnos conozcan conceptos clínicos de calidad ósea.</li><li>Que conozcan la evolución de los equipos, sus fundamentos físicos, los funcionamientos básicos y las diferencias entre las diferentes marcas de Densitómetros.</li><li>Ofrecerles la capacitación teórico-técnica para operar equipos de Densitometría Ósea brindando los conocimientos apropiados para que el profesional obtenga imágenes correctas para un diagnóstico certero.</li><li>Que el alumno sea capaz de realizar, analizar, comparar y entender la interpretación clínica un estudio de Densitometría Ósea.</li><li>Ofrecerle al alumno conocimientos para un correcto control de calidad de equipos y técnicos de Densitometría Ósea.</li><li>Que el alumno adquiera las habilidades para el cuidado de los pacientes de un Servicio de Densitometría Ósea.</li></ul>', 'Original y fotocopia de: DNI, Último recibo de sueldo, Carnet sindical, Titulo técnico o profesional.', 'densitometria-osea.png', '', 'Certificado Oficial', 'Cursada 4 meses - 1 vez por semana', 'Alberti 191 - C.A.B.A', ' ', 'Únicamente Técnicos Radiólogos y Licenciados en Producción de Bioimágenes con título habilitant', '', '', '', 1, 15, 'formacion_tecnica'),
(16, '', 'Curso de masajes terapéuticos- Nivel Básico', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 1, 'no_formal'),
(18, '', 'Curso de masajes terapéuticos- Nivel Avanzado', ' ', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 2, 'no_formal'),
(25, '', 'Curso de cosmetología - Nivel básico', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 3, 'no_formal'),
(26, '', 'Curso de cosmetología - Nivel Avanzado', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 4, 'no_formal'),
(27, '', 'Curso de manicuría', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 5, 'no_formal'),
(28, '', 'Inglés Nivel inicial', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 6, 'no_formal'),
(29, '', 'Inglés Nivel Avanzado', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 7, 'no_formal'),
(30, '', 'Facturación', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 8, 'no_formal'),
(31, '', 'Liquidación de sueldos y jornales', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 9, 'no_formal'),
(32, '', 'Computación Curso Junior', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 10, 'no_formal'),
(33, '', 'Computación Curso Senior', '', '', '', '', '', '', '', '', '', '4 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 11, 'no_formal'),
(34, '', 'Power Point e internet', '', '', '', '', '', '', '', '', '', '3 meses - 1 vez por semana', '2 horas reloj', '', '', '', '', 0, 12, 'no_formal'),
(35, '', ' Universidad Isalud', '', '', '', '       <p>A partir de este convenio tanto los Técnicos en Enfermería como los Técnicos Radiólogos pueden obtener su título de grado: la Licenciatura en Enfermería y la Licenciatura en Producción de Bioimágenes. Además, ofrecemos la Especialidad en Cuidados críticos del adulto y anciano para los Licenciados en Enfermería y la Profesionalización para los Auxiliares.</p>\n<h3>Licenciatura en Enfermería</h3>\n<p>El Ciclo para la Licenciatura en Enfermería busca proveer de herramientas a los estudiantes para su consolidación como profesionales expertos, comprometidos y actualizados de manera que puedan responder a las demandas  que plantean los diversos contextos en los que desarrolle la actividad, no sólo en el aspecto técnico sino en lo actitudinal y en lo ético-profesional.</p>\n<p><strong>Título: </strong><br /> Licenciado en Enfermería – Ciclo de Licenciatura. Resolución Nº 576/10 Ministerio de Educación, ciencia y Técnica. Reconocimiento Oficial</p>\n<p><strong>Duración: </strong><br /> 2 años</p>\n<p><strong>Requisitos de ingreso</strong></p>\n<ul>\n<li class=\"ui-corner-left\">-Solicitar turno de Entrevista</li>\n<li class=\"ui-corner-left\">-Título secundario (original y copia)</li>\n<li class=\"ui-corner-left\">-Título de Enfermero Profesional/Universitario (original y copia)</li>\n<li class=\"ui-corner-left\">-DNI (original y copia)</li>\n<li class=\"ui-corner-left\">-2 fotos 4x4</li>\n<li class=\"ui-corner-left\">-Certificado médico de aptitud física</li>\n<li class=\"ui-corner-left\">-Último Recibo de Sueldo</li>\n<li class=\"ui-corner-left\">-Carnet Sindical</li>\n</ul>\n<h3>Licenciatura en Producción de Bioimágenes</h3>\n<p>El Licenciado en Producción de Bioimágenes es un profesional de la salud capaz de desarrollar las técnicas y habilidades adecuadas para brindar calidad y seguridad en las diferentes áreas del Diagnóstico por Imágenes. Así mismo es competente en el conocimiento de la anatomía, fisiología y patología y su expresión en las imágenes. Es capaz de producir imágenes aptas para el diagnóstico médico a partir de la aplicación de técnicas de procesamiento de alta complejidad. También posee las competencias para asesorar en el diseño, planificación y gestión de servicios de Diagnóstico por Imágenes y colaborar en la implementación de los criterios de la radio protección y bioseguridad.</p>\n<p><strong>Título: </strong><br /> Licenciado en Producción de Bioimágenes (Nro. de Expediente 214)</p>\n<p><strong>Duración: </strong><br /> 2 años</p>\n<p><strong>Requisitos de ingreso</strong></p>\n<ul>\n<li class=\"ui-corner-left\">-Título terciario o universitario de Técnico Radiólogo o equivalente otorgado por universidades públicas o privadas o institutos de nivel terciario reconocidos por el Ministerio de Salud y el Ministerio de Educación de la Nación. (original y copia)</li>\n<li class=\"ui-corner-left\">-Poseer una formación previa de al menos de dos años de duración, con una carga horaria de 1400 hs o más.</li>\n<li class=\"ui-corner-left\">-Título secundario (original y copia)</li>\n<li class=\"ui-corner-left\">-DNI (original y copia)</li>\n<li class=\"ui-corner-left\">-2 fotos 4x4</li>\n<li class=\"ui-corner-left\">-Certificado médico de aptitud física</li>\n<li class=\"ui-corner-left\">-Último Recibo de Sueldo</li>\n<li class=\"ui-corner-left\">-Carnet de afiliado a ATSA Bs. As.</li>\n</ul>\n<h3>Profesionalización de Auxiliares</h3>\n<p>El nuevo profesional enfermero requiere de una sólida formación que le permita interactuar con colegas y otros profesionales en equipos interdisciplinarios, lo motive a la investigación, reflexión y acción sobre la propia práctica, con atención en las necesidades de los pacientes y la comunidad. Por eso, la Universidad ISALUD y FATSA proponen abordar científicamente la realidad socio sanitaria, de manera comprometida, para impulsar la formulación de políticas y decisiones que promuevan cambios culturales y organizacionales vinculados con el que-hacer del enfermero.</p>\n<p><strong>Título: </strong><br /> Enfermero Universitario</p>\n<p><strong>Duración: </strong><br /> 3 años</p>\n<p><strong>Requisitos de ingreso</strong></p>\n<ul>\n<li class=\"ui-corner-left\">-Ser mayor de 25 años</li>\n<li class=\"ui-corner-left\">-Poseer título secundario debidamente legalizado. En caso de poseer solo el primario el aspirante podrá realizar un curso de nivelación y realizar un examen de ingreso ( lo posibilita el Art. 7mo de la Ley Nacional de Educación Superior)</li>\n<li class=\"ui-corner-left\">-Tener más de 3 años de recibido/a de auxiliar de enfermería de escuela o instituto reconocidos oficialmente.</li>\n<li class=\"ui-corner-left\">-Contar con más de 3 años de experiencia laboral.</li>\n<li class=\"ui-corner-left\">-Estar trabajando en la actualidad</li>\n<li class=\"ui-corner-left\">-Último Recibo de Sueldo</li>\n<li class=\"ui-corner-left\">-Carnet sindical</li>\n</ul>\n<h3>Especialización en Enfermería en Cuidados Críticos del adulto y anciano</h3>\n<p>La Enfermería en Cuidados Críticos se encuentra en la actualidad en un pico de relevancia social debido, principalmente, a la evolución tecnológica y las nuevas posibilidades que surgen para brindar atención efectiva al individuo que se encuentra cursando una situación crítica en su estado de salud, con la aplicación eficaz de recursos humanos y materiales.<br /> Dicha situación plantea la necesidad de actualizar, reorganizar y formar profesionales de enfermería con conocimientos, actitudes y habilidades específicas que permitan brindar cuidados de enfermería de calidad a las personas con patologías graves que requieran internación en cuidados críticos.</p>\n<p><strong>Título: </strong><br /> Especialización en Enfermería en Cuidados Críticos del Adulto y Anciano, según lo aprobado por Resolución del Consejo. Superior N° 01/11. Resoluciones del Consejo Académico N° 03/11 y N° 43/11</p>\n<p><strong>Duración: </strong><br /> 2 años</p>\n<p><strong>Requisitos de ingreso</strong></p>\n<ul>\n<li class=\"ui-corner-left\">-DNI Original y fotocopia de la 1ª y 2ª hoja</li>\n<li class=\"ui-corner-left\">-Título de grado original y copia perfectamente legible anverso y reverso, Curriculum Vitae (no más de 5 carillas).</li>\n<li class=\"ui-corner-left\">-2 Fotos tipo carnet 4 X 4.</li>\n<li class=\"ui-corner-left\">-Último Recibo de Sueldo</li>\n<li class=\"ui-corner-left\">-Carnet sindical</li>\n</ul>', '', '', '', '', '', '', '', '', '', '', '', 0, 1, 'universitarios'),
(36, '', 'Universidad Abierta Inteamericana', '', '', '', '  <p>A través de Extensión Universitaria ofrecemos el Curso de Auxiliar de Farmacia, pensado para reconvertir al personal idóneo que trabaja en la farmacia hospitalaria y capacitar a nuevos trabajadores que estén interesados en esta área.</p>\n<h3>Auxiliar de farmacia</h3>\n<p><strong>OBJETIVOS: </strong><br /> Fármacos y materiales biomédicos cada vez más sofisticados requieren que se gestionen, dispensen y almacenen según estrictos procedimientos que garanticen seguridad y costo-eficiencia.<br /> Para cumplir con lo anterior, la farmacia actual requiere de auxiliares formados con rigor académico en las distintas disciplinas farmacéuticas y la capacidad de aplicar y relacionar los conocimientos en beneficio del paciente.<br /> Este curso tiene como objetivo que el alumno logre las premisas mencionadas, lo que le permitirá desempeñarse con éxito en un mercado creciente y altamente competitivo.</p>\n<p><strong>CARGA HORARIA: </strong><br /> El curso tendrá una duración de 77 horas y media</p>\n<p><strong>Requisitos</strong></p>\n<ul>\n<li class=\"ui-corner-left\">-Carnet sindical</li>\n<li class=\"ui-corner-left\">-DNI (Original y copia)</li>\n</ul>', '', '', '', '', '', '', '', '', '', '', '', 0, 2, 'universitarios'),
(37, '', 'Fundación Docencia e Investigación para la Salud', '', '', '', '<p>A partir de una alianza con la Confederaci&oacute;n de Cl&iacute;nicas y Sanatorios (CONFECLISA), nace la Fundaci&oacute;n Docencia e Investigaci&oacute;n para la Salud con el objetivo de lograr la educaci&oacute;n e instrucci&oacute;n de todos los trabajadores de la salud mediante la ense&ntilde;anza en todos los niveles del conocimiento, que les permita lograr habilidades y destrezas para el ejercicio de oficios y profesiones.</p>\n<p>Con el fin de cumplimentar lo enunciado anteriormente y para asegurar la mayor idoneidad en el mejoramiento de los niveles de formaci&oacute;n y capacitaci&oacute;n, la Fundaci&oacute;n ha creado el Instituto Superior de Ense&ntilde;anza &ldquo;Fundaci&oacute;n Docencia e Investigaci&oacute;n para la Salud&rdquo;, que ofrece la posibilidad de seguir estudios de Nivel Superior No Universitario en forma gratuita en las Carreras T&eacute;cnicas de Instrumentaci&oacute;n Quir&uacute;rgica, Hemoterapia, Radiolog&iacute;a y Laboratorio.</p>\n<p>Las Carreras son exclusivas para afiliados al Sindicato y la Obra Social.</p>\n<ul>\n<li class=\"ui-corner-left\"><strong>T&eacute;cnico Superior en Hemoterapia</strong><br /> Duraci&oacute;n: 3 a&ntilde;os</li>\n<li class=\"ui-corner-left\"><strong>T&eacute;cnico Superior de Laboratorio</strong><br /> Duraci&oacute;n: 3 a&ntilde;os</li>\n<li class=\"ui-corner-left\"><strong>T&eacute;cnico Superior en Instrumentaci&oacute;n Quir&uacute;rgica</strong><br /> Duraci&oacute;n: 3 a&ntilde;os</li>\n<li class=\"ui-corner-left\"><strong>T&eacute;cnico Superior en Radiolog&iacute;a</strong><br /> Duraci&oacute;n: 3 a&ntilde;os</li>\n<li class=\"ui-corner-left\"><strong>T&eacute;cnico Superior en Pr&aacute;cticas Cardiol&oacute;gicas</strong><br /> Duraci&oacute;n: 3 a&ntilde;os</li>\n</ul>\n<h3>Requisitos:</h3>\n<ul>\n<li class=\"ui-corner-left\">-Original y copia del DNI</li>\n<li class=\"ui-corner-left\">-Recibo de sueldo</li>\n<li class=\"ui-corner-left\">-Carnet sindical</li>\n<li class=\"ui-corner-left\">-Carnet Obra social</li>\n<li class=\"ui-corner-left\">-Partida de nacimiento</li>\n</ul>', '', '', '', '', '', '', '', '', '', '', '', 0, 3, 'universitarios'),
(41, 'Ciencias de la Salud', 'Técnico Superior en Enfermería', 'RESOL-2016-189-SSPLINED', '<p>Hace 27 años nació la Escuela de Enfermería del Sindicato de Trabajadores de la Sanidad, filial Bs. As, con la misión de brindar una formación a todos aquellos que quieran desarrollarse en la actividad. Durante estos 27 años hemos logramos un alto nivel de contenidos y metodologías de capacitación, así como una gran cantidad de inscriptos por año.</p>\n<p>Mucho ha pasado desde el 2 de Abril de 1938 que, bajo la conducción del gremio, los directivos y el cuerpo docente se inauguraba la Escuela de Enfermeros y Enfermeras La Cruz del Sacrificio. Por diferentes acontecimientos históricos en el año 1968 la escuela cerró y luego reinició sus actividades en 1990 cambiando su nombre por el actual: Instituto Amado Olmos.</p>\n<p>La adecuación de sus Programas y de los requisitos a las normativas vigentes le permitió obtener el reconocimiento como Instituto oficial. A partir de entonces, fueron egresando de la Escuela auxiliares de enfermería y enfermeros profesionales del ámbito público, privado y fundamentalmente, de obras sociales, lo cual amplió y diversificó el conjunto de los mismos. Siempre manteniendo la premisa de transformar y/o reemplazar al personal mayoritariamente empírico.Así siguió desarrollándose y creciendo nuestro Instituto Amado Olmos, que nos enorgullece como trabajadores de la Sanidad y como integrantes de una comunidad.</p>', '<p>El Instituto Amado Olmos tiene como objetivo la formaci&oacute;n de futuros enfermeros. A trav&eacute;s de la Carrera de T&eacute;cnico Superior en Enfermer&iacute;a, todos los que tengan inter&eacute;s en esta profesi&oacute;n pueden capacitarse con los que m&aacute;s saben de salud, los trabajadores de la Sanidad.</p>', '<ul>\n<li>Alvarado, Christian Andres - <em>instructor</em></li>\n<li>Caballero, Leopoldo - <em>instructor</em></li>\n<li>Fernandez, Eusebio - <em>instructor</em></li>\n<li>Fernandez,Fernando - <em>instructor</em></li>\n<li>Galindo, Osman Diego - <em>instructor</em></li>\n<li>Lera Mamani, Santos Daniel - <em>instructor</em></li>\n<li>Moreno, Silvina - <em>instructor</em></li>\n<li>Muguruza, Adriana - <em>instructor</em></li>\n<li>Osorio Delgado, Rosa Isabel - <em>instructor</em></li>\n<li>Potes, Claudia - <em>instructor</em></li>\n<li>Quevedo, Mirian - <em>instructor</em></li>\n<li>Ravelli, Silvia - <em>instructor</em></li>\n<li>Romano, Lidia Ester - <em>instructor</em></li>\n<li>Villafañe,Pablo Ramón - <em>instructor</em></li>\n<li>Aleksijnaite, Gabriela Beatriz - <em>Prof</em></li>\n<li>Arias, Pedro Gustavo - <em>Prof</em></li>\n<li>Barrios,Rufino Leandro - <em>Prof</em></li>\n<li>Benitez, Horacio Rubén - <em>Prof</em></li>\n<li>Benito , Maria Carina - <em>Prof</em></li>\n<li>Bonfil, Alberto Ricardo - <em>Prof</em></li>\n<li>Chizzolini, Jorge Luis - <em>Prof</em></li>\n<li>Consoni, Monica - <em>Prof</em></li>\n<li>Consoni, Silvia - <em>Prof</em></li>\n<li>Fiss, Patricia - <em>Prof</em></li>\n<li>Giron, Sandra - <em>Prof</em></li>\n<li>Kohl, Alejandro - <em>Prof</em></li>\n<li>Lumerman, Alejandro - <em>Prof</em></li>\n<li>Mele, Maria Antonieta - <em>Prof</em></li>\n<li>OZAN,Natalia Lucia - <em>Prof</em></li>\n<li>Quiroga,Patricia Alejandra - <em>Prof</em></li>\n<li>Rodriguez Ucha , Estela Maris - <em>Prof</em></li>\n<li>Sanchez Albistur , Patricia - <em>Prof</em></li>\n<li>Sosa, Griselda Noemi - <em>Prof</em></li>\n<li>Zazzarino, Maria Elena - <em>Prof</em></li>\n</ul>', '<p>Las prácticas profesionales tienen dos momentos: uno está referido al desarrollo en el gabinete y el otro son las prácticas en campo, que se realizan en diferentes hospitales, sanatorios, clínicas y en comunidad.</p>\n<p>El gabinete se realiza en un espacio simulado para que el estudiante pueda articular la teoría con la práctica. Estas prácticas simuladas, organizadas y diseñadas en forma de rotatorio permiten a los estudiantes ir aplicando los diferentes conocimientos que van adquiriendo durante la formación.</p>\n<p>Estas prácticas están atravesadas por un Modelo de Atención de Enfermería que la Escuela adhiere. Tiene presente que para poder actuar con criterio profesional es necesario una fuerte argumentación conceptual, que guiará la identidad de nuestros egresados y de la enfermería en general: el ser, el saber y el hacer. Nuestro Gabinete cuenta con recursos tanto tecnológicos como materiales que permiten la adquisición de competencias propias de la ciencia.</p>', 'enfermeria-amado-olmos.jpg', 'plan-de-estudios-enfermeria.pdf', '<ul>\n<li>Héctor Ricardo Daer – Secretario General de ATSA Bs. As. Representante Legal del Instituto Amado Olmos Lic.</li>\n<li>Cristina Quevedo – Secretaria de Cultura de ATSA Bs. As.</li>\n<li>Lic. Mónica Consoni – Sub-Secretaria de Cultura de ATSA Bs. As.</li>\n<li>Prof. Lic. Gabriela Felippa – Rectora del Instituto Amado Olmos.</li>\n<li>Prof. Mg. Carlos Barrionuevo – Vicerrector del Instituto Amado Olmos.</li>\n<li>Lic. Gabriela Piccardo – Sec. Académica del Instituto Amado Olmos</li>\n</ul>', 'Elevar el nivel cultural, moral y técnico profesional de nuestros compañeros esto es y será una tarea básica de nuestra obra diaria. Pretendemos dar a los hombres y mujeres que concurran a nuestra Escuela un instrumento de defensa en la lucha por la vida y cumplimos con un imperativo patriótico de educar y preparar técnicamente a los trabajadores. ', 'Alberti 191 - C.A.B.A', '<p>Turno mañana: 7.30 a 13.20<br />Turno Tarde: 15 a 20.50</p>', '<p>Saavedra 166. ATSA,<br />Secretaría de Culrura, PB.<br />Horario de Atención: 10 a 18 horas</p>', '3 años', 'Presencial', 'Dirección General de Enseñanza de gestión Privada, dependiente del Ministerio de Educación de la C.A.B.A', 0, 0, 'instituto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `deportes_id` int(11) NOT NULL,
  `deportes_texto` varchar(250) NOT NULL DEFAULT '',
  `deportes_url` varchar(250) NOT NULL,
  `deportes_orden` int(11) NOT NULL DEFAULT '0',
  `deportes_seccion` varchar(100) NOT NULL DEFAULT '',
  `deportes_post_type` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`deportes_id`, `deportes_texto`, `deportes_url`, `deportes_orden`, `deportes_seccion`, `deportes_post_type`) VALUES
(1, 'Reglamento', '', 4, 'reglamento', 'section'),
(3, 'Tabla de Goleadores de Torneos', '', 3, 'goleadores', 'section'),
(4, 'Tablas de posiciones de torneo liguilla fútbol masculino 5, fútbol masculino 11 (A y B) y voley fem (A)', '', 2, 'tablas', 'section'),
(5, 'Calendario con fechas de torneos/amistosos/eventos', '', 1, 'calendario', 'section'),
(6, 'Reglamento Fútbol 11', 'reglamento-futbol-11.pdf', 2, 'reglamento', 'link'),
(7, 'Reglamento Fútbol 5', 'reglamento-futbol-5.pdf', 1, 'reglamento', 'link'),
(8, 'Reglamento Voley Femenino', 'reglamento-voley-femenino.pdf', 3, 'reglamento', 'link'),
(9, 'Goleadores Fútbol 11 A', 'goleadores.pdf', 0, 'goleadores', 'link'),
(10, 'Tabla de posiciones Fútbol 5', 'tabla-posiciones-futbol-5.pdf', 1, 'tablas', 'link'),
(11, 'Tabla de posiciones Fútbol 11 (A)', 'posiciones-futbol-a.pdf', 2, 'tablas', 'link'),
(12, 'Tabla de posiciones Voley', 'posiciones-voley.pdf', 4, 'tablas', 'link'),
(13, 'Tabla de posiciones Fútbol 11 (B)', 'posiciones-futbol-b.pdf', 3, 'tablas', 'link'),
(14, 'Resultados Voley 2da Categoria', 'resultados-1era-fecha-2da-categoria-voley.pdf', 1, 'calendario', 'link'),
(15, 'Resultados Voley 1ra Categoria', 'resultados-1era-fecha-1era-categoria-voley.pdf', 2, 'calendario', 'link'),
(16, '5ta y 6ta Fecha Voley', '5tay6ta-fecha-voley.pdf', 3, 'calendario', 'link'),
(17, 'Fútbol 11 (A) Cuartos de Final', 'futbol-11-a-cuartos.pdf', 4, 'calendario', 'link'),
(18, '6º Fecha Fútbol 11 (A)', '6ta-fecha-futbol-11-a.pdf', 5, 'calendario', 'link'),
(19, '5º FECHA FÚTBOL 11 (B)', '5ta-fecha-futbol-11-b.pdf', 6, 'calendario', 'link'),
(20, '5º FECHA FÚTBOL 11 (A)', '5ta-fecha-futbol-11-a.pdf', 7, 'calendario', 'link'),
(21, '4º FECHA FÚTBOL 11 (B)', '4ta-fecha-futbol-11-b.pdf', 9, 'calendario', 'link'),
(22, '4º FECHA FÚTBOL 11 (A)', '4ta-fecha-futbol-11.pdf', 10, 'calendario', 'link'),
(23, '5º Fecha Liguilla Fútbol 5', '5-fechaliguilla-clasificatoria-futbol-5.pdf', 8, 'calendario', 'link'),
(24, '3º Fecha Fútbol 11 (B)', '3-fecha-futbol-b.pdf', 11, 'calendario', 'link'),
(25, '3º Fecha Fútbol 11 (A)', '3-fecha-futbol-a.pdf', 12, 'calendario', 'link'),
(26, '2º Fecha Fútbol 11 (B)', '2-fecha-futbol-11-b.pdf', 13, 'calendario', 'link');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tag_posts` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`tag_id`, `tag_name`, `tag_posts`) VALUES
(1, 'ATSA', 'a:2:{i:0;s:2:\"21\";i:1;i:26;}'),
(22, 'INTERNACIONALES', 'a:1:{i:0;s:2:\"24\";}'),
(23, 'NACIONALES', 'a:1:{i:0;s:2:\"23\";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `hotel_ID` int(10) UNSIGNED NOT NULL,
  `hotel_location` varchar(100) NOT NULL,
  `hotel_titulo` varchar(200) NOT NULL,
  `hotel_descripcion` text NOT NULL,
  `hotel_servicios` mediumtext NOT NULL,
  `hotel_dataextra` varchar(100) NOT NULL DEFAULT 'hotel',
  `hotel_contingente` mediumtext NOT NULL,
  `hotel_icontipo` varchar(200) NOT NULL,
  `hotel_iconservicios` varchar(200) NOT NULL,
  `hotel_thumnail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `hoteles`
--

INSERT INTO `hoteles` (`hotel_ID`, `hotel_location`, `hotel_titulo`, `hotel_descripcion`, `hotel_servicios`, `hotel_dataextra`, `hotel_contingente`, `hotel_icontipo`, `hotel_iconservicios`, `hotel_thumnail`) VALUES
(1, 'Hotel Otto Calace', 'La Falda, Córdoba', 'La Falda es una hermosa y tranquila Ciudad situada a 791 km. de la Ciudad de Córdoba, ubicada en el Centro del Valle de Punilla, sobre el faldeo de las Sierras Chicas. Allí se encuentra nuestro Hotel Otto Calace, donde podrás relajarte y disfrutar de la naturaleza.', 'Habitaciones con baño privado<br>Cancha de fútbol y vóley<br>Pileta de natación para grandes y chicos<br>Desayuno Continental y Cena<br>Estacionamiento propio<br>Sala de TV, Video, Cine y Peliculas.Snack bar y Peluqería<br>Servicio de Emergencias. Área Protegida<br>Spa. Excelente parque con amplios jardines y quincho cubierto con asadores', 'hotel', 'none', 'icon-tipo1-hotel.png', 'otto-icon-servicios.png', 'lafalda-hotel.jpg'),
(2, 'Hotel Sanidad', 'Mar del Plata, BsAs', 'En la Ciudad balnearia de Mar del Plata encontrarás nuestro gran Hotel Sanidad. Ubicado en una zona privilegiada, muy cerca del centro comercial y a cuadras de la playa y del casino, te ofrecemos un hospedaje confortable y muy cordial, ideal para vacacionar en familia todo el año.', 'Confortables habitaciones equipadas con TV y baño privado<br>Desayuno Continental y Cena<br>Confitería<br>WIFI, sala de juegos y videojuegos<br>Spa y Gimnasio<br>Recreación para los más chicos | Guardería<br>Servicio de carpas en las playas del complejo Punta Mogotes <br>Servicio de Emergencias | Área Protegida', 'hotel', 'none', 'icon-tipo1-hotel.png', 'sanidad-icon-servicios.png', 'mardel-hotel.jpg'),
(3, 'Hotel FATSA', 'San Bernardo, BsAs', 'A 323 km. de Capital Federal se encuentra una de las Ciudades balnearias más elegidas por los turistas ansiosos de disfrutar del sol, la playa y el mar. Allí Sanidad brinda un hospedaje confortable con instalaciones del Hotel FATSA, ubicado en pleno centro de la Ciudad.', 'Confortables habitaciones equipadas con TV y baño privado<br>Desayuno Continental y Cena<br>Spa<br>Recreación para los más chicos<br>Servicio de carpa en la playa<br>Servicio de Emergencias | Área Protegida', 'hotel', 'Fecha de contingentes:<br>1° 12/01 al 21/01<br>2° 11/02 al 20/02<br>3° 13/03 al 22/03', 'icon-tipo1-hotel.png', 'fatsa-icon-servicios.png', 'sanbernardo.jpg'),
(4, 'Apart-hotel 21 de Septiembre', 'Villa Gesell, BsAs', 'También contamos con un Apart Hotel propio en Villa Gesell, a 200 mts. del mar y con excelentes comodidades para disfrutar todo el año.', 'Departamentos de 1 y 2 dormitorios con baño y cocina, totalmente equipados.<br>*No incluye toallas y toallones<br>Desayuno: Incluimos todo para que vos lo prepares.<br>Servicios de blanco y mantelería en los departamentos.<br>Servicio de Emergencias | Área Protegida', 'hotel', 'none', 'icon-tipo2-hotel.png', 'sep21-icon-servicios.png', 'villagesel-hotel.jpg'),
(5, 'Hostería en Paso de la Patria', 'Corrientes', 'Sanidad ofrece un hospedaje para disfrutar de las playas y balnearios del Río Paraná en Corrientes. La Hostería FATSA es una posada de nivel internacional, rodeada de paisajes naturales, a la orilla del río.', 'Cabañas y habitaciones<br>Pileta de Natación<br>Estacionamiento propio<br>Spa<br>Amplios parques y jardines<br>Salón comedor<br>Estadía en habitación, incluyendo desayuno continental y cena.<br>Recreación para los más chicos', 'hotel', 'none', 'icon-tipo2-hotel.png', 'hosteria-icon-servicios.png', 'patria-hotel.jpg'),
(6, 'I’Marangatú', 'Tigre, BsAs', 'I’marangatú es un complejo recreativo con habitaciones ubicado en el delta del Tigre, ideal para pasar el día o descansar un fin de semana en familia. Es un espacio en medio de un lugar paradisíaco, para disfrutar de la tranquilidad de la Isla.', 'Zona de parrillas con mesas y sillas<br>Patio de juegos para los más chicos<br>Sombrillas fijas a la orilla del río<br>Restaurante<br>Proveduría<br>Quincho para 200 personas<br>Baños y vestuarios para damas y caballeros.<br>Servicio de Emergencias | Área Protegida<br>Habitaciones con baño privado.<br>*No incluye toallas y toallones', 'hotel', 'Fecha de contingentes (en temporada)<br>Lunes / Martes / Miércoles<br>Jueves cerrado<br>Viernes / Sábado / Domingo', '', 'marangatu-icon-servicios.png', 'Imarangatu-hotel.jpg'),
(7, 'Pontevedra', 'Pontevedra, BsAs', 'También contamos con un Centro Recreativo en Pontevedra, Partido de Merlo, donde todos los trabajadores de Sanidad pueden disfrutar en familia de un día de esparcimiento en las 8 hectáreas de parque.', 'Juego para niños<br>Sector parrillas<br>Pileta de natación olímpica con 3 trampolines.<br>Pileta para niños<br>Salón multifunción<br>Canchas de Fútbol – Voley – Beach Voley- Basquet – Papi Fútbol – Paddle<br>Quinchos con parrillas<br>Centro Médico', 'hotel', 'none', '', 'otto-icon-servicios.png', 'pontevedra-hotel.jpg'),
(8, '', '¡Viajá al Norte argentino con ATSA BsAs!', '<ul>\n<li>9 <em>días</em> / 6 <em>noches</em></li>\n<li>Media Pensión</li>\n<li>Micro Cama</li>\n<li><a class=\"text-underline\" href=\"http://www.ghalahotel.com.ar/\" target=\"_blank\" rel=\"noopener\">Hotel Ghala – Salta</a></li>\n<li>Salida: 29/10/2017</li>\n<li>Regreso: 6/11/2017</li>\n</ul>', 'Comunicate con la Secretaría de Turismo al 4959-7100 (int. 7106/7108)', 'viajes', 'Para todos los afliados y su grupo familiar organizamos viajes especiales a distintas provincias del país.', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `laboratorio_ID` int(11) NOT NULL,
  `laboratorio_titulo` varchar(250) NOT NULL,
  `laboratorio_texto` text NOT NULL,
  `laboratorio_imagen` varchar(250) NOT NULL DEFAULT '',
  `laboratorio_orden` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`laboratorio_ID`, `laboratorio_titulo`, `laboratorio_texto`, `laboratorio_imagen`, `laboratorio_orden`) VALUES
(1, 'SIMULADOR PARA VENOPUNCIÓN BRAZO ADULTO Y GERONTE', '<p><span class=\"webkit-html-text-node being-edited editing\" tabindex=\"0\" contenteditable=\"plaintext-only\">Maniquí de entrenamiento para profesionales en el cuidado de pacientes pediátricos hospitalarios. Representa de manera realista a un niño de seis años. Este niño es ideal para la capacitación clínica en las habilidades clínicas pediátricas principales dentro del hospital. Está diseñado para el entrenamiento basado en escenarios del cuidado y manejo de una variedad de evaluaciones pediátricas: IV e IO, evaluación de fontanela, cateterismo urinario y atención pediátrica general.</span></p>', 'simulador-de-venopuncion.jpg', 1),
(2, 'SIMULADOR INYECCIÓN INTRAMUSCULAR', '<p>El Simulador IM cuenta con una estructura &oacute;sea simulada inserta profunda en el torso inferior y representa el extremo superior del f&eacute;mur, con marcas anat&oacute;micas palpables para identificar sitios de inyecci&oacute;n apropiados..</p>', 'simulador-inyección-intramuscular.jpg', 2),
(3, 'MÓDULO DE FUNDUS PARA NURSING ANNE', '<p>Las habilidades y Evaluaci&oacute;n M&oacute;dulo de fundus muestra la anatom&iacute;a normal de la situaci&oacute;n post parto de una mujer, dise&ntilde;ado para las habilidades de evaluaci&oacute;n de la formaci&oacute;n del fundus y de masaje.</p>', 'modulo-de-fundus-para-nursing-anne.jpg', 3),
(4, 'MÓDULO CUIDADO DE HERIDAS', '<p>Incisi&oacute;n abdominal con suturas quir&uacute;rgicas, suturas por grapas con tubo de drenaje, &uacute;lceras por presi&oacute;n con tejido ulcerado adiposo visible. M&oacute;dulo para inyecci&oacute;n de heparina e insulina en abdomen. Estomas intercambiables. Colostom&iacute;a infectada. Pierna amputada, pierna con v&aacute;rices, pie diab&eacute;tico.</p>', 'modulo-cuidado-de-heridas.jpg', 4),
(5, 'MODULO QUEMADURAS', '<p>Contiene cuatro etapas para ayudar a simular los tipos de lesiones por quemaduras, la evaluaci&oacute;n del paciente y el cuidado. Use los resultados de la evaluaci&oacute;n para identificar la gravedad y el tipo de quemadura para preparar un plan de tratamiento y medir el desempe&ntilde;o del manejo de la quemadura. Las quemaduras son flexibles y se pueden cortar f&aacute;cilmente en cualquier forma para adaptarse a cualquier &aacute;rea en un paciente humano o simulador de paciente / entrenador.</p>', 'modulo-quemaduras.jpg', 5),
(6, 'PREMATURE ANNE', '<p>Maniqu&iacute; que tiene las proporciones reales de un beb&eacute; prematuro de 25 semanas desarrollado en colaboraci&oacute;n con la Academia Americana de Pediatr&iacute;a. Los primeros 10 minutos son cr&iacute;ticos para un neonato prematuro. Los profesionales sanitarios tienen que estar preparados para poder proporcionar un cuidado de calidad cuando lleguen las complicaciones. Premature Anne es un maniqu&iacute; para entrenamientos que se ha dise&ntilde;ado para preparar a los profesionales mediante experiencias realistas y ayudarles a salvar las vidas de los m&aacute;s peque&ntilde;os.</p>', 'premature-anne.jpg', 6),
(7, 'SIMULADOR DE PACIENTE CON SIMPAD Y MONITOR “NURSING KID”', '<p>Maniqu&iacute; de entrenamiento para profesionales en el cuidado de pacientes pedi&aacute;tricos hospitalarios. Representa de manera realista a un ni&ntilde;o de seis a&ntilde;os. Este ni&ntilde;o es ideal para la capacitaci&oacute;n cl&iacute;nica en las habilidades cl&iacute;nicas pedi&aacute;tricas principales dentro del hospital. Est&aacute; dise&ntilde;ado para el entrenamiento basado en escenarios del cuidado y manejo de una variedad de evaluaciones pedi&aacute;tricas: IV e IO, evaluaci&oacute;n de fontanela, cateterismo urinario y atenci&oacute;n pedi&aacute;trica general.</p>', 'simulador-de-paciente-con-simpad-y-monitor_nursing-kid.jpg', 7),
(8, 'SIMULADOR DE PACIENTE CON SIMPAD Y MONITOR “NURSING ANNE&#34;', '<p>Maniqu&iacute; para capacitaci&oacute;n basada en escenarios, cuidado y administraci&oacute;n de pacientes internados. Es eficiente, efectivo y flexible para la capacitaci&oacute;n cl&iacute;nica en la salud de la mujer, obstetricia, posparto, evaluaci&oacute;n y atenci&oacute;n de heridas y pacientes en general.</p>', 'simulador-de-paciente-con-simpad-y-monitor_nursing-anne.jpg', 8),
(9, 'RESUSCI ANNE SIMULATOR', '<p>Equipo inal&aacute;mbrico preparado para hacer los cursos de RCP m&aacute;s polivalentes. Es el primer simulador que cubre las necesidades de ense&ntilde;anza en el a&eacute;rea de emergencias. Gracias a la gesti&oacute;n de la v&iacute;a a&eacute;rea, signos vitales, respiraci&oacute;n espont&aacute;nea y su control remoto, este simulador inal&aacute;mbrico se convirti&oacute; r&aacute;pidamente en el equipo est&aacute;ndar para la ense&ntilde;anza b&aacute;sica de personal m&eacute;dico de urgencias. Permite: Mejora de la comunicaci&oacute;n y el trabajo en equipo a trav&eacute;s de la simulaci&oacute;n. M&oacute;dulos de escenarios preprogramados para una preparaci&oacute;n r&aacute;pida de la formaci&oacute;n con simulaci&oacute;n.</p>', 'resusci-anne-simulator.jpg', 9),
(10, 'RESUSCI BABY Q-RCP', '<p>Beb&eacute; para QCPR. Medida mejorada de las compresiones y las ventilaciones con orientaci&oacute;n completa y precisa. Funciones detalladas de informaci&oacute;n y an&aacute;lisis permiten a los alumnos aprender y mejorar la ejecuci&oacute;n de la RCP.</p>', 'resusci-baby-q-RCP.jpg', 10),
(11, 'BABY ANNE', '<p>Maniqu&iacute; lactante de cuerpo completo realista y liviano. Los Estudiantes pueden practicar RCP B&aacute;sico as&iacute; como tambi&eacute;n la maniobra para ahogo de Heimlich.</p>', 'baby-anne.jpg', 11),
(12, 'LITTLE ANNE', '<p>Torso adulto para pr&aacute;ctica de RCP B&aacute;sico, realista con todas las caracter&iacute;sticas anat&oacute;micas: apertura de v&iacute;a a&eacute;rea, expansi&oacute;n del t&oacute;rax y sistema de clicker.</p>', 'little-anne.jpg', 12),
(13, 'SUSIE SIMON', '<p>Maniqu&iacute; adulto completo para pr&aacute;cticas de colocaci&oacute;n de sonda oro y nasog&aacute;strica, enemas, cateterizaci&oacute;n vesical masculina y femenina, toma de muestra pap, cuidados de ostomas (traqueotom&iacute;a, colostom&iacute;a, ileostom&iacute;a, gastrostom&iacute;a) con tanques internos, punci&oacute;n intramuscular en gl&uacute;teos, muslos y deltoides, irrigaci&oacute;n &oacute;ptica y &oacute;ptica, dentadura detachable, cuerpo completamente articulado para practicar distintas posiciones del paciente.</p>', 'susie-simon.jpg', 13),
(14, 'RESUSCI ANNE PARA RCP AVANZADA', '<p>Permite combinar t&eacute;cnicas de RCP avanzada como desfibrilaci&oacute;n, v&iacute;a intravenosa y procedimientos invasivos de v&iacute;a a&eacute;rea. Feedback de variables de RCP. Practica de Trauma y Rescate. Manejo a distancia.</p>', 'resusci-anne-para-rcp-avanzada.jpg', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `post_ID` int(20) UNSIGNED NOT NULL,
  `post_autor` int(20) UNSIGNED NOT NULL DEFAULT '1',
  `post_fecha` date NOT NULL,
  `post_titulo` varchar(200) NOT NULL,
  `post_url` varchar(200) NOT NULL DEFAULT '',
  `post_contenido` longtext NOT NULL,
  `post_resumen` text NOT NULL,
  `post_bajada` text NOT NULL,
  `post_imagen` varchar(200) NOT NULL,
  `post_video` varchar(200) NOT NULL,
  `post_categoria` varchar(200) NOT NULL,
  `post_etiquetas` text NOT NULL,
  `post_galeria` varchar(20) NOT NULL DEFAULT '0',
  `post_imagenesGal` longtext NOT NULL,
  `post_status` varchar(50) NOT NULL,
  `post_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`post_ID`, `post_autor`, `post_fecha`, `post_titulo`, `post_url`, `post_contenido`, `post_resumen`, `post_bajada`, `post_imagen`, `post_video`, `post_categoria`, `post_etiquetas`, `post_galeria`, `post_imagenesGal`, `post_status`, `post_timestamp`) VALUES
(1, 0, '2017-07-19', 'El Gobierno va por la flexibilización laboral', 'gobierno-planea-flexibilizar-convenios-colectivos-y-rebajar-costos-laborales', '<p>Tras el envión de los cambios laborales en Brasil, el Gobierno comenzó a trabajar en el diseño de la reforma laboral que alentará tras las elecciones. La propuesta se propone avanzar sobre tres ejes: la flexibilización de los convenios colectivos de trabajo, el impulso a los contratos individuales o por empresa por sobre los convenios para la negociación de condiciones de trabajo y la reducción de costos laborales por efecto de eliminación de aportes a los sindicatos y rebajas de algunas cargas sociales o alícuotas de ART.</p><p>Desde la administración de Mauricio Macri reconocieron que la reforma laboral sancionada la semana pasada en Brasil fue como un \"meteorito\" que aceleró sus planes de poner en debate posibles modificaciones en el mundo del trabajo y, en línea con los reclamos del sector empresario, advirtieron que esa realidad impone \"readecuar las regulaciones laborales locales para evitar problemas de competitividad. \"Al respecto, en la Casa Rosada insistieron en que la discusión sobre la reforma se dará después de octubre y descuentan que los cambios serán producto del acuerdo entre referentes sindicales y empresarios, además de sumar la influencia de los gobernadores con su representación parlamentaria. </p><p>Pese al antecedente de la reforma brasileña, en el Gobierno diferenciaron aspectos \"valiosos\" de la ley impulsada por la gestión de Michel Temer que podrían replicarse en la Argentina.</p>', '', 'Flexibilización de convenios, reducción de costos laborales y extensión de la jornada laboral son algunas de las medidas que planea después de octubre.', 'flexibilizacion.jpg', '', 'nacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(2, 0, '2017-07-18', '¡Comenzó el especial de Vacaciones de Invierno en el Complejo Cultural Sanidad!', 'especial-vacaciones-complejo-cultural', '<p>Vení a nuestro Complejo Cultural Sanidad para vivir las vacaciones de invierno junto a tu familia. Del 15 al 30 de julio llevamos adelante el 4to Festival Infantil Innocencio Di Giovanni, donde compartimos obras de teatro todos los días con doble función. A continuación compartimos el programa del Festival donde encontrarás toda la información de las obras por día  y sus horarios. </p><p><a href=\"uploads/pdfs/programa2017.pdf\" target=\"_blank\">Descargá el programa completo aquí</a></p>', '', 'Del 15 al 30 de julio, vení a disfrutar de obras de teatro gratuitas para toda la familia de Sanidad.', 'vacaciones2017.jpg', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(3, 0, '2017-07-16', 'Las 14 claves de la flexibilización laboral de Brasil', 'las-14-claves-de-la-flexibilizacion-laboral-de-brasil', '<p>A continuación, compartimos las 14 claves de esta reforma laboral en Brasil, que perjudica a los trabajadores y representa un retroceso en el ejercicio de sus derechos conquistados. </p><ul><li>Crea nuevos tipos de contratos de trabajo, entre ellos el trabajo intermitente</li><li>Amplía la posibilidad de acuerdos individuales, entre ellos la posibilidad de jornada de 12 horas por 36 horas de descanso y reducción de intervalo intrajornada</li><li>Crea una comisión de representantes de los empleados para negociar directamente con la empresa</li><li>Prevé banco de horas para compensación de horas extra, sin necesidad de acuerdo colectivo</li><li>Dificulta y encarece el acceso a la Justicia del Trabajo</li><li>Acaba con el pago de las horas de desplazamiento</li><li>Excluye la obligatoriedad de homologaciones de despidos por sindicatos</li><li>Retira la obligación de negociar con sindicatos despidos colectivos</li><li>Restringe las hipótesis y fija límites de valores para indemnizaciones por daños morales proferidas por la Justicia del Trabajo</li><li>Autoriza arbitrajes laborales para salarios por encima de R$ 11.100</li><li>Permiten a las mujeres embarazadas y en período de lactancia realizar trabajos insalubres</li><li>Revoca los 15 minutos de descanso antes de las horas extra para las mujeres</li></ul>', '', 'El senado brasileño sancionó la reforma laboral que reclamaban las grandes empresas.', 'temer.jpg', '', 'internacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(4, 0, '2017-07-12', 'Bienvenidos compañeros y compañeras', 'bienvenidos-companeros-y-companeras', '<p>Les doy la bienvenida a nuestra nueva página web, donde van a encontrar información sobre novedades gremiales, actividades, eventos, capacitaciones y todo lo que brindamos desde Sanidad para nuestros afiliados y su grupo familiar.</p><p>Les propongo que nos encontremos también en estos espacios digitales. Tenemos la oportunidad de comunicarnos, actualizarnos, organizarnos y debatir de manera más rápida, para así seguir construyendo un gremio fuerte y con participación activa de todos ustedes, compañeros y compañeras.</p><p>Recorran la página y contáctennos por cualquier inquietud. Acá estaremos para asesorarlos, acompañarlos y representarlos en todos los ámbitos.</p><p>Una vez más, gracias por ser parte de este movimiento y sean bienvenidos.</p>', '', 'Nuestro Secretario General nos da la bienvenida a este nuevo espacio de encuentro.', 'lafiestadetodos.jpg', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(5, 0, '2017-07-11', 'Juntos y Conectados somos más', 'juntos-y-conectados-somos-mas', '<p>Hace 82 años que todos los trabajadores de la Sanidad estamos unidos bajo un mismo gremio que nos identifica y representa en cada paso y en cada lucha que damos. Hoy tenemos la oportunidad de multiplicar nuestra fuerza y expandir nuestro movimiento. Esta oportunidad nos lo dan nuestras redes sociales. Por eso, estamos presente en: Facebook, Twitter, Instagram y Youtube, además de contar con esta nueva página web con información actualizada de manera constante. </p><p>Hoy queremos invitarlos a tod@s a unirse a este movimiento virtual que es CONECTADOS, para seguir construyendo nuestra actividad laboral y sindical todos juntos y darle aún más fuerza. Las redes sociales son un espacio más de encuentro, información y debate sobre nuestro trabajo y sobre cómo mantenernos unidos frente a los que cuestionan nuestros derechos. ¡Seguinos!</p><h2>¿No tenés redes?</h2><p>¡Vení al gremio! En la Secretaría de Prensa te orientaremos para que armes tus propias cuentas de Facebook, Twitter e Instagram. También te podemos orientar para que recorras nuestra página web y encuentres todo lo que necesites.</p>', '', 'Nuestro gremio se sigue fortaleciendo. Seguinos en todas nuestras redes para informarte, opinar, debatir y participar. Conectados somos un gremio más fuerte.', 'conectados.png', 'https://www.youtube.com/watch?v=rYHyEBCMO4s', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(6, 0, '2017-07-11', 'Próximamente: Nuevo edificio de capacitación', 'proximamente-nuevo-edificio-capacitacion', '<p>En función de acompañar el avance científico tecnológico propio de este siglo, desarrollamos este espacio específico para que nuestros compañer@s se preparen, no sólo para afrontar las demandas del Sistema de Salud, sino para actuar profesionalmente y con responsabilidad social, contribuyendo al desarrollo de una sociedad más justa y solidaria.</p><p>En este Instituto podrán encontrar una amplia y diversa oferta de cursos, además de un Laboratorio de Simulación especial para la capacitación en un entorno cuasi real controlado. El detalle de los cursos y cómo anotarse lo podés encontrar en <a href=\"?page=instituto-de-formacion-tecnico\">Instituto de Perfeccionamiento Técnico Profesional</a> y en <a href=\"?page=cursos-no-formales\">Cursos no formales</a>.</p><p>La inauguración Oficial se realizará en el mes de julio. Pronto compartiremos más información para que puedan asistir y conocer nuestro nuevo Centro de Capacitación.</p>', '', 'Seguimos creciendo. A pocos pasos de nuestro gremio, construimos el Instituto de Perfeccionamiento Técnico Profesional con el objetivo de continuar formando a los trabajadores, no solo en distintas actividades del área de Salud, sino también en otros intereses que tengan y quieran desarrollar como idiomas, computación, manicura, masajes terapéuticos y más.', '', '', 'ATSA', '', '0', '', 'borrador', '2017-07-23 18:00:00'),
(7, 0, '2017-07-08', 'Acuerdo Salarial 2017 – CCT 107', 'acuerdo-salarial-2017-cct-107', '<p>El día 7 de julio arribamos al acuerdo salarial del CCT 107/75, en el cual se incorporó una nueva categoría laboral denominada profesionales bioquímicos, nutricionistas y farmacéuticos. El acuerdo representa una suba del 22% (13% en julio y 9% en octubre) con una cláusula gatillo automática que garantiza que, si la inflación de enero a diciembre de 2017 (IPC=INDEC) fuese superior al 20%, se ajustará el porcentaje al resultado de la inflación, más el + 2%. De esta manera, aseguramos la recuperación del poder de compra de nuestro salario.</p><p>Además, actualizamos el resto de los adicionales en los porcentajes pactados, incorporando a partir de este año un monto por única vez de $ 1000 a pagarse antes del 20 de septiembre, con motivo del Día del Trabajador de la Sanidad.</p><p><img src=\"uploads/images/escala-salarial107-FULL.jpg\" alt=\"Escala Salarial ATSA\"></p>', '', 'Compartimos la nueva escala salarial del CCT 107.', 'escala-salarial107.jpg', 'https://www.youtube.com/watch?v=rYHyEBCMO4s', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(8, 0, '2017-07-08', 'Acuerdo Salarial 2017 – CCT 459', 'acuerdo-salarial-2017-cct-459', '<p>El día 7 de julio arribamos al acuerdo salarial del CCT 459/06. El acuerdo representa una suba del 22% (13% en julio y 9% en noviembre) con una cláusula gatillo automática que garantiza que, si la inflación de enero a diciembre de 2017 (IPC=INDEC) fuese superior al 20%, se ajustará el porcentaje al resultado de la inflación, más el + 2%. De esta manera, aseguramos la recuperación del poder de compra de nuestro salario.</p><p>Además, actualizamos el resto de los adicionales en los porcentajes pactados, incorporando a partir de este año un monto por única vez de $ 1000 a pagarse antes del 20 de septiembre, con motivo del Día del Trabajador de la Sanidad.</p><p><img src=\"uploads/images/escala-salarial459-FULL.jpg\" alt=\"Escala Salarial ATSA\"></p>', '', 'Compartimos la nueva escala salarial del CCT 459.', 'escala-salarial459.jpg', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(9, 0, '2017-07-06', '¡Inscripciones abiertas!', 'inscripciones-abiertas', '<h2>Inscripciones abiertas: 2ndo cuatrimestre Complejo Cultural Sanidad</h2><p>Comienza el 2ndo cuatrimestre en el Complejo Cultural y seguimos ofreciendo una amplia variedad de oferta de cursos y talleres para todas las edades.</p><p>Nuestro Complejo Cultural ya está listo para comenzar la segunda mitad de año. Seguimos con los cursos y talleres que ya conoces ¡y agregamos nuevos! Batería, Canto, Tango, Teatro, Tela, Yoga, Gimnasia… ¡y mucho más! Además, nuestra oferta es totalmente GRATUITA para todos nuestros afiliados y su grupo familiar.</p><p>En nuestra sección especial del <a href=\"http://www.conjuro.biz/ccs/\" target=\"_blank\">Complejo Cultural</a> vas a poder ver toda la variedad de cursos, talleres, horarios y espectáculos que se brindarán, además de realizar una pre-inscripción y pre-reserva para todas las actividades, talleres y cursos. ¡Te esperamos!</p><div><iframe src=\"https://player.vimeo.com/video/136925659?title=0&byline=0&portrait=0\" width=\"640\" height=\"360\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><p><a href=\"https://vimeo.com/136925659\">ATSA BS AS I Complejo Cultural I Día del Niño</a> from <a href=\"https://vimeo.com/user17681848\">FATSA - Sanidad Argentina</a> on <a href=\"https://vimeo.com\">Vimeo</a>.</p></div>', '', 'Comienza el 2ndo cuatrimestre en el Complejo Cultural y seguimos ofreciendo una amplia variedad de oferta de cursos y talleres para todas las edades.', 'inscripcion2-slider-home.jpg', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(10, 0, '2017-07-05', 'Acuerdo Salarial 2017 – CCT 107', 'acuerdo-salarial-2017-cct-122', '<p>El día martes 4 de julio arribamos al acuerdo salarial del CCT 122/75, en el cual se incorporó una nueva categoría laboral denominada profesionales bioquímicos, nutricionistas y farmacéuticos. El acuerdo representa una suba del 22% (13% en julio y 9% en octubre) con una cláusula gatillo automática que garantiza que, si la inflación de enero a diciembre de 2017 (IPC=INDEC) fuese superior al 20%, se ajustará el porcentaje al resultado de la inflación, más el + 2%. De esta manera, aseguramos la recuperación del poder de compra de nuestro salario.</p><p>Además, actualizamos el resto de los adicionales en los porcentajes pactados, incorporando a partir de este año un monto por única vez de $ 1000 a pagarse antes del 20 de septiembre, con motivo del Día del Trabajador de la Sanidad.</p><p><img src=\"http://atsa.dev/uploads/pdfs/122_actaacuerdoyescalasalarial_2017.png\" alt=\"Acuerdo Salarial ATSA\"></p>', '', 'Compartimos la nueva escala salarial del CCT 122.', 'acuerdo-salarial-122.png', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(11, 0, '2017-07-05', 'Acuerdo Salarial 2017 – CCT 108', 'acuerdo-salarial-2017-cct-108', '<p>El día martes 4 de julio arribamos al acuerdo salarial del CCT 108/75, en el cual se incorporó una nueva categoría laboral denominada profesionales bioquímicos y nutricionistas. El acuerdo representa una suba del 22% (13% en julio y 9% en octubre) con una cláusula gatillo automática que garantiza que, si la inflación de enero a diciembre de 2017 (IPC=INDEC) fuese superior al 20%, se ajustará el porcentaje al resultado de la inflación, más el + 2%. De esta manera, aseguramos la recuperación del poder de compra de nuestro salario.</p><p>Además, actualizamos el resto de los adicionales en los porcentajes pactados, incorporando a partir de este año un monto por única vez de $ 1000 a pagarse antes del 20 de septiembre, con motivo del Día del Trabajador de la Sanidad.</p><p><img src=\"http://atsa.dev/uploads/pdfs/108_actaacuerdoyescalasalarial_2017.png\" alt=\"Acuerdo Salarial ATSA\"></p>', '', 'Compartimos la nueva escala salarial del CCT 108.', 'acuerdo-salarial-108.png', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(12, 0, '2017-06-30', '¡Las paritarias son de los trabajadores!', 'las-paritarias-son-de-los-trabajadores', '<p>Ante la insensibilidad y falta de respuesta por parte del sector empresarial para acordar las paritarias correspondientes a los Convenios 122, 107, 108 y 459, llevamos adelante un Plenario informativo para analizar la situación que enfrentamos.</p><p>El día viernes 30 de junio, las comisiones internas representantes de los trabajadores de los Convenios 122, 107, 108 y 459, participaron de un Plenario convocado por la Comisión Directiva con motivo de debatir e informar acerca de la conflictiva negociación paritaria que enfrentamos.</p><p>Al finalizar el Plenario, la Comisión Directiva emitió un comunicado oficial que fue entregado a todos los compañeros y compañeras de los establecimientos implicados para así mantenernos atentos ante cualquier novedad o medida de acción que fuera necesaria.</p><p><img src=\"uploads/images/paritarias.jpg\"></p><p>La semana próxima continuará la negociación paritaria con el sector empresarial. Hoy más que nunca tenemos que estar unidos y organizados, con la fuerza que nos identifica.</p>', '', 'Compartimos la nueva escala salarial del CCT 108.', 'plenario.jpg', '', 'ATSA', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(13, 0, '2017-07-01', 'Héctor Daer sobre las elecciones 2017: “Mi voto va a la unidad del movimiento obrero', 'hector-daer-sobre-las-elecciones-2017', '<p>“Creo en la necesidad e importancia de lograr la unidad del peronismo para evitar la debilitación del movimiento obrero que pretende este gobierno” aseguró nuestro Secretario General e integrante del triunvirato de la CGT, Héctor Daer, en diálogo con El Fin de la Metáfora, programa de Radio 10, en referencia a las instancias de agosto y octubre del corriente año. En este sentido, agregó que “la discusión de cara a las próximas elecciones debe ser un debate de construcción política y no de resentimiento\".</p><p>Asimismo, nuestro dirigente criticó las políticas anti sindicales del Gobierno nacional y advirtió: “Quieren bajar los convenios, hacernos perder derechos y bajar salarios”, al tiempo que resaltó la importancia de “no perder poder adquisitivo este año”.</p>', '', 'El integrante del triunvirato de la CGT aseguró: “Mi voto será del peronismo, no importa quién termine siendo el candidato.”', 'imagen-1.jpg', '', 'nacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(14, 0, '2017-06-30', 'Paritarias 2017: “El Gobierno tiene que dar respuestas sobre los temas que nos preocupan a los trabajadores”', 'paritarias-2017-hector-daer', '<p>En un contexto de ajuste, inflación y desempleo, desencadenado a partir de las políticas del Gobierno actual, luchamos por unas paritarias justas y equitativas, que mantengan nuestro poder de compra.</p>', '', 'Compartimos una declaración de Héctor Daer cuando se inició la discusión paritaria.', 'noticia-nacional2.jpg', 'https://www.youtube.com/watch?v=SqMm3vsoiA0', 'nacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(15, 0, '2017-06-28', 'NO AL 2X1', 'no-al-2x1', '<h2>¡Decimos NO AL 2X1!</h2><p>En repudio al fallo de la Corte Suprema de Justicia por la aplicación “2x1” a los represores del gobierno militar, los trabajadores de ATSA Bs As nos movilizamos a Plaza de Mayo el 10 de mayo junto al conjunto de la sociedad. Defendemos  la Memoria, la Verdad y la Justicia  hoy y siempre. </p>', '', 'ATSA dijo NO al 2x1 y marchó junto a la sociedad en defensa de los derechos humanos.', '2x1noticia.jpg', '', 'nacionales', '', '1', 'a:12:{i:0;s:14:\"2x1slider1.jpg\";i:1;s:14:\"2x1slider2.jpg\";i:2;s:14:\"2x1slider3.jpg\";i:3;s:14:\"2x1slider4.jpg\";i:4;s:14:\"2x1slider5.jpg\";i:5;s:14:\"2x1slider6.jpg\";i:6;s:14:\"2x1slider7.jpg\";i:7;s:14:\"2x1slider8.jpg\";i:8;s:14:\"2x1slider9.jpg\";i:9;s:15:\"2x1slider10.jpg\";i:10;s:15:\"2x1slider11.jpg\";i:11;s:15:\"2x1slider12.jpg\";}', 'publicado', '2017-07-23 18:00:00'),
(16, 0, '2017-07-10', 'Red Sindical UNI', 'red-sindical-uni', '<p>UNI Global Union es la voz de 20 millones de trabajadores del sector de servicios del mundo entero. A través de 900 sindicatos afiliados, representa a los trabajadores y las trabajadoras en 150 países y en todas las regiones del mundo. Incluye a los trabajadores de los sectores de Limpieza y Seguridad; Comercio; Finanzas; Juego; Gráficos y Embalaje; Peluqueros y Esteticistas; Medios de Comunicación, Espectáculo y Artes; Correos y Logística; Seguro Social; Deporte; Trabajadores Temporales y de Agencias y Turismo.</p><p>Dentro de UNI Global Union, se encuentra UNI CARE (UNI Cuidados), que actualmente es presidida por Carlos West Ocampo, Secretario General de FATSA. La misma es la que representa nuestro sector y nuestra actividad a nivel mundial actualmente.</p><p>Por otro lado, concentrando a todos los países de nuestro continente, se desprende UNI Américas, que representa a 4 millones de trabajadores en las Américas y el Caribe. Su deber y misión principal consiste en garantizar que se protejan los derechos de los trabajadores de esta región, incluido el derecho de sindicación y negociación colectiva. Su estrategia consiste en cambiar las reglas del juego en el mercado de trabajo y garantizar la justicia y la igualdad a trabajadoras y trabajadores.</p>', '', '¿Qué es y cómo se relaciona con nuestro gremio?', 'uni-remade.jpg', '', 'internacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(17, 0, '2017-07-08', 'UNI Américas', 'uni-americas', '<p>UNI Américas forma parte de la UNI Sindicato Global, al que están afiliados más de 900 sindicatos de 140 países en todo el mundo. </p><p>Tres cuartas partes de los puestos de trabajo están en el sector de servicios. Los procesos acelerados de urbanización de nuestra región crean más y más empleos, y UNI Américas quiere que estos empleos sean dignos, que sus trabajadores puedan sindicalizarse y que negocien colectivamente. Cada uno de los sectores en los que UNI Américas cuenta con afiliados están desarrollando estrategias de sindicalización para que más jóvenes, más mujeres, más trabajadores y más trabajadoras sean ciudadanos y ciudadanas con derechos plenos.</p><p>Entre los objetivos actuales de UNI Américas se encuentran:</p><ul><li>Fortalecer las relaciones entre el personal de UNI Américas y sus afiliadas, en cada uno de los sectores y países.</li><li>Aumentar la visibilidad de la oficina regional, para tener una voz fuerte y clara que nos permita apoyar a los sindicatos en su construcción de poder estratégico.</li><li>Establecer un sistema fluido y permanente de comunicación entre el personal de UNI Américas y entre el mismo y las afiliadas, a través del uso intensivo de los nuevos medios de comunicación y redes sociales.</li></ul><p>Más información en <a href=\"http://www.uniglobalunion.org/es/regions/uni-americas\" target=\"_blank\">www.uniglobalunion.org/es/regions/uni-americas</a></p>', 'Hector Daer fue designado Vicepresidente de UNI Américas.', 'El día 10 de julio, nuestro Secretario General Héctor Daer fue designado Vicepresidente de UNI Américas, organización sindical internacional que representa a más de 4 millones de trabajadores en América y el Caribe.', 'daer2.jpg', '', 'internacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(18, 0, '2017-07-08', 'Unicare', 'unicare', '<p>El Comité Directivo UNICARE Mundial, reunido en la sede de UNI Global Union en Nyon, Suiza, reflexionó las problemáticas del sector, crecientes en todo el mundo, y sobre la necesidad de una respuesta integrada impulsada por los sindicatos que representan a los trabajadores de la salud. Con el fin de seguir el ritmo del crecimiento en el sector, los sindicatos tendrán que innovar, utilizar las nuevas tecnologías y participar activamente en la profesionalización de la fuerza de trabajo. Compartimos las palabras del Secretario General de FATSA, Carlos West Ocampo, quien preside UNI CARE (UNI Cuidados).</p>', '', 'El Secretario General de FATSA, Carlos West Ocampo, presidente de UNI CARE (UNI Cuidados), reflexiona sobre las problemáticas del sector.', 'carloswest.jpg', 'https://www.youtube.com/watch?v=4ITizwzWt0w', 'internacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(19, 0, '2017-07-05', 'UNI Américas avanza en defensa de l@s trabajador@s', 'UNI-americas-avanza-en-defensa-de-l@s-trabajador@s', '<p>En el día de ayer, la Unión Nacional de Enfermería, UNASED, y la Federación Nacional de Mujeres Trabajadoras, FENAMUTRA, reclamaron en una rueda de prensa a las autoridades del Sistema Nacional de Salud de República Dominicana que se realicen mejoras en las condiciones laborales para el sector y se ponga fin al abuso de las y los trabajadores.</p><p>Las delegadas sindicales denunciaron el incumplimiento de pago del personal contratado, o de servicios prestados, que se adeuda desde hace de varios meses y la falta de nombramiento de personal de salud, lo que repercute no solo en las condiciones laborales de los trabajadores, sino también en la de los usuarios.</p><p>Alan Sable, Director Regional de UNI Américas Cuidados, expresó que el gobierno es responsable de esta situación y tiene que tomar medidas de inmediato.</p><p>“El presidente Danilo Medina debe afrontar la falta de 15 mil enfermeras. La falta de personal activo ha provocado desgaste físico y agotamiento entre las enfermeras”, expresó.</p><p>“También queremos destacar que la falta de pago a estas trabajadoras está empeorando la salud de todas y todos los dominicanos”, indicó.</p><p>Las representantes sindicales concluyeron que si de no encontrar una solución a estas demandas, realizarán movilizaciones y paralizaciones en diferentes partes del país como medida de lucha, iniciando en la sede Administrativa del Servicio Nacional de Salud.</p>', '', 'Sindicatos de la salud dominicanos reclaman mejores condiciones de trabajo', 'dominicanos.jpg', '', 'internacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(20, 0, '2017-07-01', 'El discurso del Papa Francisco a los sindicatos italianos', 'el-discurso-del-papa-francisco-a-los-sindicatos-italianos', '<p>A continuación compartimos el discurso completo:</p><div style=\"font-style:italic;padding:5px 10px\"><p><< Han elegido un lema muy hermoso para este congreso: “Para la persona,  para el trabajo.” Persona y trabajo son dos palabras que pueden y deben juntarse. Porque si pensamos y decimos  trabajo sin  decir persona, el trabajo termina por convertirse en algo inhumano que, olvidándose de las personas, se olvida y se pierde a sí mismo.</p><p>Pero si pensamos en la persona sin el  trabajo decimos algo parcial, incompleto, porque la persona se realiza plenamente cuando se convierte en trabajador, en trabajadora;  porque el individuo se convierte en persona cuando se abre a los demás, en la vida social, cuando florece en el trabajo. La persona florece en el trabajo. El trabajo es la forma más común de cooperación que la humanidad haya  producido en su historia. Cada día, millones de personas cooperan simplemente trabajando: educando a nuestros hijos, maniobrando equipos mecánicos, resolviendo asuntos en una oficina … El trabajo es una forma de amor cívico, no es un amor romántico ni siempre intencional, pero es un amor verdadero, auténtico, que nos hace vivir y saca adelante el mundo.</p><p>Por supuesto, la persona no es sólo trabajo… Tenemos que pensar en la saludable cultura del ocio, de saber descansar. No es pereza, es una necesidad humana. Cuando pregunto a un hombre, a una mujer, que tiene dos, tres hijos: “Pero dígame, ¿Usted juega con sus hijos? ¿Tiene este “ocio?”- “¡Eh!, sabe, cuando voy al trabajo, todavía están dormidos, y cuando vuelvo ya están acostados”. Esto es inhumano. Por eso, junto con el trabajo, hay que tener la otra cultura. Porque la persona no es solamente trabajo; porque no trabajamos siempre y  no siempre tenemos  que trabajar.</p><p>De niños no se trabaja y no se debe trabajar .No trabajamos cuando estamos enfermos, no trabajamos cuando somos ancianos. Hay muchas personas que todavía no trabajan, o que ya no trabajan. Todo esto es cierto y sabido, pero hay que recordarlo  también  hoy , cuando en el mundo todavía  hay demasiados niños y chicos  que trabajan y no estudian, mientras el  estudio es el único “trabajo” bueno de los niños y de los jóvenes.</p><p>Y cuando no siempre y no a todos se les reconoce el derecho a una jubilación justa – ni demasiado pobre ni demasiado rica: las “jubilaciones  de oro” son un insulto al trabajo no menos grave que el de las jubilaciones demasiado pobres, porque vuelven perennes las desigualdades del tiempo del trabajo. O cuando un trabajador enferma y  se le descarta del mundo del trabajo en nombre de la eficiencia – y, sin embargo, si una persona enferma puede, dentro de sus límites,  trabajar, el trabajo también desempeña una función terapéutica- : a veces  uno se cura trabajando con los demás , trabajando juntos, para los demás.</p><p>Me gustaría hacer hincapié en dos desafíos trascendentales que el hoy  el movimiento sindical debe afrontar y superar si quiere seguir desempeñando su papel esencial para el bien común.</p><p>El primero es la profecía, y se refiere a la naturaleza misma del sindicato,  a su verdadera vocación. El sindicato  es una expresión del perfil profético de una sociedad. El sindicato nace y renace cada vez que, como los profetas bíblicos, da voz a los que no la tienen, denuncia al pobre “vendido por un par de sandalias” (cfr Amós 2,6), desenmascara  a los poderosos que pisotean  los derechos de los trabajadores más vulnerables, defiende la causa del extranjero, de los último, de los “descartes”.</p><p>Como demuestra la gran tradición de la CISL, el movimiento sindical tiene sus grandes temporadas cuando es  profecía. Pero en nuestras sociedades capitalistas avanzadas el sindicato corre el peligro  de  perder esta naturaleza profética  y de volverse demasiado parecido a las instituciones y a los  poderes que, en cambio,  debería criticar. El sindicato, con el  pasar del tiempo, ha acabado por  parecerse  demasiado a la  política, o mejor dicho, a los partidos políticos, a su lenguaje, a su estilo. En cambio, si se olvida de esta dimensión típica y diferente, también su acción dentro de  las empresas pierde potencia y eficacia. Esta es la profecía.</p><p>Segundo desafío : innovación. Los profetas son  centinelas, que vigilan desde su atalaya. También el sindicato tiene que  vigilar desde las murallas  de la ciudad del trabajo, como  un centinela que mira y protege a los que están dentro  de la ciudad del trabajo, pero que mira  y protege también a los que están fuera de las murallas. El sindicato no realiza su función esencial de  innovación social si vigila solo a los  que están dentro, si sólo protege los derechos de las personas que trabajan o que ya están retiradas. Esto se debe hacer, pero es la mitad  de vuestro  trabajo. Vuestra vocación es también proteger los  derechos de quien todavía no los tiene,  los excluidos del trabajo  que también están excluidos de los derechos y de la democracia.</p><p>El capitalismo de nuestro tiempo no comprende el valor del sindicato, porque se ha olvidado de la naturaleza social de la economía, de la empresa. Este es uno de los pecados más graves. Economía de mercado: no. Digamos economía social de mercado, como enseñaba san Juan Pablo II: economía social de mercado. La economía se ha olvidado de la naturaleza social de su vocación, de la naturaleza social de la empresa, de  la vida,  de los lazos, de los  pactos. Pero tal vez nuestra sociedad no entiende al sindicato porque  no lo ve luchar  lo suficiente en los lugares de los “derechos del todavía no”, en las periferias existenciales, entre los descartados del trabajo. Pensemos en el 40% de jóvenes menores de 25 años que no tienen trabajo.</p><p>Aquí, en Italia. ¡Y allí es donde tienen que luchar! Son periferias existenciales. No lo ve luchar entre los inmigrantes, de los pobres, que están bajo las murallas de la ciudad ; o simplemente no lo entiende por qué a veces -pero pasa en todas las familias- la corrupción ha entrado en el corazón de algunos sindicalistas. No os dejéis bloquear por esto. Sé que se están esforzando ya desde hace tiempo en la dirección justa, sobre todo con los migrantes, con los jóvenes y con las mujeres.</p><p>Y lo que digo ahora podría parecer superado, pero en el mundo del trabajo la mujer es todavía de segunda clase. Podrían decirme: “No, hay esa empresaria, esa otra…”. Sí, pero la mujer gana menos, se la explota con más facilidad…Hagan algo. Les animo a continuar y, si es posible, a hacer más. Vivir las periferias puede convertirse en una estrategia de acción, en una prioridad del sindicato de hoy y de mañana.</p><p>No hay una buena sociedad sin un buen sindicato, y no hay un buen sindicato que no renazca todos los días en las periferias, que no transforme  las piedras  descartadas por la economía en piedras angulares. Sindicato es una hermosa palabra que viene del griego “dike”, es decir justicia y “syn” juntos. Es decir, “justicia juntos”. No hay justicia  juntos si no es junto con los excluidos de hoy. >></p></div>', '', 'El papa Francisco recibió en el Vaticano a una delegación del sindicato italiano CISL y, en el contexto del congreso “Para la Persona, para el trabajo”, realizó un discurso muy motivador para el sindicalismo mundial.', 'papa_francisco.jpg', '', 'internacionales', '', '0', '', 'publicado', '2017-07-23 18:00:00'),
(21, 0, '2017-07-26', '¡Celebramos el Día del Niño juntos!', 'celebramos-el-dia-del-nino-juntos', '<p>Como todos los años, el Día del Niño lo celebramos junto a vos y tu familia. En esta oportunidad, te invitamos a disfrutar de un espectáculo exclusivo: ¡El gran <a href=\"http://www.circorodas.com.ar/\" target=\"_blank\">Circo Rodas</a> presentará su increíble show!</p><h2>¿Dónde?</h2><p>En el mismo lugar que el año pasado: Estadio Luna Park, Av. Eduardo Madero 470, CABA.</p><h2>¿Cuándo?</h2><p>Domingo 20 de agosto.</p><h2>¿A qué hora?</h2><p>El Circo Rodas dará 2 funciones. La primera a las 12:00 y la segunda a las 16 hs.</p><h2>¿Cómo adquiero mis entradas?</h2><p>A partir del primero de agosto podés retirar tus entradas directamente en el gremio, Saavedra 166, CABA, de 8 a 18:30 hs. Tenés que traer tu carnet de afiliado, recibo de sueldo, DNI/Cédula de tu hijo/a y acreditación de parentesco (partida de nacimiento o libreta de casamiento). El show es para niños y niñas de hasta 12 años inclusive.</p><h2>¿Tenés dudas?</h2><p>Para más información comunícate con tu delegado o acercate a al sindicato, Saavedra 166, de lunes a viernes de 10 a 18 hs. También podés ingresar a nuestras redes sociales para saber más.<br> (<a href=\"http://www.facebook.com/atsabsas\" target=\"_blank\">www.facebook.com/atsabsas</a>; <a href=\"http://www.twitter.com/atsabsas\" target=\"_blank\">www.twitter.com/atsabsas</a>; <a href=\"http://www.instagram.com/atsabsas\" target=\"_blank\">www.instagram.com/atsabsas</a>)</p>', '', 'El 20 de agosto te invitamos a vos y tu familia al Luna Park a vivir un Día del Niño único.', 'diadelnino2017.jpg', '', 'ATSA', 'a:1:{i:0;s:1:\"1\";}\n', '1', 'a:7:{i:0;s:26:\"galerianinovacaciones1.jpg\";i:1;s:26:\"galerianinovacaciones2.jpg\";i:2;s:26:\"galerianinovacaciones3.jpg\";i:3;s:26:\"galerianinovacaciones4.jpg\";i:4;s:26:\"galerianinovacaciones5.jpg\";i:5;s:26:\"galerianinovacaciones6.jpg\";i:6;s:26:\"galerianinovacaciones7.jpg\";}', 'publicado', '2017-07-26 11:59:29'),
(22, 0, '2017-07-27', 'Encuentro regional de UNI América Cuidados en Lima', 'encuentro-regional-de-UNI', '<p>Análisis, debate, planificación de futuras actividades y acciones, movilización en apoyo a la FED-CUT (uno de los afiliados de UNI Cuidados en Perú) constituyeron el marco de una semana muy productiva para todas las organizaciones participantes.</p><h2>Dónde estamos, hacia dónde vamos</h2><p>Carlos West Ocampo, Presidente de UNI Cuidados a nivel mundial, junto con Adrian Durstchi (Director Global) y Alan Sable (Director Regional), coordinaron animados debates sobre el crecimiento sindical que se ha logrado en la región y los principales problemas que afectan a los sindicatos y a los trabajadores.</p><p>Las leyes laborales adoptadas por el Parlamento brasileño que retrotraen los derechos sindicales y destruyen derechos adquiridos durante más de cien años de lucha estuvieron en el foco de la discusión. El análisis realizado por el compañero Edison de Oliveira, de FEESSESP, Brasil, fue el puntapié para comenzar el debate, y recibió el apoyo de todas las organizaciones presentes para las futuras acciones que emprenda el movimiento sindical brasileño en defensa de los intereses de los trabajadores a quienes representa.</p><p>Una especial atención recibió el análisis de la situación del sector salud en el marco de los cambios que se están generando en el nuevo mundo del trabajo. Se calcula que el sector salud va a ser uno de los pocos con capacidad para crear nuevos empleos . Según datos de la Organización Internacional del Trabajo el crecimiento anual promedio del empleo en el ámbito de la salud duplicó el registrado por el empleo total (2.8% frente al 1.3%). La misma fuente prevé que para el 2030 la creciente demanda de servicios de salud generará unos 40 millones de empleos nuevos.”El papel de UNI Cuidados, subrayó Carlos West Ocampo, es lograr que todos estos trabajadores estén organizados en sindicatos y cuenten con negociación colectiva, como instrumentos únicos para asegurarles una vida digna”.  En este sentido,  los sindicatos presentes de Canadá, República Dominicana, Estados Unidos, Perú, Colombia, Brasil, México, Chile y Argentina se comprometieron en un plan de acción destinado al fortalecimiento y crecimiento sindical.</p><h2>¡Estamos en la calle por culpa del gobierno!</h2><p>Esta fue una de las consignas que entonaban los cientos de participantes de la FED-CUT que se movilizaron al Ministerio del Trabajo, junto con la delegación internacional de UNI Cuidados, para exigirle al gobierno que cumpla con el pago de un bono que hace ya tres años fue otorgado a los trabajadores sindicalizados. Después de múltiples movilizaciones y hasta de un proceso llevado a cabo en el ámbito de la justicia, el gobierno sigue negando el pago de este bono.</p><p>Sin embargo, las voces de los trabajadores peruanos y las de los delegados internacionales se hicieron oír con fuerza. Carlos West Ocampo acompañó al Presidente de FED CUT, Cro. Wilfredo Ponce, en sus gestiones ante el Ministerio, con éxito, ya que al día siguiente fue firmada un Acta de Acuerdo, que esperamos sea respetada.</p><h2>Construyendo redes </h2><p>La presencia creciente de empresas multinacionales en el sector de la salud fue también motivo de profundo análisis. En este sentido, se analizaron posibles estrategias, una de las cuales es la búsqueda de acuerdos globales que permitan que la empresa, opere en el país que opere, se comprometa a respetar normas básicas, tales como el derecho a la sindicalización y a la negociación colectiva. También se definió la necesidad de construir redes sindicales, destinadas a fortalecer la solidaridad entre los sindicatos y fortalecer el intercambio de estrategias.</p><p><strong>Una semana a pleno, que contó con todos los ingredientes necesarios para avanzar sindicalmente: compromiso por parte de los sindicatos, vínculos de solidaridad entre los presentes, y una creciente capacidad de análisis e información. </strong></p>', '', 'Durante la semana del 10 al 14 de julio, UNI Américas Cuidados celebró diferentes\r\nactividades en Lima, en conjunto con compañeros y compañeras de toda la región.', 'encuentro-regional-de-UNI.jpg', '', 'internacionales', '', '1', 'a:8:{i:0;s:15:\"slider-uni1.jpg\";i:1;s:15:\"slider-uni2.jpg\";i:2;s:15:\"slider-uni3.jpg\";i:3;s:15:\"slider-uni4.jpg\";i:4;s:15:\"slider-uni5.jpg\";i:5;s:15:\"slider-uni6.jpg\";i:6;s:15:\"slider-uni7.jpg\";i:7;s:15:\"slider-uni8.jpg\";}', 'publicado', '2017-07-26 15:16:47'),
(23, 1, '2017-08-01', '“Marcha de las Antorchas” en memoria de Evita', 'marcha-de-las-antorchas-en-memoria-de-evita', '<p>El 26 de julio se conmemoró el aniversario nº 65 del Paso a la Inmortalidad de la compañera Eva Perón y los trabajadores de Sanidad participamos de la marcha en su nombre. </p><p>Primero nos encontramos en Av. Belgrano y Defensa para luego caminar juntos hasta el histórico edificio de la CGT, Azopardo 802, donde se proyectaron imágenes alusivas a la figura de Evita y la importancia de su rol en la historia argentina.</p><p>Además, durante el acto, el triunvirato anunció que presentará un proyecto de ley en el Congreso para que sus restos sean trasladados desde el cementerio de la Recoleta hasta la sede de la central obrera, al recordar que ése era su deseo en vida.</p>', '', 'El 26 de julio se conmemoró el aniversario nº 65 del Paso a la Inmortalidad de Eva Perón. Los trabajadores de Sanidad participamos de la marcha en su nombre.', 'marcha-antorchas-min.jpg', '', 'nacionales', 'a:1:{i:0;s:2:\"23\";}', '1', 'a:13:{i:0;s:23:\"2017-08-10-751-ATSA.jpg\";i:1;s:23:\"2017-08-10-578-ATSA.jpg\";i:2;s:23:\"2017-08-10-551-ATSA.jpg\";i:3;s:23:\"2017-08-10-684-ATSA.jpg\";i:4;s:23:\"2017-08-10-625-ATSA.jpg\";i:5;s:23:\"2017-08-10-810-ATSA.jpg\";i:6;s:23:\"2017-08-10-192-ATSA.jpg\";i:7;s:23:\"2017-08-10-959-ATSA.jpg\";i:8;s:23:\"2017-08-10-812-ATSA.jpg\";i:9;s:23:\"2017-08-10-898-ATSA.jpg\";i:10;s:23:\"2017-08-10-550-ATSA.jpg\";i:11;s:23:\"2017-08-10-383-ATSA.jpg\";i:12;s:23:\"2017-08-10-681-ATSA.jpg\";}', 'publicado', '2017-08-01 02:23:23'),
(24, 0, '2017-08-01', '1 al 7 de agosto: Semana mundial de la lactancia materna', 'semana-mundial-de-la-lactancia-materna', '<p>El proceso de amamantar tiene múltiples beneficios para el bebé y su mamá, especialmente en lo que refiere a la salud y calidad de vida de ambos. Con el fin de fomentar esta práctica, todos los años, durante la semana del 1ero al 7 de agosto, se celebra en más de 170 países la Semana de la Lactancia Materna. Como sabemos, uno de los impedimentos de amamantar a libre demanda y de forma exclusiva durante los primeros seis meses de vida es la vuelta al trabajo. No todas las mamás pueden trabajar menos horas, tomarse seis meses de licencia, tener cerca a su bebé mientras trabajan o contar con una movilidad adecuada o guardería. Por lo tanto, se vuelve fundamental la predisposición y condiciones del entorno. </p><p>\nDe una u otra forma, regresar al trabajo no debería ser un motivo para finalizar el período de lactancia materna. A tal fin, la <a href=\"uploads/pdfs/ley-20744regimen-de-contrato-de-trabajo.pdf\" target=\"_blank\">Ley de Contrato de Trabajo</a> establece, en su artículo 179, que toda madre trabajadora dispone, durante al menos un año, de dos descansos de media hora para amamantar a su hijo durante la jornada de trabajo. Si el niño no está cerca, la madre puede sumar esos descansos y trabajar una hora menos por día, o bien utilizarlos para sacarse leche y conservarla en un recipiente limpio y dentro de una heladera, hasta su hora de salida del trabajo.</p><p>Extraerse leche durante la jornada de trabajo estimula la producción y permite a las madres seguir teniendo leche suficiente para amamantar al bebé cuando regresen a su lado. Además, al recolectar la leche en el trabajo, los bebés seguirán disfrutando de las ventajas nutricionales y de salud que sólo la leche materna ofrece, aun cuando la madre no se encuentra presente, ya que la misma es guardada en la heladera y, de esta manera, conserva sus propiedades por tres días.</p><p>Otro de los beneficios que trae la lactancia materna para la madre es que ayuda a la prevención del cáncer de mama y de ovario, la depresión post-parto, la anemia, la hipertensión, la osteoporosis y la artritis reumatoide, como también de la obesidad post-parto.</p>', '', 'Garantizar la lactancia materna en nuestros espacios laborales debe ser una prioridad.', 'lactancia-materna.jpg', '', 'internacionales', 'a:1:{i:0;i:22;}', '0', '', 'publicado', '2017-08-01 13:48:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pages`
--

CREATE TABLE `pages` (
  `page_ID` int(11) NOT NULL,
  `page_titulo` varchar(250) NOT NULL DEFAULT '',
  `page_text` longtext NOT NULL,
  `page_imagen` varchar(200) NOT NULL DEFAULT '',
  `page_post_type` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pages`
--

INSERT INTO `pages` (`page_ID`, `page_titulo`, `page_text`, `page_imagen`, `page_post_type`) VALUES
(1, 'Sanidad en números', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"../uploads/images/sanidadnumeros1.png\" alt=\"\" width=\"884\" height=\"382\" /></p>\n<p style=\"text-align: center;\"><img src=\"../uploads/images/sanidadnumeros2.png\" alt=\"\" width=\"503\" height=\"1456\" /></p>\n<p style=\"text-align: center;\"><img src=\"../uploads/images/sanidadnumeros3.png\" alt=\"\" width=\"544\" height=\"201\" /></p>\n<p style=\"text-align: center;\"><img src=\"../uploads/images/sanidadnumeros5.png\" alt=\"\" width=\"592\" height=\"140\" /></p>\n<p style=\"text-align: center;\"><img src=\"../uploads/images/sanidadnumeros6.png\" alt=\"\" width=\"567\" height=\"414\" /></p>', '', 'page'),
(2, 'Otra', '', '', 'page');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `pregunta_ID` int(11) NOT NULL,
  `pregunta_titulo` varchar(250) NOT NULL,
  `pregunta_texto` text NOT NULL,
  `pregunta_imagen` varchar(250) NOT NULL DEFAULT '',
  `pregunta_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`pregunta_ID`, `pregunta_titulo`, `pregunta_texto`, `pregunta_imagen`, `pregunta_orden`) VALUES
(1, '¿A quién debo acudir en caso de tener un conflicto con mi empleador?', '<p>Desde la Secretaría Gremial podrán asesorarte y ayudarte a resolver el conflicto o las dudas que tengas.<br>Comunicate al 4959-7100, interno 7137/38/39.</p>', 'preg-icono-1.png', 1),
(2, '¿Cómo sé a qué convenio pertenezco?', '<p>Desde la Secretaría Gremial podrán ayudarte e informarte sobre tu convenio, acuerdos salariales actuales y condiciones laborales.<br>Comunicate al 4959-7100, interno 7137/38/39.</p>', 'preg-icono-2.png', 2),
(3, '¿Qué cursos puedo hacer?', '<p>En la sección Cultura podés ver toda la oferta de cursos y capacitaciones en Salud, idiomas, computación de estética y para administrativos. También ofrecemos tecnicaturas y convenios universitarios.</p><h3>¿Cómo me inscribo?</h3><p>Comunicate con la Secretaría de Cultura al 4959-7100 int. 7117/55 o acercate al gremio, Saavedra 166, PB.</p>', 'preg-icono-3.png', 3),
(4, '¿Qué talleres puedo hacer en el Complejo Cultural Sanidad?', '<p>En el Complejo Cultural podés realizar talleres artísticos de todo tipo.<br>Danza, pintura, escritura, circo, cerámica y mucho más.<br>Ingresá <a href=\"http://www.conjuro.biz/ccs/\" target=\"_blank\">aca</a> para conocer toda la oferta y cómo inscribirte.</p><p>Para reservar entradas para obras de teatro, muestras y eventos especiales en nuestro Complejo, tenés que llamar al 4959-7100 (int. 7923/24/25) o vía mail a complejocultural@atsa.org.ar<br>También podés mantenerte informado sobre todas las novedades a través del <a href=\"https://www.facebook.com/ComplejoCulturalSanidad/\" target=\"_blank\">Facebook oficial del Complejo.</a></p>', 'preg-icono-4.png', 4),
(5, '¿Qué hago en caso de emergencias médicas?', '<p>En caso de urgencias o emergencias médicas, comunicate al 0800-999-7624.<br />La línea es gratuita y atiende las 24 hs del día, los 365 días del año.</p>', 'preg-icono-5.png', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prevencion`
--

CREATE TABLE `prevencion` (
  `prevencion_ID` int(11) NOT NULL,
  `prevencion_titulo` varchar(250) NOT NULL,
  `prevencion_texto` longtext NOT NULL,
  `prevencion_orden` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prevencion`
--

INSERT INTO `prevencion` (`prevencion_ID`, `prevencion_titulo`, `prevencion_texto`, `prevencion_orden`) VALUES
(1, 'Prevención de Dislipemias | Colesterol', '<p>Las dislipemias son un conjunto de anormalidades en los lípidos de la sangre principalmente Colesterol y Trigliceridos. Representan uno de los principales Factores de Riesgo de Enfermedades Cardiovasculares.</p>\n<p>El Colesterol es una sustancia grasa producida normalmente por el hígado que es necesaria para el correcto funcionamiento de nuestro cuerpo. Los alimentos de origen animal son una fuente externa de Colesterol (carnes, embutidos, lácteos enteros, huevos, etc.)</p>\n<p>Viaja en la sangre de dos formas:</p>\n<ul>\n<li><strong> COLESTEROL LDL o COLESTEROL Malo </strong>: va hacia las arterias y puede depositarse allí.</li>\n<li><strong> COLESTEROL HDL o COLESTEROL Bueno </strong>: remueve el colesterol de los tejidos hacía el hígado para su eliminación</li>\n</ul>\n<h4>Prevención | Tratamiento</h4>\n<p>Para mantener los valores de Colesterol dentro de parámetros normales usted debe:</p>\n<ul>\n<li>Controlar su peso</li>\n<li>Realizar actividad física regular</li>\n<li>Modificar la composición de sus comidas</li>\n<li>Dejar de fumar</li>\n<li>Llevar una alimentación sana frutas y verduras, carnes rojas solo cortes magros (con poca grasa), pollo sin piel, pescados, lácteos y quesos descremados</li>\n<li>Incorporar fibras a la dieta (cereales y legumbres)</li>\n<li>Evitar fritos y embutidos</li>\n<li>Limitar el consumo de grasas en general</li>\n</ul>\n<p><strong> Los medicamentos que reducen el colesterol están ampliamente disponibles, son muy eficaces y contribuyen de forma crucial a reducer la morbilidad cardiovascular en todo el mundo. No se automedique, consulte a su médico. </strong></p>\n<h4>Síntomas | Diagnóstico</h4>\n<p>El exceso de Colesterol Malo se deposita en las paredes de las arterias, y esto asociado a una reacción inflamatoria (ateroesclerosis), produce una disminución en su diámetro. Puede llegar a obstruirse y provocar, según el lugar del cuerpo afectado, un infarto cardiaco, cerebral, etc.</p>\n<h4>¿Qué valores de Colesterol debería tener?</h4>\n<h5>COLESTEROL TOTAL:</h5>\n<p>Deseable menor de 200 mg. %<br /> Limítrofe alto 200-239 mg. %<br /> Alto riesgo mayo de 240 mg. %</p>\n<h5>COLESTEROL LDL (MALO):</h5>\n<p>Deseable menor de 130 mg. %<br /> Limítrofe alto 130-159 mg. %<br /> Alto riesgo mayor de 160 mg. %</p>\n<h5>COLESTEROL HDL (BUENO):</h5>\n<p>Deseable menor de 45 mg. %<br /> Alto riesgo menor de 35 mg. %</p>\n<h5>TRIGLICERIDOS:</h5>\n<p>Deseable menor 150 mg. %<br /> Limítrofe alto 150-199 mg. %<br /> Alto riesgo 200-499 mg. %<br /> Muy elevado mayor de 500 mg. %</p>\n<h4>Recuerde:</h4>\n<p>Realizar exámenes periódicos de sangre para saber cuáles son nuestros niveles de Colesterol es fundamental para el correcto funcionamiento del corazón y la circulación. No deje de consultar a su médico.</p>', 1),
(2, 'Prevención Antitabaco', '<p>\r\n    El consumo de tabaco es uno de los principales factores de riesgo de varias enfermedades crónicas, como el cáncer, las enfermedades pulmonares y cardiovasculares. Se asocia con alteraciones en todos los órganos y sistemas. Es una adicción fundamentalmente asociada a uno de sus componentes, la nicotina, que actúa sobre el sistema nervioso central.\r\n</p>\r\n<p>\r\n    <strong>\r\n        El tabaquismo es la primera causa de muerte evitable en el mundo. Los fumadores viven en promedio diez años menos que los no fumadores.\r\n    </strong>\r\n</p>\r\n\r\n<h4>Prevención | Tratamiento</h4>\r\n\r\n<h5>¿Por qué dejar de fumar?</h5>\r\n\r\n<ul>\r\n    <li>\r\n        Disminuye las posibilidades de tener un ataque cardíaco o cerebral, de desarrollar cáncer de pulmón, enfisema y otras enfermedades pulmonares y de sufrir gripes y resfríos\r\n    </li>\r\n    <li>\r\n        Va a poder subir escaleras y caminar sin cansarse\r\n    </li>\r\n    <li>\r\n        Mejor aliento y olfato\r\n    </li>\r\n    <li>\r\n        Cuando una persona deja el cigarrillo también se benefician todos los miembros de su familia que estaban expuestos como fumadores pasivos\r\n    </li>\r\n</ul>\r\n\r\n<p>\r\n    <strong>\r\n        El 70% de los fumadores desea abandonar la adicción al tabaco. No es sencillo. Cuantas más veces lo intente más cerca estará de lograrlo. No se desanime.\r\n    </strong>\r\n</p>\r\n\r\n<h4>Síntomas | Diagnóstico</h4>\r\n\r\n<ul>\r\n    <li>\r\n        Astenia. Cansancio que, a veces, desaparece al fumar\r\n    </li>\r\n    <li>\r\n        Anorexia. Falta de apetito, que se suele acentuar al fumar\r\n    </li>\r\n    <li>\r\n        Disnea. Dificultad para respirar, que se acentúa con el mínimo esfuerzo\r\n    </li>\r\n    <li>\r\n        Disfonía. Ronquera del Fumador\r\n    </li>\r\n    <li>\r\n        Tos bronquial matinal: tos con flemas por la mañana\r\n    </li>\r\n    <li>\r\n        Impotencia a edades precoces o disminución de la líbido\r\n    </li>\r\n    <li>\r\n        Coloración amarillenta de los dientes\r\n    </li>\r\n    <li>\r\n        Dolores torácicos difusos\r\n    </li>\r\n    <li>\r\n        Bronquitis estacionales\r\n    </li>\r\n</ul>\r\n\r\n<p>\r\n    <strong>\r\n        El humo del tabaco contiene más de 4.000 componentes, de los cuales 50 son sustancias que producen cáncer.\r\n    </strong>\r\n</p>\r\n\r\n<h4>\r\n    Recuerde:\r\n</h4>\r\n<p>\r\n    El Tabaquismo es la primera causa de muerte evitable en el mundo. Si decide dejar de fumar consulte con su médico, el puede ayudarlo a lograrlo, aconsejando diversos métodos o tratamientos para vencer la adicción, para manejar la abstinencia y para mantenerse sin fumar a largo plazo. Inténtelo.\r\n</p>', 2),
(3, 'Prevención de Hipertensión Arterial', '<p>\r\n    Hipertensión Arterial es un aumento sostenido de la Presión Arterial por encima de los valores normales que oscilan entre 120 y 129 de Presión Sistólica o “máxima” y entre 80 y 84 de Presión Diastólica “mínima”.\r\n</p>\r\n\r\n<p>\r\n    Es el principal Factor de Riesgo para padecer Enfermedades Cardiovasculares como infarto Agudo de Miocardio y Accidentes cerebrovasculares. Produce daños en los riñones, retina y sistema nervioso.&nbsp;\r\n</p>\r\n\r\n<h4>Síntomas | Diagnóstico</h4>\r\n\r\n<p>\r\n    En muchos casos no da síntomas, y en otros puede ocasionar dolor de cabeza, náuseas, palpitaciones o desmayos.\r\n</p>\r\n<p>\r\n    Si usted no ha efectuado controles con el Médico Clínico en el último año, debe realizarlo sin demoras. Su médico le informará los Valores de su Presión Arterial y si son elevados le indicará el camino a seguir.\r\n</p>\r\n\r\n<p>\r\n    <strong>\r\n        Los pacientes hipertensos que cumplen su tratamiento tienen menos probabilidades de desarrrollar hipertensión grave.\r\n    </strong>\r\n</p>\r\n\r\n<h4>Prevención | Tratamiento</h4>\r\n<p>\r\n    Es ideal controles clínicos a partir de los 20 años de edad.\r\n</p>\r\n<ul>\r\n    <li>\r\n        Una dieta equilibrada con bajo contenido de sal\r\n    </li>\r\n    <li>\r\n        Evitar el sobrepeso y el hábito de fumar\r\n    </li>\r\n    <li>\r\n        Efectuar ejercicio aeróbico\r\n    </li>\r\n</ul>\r\n\r\n<h4>\r\n    Recuerde:\r\n</h4>\r\n<p>\r\n    Cada individuo es único y necesita un tratamiento acorde a sus características. Consulte a su médico. No se automedique.\r\n</p>', 3),
(4, 'Prevención y Detección Precoz de la Diabetes', '                   \r\n<p>\r\n    La Diabetes es una enfermedad crónica producida por un aumento permanente del azúcar (glucosa) en la sangre denominada hiperglucemia. Cuando esto se produce el organismo envía una señal al páncreas para que secrete insulina. La insulina permite el ingreso de la glucosa a las células y es utilizada como combustible para vivir y desarrollarse. Si este proceso se altera la glucosa no entra a las células y permanece en la sangre produciendo Hiperglucemia, ya sea por falta de insulina o por menor acción de la misma.\r\n</p>\r\n\r\n<h4>Síntomas | Diagnóstico</h4>\r\n\r\n<h5>\r\n    ¿Qué provoca la Hiperglucemia a corto y a largo plazo?\r\n</h5>\r\n<ul>\r\n    <li>\r\n        Aumento de la sed, el apetito y la cantidad de orina\r\n    </li>\r\n    <li>\r\n        Debilidad y cansancio\r\n    </li>\r\n    <li>\r\n        Infecciones frecuentes de la piel y de los aparatos urinario y genital\r\n    </li>\r\n    <li>\r\n        Alteraciones de la visión\r\n    </li>\r\n    <li>\r\n        Dificultad para la cicatrización de heridas\r\n    </li>\r\n    <li>\r\n        Problemas cardíacos\r\n    </li>\r\n    <li>\r\n        Alteración de la función de los riñones\r\n    </li>\r\n    <li>\r\n        Lesiones en los pies\r\n    </li>\r\n</ul>\r\n\r\n<p>\r\n    <strong>\r\n        Su médico le indicará cuál es la alimentación más apropiada, la actividad física más conveniente y el medicamento más adecuado.\r\n    </strong>\r\n</p>\r\n\r\n<h4>Prevención | Tratamiento</h4>\r\n<p>\r\n    La disminución de peso y el incremento de la actividad física regular disminuyen la aparición de la Diabetes.\r\n</p>\r\n<p>\r\n    El control es fundamental para evitar o retardar las complicaciones asociadas con la Hiperglucemia.\r\n</p>\r\n<p>\r\n    La alimentación debe incluir hidratos de carbono, proteínas, grasas, vitaminas y minerales. Este tipo de dietas permiten mantener un buen estado nutricional.\r\n</p>\r\n<p>\r\n    La actividad física regular disminuye la glucemia porque aumenta su consumo. Además ayuda a la reducción de peso.\r\n</p>\r\n<p>\r\n    Es fundamental un tratamiento farmacológico adecuado, no se automedique. Consulte a su médico.\r\n</p>\r\n<h4>\r\n    Recuerde:\r\n</h4>\r\n<p>\r\n    Realizar controles periódico de salud con determinación de glucosa en sangre para diagnosticar la dibetes a tiempo.\r\n</p>\r\n', 4),
(5, 'REHABILITACIÓN CARDIOVASCULAR', '<p>Es un m&oacute;dulo de asistencia m&eacute;dica y param&eacute;dica para el paciente que haya tenido alg&uacute;n evento card&iacute;aco, y tiene el fin de reducir su riesgo de eventos vasculares futuros. Los planes est&aacute;n basados en consejo m&eacute;dico, educaci&oacute;n y ejercicio supervisado, guiado por especialistas.<br /> El &aacute;rea de ejercicio se dispone en un espacio cubierto con ambiente climatizado, e incluye entrenamiento en bicicletas, cintas, clases de gimnasia dirigida, y caminatas.</p>\n<p><strong> El programa incluye a aquellos pacientes que hayan presentado durante los &uacute;ltimos 365 d&iacute;as un evento card&iacute;aco o fueron sometidos a alg&uacute;n procedimiento de Hemodinamia o Cirug&iacute;a Cardiovascular: </strong></p>\n<ul>\n<li>Post infarto agudo de miocardio (IAM/s&iacute;ndrome coronario agudo).</li>\n<li>Post cirug&iacute;a de by-pass aorto-coronario.</li>\n<li>Post angioplast&iacute;a coronaria.</li>\n<li>Angina estable.</li>\n<li>Reparaci&oacute;n o reemplazo valvular.</li>\n<li>Trasplante card&iacute;aco o cardiopulmonar.</li>\n<li>Insuficiencia cardiaca cr&oacute;nica.</li>\n<li>Enfermedad vascular perif&eacute;rica.</li>\n</ul>\n<h4>Componentes del programa:</h4>\n<ul>\n<li>Sesiones de ejercicios f&iacute;sico supervisado por un Profesor de Educaci&oacute;n F&iacute;sica y bajo el control de un M&eacute;dico Cardi&oacute;logo (2-3 veces por semana).</li>\n<li>Consejo y supervisi&oacute;n m&eacute;dica permanente.</li>\n<li>Educaci&oacute;n y control sobre factores de riesgo coronarios, dieta y cuidados de la salud.</li>\n<li>Folleter&iacute;a, literatura y programa de educaci&oacute;n contin&uacute;a.</li>\n<li>Indicaci&oacute;n y plan de ejercicio supervisado para realizar en forma segura.</li>\n<li>Actualizaci&oacute;n continua de fichas de entrenamiento y progresiones.</li>\n<li>Evaluaciones peri&oacute;dicas para re-evaluar objetivos y visualizar mejor&iacute;as.</li>\n</ul>\n<p><strong>Duraci&oacute;n del Programa</strong>:Los pacientes estar&aacute;n incluidos en el programa entre 3 y 6 meses como m&iacute;nimo.</p>\n<p><strong>Reportes del progreso durante el programa</strong>:A lo largo del programa, cada vez que el paciente vea a su cardi&oacute;logo de cabecera podr&aacute; solicitar un informe de los progresos, cambios u observaciones m&eacute;dicas.</p>', 9),
(6, 'Prevención de Cáncer de Cuello Uterino', '<p>El C&aacute;ncer de Cuello Uterino es una enfermedad de evoluci&oacute;n lenta, puede producirse en la mujer a partir del momento en que comienza a tener relaciones sexuales. Consiste en una serie de cambios de c&eacute;lulas del cuello del &uacute;tero que llevan a una multiplicaci&oacute;n celular incontrolable, que invade el &uacute;tero y &oacute;rganos vecinos.</p>\n<p><em> La detecci&oacute;n temprana del c&aacute;ncer de cuello uterino permite un tratamiento &eacute;xitoso. </em></p>\n<p><em> Una mujer sexualmente activa debe realizar periodicamente el ex&aacute;men de Papanicolau. </em></p>\n<h4>S&iacute;ntomas | Diagn&oacute;stico</h4>\n<p>En su primera fase no presenta s&iacute;ntomas, cuando empieza a invadir los tejidos puede provocar hemorragias.</p>\n<p>El ex&aacute;men que puede detectar en forma precoz las lesiones asociadas al C&aacute;ncer de Cuello Uterino es el PAP o T&eacute;cnica de Papanicolau.</p>\n<p>Es un ex&aacute;men simple, r&aacute;pido y que no produce dolor, para realizarlo se raspa suavemente el cuello uterino para obtener algunas c&eacute;lulas de la zona y ser analizadas en un microscopio.</p>\n<p>Con este ex&aacute;men pueden observarse cambios en las c&eacute;lulas del cuello uterino mucho antes de que la mujer tenga s&iacute;ntomas.</p>\n<p>El sangrado anormal entre las menstruaciones, luego de mantener relaciones sexuales o despu&eacute;s de lavados vaginales, pueden ser s&iacute;ntomas que ayudan a su detecci&oacute;n temprana de este tipo de c&aacute;ncer.</p>\n<h4>Prevenci&oacute;n | Tratamiento</h4>\n<p>Es necesario realizar el PAP peri&oacute;dicamente porque como todo m&eacute;todo diagn&oacute;stico puede dar &ldquo;falsos negativos&rdquo; (o sea resultados negativos cuando si hay enfermedad) con la realizaci&oacute;n en forma peri&oacute;dica hay mayor garant&iacute;a de un diagn&oacute;stico temprano.</p>\n<p>Para realizarse un Ex&aacute;men PAP:</p>\n<ul>\n<li>No debe estar menstruando, ni haber efectuado lavados vaginales, ni colocado &oacute;vulos</li>\n<li>No debe haber mantenido relaciones sexuales, 24 horas antes del ex&aacute;men</li>\n</ul>\n<p>Estas condiciones contribuyen a que la muestra que se toma sea de buena calidad.</p>\n<p>En las mujeres en que la detecci&oacute;n se efect&uacute;a en estad&iacute;os tempranos, las probabilidades de curaci&oacute;n llegan casi al 100%.</p>\n<h4>Recuerde:</h4>\n<p><strong>Utilice preservativos ante contacto sexuales nuevos, as&iacute; evitar&aacute; el contagio de enfermedades virales que predisponen al C&aacute;ncer de Cuello como el HPV (Virus del Papiloma Humano) HIV y Herpes genital.</strong></p>', 8),
(7, 'Prevención de Cáncer de Mama', '<p>El c&aacute;ncer de mama es el crecimiento anormal de c&eacute;lulas malignas en el tejido mamario.No existen hasta la actualidad m&eacute;todos confirmados para prevenirlo, la mejor manera de sobrevivir al C&aacute;ncer es siempre la Detecci&oacute;n Precoz. A trav&eacute;s del Autoex&aacute;men Mamario, ex&aacute;men Ginecol&oacute;gico y Mamograf&iacute;a.</p>\n<p>Es ideal iniciar controles ginecol&oacute;gicos a partir del inicio de relaciones sexuales o de los 20 a&ntilde;os. Su m&eacute;dico le informar&aacute; con qu&eacute; intervalos debe realizarlos.</p>\n<p><strong> Si Usted no ha efectuado controles con el Ginec&oacute;logo en el ultimo a&ntilde;o, debe realizarlos sin demoras. </strong></p>\n<h4>Prevenci&oacute;n | Tratamiento</h4>\n<p>Los factores riesgo m&aacute;s frecuentes son:</p>\n<ul>\n<li>Mujeres mayores de 35 a&ntilde;os</li>\n<li>Aquellas que no hayan tenido hijos o su primer embarazo luego de los 30 a&ntilde;os de edad</li>\n<li>Las mujeres que tengan familiares con antecedentes de C&aacute;ncer de Mamas</li>\n<li>Tambi&eacute;n influyen el sobrepeso, el tabaquismo, las terapias de reemplazo hormonal, el uso de pastillas anticonceptivas y el consumo de alcohol</li>\n</ul>\n<p><strong> Si se detecta en estados temprano el tratamiento tiene mayores probabilidades de ser &eacute;xitoso. </strong></p>\n<h4>S&iacute;ntomas | Diagn&oacute;stico</h4>\n<p>En muchos casos no da s&iacute;ntomas. En otros puede producir:</p>\n<ul>\n<li>Sangrado o salida de secreci&oacute;n en el pez&oacute;n</li>\n<li>Retracci&oacute;n de la piel o del pez&oacute;n</li>\n<li>Presencia de un \"bulto\" en la mama</li>\n<li>Cambio de tama&ntilde;o o forma de la mama</li>\n</ul>\n<h4>Recuerde:</h4>\n<p><strong>El diagn&oacute;stico precoz sumado a los avances en las terapias contra el C&aacute;ncer est&aacute;n cambiando la historia de estas enfermedades.</strong></p>\n<p>Una mamograf&iacute;a oportuna puede salvar su vida.</p>', 7),
(8, 'Prevención de Cáncer Colorectal', '<p>El c&aacute;ncer Colorectal es el que comienza en el intestino grueso (colon) o en el recto (parte final del colon). Se presenta mayoritariamente en personas adultas, de ambos sexos, generalmente mayores de 50 a&ntilde;os. Casi todos los c&aacute;nceres de colon empiezan en gl&aacute;ndulas del revestimiento del colon y del recto cuando una c&eacute;lula normal se transforma en tumoral.</p>\n<h4>S&iacute;ntomas | Diagn&oacute;stico</h4>\n<p>En muchos casos no presenta s&iacute;ntomas. En otros los m&aacute;s frecuentes son:</p>\n<ul>\n<li>Sangrado digestivo</li>\n<li>Anemia</li>\n<li>Cambios de ritmo evacuatorio intestinal</li>\n</ul>\n<p>Ante la aparici&oacute;n de algunos de estos s&iacute;ntomas debe consultar a su m&eacute;dico.</p>\n<p>Un diagn&oacute;stico temprano es vital. El profesional le solicitar&aacute; los estudios correspondientes seg&uacute;n su edad y los factores de riesgo que presente.</p>\n<p>Un an&aacute;lisis de laboratorio puede determinar la presencia de sangre oculta en materia fecal y con una endoscop&iacute;a digestiva se puede detectar la enfermedad en su estad&iacute;o inicial.</p>\n<p>La mortalidad a causa del c&aacute;ncer de colon ha descendido en los &uacute;ltimos 15 a&ntilde;os debido al aumento de la conciencia y la detencci&oacute;n temprana por medio de estudios m&eacute;dicos que detectan p&oacute;lipos antes que se vuelvan cancerosos.</p>\n<h4>Prevenci&oacute;n | Tratamiento</h4>\n<ul>\n<li>Hacer una dieta equilibrada, con bajo contenido de carnes rojas y altos porcentajes de frutas y verduras</li>\n<li>Evitar el h&aacute;bito de fumar y el consumo de alcohol</li>\n</ul>\n<p>Si es diagnosticado con C&aacute;ncer Colorectal, su m&eacute;dico brindar&aacute; las indicaciones correspondientes de acuerdo a sus antecedentes y al estad&iacute;o de la enfermedad.</p>\n<p><strong> Hacer una dieta equilibrada, con bajo contenido de carnes rojas y altos porcentajes de verduras y frutas, evitar el h&aacute;bito de fumar y el consumo de acohol, contribuyen a la prevenci&oacute;n. </strong></p>\n<p><strong> Usted tiene mayor riesgo de padecer c&aacute;ncer de colon si: </strong></p>\n<ul>\n<li>Tiene m&aacute;s de 60 a&ntilde;os</li>\n<li>Consume una alimentaci&oacute;n rica en carnes rojas o procesadas</li>\n<li>Tiene p&oacute;lipos colorrectales</li>\n<li>Tiene enfermedad intestinal inflamatoria (enfermedad de Crohn o colitis ulcerativa)</li>\n<li>Tiene antecedentes familiares de c&aacute;ncer de colon</li>\n<li>Tiene un antecedente personal de c&aacute;ncer de mama</li>\n</ul>\n<h4>Recuerde:</h4>\n<p><strong>Es una enfermedad de evoluci&oacute;n lenta que tarda a&ntilde;os en desarrollarse. Los chequeos m&eacute;dicos peri&oacute;dicos son la mejor forma de prevenirla.</strong></p>', 6),
(9, 'Prevención Diagnóstico y Tratamiento de Sobrepeso y Obesidad', '<p>La obesidad es una enfermedad cr&oacute;nica que se caracteriza por la acumulaci&oacute;n excesiva de grasa en el cuerpo. No distingue clases sociales y sus principales causas son la mala alimentaci&oacute;n y la falta de actividad f&iacute;sica. Favorece la aparici&oacute;n de otras enfermedades vinculadas al estilo de vida, como Diabetes, Hipertensi&oacute;n Arterial, Enfermedades Coronarias, Respiratorias, etc.</p>\n<p><strong> Las dietas temporales o r&aacute;pidas solo logran que al finalizarlas volvamos al peso anterior acumulando grasa en lugar de masa muscular. Y fundamentalmente frustaci&oacute;n. El tratamiento debe ser continuo, con profesionales m&eacute;dicos especialistas. </strong></p>\n<h4>Prevenci&oacute;n | Tratamiento</h4>\n<p>El mejor tratamiento para la Obesidad es prevenirla:</p>\n<ul>\n<li>Con un estilo de vida m&aacute;s saludable</li>\n<li>Una alimentaci&oacute;n adecuada, particularmente en la infancia. Incluya todos los d&iacute;as frutas y verduras en la dieta</li>\n<li>Infecciones frecuentes de la piel y de los aparatos urinario y genital</li>\n<li>Evite porciones mayores que su pu&ntilde;o</li>\n<li>Actividad f&iacute;sica regular</li>\n</ul>\n<h4>S&iacute;ntomas | Diagn&oacute;stico</h4>\n<p>El &iacute;ndice de Masa Corporal (IMC) es un c&aacute;lculo sencillo.<br /> Tiene que utilizar su peso y su altura (&eacute;sta multiplicada por si misma) con esta f&oacute;rmula:<br /> Peso en kilos dividido por altura en metros al cuadrado (o sea multiplicada por si misma).</p>\n<p><strong>Ejemplo:</strong> Usted pesa 70 kg. Y mide 1.60 mts.<br /> El c&aacute;lculo ser&iacute;a as&iacute;: 70 dividido 2.56 (1.60 X 1.60)= IMC 27.3.</p>\n<h4>&iquest;Qu&eacute; reflejan los valores del IMC?</h4>\n<ul>\n<li>Entre 20 y 24.9: Peso Adecuado.</li>\n<li>Entre 25 y 29.9: Sobrepeso o Preobesidad.</li>\n<li>Entre 30 y 34.9: Obesidad Leve.</li>\n<li>Entre 35 y 39.9: Obesidad Moderada.</li>\n<li>Mayor de 40: Obesidad M&oacute;rbida o Grave.</li>\n</ul>\n<h4>Sobrepeso y Obesidad Infantil</h4>\n<p><strong> Algunas medidas generales de prevenci&oacute;n de la obesidad relacionadas con la alimentaci&oacute;n son: </strong></p>\n<ul>\n<li>Estimulaci&oacute;n de la lactancia materna.</li>\n<li>Alimentaci&oacute;n planificada, equilibrada, variada y adaptada.</li>\n<li>Adaptar el tama&ntilde;o de la porci&oacute;n a las necesidades del ni&ntilde;o.</li>\n<li>Adecuar el horario a las comidas familiares.</li>\n<li>Utilizar el agua como bebida en lugar de gaseosas.</li>\n<li>Incentivar el consumo de verduras crudas y cocidas, legumbres, frutas y cereales.</li>\n<li>Limitar las comidas entre horas (&ldquo;picoteo&rdquo;), sobre todo las de alto valor cal&oacute;rico.</li>\n<li>Evitar la oferta de alimentos como premio.</li>\n<li>Moderar las actividades sedentarias (uso de televisor, juegos electr&oacute;nicos y computadoras).</li>\n<li>Estimular la actividad f&iacute;sica.</li>\n</ul>\n<p><strong> Tan importante como los h&aacute;bitos alimentarios, es la estimulaci&oacute;n de la pr&aacute;ctica de ejercicio f&iacute;sico desde la edad infantil ya sea en el medio escolar, familiar, el entorno comunitario, etc. </strong></p>\n<p><strong> Algunas medidas generales de prevenci&oacute;n de la obesidad relacionadas con la alimentaci&oacute;n son: </strong></p>\n<ul>\n<li>Participaci&oacute;n en las actividades de deporte escolar.</li>\n<li>Aumento de la actividad f&iacute;sica cotidiana (caminar, subir las escaleras, etc.)</li>\n<li>Mantenimiento de las actividades deportivas durante la adolescencia y la etapa juvenil.</li>\n<li>Participaci&oacute;n en actividades comunitarias de promoci&oacute;n del ejercicio f&iacute;sico: carreras populares, paseos en bicicleta, deportes de playa, f&uacute;tbol, etc.</li>\n<li>Promoci&oacute;n de un entorno familiar y estilo de vida saludable.</li>\n<li>Propuesta de planes individuales de actividad f&iacute;sica para ni&ntilde;os con obesidad o sobrepeso.</li>\n</ul>\n<h4>Recuerde:</h4>\n<p>La obesidad es una enfermedad. No se desanime, siga intent&aacute;ndolo. Combatir y prevenir la Obesidad es estar sano.</p>', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliders`
--

CREATE TABLE `sliders` (
  `slider_id` int(11) NOT NULL,
  `slider_imagen` varchar(200) NOT NULL,
  `slider_titulo` varchar(200) NOT NULL DEFAULT '',
  `slider_link` varchar(300) NOT NULL DEFAULT '',
  `slider_textoLink` varchar(200) NOT NULL DEFAULT 'Leer más',
  `slider_texto` varchar(250) NOT NULL DEFAULT '',
  `slider_ubicacion` varchar(100) NOT NULL DEFAULT '',
  `slider_orden` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sliders`
--

INSERT INTO `sliders` (`slider_id`, `slider_imagen`, `slider_titulo`, `slider_link`, `slider_textoLink`, `slider_texto`, `slider_ubicacion`, `slider_orden`) VALUES
(1, 'lafiestadetodos.jpg', 'Bienvenidos compañeros y compañeras', '/noticias/bienvenidos-companeros-y-companeras', 'Leer más', 'Nuestro Secretario General nos da la bienvenida a este nuevo espacio de encuentro.', 'home', 1),
(2, 'conectados.png', 'JUNTOS Y CONECTADOS SOMOS MÁS', '/noticias/juntos-y-conectados-somos-mas', 'Leer más', '#Conectados nos encontramos, nos comunicamos, nos conocemos. No te quedes afuera de este movimiento.', 'home', 2),
(3, 'vacaciones2017.jpg', 'Vacaciones de Invierno en el complejo Cultural Sanidad', '/noticias/especial-vacaciones-complejo-cultural', 'Leé más acá', 'Obras de teatro para toda la familia, todos los días, hasta el 30 de julio y totalmente gratuitas.', '', 0),
(4, 'inscripciones-julio.jpg', 'Inscripciones abiertas', '/noticias/inscripciones-abiertas', 'Leé más acá', 'Teatro, música, circo, pintura, dibujo y mucho más para vos y tu familia.', 'home', 3),
(5, 'prevencion1.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(6, 'prevencion2.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(7, 'prevencion3.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(8, 'prevencion4.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(9, 'prevencion5.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(10, 'prevencion6.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(11, 'prevencion7.jpg', '', '', 'Leer más', '', 'prevencion', 0),
(12, 'trabajadores1.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(13, 'trabajadores2.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(14, 'trabajadores3.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(15, 'trabajadores4.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(16, 'trabajadores5.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(17, 'trabajadores6.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(18, 'trabajadores7.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(19, 'trabajadores8.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(20, 'trabajadores9.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(21, 'trabajadores10.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(22, 'trabajadores11.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(23, 'trabajadores12.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(24, 'trabajadores13.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(25, 'trabajadores14.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(26, 'trabajadores13.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(27, 'trabajadores15.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(28, 'trabajadores16.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(29, 'trabajadores17.jpg', '', '', 'Leer más', '', 'trabajadores', 0),
(31, 'slider-viajes2.jpg', '', '', 'Leer más', '', 'viajes', 2),
(32, 'slider-viajes3.jpg', '', '', 'Leer más', '', 'viajes', 3),
(33, 'slider-viajes4.jpg', '', '', 'Leer más', '', 'viajes', 4),
(34, 'slider-viajes5.jpg', '', '', 'Leer más', '', 'viajes', 5),
(35, 'celesteyblanca.jpg', '', '', 'Leer más', '', 'celeste', 0),
(36, 'slider-cyb1.jpg', '', '', 'Leer más', '', 'celeste', 0),
(37, 'slider-cyb2.jpg', '', '', 'Leer más', '', 'celeste', 0),
(38, 'slider-cyb3.jpg', '', '', 'Leer más', '', 'celeste', 0),
(39, 'slider-cyb4.jpg', '', '', 'Leer más', '', 'celeste', 0),
(40, 'slider-cyb5.jpg', '', '', 'Leer más', '', 'celeste', 0),
(41, 'slider-cyb6.jpg', '', '', 'Leer más', '', 'celeste', 0),
(42, 'slider-cyb7.jpg', '', '', 'Leer más', '', 'celeste', 0),
(43, 'slider-cyb8.jpg', '', '', 'Leer más', '', 'celeste', 0),
(44, 'slider-cyb9.jpg', '', '', 'Leer más', '', 'celeste', 0),
(45, 'slider-derportes1.jpg', '', '', 'Leer más', '', 'deportes', 0),
(46, 'slider-derportes2.jpg', '', '', 'Leer más', '', 'deportes', 0),
(47, 'slider-derportes3.jpg', '', '', 'Leer más', '', 'deportes', 0),
(48, 'slider-derportes4.jpg', '', '', 'Leer más', '', 'deportes', 0),
(49, 'slider-derportes5.jpg', '', '', 'Leer más', '', 'deportes', 0),
(50, 'slider-derportes6.jpg', '', '', 'Leer más', '', 'deportes', 0),
(51, 'slider-derportes7.jpg', '', '', 'Leer más', '', 'deportes', 0),
(52, 'slider-derportes8.jpg', '', '', 'Leer más', '', 'deportes', 0),
(53, 'escuela1.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(54, 'escuela2.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(55, 'escuela3.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(56, 'escuela4.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(57, 'escuela5.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(58, 'escuela6.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(59, 'escuela7.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(60, 'slider-hotel.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(61, 'imarangatu-slider2.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(62, 'escuela8.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(63, 'escuela9.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(64, 'escuela10.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(65, 'escuela11.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(66, 'escuela12.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(67, 'escuela13.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(68, 'escuela14.jpg', '', '', 'Leer más', '', 'enfermeria', 0),
(69, 'pontevedra-slider2.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(71, 'patria-slider1.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(72, 'slider-hoteles1.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(73, 'slider-hoteles2.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(74, 'slider-hoteles3.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(75, 'slider-hoteles4.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(76, 'slider-hoteles5.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(77, 'slider-hoteles6.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(78, 'slider-hoteles7.jpg', '', '', 'Leer más', '', 'hoteles', 0),
(81, 'slider-viajes1.jpg', '', '', 'Leer más', '', 'viajes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_orden` int(11) NOT NULL DEFAULT '0',
  `staff_nombre` varchar(250) DEFAULT '',
  `staff_cargo` varchar(250) NOT NULL DEFAULT '',
  `staff_trabajo` varchar(250) NOT NULL DEFAULT '',
  `staff_image` varchar(250) NOT NULL DEFAULT '',
  `staff_redsocial` varchar(250) NOT NULL DEFAULT '',
  `staff_post_type` varchar(250) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_orden`, `staff_nombre`, `staff_cargo`, `staff_trabajo`, `staff_image`, `staff_redsocial`, `staff_post_type`) VALUES
(1, 0, 'Daer Héctor Ricardo', 'Secretario General', 'Laboratorio Bernabó', 'hector-autoridades.jpg', '@hectordaer', 'secretario_general'),
(2, 1, 'Vergara Gayozo Ligia Mabel', 'Secretaria General Adjunta', 'Swiss Medical - Pueyrredon', 'mabel-vergara.jpg', '@Mabyvergara2', 'comision_directiva'),
(3, 2, 'Lujan Hugo', 'Secretario de Actas', 'Hospital Italiano', 'hugo-lujan.jpg', '', 'comision_directiva'),
(4, 3, 'Guzzetti Pablo David', 'Secretario de Finanzas', 'Hospital Alemán', 'pablo-guzetti.jpg', '', 'comision_directiva'),
(9, 1, 'Cra Alicia Carnucchio', '', '', 'alicia-carnucchio.jpg', '', 'delegados_gremiales'),
(10, 3, 'Cro. Sergio Doubrova', '', '', 'sergio-doubrova.jpg', '', 'delegados_gremiales'),
(11, 5, 'Cra. Alejandra Sandoval', '', '', 'alejandra-sandoval.jpg', '', 'delegados_gremiales'),
(12, 4, 'Cra. Cecilia Pogonza', '', '', 'cecilia-pogonza.jpg', '', 'delegados_gremiales'),
(13, 2, 'Cro. José Luis Alberto Jelvez', '', '', 'jose-jelvez.jpg', '', 'delegados_gremiales'),
(14, 6, 'Cro. Fabian Rivas', '', '', 'fabian-rivas.jpg', '', 'delegados_gremiales'),
(15, 1, 'Coria Héctor Marcelo', '1° Vocal Titular', 'Fundación Favaloro', '', '', 'vocales_titulares'),
(17, 2, 'Jaime Silvia Cristina', '2° Vocal Titular', 'Sanatorio Mitre', '', '', 'vocales_titulares'),
(18, 3, 'Rivarola Enrique', '3° Vocal Titular', 'Drog. Suizo Argentina', '', '', 'vocales_titulares'),
(19, 4, 'Lencioni Dario Osmar', '4° Vocal Titular', 'Mater Dei', '', '', 'vocales_titulares'),
(20, 5, 'Sequeira Marta', '5° Vocal Titular', 'Clínica del Sol', '', '', 'vocales_titulares'),
(21, 6, 'Castro Nelly Cristina', '6° Vocal Titular', 'Clínica Adventista', '', '', 'vocales_titulares'),
(22, 7, 'Suarez Stella Maris', '7° Vocal Titular', 'Centro Gallego', '', '', 'vocales_titulares'),
(23, 8, 'Narbe Carlos', '8° Vocal Titular', 'Sanatorio Güemes', '', '', 'vocales_titulares'),
(25, 9, 'Capristo Pablo Enrique', '9° Vocal Titular', 'Vittal / Emergencias', '', '', 'vocales_titulares'),
(26, 10, 'Reynoso Juan Andrés', '10° Vocal Titular', 'Laboratorios Rivero', '', '', 'vocales_titulares'),
(27, 1, 'Alvarez Soler Daniel', '1° Vocal Suplente', 'Hospital Español', '', '', 'vocales_suplentes'),
(28, 2, 'Santangelo Mónica', '2° Vocal Suplente', 'Ciarec', '', '', 'vocales_suplentes'),
(29, 3, 'Lusquiños Juan Pablo', ' 3° Vocal Suplente', 'Instituto Dupuytren', '', '', 'vocales_suplentes'),
(30, 4, 'Rodriguez Néstor Javier', '4° Vocal Suplente', 'Hospital Sirio Libanes', '', '', 'vocales_suplentes'),
(31, 5, 'Barros Diego Omar', '5° Vocal Suplente', 'Hospital Britanico', '', '', 'vocales_suplentes'),
(32, 6, 'Medina Sonia', '6° Vocal Suplente', 'Laboratorios FADA', '', '', 'vocales_suplentes'),
(33, 7, 'Quevedo Mirta Alejandra', '7° Vocal Suplente', 'CI. Sta. Rosa Psicopatología', '', '', 'vocales_suplentes'),
(34, 8, 'Casares Estela', '8° Vocal Suplente', 'Sanatorio Franchin', '', '', 'vocales_suplentes'),
(35, 9, 'Echeverría Diego Brisio', '9° Vocal Suplente', 'Laboratorios Biosidus', '', '', 'vocales_suplentes'),
(36, 10, 'Salamone Pablo', '10° Vocal Suplente', 'Cruz Roja Argentina', '', '', 'vocales_suplentes'),
(37, 1, 'González Fernando', '1° Revisor de Cuentas Titular', 'Emergencias', '', '', 'revisores_de_cuenta'),
(38, 2, 'Vergara Marcelo', '2° Revisor de Cuentas Titular', 'Clínica Bazterrica', '', '', 'revisores_de_cuenta'),
(39, 3, 'Muiño Inés', '3° Revisor de Cuentas Titular', 'Hospital U.I.A', '', '', 'revisores_de_cuenta'),
(40, 4, 'Romero Jorge', '1° Revisor de Cuentas Suplente', 'Sanatorio Finochietto', '', '', 'revisores_de_cuenta'),
(41, 5, 'Almirón Nancy Vanina', '2° Revisor de Cuentas Suplente', 'Medicus', '', '', 'revisores_de_cuenta'),
(42, 6, 'Álvarez Antonio', '3° Revisor de Cuentas Suplente', 'I.C.B.A', '', '', 'revisores_de_cuenta'),
(43, 4, 'Rojas Lucio', 'Sub-Secretario de Finanzas', 'Laboratorio Baliarda', 'lucio-rojas.jpg', '', 'comision_directiva'),
(44, 5, 'Pokoik García Javier', 'Secretario Gremial y de Organización', 'Facoep S.E.', 'javier-pokoik.jpg', '@Javipok', 'comision_directiva'),
(45, 6, 'Sisto Diego Maximiliano', 'Sub-Secretario Gremial', 'Swiss Medical - 25 de Mayo', 'diego-sisto.jpg', '@sistomax', 'comision_directiva'),
(46, 7, 'Acosta Carneiro María Ximena', 'Sub-Secretaria de Organización', 'Stamboulian', 'ximena.jpg', '', 'comision_directiva'),
(47, 8, 'Ramírez Héctor Abel', 'Secretario de Seguridad, Higiene y Medicina del Trabajo', 'Instituto Alexander Fleming ', 'abel-ramirez.jpg', '@AbelATSA', 'comision_directiva'),
(48, 9, 'Maschio Norberto', 'Secretario de Prensa y Difusión', 'Sanatorio Sagrado Corazón', 'norberto.jpg', '@norbertomaschio', 'comision_directiva'),
(49, 10, 'Frías Abel', 'Sub-Secretario de Prensa y Difusión', 'Laboratorios Elea', 'abel-frias.jpg', '@abelfras2', 'comision_directiva'),
(50, 11, 'López Norma Leonor', 'Secretaria de la Mujer', 'Laboratorios Gador', 'norma-lopez.jpg', '@NormaLo08721498', 'comision_directiva'),
(51, 12, 'Jara Graciela', 'Secretaria de Asistencia Social', 'Laboratorio Sant Gall Friburg', 'graciela-jara.jpg', '', 'comision_directiva'),
(52, 13, 'Turner Dopazo Susan Elizabeth', 'Sub-Secretaria de Asistencia Social', 'Sanatorio San José ', 'susan-turner.jpg', '@seturner27', 'comision_directiva'),
(53, 14, 'Leite Raúl Enrique', 'Secretario de Deporte y Turismo', 'Droguería Monroe Americana', 'raul-leite.jpg', '', 'comision_directiva'),
(54, 15, 'Pérez Ruben Agustín', 'Sub-Secretario de Deporte y Turismo', 'Clínica de la Esperanza', 'ruben-perez.jpg', '@perezagustin211', 'comision_directiva'),
(55, 16, 'Romero Ricardo', 'Secretario de Vivienda', 'Sanatorio Otamendi', 'romero.jpg', '', 'comision_directiva'),
(56, 17, 'Quevedo Cristina Elisa', 'Secretaria de Acción Cultural y Capacitación', 'Instituto Argentino de Diagnostico y Tratamiento (IADT)', 'cristina-quevedo.jpg', '', 'comision_directiva'),
(57, 18, 'Consoni Mónica', 'Sub-Secretaria de Acción Cultural y Capacitación', 'Instituto Amado Olmos', 'monica-consoni.jpg', '', 'comision_directiva'),
(58, 19, 'Romero Sergio Daniel', 'Secretario de Acción Social', 'Laboratorios Richet', 'sergio-romero.jpg', '@romero_sergiod', 'comision_directiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `user_id` int(10) NOT NULL,
  `user_usuario` varchar(50) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_nombre` varchar(100) NOT NULL,
  `user_status` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user_id`, `user_usuario`, `user_password`, `user_nombre`, `user_status`) VALUES
(0, 'coco@lacueva.tv', '$2y$10$lj7YrUfJagOjWVx7VN2mL.HK61ZwBL/mISc1Lu1FExYcwPkivPc/i', 'coco', 0),
(1, 'josefina@conjuro.biz', '$2y$10$VQpgSWXbKY6x4pXlgyWvA.8KwYxPGi.7TxMR28UbiMRupj.wqjMc2', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  ADD PRIMARY KEY (`beneficio_ID`);

--
-- Indices de la tabla `convenios`
--
ALTER TABLE `convenios`
  ADD PRIMARY KEY (`convenios_id`),
  ADD UNIQUE KEY `convenios_id` (`convenios_id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`curso_ID`),
  ADD KEY `curso_titulo` (`curso_titulo`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`deportes_id`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`hotel_ID`),
  ADD KEY `hotel_titulo` (`hotel_titulo`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`laboratorio_ID`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`post_ID`),
  ADD KEY `post_titulo` (`post_titulo`);

--
-- Indices de la tabla `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_ID`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`pregunta_ID`);

--
-- Indices de la tabla `prevencion`
--
ALTER TABLE `prevencion`
  ADD PRIMARY KEY (`prevencion_ID`);

--
-- Indices de la tabla `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_usuario` (`user_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  MODIFY `beneficio_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `convenios`
--
ALTER TABLE `convenios`
  MODIFY `convenios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `curso_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `deportes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `hotel_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `laboratorio_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `post_ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `pages`
--
ALTER TABLE `pages`
  MODIFY `page_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `pregunta_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `prevencion`
--
ALTER TABLE `prevencion`
  MODIFY `prevencion_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `sliders`
--
ALTER TABLE `sliders`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
