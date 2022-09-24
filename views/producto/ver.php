<h1><?=$pro->nombre?></h1>
    <div class="detail-product">
        <div class="imagen">
    <?php if($pro->imagen!=null): ?>
        <img src="<?=base_url?>uploads/imagenes/<?=$pro->imagen?>" alt="imagen">
    <?php else: ?>
        <img src="<?=base_url?>assets/img/imagen_default.png" alt="imagen">
    <?php endif; ?>
        </div>
        <div class="data">
            <h3 class="descripcion">Descripcion</h3>
            <p class="descripcion"><?=$pro->descripcion?></p>
            <h3 class="precio">Precio</h3>
            <p class="precio">S/<?=$pro->precio?></p>
            <h3 class="precio">Stock</h3>
            <p class="precio"><?=$pro->stock?></p>
            <?php 
            
                if(isset($_GET['editar'])){

                    $url = base_url."carrito/edit&id=".$pro->id;

                }else{
                    $url = base_url."carrito/add&id=".$pro->id;
                }
            ?>
            <form action="<?=$url?>" method="post">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" min="1" required/>
                <?php echo isset($_SESSION['msj-carrito']) ? "<div class='alert-green'>".$_SESSION['msj-carrito']."</div>":"" ?>
                <input type="submit" value="Añadir al carrito" name="btn-add-producto"/>
            
            </form>
            <a href="<?=base_url?>carrito/ver" class="button">Ver Carrito</a>    
        </div>
        
        
    </div>

    <?php Utils::deleteSesion("msj-carrito"); ?>
