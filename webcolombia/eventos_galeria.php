<link type="text/css" href="scripts/uploader/assets/css/style.css" rel="stylesheet"></link>
<script src="scripts/uploader/assets/js/jquery.knob.js"></script>
<script src="scripts/uploader/assets/js/jquery.ui.widget.js"></script>
<script src="scripts/uploader/assets/js/jquery.iframe-transport.js"></script>
<script src="scripts/uploader/assets/js/jquery.fileupload.js"></script>
<script src="scripts/uploader/assets/js/script.js"></script>

<div class="fondo-eventos">
    <div class="titulo-present-eventos">ADMINISTRADOR GALERIAS</div>
    <form id="upload" method="post" action="webcolombia/upload.php" enctype="multipart/form-data">
        <label>Nombre de la Galeria<input type="text" value="" id="nombre" name="nombre"/></label>
        <br />
        <input type="submit" value="Cargar Galeria" id="procesar"/>
        <div id="drop">
            Arrastre Archivos
            <a>Examinar...</a>
            <input type="file" name="upl" multiple />
        </div>
        <ul></ul>
    </form>
</div>