## BACKEND
* Versión 4.0
- restructuración porque el modal de bootstrap me causaba bastantes problemas
- agregué modulo de deportes para atsa
- agregué modulo de convenios y leyes para atsa
- agregué modulo de autoridades y delegados (staff) para atsa
- agregué modulo de hoteles y viajes para atsa
- agregué modulo de cultura para atsa (maneja institudo amada olmos, cursos no formales, convenios universitarios y los cursos de formación técnica profesional
- agregué modulo de beneficios para atsa
- agregué modulo de programas prevencion para atsa
- agregué modulo de laboratorio de simulacion para atsa
- agregué modulo de preguntas frecuentes para atsa
- agregué modulo de pages para atsa con editor de texto enriquecido


* Versión 3.0  
- Agrego sistema de usuarios
- Agrego modulo de editar noticias
- Biblioteca de imagenes recorre el directorio, las imagenes no están en la base de datos
- Se agregó la función callback de tinymce para cargar fotos propias y tener una mini biblioteca. Esa mini biblioteca usa tabs por ajax con jquery ui, y para eso se creo una carpeta ajax dentro de template, donde están los html que pide esas tabs con ajax
- Hay un sistema de programación de noticias por día, no funciona por horas. Al crear una noticia con una fecha posterior a la actual no se publica hasta que sea esa fecha.
- Modulo de carga los sliders
- Las imagenes se cargan desde una biblioteca que se hizo con .dialog() de jquery ui
- En las noticias, la galería de imagenes muestra las imágenes y se pueden ordenar mediante drag and drop
- Las etiquetas están funcionando, cuando se cambian de los post, siempre se recorren todas para actualizarlas y que no haya etiquetas sin contenido

NOTA:
Al usar modals, de bootstrap, las ventanas del editor de tinymce no funcionan correctamente. Los inputs no se pueden acceder, cuando queres escribir algo, entonces los links, las imágenes y todo lo que tengas un input para escribir no es accesible. Para corregir este error sirve este pequeño código:
~~~
$(document).on('focusin', function(e) {
  if ($(e.target).closest('.mce-window').length) {
    e.stopImmediatePropagation();
  }
});
~~~



* Versión 2.0 - fecha 10.5.17  
-Front end del admin hecho con bootstrap, mejorado y colorido
-Los modulos cargan mediante ajax
-se pueden cargar más de una imagen a la vez
-Seccion Contactos es una tabla, se puede imprimir y exportar a excel
-el popup tiene una imagen por defecto (esa función hay que incluirla en el front también pero la imagen siempre esta en admin)
-con un formulario se puede subir todos los archivos e indicar a que sección pertenece
-Estructura: Templates(html modulos y jquery incluido en el template para que ese script cargue solo con el modulo)
-se suben archivos y links
-los post_type de archivos son únicos, por lo tanto siempre se remplazan 'REPLACE INTO' en las query de MySQL.
-Galería tiene papelera de reciclaje para arrepentirse




* Versión 1.1 online
