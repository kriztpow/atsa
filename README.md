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

### Versión 2.2
* Base de datos noticias (el index busca si es noticias en la base de datos)
* Paginación cada 10 post
* Cargar más noticias mediante ajax
* Hoteles cargados en base de datos
* Cursos tecnico profesional cargados en base de datos
* SE ELIMINA ARCHIVO DATA.PHP

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
