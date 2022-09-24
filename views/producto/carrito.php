<?php if(!isset($_SESSION['carrito'])): ?>
        <?php $_SESSION['carrito']=array(); ?>
<?php endif; ?>

<h1>Carrito run run</h1>
<?php if(count($_SESSION['carrito'])>0): ?>
<table class="tabla">

    <th>PRODUCTO</th>
    <th>NOMBRE</th>
    <th>PRECIO</th>
    <th>CANTIDAD</th>
    <th>MONTO</th>
    <th>ACCIONES</th>

    <?php foreach($_SESSION['carrito'] as $pro): ?>
        <tr>
            <td>
            <?php if($pro->imagen!=null): ?>
                <img class="imagen-carrito" src="<?=base_url?>uploads/imagenes/<?=$pro->imagen?>" alt="imagen">
            <?php else: ?>
                <img class="imagen-carrito" src="<?=base_url?>assets/img/imagen_default.png" alt="imagen">
            <?php endif; ?>
            </td>
            <td><?=$pro->nombre?></td>
            <td><?=$pro->precio?></td>
            <td><a class="button button-aniadir" href=""> - </a><?=$pro->cantidad?><a class="button button-aniadir" href=""> + </a></td>
            <td>S/<?= ($pro->cantidad * $pro->precio) ?></td>
            <td>
                <a class="button button-red" href="<?=base_url?>carrito/deleteProducto&id=<?=$pro->id?>">Quitar</a>
                <a class="button button-blue" href="<?=base_url?>producto/ver&id=<?=$pro->id?>&editar=1">Editar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php $carrito = Utils::datosCarrito(); ?>
<br>
<div>
    <div class="vaciar-carrito">
        <a class="button button-small button-red" href="<?=base_url?>carrito/delete">Vaciar Carrito</a>
    </div>

    <div class="total-carrito">
        <h3>Total S/<?=$carrito['total']?></h3>
        <a class="button button-small button-green" href="<?=base_url?>pedido/hacer">Finalizar Compra</a>
    </div>
</div>

<?php else: ?>
    <h3>Carrito vacío</h3>
    <a class="button button-small button-green" href="<?=base_url?>">Ver Productos</a>
<?php endif; ?>