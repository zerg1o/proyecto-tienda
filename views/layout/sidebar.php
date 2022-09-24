<!-- barra lateral -->

            <aside id="lateral">
                <div id ="login" class="block-aside">
                <?php if(!isset($_SESSION['usuario'])): ?>
                    <h3>Login</h3>
                <?php echo isset($_SESSION['error_login']) ? $_SESSION['error_login']:"" ?>
                    
                    <form action="<?=base_url?>usuario/login" method="post">
                        <label for="email">Email</label>
                        <input type="email" name="email"/>
                        <label for="password">Password</label>
                        <input type="password" name="password"/>
                        <input type="submit" name="btn-login" value="Ingresar"/>
                    </form>
                    <form action="<?=base_url?>usuario/registro" method ="post"><input type="submit" name="btn-registrarse" value="Registrarse"/></form>
                <?php else: ?>
                    <h2><?="Bienvenido, ".$_SESSION['usuario']->nombre." ".$_SESSION['usuario']->apellidos ?></h2>  
                    <ul>
                        <li><a href="<?=base_url?>pedido/mispedidos">Mis Pedidos</a></li>
                        <?php if(isset($_SESSION['admin'])): ?>
                        
                        <li><a href="<?=base_url?>pedido/gestion">Gestionar Pedidos</a></li>
                        <li><a href="<?=base_url?>producto/gestion">Gestionar Productos</a></li>
                        <li><a href="<?=base_url?>categoria/index">Gestionar Categorias</a></li>

                        <?php endif; ?>
                        <form action="<?=base_url?>usuario/logout" method ="post"><input type="submit" name="btn-cerrar-sesion" value="Cerrar sesión"/></form>
                        
                    </ul>
                <?php endif;?>
                </div>
            </aside>      
            <!-- contenido central -->
            <div id="central">
<?php Utils::deleteSesion("error_login"); ?>
