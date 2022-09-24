<h1>Detalles del pedido</h1>

<?php if(isset($_SESSION['admin'])): ?>
    <h3>Cambiar estado del pedido:</h3>
    <?php if(isset($_SESSION['estado']) && $_SESSION['estado']=="completed"): ?>
        <div class="alert-green">Estado actualizado</div>
    <?php elseif(isset($_SESSION['estado']) && $_SESSION['estado']!="completed"): ?>
        <div class="alert-red">Fallo al actualizar estado</div>
    <?php endif; ?>
    <br>
    <form action="<?=base_url?>pedido/estado" method="post">
        <input type="hidden" name="id" value="<?=$detalle_pedido->id?>">
        <select name="estado">
            <option value="confirmado" <?= $detalle_pedido->estado =="confirmado" ? 'selected' :''?> >Confirmado</option>
            <option value="aprobado" <?= $detalle_pedido->estado =="aprobado" ? 'selected' :''?>>Pago aprobado</option>
            <option value="preparado" <?= $detalle_pedido->estado =="preparado" ? 'selected' :''?>>Preparado para enviar</option>
            <option value="enviado" <?= $detalle_pedido->estado =="enviado" ? 'selected' :''?>>Enviado</option>
            <option value="reembolsado" <?= $detalle_pedido->estado =="reembolsado" ? 'selected' :''?>>Reembolsado</option>
            <option value="entregado" <?= $detalle_pedido->estado =="entregado" ? 'selected' :''?>>Entregado</option>
        </select>
        <input type="submit" value="Cambiar Estado" name="btn-cambiar-estado"/>
    </form>
    <br>
<?php endif; ?>
<div class="detail-pedido">
    <h3>Estado del pedido:</h3>
    <p><?=Utils::getEstado($detalle_pedido->estado)?></p>
    <br>
    <h3>Direccion del envio</h3>
    <p>Provincia: <?=$detalle_pedido->provincia?></p> 
    <p>Localidad: <?=$detalle_pedido->localidad?></p> 
    <p>Direccion: <?=$detalle_pedido->direccion?></p>
    <br>
    <h3>Datos del pedido</h3>
    <p>Numero de pedido: <?=$detalle_pedido->id?></p> 
    <p>Total a pagar: S/<?=$detalle_pedido->coste?></p>
</div>



<div class="productos-pedido">
    <table class="tabla tabla-pedido">
            <th>PRODUCTO</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
        <?php while($pro = $productos->fetch_object()): ?>
            
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
                    <td><?=$pro->unidades?></td>
                </tr>
            
        <?php endwhile; ?>
    </table>
</div>

<?php Utils::deleteSesion("estado"); ?>