<?php if(isset($gestion)):?>
    <h1>Gestionar Pedidos</h1>
<?php else: ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>

<table class="tabla">
    <th>N° PEDIDO</th>
    <th>COSTE</th>
    <th>FECHA</th>
    <th>ESTADO</th>

    <?php while($pedido = $pedidos->fetch_object()): ?>
        <tr>
            <td><a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>"><?=$pedido->id?></a></td>
            <td>S/<?=$pedido->coste?></td>
            <td><?=$pedido->fecha?></td>
            <td><?=Utils::getEstado($pedido->estado)?></td>
        </tr>
    <?php endwhile; ?>
</table>