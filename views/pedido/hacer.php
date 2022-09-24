

<?php if(isset($_SESSION['usuario'])): ?>


<h1>Realizar Pedido</h1>
<?php if(isset($_SESSION['register'])): ?>
    <div class="alert-green"><?=$_SESSION['register']?></div>
<?php endif; ?>
<h2>Direccion para el envio:</h2>
<form action="<?=base_url?>pedido/add" method="post">
    <label for="provincia">Provincia</label>
    <input type="text" name="provincia" id="" required/>
    <label for="direccion">Direccion</label>
    <input type="text" name="direccion" id="" required/>
    <label for="localidad">Localidad</label>
    <input type="text" name="localidad" id="" required/>
    <input type="submit" value="Confirmar Pedido" name="btn-guardar-pedido">
</form>
<?php else: ?>
    <h1>Necesita estar logueado</h1>
    <p>Necesita estar logueado para realizar un pedido.</p>
<?php endif; ?>

<?php Utils::deleteSesion("register"); ?>
