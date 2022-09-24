<?php if(isset($_SESSION['register'])&&$_SESSION['register']=="completed" && is_object($last_pedido)): ?>
<h1>Pedido Registrado</h1>
<p>
Deberas realizar el pago mediante una transferencia bancaria al numero de cuenta
322322322322, una vez realizado se procesará el pedido y envio del mismo.
</p>
<br>
<br>
<div class="detail-pedido">
    <h3>Datos del pedido</h3>
    <h4>Numero de pedido: <?=$last_pedido->id?></h4> 
    <h4>Total a pagar: S/<?=$last_pedido->coste?></h4>
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
<?php elseif((isset($_SESSION['register'])&&$_SESSION['register']!="completed")):  ?>
    <h1>No se ha podido registrar el pedido</h1>
<?php endif;  ?>
