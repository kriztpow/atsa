<?php
/*
 * Sitio web: Colegio Buenos Aires
 * @LaCueva.tv
 * Since 1.0
 * PAGE TEMPLATE: PAGINA ERROR
*/
include 'header.php';
?>
<!--- .inner-wrapper: contenido principal y específico del template -->
<div class="inner-wrapper">
    <div class="page404">
        <h1>Página no encontrada</h1>
        <p>
            No se encontró artículo o página relacionada. Vuelva a intentar con otra búsqueda.
        </p>

        <a href="<?php echo MAINSURL; ?>" title="Inicio" role="link" class="btn">Volver al inicio</a>
    </div>
</div><!--- //.inner-wrapper -->

<?php include 'footer.php'; ?>