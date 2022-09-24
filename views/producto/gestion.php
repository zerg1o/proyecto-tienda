<h1>Gestion de Productos</h1>
<?php if(isset($_SESSION['delete']) && $_SESSION['delete']=="Completed"): ?>

<strong class="alert-green">Eliminación exitosa</strong>

<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete']=="Failed"): ?>

<strong class="alert-red">Eliminación fallida</strong>

<?php endif; ?>
<a class="button button-small" href="<?=base_url?>producto/crear">Registrar Producto</a>
<table class="tabla">
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
        
    <?php while($prod = $productos->fetch_object()): ?>
        
        <tr>
            <td><?=$prod->id?></td>
            <td><?=$prod->nombre?></td>
            <td><?=$prod->precio?></td>
            <td><?=$prod->stock?></td>
            <td>
                <a class="button button-red" href="<?=base_url?>producto/eliminar&id=<?=$prod->id?>">Eliminar</a>
                <a class="button button-gestion" href="<?=base_url?>producto/editar&id=<?=$prod->id?>">Editar</a>
            </td>
        </tr>
        
    <?php endwhile; ?>

</table>
<?php Utils::deleteSesion('update');  ?>
<?php Utils::deleteSesion('delete'); ?>