
<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register']=="Completed"): ?>

    <strong class="alert-green">Registro exitoso</strong>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=="Failed"): ?>

    <strong class="alert-red">Registro fallido, introduzca bien los datos</strong>

<?php endif; ?>

<form action="<?=base_url?>/usuario/save" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"nombre") : "";?>
    <label for="apellidos">Apellidos</label>
    <input type="text" name="apellidos" required/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"apellidos") : "";?>
    <label for="email">Email</label>
    <input type="email" name="email" required/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"email") : "";?>
    <label for="password">Password</label>
    <input type="password" name="password" required/>
    <?php echo isset($_SESSION['errores']) ? Utils::mostrarErrores($_SESSION['errores'],"password") : "";?>
    <input type="submit" value="Registrarse" name="btn-registrar-usuario"/>
</form>
<?php Utils::deleteSesion('register');  ?>
<?php Utils::deleteSesion('errores');  ?>