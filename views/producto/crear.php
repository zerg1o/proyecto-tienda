<h1>Registrar Producto</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register']=="Completed"): ?>

<strong class="alert-green">Registro exitoso</strong>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=="Failed"): ?>

<strong class="alert-red">Registro fallido</strong>

<?php endif; ?>

<form action="<?=base_url?>producto/save" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre"/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"nombre"):"" ?>


    <label for="descripcion">Descripcion</label>
    <textarea class="textarea" name="descripcion" id="" cols="30" rows="5"></textarea>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"descripcion"):"" ?>

    <label for="precio">precio</label>
    <input type="text" name="precio"/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"precio"):"" ?>


    <label for="stock">stock</label>
    <input type="number" name="stock" min="0"/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"stock"):"" ?>

    <label for="categoria">Categoria</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="categoria">
        <?php while($cat = $categorias->fetch_object()): ?>
        <option value="<?=$cat->id?>"><?=$cat->nombre?></option>
        <?php endwhile; ?>
    </select>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"categoria"):"" ?>


    <label for="imagen">Imagen</label>
    <input type="file" name="imagen" id=""/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"imagen"):"" ?>
    <input type="submit" name="btn-guardar-producto" value="Guardar"/>
</form>
<?php Utils::deleteSesion('register');  ?>
<?php Utils::deleteSesion('errores');  ?>