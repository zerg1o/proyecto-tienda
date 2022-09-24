<h1>Crear Nueva Categoría</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register']=="Completed"): ?>

<strong class="alert-green">Registro exitoso</strong>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register']=="Failed"): ?>

<strong class="alert-red">Registro fallido</strong>

<?php endif; ?>

<form action="<?=base_url?>categoria/save" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre"/>
    <input type="submit" name="btn-guardar-categoria" value="Guardar"/>
</form>
<?php Utils::deleteSesion('register');  ?>
<?php Utils::deleteSesion('errores');  ?>