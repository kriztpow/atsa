#ATSA - Sitio Autoadministrable

(PHP - HTML5 - JQUERY)
Inicio: 11-06-17

## Librerías utilizadas
* Jquery 3.1.1
* Jquery UI (personalizado, accordion y tabs)
>>>> NOTA: cuando se usa la etiqueta base en el head, las tabs no funcionan, para que funcionen hay que escribir el href completo, es decir, en vez de #id http://dominio.com/#id. Para solucionarlo yo hice script de javascript para que tomen el url correcto del navegador y lo agreguen al id y siempre funcione
* Bootstrap (personalizado solo con grid y algunos accesorios, mínimos)
* agregado un chat, librería: 'mylivechat'
* html5shiv.js (para internet explorer vieo)
* jquery-gridrotator v1.1.0 - pluggin grid (homepage) para mostrar fotos. TUVE QUE CORREGIR LINEA 228 PORQUE LA FUNCION 'LOAD' NO EXISTE MAS, TUVE QUE PONER "ON.('LOAD', FUNCTION)"
* modernizr custom, viene con pluggin grid anterior
* Images grid, jquery pluggin: https://github.com/taras-d/images-grid - ESTE GRID SE QUITÓ LUEGO
* Google analytics  

## VERSIONES:

### Versión 8.4 - PAGINA NUEVA, MUJERES QUE HICIERON HISTORIA (nov.2018)

### Versión 8.3 - PAGINA EXCLUSIVA DELEGADOS (nov.2018)
* Crear templates con accesos restringidos para usuarios legados
* Este template se maneja desde el backend de admin
* En afiliados las imágenes (que son unicamente de los iconos de los usuarios) se suben a atsa.org.ar/uploads/images pero se guardan en la base de datos en la parte de usuarios, no se guardan en base de datos como medios y por lo tanto no se pueden listar luego

### Versión 8.2 - RECHAZADOS
* Modificaciones en el backend para que cuando un usuario es rechazado, se agregue a una base de datos y se pueda ver.

### Versión 8.1 - AFILIATE  
* modificaciones del front, para que el afiliado pueda autocompletar sus datos, pero deben hacerlo en 5 días, luego no se puede más.
* correcciones en el back para que tengan más filtros para ver no contactados, anulados, firmados y contactados
* se agrega usuario delegado que puede solo cargar afiliados

### Versión 8 - AFILIATE  
* Creación landing page para afiliarse con manejo de usuarios

### Versión 7 - SSL
* Le agregué a la funcion url_base() el https para que funcione bien.


### Versión 6 - AUTOADMINISTRABLE  
* Se le suma la página del Complejo de Cultural, agregué un nuevo administrador, para administrar esa página  

### Versión 5 - AUTOADMINISTRABLE
* Se le suma la página de Voces de sanidad, agregué un nuevo administrador, para administrar esa página

### Versión 4 - AUTOADMINISTRABLE  
(18/12/17)  

* Cambios en inicio, ahora la pagina es autoadministrable.
* Cree un nuevo item en la base de datos para que busque ahí todos los datos de la página de inicio

### Versión 3.4 - AUTOADMINISTRABLE
* Cambios en voces de sanidad
* Publicado 3 noticias, 1 por categoría (versión estática)

### Versión 3.3 - AUTOADMINISTRABLE
* Link de Voces de sanidad habilitado

### Versión 3.2 - AUTOADMINISTRABLE
* Slider del home clickqeable. OK
* solo las últimas tres noticias ok
* no hay más cargar mas,
* se ven dos ultimas noticias destacadas (como en las noticias individuales), ya que si pongo 3 tengo que editar todo de nuevo y no llego a hacerlo. si querés pongo 4, pero tiene que ser par.
* cuando ingresas a una noticia en particular quieren que el título permanezca arriba como cuando estás en la home de las noticias y no después de la foto porque se pierde. OK (creo, según entendí)
* ya no se pueden suscribir sin poner email :D
* corregí el mensaje por el que me mandaste "Gracias por suscribirse"

### Versión 3.1 - AUTOADMINISTRABLE
* Lo estático se toma de la base de datos, modulos: deportes, leyes, convenios, autoridades


