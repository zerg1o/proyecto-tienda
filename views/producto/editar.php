<h1>Editar Producto</h1>

<?php if(isset($_SESSION['update']) && $_SESSION['update']=="Completed"): ?>
    <strong class="alert-green">Actualización exitosa</strong>
<?php elseif(isset($_SESSION['update']) && $_SESSION['update']=="Failed"): ?>
    <strong class="alert-red">Actualización fallida</strong>
<?php endif; ?>

<form action="<?=base_url?>producto/update&id=<?=$pro->id?>" method="post" enctype="multipart/form-data">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="<?= is_object($pro) ? $pro->nombre:''?>"/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"nombre"):"" ?>


    <label for="descripcion">Descripcion</label>
    <textarea class="textarea" name="descripcion" id="" cols="30" rows="5"><?= is_object($pro) ? $pro->descripcion:''?></textarea>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"descripcion"):"" ?>

    <label for="precio">precio</label>
    <input type="text" name="precio" value="<?= is_object($pro) ? $pro->precio:''?>"/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"precio"):"" ?>


    <label for="stock">stock</label>
    <input type="number" name="stock" min="0" value="<?= is_object($pro) ? $pro->stock:''?>"/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"stock"):"" ?>

    <label for="categoria">Categoria</label>
    <?php $categorias = Utils::showCategorias(); ?>
    <select name="categoria">
        <?php while($cat = $categorias->fetch_object()): ?>
        <option value="<?=$cat->id?>"  <?= is_object($pro) && $cat->id==$pro->categoria_id ? "selected":'' ?> ><?=$cat->nombre?></option>
        <?php endwhile; ?>
    </select>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"categoria"):"" ?>


    <label for="imagen">Imagen</label>

    <?php if(is_object($pro) && !empty($pro->imagen)): ?>
        
        <img class="thumb" src="<?=base_url?>/uploads/imagenes/<?=$pro->imagen?>" alt="">
    
    <?php endif; ?>

    <input type="file" name="imagen" id=""/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"imagen"):"" ?>
    <input type="submit" name="btn-guardar-producto" value="Guardar"/>
</form>
<?php Utils::deleteSesion('update');  ?>
<?php Utils::deleteSesion('errores');  ?>