### Versión 3 - AUTOADMINISTRABLE
* Detalles de modulo de auto administración va en otro lugar
* Le agregué en el loop de noticias una especie de programación. Ya que omite toda noticia que tenga fecha después de hoy. Entonces si al editar se pone una fecha superior queda programada.
* agregué sistema de etiquetas
* Agregué el SEO de facebook, toma la imagen destacada de la noticia, titulo y descripción
* agregué compartir con facebook, twitter e imprimir.
* Agregue para compartir por email, pero con mailto

### Versión 2.3
* Subida Online 30/07/17
* Slider con base de datos
* Se borran todos los archivos de sliders y se remplaza por uno solo.
* Todas las imagenes re organizadas, se suben directo a upload/images sin subcarpeta. Salvo las del grid del home que tiene su carpeta simple
* se corrigió el menú para que funcione mejor
* algunos ajustes de estilo corregidos
* agregué noticias debajo de la noticia single para conituar navegando

### Versión 2.2
* Base de datos noticias (el index busca si es noticias en la base de datos)
* Paginación cada 10 post
* Cargar más noticias mediante ajax
* Hoteles cargados en base de datos
* Cursos tecnico profesional cargados en base de datos
* SE ELIMINA ARCHIVO DATA.PHP
* Corregí el bug de tabs de jquery ui que sucede cuando usas la etiqueta base en head

### Versión 2.1 (23.7.17)
* Permalinks (links bonitos) habilitados por completo
* Correcciones y noticias nuevas
* Google analytics

### Versión 2.0.2
* Correcciones y noticias nuevas (17.7.17)

### Versión 2.0.1
* finalmente version online (14.7.17)
* corregido todo y con los pdfs actualizados
* templates: hay version con permalinks (urls bonitas para la version online) y sin permalinks para trabajar localmente (son cuatro archivos: menu.php sub-menu.php home.php footer.php)
* noticias no tiene url bonitas (VER OTRA CONFIGURACIÓN LUEGO)
* backup en dropbox

### Versión 2.0
* Noticias y cursos funciona con variables impresas en archivo (data que luego se remplazará con base de datos)
* noticias-index fue quitado. El archivo de noticias busca el template noticias-loop (que puede ser con una cagetoria o gral) o el template noticias-single
* todas las internas terminadas
* formularios funcionando en php básico y con ajax la respuesta va a info@atsa.org.ar
* falta la parte administrable
* falta la base de datos
* corregido el script del slider para que funcione mejor
* Corregido css para que se vea mejor en varios lados
* grid de imagenes borrado completamente
* voces de sanidad no está linqueado
* chat agregado a la pagina

### Novena versión: 1.9
* ajustes al home
* carga de información estática
* más paginas internas
* menú arreglado al hacer scroll, cuando queda fijo no tiene más ese salto

### Octava versión: 1.8
* pagina noticias funciona independiente de las demaś, ya que tiene otra lógica y va a ser el loop en base de datos en el futuro buscando por categorías
*grid de imagenes al home

### Septima versión: 1.7
* Editando páginas internas
* Agregue una pagina noticias.php pero falta editarla

### Sexta Versión: 1.6
* Modifica el menú para que el segundo menu esté incluido en el movil, pero que este menú sea uno solo

### Quinta Versión: 1.5
* Editando páginas internas
* Agregue el scripy de jquery en <head> porque necesitaba que cargue antes
* hay páginas que tienen módulos de jqueryUI
* MENU:  
-indicación de navegacion: en las páginas internas te indica donde estas y hay un link para volver al inicio

### Cuarta versión: 1.4
* Pagina internas (estáticas): 1-autoridades
* el menú fue separado como template, así se puede elegir que menú mostrar y remarcar que enlace está activo


### Tercera versión: 1.2
* cambios en slider, más alto
* cambios en menu, ahora es fixed
* retoques diseño

### Segunda versión: 1.1
* cambios de diseño pagina inicio
* versión full width
* sigue siendo estático
* cambia header (menú)
* cambia footer
* cambia slider (se hace full width)
* cambios de algunos contenidos

### Primera versión: 1.0
* sin base de datos
* Página de inicio responsive, maquetado estático  
* responsive: Semi propio, estoy usando BOOTSTRAP solo por grid, uso mucho la clase "container" y también el reset de bootstrap
* slider propio hecho con jquery  
* Menus y script hecho todo propio, no hay nada de bootstrap
